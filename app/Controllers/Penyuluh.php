<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\PenyuluhModel;

class Penyuluh extends BaseController
{
    public function index($agama=false)
    {
        $data['agama'] = ($agama)?$agama:session('agama');
        return view('penyuluh/index', $data);
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

      if($kelola > 0){
        $model->where(['tugas_kabupaten'=>$kelola]);
      }

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="'.site_url('penyuluh/detail/'.encrypt($row->id)).'" type="button" target="_blank" class="btn btn-sm btn-primary">Detail</a>';
      })->toJson(true);
    }

    public function detail($id)
    {
      $id = decrypt($id);

      $model = new PenyuluhModel;
      $data['penyuluh'] = $model->find($id);

      return view('penyuluh/detail', $data);
    }
}
