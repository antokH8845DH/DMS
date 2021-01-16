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
}
