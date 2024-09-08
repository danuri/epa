<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KabupatenModel;

class Master extends BaseController
{
    public function index(): string
    {
        return view('admin/index');
    }

    public function penyuluhAdd()
    {
      $kabm = new KabupatenModel;
      $data['kabupaten'] = $kabm->where('id_prov',session('kodekelola'))->findAll();
      return view('admin/master/penyuluh/add_non', $data);
    }

    public function penyuluhSave()
    {
      $satker = $unor->find($this->request->getVar('unor'));
      $keterangan = $satker->keterangan;
    }
}
