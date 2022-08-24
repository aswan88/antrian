<?php

namespace App\Controllers;

use CodeIgniter\CLI\Console;

namespace App\Controllers;

use phpDocumentor\Reflection\Types\This;
use CodeIgniter\Validation\Rules;
use Config\Validation;
use App\Models\ModelPasien;
use App\Models\UserModel;
use App\Models\AntrianModel;
use App\Models\DokterModel;
use CodeIgniter\HTTP\Request;
use App\Models\SettingModel;
use App\Models\RiwayatModel;
use CodeIgniter\I18n\Time;
use mysqli;

class Test extends BaseController
{
    protected $ModelPasien;
    protected $UserModel;
    protected $DokterModel;
    protected $AntrianModel;
    protected $SettingModel;
    protected $RiwayatModel;
    public function __construct()
    {

        $this->ModelPasien = new ModelPasien();
        $this->AntrianModel =  new AntrianModel();
        $this->DokterModel =  new DokterModel();
        $this->SettingModel = new SettingModel();
        $this->RiwayatModel = new RiwayatModel();
    }

    public function index()
    {
        $kemarin = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
        $date = date('Y-m-d', $kemarin);
        // dd($date);
        $data = $this->RiwayatModel->like('masuk', $date)->findAll();
        // dd($data);
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
        echo   'rata-rata pelayanan per jam = ' . round($u, 3) . ' pasien';
        // d($selisih);

        echo '</br>';
        echo '</br>';
        echo '</br>';
        // rata-rata kedatangan per jam
        $e1 = $this->AntrianModel->selectMin('created_at')->first();
        $e2 = $this->AntrianModel->selectMax('created_at')->first();
        $r1 = Time::parse($e1['created_at']);
        $r2 = Time::parse($e2['created_at']);
        $diff = $r1->difference($r2);
        $s1 = round($diff->getSeconds() / 60 / 60, 4);
        $h2 = $s1 / $count;
        $y = 1 / $h2;
        echo 'rata-rata kedatangan per jam = ' .  round($y, 4);

        echo '</br>';
        echo '</br>';
        echo '</br>';

        echo 'intensitas pelayanan = ' . round($y / $u, 4);

        echo '</br>';
        echo '</br>';
        echo '</br>';
        $W = round(1 / ($u - $y), 4);
        echo 'Rata-rata menunggu dalam sistem = ' . $W . ' atau ' . $W * 60 . '  Menit';

        echo '</br>';
        echo '</br>';
        echo '</br>';
        $Wq1 = round($u - $y, 4);
        $Wq2 = round($u * $Wq1, 4);
        $wq = round($y / $Wq2, 4);
        echo 'Rata-rata menunggu dalam sistem = ' . $wq . ' atau ' . ($wq * 60) * 60  . '  detik';
    }
}
