<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DownloadModel;
use App\Models\CrudModel;
use Aws\S3\S3Client;

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
          'target_agama' => "required",
          'lampiran' => [
              'label' => 'Lampiran PDF',
              'rules' => [
                  'uploaded[lampiran]',
                  'mime_in[lampiran,application/pdf]',
              ],
          ]
        ])) {
            return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
        }

      // Minio upload
      $file_name = 'document.'.time().'.'.$ext;
      $s3 = new S3Client([
        'region'  => 'us-east-1',
        'endpoint' => 'http://10.33.0.199:9000/',
        'use_path_style_endpoint' => true,
        'version' => 'latest',
        'credentials' => [
          // 'key'    => "118ZEXFCFS0ICPCOLIEJ",
          // 'secret' => "9xR+TBkYyzw13guLqN7TLvxhfuOHSW++g7NCEdgP",
          'key'    => "PkzyP2GIEBe8z29xmahI",
          'secret' => "voNVqTilX2iux6u7pWnaqJUFG1414v0KTaFYA0Uz",
        ],
        'http'    => [
            'verify' => false
        ]
      ]);

  		$result = $s3->putObject([
  			'Bucket' => 'epa',
  			'Key'    => 'dokumen/'.$file_name,
  			'SourceFile' => $temp_file_location,
        'ContentType' => 'application/pdf'
  		]);

      $param = [
        'nama' => $this->request->getVar('nama'),
        'kategori' => $this->request->getVar('kategori'),
        'keterangan' => $this->request->getVar('keterangan'),
        'target_agama' => session('agama'),
        'lampiran' => $file_name,
        'viewer' => 0,
      ];

      $model = new DownloadModel;
      $insert = $model->insert($param);

      return redirect()->back()->with('message', 'Dokumen telah ditambahkan');
    }
}
