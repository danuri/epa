<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DownloadModel;

class Download extends BaseController
{
    public function regulasi()
    {
        $model = new DownloadModel;
        $agama = session('agama');
        $data['downloads'] = $model->whereIn(['target_agama'=>[0,$agama],'kategori'=>'regulasi'])->findAll('tr_download');
        return view('download/regulasi',$data);
    }

    public function regulasi()
    {
        $model = new DownloadModel;
        $agama = session('agama');
        $data['downloads'] = $model->whereIn(['target_agama'=>[0,$agama],'kategori'=>'materi'])->findAll('tr_download');
        return view('download/materi',$data);
    }
}
