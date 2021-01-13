<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $register = [
		'username' => [
			'rules' => 'required|min_length[4]',
		],
		'password' => [
			'rules' => 'required|min_length[5]',
		],
		'repeatPassword' => [
			'rules' => 'required|matches[password]',
		],
	];

	public $register_errors = [
		'username' => [
			'required' => '{field} Harus Diisi',
			'min_length' => '{field} Minimal 4 Karakter',
		],
		'password' => [
			'required' => '{field} Harus Diisi',
			'min_length' => '{field} Minimal 5 Karakter',
		],
		'repeatPassword' => [
			'required' => '{field} Harus Diisi',
			'matches' => '{field} Tidak Match Dengan Password'
		],
	];

	public $login = [
		'username' => [
			'rules' => 'required|min_length[4]',
		],
		'password' => [
			'rules' => 'required',
		],
	];

	public $login_errors = [
		'username' => [
			'required' => '{field} Harus Diisi',
			'min_length' => '{field} Minimal 4 Karakter',
		],
		'password' => [
			'required' => '{field} Harus Diisi',
		],
	];

	public $mobil = [
		'nopol' => [
			'rules' => 'required|min_length[7]',
		],
		'merek' => [
			'rules' => 'required',
		],
		'type' => [
			'rules' => 'required',
		],
		'jenis' => [
			'rules' => 'required',
		],
		'th_perakitan' => [
			'rules' => 'required|is_natural'
		],
		'tgl_stnk' => [
			'rules' => 'required|valid_date'
		],
	];
	public $mobil_errors = [
		'nopol' => [
			'required' => '{field} Harus Diisi',
			'min_length' => '{field} Min 7 - Max 8 Karakter',
			'max_length' => '{field} Min 7 - Max 8 Karakter',
		],
		'merek' => [
			'required' => '{field} Harus Diisi'
		],
		'type' => [
			'required' => '{field} Harus Diisi'
		],
		'jenis' => [
			'required' => '{field} Harus Diisi'
		],
		'th_perakitan' => [
			'required' => '{field} Harus Diisi',
			'is_natural' => 'Tahun Perakitan Harus Angka',
		],
		'tgl_stnk' => [
			'required' => 'Tanggal STNK Harus Diisi',
			'valid_date' => 'Tanggal STNK Harus Tanggal Yang Benar'
		],
	];

	public $cekMingguan = [
		'km' => [
			'rules' => 'required|is_natural'
		]
	];
	public $cekMingguan_errors = [
		'km' => [
			'required' => 'KM harus di isi',
			'is_natural' => 'KM harus Angka'
		],
	];
	public $updatePassword = [
		'oldPassword' => [
			'rules' => 'required|min_length[5]',
		],
		'newPassword' => [
			'rules' => 'required|min_length[5]',
		],
		'repeatNewPassword' => [
			'rules' => 'required|matches[newPassword]',
		],
	];

	public $updatePassword_errors = [
		'oldPassword' => [
			'required' => '{field} Harus Diisi',
			'min_length' => '{field} Minimal 5 Karakter',
		],
		'newPassword' => [
			'required' => '{field} Harus Diisi',
			'min_length' => '{field} Minimal 5 Karakter',
		],
		'repeatNewPassword' => [
			'required' => '{field} Harus Diisi',
			'matches' => 'Repeat Password tidak sama Dengan Password'
		],
	];
}
