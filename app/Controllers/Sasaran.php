<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\SasaranumumModel;
use App\Models\SasarankhususModel;

class Sasaran extends BaseController
{
    public function index()
    {
        //
    }

    public function umum()
    {
      return view('sasaran/umum');
    }

    public function umumgetdata()
    {
      $model = new SasaranumumModel();
      $idp = session('idp');

      $model->where(['id_penyuluh'=>$idp]);

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="'.site_url('sasaran/umum/delete/'.encrypt($row->id)).'" onclick="return confirm(\'Sasaran umum akan dihapus?\')" type="button" class="btn btn-sm btn-danger"><i class="ri-delete-bin-5-line"></i></a>';
      })->toJson(true);
    }

    public function umumsave()
    {
      if (! $this->validate([
          'nama' => "required",
          'no_hp' => "required",
          'jumlah_jamaah' => "required",
          'organisasi_induk' => "required",
        ])) {
            // return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
            echo 'Harap isi dengan lengkap.';
        }

        $model = new SasaranumumModel;

        $param = [
          'id_penyuluh' => session('idp'),
          'jenis' => $this->request->getVar('jenis'),
          'nama' => $this->request->getVar('nama'),
          'media_sosial' => $this->request->getVar('media_sosial'),
          'no_hp' => $this->request->getVar('no_hp'),
          'jumlah_jamaah' => $this->request->getVar('jumlah_jamaah'),
          'organisasi_induk' => $this->request->getVar('organisasi_induk')
        ];

        $model->insert($param);

        return redirect()->back()->with('message', 'Sasaran telah ditambahkan');
    }

    public function umumdelete($id)
    {
      $model = new SasaranumumModel;
      $id = decrypt($id);
      $model->delete($id);

      return redirect()->back()->with('message', 'Sasaran telah ditambahkan');
    }

    public function khusus()
    {
      return view('sasaran/khusus');
    }

    public function khususgetdata()
    {
      $model = new SasarankhususModel();
      $idp = session('idp');

      $model->where(['id_penyuluh'=>$idp]);

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="'.site_url('sasaran/umum/delete/'.encrypt($row->id)).'" onclick="return confirm(\'Sasaran khusus akan dihapus?\')" type="button" class="btn btn-sm btn-danger"><i class="ri-delete-bin-5-line"></i></a>';
      })->toJson(true);
    }

    public function khusussave()
    {
      if (! $this->validate([
          'nama' => "required",
          'ketua' => "required",
          'no_hp' => "required",
          'jumlah_jamaah' => "required",
        ])) {
            // return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
            echo 'Harap isi dengan lengkap.';
        }

        $model = new SasarankhususModel;

        $param = [
          'id_penyuluh' => session('idp'),
          'sasaran' => $this->request->getVar('nama'),
          'nama' => $this->request->getVar('nama'),
          'ketua' => $this->request->getVar('jenis'),
          'no_hp' => $this->request->getVar('no_hp'),
          'jumlah_jamaah' => $this->request->getVar('jumlah_jamaah')
        ];

        $model->insert($param);

        return redirect()->back()->with('message', 'Sasaran telah ditambahkan');
    }

    public function khususdelete($id)
    {
      $model = new SasarankhususModel;
      $id = decrypt($id);
      $model->delete($id);

      return redirect()->back()->with('message', 'Sasaran telah ditambahkan');
    }
}
