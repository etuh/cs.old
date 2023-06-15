<?php
namespace App\Libraries;

class AlertMessage
{
    public function show($params): string
    {
        return "<p class='".$params['type']."'>".$params['message']."</p>";
    }
}