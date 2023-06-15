<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'orderid:int';
    protected $debug = true;
    protected $allowedFields = ['fly_code','customerid', 'orderstart','orderend','qty','size','orderno'];

    public function getOrders($orderids = null)
    {
        if (!$orderids) {
            return $this->findAll();
        }
    
        if (is_array($orderids)) {
            $orders = $this->whereIn('orderid', $orderids)->findAll();
            if (count($orders) !== count($orderids)) {
                return ['error' => 'One or more order IDs do not exist.']; 
            }
            return $orders;
        }
    
        $order = $this->where('orderid', $orderids)->first();
        if (!$order) {
            return ['error' => 'Order ID does not exist.'];
        }
        return [$order];
    }
    
    
    public function getCustomerid($orderid)
    {
        if(is_array($orderid))
        {
            return $this->select('customerid')->whereIn('orderid',$orderid)->get()->getResultArray() ;
        }
        return $this->select('customerid')->where(['orderid' => $orderid])->get()->getResultArray();
    }

    public function getCustomeridByNo($orderno)
    {
        return $this->select('customerid')->where('orderno', $orderno)->get()->getRow('customerid', 'int');
    }
    public function getFlycode($orderid)
    {
        
        if (is_array($orderid)) {
            $flycodes = array();
            foreach($orderid as $id){
                $flycode = $this->select('fly_code')->where('orderid',$id)->first();
                array_push($flycodes,$flycode);
            }
            return $flycodes;
        }
        return $this->where('fly_code',array('orderid'=>$orderid),1)->first();
    }
    public function getSize($orderid)
    {
        if (is_array($orderid)) {
            return $this->select('size')->where(array('orderid'=>$orderid,1))->get()->getResultArray();
        }
        else{
            return $this->select('size')->where('orderid',$orderid)->get()->getResultArray();
        }
    }
    public function getQty($orderid)
    {
        if (is_array($orderid)) {
            return $this->select('qty')->where(array('orderid'=>$orderid,1))->get()->getResultArray();
        }
        else{
            return $this->select('qty')->where('orderid',$orderid)->get()->getResultArray();
        }
    }
    public function totalOrderCount():int
    {
        return $this->countAllResults();
    }
    public function getOrdersByNumber($orderno)
    {
        return $this->where(['orderno' => $orderno])->findAll();
    }
    public function totalOrderCountByNo($order)
    {
        $orders =array();
        foreach ($order as $orderno){
            $rs = $this->where(['orderno'=>$orderno])->countAllResults();
            array_push($orders, $rs);
        }
        return $orders;
    }
    public function newOrder($order)
    {
        $data = [
            'fly_code' => $order['flycode'],
            'size' => $order['flysize'],
            'customerid'=> $order['customerid'],
            'qty'    => $order['flyquantity'],
            'orderno'    => $order['orderno'],
        ];
        $data['orderstart'] = date("Y-m-d H:i:s");

        return $this->insert($data);
    }

    public function getAmountByNo($data)
    {
        $total =array();
        foreach ($data as $orderno){
            $rs = $this->selectSum('amount')->where(['orderno'=>$orderno])->get()->getRow()->amount;
            array_push($total, $rs);
        }
        return $total;
    }
 
}