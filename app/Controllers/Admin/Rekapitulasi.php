<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\PenyuluhModel;

class Rekapitulasi extends BaseController
{
    public function index()
    {
      $model = new PenyuluhModel();
      $data['agama'] = ($agama)?$agama:session('agama');
      $data['jpenyuluh'] = $model->jumlahPenyuluh(0);
      $data['jpenyuluhpns'] = $model->jumlahPenyuluh('PNS');
      $data['jpenyuluhpppk'] = $model->jumlahPenyuluh('PPPK');
      $data['jpenyuluhnon'] = $model->jumlahPenyuluh('NON PNS');

      $data['provinsi'] = $model->jumlahProvinsi();

      return view('admin/rekapitulasi', $data);
    }
}
