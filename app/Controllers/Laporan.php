<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use \Hermawan\DataTables\DataTable;
use App\Models\LaporanModel;
use App\Models\PenyuluhModel;
use App\Models\CrudModel;

class Laporan extends BaseController
{
    public function index()
    {
        return view('laporan');
    }

    public function getdata()
    {
      $model = new LaporanModel();
      $idp = session('idp');

      $tahun = $this->request->getVar('tahun');
      $bulan = $this->request->getVar('bulan');

      $tanggal = $tahun.'-'.$bulan;
      $model->where(['id_penyuluh'=>$idp,'category'=>1]);
      $model->like('waktu',$tanggal,'after');

      return DataTable::of($model)
      ->edit('status', function($row){
        return laporan_status($row->status);
      })
      ->add('action', function($row){
        if ($row->status == 0) {
          return '<a href="javascript:;" onclick="detail(\''.$row->id.'\')" type="button" class="btn btn-sm btn-primary">Detail</a> <a href="'.site_url('laporan/delete/'.encrypt($row->id)).'" onclick="return confirm(\'Hapus laporan?\')" type="button" class="btn btn-sm btn-danger">Delete</a>';
        }else{
          return '<a href="javascript:;" onclick="detail(\''.$row->id.'\')" type="button" class="btn btn-sm btn-primary">Detail</a>';
        }
      })->toJson(true);
    }

    public function getdatalain()
    {
      $model = new LaporanModel();
      $idp = session('idp');

      $tahun = $this->request->getVar('tahun');
      $bulan = $this->request->getVar('bulan');

      $model->where(['id_penyuluh'=>$idp,'category'=>2,'waktu_bulan'=>$bulan,'waktu_tahun'=>$tahun]);

      return DataTable::of($model)
      ->edit('status', function($row){
        return laporan_status($row->status);
      })
      ->add('action', function($row){
        if ($row->status == 0) {
          return '<a href="'.site_url('laporan/delete/'.encrypt($row->id)).'" onclick="return confirm(\'Hapus laporan?\')" type="button" class="btn btn-sm btn-danger">Delete</a>';
        }
      })->toJson(true);
    }

    public function save()
    {
      if (! $this->validate([
          'deskripsi' => "required",
          'lokasi' => "required",
          'waktu' => "required",
          'jumlah_jamaah' => "required",
          'publish_link' => "required",
        ])) {
            return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
        }

        if(substr($this->request->getVar('sasaran_id'),0,4) == 'umum'){
          $jenis_sasaran = 'umum';
          $sasaran_id = str_replace('umum','',$this->request->getVar('sasaran_id'));
        }else{
          $jenis_sasaran = 'khusus';
          $sasaran_id = str_replace('khusus','',$this->request->getVar('sasaran_id'));
        }

        $foto = '';

        $param = [
          'id_penyuluh' => session('idp'),
          'nama' => session('nama'),
          'id_materi' => $this->request->getVar('kategori'),
          'nama_materi' => $this->request->getVar('nama_materi'),
          'sasaran_id' => $sasaran_id,
          'sasaran_nama' => $this->request->getVar('sasaran_nama'),
          'jenis_sasaran' => $jenis_sasaran,
          'deskripsi' => $this->request->getVar('deskripsi'),
          'foto' => $foto,
          'publish_link' => $this->request->getVar('publish_link'),
          'lokasi' => $this->request->getVar('lokasi'),
          'waktu' => $this->request->getVar('waktu'),
          'waktu_bulan' => date('n',strtotime($this->request->getVar('waktu'))),
          'waktu_tahun' => date('Y',strtotime($this->request->getVar('waktu'))),
          'jumlah_jamaah' => $this->request->getVar('jumlah_jamaah'),
          // 'materi' => $materi,
          'category' => 1,
          'status' => 0,
          'verifikator' => session('tugas_kabupaten')
        ];

        $model = new LaporanModel();
        $model->insert($param);

        return redirect()->back()->with('message', 'Laporan telah ditambahkan');
    }

    public function savelain()
    {
      if (! $this->validate([
          'judul' => "required",
          'deskripsi' => "required",
          'waktu' => "required",
        ])) {
            return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
        }

        $param = [
          'id_penyuluh' => session('idp'),
          'nama' => session('nama'),
          'judul' => $this->request->getVar('judul'),
          'deskripsi' => $this->request->getVar('deskripsi'),
          'waktu' => $this->request->getVar('waktu'),
          'waktu_bulan' => date('n',strtotime($this->request->getVar('waktu'))),
          'waktu_tahun' => date('Y',strtotime($this->request->getVar('waktu'))),
          'category' => 2,
          'status' => 0,
          'verifikator' => session('tugas_kabupaten')
        ];

        $model = new LaporanModel();
        $model->insert($param);

        return redirect()->back()->with('message', 'Laporan telah ditambahkan');
    }

