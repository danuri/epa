<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\PenyuluhModel;
use App\Models\Admin\ProvinsiModel;

class Rekapitulasi extends BaseController
{
    public function index()
    {
      $model = new PenyuluhModel();

      $data['jpenyuluh'] = $model->jumlahPenyuluh(0);
      $data['jpenyuluhpns'] = $model->jumlahPenyuluh('PNS');
      $data['jpenyuluhpppk'] = $model->jumlahPenyuluh('PPPK');
      $data['jpenyuluhnon'] = $model->jumlahPenyuluh('NON PNS');

      $data['provinsi'] = $model->jumlahProvinsi(session('agama'));

      return view('admin/rekapitulasi/index', $data);
    }

    public function provinsi($idprov)
    {
      $pm = new ProvinsiModel();
      $data['namaprov'] = $pm->find($idprov);

      $model = new PenyuluhModel();

      $agama = session('agama');

      $data['jpenyuluh'] = $model->jumlahPenyuluhSub(0);
      $data['jpenyuluhpns'] = $model->jumlahPenyuluhSub($idprov,$agama,'PNS');
      $data['jpenyuluhpppk'] = $model->jumlahPenyuluhSub($idprov,$agama,'PPPK');
      $data['jpenyuluhnon'] = $model->jumlahPenyuluhSub($idprov,$agama,'NON PNS');

      $data['kabupaten'] = $model->jumlahKabupaten($idprov,session('agama'));

      return view('admin/rekapitulasi/provinsi', $data);
    }
}
