<?php

namespace App\Controllers;
// use CodeIgniter\Exceptions\P ageNotFoundException;
// use App\Controllers\Admin\Dashboard as AdminDash;
use App\Models\CustomersModel;
use App\Models\StaffModel;
use App\Models\UsersModel;

class Accounts extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
    }
    public function admin($page = 'dashboard')
    {
        // if (! is_file(APPPATH . 'Views/' . $page . '.php')) {
        //     // Whoops, we don't have a page for that!
        //     throw new PageNotFoundException($page);
        // }

        $data['meta_title'] = ucfirst($page); // Capitalize the first letter

        return view('pages/' . $page, $data);
    }

    public function login()
    {
        if (session()->has('userid')) {
            return redirect()->to(base_url());
        }

        $data = [
            'meta_title' => 'Login',
            'title' => 'Login',
            'success' => 0,
            'name' => 0];

        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UsersModel();
            $user = $userModel->login($username, $password);

            if ($user) {
                $id = $user->userid;
                session()->set('userid', $id);
                session()->set('name', $user->name);
                session()->set('type', $user->type);
                if($user->type == 'staff')
                {
                    $staffmodel =  new StaffModel();
                    $staffid = $staffmodel->getStaffid($id);
                    session()->set('staffid', $staffid);
                }
                return redirect()->to(base_url());
            } else {
                $data['success'] = 1;
            }
        }

        return view('accounts/login', $data);
    }

    public function logout()
    {
        // Remove the user's session data
        session()->destroy();
        // Redirect to the login page
        return redirect()->to(base_url('/login'));
    }
    public function register(){
        $data = [
            'meta_title' => 'New user',
            'title' => 'Create New user',
            'success' => 0
        ];
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');

        if($this->request->getMethod() == 'post'){
            $model = new UsersModel();
            $userid = $model->addUser($_POST);
            
            if($userid){
                if($_POST['type'] == 'customer')
                {
                $model = new CustomersModel();
                $model->addCustomer($userid);
                }else if($_POST['type'] == 'user')
                {
                    $staffid=$_POST['staffid'];
                    $stafftype=$_POST['stafftype'];
                    $model = new StaffModel();
                    $model->addStaff($userid,$staffid,$stafftype);
                }
                $data['success'] = 2;
            }else{
                $data['success'] = 1;
            }
        }
        return view('accounts/signup',$data);
    }
    public function signup(){
        $data = [
            'meta_title' => 'New user',
            'title' => 'Create New user',
            'success' => 0
        ];
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');

        if($this->request->getMethod() == 'post'){
            $model = new UsersModel();
            $userid = $model->addUser($_POST);
            
            if($userid){
                if($_POST['type'] == 'customer')
                {
                $model = new CustomersModel();
                $model->addCustomer($userid);
                }else if($_POST['type'] == 'user')
                {
                    $staffid=$_POST['staffid'];
                    $stafftype=$_POST['stafftype'];
                    $model = new StaffModel();
                    $model->addStaff($userid,$staffid,$stafftype);
                }
                $data['success'] = 2;
            }else{
                $data['success'] = 1;
            }
        }
        return view('accounts/signup2',$data);
    }
    public function profile()
    {
        $data = [
            'meta_title' => 'Profile',
            'title' => 'Profile',
            'success' => 0
        ];
        $data['name'] = session()->get('name');
        $data['type'] = session()->get('type');
        $id = session()->get('userid');
        $model = new UsersModel();
        $users = $model->getUsers($id)[0];
        // $data['user']['email'] = isset($users['email']) ? $users['email'] : '';
        $data['user']['email'] = $users['email'];
        $data['user']['name'] = $users['name'];

        if ($this->request->getMethod() == 'post') {
            $username = session()->get('name');
            $password = $this->request->getPost('password');

            $newpassword = $this->request->getPost('newpassword');
            $repassword = $this->request->getPost('renewpassword');
            if($newpassword != $repassword){
                $data['error'] = "Passwords do not match";
            }else{

            $userModel = new UsersModel();
            $user = $userModel->login($username, $password);

            if(!$user){
                $data['error'] = "Wrong original password";
            }else{
                $reset=$userModel->resetPassword($id,$newpassword);
                if($reset){$data['success']=1;}
            }

        }

           
        }

        return view('accounts/profile', $data);
    }

    public function mailtest()
    {
        $email='edwinkuria0@gmail.com';
        $username='ed';
        $generatedpass = 'rga';
        $subject = "Welcome to our site";
            $message = "Hello " . $username . ",\n\nRegistration Successful.\n\n New password is \"" . $generatedpass ."\" \n";
            $mail = \Config\Services::email();
            $mail->setFrom('fgi@flies-galore.com','Accounts');
            $mail->setTo($email)->setReplyTo('no-reply@flies-galore.com');
            $mail->setSubject($subject)->setMessage($message);
            $mail->send();

            var_dump($mail->printDebugger($include = ['headers', 'subject', 'body']));
    }
}
