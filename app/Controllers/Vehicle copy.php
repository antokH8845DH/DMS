<?php

namespace App\Controllers;

use DateTime;
use App\Models\VehicleModel;

class Vehicle extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }
    public function index()
    {
        $vehicleModel =  new \App\Models\VehicleModel();
        $mobil =  $vehicleModel->where('active', 'Y')->findAll();
        $data = ['vehicles' => $mobil];
        return view('vehicle', $data);
    }

    //--------------------------------------------------------------------
    public function add()
    {
        if ($this->request->getPost()) {

            $data = $this->request->getPost();
            // $validate = $this->validation->run($data, 'mobil');
            $this->validation->run($data, 'mobil');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $vehicleModel =  new \App\Models\VehicleModel();
                $vehicle = new \App\Entities\Vehicle();
                $vehicle->fill($data);
                $vehicle->active = 'Y';
                $vehicle->created_date = Date('Y-m-d H:i:s');
                $vehicleModel->save($vehicle);
                $segment = ['vehicle', 'index'];
                return redirect()->to(site_url($segment));
            } else {
                $this->session->setFlashdata('errors', $errors);
            }
            $segment = ['vehicle', 'index'];
            return redirect()->to(site_url($segment));
        }
    }

    public function rutin()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $mobil = $vehicleModel->where('active', 'Y')->findAll();
        return view('rutin', ['mobils' => $mobil]);
    }
    public function detailRutin()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $id = $this->request->uri->getSegment(3);
        $mobil = $vehicleModel->find($id);

        $data = [
            'mobil' => $mobil,
        ];
        return view('detailRutin', ['mobils' => $mobil]);
    }
    public function detail()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $id = $this->request->uri->getSegment(3);
        $mobil = $vehicleModel->find($id);
        $user = new \App\Models\UserModel();
        $date = '(now() - interval 1 month)';

        $cekMingguan = new \App\Models\CekMingguanModel();
        $array = ['cekMingguan.id_mobil' => $id, 'cekMingguan.maint_created_date >' => $date, 'cekMingguan.active' => 'Y'];
        $activity =  $cekMingguan->join('user', 'user.id=cekMingguan.id_user', 'left')
            ->where($array)->findAll();

        $mesin = new \App\Models\MesinModel();
        $array2 = ['mesin.id_mobil' => $id, 'mesin.msn_created_date >' => $date, 'mesin.active' => 'Y', 'mesin.status' => '1'];
        $maintMesin = $mesin->join('user', 'user.id=mesin.id_user', 'right')
            ->where($array2)->findAll();

        $body = new \App\Models\BodyModel();
        $array3 = ['body.id_mobil' => $id, 'body.bdy_created_date >' => $date, 'body.active' => 'Y', 'body.status' => '1'];
        $maintbody = $body->join('user', 'user.id=body.id_user', 'left')
            ->where($array3)->findAll();
        $listrik = new \App\Models\ListrikModel();
        $array4 = ['listrik.id_mobil' => $id, 'listrik.lst_created_date >' => $date, 'listrik.active' => 'Y', 'listrik.status' => '1'];
        $maintlistrik = $listrik->join('user', 'user.id=listrik.id_user', 'left')
            ->where($array4)->findAll();
        $kaki = new \App\Models\KakiModel();
        $array5 = ['kaki.id_mobil' => $id, 'kaki.kk_created_date >' => $date, 'kaki.active' => 'Y', 'kaki.status' => '1'];
        $maintkaki = $kaki->join('user', 'user.id=kaki.id_user', 'left')
            ->where($array5)->findAll();
        // sort trouble
        $array6 = ['mesin.id_mobil' => $id, 'mesin.msn_created_date >' => $date, 'mesin.active' => 'Y', 'mesin.status' => '2'];
        $troubleMesin = $mesin->join('user', 'user.id=mesin.id_user', 'right')
            ->where($array6)->findAll();
        $array7 = ['body.id_mobil' => $id, 'body.bdy_created_date >' => $date, 'body.active' => 'Y', 'body.status' => '2'];
        $troublebody = $body->join('user', 'user.id=body.id_user', 'left')
            ->where($array7)->findAll();
        $array8 = ['listrik.id_mobil' => $id, 'listrik.lst_created_date >' => $date, 'listrik.active' => 'Y', 'body.status' => '2'];
        $troublelistrik = $listrik->join('user', 'user.id=listrik.id_user', 'left')
            ->where($array8)->findAll();
        $array9 = ['kaki.id_mobil' => $id, 'kaki.kk_created_date >' => $date, 'kaki.active' => 'Y', 'body.status' => '2'];
        $troublekaki = $kaki->join('user', 'user.id=kaki.id_user', 'left')
            ->where($array9)->findAll();
        $data = [
            'mobils' => $mobil,
            'activities' => $activity,
            'mesins' => $maintMesin,
            'bodies' => $maintbody,
            'listriks' => $maintlistrik,
            'kakis' => $maintkaki,
            'tmesins' => $troubleMesin,
            'tbodies' => $troublebody,
            'tlistriks' => $troublelistrik,
            'kakis' => $troublekaki,
        ];

        // print_r($activity);
        // exit;
        return view('detail', $data);
    }
    public function addCheck()
    {
        $data = $this->request->getPost();
        $id = $this->request->getPost('id_mobil');
        // $id = $this->request->uri->getSegment(3);
        // print_r($data);
        // print_r($id);
        // exit;
        if ($data) {
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $cekMingguanModel = new \App\Models\CekMingguanModel();
                $idUser = $this->session->get('id');
                $cek = new \App\Entities\cekMingguan();
                $cek->fill($data);
                $cek->created_date = Date('Y-m-d H:i:s');
                $cek->active = 'Y';
                $cek->created_by = $idUser;
                $cek->id_user = $idUser;
                $cekMingguanModel->save($cek);
                $id = $this->request->getPost('id_mobil');
                $notif = 'Data Telah Tersimpan';
                $this->session->setFlashdata('ok', $notif);
                // $this->session->keep_flashdata('ok', $notif);
                $segment = ['vehicle', 'detail', $id];
                return redirect()->to(site_url($segment));
            } else {
                $this->session->setFlashdata('errors', $errors);
            }
        }
        $segment = ['vehicle', 'detailRutin', $id];
        return redirect()->to(site_url($segment));
    }
    public function detailMaintenance()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $id = $this->request->uri->getSegment(3);
        $mobil = $vehicleModel->find($id);
        $user = new \App\Models\UserModel();
        $data = [
            'mobils' => $mobil,
        ];
        return view('maintenance', $data);
    }
    public function detailtrouble()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $id = $this->request->uri->getSegment(3);
        $mobil = $vehicleModel->find($id);
        $user = new \App\Models\UserModel();
        $data = [
            'mobils' => $mobil,
        ];
        return view('trouble', $data);
    }
    public function addMaintenance()
    {
        $id_user = $this->session->get('id');
        $id = $this->request->getPost('id_mobil');
        $data = $this->request->getPost();
        if ($data) {
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $MesinModel = new \App\Models\MesinModel();
                $BodyModel =  new \App\Models\BodyModel();
                $ListrikModel = new \App\Models\ListrikModel();
                $KakiModel = new \App\Models\KakiModel();
                $mesin = new \App\Entities\Mesin();
                $body = new \App\Entities\Body();
                $kaki = new \App\Entities\Kaki();
                $listrik = new \App\Entities\Listrik();
                $created = date('Y-m-d H:i:s');
                if ($this->request->getPost('problem_mesin') <> "") {
                    $mesin->fill($data);
                    $mesin->msn_created_date = $created;
                    $mesin->msn_created_by =  $id_user;
                    $MesinModel->save($mesin);
                    // print_r($mesin) . '<br>';
                }
                if ($this->request->getPost('problem_body') <> "") {
                    $body->fill($data);
                    $body->bdy_created_date = $created;
                    $body->bdy_created_by =  $id_user;
                    $BodyModel->save($body);
                    // print_r($body) . '<br>';
                }
                if ($this->request->getPost('problem_listrik') <> "") {
                    $listrik->fill($data);
                    $listrik->lst_created_date = $created;
                    $listrik->lst_created_by =  $id_user;
                    $ListrikModel->save($listrik);
                    // print_r($listrik) . '<br>';
                }
                if ($this->request->getPost('problem_kaki') <> "") {
                    $kaki->fill($data);
                    $kaki->kk_created_date = $created;
                    $kaki->kk_created_by =  $id_user;
                    $KakiModel->save($kaki);
                    // print_r($kaki) . '<br>';
                }
                $segment = ['vehicle', 'detail', $id];
                // print_r($id);
                // exit;
                return redirect()->to(site_url($segment));
            }
            $this->session->setFlashdata('errors', $errors);
        }
        $segment = ['vehicle', 'detail', $id];
        return redirect()->to(site_url($segment));
        // print_r($data) . '<br>';
        // print_r($errors);
        // print_r($id_user);
        // exit;
    }
    public function addTrouble()
    {
        $id_user = $this->session->get('id');
        $id = $this->request->getPost('id_mobil');
        $data = $this->request->getPost();
        if ($data) {
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $MesinModel = new \App\Models\MesinModel();
                $BodyModel =  new \App\Models\BodyModel();
                $ListrikModel = new \App\Models\ListrikModel();
                $KakiModel = new \App\Models\KakiModel();
                $mesin = new \App\Entities\Mesin();
                $body = new \App\Entities\Body();
                $kaki = new \App\Entities\Kaki();
                $listrik = new \App\Entities\Listrik();
                $created = date('Y-m-d H:i:s');
                if ($this->request->getPost('problem_mesin') <> "") {
                    $mesin->fill($data);
                    $mesin->msn_created_date = $created;
                    $mesin->msn_created_by =  $id_user;
                    $MesinModel->save($mesin);
                    // print_r($mesin) . '<br>';
                }
                if ($this->request->getPost('problem_body') <> "") {
                    $body->fill($data);
                    $body->bdy_created_date = $created;
                    $body->bdy_created_by =  $id_user;
                    $BodyModel->save($body);
                    // print_r($body) . '<br>';
                }
                if ($this->request->getPost('problem_listrik') <> "") {
                    $listrik->fill($data);
                    $listrik->lst_created_date = $created;
                    $listrik->lst_created_by =  $id_user;
                    $ListrikModel->save($listrik);
                    // print_r($listrik) . '<br>';
                }
                if ($this->request->getPost('problem_kaki') <> "") {
                    $kaki->fill($data);
                    $kaki->kk_created_date = $created;
                    $kaki->kk_created_by =  $id_user;
                    $KakiModel->save($kaki);
                    // print_r($kaki) . '<br>';
                }
                $segment = ['vehicle', 'detail', $id];
                // print_r($id);
                // exit;
                return redirect()->to(site_url($segment));
            }
            $this->session->setFlashdata('errors', $errors);
        }
        $segment = ['vehicle', 'detail', $id];
        return redirect()->to(site_url($segment));
        // print_r($data) . '<br>';
        // print_r($errors);
        // print_r($id_user);
        // exit;
    }
}
