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
          'lampiran' => [
              'label' => 'Lampiran PDF',
              'rules' => [
                  'uploaded[lampiran]',
                  'mime_in[lampiran,application/pdf]',
                  'max_size[lampiran,5000]',
              ],
          ]
        ])) {
            return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
        }

      // Minio upload
      $file_name = $_FILES['lampiran']['name'];
      $ext = pathinfo($file_name, PATHINFO_EXTENSION);

      $file_name = 'document.'.time().'.'.$ext;
      $temp_file_location = $_FILES['lampiran']['tmp_name'];

      $s3 = new S3Client([
        'region'  => 'us-east-1',
        'endpoint' => 'http://10.33.0.199:9000/',
        'use_path_style_endpoint' => true,
        'version' => 'latest',
        'credentials' => [
          // 'key'    => "118ZEXFCFS0ICPCOLIEJ",
          // 'secret' => "9xR+TBkYyzw13guLqN7TLvxhfuOHSW++g7NCEdgP",
          'key'    => "GXQij0qXEekpFoBdKZfG",
          'secret' => "fQVClQicjPfsWwRj8Ybek4A3kW73j7Nhla0N3hRH",
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

    public function delete($id)
    {
      $id = decrypt($id);

      $model = new DownloadModel;
      $delete = $model->delete($id);
      return redirect()->back()->with('message', 'Dokumen telah dihapus');
    }
}
