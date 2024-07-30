<?php

namespace App\Controllers;
use App\Models\PenyuluhModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function profil()
    {
      return view('profil');
    }

    public function save()
    {
      $model = new PenyuluhModel();

      $param = [
        'status_pegawai' => $this->request->getVar('status_pegawai'),
        'nip' => $this->request->getVar('nip'),
        'pangkat' => $this->request->getVar('pangkat'),
        'jenis_pendidikan' => $this->request->getVar('jenis_pendidikan'),
        'pendidikan' => $this->request->getVar('pendidikan'),
        'jurusan' => $this->request->getVar('jurusan'),
      ];
    }
}
