<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Hermawan\DataTables\DataTable;
use App\Models\Admin\PenyuluhModel;
use App\Models\CrudModel;
use App\Models\SasarankhususModel;
use App\Models\SasaranumumModel;
use App\Models\KabupatenModel;
use App\Models\DiklatModel;
use App\Models\UnorModel;

class Penyuluh extends BaseController
{
    public function index($agama=false)
    {
        $model = new PenyuluhModel();
        $data['agama'] = ($agama)?$agama:session('agama');
        $data['jpenyuluh'] = $model->jumlahPenyuluh(0);
        $data['jpenyuluhpns'] = $model->jumlahPenyuluh('PNS');
        $data['jpenyuluhpppk'] = $model->jumlahPenyuluh('PPPK');
        $data['jpenyuluhnon'] = $model->jumlahPenyuluh('NON PNS');

        $kabm = new KabupatenModel;
        $data['kabupaten'] = $kabm->where('id_prov',session('kodekelola'))->findAll();

        return view('admin/penyuluh/index', $data);
    }

    public function getdata($kodeagama=0)
    {
      $model = new PenyuluhModel();
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
          return '<a href="'.site_url('admin/penyuluh/detail/'.encrypt($row->id)).'" type="button" target="_blank" class="btn btn-sm btn-primary">Detail</a>';
      })->toJson(true);
    }

    public function detail($id)
    {
      $id = decrypt($id);

      $model = new PenyuluhModel;
      $data['penyuluh'] = $model->find($id);

      $sasus = new SasarankhususModel;
      $data['khusus'] = $sasus->join('tm_sasaran', 'tm_sasaran.id = tr_sasaran_khusus.sasaran')->where(['id_penyuluh'=>$id])->findAll();

      $sasum = new SasaranumumModel;
      $data['umum'] = $sasum->where(['id_penyuluh'=>$id])->findAll();

      $diklat = new DiklatModel;
      $data['diklat'] = $diklat->where(['id_penyuluh'=>$id])->findAll();

      return view('admin/penyuluh/detail', $data);
    }

    public function save()
    {
      // validasi
      if (! $this->validate([
          'nip' => "required|is_unique[penyuluh.nip]",
          'nik' => "required|is_unique[penyuluh.nik]",
          'tmt_awal' => "required",
        ])) {
          return $this->response->setJSON(['status'=>'error','message'=>'Data gagal ditambahkan. Isi dengan lengkap.']);
        }

      $jk = $this->request->getVar('jk');
      $kabupaten = $this->request->getVar('kabupaten');
      $crud = new CrudModel;

      $cekurut = $crud->getlastKab($kabupaten);

      if($cekurut){
        $urutan = $cekurut->urut+1;
      }else{
        $urutan = 1;
      }

      $nipa = $this->gennipa($kabupaten,$urutan,1,$jk);

      $unor = new UnorModel;
      $satker = $unor->find($this->request->getVar('unor'));
      $keterangan = $satker->keterangan;

      $model = new PenyuluhModel;
      $data   = [
        'urut'  => $urutan,
        'nip'  => $this->request->getVar('nip'),
        'nipa'  => $nipa,
        'password'  => $nipa,
        'nik'  => $this->request->getVar('nik'),
        'nama'  => $this->request->getVar('nama'),
        'pangkat'  => $this->request->getVar('pangkat'),
        'golongan'  => $this->request->getVar('golongan'),
        'jabatan'  => $this->request->getVar('jabatan'),
        'tmt_awal'  => $this->request->getVar('tmt_awal'),
        'agama'  => session('agama'),
        'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
        'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
        'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
        'tugas_provinsi'  => session('kodekelola'),
        'tugas_kabupaten'  => $kabupaten,
        'tugas_kecamatan'  => 0,
        'tugas_kua'  => 0,
        'status_pegawai_validasi'  => $this->request->getVar('status_pegawai'),
        'kode_satker'  => $this->request->getVar('unor'),
        'nama_satker'  => $keterangan,
      ];
      $insert = $model->insert($data);

      return $this->response->setJSON(['status'=>'success','message'=>'Data telah ditambahkan.']);
    }

    public function savenon()
    {
      // validasi
      if (! $this->validate([
          'nik' => "required|is_unique[penyuluh.nik]",
          'tmt_awal' => "required",
        ])) {
          return $this->response->setJSON(['status'=>'error','message'=>'Data gagal ditambahkan. Isi dengan lengkap.']);
        }

      $jenis_kelamin = $this->request->getVar('jenis_kelamin');
      if($jenis_kelamin == 'Laki-Laki'){
        $jk = 1;
      }else{
        $jk = 0;
      }
      $kabupaten = $this->request->getVar('kabupaten');
      $crud = new CrudModel;

      $cekurut = $crud->getlastKab($kabupaten);

      if($cekurut){
        $urutan = $cekurut->urut+1;
      }else{
        $urutan = 1;
      }

      $nipa = $this->gennipa($kabupaten,$urutan,0,$jk);

      $unor = new UnorModel;
      $satker = $unor->find($this->request->getVar('unor'));
      $keterangan = $satker->keterangan;

      $model = new PenyuluhModel;
      $data   = [
        'urut'  => $urutan,
        'nipa'  => $nipa,
        'password'  => $nipa,
        'nik'  => $this->request->getVar('nik'),
        'nama'  => $this->request->getVar('nama'),
        'tmt_awal'  => $this->request->getVar('tmt_awal'),
        'agama'  => session('agama'),
        'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
        'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
        'jenis_kelamin'  => $jenis_kelamin,
        'tugas_provinsi'  => substr($kabupaten,2),
        'tugas_kabupaten'  => $kabupaten,
        'tugas_kecamatan'  => 0,
        'tugas_kua'  => 0,
        'status_pegawai_validasi'  => 'Non ASN',
        'kode_satker'  => $this->request->getVar('unor'),
        'nama_satker'  => $keterangan,
      ];
      $insert = $model->insert($data);

      return $this->response->setJSON(['status'=>'success','message'=>'Data telah ditambahkan.']);
    }

    public function export()
    {
      $kode = session('kodekelola');

      $model = new PenyuluhModel;
      $model->where(['agama'=>session('agama')]);
      $model->like('tugas_kabupaten', $kode, 'after');
      $data = $model->findAll();

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

    public function gennipa($kabupaten,$urutan,$pns,$jk)
    {
      $crud = new CrudModel;
      $agama = session('agama');

      $index = '000';
      if(strlen($urutan) == 1){
        $index = '00'.$urutan;
      }else if(strlen($urutan) == 2){
        $index = '0'.$urutan;
      }else{
        $index = $urutan;
      }

      $nipa = $agama.$kabupaten.'000'.$pns.$jk.$index;
      return $nipa;
    }
}
