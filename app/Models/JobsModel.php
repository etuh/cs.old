<?php
namespace App\Models;

use CodeIgniter\Model;

class JobsModel extends Model
{
    protected $table      = 'job';
    protected $primaryKey = 'jobid';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['staffid', 'dqty', 'jobstart', 'orderid','jobtype','jobend' ];

    public function getJob($jobid = null)
    {
        if (!$jobid){
            return $this->findAll();
        }
        return $this->where(['jobid' => $jobid])->first();
    }
    public function getOrderid($jobid)
    {
        if (!$jobid) {
            return $this->select('orderid')->findAll();
        }
        $orderid = array();
        foreach($jobid as $id)
        {
            $rs = $this->select('orderid')->where('jobid',$id)->first();
            array_push($orderid,$rs);
        }
        return $orderid;
    }
    public function getJobByOrderid($orderid)
    {
        return $this->where(array('orderid'=>$orderid),1)->findAll();
    }
    public function getTotalQty($orderid) //Number of orders
    {
        return $this->where(array('orderid'=>$orderid),1)->countAllResults();
    }
    public function assignOrder($form)
    {
        $count = $form['count'];
        $orderid = $form['orderid'];
        $i=0;
        for($j=1;$i!=$count;$j++):
            $data[$i] = [
                'staffid' => $form['staffid'.$j],
                'dqty' => $form['qty'.$j],
                'jobstart' => date("Y-m-d H:i:s"),
                'jobtype' => 'tyer',
                'orderid' => $orderid
            ];
            $i++;
        endfor;

        foreach ($data as $record) {
            $status = $this->insert($record);
        }
        if($status){
            return 1; 
        }else{
            return 0;
        }
    }
    public function totaldqty($orderid)
    {
        return (int)$this->selectSum('dqty')->where('orderid', $orderid)->first()['dqty'];
    }
    public function deleteJob($id)
    {
        return $this->where('jobid',$id)->delete();
    }
    public function getStaffid($id)
    {
        if(is_array($id)){
            var_dump("here we waer");
            $sid =array();
            foreach ($id as $jobid){
                $rs = $this->select('staffid')->where(['jobid'=>$jobid])->findAll();
                array_push($sid, $rs);
            }
            // var_dump($sid);
            $sid = array_map(function($item) {
                return $item[0]['staffid'];
            }, $sid);
            return $sid;

        }
        return $this->select('staffid')->where(['jobid'=>$id])->first();
    }
    public function getJobsbyStaffid($id)
    {
        return $this->where(['staffid' => $id])->findAll();
    }
    public function complete($data)
    {
        $jobid = $data['jid'];
        $jobend = date("Y-m-d H:i:s");
        $status = $this->set('jobend', $jobend)->where('jobid', $jobid)->update();

        var_dump("status is ".$status);
        return $status;
    }
    public function reassign($post)
    {
        $jobid = $post['jid'];
        // $quantity = $data['qty'];
        $job = $this->where('jobid', $jobid)->first();
        $data = [
            'orderid' => $job['orderid'],
            'dqty'    => $job['dqty'],
            // 'orderno'    => $order['orderno']                
        ];
        $data['jobstart'] = date("Y-m-d H:i:s");
        if($job['jobtype'] == 'tyer')
        {
            $data['jobtype']='sampler';
        }else if($job['jobtype'] == 'sampler')
        {
            $data['jobtype']='qc1';
        }else if($job['jobtype'] == 'qc1')
        {
            $data['jobtype']='qc2';
        }else if($job['jobtype'] == 'qc2')
        {
            $data['jobtype']='packaging';
        }

        return $this->insert($data);

    }
}
