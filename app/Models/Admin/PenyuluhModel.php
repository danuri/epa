<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PenyuluhModel extends Model
{
    protected $table            = 'penyuluh';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function jumlahPenyuluh($jenis)
    {
      $agama = session('agama');
      $level = session('level');
      $kelola = session('kodekelola');

      if($jenis != '0'){
        $wjenis = "AND status_pegawai='$jenis'";
      }else{
        $wjenis = "";
      }

      if($level == 2){
        $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM penyuluh WHERE agama='$agama' $wjenis");
      }else if($level == 3){
        $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM penyuluh WHERE agama='$agama' AND tugas_provinsi='$kelola' $wjenis");
      }else{
        $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM penyuluh WHERE agama='$agama' AND tugas_kabupaten='$kelola' $wjenis");
      }
      return $query->getRow();
    }

    public function jumlahProvinsi()
    {
      $query = $this->db->query("SELECT a.*, COUNT(b.id) AS jumlah FROM tm_provinsi a
                                INNER JOIN penyuluh b
                                ON a.id_prov = b.tugas_provinsi
                                GROUP BY a.id_prov");
      return $query->getResul();
    }
}
