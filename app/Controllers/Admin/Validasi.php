<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Hermawan\DataTables\DataTable;
use App\Models\Admin\ValidasiModel;

class Validasi extends BaseController
{
    public function index($agama=false)
    {
        $model = new ValidasiModel();
        $data['agama'] = ($agama)?$agama:session('agama');
        $data['jpenyuluh'] = $model->jumlahPenyuluh(0);
        $data['jpenyuluhpns'] = $model->jumlahPenyuluh('PNS');
        $data['jpenyuluhpppk'] = $model->jumlahPenyuluh('PPPK');
        $data['jpenyuluhnonasn'] = $model->jumlahPenyuluh('NON ASN');
        $data['jpenyuluhnon'] = $model->jumlahPenyuluh('NON PENYULUH');
        $data['jnonvalid'] = $model->jumlahPenyuluh('non');
        return view('admin/validasi', $data);
    }

    public function getdata($kodeagama=0)
    {
      $model = new ValidasiModel();
      $level = session('level');
      $agama = session('agama');
      $kelola = session('kodekelola');

      if(in_array($level,[2,3])){
        $model->where(['agama'=>$agama]);
      }

      if($level == 4){
        $model->where(['tugas_kabupaten'=>$kelola]);
      }else if($level == 3){
        $model->where(['tugas_provinsi'=>$kelola]);
      }

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="javascript:;" onclick="detail(\''.$row->id.'\')"  type="button" class="btn btn-sm btn-primary">Detail</a>';
      })->toJson(true);
    }

    public function detail($id)
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

        </div>
      </div>

      <?php
    }

    public function export()
    {
      $kode = session('kodekelola');

      $model = new PenyuluhModel;
      $data = $model->like('tugas_kabupaten', $kode, 'after')->findAll();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'NIPA');
      $sheet->setCellValue('B1', 'NIK');
      $sheet->setCellValue('C1', 'NIP');
      $sheet->setCellValue('D1', 'NAMA');
      $sheet->setCellValue('E1', 'PANGKAT');
      $sheet->setCellValue('F1', 'GOLONGAN');
      $sheet->setCellValue('G1', 'JABATAN');
      $sheet->setCellValue('H1', 'TMT_AWAL');
      $sheet->setCellValue('I1', 'AGAMA');
      $sheet->setCellValue('J1', 'TEMPAT_LAHIR');
      $sheet->setCellValue('K1', 'TANGGAL_LAHIR');
      $sheet->setCellValue('L1', 'JENIS_KELAMIN');
      $sheet->setCellValue('M1', 'ALAMAT');
      $sheet->setCellValue('N1', 'TUGAS_PROVINSI');
      $sheet->setCellValue('O1', 'TUGAS_KABUPATEN');
      $sheet->setCellValue('P1', 'TUGAS_KECAMATAN');
      $sheet->setCellValue('Q1', 'TUGAS_KUA');
      $sheet->setCellValue('R1', 'STATUS_PEGAWAI');
      $sheet->setCellValue('S1', 'NO_HP');
      $sheet->setCellValue('T1', 'EMAIL');
      $sheet->setCellValue('U1', 'PENDIDIKAN');
      $sheet->setCellValue('V1', 'JURUSAN');
      $sheet->setCellValue('W1', 'JENIS_PENDIDIKAN');
      $sheet->setCellValue('X1', 'ORGANISASI');
      $sheet->setCellValue('Y1', 'SPESIALISASI_1');
      $sheet->setCellValue('Z1', 'SPESIALISASI_2');
      $sheet->setCellValue('AA1', 'SWAFOTO');
      $sheet->setCellValue('AB1', 'DISABILITAS');

      $i = 2;
      foreach ($data as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nipa,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getCell('B'.$i)->setValueExplicit($row->nik,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getCell('C'.$i)->setValueExplicit($row->nip,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('D'.$i, $row->nama);
        $sheet->setCellValue('E'.$i, $row->pangkat);
        $sheet->setCellValue('F'.$i, $row->golongan);
        $sheet->setCellValue('G'.$i, $row->jabatan);
        $sheet->setCellValue('H'.$i, $row->tmt_awal);
        $sheet->setCellValue('I'.$i, $row->agama);
        $sheet->setCellValue('J'.$i, $row->tempat_lahir);
        $sheet->setCellValue('K'.$i, $row->tanggal_lahir);
        $sheet->setCellValue('L'.$i, $row->jenis_kelamin);
        $sheet->setCellValue('M'.$i, $row->alamat);
        $sheet->setCellValue('N'.$i, $row->tugas_provinsi);
        $sheet->setCellValue('O'.$i, $row->tugas_kabupaten);
        $sheet->setCellValue('P'.$i, $row->tugas_kecamatan);
        $sheet->setCellValue('Q'.$i, $row->tugas_kua);
        $sheet->setCellValue('R'.$i, $row->status_pegawai);
        $sheet->setCellValue('S'.$i, $row->no_hp);
        $sheet->setCellValue('T'.$i, $row->email);
        $sheet->setCellValue('U'.$i, $row->pendidikan);
        $sheet->setCellValue('V'.$i, $row->jurusan);
        $sheet->setCellValue('W'.$i, $row->jenis_pendidikan);
        $sheet->setCellValue('X'.$i, $row->organisasi);
        $sheet->setCellValue('Y'.$i, $row->spesialisasi);
        $sheet->setCellValue('Z'.$i, $row->spesialisasi2);
        $sheet->setCellValue('AA'.$i, $row->swafoto);
        $sheet->setCellValue('AB'.$i, $row->disabilitas);

        $i++;
      }

      $tanggal = date('YmdHis');
      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data Penyuluh'.$tanggal.'.xlsx"');
      $writer->save('php://output');
    }
}
