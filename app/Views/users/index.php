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
      <h4 class="mb-0">Pengguna</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">ePA</a></li>
          <li class="breadcrumb-item active">Data Pengguna</li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <div class="float-end">
          <div class="dropdown">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
              Tambah Pengguna
            </button>
          </div>
        </div>
        <h4 class="card-title">Data Pengguna</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0" id="penyuluh">
            <thead class="table-light">
              <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Kelola</th>
                <th>Aksi</th>
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

<div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
              <form action="users/save" method="post">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="nip" class="form-label">NIP</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan NIP">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="nama" class="form-label">Nama</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pengguna">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="kelola" class="form-label">Wilayah Kelola</label>
                    </div>
                    <div class="col-lg-9">
                        <select id="kabupaten" name="kelola">
                        </select>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.responsive.min.js"></script>

<script src="<?= base_url()?>assets/js/custom.js"></script>
<script>
$(document).ready(function() {

$('#penyuluh').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: '<?= site_url('users/getdata')?>',
          method: 'POST'
      },
      columns: [
            {data: 'nip'},
            {data: 'nama'},
            {data: 'kelola'},
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
