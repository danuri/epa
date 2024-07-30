<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\Admin\PenyuluhModel;

class Penyuluh extends BaseController
{
    public function index($agama=false)
    {
        $model = new PenyuluhModel();
        $data['agama'] = ($agama)?$agama:session('agama');
        $data['jpenyuluh'] = $model->jumlahPenyuluh(0);
        $data['jpenyuluhpns'] = $model->jumlahPenyuluh('PNS');
        $data['jpenyuluhpppk'] = $model->jumlahPenyuluh('PPPK');
        $data['jpenyuluhnon'] = $model->jumlahPenyuluh('NON PNS');
        return view('admin/penyuluh/index', $data);
    }

    public function getdata($kodeagama=0)
    {
      $model = new PenyuluhModel();
      $level = session('level');
      $agama = session('agama');
      $kelola = session('kodekelola');

      if(in_array($level,[2,3])){
        $model->where(['agama'=>$agama]);
      }

      if($level == 4){
        $model->where(['tugas_kabupaten'=>$kelola]);
      }else if($level == 3){
        $model->where(['tugas_provinsi'=>$kelola]);
      }

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="'.site_url('admin/penyuluh/detail/'.encrypt($row->id)).'" type="button" target="_blank" class="btn btn-sm btn-primary">Detail</a>';
      })->toJson(true);
    }

    public function detail($id)
    {
      $id = decrypt($id);

      $model = new PenyuluhModel;
      $data['penyuluh'] = $model->find($id);

      return view('admin/penyuluh/detail', $data);
    }
}