    public function detail($id)
    {
      $model = new LaporanModel();
      $laporan = $model->find($id);
      ?>
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td>Sasaran</td>
            <td><?= $laporan->sasaran_nama;?></td>
          </tr>
          <tr>
            <td>Materi</td>
            <td><?= $laporan->nama_materi;?></td>
          </tr>
          <tr>
            <td>Deskripsi</td>
            <td><?= $laporan->deskripsi;?></td>
          </tr>
          <tr>
            <td>Sosial Media Publikasi</td>
            <td>
              <?= ($laporan->publish_link == '')?'Tidak ada':'<a href="'.$laporan->publish_link.'" target="_blank">Lihat</a>';  ?>
            </td>
          <!-- </tr>
          <tr>
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
          <!-- <tr>
            <td>Photo Kegiatan</td>
            <td><img src="<?= base_url('uploads/laporan/'.$laporan->foto);?>" class="img-thumbnail"></td>
          </tr> -->
        </tbody>
      </table>
      <?php
    }

    public function delete($id)
    {
      $id = decrypt($id);

      $model = new LaporanModel;
      $model->delete($id);

      return redirect()->back()->with('message', 'Laporan telah dihapus');
    }

    public function rekapitulasi($tahun=false)
    {
      $tahun = ($tahun)?$tahun:date('Y');

      $model = new CrudModel();
      $idp = session('idp');
      $data['laporan'] = $model->getLaporanBulanan($idp,$tahun);
      $data['tahun'] = $tahun;
      return view('laporan_bulanan',$data);
    }

    public function laporanexport($bulan,$tahun)
    {
      $penyuluhmodel = new PenyuluhModel();
      $data['penyuluh'] = $penyuluhmodel->find(session('idp'));

      $model = new CrudModel();
      $data['kua'] = $model->getRow('temp_kua',['id_kua'=>session('tugas')]);

      $lapmodel = new LaporanModel();
      $data['laporans'] = $lapmodel->where(['id_penyuluh'=>session('idp'),'status'=>1,'category'=>1,'waktu_bulan'=>$bulan,'waktu_tahun'=>$tahun])->findAll();
      $data['lains'] = $lapmodel->where(['id_penyuluh'=>session('idp'),'status'=>1,'category'=>2,'waktu_bulan'=>$bulan,'waktu_tahun'=>$tahun])->findAll();
      // return view('laporan/pdf_view',$data);
      $filename = date('y-m-d-H-i-s'). '-laporan-view';
      $dompdf = new Dompdf();
      $dompdf->loadHtml(view('laporan/pdf_view',$data));
      $dompdf->render();
      $dompdf->stream($filename);
    }

    public function laporanexportx($bulan,$tahun)
    {

      $idp = session('idp');

      $model = new CrudModel();
      $kua = $model->getResult('temp_kua',['id_kua'=>session('tugas')]);

      $lapmodel = new LaporanModel();
      $laporans = $lapmodel->where(['id_penyuluh'=>session('idp'),'status'=>1,'category'=>1,'waktu_bulan'=>$bulan,'waktu_tahun'=>$tahun])->findAll();
      $lains = $lapmodel->where(['id_penyuluh'=>session('idp'),'status'=>1,'category'=>2,'waktu_bulan'=>$bulan,'waktu_tahun'=>$tahun])->findAll();

      // $lains = $this->db->query("SELECT * FROM v_laporanlain WHERE id_penyuluh='$idp' AND waktu LIKE '$waktu%' AND status='1'")->result();

      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH.'assets/template_laporan_bulan.docx');

      $templateProcessor->cloneRow('no', count($laporans));
      $templateProcessor->cloneRow('nob', count($lains));

      $no = 1;
      // $bulan = $this->crud->get_row('tm_bulan', array('id'=>$bulan));

      $templateProcessor->setValue('bulan', strtoupper(mtobulans($bulan)));
      $templateProcessor->setValue('tahun', $tahun);

      $templateProcessor->setValue('nama', session('nama'));
      $templateProcessor->setValue('nip', session('nip'));
      $templateProcessor->setValue('nipa', session('nipa'));
      $templateProcessor->setValue('provinsi', $kua->provinsi);
      $templateProcessor->setValue('kabupaten', $kua->kabupaten);
      $templateProcessor->setValue('kecamatan', $kua->kecamatan);
      $templateProcessor->setValue('kua', $kua->kua);

      foreach ($laporans as $row) {
        $templateProcessor->setValue('no#'.$no, $no);
        $templateProcessor->setValue('tanggal#'.$no, $row->waktu);
        $templateProcessor->setValue('kelompok#'.$no, htmlspecialchars($row->sasaran_nama));
        $templateProcessor->setValue('jamaah#'.$no, $row->jumlah_jamaah);
        $templateProcessor->setValue('tema#'.$no, $row->nama_materi);
        $templateProcessor->setValue('keterangan#'.$no, '');

        $no++;
      }

      $no = 1;
      foreach ($lains as $row) {

        $deskripsi = strip_tags($row->deskripsi);
        $deskripsi = html_entity_decode($deskripsi);
        $deskripsi = str_replace('&', '&amp;', $deskripsi);

        // $deskripsi = str_replace('&nbsp;','',$deskripsi);
        $templateProcessor->setValue('nob#'.$no, $no);
        $templateProcessor->setValue('tanggalb#'.$no, $row->waktu);
        $templateProcessor->setValue('judul#'.$no, $row->judul);
        $templateProcessor->setValue('deskripsi#'.$no, $deskripsi);

        $no++;
      }

      $filename = 'laporan'.session('nipa').'-'.$bulan.'-'.$tahun.'.docx';

      $templateProcessor->saveAs('uploads/'.$filename);
    }

    public function lain()
    {
      return view('laporan/lain');
    }
}
