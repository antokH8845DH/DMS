<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function register()
    {
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'register');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $userModel = new \App\Models\UserModel();
                $user =  new \App\Entities\User();

                $user->username = $this->request->getPost('username');
                $user->name = $this->request->getPost('username');
                $user->password = $this->request->getPost('password');
                $user->active = 'Y';
                $user->created_by = 0;
                $user->created_date = date("Y-m-d H:i:s");

                $userModel->save($user);

                return view('login');

                // print_r($data);
                // exit;
            }
            $this->session->setFlashdata('errors', $errors);
        }
        return view('register');
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'login');
            $errors = $this->validation->getErrors();

            if ($errors) {
                // jika ada error kembali ke menu login
                return view('login');
            }
            // jika tidak ada error lakukan
            $userModel = new \App\Models\UserModel();
            $username =  $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = $userModel->where('username', $username)->first();
            // printf($username . ' ');
            // printf($password . ' ');
            // print_r($user);
            // print_r($data);
            // exit();
            if ($user) {
                //jika user ada lakukan
                $salt = $user->salt;
                if ($user->password  !== md5($salt . $password)) {
                    // jika user dan password tidak sama dengan yang didaftarkan
                    $this->session->setFlashdata('errors', ['Wrong Password']);
                } else {
                    // jika user dan password sama
                    $sessData = [
                        'username' => $user->username,
                        'name' => $user->name,
                        'id' => $user->id,
                        'role' => $user->role,
                        'isLoggedIn' => true,
                    ];
                    $this->session->set($sessData);
                    // print_r($sessData);
                    // exit();
                    // return view('register');
                    return redirect()->to(base_url('home/index'));
                }
            } else {
                $this->session->setFlashdata('errors', ['Username not found']);
            }
        }
        return view('login');
    }


    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('auth/login'));
    }
}
