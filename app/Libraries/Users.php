<?php

namespace App\Libraries;

class Users{
    public function userlist($userid){
        return view('lists/users', $userid);
    }
}