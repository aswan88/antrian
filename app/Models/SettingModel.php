<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'setting';
    protected $primaryKey = 'setting_id';
    protected $returnType     = 'array';

    protected $allowedFields = ['dokter_id', 'set_buka', 'set_tutup', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getSettingDokter($dokter_id = false)
    {
        if ($dokter_id == false) {
            return $this->findAll();
        }
        return $this->where(['dokter_id' => $dokter_id])->first();
    }
}
