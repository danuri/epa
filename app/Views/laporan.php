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
          <table class="table table-centered table-nowrap mb-0" id="laporan">
            <thead class="table-light">
              <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>View Details</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Buat Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
              <form class="" action="<?= site_url('laporan/save');?>" method="post" id="addform" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Kelompok Sasaran</label>
                    <div class="col-md-8">
                      <select class="form-select" name="sasaran_id" id="sasaran_id" required>
                      </select>
                      <input type="hidden" name="sasaran_nama" id="sasaran_nama" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Tema Materi</label>
                    <div class="col-md-8">
                      <select class="form-select" name="kategori" id="kategori" required>

                      </select>
                      <input type="hidden" name="nama_materi" id="nama_materi" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Deskripsi Singkat</label>
                    <div class="col-md-8">
                      <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Lokasi</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="" name="lokasi" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Tanggal Kegiatan</label>
                    <div class="col-md-8">
                      <input type="date" class="form-control" name="waktu" id="datepicker" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Jumlah Jamaah</label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" value="" name="jumlah_jamaah" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Photo Kegiatan</label>
                    <div class="col-md-8">
                        <input class="form-control" type="file" value="" name="foto">
                        <p class="help-block">File type: jpg,jpeg atau png, Maksimum: 500kb</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Link Sosial Media</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="" name="publish_link">
                        <p>Sertakan Link konten kegiatan yang dibagikan ke sosial media</p>
                    </div>
                </div>
                <!-- <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Naskah Materi</label>
                    <div class="col-md-8">
                        <input class="form-control" type="file" value="" name="materi">
                        <p class="help-block">File type: PDF, Maksimum: 5mb</p>
                        <div class="alert alert-primary" role="alert">
                            Pastikan tipe file yang diunggah adalah pdf. Penulisan materi sesuai format yang ditentukan oleh admin kabupaten/kota. Laporan Anda mungkin akan ditolak jika dianggap tidak sesuai.
                        </div>
                    </div>
                </div> -->
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#addform').submit()">Save Changes</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detaillabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="detaillabel">Detail Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="detailbody">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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

  $('#sasaran_id').on('change', function(event) {
    $('#sasaran_nama').val($("#sasaran_id option:selected" ).text());
  });

  $('#kategori').on('change', function(event) {
    $('#nama_materi').val($("#kategori option:selected" ).text());
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
