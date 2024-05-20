<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-xl-12">
        <div class="card overflow-hidden">
            <div class="card-body bg-marketplace d-flex">
                <div class="flex-grow-1">
                    <h4 class="fs-18 lh-base mb-0" id="nama"></h4>
                    <p class="mb-0 mt-2 pt-1 text-muted" id="tugas">Tempat tugas</p>
                    <p class="mb-0 mt-2 pt-1 text-muted">Status Pegawai <span id="statuspegawai" class="text-bold"></span></p>
                    <div class="d-flex gap-3 mt-4">
                        <!-- <a href="<?= site_url('print/drh')?>" target="_blank" class="btn btn-success">Cetak DRH</a> -->
                    </div>
                </div>
                <img src="assets/images/bg-d.png" alt="" class="img-fluid" />
            </div>
        </div>
    </div>
</div>

<div id="profil">
  <div class="row">
    <div class="col-lg-6">
      <div class="card" aria-hidden="true">
        <div class="card-body">
          <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6"></span>
          </h5>
          <p class="card-text placeholder-glow">
            <span class="placeholder col-7"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-6"></span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card" aria-hidden="true">
        <div class="card-body">
          <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6"></span>
          </h5>
          <p class="card-text placeholder-glow">
            <span class="placeholder col-7"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-6"></span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script id="profil-template" type="text/x-handlebars-template">
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
          <table class="table table-borderless mb-0">
              <tbody>
                  <tr>
                      <td class="fw-medium" scope="row">NIK</td>
                      <td id="nik">{{nik}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">NIPA</td>
                      <td id="nipa">{{nipa}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">Nama</td>
                      <td class="nama">{{nama}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">Jenis Kelamin</td>
                      <td class="nama">{{jenis_kelamin}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">Tempat, Tanggal Lahir</td>
                      <td id="ttl">{{tempat_lahir}} {{tanggal_lahir}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">No. HP</td>
                      <td id="nohp">{{no_hp}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">Email</td>
                      <td id="email">{{email}}</td>
                  </tr>
                  <tr>
                      <td class="fw-medium" scope="row">Alamat</td>
                      <td id="alamat">{{alamat}}</td>
                  </tr>
              </tbody>
          </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <table class="table table-borderless">
          <tr>
            <td>Jenjang Pendidikan</td>
            <td>{{pendidikan}}</td>
          </tr>
          <tr>
            <td>Pendidikan</td>
            <td>{{jurusan}}</td>
          </tr>
          <tr>
            <td>Jenis Pendidikan</td>
            <td>{{jenis_pendidikan}}</td>
          </tr>
          <tr>
            <td>Organisasi</td>
            <td>{{organisasi}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script src="<?= base_url()?>assets/js/content/profil.js"></script>
<?= $this->endSection() ?>
