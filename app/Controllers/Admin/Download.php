<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DownloadModel;
use App\Models\CrudModel;

class Download extends BaseController
{
    public function index()
    {
        $model = new DownloadModel;
        $crud = new CrudModel;
        $data['download'] = $model->where(['target_agama'=>session('agama')])->findAll();
        $data['provinsi'] = $crud->getResult('tm_provinsi');

        return view('admin/download/index', $data);
    }

    public function save()
    {
      if (! $this->validate([
          'nama' => "required",
          'kategori' => "required",
          'keterangan' => "required",
          'target_wilayah' => "required",
          'target_agama' => "required",
          'lampiran' => "required",
        ])) {
            return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
        }

      // Minio upload
      $lampiran = '';

      $param = [
        'nama' => $this->request->getVar('nama'),
        'kategori' => $this->request->getVar('kategori'),
        'keterangan' => $this->request->getVar('keterangan'),
        'target_wilayah' => $this->request->getVar('target_wilayah'),
        'target_agama' => session('agama'),
        'lampiran' => $lampiran,
        'viewer' => 0,
      ];

      $model = new DownloadModel;
      $insert = $model->insert($param);

      return redirect()->back()->with('message', 'Dokumen telah ditambahkan');
    }
}
