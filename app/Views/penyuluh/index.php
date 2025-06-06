<?= $this->extend('template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url()?>assets/libs/datatables/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="<?= base_url()?>assets/libs/datatables/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="<?= base_url()?>assets/libs/datatables/buttons.dataTables.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row mb-3 pb-1">
  <div class="col-12">
    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
      <div class="flex-grow-1">
        <h4 class="fs-16 mb-1">Data Penyuluh Agama</h4>
        <!-- <p class="text-muted mb-0">Here's what's happening with your store today.</p> -->
      </div>
      <div class="mt-3 mt-lg-0">
        <form action="javascript:void(0);">
          <div class="row g-3 mb-0 align-items-center">
            <div class="col-sm-auto">
              <select class="form-select" name="statuspegawai" id="statuspegawai">
                <option value="0">Semua Status</option>
                <option value="1">Non ASN</option>
                <option value="2">PNS</option>
                <option value="3">PPPK</option>
              </select>
            </div>

            <div class="col-auto">
              <?php if(session('level') == 1){ ?>
                <select class="form-select" name="agama" id="agama">
                  <option value="0" <?= ($agama == 0)?'selected':''?>>Semua Agama</option>
                  <option value="1" <?= ($agama == 1)?'selected':''?>>Islam</option>
                  <option value="2" <?= ($agama == 2)?'selected':''?>>Kristen</option>
                  <option value="3" <?= ($agama == 3)?'selected':''?>>Katolik</option>
                  <option value="4" <?= ($agama == 4)?'selected':''?>>Buddha</option>
                  <option value="5" <?= ($agama == 5)?'selected':''?>>Hindu</option>
                </select>
              <?php } ?>
            </div>

            <div class="col-auto">
              <!--  -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-3 col-md-6">
      <div class="card">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="flex-grow-1 ms-3">
                      <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Jumlah Penyuluh</p>
                      <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">0</span></h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="card">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="flex-grow-1 ms-3">
                      <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> PNS</p>
                      <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">0</span></h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="card">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="flex-grow-1 ms-3">
                      <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> PPPK</p>
                      <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">0</span></h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="card">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="flex-grow-1 ms-3">
                      <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Non ASN</p>
                      <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">0</span></h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0" id="penyuluh">
            <thead class="table-light">
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Jenis Pendidikan</th>
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
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {

  $('#agama').on('change', function(event) {
    window.location.replace("<?= site_url('penyuluh/index') ?>/"+$('#agama').val());
  });

  $('#penyuluh').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '<?= site_url('penyuluh/getdata/'.$agama)?>',
      method: 'POST'
    },
    columns: [
      {data: 'nik'},
      {data: 'nama'},
      {data: 'status_pegawai'},
      {data: 'jenis_pendidikan'},
      {data: 'action', orderable: false},
    ]
  });
});
</script>
<?= $this->endSection() ?>
