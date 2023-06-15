<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    // protected $primaryKey = 'staffid';
    protected $allowedFields = ['userid','staffid','stafftype'];

    public function addStaff($userid,$staffid,$stafftype)
    {
      $data['userid'] = $userid;
      $data['staffid'] = $staffid;
      $data['stafftype'] = $stafftype;
      return $this->insert($data);
    }
    public function getStaff($staffid = null)
    {
        if (!$staffid){
            return $this->findAll();
        }
    
        return $this->where(['staffid' => $staffid])->first();
    }
   public function getUserid($staffid){
     if(is_array($staffid))
     {
        $userIds = array();
        foreach ($staffid as $id) {
            $result = $this->select('userid')->where('staffid', $id)->findAll();
            foreach ($result as $row) {
                array_push($userIds, $row['userid']);
            }
        }
        return $userIds;
     }
    return $this->select('userid')->where('staffid',$staffid)->get()->getResultArray() ;
   }
    public function getStaffByUserid($userid) {
        if(is_array($userid))
      {
        $count = count($userid);  
        $userIds = array();
        
          for ($i=0;$i<$count;$i++) {
              $result = $this->where('userid', $userid[$i])->findAll();
              foreach ($result as $row) {
                  array_push($userIds, array(
                    'uid'=>$userid[$i],
                    'sid' => $row['staffid'],
                    't'=>$row['stafftype']
                  ));
              }
          }
          return $userIds;
      }
        $this->select('staffid');
        $this->where('userid', $userid);
        $query = $this->get();
        
        $result = array();
        foreach ($query->result() as $row) {
          $result[] = $row->staffid;
        }
        return $result;
      }
    public function getStaffid($userid)
    {
      return $this->select('staffid')->where('userid', $userid)->first()['staffid'];
    }
    public function deleteStaff($id)
    {
        return $this->where('userid',$id)->delete();
    }
    
}