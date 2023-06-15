<?php

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\CustomersModel;
use App\Models\FlyModel;
use App\Models\JobsModel;
use PhpParser\Node\Scalar\MagicConst\Method;



class Delete extends BaseController
{
    public function DeleteUser($id)
    {
        $usersmodel = model(UsersModel::class);
        $customersmodel = model(CustomersModel::class);
        $staffmodel = model(StaffModel::class);
        $type = $usersmodel->getUserType($id);
        if($type == 'user')
        {
            $staffmodel->deleteStaff($id);
        }else if($type == 'customer')
        {
            $customersmodel->deleteCustomer($id);
        }
        $usersmodel->deleteUser($id);
        
        return redirect()->to(base_url('/users'));
    }
}