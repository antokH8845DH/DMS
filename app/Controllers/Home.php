<?php

namespace App\Controllers;

class Home extends BaseController
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
		return view('dmshome', ['mobils' => $mobil, 'users' => $user]);
	}

	//--------------------------------------------------------------------
	public function user()
	{
		$id = $this->request->uri->getSegment(3);
		$userModel = new \App\Models\UserModel();
		$user = $userModel->find($id);
		// print_r($user);
		// exit;
		$array = ['users' => $user,];
		return view('user', $array);
	}
	public function upload()
	{
		return view('uploads');
	}
	public function image()
	{

		$files = $this->request->getFileMultiple('upload');
		$UploadModel =  new \App\Models\UploadModel();
		$Upload = new \App\Entities\Upload();
		// print_r($files);
		if ($files) {
			// $uploads = \Config\Services::image('imagick');
			foreach ($files as $file) {
				$name = $file->getRandomName();
				// $file->resize(1000, 1300, true, 'height');
				echo $name . '<br>';
				$file->move('../image/upload', $name);
				$Upload->image = $name;
				// $Upload->no_form = $no_form;
				$UploadModel->save($Upload);
			}
		}
	}
}
