<?= $this->extend('template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">
      <h4 class="mb-0">Laporan Kegiatan</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Buat Laporan Baru</button></li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <select class="form-select" id="bulan">
                  <?php foreach (bulans() as $key => $value) {
                    $select = (date('m') == $key)?'selected':'';
                    echo '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
                  } ?>
                </select>
              </div>
              <div class="col-sm-6 col-lg-3">
                <select class="form-select" id="tahun">
                  <?php for ($i=2022; $i <= date('Y'); $i++) {
                    $select = (date('Y') == $i)?'selected':'';
                    echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
                  } ?>
                </select>
              </div>
            </div>
          </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="datatable">
            <thead>
              <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
                <th>EXPORT</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($laporan as $row) {?>
                <tr>
                  <td><?= $no;?></td>
                  <td><?= mtobulan($row->created_month).' - '.$row->created_year;?></td>
                  <td><?= $row->jumlah;?></td>
                  <td><a href="<?= site_url('laporan/export/'.$row->created_month.'/'.$row->created_year);?>" class="btn btn-success" target="_blank">Download</a></td>
                </tr>
              <?php $no++;} ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {

var laporanTable = $('#laporan').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: '<?= site_url('laporan/getdata')?>',
          method: 'POST',
          data: function (d) {
                d.tahun = $('#tahun').val();
                d.bulan = $('#bulan').val();
          }
      },
      columns: [
            {data: 'waktu'},
            {data: 'status'},
            {data: 'nama_materi'},
            {data: 'judul'},
            {data: 'action', orderable: false},
        ]
  });

  $('#tahun').change(function(event) {
        laporanTable.ajax.reload();
  });
  $('#bulan').change(function(event) {
        laporanTable.ajax.reload();
  });

  $.getJSON('<?= site_url(); ?>ajax/getsasaranpenyuluh', function(datasasaran) {
    $("#sasaran_id").select2({
      data: datasasaran
    });
  });

  $.getJSON('<?= site_url(); ?>ajax/getmateriopsi', function(data) {
    $("#kategori").select2({
      data: data
    });
  });
});

function detail(id) {
  $('#detailbody').html('Sedang memuat...');

  $('#detailbody').load('<?= site_url('laporan/detail')?>/'+id);

  $('#detail').modal('show');
}
</script>
<?= $this->endSection() ?>
