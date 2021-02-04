<?php

namespace App\Controllers;

use App\Entities\CekMingguan;

class Validasi extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }
    public function index()
    {
        $vehicleModel = new \App\Models\VehicleModel();
        $mobil = $vehicleModel->where('active', 'Y')->findAll();
        $id = $this->session->get('id');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $array = [
            'maintenance.active' => 'Y', 'maintenance.validasi' => 'N', 'maintenance.status' => '1',
        ];
        $maintenance = $MaintenanceModel->join('mobil', 'maintenance.id_mobil=mobil.id')->join('upload', 'maintenance.no_form=upload.no_form')->where($array)->groupBy('maintenance.no_form')->findAll();
        $trouble = $MaintenanceModel->join('mobil', 'maintenance.id_mobil=mobil.id')->join('upload', 'maintenance.no_form=upload.no_form')->where(['maintenance.active' => 'Y', 'maintenance.validasi' => 'N', 'maintenance.status' => '2',])->groupBy('maintenance.no_form')->findAll();

        $upload = $MaintenanceModel->join('upload', 'maintenance.no_form=upload.no_form')->where(['upload.active' => 'Y'])->findAll();

        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $cek = $cekMingguanModel->join('mobil', 'cekmingguan.id_mobil=mobil.id')->where(['cekmingguan.active' => 'Y', 'cekmingguan.validasi' => 'N'])->findAll();
        $array = ['validasi' => 'N', 'active' => 'Y'];
        $jmlcek = count($cekMingguanModel->where($array)->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where($array)->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        return view('validasi', [
            'mobils' => $mobil, 'users' => $user,
            'maintenances' => $maintenance, 'ceks' => $cek,
            'troubles' => $trouble,
            'uploads' => $upload,
        ]);
    }

    public function valCek()
    {
        $idCek = $this->request->uri->getSegment(3);
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $detailCek = $cekMingguanModel->find($idCek);
        $cek = new \App\Entities\CekMingguan();
        $id_mobil = $detailCek->id_mobil;
        $cek->idCek = $idCek;
        $cek->validasi = 'Y';
        $cekMingguanModel->save($cek);
        if ($cekMingguanModel) {
            $this->session->setFlashdata('success', "Data Telah di Validasi");
        }
        $array = ['validasi' => 'N', 'active' => 'Y'];
        $jmlcek = count($cekMingguanModel->where($array)->findAll());
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where($array)->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);
        $segment = ['validasi', 'index'];
        return redirect()->to(site_url($segment));
    }
    public function valMaint()
    {
        $idMaint = $this->request->uri->getSegment(3);
        $MaintenanceModel = new \App\Models\MaintenanceModel();
        $detailmaint = $MaintenanceModel->find($idMaint);
        $maint = new \App\Entities\Maintenance();
        $maint->id_maint = $idMaint;
        $maint->validasi = 'Y';
        $maint->validasi_date = date('Y-m-d H:i:s');
        $maint->validasi_by = $this->session->get('id');
        $MaintenanceModel->save($maint);
        if ($MaintenanceModel) {
            $this->session->setFlashdata('success', "Data Telah di Validasi");
        }
        $cekMingguanModel = new \App\Models\CekMingguanModel();
        $array = ['validasi' => 'N', 'active' => 'Y'];
        $jmlcek = count($cekMingguanModel->where($array)->findAll());
        // $MaintenanceModel = new \App\Models\MaintenanceModel();
        $jmlmaint = count($MaintenanceModel->where($array)->findAll());
        $counts = $jmlcek + $jmlmaint;
        $sessData = ['counts' => $counts];
        $this->session->set($sessData);
        $segment = ['validasi', 'index'];
        return redirect()->to(site_url($segment));
    }
    public function view()
    {
        $no_form = $this->request->uri->getSegment(3);
        // print_r($no_form);
        // exit;
        $UploadModel = new \App\Models\UploadModel();
        $upload =  $UploadModel->where(['no_form' => $no_form, 'active' => 'Y'])->findAll();
        $data = ['uploads' => $upload];
        return view('detailUpload', $data);
    }
    //--------------------------------------------------------------------
}
