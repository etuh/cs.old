<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customerid';
    protected $allowedFields = ['userid'];

    public function addCustomer($userid)
    {
      $data['userid'] = $userid;
      return $this->insert($data);
    }
    public function getCustomers($customerid = null)
    {
        if (!$customerid){
            return $this->findAll();
        }
    
        return $this->where(['customerid' => $customerid])->first();
    }
   public function getUserid($customerid){
     if(is_array($customerid))
     {
        $userIds = array();
        foreach ($customerid as $id) {
            $result = $this->select('userid')->where('customerid', $id)->findAll();
            foreach ($result as $row) {
                array_push($userIds, $row['userid']);
            }
        }
        return $userIds;
     }
    return $this->select('userid')->where('customerid',$customerid)->get()->getResultArray() ;
   }
    public function getCustomersByUserid($userid) {
      if (is_array($userid))
      {
        $result = array();
        foreach($userid as $id){
          $user = $this->where('userid', $id)->findAll();
            array_push($result, $user);
          }
      }
      else{
        $result = $this->where('userid', $userid)->findAll();
      }
        
       
        return $result;
      }
    public function deleteCustomer($id)
    {
        return $this->where('userid',$id)->delete();
    }
    
}