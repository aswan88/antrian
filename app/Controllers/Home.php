<?php

namespace App\Controllers;

use App\Models\ModelPasien;
use App\Models\AntrianModel;
use App\Models\DokterModel;
use App\Models\RiwayatModel;

class Home extends BaseController
{
	protected $ModelPasien;
	protected $AntrianModel;
	protected $DokterModel;
	protected $RiwayatModel;
	public function __construct()
	{
		$this->ModelPasien = new ModelPasien();
		$this->AntrianModel = new AntrianModel();
		$this->DokterModel = new DokterModel();
		$this->RiwayatModel = new RiwayatModel();
	}
	public function index()
	{
		if (session('status') == 'login') {
			$pasien_id = session('pasien_id');
			$row = $this->ModelPasien->where(['pasien_id' == $pasien_id])->first(); //Mengambil Data Pasien Berdasarkan id pasien yang login
			$antrian = $this->AntrianModel->getAllAntrian($pasien_id); //->mengambil no antian berdasarkan id pasien yang login
			// dd($antrian);
			$jmlAntrian = $this->AntrianModel->countAllResults(); //->Menghitung Jumlah Keseluruahan Pasien yang sedang mengantri

			// mengambil nilai paling besar dari no_antrian yang memiliki nilai status_antrian =0
			$tAntrian = $this->AntrianModel->where(['status_antrian' => 0])->selectMin('no_antrian')->first();
			$antTunggu =  $this->AntrianModel->where('no_antrian', $tAntrian)->first();

			// mengambil nilai paling besar dari no_antrian yang memiliki nilai status_antrian = 1
			$psAntrian = $this->AntrianModel->where(['status_antrian' => 1])->selectMin('no_antrian')->first();
			$antProses =  $this->AntrianModel->where('no_antrian', $psAntrian)->first();
			// mengabil nilai jumlah antrian yang selesai
			$slsAntrian = $this->AntrianModel->where('status_antrian', 2)->selectMax('no_antrian')->first();
			$JslsAntrian = $this->AntrianModel->where('status_antrian', 2)->countAllResults();
			$jumlahMenunggu = $this->AntrianModel->where('status_antrian', 0)->countAllResults();

			// data Riwayat
			$riwayat = $this->RiwayatModel->getRiwayatAntrian($pasien_id);
			// dd($riwayat);
			$data = [
				'title' => 'SI KLINIK EVENGILINE | Pengonto',
				'dataPasien' => $row,
				'antrian' => $antrian,
				'jumlahMenunggu' => $jumlahMenunggu,
				'jmlAntrian' => $jmlAntrian,
				'antTunggu' => $antTunggu,
				'antrianProses' => $antProses,
				'antrianSelesai' => $slsAntrian,
				'JantrianSelesai' => $JslsAntrian,
				'dataDokter' => $this->DokterModel->getDataDokter(),
				'riwayat' => $riwayat,
				'notif' => $this->AntrianModel->getNotif(),
			];
			return view('halaman/home', $data);
		} else {
			$data = [
				'title' => 'SI KLINIK EVENGILINE | Pengonto',
				'dataDokter' => $this->DokterModel->getDataDokter()
			];
			return view('halaman/home', $data);
		}
	}

	public function login()
	{
		$data = [
			'title' => 'Halaman Login | Pangonto',
			'validation' => \Config\Services::validation()
		];

		return view('halaman/login', $data);
	}

	public function saveAntrian()
	{
		echo "test";
		// $data = [
		// 	'title' => 'Halaman print | Pangonto',
		// ];

		// return view('halaman/login', $data);
	}

	// function login proses
	public function login_proses()
	{
		// valdasi form

		if (!$this->validate([
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} harus di isi',
					'valid_email' => 'format email salah harus ada @ & .com'
				]
			],
			'password' => [
				'rules' => 'required|min_length[4]',
				'errors' => [
					'required' => '{field} harus di isi',
					'min_length' => 'Password minimal 4 karakter'
				]
			],
		])) {
			return redirect()->to('/home/login')->withInput();
		}
		$email = $this->request->getVar('email');
		$pass = $this->request->getVar('password');

		$data =	$this->ModelPasien->where('email', $email)->first();
		if ($data == null) {
			session()->setFlashdata('pesan_login', 'Email Tidak Terdaftar silahkan daftar dulu');
			return redirect()->to('/home/login');
		} else {

			if ($data['password'] != $pass) {
				session()->setFlashdata('pesan_login', 'email/Password salah periksa kembali');
				return redirect()->to('/home/login');
			} else {
				session()->set('email', $data['email']);
				session()->set('nama', $data['nama']);
				session()->set('status', 'login');
				session()->set('pasien_id', $data['pasien_id']);
				return redirect()->to('/home');
			}
		}
	}

	// logoun
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/home');
	}


	public function daftar()
	{
		$data = [
			'title' => 'Halaman Daftar | Pangonto',
			'validation' => \Config\Services::validation()
		];

		return view('halaman/daftar', $data);
	}

	// methods simpan data yg di daftarkan calon pasien / save_daftar
	public function save_daftar()
	{
		// validasi form 
		if (!$this->validate([

			'nama' => [
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => '{field} harus di isi',
					'alpha_space' => '{field} tidak boleh ada angka',
				]
			],
			'email' => [
				'rules' => 'required|is_unique[pasien.email]|valid_email',
				'errors' => [
					'required' => '{field} harus di isi',
					'valid_email' => 'format email salah harus ada @',
					'is_unique' => '{field} sudah terdaftar',
				]
			],
			'password' => [
				'rules' => 'required|min_length[4]',
				'errors' => [
					'required' => '{field} harus di isi',
					'min_length' => 'Password minimal 4 karakter'
				]
			],
			'v_password' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => '{field} harus di isi',
					'matches' => 'Harus sama dengan Password'
				]
			],

		])) {
			// $validation = \Config\Services::validation();

			return redirect()->to('/home/daftar')->withInput();
		}

		// menyimpan ke database
		$this->ModelPasien->save([
			'nama' => $this->request->getVar('nama'),
			'email' => $this->request->getVar('email'),
			'password' => $this->request->getVar('password')
		]);
		session()->setFlashdata('pesan', 'Pendaftaran Berhasil. ');

		return redirect()->to('/home/login');
	}

	//--------------------------------------------------------------------

}
