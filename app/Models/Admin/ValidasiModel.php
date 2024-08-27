<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ValidasiModel extends Model
{
    protected $table            = 'penyuluh';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['status_pegawai_validasi','nip','nik','kode_satker','nama_satker','keterangan'];

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

      if($jenis == 'non'){
        $wjenis = "AND status_pegawai_validasi IS NULL";
      }else if($jenis != '0'){
        $wjenis = "AND status_pegawai_validasi='$jenis'";
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

    public function jumlahPenyuluhSub($prov,$agama,$jenis)
    {
      if($jenis != '0'){
        $wjenis = "AND status_pegawai='$jenis'";
      }else{
        $wjenis = "";
      }

      $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM penyuluh WHERE agama='$agama' AND tugas_provinsi='$prov' $wjenis");

      return $query->getRow();
    }

    public function jumlahProvinsi($agama)
    {
      $query = $this->db->query("SELECT a.*, COUNT(b.id) AS jumlah FROM tm_provinsi a
                                INNER JOIN penyuluh b
                                ON a.id_prov = b.tugas_provinsi
                                WHERE b.agama = '$agama'
                                GROUP BY a.id_prov");
      return $query->getResult();
    }

    public function jumlahKabupaten($prov,$agama)
    {
      $query = $this->db->query("SELECT a.*, COUNT(b.id) AS jumlah FROM tm_kabupaten a
                                INNER JOIN penyuluh b
                                ON a.id_kab = b.tugas_kabupaten
                                WHERE a.id_prov = '$prov' AND b.agama = '$agama'
                                GROUP BY a.id_kab");
      return $query->getResult();
    }
}
