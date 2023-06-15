<?php

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\CustomersModel;
use App\Models\FlyModel;
use App\Models\JobsModel;
use PhpParser\Node\Scalar\MagicConst\Method;



class Users extends BaseController
{
    public function users($userid = null){
        $data['meta_title'] = 'users';
        $data['userid']=1;
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');
        if(!$userid){
            $data['userid']=0;
        }
        $model = model(UsersModel::class);
        $data['users'] = $model->getUsers($userid);
        $userid =array();
        foreach($data['users'] as $user)
        {
            array_push($userid,$user['userid']);
        }
        $staffmodel = model(StaffModel::class);

        $data['staff'] = $staffmodel->getStaffByUserid($userid);
        
        return view('lists/users',$data);

    }
    public function customers($customerid = null){
        $data['meta_title'] = 'users';
        $data['customerid']=1;
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');
        if(!$customerid){
            $data['customerid']=0;
        }
        $model = model(UsersModel::class);
        $data['users'] = $model->getUsers($customerid);
        $userid =array();
        foreach($data['users'] as $user)
        {
            array_push($userid,$user['userid']);
        }
        $customersmodel = model(CustomersModel::class);

        $data['customer'] = $customersmodel->getCustomersByUserid($userid);
        return view('lists/customers',$data);

    }
}