<?php

namespace App\Controllers;

use App\Models\ModelPasien;

use App\Models\AntrianModel;
use App\Models\DokterModel;

use App\Models\SettingModel;
use App\Models\RiwayatModel;
use App\Models\AdminModel;
use CodeIgniter\I18n\Time;


class Admin extends BaseController
{
    protected $ModelPasien;
    protected $DokterModel;
    protected $SettingModel;
    protected $RiwayatModel;
    protected $AntrianModel;
    protected $AdminModel;


    public function __construct()
    {

        $this->ModelPasien = new ModelPasien();
        $this->AntrianModel =  new AntrianModel();
        $this->DokterModel =  new DokterModel();
        $this->SettingModel = new SettingModel();
        $this->RiwayatModel = new RiwayatModel();
        $this->AdminModel = new AdminModel();
    }


    public function index()
    {

        if (@$_SESSION['username'] == null) {
            session()->setFlashdata('pesanError', 'Anda tidak di ijinkan');
            return redirect()->to('/admin/login');
        } else {
            $set = strtotime(date('H:i:s')) + 5;
            $settingTutup = date('H:i:s', $set);
            $data = [
                'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
                'settingTutup' => $settingTutup,
                'dataPasien' => $this->ModelPasien->countAllResults(),
                'dataDokter' => $this->DokterModel->countAllResults(),
                'dataAntrian' => $this->AntrianModel->countAllResults(),
                'dataRiwayat' => $this->RiwayatModel->countAllResults(),
                'dataAdmin' => 3,

            ];
            return view('admin/index', $data);
        }
    }

