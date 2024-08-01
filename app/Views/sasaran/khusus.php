<?= $this->extend('template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url()?>assets/libs/datatables/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="<?= base_url()?>assets/libs/datatables/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="<?= base_url()?>assets/libs/datatables/buttons.dataTables.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">
      <h4 class="mb-0">Sasaran Khusus</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Buat Sasaran Khusus Baru</button></li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-centered mb-0" id="sasaran">
            <thead class="table-light">
              <tr>
                <th>Sasaran</th>
                <th>Nama</th>
                <th>Ketua</th>
                <th>Jumlah Anggota</th>
                <th>No HP</th>
                <th></th>
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
                <h5 class="modal-title" id="myModalLabel">Tambah Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
              <form class="" action="<?= site_url('sasaran/khusus/save');?>" method="post" id="addform" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Sasaran</label>
                    <div class="col-md-8">
                      <select class="form-select" name="jenis" id="jenis" required>
                        <option value="Majelis">Majelis</option>
                        <option value="Yayasan">Yayasan</option>
                        <option value="Kelompok">Kelompok</option>
                      </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Nama Sasaran</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="" name="nama" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Nama Ketua</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="" name="ketua" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">No. HP</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="" name="no_hp" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-4 col-form-label">Jumlah Jamaah</label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" value="" name="jumlah_jamaah" required>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="$('#addform').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>

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
<script src="<?= base_url()?>assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/libs/select2/select2.min.js"></script>
<script>
$(document).ready(function() {

var laporanTable = $('#sasaran').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: '<?= site_url('sasaran/khusus/getdata')?>',
          method: 'POST'
      },
      columns: [
            {data: 'sasaran'},
            {data: 'nama'},
            {data: 'ketua'},
            {data: 'jumlah_anggota'},
            {data: 'no_hp'},
            {data: 'action', orderable: false},
        ]
  });

});

function detail(id) {
  $('#detailbody').html('Sedang memuat...');
  $('#detailbody').load('<?= site_url('laporan/detail')?>/'+id);
  $('#detail').modal('show');
}
</script>
<?= $this->endSection() ?>
