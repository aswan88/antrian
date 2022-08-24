<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table      = 'dokter';
    protected $primaryKey = 'dokter_id';

    protected $allowedFields = ['SIP', 'nama_dokter', 'spesialisasi', 'hari_praktek', 'jam_buka', 'jam_tutup', 'kd_antrian', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getDataDokter($dokter_id = false)
    {
        if ($dokter_id == false) {
            return  $this->findAll();
        } else {
            return $this->where(['dokter_id' => $dokter_id])->first();
        }
    }
}