    public function antrian()
    {
        $dokter = $this->DokterModel->getDataDokter();

        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'dataDokter' => $dokter,
            'notif' => $this->AntrianModel->getNotif(),

        ];
        return view('admin/antrian', $data);
    }

    public function getNotif()
    {
        if ($this->request->isAJAX()) {
            $dokter_id = $this->request->getVar('dokter_id');
            $res = [
                'data' => $this->AntrianModel->getNotif($dokter_id),
            ];
            echo json_encode($res);
        }
    }

    public function viewAntrian($id)
    {
        $dokter_id = $id;


        // perhitungan waiting line
        $kemarin = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
        $date = date('Y-m-d', $kemarin);
        // dd($date);
        $data = $this->RiwayatModel->where(['dokter_id' => $dokter_id])->orderBy('masuk', 'desc')->findAll();
        // dd($data);
        if (!empty($data)) {
            foreach ($data as $row) {
                $current = Time::parse($row['masuk']);
                $test    = Time::parse($row['selesai']);
                // $waktu[] = $row['created_at'];
                // d($test);
                $diff = $current->difference($test);

                // echo $diff->getYears();     // -7
                // echo $diff->getMonths();    // -84
                // echo $diff->getWeeks();     // -365
                // echo $diff->getDays();      // -2557
                // echo $diff->getHours()  . '</br>';     // -61368
                $selisih[] = $diff->getSeconds();
                // echo $diff->getMinutes() . '</br>';
                // echo round($diff->getMinutes() / 60, 1)  . '</br>';  // -3682080
                // echo $diff->getSeconds();   // -220924800
            }
            $sum = array_sum($selisih);
            $count = count($selisih);
            // echo $sum / $count;
            // rata-rata pelayanan per jam
            // dd(($sum / $count) / 3600, 3);
            $r = round(($sum / $count) / 3600, 3);
            // dd($r);
            $u = 1 / $r;
            // d($r);
            // rata- Rata Perjam

            // d($selisih);
            // rata-rata kedatangan per jam
            $count2 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->countAllResults();
            $count3 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->countAllResults();
            $e1 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->selectMin('created_at')->first();
            $e2 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->selectMax('created_at')->first();
            $r1 = Time::parse($e1['created_at']);
            $r2 = Time::parse($e2['created_at']);
            $diff = $r1->difference($r2);
            $s1 = round($diff->getSeconds() / 60 / 60, 4);
            $h2 = $s1 / $count2;
            $y = 1 / $h2;
            // $kedatangan = round($y)
            $Wq1 = round($u - $y, 4);
            $Wq2 = round($u * $Wq1, 4);
            $wq = round($y / $Wq2, 4);
            // echo 'Rata-rata menunggu dalam sistem = ' . $wq . ' atau ' . ($wq * 60) * 60  . '  detik';
            $rata_perjam = round($u, 3);
            $kedatangan =  round($y, 2);
            $itensitas = round($y / $u, 4);
            $menungguDS = $wq;
        } else {
            $rata_perjam = 0;
            $kedatangan = 0;
            $itensitas = 0;
            $menungguDS = 0;
        }





        // dd($row);
        //->mengambil semua data antian 
        $antrian = $this->AntrianModel->where('dokter_id', $dokter_id)->getDataAntrian();

        //->Menghitung Jumlah Keseluruahan Pasien yang sedang mengantri
        $jmlAntrian = $this->AntrianModel->where('dokter_id', $dokter_id)->countAllResults();

        // mengambil nilai paling besar dari no_antrian yang memiliki nilai status_antrian =0
        $tAntrian = $this->AntrianModel->where(['status_antrian' => 0, 'dokter_id' => $dokter_id])->selectMin('no_antrian')->first();
        $tAntrian = $this->AntrianModel->where(['status_antrian' => 0, 'dokter_id' => $dokter_id])->selectMin('no_antrian')->first();
        $antTunggu =  $this->AntrianModel->where('no_antrian', $tAntrian)->first();

        // mengambil nilai paling besar dari no_antrian yang memiliki nilai status_antrian = 1
        $psAntrian = $this->AntrianModel->where(['status_antrian' => 1, 'dokter_id' => $dokter_id])->selectMin('no_antrian')->first();
        $antProses =  $this->AntrianModel->where('no_antrian', $psAntrian)->first();

        // mengabil nilai jumlah antrian yang selesai
        $slsAntrian = $this->AntrianModel->where(['status_antrian' => 2, 'dokter_id' => $dokter_id])->countAllResults();

        $dokter = $this->DokterModel->getDataDokter($dokter_id);
        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'antrian' => $antrian,
            'jmlAntrian' => $jmlAntrian,
            'antTunggu' => $antTunggu,
            'antProses' => $antProses,
            'slsAntrian' => $slsAntrian,
            'data' => $dokter,
            'itensitas' => $itensitas * 100,
            'rata_per_jam' => $rata_perjam,
            'kedatangan' => $kedatangan * 100,
            'menunggu' => $menungguDS * 100
        ];

        return view('admin/viewDokterAntrian', $data);
    }

    public function pasien()
    {
        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'dataPasien' => $this->ModelPasien->getPasien()
        ];
        return view('admin/pasien', $data);
    }

    public function riwayat()
    {
        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'dataRiwayat' => $this->RiwayatModel->getRiwayatAntrian()
        ];
        return view('admin/riwayat', $data);
    }

    public function viewAdmin()
    {
        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'dataAdmin' => $this->AdminModel->getAdmin()
        ];
        return view('admin/viewAdmin', $data);
    }

    public function saveAdmin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $password2 = $this->request->getPost('password2');

        if ($password !== $password2) {
            session()->setFlashdata('pesanError', 'Gagal password dan konfirmasi password tidak sama');
            return redirect()->to('/admin/viewAdmin');
        } else {
            // enkripsi assword 
            $encPassword = password_hash($password, PASSWORD_DEFAULT);

            $save = $this->AdminModel->save([
                'username' => $username,
                'password' => $encPassword
            ]);
            if ($save == true) {
                session()->setFlashdata('pesanData', 'Berhasil Menambahkan admin ');
                return redirect()->to('/admin/viewAdmin');
            } else {
                session()->setFlashdata('pesanError', 'Gagal simpan ke database');
                return redirect()->to('/admin/viewAdmin');
            }
        }
    }
    public function hapusAdmin()
    {
        if ($this->request->isAJAX()) {
            $admin_id = $this->request->getVar('admin_id');
            if (!empty($admin_id)) {
                $this->AdminModel->delete($admin_id);
                $res = [
                    'success' => 'Data Berhasil Di Hapus',
                ];
                echo json_encode($res);
            } else {
                $this->AdminModel->delete($admin_id);
                $res = [
                    'success' => 'Data Berhasil Di Hapus',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }

    // login
    public function login()
    {
        $data = [
            'username' => "Administrator",
            'dataAdmin' => $this->AdminModel->getAdmin()
        ];
        return view('admin/login', $data);
    }
    public function loginProses()
    {
        // dd($_POST);
        $username = htmlspecialchars($this->request->getPost('username'));
        $password = htmlspecialchars($this->request->getPost('password'));

        // var_dump($username, $password);
        $sql = $this->AdminModel->where(['username' => $username])->first();
        // dd($sql['username']);
        if ($sql == true) {
            $verifikasi = password_verify($password, $sql['password']);
            if ($verifikasi == true) {
                $_SESSION['username'] = $sql['username'];
                session()->setFlashdata('pesanData', 'Berhasil Login..');
                return redirect()->to('/admin/index');
            } else {
                session()->setFlashdata('pesanError', 'Gagal Login');
                return redirect()->to('/admin/login');
            }
        } else {
            session()->setFlashdata('pesanError', 'Gagal Login');
            return redirect()->to('/admin/login');
        }
    }
    public function logoutAdmin()
    {
        session_destroy();
        session_unset();
        return redirect()->to('/');
    }


    public function dokter()
    {


        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'dataDokter' => $this->DokterModel->getDataDokter(),
            'dataSetting' => $this->SettingModel->getSettingDokter(),

        ];
        return view('admin/dokter', $data);
    }


    // tambah data dokter

    public function tambah_dokter()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            // validasi form 
            $valid = $this->validate([

                'sip' => [
                    'label' => 'No SIP',
                    'rules' => 'required|is_unique[dokter.SIP]|numeric',
                    'errors' => [
                        'required' => '{field} harus di isi',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],

                'nama_dokter' => [
                    'label' => 'Nama Dokter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'spesialisasi' => [
                    'label' => 'Spesialisasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'hari_praktek1' => [
                    'label' => 'Hari Awal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'hari_praktek2' => [
                    'label' => 'Sampai Hari',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'jam_buka' => [
                    'label' => 'Jam Buka',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'jam_tutup' => [
                    'label' => 'Tutup tutup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],
                'kd_antrian' => [
                    'label' => 'Kode Antrian',
                    'rules' => 'required|is_unique[dokter.kd_antrian]',
                    'errors' => [
                        'required' => '{field} harus di isi',
                        'is_unique' => '{field} Sudah Ada .! Coba Yang Lain',
                    ]
                ],
            ]);
            if (!$valid) {
                $res = [
                    'error' => [
                        'sip' => $validation->getError('sip'),
                        'nama_dokter' => $validation->getError('nama_dokter'),
                        'spesialisasi' => $validation->getError('spesialisasi'),
                        'hari_praktek1' => $validation->getError('hari_praktek1'),
                        'hari_praktek2' => $validation->getError('hari_praktek2'),
                        'jam_buka' => $validation->getError('jam_buka'),
                        'jam_tutup' => $validation->getError('jam_tutup'),
                        'kd_antrian' => $validation->getError('kd_antrian'),
                    ]
                ];
                echo json_encode($res);
            } else {

                $hari_praktek = $this->request->getPost('hari_praktek1') . ' - ' . $this->request->getPost('hari_praktek2');
                // dd($hari_praktek);
                $array = [
                    'SIP' => $this->request->getPost('sip'),
                    'nama_dokter' => $this->request->getPost('nama_dokter'),
                    'spesialisasi' => $this->request->getPost('spesialisasi'),
                    'hari_praktek' => $hari_praktek,
                    'jam_buka' => $this->request->getPost('jam_buka'),
                    'jam_tutup' => $this->request->getPost('jam_tutup'),
                    'kd_antrian' => $this->request->getPost('kd_antrian'),
                    'status' => 'Tutup',
                ];
                $save = $this->DokterModel->save($array);
                if (!$save) {
                    $res = [
                        'success' => 'gagal menyimpan ke data base',
                    ];
                    echo json_encode($res);
                } else {
                    $res = [
                        'success' => 'Data Berhasil Di Tambah',
                    ];
                    echo json_encode($res);
                }
            }
        } else {
            exit;
        }
    }
    // tambah data dokter

    public function edit_dokter()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            // validasi form 
            $valid = $this->validate([

                'sip' => [
                    'label' => 'No SIP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',

                    ]
                ],

                'nama_dokter' => [
                    'label' => 'Nama Dokter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'spesialisasi' => [
                    'label' => 'Spesialisasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'hari_praktek1' => [
                    'label' => 'Hari Awal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'hari_praktek2' => [
                    'label' => 'Sampai Hari',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'jam_buka' => [
                    'label' => 'Jam Buka',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],

                'jam_tutup' => [
                    'label' => 'Tutup tutup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ]
                ],
            ]);
            if (!$valid) {
                $res = [
                    'error' => [
                        'sip' => $validation->getError('sip'),
                        'nama_dokter' => $validation->getError('nama_dokter'),
                        'spesialisasi' => $validation->getError('spesialisasi'),
                        'hari_praktek1' => $validation->getError('hari_praktek1'),
                        'hari_praktek2' => $validation->getError('hari_praktek2'),
                        'jam_buka' => $validation->getError('jam_buka'),
                        'jam_tutup' => $validation->getError('jam_tutup'),
                    ]
                ];
                echo json_encode($res);
            } else {

                $hari_praktek = $this->request->getPost('hari_praktek1') . ' - ' . $this->request->getPost('hari_praktek2');
                // dd($hari_praktek);
                $dokter_id = $this->request->getPost('dokter_id');
                $array = [
                    'SIP' => $this->request->getPost('sip'),
                    'nama_dokter' => $this->request->getPost('nama_dokter'),
                    'spesialisasi' => $this->request->getPost('spesialisasi'),
                    'hari_praktek' => $hari_praktek,
                    'jam_buka' => $this->request->getPost('jam_buka'),
                    'jam_tutup' => $this->request->getPost('jam_tutup'),
                    'kd_antrian' => $this->request->getPost('kd_antrian'),
                ];
                $save = $this->DokterModel->update($dokter_id, $array);
                if (!$save) {
                    $res = [
                        'success' => 'gagal menyimpan ke data base',
                    ];
                    echo json_encode($res);
                } else {
                    $res = [
                        'success' => 'Data Berhasil Di Edit',
                    ];
                    echo json_encode($res);
                }
            }
        } else {
            exit;
        }
    }


    public function hapusDokter()
    {
        if ($this->request->isAJAX()) {
            $dokter_id = $this->request->getVar('dokter_id');
            $setting = $this->SettingModel->getSettingDokter($dokter_id);
            if (!empty($setting)) {
                $setting_id = $setting['setting_id'];
                $this->SettingModel->delete($setting_id);
                $this->DokterModel->delete($dokter_id);
                $res = [
                    'success' => 'Data Berhasil Di Hapus',
                ];
                echo json_encode($res);
            } else {
                $this->DokterModel->delete($dokter_id);
                $res = [
                    'success' => 'Data Berhasil Di Hapus',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }





    public function pasien_detail($nik)
    {
        $data = [
            'title' => 'ADMIN KLINIK EVENGILINE | Pengonto',
            'dataPasien' => $this->ModelPasien->getPasien($nik),
        ];
        return view('admin/pasien_detail', $data);
    }









    // untuk modal
    public function modalTambahDokter()
    {
        if ($this->request->isAJAX()) {

            $res = [
                'data' => view('admin/modal/tambahDokter'),
            ];
            echo json_encode($res);
        } else {
            exit;
        }
    }

    public function modalSetting()
    {
        if ($this->request->isAJAX()) {
            $dokter_id = $this->request->getVar('dokter_id');
            $dokter = $this->DokterModel->getDataDokter($dokter_id);
            $dataSetting = $this->SettingModel->getSettingDokter($dokter_id);
            $setBuka = $dataSetting['set_buka'];
            $setTutup = $dataSetting['set_tutup'];
            $praktekBuka = $dokter['jam_buka'];
            $praktekTutup = $dokter['jam_tutup'];


            if (strtotime($setBuka) + 60 * 15 == strtotime($praktekBuka)) {
                $settingBuka = '15 menit';
            } elseif (strtotime($setBuka) + 60 * 30 == strtotime($praktekBuka)) {
                $settingBuka = '30 menit';
            } elseif (strtotime($setBuka) + 60 * 60 == strtotime($praktekBuka)) {
                $settingBuka = '1 jam';
            } elseif (strtotime($setBuka) + 60 * 60 * 2 == strtotime($praktekBuka)) {
                $settingBuka = '2 jam';
            } elseif (strtotime($setBuka) == strtotime($praktekBuka)) {
                $settingBuka = 'sesuai';
            } else {
                $settingBuka = 'sekarang';
            }
            if (strtotime($setTutup) + 60 * 15 == strtotime($praktekTutup)) {
                $settingTutup = '15 menit';
            } elseif (strtotime($setTutup) + 60 * 30 == strtotime($praktekTutup)) {
                $settingTutup = '30 menit';
            } elseif (strtotime($setTutup) + 60 * 60 == strtotime($praktekTutup)) {
                $settingTutup = '1 jam';
            } elseif (strtotime($setTutup) == strtotime($praktekTutup)) {
                $settingTutup = 'sesuai';
            } else {
                $settingTutup = 'sekarang';
            }
            $data = [
                'dataDokter' => $dokter,
                'settingBuka' => $settingBuka,
                'settingTutup' => $settingTutup,
                'setBuka' => $setBuka,
                'setTutup' => $setTutup
            ];
            $res = [
                'data' => view('admin/modal/settingEdit', $data),
            ];
            echo json_encode($res);
        }
    }

    public function modalEditDokter()
    {
        if ($this->request->isAJAX()) {

            $dokter_id = $this->request->getVar('dokter_id');

            // dd($row);
            $data = [
                'dataDokter' => $this->DokterModel->getDataDokter($dokter_id),
            ];
            $res = [
                'data' => view('admin/modal/editDokter', $data),
            ];
            echo json_encode($res);
        } else {
            exit;
        }
    }


    public function cekEventBuka()
    {
        if ($this->request->isAJAX()) {
            $waktu = date('H:i:s');
            $array = ['set_buka =' => $waktu];
            if (!empty($cek = $this->SettingModel->where($array)->first())) {
                $id = $cek['dokter_id'];
                $dokter = $this->DokterModel->getDataDokter($id);
                $data = [
                    'status' => 'Buka'
                ];
                $save = $this->DokterModel->update($id, $data);
                if ($save) {
                    echo 'Antrian Dokter ' . $dokter['nama_dokter'] . ' Telah di buka';
                } else {
                    echo 'Cek';
                }
            } else {
                exit;
            }
        } else {
            exit;
        }
    }
    public function cekEventTutup()
    {
        if ($this->request->isAJAX()) {
            $waktu = date('H:i:s');
            $array = ['set_tutup =' => $waktu];
            if (!empty($cek = $this->SettingModel->where($array)->first())) {
                $id = $cek['dokter_id'];
                $dokter = $this->DokterModel->getDataDokter($id);
                $data = [
                    'status' => 'Tutup'
                ];
                $save = $this->DokterModel->update($id, $data);
                if ($save) {
                    echo 'Antrian Dokter ' . $dokter['nama_dokter'] . ' Telah di Tutup';
                } else {
                    echo 'Cek';
                }
            } else {
                exit;
            }
        } else {
            exit;
        }
    }



    public function hapusPasien()
    {
        if ($this->request->isAJAX()) {
            $pasien_id = $this->request->getVar('pasien_id');
            if (!empty($pasien_id)) {
                $this->ModelPasien->delete($pasien_id);
                $res = [
                    'success' => 'Data Berhasil Di Hapus',
                ];
                echo json_encode($res);
            } else {
                $this->ModelPasien->delete($pasien_id);
                $res = [
                    'success' => 'Data Berhasil Di Hapus',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }
    //--------------------------------------------------------------------

}
