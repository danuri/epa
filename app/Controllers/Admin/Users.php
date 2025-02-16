<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\Admin\KabupatenModel;
use App\Models\Admin\UserModel;
use App\Models\CrudModel;

class Users extends BaseController
{
    public function index()
    {
        $crud = new CrudModel;
        if(session('level') == 2){
          $data['provinsi'] = $crud->getResult('tm_provinsi');
        }else if(session('level') == 3){
          $data['kabupaten'] = $crud->getResult('temp_kabupaten',['id_prov'=>session('kodekelola')]);
        }
        return view('admin/users/index', $data);
    }

    public function getdata()
    {
      $model = new UserModel();
      $level = session('level');
      $agama = session('agama');

      if(session('level') == 2){
        $model->where(['level'=>3,'agama'=>$agama]);
      }else if(session('level') == 3){
        $model->where(['level'=>4,'agama'=>$agama,'parent'=>session('kodekelola')]);
      }

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="users/delete/'.$row->id.'" type="button" class="btn btn-sm btn-primary" onclick="return confirm(\'Pengguna akan dihapus?\')">Delete</a>';
      })->toJson(true);
    }

    public function save()
    {
      if (! $this->validate([
          'nip' => "required",
          'nama' => "required",
          'kelola' => "required",
        ])) {
            return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
        }

      $model = new UserModel();

      if(session('level') == 2){

        $level = 3;
        $kabm = new KabupatenModel;
        $kab = $kabm->where(['id_prov'=>$this->request->getVar('kelola')])->first();
        $kelola = $kab->provinsi;

      }else if(session('level') == 3){

        $kabm = new KabupatenModel;
        $kab = $kabm->find($this->request->getVar('kelola'));
        $level = 4;
        $kelola = $kab->kabupaten;

      }

      $param = [
        'nip' => $this->request->getVar('nip'),
        'nama' => $this->request->getVar('nama'),
        'kelola' => $kelola,
        'kelola_kode' => $this->request->getVar('kelola'),
        'agama' => session('agama'),
        'level' => $level,
        'parent' => session('kodekelola'),
      ];

      $insert = $model->insert($param);

      return redirect()->back()->with('message', 'User telah ditambahkan');
    }

    public function delete($id)
    {
      $model = new UserModel();

      $model->delete($id);
      return redirect()->back()->with('message', 'User telah dihapus');
    }
}
