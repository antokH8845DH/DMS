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
        // $this->load->model('uploads');
    }
    public function index()
    {
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $array = ['validasi' => 'N', 'active' => 'Y'];
        $jmlcek = count($cekMingguanModel->where($array)->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where($array)->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);
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
                if ($vehicleModel) {
                    $this->session->setFlashdata('success', 'data telah tersimpan');
                }
                $cekMingguanModel = new \App\Models\CekMingguanModel();
                $array = ['validasi' => 'N', 'active' => 'Y'];
                $jmlcek = count($cekMingguanModel->where($array)->findAll());
                $MaintenanceModel = new \App\Models\MaintenanceModel();
                $jmlmaint = count($MaintenanceModel->where($array)->findAll());
                $counts = $jmlcek + $jmlmaint;
                $sessData = ['counts' => $counts];
                $this->session->set($sessData);
                $segment = ['vehicle', 'index'];
                return redirect()->to(site_url($segment));
            } else {
                $this->session->setFlashdata('errors', $errors);
            }
            $segment = ['vehicle', 'index'];
            return redirect()->to(site_url($segment));
        }
    }
    public function editVehicle()
    {
        $id_mobil = $this->request->uri->getSegment(3);
        $data = $this->request->getPost();
        if ($data) {
            $this->validation->run($data, 'mobil');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                $vehicleModel = new \App\Models\VehicleModel();
                $vehicleModel->where('id', $id_mobil)->first();
                $mobil = new \App\Entities\Vehicle();
                $mobil->id = $id_mobil;
                $mobil->fill($data);
                $mobil->updated_by = $this->session->get('id');
                $mobil->updated_date = date('Y-m-d H:i:s');
                // print_r($id_mobil);
                // print_r($mobil);
                // exit;
                $vehicleModel->save($mobil);
                if ($vehicleModel) {
                    $this->session->setFlashdata('success', 'data telah diupdate');
                }
                $segment = ['vehicle', 'index'];
                return redirect()->to(site_url($segment));
            }
            $this->session->setFlashdata('errors', $errors);
        }
        $segment = ['vehicle', 'index'];
        return redirect()->to(site_url($segment));
    }

    public function delVehicle()
    {
        $id_mobil = $this->request->uri->getSegment(3);
        $vehicleModel = new \App\Models\VehicleModel();
        $vehicleModel->where('id', $id_mobil)->first();
        $mobil = new \App\Entities\Vehicle();
        $mobil->id = $id_mobil;
        $mobil->updated_by = $this->session->get('id');
        $mobil->updated_date = date('Y-m-d H:i:s');
        $mobil->active = 'N';
        $vehicleModel->save($mobil);
        $segment = ['vehicle', 'index'];
        return redirect()->to(site_url($segment));
    }
    public function rutin()
    {
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $jmlcek = count($cekMingguanModel->where('validasi', 'N')->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where('validasi', 'N')->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);
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
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $jmlcek = count($cekMingguanModel->findAll());
        // $jmlcek = count($cekMingguanModel->where('validasi', 'N')->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where('validasi', 'N')->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);
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
        $array = [
            'cekmingguan.id_mobil' => $idmobil, 'cekmingguan.maint_created_date >' => $date, 'cekmingguan.active' => 'Y',

        ];
        $activity =  $cekMingguan->join('user', 'user.id=cekmingguan.id_user')
            ->where($array)->findAll();

        $maintenance = new \App\Models\MaintenanceModel();
        $array22 = [
            'maintenance.id_mobil' => $idmobil, 'maintenance.tanggal >' => $date, 'maintenance.active' => 'Y',
            'maintenance.status' => '1',
        ];
        $maintenances = $maintenance->join('user', 'user.id=maintenance.id_user')
            ->where($array22)->findAll();
        $trouble = new \App\Models\MaintenanceModel();
        $array23 = [
            'maintenance.id_mobil' => $idmobil, 'maintenance.tanggal >' => $date, 'maintenance.active' => 'Y',
            'maintenance.status' => '2',
        ];
        $troubles = $trouble->join('user', 'user.id=maintenance.id_user')
            ->where($array23)->findAll();

        $data = [
            'mobils' => $mobil,
            'activities' => $activity,
            'maintenances' => $maintenances,
            'troubles' => $troubles,
        ];
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $array = ['validasi' => 'N', 'active' => 'Y'];
        $jmlcek = count($cekMingguanModel->where($array)->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where($array)->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);

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
                $cekMingguanModel = new \App\Models\CekMingguanModel();
                $array = ['active' => 'Y'];
                $jmlcek = count($cekMingguanModel->where($array)->findAll());
                $MaintenanceModel = new \App\Models\MaintenanceModel();
                $jmlmaint = count($MaintenanceModel->where($array)->findAll());
                $counts = $jmlcek + $jmlmaint;
                $sessData = ['counts' => $counts];
                $this->session->set($sessData);
                $id = $this->request->getPost('id_mobil');
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
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $maintenance = $MaintenanceModel->orderBy('id_maint', 'DESC')->first();
        $m = new \App\Entities\Maintenance();
        if ($maintenance) {
            $no = $maintenance->no_form;
        } else {
            $no = 0;
        }
        if ($no >= 1) {
            $no_form = $no + 1;
        } else {
            $no_form = 1;
        }

        $data = [
            'mobils' => $mobil,
            'no_form' => $no_form,
        ];
        return view('maintenance', $data);
    }
    public function detailtrouble()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $id = $this->request->uri->getSegment(3);
        $mobil = $vehicleModel->find($id);
        $user = new \App\Models\UserModel();
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $maintenance = $MaintenanceModel->orderBy('id_maint', 'DESC')->first();
        $m = new \App\Entities\Maintenance();
        // print_r($maintenance);
        // exit;
        $no = $maintenance->no_form;
        if ($no >= 1) {
            $no_form = $no + 1;
        } else {
            $no_form = 1;
        }

        $data = [
            'mobils' => $mobil,
            'no_form' => $no_form,
        ];
        return view('trouble', $data);
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
        $id = $this->request->getPost('id_mobil');
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
                $cekMingguanModel = new \App\Models\CekMingguanModel();
                $array = ['validasi' => 'N', 'active' => 'Y'];
                $jmlcek = count($cekMingguanModel->where($array)->findAll());
                $MaintenanceModel = new \App\Models\MaintenanceModel();
                $jmlmaint = count($MaintenanceModel->where($array)->findAll());
                $counts = $jmlcek + $jmlmaint;
                $sessData = ['counts' => $counts];
                $this->session->set($sessData);
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
    public function detailMaint()
    {

        $no_form = $this->request->uri->getSegment(3);
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $array = [
            'no_form' => $no_form,
            'active' => 'Y',
        ];

        $maint = $MaintenanceModel->where($array)->first();
        $idmobil = $maint->id_mobil;
        $arrayMesin = [
            'no_form' => $no_form,
            'active' => 'Y',
            'detail' => 'Mesin'
        ];
        $maintMesin = $MaintenanceModel->where($arrayMesin)->first();
        $vehicleModel = new \App\Models\VehicleModel();
        $mobil = $vehicleModel->find($idmobil);
        $arrayBody = [
            'no_form' => $no_form,
            'active' => 'Y',
            'detail' => 'Body'
        ];
        $maintBody = $MaintenanceModel->where($arrayBody)->first();
        $arrayKaki = [
            'no_form' => $no_form,
            'active' => 'Y',
            'detail' => 'Kaki-Kaki'
        ];
        $maintKaki = $MaintenanceModel->where($arrayKaki)->first();
        $arrayListrik = [
            'no_form' => $no_form,
            'active' => 'Y',
            'detail' => 'Listrik'
        ];
        $maintListrik = $MaintenanceModel->where($arrayListrik)->first();

        $UploadModel = new \App\Models\UploadModel();
        $arrayFoto = [
            'no_form' => $no_form,
            'active' => 'Y'
        ];
        $fileuploads = $UploadModel->where($arrayFoto)->findAll();


        $data = [
            'maintMesin' => $maintMesin,
            'maintBody' => $maintBody,
            'maintKaki' => $maintKaki,
            'maintListrik' => $maintListrik,
            'mobils' => $mobil,
            'maint' => $maint,
            'fileuploads' => $fileuploads,
        ];
        $status = $maint->status;
        if ($status == '1') {

            return view('editMaintenance', $data);
        } else {
            return view('editTrouble', $data);
        }
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
        // print_r($data);
        // exit;
        $no_form = $this->request->getPost('no_form');
        $UploadModel =  new \App\Models\UploadModel();
        $Upload = new \App\Entities\Upload();
        $files = $this->request->getFileMultiple('uploads');
        if ($data) {
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {
                if ($files) {
                    // $this->validation->run($files, 'image');
                    $this->validate([
                        'uploads' => 'uploaded[uploads]|is_image[uploads]'
                    ]);
                    $errors = $this->validation->getErrors();
                    foreach ($files as $file) {
                        if (!$errors) {
                            $Upload->original = $file->getName();
                            $name = $file->getRandomName();
                            $file->move('../image/upload', $name);
                            $Upload->image = $name;
                            $Upload->no_form = $no_form;
                            $UploadModel->save($Upload);
                        } else {
                            $this->session->setFlashdata('errors', $errors);
                            $segment = ['vehicle', 'detail', $id];
                            return redirect()->to(site_url($segment));
                        }
                    }
                }
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

                // print_r($Upload);
                // exit;
                if ($MaintenanceModel) {
                    $this->session->setFlashdata('success', "Data Telah di Simpan");
                }
                $cekMingguanModel = new \App\Models\CekMingguanModel();
                $array = ['validasi' => 'N', 'active' => 'Y'];
                $jmlcek = count($cekMingguanModel->where($array)->findAll());
                $MaintenanceModel = new \App\Models\MaintenanceModel();
                $jmlmaint = count($MaintenanceModel->where($array)->findAll());
                $counts = $jmlcek + $jmlmaint;
                $sessData = ['counts' => $counts];
                $this->session->set($sessData);
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
    public function editMaintenance()
    {
        $no_form = $this->request->uri->getSegment(3);
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $idmobil = $this->request->getPost('id_mobil');

        if ($this->request->getPost()) {
            $data = $this->request->getPost();

            $updated = date('Y-m-d H:i:s');
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
            $id_maint_mesin = $this->request->getPost('id_maint_mesin');
            $id_maint_body = $this->request->getPost('id_maint_body');
            $id_maint_listrik = $this->request->getPost('id_maint_listrik');
            $id_maint_kaki = $this->request->getPost('id_maint_kaki');
            $id_mobil =  $this->request->getPost('id_mobil');
            $cekMesin = $this->request->getPost('cekMesin');
            $cekBody = $this->request->getPost('cekBody');
            $cekKaki = $this->request->getPost('cekKaki');
            $cekListrik = $this->request->getPost('cekListrik');
            $iduser = $this->session->get('id');
            $this->validation->run($data, 'cekMingguan');
            $errors = $this->validation->getErrors();
            if (!$errors) {

                $UploadModel =  new \App\Models\UploadModel();
                $Upload = new \App\Entities\Upload();
                $files = $this->request->getFileMultiple('uploads');
                if ($files) {
                    // $this->validation->run($files, 'image');
                    $this->validate([
                        'uploads' => 'uploaded[uploads]|is_image[uploads]'
                    ]);
                    $errors = $this->validation->getErrors();
                    if (!$errors) {
                        $edit = new \App\Entities\Upload();
                        $UploadModel->set(['active' => 'N'])->where('no_form', $no_form)->update();
                        foreach ($files as $file) {
                            $Upload->original = $file->getName();
                            $name = $file->getRandomName();
                            $file->move('../image/upload', $name);
                            $Upload->image = $name;
                            $Upload->no_form = $no_form;
                            $UploadModel->save($Upload);
                        }
                    } else {
                        $this->session->setFlashdata('errors', $errors);
                        $segment = ['vehicle', 'detail', $idmobil];
                        return redirect()->to(site_url($segment));
                    }
                }
                $mesin = new \App\Entities\Maintenance();
                $body = new \App\Entities\Maintenance();
                $kaki = new \App\Entities\Maintenance();
                $listrik = new \App\Entities\Maintenance();
                if ($cekMesin == '0' and $problem_mesin <> '') {
                    $mesin->fill($data);
                    $mesin->problem = $problem_mesin;
                    $mesin->action = $action_mesin;
                    $mesin->detail = $detail_mesin;
                    $mesin->maintenance_created_date = $updated;
                    $mesin->maintenance_updated_by = $iduser;
                    $MaintenanceModel->save($mesin);
                } else if ($cekMesin == '1' and $problem_mesin <> '') {
                    $mesin->id_maint = $id_maint_mesin;
                    $mesin->fill($data);
                    $mesin->problem = $problem_mesin;
                    $mesin->action = $action_mesin;
                    $mesin->detail = $detail_mesin;
                    $mesin->maintenance_updated_date = $updated;
                    $mesin->maintenance_updated_by =  $iduser;
                    $MaintenanceModel->save($mesin);
                }
                if ($cekBody == '0' and $problem_body <> '') {
                    $body->fill($data);
                    $body->problem = $problem_body;
                    $body->action = $action_body;
                    $body->detail = $detail_body;
                    $body->maintenance_created_date = $updated;
                    $body->maintenance_updated_by = $iduser;
                    $MaintenanceModel->save($body);
                } else if ($cekBody == '1' and $problem_body <> '') {
                    $body->id_maint = $id_maint_body;
                    $body->fill($data);
                    $body->problem = $problem_body;
                    $body->action = $action_body;
                    $body->detail = $detail_body;
                    $body->maintenance_updated_date = $updated;
                    $body->maintenance_updated_by =  $iduser;
                    $MaintenanceModel->save($body);
                }
                if ($cekListrik == '0' and $problem_listrik <> '') {
                    $listrik->fill($data);
                    $listrik->problem = $problem_listrik;
                    $listrik->action = $action_listrik;
                    $listrik->detail = $detail_listrik;
                    $listrik->maintenance_created_date = $updated;
                    $listrik->maintenance_updated_by = $iduser;
                    $MaintenanceModel->save($listrik);
                } else if ($cekListrik == '1' and $problem_listrik <> '') {
                    $listrik->id_maint = $id_maint_listrik;
                    $listrik->fill($data);
                    $listrik->problem = $problem_listrik;
                    $listrik->action = $action_listrik;
                    $listrik->detail = $detail_listrik;
                    $listrik->maintenance_updated_date = $updated;
                    $listrik->maintenance_updated_by =  $iduser;
                    $MaintenanceModel->save($listrik);
                }
                if ($cekKaki == '0' and $problem_kaki <> '') {
                    $kaki->fill($data);
                    $kaki->problem = $problem_kaki;
                    $kaki->action = $action_kaki;
                    $kaki->detail = $detail_kaki;
                    $kaki->maintenance_created_date = $updated;
                    $kaki->maintenance_updated_by = $iduser;
                    $MaintenanceModel->save($kaki);
                } else if ($cekKaki == '1' and $problem_kaki <> '') {
                    $kaki->id_maint = $id_maint_kaki;
                    $kaki->fill($data);
                    $kaki->problem = $problem_kaki;
                    $kaki->action = $action_kaki;
                    $kaki->detail = $detail_kaki;
                    $kaki->maintenance_updated_date = $updated;
                    $kaki->maintenance_updated_by =  $iduser;
                    $MaintenanceModel->save($kaki);
                }
                if ($MaintenanceModel) {
                    $this->session->setFlashdata('success', "Data Telah di Update");
                }
                $cekMingguanModel = new \App\Models\CekMingguanModel();
                $array = ['validasi' => 'N', 'active' => 'Y'];
                $jmlcek = count($cekMingguanModel->where($array)->findAll());
                $MaintenanceModel = new \App\Models\MaintenanceModel();
                $jmlmaint = count($MaintenanceModel->where($array)->findAll());
                $counts = $jmlcek + $jmlmaint;
                $sessData = ['counts' => $counts];
                $this->session->set($sessData);
                $segment = ['vehicle', 'detail', $id_mobil];
                return redirect()->to(site_url($segment));
            }
            $this->session->setFlashdata('errors', $errors);
        }
        $segment = ['vehicle', 'detail', $id_mobil];
        return redirect()->to(site_url($segment));
    }

    public function delMaint()
    {
        $id_maint = $this->request->uri->getSegment(3);
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $detail = $MaintenanceModel->find($id_maint);
        $maintenance = new \App\Entities\Maintenance();
        $id_mobil = $detail->id_mobil;
        $maintenance->id_maint = $id_maint;
        $maintenance->active = 'N';
        // print_r($maintenance);
        // exit;
        $MaintenanceModel->save($maintenance);
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $array = ['validasi' => 'N', 'active' => 'Y'];
        $jmlcek = count($cekMingguanModel->where($array)->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where($array)->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);
        $segment = ['vehicle', 'detail', $id_mobil];
        return redirect()->to(site_url($segment));
    }
}
