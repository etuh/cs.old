<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\jobsModel;
use App\Models\StaffModel;
use App\Models\FlyModel;
// use App\Controllers\Admin\Dashboard as AdminDash;

class Home extends BaseController
{
    public function index($page = 'dashboard')
    {
        if ($this->forceLogin()):return $this->forceLogin();endif;
        $data['meta_title'] = ucfirst($page); // Capitalize the first letter

        $data['name'] = session()->get('name');
        $type = session()->get('type');
        $data['type'] = $type;
        $usersmodel = model(UsersModel::class);
        $ordersmodel = model(OrdersModel::class);
        if($type == 'admin')
        {
            $data['total_users'] = $usersmodel->totalUserCount();
            $data['total_orders'] = $ordersmodel->totalOrderCount();
            $data['completed_orders'] = 0;
            // @TODO complete orders = count orders where orderend
            $data['active_jobs'] = 0;
            // active_jobs = count jobs where !jobend
            $data['completed_jobs'] = 0;
            // =count jobs where jobend
            $data['jobid'] = 0;
            $jobid = 0;        
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');
            if(!$jobid){
                $data['jobid'] = 0;        
            }
        $jobsmodel = model(JobsModel::class);
        $ordersmodel = model(OrdersModel::class);
        $usersmodel = model(UsersModel::class);
        $customersmodel = model(CustomersModel::class);
        $staffmodel = model(StaffModel::class);
        $flymodel = model(FlyModel::class);

        $data['job'] = $jobsmodel->getJob($jobid);
        $rs = $jobsmodel->getOrderid($jobid);
        $orderid = array_column($rs, 'orderid');

        $flycode = $ordersmodel->getFlycode($orderid);
        $flycode = array_column($flycode, 'fly_code');
        $data['flycode'] = $flycode;

        $data['flyd'] = $flymodel->getDescription($flycode);

        $data['size']=$flymodel->getSize($flycode);

        $staffid = array();
        foreach ($data['job'] as $job)
        {
            array_push($staffid,$job['staffid']);
        }
        $data['staffid'] = $staffid;
        $userid = $staffmodel->getUserid($staffid);
        $data['user'] = $usersmodel->getNamebyid($userid);

        }else if($type == 'staff')
        {
            $jobsmodel = model(JobsModel::class);
            $usersmodel = model(UsersModel::class);
            $staffmodel = model(StaffModel::class);
            $flymodel = model(FlyModel::class);

            $staffid = session()->get('staffid');

            $data['job'] = $jobsmodel->getJobsbyStaffid($staffid);
            $jobid = array();
            foreach ($data['job'] as $job)
            {
                array_push($jobid,$job['jobid']);
            }
            $rs = $jobsmodel->getOrderid($jobid);
            $orderid = array_column($rs, 'orderid');


            $flycode = $ordersmodel->getFlycode($orderid);
            $flycode = array_column($flycode, 'fly_code');
            $data['flycode'] = $flycode;

            $data['flyd'] = $flymodel->getDescription($flycode);

            $data['size']=$flymodel->getSize($flycode);

            
            $data['staffid'] = $staffid;
            $userid = $staffmodel->getUserid($staffid);
            $data['user'] = $usersmodel->getNamebyid($userid);
        }
        

        return view('pages/' . $type, $data);
    }
    public function jobs($jobid)
    {
        if ($this->forceLogin()):return $this->forceLogin();endif;
        $id = session()->get('userid');
            
        $jobsmodel = model(JobsModel::class);
        $ordersmodel = model(OrdersModel::class);
        $usersmodel = model(UsersModel::class);
        $staffmodel = model(StaffModel::class);
        $flymodel = model(FlyModel::class);

        $staffid = session()->get('staffid');

        $data['job'] = $jobsmodel->getJobsbyStaffid($staffid);
        $rs = $jobsmodel->getOrderid($jobid);
        $orderid = array_column($rs, 'orderid');

        $flycode = $ordersmodel->getFlycode($orderid);
        $flycode = array_column($flycode, 'fly_code');
        $data['flycode'] = $flycode;

        $data['flyd'] = $flymodel->getDescription($flycode);

        $data['size']=$flymodel->getSize($flycode);

        $staffid = array();
        foreach ($data['job'] as $job)
        {
            array_push($staffid,$job['staffid']);
        }
        $data['staffid'] = $staffid;
        $userid = $staffmodel->getUserid($staffid);
        $data['user'] = $usersmodel->getNamebyid($userid);
        return view('lists/jobs',$data);
    }
    public function test(){
        return view('lists/10_file_upload/example10.html');
    }
}
