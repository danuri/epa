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
      <h4 class="mb-0">Download Materi</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">

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
          <table class="table table-nowrap table-centered align-middle">
            <thead class="table-light">
              <tr>
                <tr>
                  <th>Tanggal</th>
                  <th>Dokumen</th>
                  <th>Download</th>
                </tr>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($downloads as $row) {?>
                <tr>
                  <td><?= $row->created_at;?></td>
                  <td><?= '<b>'.$row->nama.'</b>'.'<br>'.$row->keterangan;?></td>
                  <td><a href="<?= base_url('uploads/dokumen/'.$row->lampiran);?>" onclick="viewer(<?= $row->id;?>)" class="btn btn-primary" target="_blank">Lihat</a></td>
                </tr>
              <?php } ?>
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

  var laporanTable = $('#laporan').DataTable();
});
</script>
<?= $this->endSection() ?>
