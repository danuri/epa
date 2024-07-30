<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{

  public function index()
  {
    return view('admin/auth');
  }

  public function login()
  {
    if (!session()->get('isLoggedIn')) {
      return redirect()->to($_ENV['SSO_SIGNIN'].'?appid='.$_ENV['SSO_APPID']);
    }else{
      return redirect()->to('admin');
    }
  }

  public function callback()
  {
    $request = \Config\Services::request();
    $client = \Config\Services::curlrequest();

    $token = $request->getVar('token') ?? '';
    if($token){
      $verify_url = $_ENV['SSO_VERIFY'];

      $response = $client->request('POST', $verify_url, [
        'headers' => [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer '. $token,
        ],
        'verify' => false
      ]);

      $data = json_decode($response->getBody());

      if($data->status == 200){
        $data = $data->pegawai;

        $model = new UserModel;
        $check = $model->where(['nip'=>$data->NIP])->first();


        if($check){
          $ses_data = [
            'nip'        => $data->NIP,
            'nama'       => $data->NAMA,
            'kelola'     => $check->kelola,
            'kodekelola' => $check->kelola_kode,
            'level'     => $check->level,
            'agama'     => $check->agama,
            'isLoggedInAdmin' => TRUE
          ];
          session()->set($ses_data);
          return redirect()->to('admin');
        }else{
          return redirect()->to($_ENV['SSO_SIGNIN'].'?appid='.$_ENV['SSO_APPID'].'&info=2');
        }

      }else{
        echo $data->msg;
      }
    }else{
      echo 'no Token';
    }
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('admin/auth');
  }
}
