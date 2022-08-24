<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table      = 'riwayat_antrian';
    protected $primaryKey = 'riwayat_id';
    protected $returnType     = 'array';

    protected $allowedFields = ['pasien_id', 'dokter_id', 'no_antrian', 'masuk', 'selesai'];



    public function getRiwayatAntrian($pasien_id = false)
    {
        if ($pasien_id == false) {
            return $this->db->table('riwayat_antrian')
                ->join('pasien', 'riwayat_antrian.pasien_id = pasien.pasien_id')
                ->join('dokter', 'riwayat_antrian.dokter_id = dokter.dokter_id')->orderBy('selesai', 'DESC')->get()->getResultArray();
        }
        return $this->join('dokter', 'riwayat_antrian.dokter_id=dokter.dokter_id')->where(['pasien_id' => $pasien_id])->findAll();
    }
}
