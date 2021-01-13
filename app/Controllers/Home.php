<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$vehicleModel = new \App\Models\VehicleModel();
		$mobil = $vehicleModel->where('active', 'Y')->findAll();

		return view('dmshome', ['mobils' => $mobil]);
	}

	//--------------------------------------------------------------------
	public function user()
	{

		return view('user');
	}
}
