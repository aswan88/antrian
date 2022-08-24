<?php

namespace App\Controllers;

// use App\Models\ModelPasien;
use App\Models\AntrianModel;
use CodeIgniter\I18n\Time;
use App\Models\DokterModel;
use App\Models\SettingModel;
use App\Models\RiwayatModel;

class Antrian extends BaseController
{

    protected $AntrianModel;
    protected $SettingModel;
    protected $RiwayatModel;
    protected $DokterModel;
    public function __construct()
    {
        $this->AntrianModel = new AntrianModel();
        $this->DokterModel = new DokterModel();
        $this->SettingModel = new SettingModel();
        $this->RiwayatModel = new RiwayatModel();
    }

    public function getAntrian()
    {
        if ($this->request->isAJAX()) {

            $no_antrian = '';
            $dokter_id = $this->request->getVar('dokter_id');
            $pasien_id = $this->request->getVar('pasien_id');
            // dd($pasien_id);
            $cek_dokter = $this->AntrianModel->getAntrianDokter($dokter_id);
            $dataDokter = $this->DokterModel->getDataDokter($dokter_id);
            if ($cek_dokter > 0) {
                // perhitungan waiting line
                $kemarin = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
                // mengabil data terbaru
                $dataBaru = $this->RiwayatModel->where(['dokter_id' => $dokter_id])->orderBy('masuk', 'desc')->first();
                $tglDataBaru = date('Y-m-d', strtotime($dataBaru['masuk']));
                // echo $tglDataBaru;
                // die;
                $date = date('Y-m-d', $kemarin);
                // dd($date);
                $dataR1 = $this->RiwayatModel->where(['dokter_id' => $dokter_id])->like('masuk', $date)->findAll();
                $dataR2 = $this->RiwayatModel->where(['dokter_id' => $dokter_id])->like('masuk', $tglDataBaru)->findAll();
                if ($dataR1 > 0) {
                    $data = $dataR2;
                } else {
                    $data = $dataR1;
                }
                foreach ($data as $row) {
                    $current = Time::parse($row['masuk']);
                    $test    = Time::parse($row['selesai']);
                    // $waktu[] = $row['created_at'];
                    // dd($test);
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
                    // echo ($selisih);
                }
                if (!$selisih) {
                    $selisih = 0;
                }
                $sum = array_sum($selisih);
                $count = count($selisih);
                // echo $sum / $count;
                // rata-rata pelayanan per jam
                // dd(($sum / $count) / 3600, 3);
                $r = round(($sum / $count) / 3600, 3);
                // dd($r);
                $u = 1 / $r;
                // echo $u;
                // die;
                // d($r);
                // echo   'rata-rata pelayanan per jam = ' . round($u, 3) . ' pasien';
                // d($selisih);
                // rata-rata kedatangan per jam
                $count2 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->countAllResults();
                $count3 = $this->AntrianModel->where(['dokter_id' => $dokter_id, 'pasien_id' < $pasien_id])->countAllResults();
                $e1 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->selectMin('created_at')->first();
                $e2 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->selectMax('created_at')->first();
                $e3 = $this->AntrianModel->where(['dokter_id' => $dokter_id])->selectMax('prediksi')->first();
                $r1 = Time::parse($e1['created_at']);
                $r2 = Time::parse($e2['created_at']);
                $datePrediksi = Time::parse($e3['prediksi']);
                $diff = $r1->difference($r2);
                $s1 = round($diff->getSeconds() / 60 / 60, 4);
                $h2 = $s1 / $count2;
                $y = 1 / $h2;
                // echo 'rata-rata kedatangan per jam = ' .  round($y, 2);
                $W = round(1 / ($u - $y), 4);
                $Wq1 = round($u - $y, 4);
                $Wq2 = round($u * $Wq1, 4);
                $wq = round($y / $Wq2, 4);

                // $dtpre = date('H:i:s', $datePrediksi);;
                $hariIni = strtotime($datePrediksi) +  ($wq * 60) * 60;
                $prediksi = date('H:i:s', $hariIni);

                $cekPasien = $this->AntrianModel->getDataAntrian($pasien_id);
                if (empty($cekPasien)) {
                    $antrian = $this->AntrianModel->selectMax('no_antrian')->where(['dokter_id' => $dokter_id])->first();
                    $s = (int)substr($antrian['no_antrian'], 2, 3);
                    if (strlen($s) == 1) {
                        if ($s == 9) {
                            $no_antrian = $dataDokter['kd_antrian'] . '-010';
                        } else {
                            $no_antrian =  $dataDokter['kd_antrian'] . '-00' . ((int) $s + 1);
                        }
                    } elseif (strlen($s) == 2) {
                        if ($s == 99) {
                            $no_antrian = $dataDokter['kd_antrian'] . '-100';
                        } else {
                            $no_antrian =  $dataDokter['kd_antrian'] . '-0' . ((int) $s + 1);
                        }
                    } else {
                        $no_antrian =  $dataDokter['kd_antrian'] . '-' . ((int) $s + 1);
                    }
                    $array = [
                        'no_antrian' => $no_antrian,
                        'pasien_id' => $pasien_id,
                        'dokter_id' => $dokter_id,
                        'prediksi' => $prediksi,
                        'status_antrian' => 0,
                        'created_at' => Time::now()

                    ];
                    $save = $this->AntrianModel->save($array);
                    if (!$save) {
                        $res = [
                            'success' => 'Maaf gagal ',
                        ];
                        echo json_encode($res);
                    } else {
                        $res = [
                            'success' => 'Berhasil No Antrian Kamu Adalah ' . $no_antrian,
                        ];
                        echo json_encode($res);
                    }
                } else {
                    $res = [
                        'success' => 'Anda Sudah Memiliki No antrian ' . $no_antrian,
                    ];
                    echo json_encode($res);
                }
            } else {
                $no_antrian = $dataDokter['kd_antrian'] . '-001';
                $array = [
                    'no_antrian' => $no_antrian,
                    'pasien_id' => $pasien_id,
                    'dokter_id' => $dokter_id,
                    'prediksi' => $dataDokter['jam_buka'],
                    'status_antrian' => 0,
                    'created_at' => Time::now()
                ];

                $save = $this->AntrianModel->save($array);
                if (!$save) {
                    $res = [
                        'success' => 'Gagal',
                    ];
                    echo json_encode($res);
                } else {
                    $res = [
                        'success' => 'Berhasil No Antrian Kamu Adalah ' . $no_antrian,
                    ];
                    echo json_encode($res);
                }
            }
        } else {
            exit;
        }
    }




