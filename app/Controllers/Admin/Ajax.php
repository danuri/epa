<?php

namespace App\Controllers;
use App\Models\KabupatenModel;

class Ajax extends BaseController
{
    public function getkabupaten()
    {
        $model = new KabupatenModel;
        $search = $this->request->getVar('search');

        $data = $model->like('kabupaten', $search, 'both')->findAll();
        return $this->response->setJSON($data);
    }
}
