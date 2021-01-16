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
                        'avatar' => $user->avatar,
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
    public function gantiPassword()
    {

        $data = $this->request->getPost();
        if ($data) {
            $this->validation->run($data, 'updatePassword');
            $errors = $this->validation->getErrors();
            $id = $this->session->get('id');
            $oldPassword = $this->request->getPost('oldPassword');
            if (!$errors) {
                $UserModel = new \App\Models\UserModel();
                $User = $UserModel->where('id', $id)->First();
                $salt = $User->salt;
                // printf($salt);
                if ($User->password !== md5($salt . $oldPassword)) {
                    $this->session->setFlashdata('errors', ['Password Lama Tidak Sama']);
                    return redirect()->to(base_url('home/user'));
                } else {
                    $user = new \App\Entities\User();
                    $user->fill($data);
                    $user->id = $id;
                    $user->password = $this->request->getPost('newPassword');
                    $user->updated_date = date('Y-m-d H:i:s');
                    $user->updated_by = $id;
                    $UserModel->save($user);
                    return redirect()->to(site_url('auth/logout'));
                }
            }
            $this->session->setFlashdata('errors', $errors);
            return redirect()->to(base_url('home/user'));
        }
    }
    public function gantiProfile()
    {
        $data = $this->request->getPost();
        $id = $this->request->uri->getSegment(3);
        $UserModel = new \App\Models\UserModel();
        $UserModel->find($id);
        if ($data) {
            $this->validation->run($data, 'gantiProfile');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $userUpdate = new \App\Entities\User();
                $userUpdate->id = $id;
                $userUpdate->fill($data);
                if ($this->request->getFile('profile')->isValid()) {

                    $userUpdate->profile = $this->request->getFile('profile');
                }
                $userUpdate->updated_date = date('Y-m-d H:i:s');
                $userUpdate->updated_by = $id;
                $UserModel->save($userUpdate);
                $user = $UserModel->find($id);
                $sessData = [
                    'username' => $user->username,
                    'name' => $user->name,
                    'id' => $user->id,
                    'avatar' => $user->avatar,
                    'role' => $user->role,
                    'isLoggedIn' => true,
                ];
                $this->session->set($sessData);

                if ($UserModel) {
                    $this->session->setFlashdata('success', "Data Telah di Simpan");
                }
                return redirect()->to(base_url('home/user/' . $id));
            }
            $this->session->setFlashdata('errors', $errors);
            return redirect()->to(base_url('home/user/' . $id));
        }
        return view('home/user/' . $id);
    }
}
