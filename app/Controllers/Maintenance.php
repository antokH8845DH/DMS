<?php

namespace App\Controllers;

class Maintenance extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
        // $this->image = \Config\Services::image('imagick');
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
}
