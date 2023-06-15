<?php

namespace App\Models;

use CodeIgniter\Model;

class FlyModel extends Model
{
    protected $table = 'fly';
    // protected $primaryKey = 'fly_code';
    protected $allowedFields = ['fly_code','flyname','description','bpcost','spcost','notes','barcode'];


    public function getFlies($id = null)
    {
        if (!$id){
            return $this->findAll();
        }
        if(is_array($id)){
            $fly =array();
        foreach ($id as $flycode){
            $rs = $this->where(['fly_code'=>$flycode])->findAll();
            array_push($fly, $rs);
        }
        return $fly;
        }
    
        return $this->find($id);
    }
    public function getDescription($id)
    {
        if(is_array($id)){
            $fly =array();
        foreach ($id as $flycode){
            $rs = $this->select('description')->where(['fly_code'=>$flycode])->findAll();
            array_push($fly, $rs);
        }
        $fly = array_map(function($item) {
            return $item[0]['description'];
        }, $fly);
        
        return $fly;
        }
        return $this->where('description',array('fly_code'=>$id),1)->first();
    }

    public function addFly($flyData)
    {
        $data = [
            'fly_code'    => $flyData['flycode'],
            'flyname' => $flyData['flyname'],
            'description'=> $flyData['flydescription'],
            'barcode'    => $flyData['barcode'],
            'bpcost'    => $flyData['bpcost'],
            'spcost'    => $flyData['spcost'],
            'notes'    => $flyData['notes'],
            'hook'    => $flyData['hook']
        ];

        return $this->insert($data);
    }

    public function totalFlyCount():int
    {
        return $this->countAllResults();
    }
    public function getFlyCodes()
    {
        return $this->select('fly_code')->findAll();
    }
    public function deleteFly($flycode)
    {
        return $this->where('fly_code',$flycode)->delete();
    }
    public function getSize($id)
    {
        if(is_array($id)){
            $fly =array();
        foreach ($id as $flycode){
            $rs = $this->select('size')->where(['fly_code'=>$flycode])->findAll();
            array_push($fly, $rs);
        }
        $fly = array_map(function($item) {
            return $item[0]['size'];
        }, $fly);
        
        return $fly;
        }
        return $this->where('description',array('fly_code'=>$id),1)->first();
    }
    public function getFly($data)
    {
        $i = $this->where(['fly_code'=> $data])->first();
        var_dump($i);

        return $i;
    }
}

// class UserModel extends Model
// {
//     protected $table      = 'users';
//     protected $primaryKey = 'userid';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    // protected $allowedFields = ['username', 'password'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
// }