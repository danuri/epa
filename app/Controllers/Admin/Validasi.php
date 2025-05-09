<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Hermawan\DataTables\DataTable;
use App\Models\Admin\ValidasiModel;
use App\Models\UnorModel;

class Validasi extends BaseController
{
    public function index($agama=false)
    {
        $model = new ValidasiModel();
        $data['agama'] = ($agama)?$agama:session('agama');
        $data['jpenyuluh'] = $model->jumlahPenyuluh(0);
        $data['jnonvalid'] = $model->jumlahPenyuluh('non');
        return view('admin/verifikasi', $data);
    }

    public function getdata($kodeagama=0)
    {
      $model = new ValidasiModel();
      $level = session('level');
      $agama = session('agama');
      $kelola = session('kodekelola');

      $model->where(['is_verif'=>1]);

      // if(in_array($level,[2,3,4])){
      //   $model->where(['agama'=>$agama]);
      // }

      if($level == 4){
        $model->where(['tugas_kabupaten'=>$kelola]);
      }else if($level == 3){
        $model->where(['tugas_provinsi'=>$kelola]);
      }

      return DataTable::of($model)
      ->add('action', function($row){
          return '<div class="btn-group"><button class="btn btn-light btn-sm" type="button">'.$row->hasil_verifikasi.'</button>
                <button type="button" class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="'.site_url('admin/validasi/status/'.encrypt($row->id).'/1').'">Aktif</a>
                    <a class="dropdown-item" href="'.site_url('admin/validasi/status/'.encrypt($row->id).'/0').'" onclick="">Non Aktif</a>
                </div></div>';
      })->toJson(true);
    }

    public function detail($id)
    {
      $id = decrypt($id);

      $model = new ValidasiModel;
      $penyuluh = $model->find($id);

      return $this->response->setJSON($penyuluh);
    }

    public function detailx($id)
    {
      $id = decrypt($id);

      $model = new ValidasiModel;
      $penyuluh = $model->find($id);
      ?>
      <div class="row">
        <div class="col-6">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td>Foto</td>
                <td><img src="<?= base_url('uploads/laporan/'.$penyuluh->swafoto);?>" class="img-thumbnail"></td>
              </tr>
              <tr>
                <td>NIPA</td>
                <td><?= $penyuluh->nipa;?></td>
              </tr>
              <tr>
                <td>NAMA</td>
                <td><?= $penyuluh->nama;?></td>
              </tr>
              <tr>
                <td>NIK</td>
                <td><?= $penyuluh->nik;?></td>
              </tr>
              <tr>
                <td>NIP</td>
                <td><?= $penyuluh->nip;?></td>
              </tr>
              <tr>
                <td>TUGAS KUA</td>
                <td><?= $penyuluh->tugas_kua_nama;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-6">
          <form action="<?= site_url('admin/validasi/save')?>" method="post">
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="nameInput" class="form-label">Status Pegawai</label>
                </div>
                <div class="col-lg-9">
                    <select class="form-select" name="status_pegawai">
                      <option value="NON ASN">NON ASN</option>
                      <option value="PNS">PNS</option>
                      <option value="PPPK">PPPK</option>
                      <option value="NON PENYULUH">NON PENYULUH</option>
                    </select>
                    <p>Non Penyuluh adalah Penyuluh yang sudah tidak aktif sebagai penyuluh. Bisa dikarenakan selesai masa kerja atau perubahan status kepegawaian ke jabatan lain selain penyuluh.</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="websiteUrl" class="form-label">NIK</label>
                </div>
                <div class="col-lg-9">
                    <input type="number" class="form-control" name="nik" id="nik" value="<?= $penyuluh->nik;?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="dateInput" class="form-label">NIP</label>
                </div>
                <div class="col-lg-9">
                    <!-- <input type="number" name="nip" class="form-control" id="nip" value="<?= $penyuluh->nip;?>"> -->
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="NIP Pegawai" aria-describedby="button-addon2" name="nip" id="nip" value="<?= $penyuluh->nip;?>">
                        <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="searchpegawai()">Cari</button>
                    </div>
                    <p>Isikan jika Penyuluh berstatus PNS/PPPK</p>
                    <input type="hidden" name="id" value="<?= $penyuluh->id?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <label for="dateInput" class="form-label">Satuan Kerja</label>
                </div>
                <div class="col-lg-9">
                  <select class="form-select" name="unor" id="unor">
                  </select>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
      </div>

      <?php
    }

    public function save()
    {
      if (! $this->validate([
          'status_pegawai' => "required",
          'nik' => "required",
        ])) {
            return redirect()->back()->with('message', 'Harap isi semua.');
        }

      $model = new ValidasiModel;
      $unor = new UnorModel;

      if($this->request->getVar('unor')){
        $satker = $unor->find($this->request->getVar('unor'));
        $keterangan = $satker->keterangan;
      }else{
        $keterangan = '';
      }

      $param = [
        'status_pegawai_validasi' => $this->request->getVar('status_pegawai'),
        'nik' => $this->request->getVar('nik'),
        'nip' => $this->request->getVar('nip'),
        'keterangan' => $this->request->getVar('keterangan'),
        'kode_satker' => $this->request->getVar('unor'),
        'nama_satker' => $keterangan,
      ];

      $id = $this->request->getVar('id');

      $update = $model->update($id,$param);

      return redirect()->back()->with('message', 'Data telah diupdate');
    }

    function setstatus($id,$status) {
      $model = new ValidasiModel;

      $id = decrypt($id);
      $status = ($status == 1)?'Aktif':'Non Aktif';
      $model->update($id, ['hasil_verifikasi'=>$status]);

      return redirect()->back()->with('message', 'Status telah diupdate');
    }

    public function export()
    {
      $kode = session('kodekelola');

      $model = new ValidasiModel;
      $model->where(['agama'=>session('agama')]);
      $model->like('tugas_kabupaten', $kode, 'after');
      $data = $model->findAll();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'NIPA');
      $sheet->setCellValue('B1', 'NIK');
      $sheet->setCellValue('C1', 'NIP');
      $sheet->setCellValue('D1', 'NAMA');
      $sheet->setCellValue('E1', 'TUGAS_PROVINSI');
      $sheet->setCellValue('F1', 'TUGAS_KABUPATEN');
      $sheet->setCellValue('G1', 'TUGAS_KECAMATAN');
      $sheet->setCellValue('H1', 'TUGAS_KUA');
      $sheet->setCellValue('I1', 'STATUS_PEGAWAI');
      $sheet->setCellValue('J1', 'TEMPAT_TUGAS_FINAL');

      $i = 2;
      foreach ($data as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nipa,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getCell('B'.$i)->setValueExplicit($row->nik,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getCell('C'.$i)->setValueExplicit($row->nip,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('D'.$i, $row->nama);
        $sheet->setCellValue('E'.$i, $row->tugas_provinsi_nama);
        $sheet->setCellValue('F'.$i, $row->tugas_kabupaten_nama);
        $sheet->setCellValue('G'.$i, $row->tugas_kecamatan_nama);
        $sheet->setCellValue('H'.$i, $row->tugas_kua_nama);
        $sheet->setCellValue('I'.$i, $row->status_pegawai_validasi);
        $sheet->setCellValue('J'.$i, $row->nama_satker);

        $i++;
      }

      $tanggal = date('YmdHis');
      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data Validasi Penyuluh'.$tanggal.'.xlsx"');
      $writer->save('php://output');
    }
}
