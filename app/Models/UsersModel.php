<?php

namespace App\Models;

use CodeIgniter\Model;
use TheSeer\Tokenizer\Exception;

class UsersModel extends Model
{
    protected $table = 'users';
    // protected $primaryKey = 'userid';
    protected $allowedFields = ['userid','username','name', 'password','type'];


    public function getUsers($userid = null)
    {
        if (!$userid){
            return $this->findAll();
        }
        return $this->where('userid',$userid)->findAll();

    }
    public function addUser($userData)
    {
        // if ($userData['pass'] !== $userData['repass']) {
        //     throw new Exception('Password confirmation does not match password');
        // }

        function randomPassword() {
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        $generatedpass = randomPassword();     
        $email = $userData['email'];
        $username = $userData['username'];   

        $password = password_hash($generatedpass, PASSWORD_DEFAULT);

        $type = $userData['type'];
        
        $existingUser = $this->getByUsername($username);
        if ($existingUser) {
            throw new Exception('Username already exists');
        }
    
        $data = [
            'name'    => $userData['name'],
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'type'    => $type
        ];

        $status = $this->insert($data);
        if ($status)
        {
            $subject = "Welcome to our site";
            $message = "Hello " . $username . ",\n\nRegistration Successful.\n\n New password is \"" . $generatedpass ."\" ";
            $mail = \Config\Services::email();
            $mail->setFrom('fgi@flies-galore.com','Accounts');
            $mail->setTo($email);
            $mail->setSubject($subject)->setMessage($message);
            $mail->send();

            // var_dump($mail->printDebugger($include = ['headers', 'subject', 'body']));
            return $this->getLastInsertId($username);
        }else
        {
            return 0;
        }
    }
    public function resetPassword($id, $pass)
    {
        $password = password_hash($pass, PASSWORD_DEFAULT);
        return $this->set('password', $password)->where('userid',$id)->update();
    }
    public function getByUsername($username)
    {
        return $this->where(['username'=>$username])->first();
    }
    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if (!$user){
            return false;
        }

        $verify = password_verify($password, $user['password']);
        if (!$verify) {
            return false;
        }

        if ($user && password_verify($password, $user['password'])) {
            return (object)$user;
        } else {
            return false;
        }
    }
    public function totalUserCount():int
    {
        return $this->countAllResults();
    }
    public function getNamebyid($userid)
    {
        if(is_array($userid))
     {
        $userNames = array();
        foreach ($userid as $id) {
            $result = $this->select('name')->where('userid', $id)->findAll();
            foreach ($result as $row) {
                array_push($userNames, $row['name']);
            }
        }
        return $userNames;
     }
        return $this->select('name')->where('userid' , $userid)->findAll();//->get()->getResultArray();
    }
    public function getLastInsertId($username)
    {
        return $this->select('userid')->where(['username' => $username])->first();
    }
    public function getUserType($id):string
    {
        $data = $this->select('type')->where('userid',$id)->first();
        return $data['type'];
    }
    public function deleteUser($id)
    {
        return $this->where('userid',$id)->delete();
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