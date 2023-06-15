<?php

namespace App\Controllers;

use App\Models\FlyModel;
use App\Models\UsersModel;
use App\Models\OrdersModel;

class Fly extends BaseController
{
    //Add fly form
    public function addfly()
    {
        $data = [
            'meta_title' => 'New Fly',
            'title' => 'Add new Fly',
            'success' => 0
        ];

        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');

        if($this->request->getMethod() == 'post'){
            $model = new FlyModel();
            $status = $model->addFly($_POST);
            if($status){
                $data['success'] = 2;
            }else{
                $data['success'] = 1;
            }
        }

        return view('forms/fly',$data);
    }
    public function getfly()
    {
        $flymodel = model(FlyModel::class);
        if(isset($_POST["flycode"])){
            $flycode = $_POST["flycode"];
            $fly = $flymodel->getFly($flycode);

                $response = array(
                    "flyname" => $fly['flyname'],
                    "flydescription" => $fly["description"],
                    "barcode" => $fly["barcode"],
                    "size" => $fly["size"]
                );
            
        
            return json_encode($response);
        }
    }
    public function flylist($id = null)
    {
        $flymodel = model(FlyModel::class);
        $data['meta_title'] = 'Fly list';
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');
        
        if (!$id){
            $data['fly'] = $flymodel->getFlies();
            $data['id'] = 1;
            return view('lists/fly',$data);
        }
        else{
            $data['id'] = 0;
            $data['fly'] = $flymodel->getFlies($id);
            return view('lists/fly',$data);
        }
        
    }




}