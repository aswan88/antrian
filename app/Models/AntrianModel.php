<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianModel extends Model
{
    protected $table      = 'antrian';
    protected $primaryKey = 'antrian_id';
    protected $returnType     = 'array';

    protected $allowedFields = ['pasien_id', 'dokter_id', 'no_antrian', 'status_antrian', 'prediksi', 'waktu_proses', 'waktu_selesai', 'waktu_masuk', 'waktu_keluar', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';




    public function getDataAntrian($pasien_id = false)
    {
        if ($pasien_id == false) {
            return $this->findAll();
        }
        return $this->where(['pasien_id' => $pasien_id])->first();
    }
    public function getNotif($id = false)
    {
        if ($id == false) {
            return $this->db->table('antrian')->select('dokter_id, COUNT(*) as countD')->groupBy('dokter_id')->get()->getResultArray();
        }
        return $this->db->table('antrian')->select('dokter_id, COUNT(*) as countD')->where(['dokter_id' => $id])->get()->getResult();
    }
    public function getAntrianDokter($dokter_id = false)
    {
        if ($dokter_id == false) {
            return $this->findAll();
        }
        return $this->where(['dokter_id' => $dokter_id])->first();
    }

    public function getAllAntrian($pasien_id = false)
    {
        if ($pasien_id == false) {
            $this->db->table('antrian')
                ->join('pasien', 'antrian.pasien_id = pasien.pasien_id')
                ->join('dokter', 'antrian.dokter_id = dokter.dokter_id');
            return $this->getResultArray();
        }
        return $this->db->table('antrian')
            ->join('pasien', 'antrian.pasien_id=pasien.pasien_id')
            ->join('dokter', 'antrian.dokter_id=dokter.dokter_id')
            ->where('antrian.pasien_id', $pasien_id)
            ->get()->getResultArray();
    }

    public function prdiksi()
    {
        return $this->db->query('SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(created_at))) as Average from antrian')->getResult();
    }
}
