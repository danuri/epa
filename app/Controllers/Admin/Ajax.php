<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\KabupatenModel;
use App\Models\UnorModel;

class Ajax extends BaseController
{
    public function getkabupaten()
    {
        $model = new KabupatenModel;
        $search = $this->request->getVar('search');

        $data = $model->like('kabupaten', $search, 'both')->findAll();
        return $this->response->setJSON($data);
    }

    public function getPegawai($nip)
    {
      $request = \Config\Services::request();
      $client = \Config\Services::curlrequest();

      $apiurl = 'https://api.kemenag.go.id/epa/pegawai/'.$nip;

      $response = $client->request('GET', $apiurl, [
        'headers' => [
            'Accept'        => 'application/json'
        ],
        'verify' => false
      ]);

      $data = json_decode($response->getBody());
      return $this->response->setJSON($data);
    }

    public function searchunor()
    {
      $model = new UnorModel;
      $search = $this->request->getVar('search');

      $data = $model->like('keterangan', $search, 'both')->findAll();
      return $this->response->setJSON($data);
    }
}
