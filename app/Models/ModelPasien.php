<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPasien extends Model
{
    protected $table      = 'pasien';
    protected $primaryKey = 'pasien_id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['nik', 'nama', 'profile_pasien', 'email', 'password', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getPasien($nik = false)
    {
        if ($nik == false) {
            return $this->findAll();
        }

        return $this->where(['nik' => $nik])->first();
    }
}
