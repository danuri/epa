<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenyuluhModel;

class Auth extends BaseController
{

  public function index()
  {
    return view('auth');
  }

  public function login()
  {
    if( !$this->validate([
      'username' 	=> 'required',
      'password' 	=> 'required',
    ]))
    {
      return $this->response->setJSON(['status' => false, 'code' => 403, "message" => 'Username dan Password harus diisi.']);
    }

    $u = $this->request->getVar('username');
    // $p = md5($this->request->getVar('password'));
    $p = $this->request->getVar('password');

    $model = new PenyuluhModel;
    $pegawai  = $model->where(['nipa'=>$u,'password'=>$p])->first();

    if($pegawai){
      $ses_data = [
          'idp'  => $pegawai->id,
          'nipa'  => $pegawai->nipa,
          'nama'  => $pegawai->nama,
          'tugas'  => $pegawai->tugas_kua,
          'tugas_kabupaten'  => $pegawai->tugas_kabupaten,
          'isLoggedIn' => true,
      ];

      session()->set($ses_data);
      return redirect()->to('/');
    }
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('auth');
  }
}