    public function resetAntrian()
    {
        if ($this->request->isAJAX()) {
            $proses = $this->AntrianModel->truncate();
            if (!$proses) {
                $res = [
                    'success' => 'Gagal',
                ];
                echo json_encode($res);
            } else {
                $res = [
                    'success' => 'Berhasil mengupdate setting antrian',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }

    public function resetAntrianDokter()
    {
        if ($this->request->isAJAX()) {
            $dokter_id = $this->request->getVar('dokter_id');
            if (!empty($dokter_id)) {
                $this->DokterModel->delete($dokter_id);
                $res = [
                    'success' => 'Data Berhasil Di Reset',
                ];
                echo json_encode($res);
            } else {
                $this->DokterModel->delete($dokter_id);
                $res = [
                    'success' => 'Data Berhasil Di Reset',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }
    public function nextAntrian()
    {
        if ($this->request->isAJAX()) {
            $tunggu_id = $this->request->getPost('tunggu_id');
            $proses_id = $this->request->getPost('proses_id');
            $no_tunggu = $this->request->getPost('no_tunggu');
            // $no_proses = $this->request->getPost('no_proses');
            if (!empty($tunggu_id)) {
                if (!empty($proses_id)) {
                    $array1 = [
                        'status_antrian' => 1,
                        'waktu_proses' =>  Time::now()
                    ];
                    $proses = $this->AntrianModel->update($tunggu_id, $array1);
                    $array2 = [
                        'status_antrian' => 2,
                        'waktu_selesai' =>  Time::now()
                    ];

                    // simpan data yang sudah selesai ke data base riwayat
                    $data = $this->AntrianModel->where(['antrian_id' => $proses_id])->first();
                    $array = [
                        'pasien_id' => $data['pasien_id'],
                        'dokter_id' => $data['dokter_id'],
                        'no_antrian' => $data['no_antrian'],
                        'masuk' => $data['waktu_proses'],
                        'selesai' => Time::now()
                    ];
                    $this->RiwayatModel->save($array);
                    $proses2 = $this->AntrianModel->update($proses_id, $array2);

                    if (!$proses && !$proses2) {
                        $res = [
                            'success' => 'Gagal',
                        ];
                        echo json_encode($res);
                    } else {
                        $res = [
                            'success' => 'Memanggil No Antrian ' . $no_tunggu,
                            'antrian' => 'Antrian  ' . $no_tunggu
                        ];
                        echo json_encode($res);
                    }
                } else {
                    $array1 = [
                        'status_antrian' => 1,
                        'waktu_proses' =>  Time::now()
                    ];
                    $proses = $this->AntrianModel->update($tunggu_id, $array1);
                    if (!$proses) {
                        $res = [
                            'success' => 'Gagal',
                        ];
                        echo json_encode($res);
                    } else {
                        $res = [
                            'success' => 'Memanggil No Antrian' . $no_tunggu,
                            'antrian' => 'Antrian  ' . $no_tunggu
                        ];
                        echo json_encode($res);
                    }
                }
            } elseif (!empty($proses_id)) {


                if (!empty($tunggu_id)) {

                    // mengupdate status antrian
                    $array1 = [
                        'status_antrian' => 1,
                        'waktu_proses' =>  Time::now()
                    ];
                    $proses = $this->AntrianModel->update($tunggu_id, $array1);
                    $array2 = [
                        'status_antrian' => 2,
                        'waktu_selesai' =>  Time::now()
                    ];
                    $proses2 = $this->AntrianModel->update($proses_id, $array2);

                    if (!$proses && !$proses2) {
                        $res = [
                            'success' => 'Gagal',
                        ];
                        echo json_encode($res);
                    } else {
                        $res = [
                            'antrian' => 'Antrian  ' . $no_tunggu,
                            'success' => 'Antrian Sementara Kosong',
                        ];

                        echo json_encode($res);
                    }
                } else {
                    // simpan data yang sudah selesai ke data base riwayat
                    $data = $this->AntrianModel->where(['antrian_id' => $proses_id])->first();
                    $array = [
                        'pasien_id' => $data['pasien_id'],
                        'dokter_id' => $data['dokter_id'],
                        'no_antrian' => $data['no_antrian'],
                        'masuk' => $data['waktu_proses'],
                        'selesai' => Time::now()
                    ];
                    $proses3 = $this->RiwayatModel->save($array);
                    $array1 = [
                        'status_antrian' => 2,
                        'waktu_selesai' =>  Time::now()
                    ];
                    $proses = $this->AntrianModel->update($proses_id, $array1);

                    if (!$proses) {
                        $res = [
                            'gagal' => 'Gagal',
                        ];
                        echo json_encode($res);
                    } else {
                        $res = [
                            'antrian' => 'Antrian ' . $no_tunggu,
                            'kosong' => 'Antrian Berikutnya Sementara Kosong',
                        ];
                        echo json_encode($res);
                    }
                }
            } else {
                $res = [
                    'kosong' => 'Antrian Sementara Kosong',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }
    public function ulang()
    {
        if ($this->request->isAJAX()) {
            $no_ulang = $this->request->getPost('no_ulang');
            if (!empty($no_ulang)) {
                $res = [
                    'success' => 'Memanggil No Antrian ' . $no_ulang,
                    'antrian' => 'Nomor Antrian  ' . $no_ulang
                ];
                echo json_encode($res);
            } else {
                $res = [
                    'success' => 'Antrian Sementara Kosong',
                ];
                echo json_encode($res);
            }
        } else {
            exit;
        }
    }

    public function setting()
    {
        if ($this->request->isAJAX()) {
            $dokter_id = $this->request->getVar('dokter_id');
            $jam_buka = $this->request->getVar('jam_buka');
            $jam_tutup = $this->request->getVar('jam_tutup');
            $setBuka = $this->request->getVar('buka_antrian');
            $setTutup = $this->request->getVar('tutup_antrian');


            if ($setBuka == '15 menit') {
                $set = strtotime($jam_buka) - 60 * 15;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == '30 menit') {
                $set = strtotime($jam_buka) - 60 * 30;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == '1 jam') {
                $set = strtotime($jam_buka) - 60 * 60;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == '2 jam') {
                $set = strtotime($jam_buka) - 60 * 60;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == 'sekarang') {
                $set = strtotime(date('H:i:s')) + 10;
                $settingBuka = date('H:i:s', $set);
            } else {
                $settingBuka = $jam_buka;
            }
            if ($setTutup == '15 menit') {
                $set = strtotime($jam_tutup) - 60 * 15;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == '30 menit') {
                $set = strtotime($jam_tutup) - 60 * 30;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == '1 jam') {
                $set = strtotime($jam_tutup) - 60 * 60;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == 'sekarang') {
                $set = strtotime(date('H:i:s')) + 10;
                $settingTutup = date('H:i:s', $set);
            } else {
                $settingTutup = $jam_tutup;
            }

            $dtaArr = [
                'dokter_id' => $dokter_id,
                'set_buka' => $settingBuka,
                'set_tutup' => $settingTutup,
            ];

            $save = $this->SettingModel->save($dtaArr);
            if (!$save) {
                $res = [
                    'success' => 'Gagal',
                ];
                echo json_encode($res);
            } else {
                $res = [
                    'success' => 'Berhasil mengupdate setting antrian',
                ];
                echo json_encode($res);
            }
        }
    }

    public function settingEdit()
    {
        if ($this->request->isAJAX()) {
            $waktu = date('H:i:s');
            $dokter_id = $this->request->getVar('dokter_id');
            $setting = $this->SettingModel->getSettingDokter($dokter_id);
            $setting_id = $setting['setting_id'];

            $jam_buka = $this->request->getVar('jam_buka');
            $jam_tutup = $this->request->getVar('jam_tutup');
            $tutup_awal = $this->request->getVar('tutup_awal');
            $buka_awal = $this->request->getVar('buka_awal');
            $setBuka = $this->request->getVar('buka_antrian');
            $setTutup = $this->request->getVar('tutup_antrian');

            if ($setBuka == '15 menit') {
                $set = strtotime($jam_buka) - 60 * 15;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == '30 menit') {
                $set = strtotime($jam_buka) - 60 * 30;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == '1 jam') {
                $set = strtotime($jam_buka) - 60 * 60;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == '2 jam') {
                $set = strtotime($jam_buka) - 60 * 60;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == 'sekarang') {
                $set = strtotime(date('H:i:s')) + 10;
                $settingBuka = date('H:i:s', $set);
            } elseif ($setBuka == 'sesuai') {
                $settingBuka = $jam_buka;
            } else {
                $settingBuka = $buka_awal;
            }
            if ($setTutup == '15 menit') {
                $set = strtotime($jam_tutup) - 60 * 15;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == '30 menit') {
                $set = strtotime($jam_tutup) - 60 * 30;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == '1 jam') {
                $set = strtotime($jam_tutup) - 60 * 60;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == 'sekarang') {
                $set = strtotime(date('H:i:s')) + 10;
                $settingTutup = date('H:i:s', $set);
            } elseif ($setTutup == 'sesuai') {
                $settingTutup = $jam_tutup;
            } else {
                $settingTutup = $tutup_awal;
            }

            $dtaArr = [
                'dokter_id' => $dokter_id,
                'set_buka' => $settingBuka,
                'set_tutup' => $settingTutup,
            ];

            $save = $this->SettingModel->update($setting_id, $dtaArr);
            if (!$save) {
                $res = [
                    'success' => 'Gagal',
                ];
                echo json_encode($res);
            } else {
                $res = [
                    'success' => 'Berhasil mengupdate setting antrian',
                ];
                echo json_encode($res);
            }
        }
    }




    //--------------------------------------------------------------------

}
