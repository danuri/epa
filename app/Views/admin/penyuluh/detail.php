<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">
      <h4 class="mb-0">Data Penyuluh</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">ePA</a></li>
          <li class="breadcrumb-item active">Data Penyuluh</li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <div class="dropdown float-end">
            <a class="text-body dropdown-toggle font-size-18" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
              <i class="uil uil-ellipsis-v"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">Edit</a>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Remove</a>
            </div>
          </div>
          <div class="clearfix"></div>
          <div>
            <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-lg rounded-circle img-thumbnail">
          </div>
          <h5 class="mt-3 mb-1"><?= $penyuluh->nama?></h5>
          <p class="text-muted"><?= $penyuluh->nipa?></p>

          <div class="mt-4">
            <button type="button" class="btn btn-light btn-sm"><i class="uil uil-envelope-alt me-2"></i> Message</button>
          </div>
        </div>

        <hr class="my-4">

        <div class="table-responsive mt-4">
          <div>
            <p class="mb-1">Nomor Induk Penyuluh Agama :</p>
            <h5 class="font-size-16"><?= $penyuluh->nipa;?></h5>
          </div>
          <div>
            <p class="mb-1">Nama :</p>
            <h5 class="font-size-16"><?= $penyuluh->nama;?></h5>
          </div>
          <div class="mt-4">
            <p class="mb-1">No. HP :</p>
            <h5 class="font-size-16"><?= $penyuluh->no_hp;?></h5>
          </div>
          <div class="mt-4">
            <p class="mb-1">E-mail :</p>
            <h5 class="font-size-16"><?= $penyuluh->email;?></h5>
          </div>
          <div class="mt-4">
            <p class="mb-1">Alamat :</p>
            <h5 class="font-size-16"><?= $penyuluh->alamat;?></h5>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-8">
    <div class="card mb-0">
      <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-success mb-3" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab" aria-selected="false">
                  <i class="ri-home-5-line align-middle me-1"></i> Biodata
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab" aria-selected="false">
                  <i class="ri-user-line me-1 align-middle"></i> Kelompok Sasaran
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false">
                  <i class="ri-question-answer-line align-middle me-1"></i>Pengalaman Diklat
              </a>
          </li>
      </ul>
      <!-- Nav tabs -->
      <!-- Tab content -->
      <div class="tab-content p-4">
        <div class="tab-pane active" id="about" role="tabpanel">
          <div>
            <form class="" action="<?= site_url('profil/saveprofil')?>" method="post">
              <div class="mb-3 row">
                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->nama;?>" name="nama" id="nama" disabled>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nik" class="col-md-2 col-form-label">NIK</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->nik;?>" name="nik" id="nik" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="agama" class="col-md-2 col-form-label">Agama</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= agama($penyuluh->agama);?>" id="agama" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="jk" class="col-md-2 col-form-label">Jenis Kelamin</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->jenis_kelamin;?>" id="jk" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tpl" class="col-md-2 col-form-label">Tempat Lahir</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->tempat_lahir;?>" name="tempat_lahir" id="tpl" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tgl" class="col-md-2 col-form-label">Tanggal Lahir</label>
                <div class="col-md-10">
                  <input class="form-control" type="date" value="<?= $penyuluh->tanggal_lahir;?>" name="tanggal_lahir" id="tgl" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="email" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->email;?>" id="email" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="hp" class="col-md-2 col-form-label">No. HP</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->no_hp;?>" name="no_hp" id="hp" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                <div class="col-md-10">
                  <textarea name="alamat" class="form-control" rows="3" name="alamat" id="alamat" readonly><?= $penyuluh->alamat;?></textarea>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nama" class="col-md-2 col-form-label">Spesialisasi</label>
                <div class="col-md-10">
                  <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Pilih" name="spesialisasi[]" readonly>

                </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nik" class="col-md-2 col-form-label">Pendidikan Terakhir</label>
                <div class="col-md-10">
                  <select class="form-control" name="pendidikan" readonly>
                    <option value="SD" <?= ($penyuluh->pendidikan == 'SD')?'selected':'';?>>SD</option>
                    <option value="SMP" <?= ($penyuluh->pendidikan == 'SMP')?'selected':'';?>>SMP</option>
                    <option value="SMA" <?= ($penyuluh->pendidikan == 'SMA')?'selected':'';?>>SMA</option>
                    <option value="Diploma" <?= ($penyuluh->pendidikan == 'Diploma')?'selected':'';?>>Diploma</option>
                    <option value="S1" <?= ($penyuluh->pendidikan == 'S1')?'selected':'';?>>S1</option>
                    <option value="S2" <?= ($penyuluh->pendidikan == 'S2')?'selected':'';?>>S2</option>
                    <option value="S3" <?= ($penyuluh->pendidikan == 'S3')?'selected':'';?>>S3</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nik" class="col-md-2 col-form-label">Program Studi</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="jurusan" value="<?= $penyuluh->jurusan?>" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="organisasi" class="col-md-2 col-form-label">Organisasi</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" value="<?= $penyuluh->organisasi?>" id="organisasi" name="organisasi" readonly>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="tab-pane" id="tasks" role="tabpanel">
          <div>
            <h5 class="font-size-16 mb-3">Kelompok Sasaran Khusus</h5>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Sasaran</th>
                    <th>Ketua</th>
                    <th>No. HP</th>
                    <th>Jumlah Anggota</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($khusus as $row) {?>
                    <tr>
                      <td><?= $row->nama?></td>
                      <td><?= $row->ketua?></td>
                      <td><?= $row->no_hp?></td>
                      <td><?= $row->jumlah_anggota?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <h5 class="font-size-16 mb-3">Kelompok Sasaran Umum</h5>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Jenis</th>
                    <th>Nama</th>
                    <th>Organisasi Induk</th>
                    <th>Jumlah Anggota</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($umum as $row) {?>
                    <tr>
                      <td><?= $row->jenis?></td>
                      <td><?= $row->nama?></td>
                      <td><?= $row->organisasi_induk?></td>
                      <td><?= $row->jumlah_jamaah?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="messages" role="tabpanel">
          <div>
            <h5 class="font-size-16 mb-4">Diklat</h5>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Tahun</th>
                  <th>Diklat</th>
                  <th>Penyelenggara</th>
                  <th>Jam</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($diklat as $row) {?>
                  <tr>
                    <td><?= $row->tahun?></td>
                    <td><?= $row->nama_diklat?></td>
                    <td><?= $row->lembaga?></td>
                    <td><?= $row->jam?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>
