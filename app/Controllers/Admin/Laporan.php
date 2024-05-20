<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    public function index()
    {
        return view('penyuluh/laporan');
    }

    public function getdata()
    {
      $model = new LaporanModel();
      $level = session('level');
      $agama = session('agama');
      $kelola = session('kodekelola');

      // if($level == 2){
      //   $model->where(['status'=>0]);
      // }else{
      //   $model->where(['status'=>0]);
      // }

      if($kelola > 0){
        $model->like('tugas_id', $kelola, 'after');
      }

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="javascript:;" onclick="detail(\''.$row->id.'\')" type="button" class="btn btn-sm btn-primary">Detail</a>';
      })->toJson(true);
    }

    public function detail($id)
    {
      $model = new LaporanModel();
      $laporan = $model->find($id);
      ?>
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td>Deskripsi</td>
            <td><?= $laporan->deskripsi;?></td>
          </tr>
          <tr>
            <td>Sosial Media Publikasi</td>
            <td>
              <?= ($laporan->publish_link == '')?'Tidak ada':'<a href="'.$laporan->publish_link.'" target="_blank">Lihat</a>';  ?>
            </td>
          </tr>
          <!-- <tr>
            <td>Lampiran Materi</td>
            <td>
              <a href="<?= base_url('uploads/laporan/'.$laporan->materi);?>" target="_blank">Lihat</a>
              <object data="<?= base_url('uploads/laporan/'.$laporan->materi);?>" type="application/pdf" width="100%" style="height: 80vh;" id="object">'+
                <p>Browser tidak mendukung!</p>
              </object>
            </td>
          </tr> -->
          <tr>
            <td>Tanggal</td>
            <td><?= $laporan->waktu;?></td>
          </tr>
          <tr>
            <td>Lokasi</td>
            <td><?= $laporan->lokasi;?></td>
          </tr>
          <tr>
            <td>Jumlah Jamaah</td>
            <td><?= $laporan->jumlah_jamaah;?></td>
          </tr>
          <tr>
            <td>Photo Kegiatan</td>
            <td><img src="<?= base_url('uploads/laporan/'.$laporan->foto);?>" class="img-thumbnail"></td>
          </tr>
        </tbody>
      </table>
      <?php
    }

    public function terima($id)
    {
      $model = new LaporanModel();
      $update = $model->update($id,['status'=>1]);
      return $this->response->setJSON(['status'=>'ok']);
    }

    public function tolak()
    {
      $model = new LaporanModel();

      $id = $this->request->getVar('id');
      $info = $this->request->getVar('info');

      $update = $model->update($id,['status'=>2,'info_verifikator'=>$info]);
      return $this->response->setJSON(['status'=>'ok']);
    }
}
