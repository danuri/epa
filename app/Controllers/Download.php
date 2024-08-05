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
        $data['downloads'] = $model->where('kategori','Regulasi')->whereIn('target_agama',[0,$agama])->findAll();
        return view('download/regulasi',$data);
    }

    public function materi()
    {
        $model = new DownloadModel;
        $agama = session('agama');
        $data['downloads'] = $model->where('kategori','Materi')->whereIn('target_agama',[0,$agama])->findAll();
        return view('download/materi',$data);
    }
}
