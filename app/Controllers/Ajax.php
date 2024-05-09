<?php

namespace App\Controllers;
use App\Models\KabupatenModel;
use App\Models\CrudModel;
use App\Models\PenyuluhModel;

class Ajax extends BaseController
{
    public function getkabupaten()
    {
        $model = new KabupatenModel;
        $search = $this->request->getVar('search');

        $data = $model->like('kabupaten', $search, 'both')->findAll();
        return $this->response->setJSON($data);
    }

    public function getmateri()
    {
      $model = new CrudModel;
      $data = $model->getResult('tm_materi');

      return $this->response->setJSON($data);
    }

    public function getsasaran()
    {
      $model = new CrudModel;
      $data = $model->getResult('tr_sasaran_umum',['id_penyuluh'=>session('idp')]);

      return $this->response->setJSON($data);
    }

    public function getprofil()
    {
      $model = new PenyuluhModel;
      $data = (array) $model->find(session('idp'));

      $crud = new CrudModel;
      $data['tugas'] = $crud->getRow('temp_kua',['id_kua'=>session('tugas')]);

      return $this->response->setJSON($data);
    }

    public function getkuaid($id)
    {
      $model = new CrudModel;
      $data = $model->getResult('temp_kua',['id_kua'=>$id]);

      return $this->response->setJSON($data);
    }

    public function getsasaranpenyuluh()
    {
      $model = new CrudModel;
      $umum = $model->getResult('tr_sasaran_umum',['id_penyuluh'=>session('idp')]);
      $data = array();

      foreach ($umum as $row) {
        $data[] = ['id'=>'umum'.$row->id,'text'=>$row->nama];
      }

      $khusus = $model->getResult('tr_sasaran_khusus',['id_penyuluh'=>session('idp')]);
      foreach ($khusus as $row) {
        $data[] = ['id'=>'khusus'.$row->id,'text'=>$row->nama];
      }

      return $this->response->setJSON($data);
    }

    public function getmateriopsi()
    {
      $model = new CrudModel;
      $materi = $model->getResult('tm_materi');

      $data = array();

      foreach ($materi as $row) {
        $data[] = ['id'=>$row->id,'text'=>$row->materi];
      }

      return $this->response->setJSON($data);
    }
}
