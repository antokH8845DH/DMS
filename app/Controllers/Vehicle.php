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
    public function add() //menambah mobil
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
        // print_r($id);
        // exit;
        $mobil = $vehicleModel->find($id);
        $data = [
            'mobils' => $mobil,
        ];
        return view('detailRutin', $data);
    }
    public function detail()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $idmobil = $this->request->uri->getSegment(3);
        $mobil = $vehicleModel->find($idmobil);
        $user = new \App\Models\UserModel();
        $date = '(now() - interval 1 month)';

        $cekMingguan = new \App\Models\CekMingguanModel();
        $array = ['cekMingguan.id_mobil' => $idmobil, 'cekMingguan.maint_created_date >' => $date, 'cekMingguan.active' => 'Y'];
        $activity =  $cekMingguan->join('user', 'user.id=cekMingguan.id_user')
            ->where($array)->findAll();

        $maintenance = new \App\Models\MaintenanceModel();
        $array22 = ['maintenance.id_mobil' => $idmobil, 'maintenance.tanggal >' => $date, 'maintenance.active' => 'Y', 'maintenance.status' => '1'];
        $maintenances = $maintenance->join('user', 'user.id=maintenance.id_user')
            ->where($array22)->findAll();
        $trouble = new \App\Models\MaintenanceModel();
        $array23 = ['maintenance.id_mobil' => $idmobil, 'maintenance.tanggal >' => $date, 'maintenance.active' => 'Y', 'maintenance.status' => '2'];
        $troubles = $trouble->join('user', 'user.id=maintenance.id_user')
            ->where($array23)->findAll();

        $data = [
            'mobils' => $mobil,
            'activities' => $activity,
            'maintenances' => $maintenances,
            'troubles' => $troubles,
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
                $cek->maint_created_date = Date('Y-m-d H:i:s');
                $cek->active = 'Y';
                $cek->maint_created_by = $idUser;
                $cek->id_user = $idUser;
                $cekMingguanModel->save($cek);
                $id = $this->request->getPost('id_mobil');
                $notif = 'Data Telah Tersimpan';
                $segment = ['vehicle', 'detail', $id];
                if ($cekMingguanModel) {
                    $this->session->setFlashdata('success', "Data Telah di Simpan");
                }
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
        $km = $this->request->getPost('km');
        $status = $this->request->getPost('status');
        $data = $this->request->getPost();
        $MaintenanceModel =  new \App\Models\MaintenanceModel();
        $created = date('Y-m-d H:i:s');
        $problem_mesin = $this->request->getPost('problem_mesin');
        $problem_body = $this->request->getPost('problem_body');
        $problem_kaki = $this->request->getPost('problem_kaki');
        $problem_listrik = $this->request->getPost('problem_listrik');
        $action_mesin = $this->request->getPost('action_mesin');
        $action_body = $this->request->getPost('action_body');
        $action_kaki = $this->request->getPost('action_kaki');
        $action_listrik = $this->request->getPost('action_listrik');
        $detail_mesin = $this->request->getPost('detailMesin');
        $detail_body = $this->request->getPost('detailBody');
        $detail_kaki = $this->request->getPost('detailKaki');
        $detail_listrik = $this->request->getPost('detailListrik');

        if ($data) {
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {

                // print_r($data);
                // exit;

                $Maintenance = new \App\Entities\Maintenance();
                if ($problem_mesin <> "") {
                    // print_r($data);
                    // exit;
                    $Maintenance->fill($data);
                    $Maintenance->problem = $problem_mesin;
                    $Maintenance->action = $action_mesin;
                    $Maintenance->detail = $detail_mesin;
                    $Maintenance->maintenance_created_date = $created;
                    $Maintenance->maintenance_created_by =  $id_user;
                    $MaintenanceModel->save($Maintenance);
                    // print_r($mesin) . '<br>';
                }
                if ($problem_body <> "") {
                    $Maintenance->fill($data);
                    $Maintenance->problem = $problem_body;
                    $Maintenance->action = $action_body;
                    $Maintenance->detail = $detail_body;
                    $Maintenance->maintenance_created_date = $created;
                    $Maintenance->maintenance_created_by =  $id_user;
                    $MaintenanceModel->save($Maintenance);
                    // print_r($body) . '<br>';
                }
                if ($problem_listrik <> "") {
                    $Maintenance->fill($data);
                    $Maintenance->problem = $problem_listrik;
                    $Maintenance->action = $action_listrik;
                    $Maintenance->detail = $detail_listrik;
                    $Maintenance->maintenance_created_date = $created;
                    $Maintenance->maintenance_created_by =  $id_user;
                    $MaintenanceModel->save($Maintenance);
                    // print_r($listrik) . '<br>';
                }
                if ($problem_kaki <> "") {
                    $Maintenance->fill($data);
                    $Maintenance->problem = $problem_kaki;
                    $Maintenance->action = $action_kaki;
                    $Maintenance->detail = $detail_kaki;
                    $Maintenance->maintenance_created_date = $created;
                    $Maintenance->maintenance_created_by =  $id_user;
                    $MaintenanceModel->save($Maintenance);
                    // print_r($kaki) . '<br>';
                }
                if ($MaintenanceModel) {
                    $this->session->setFlashdata('success', "Data Telah di Simpan");
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

    public function detailCek()
    {
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $id = $this->request->uri->getSegment(3);
        $cek = $cekMingguanModel->find($id);
        $idmobil = $cek->id_mobil;
        $vehicleModel = new \App\Models\VehicleModel();
        $mobil = $vehicleModel->find($idmobil);
        $data = [
            'ceks' => $cek,
            'mobils' => $mobil
        ];
        return view('editDetailRutin', $data);
    }
    public function editCheck()
    {
        $idCek = $this->request->uri->getSegment(3);
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $mingguan = $cekMingguanModel->find($idCek);
        $data = $this->request->getPost();
        $idUser = $this->session->get('id');
        if ($data) {
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $cek = new \App\Entities\cekMingguan();
                $cek->idCek = $idCek;
                $cek->fill($data);
                $cek->maint_updated_date = Date('Y-m-d H:i:s');
                $cek->active = 'Y';
                $cek->maint_updated_by = $idUser;
                // $cek->id_user = $idUser;
                // print_r($cek);
                // exit;
                $cekMingguanModel->save($cek);
                $id = $this->request->getPost('id_mobil');
                $notif = 'Data Telah Tersimpan';
                $segment = ['vehicle', 'detail', $id];
                if ($cekMingguanModel) {
                    $this->session->setFlashdata('success', "Data Telah di Simpan");
                }
                return redirect()->to(site_url($segment));
            } else {
                $this->session->setFlashdata('errors', $errors);
            }
        }
        $segment = ['vehicle', 'detailRutin', $id];
        return redirect()->to(site_url($segment));
    }
}
