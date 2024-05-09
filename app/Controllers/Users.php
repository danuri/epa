<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        return view('users/index');
    }

    public function getdata()
    {
      $model = new UserModel();
      $level = session('level');
      $agama = session('agama');

      $model->where(['level >'=>$level,'agama'=>$agama]);

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="users/delete/'.$row->id.'" type="button" class="btn btn-sm btn-primary" onclick="return confirm(\'Pengguna akan dihapus?\')">Delete</a>';
      })->toJson(true);
    }

    public function save()
    {
      $model = new UserModel();
      $param = [
        'nip' => $this->request->getVar('nip'),
        'nama' => $this->request->getVar('nama'),
        'kelola' => $this->request->getVar('kelola'),
        'kelola_kode' => $this->request->getVar('kelola'),
        'agama' => session('agama'),
        'level' => 4,
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
