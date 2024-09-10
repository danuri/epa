<?= $this->extend('admin/template') ?>

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
              <!-- <select class="form-select" name="statuspegawai" id="statuspegawai">
                <option value="0">Semua Status</option>
                <option value="1">Non ASN</option>
                <option value="2">PNS</option>
                <option value="3">PPPK</option>
              </select> -->
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
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jpenyuluh->jumlah?>">0</span></h4>
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
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jpenyuluhpns->jumlah?>">0</span></h4>
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
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jpenyuluhpppk->jumlah?>">0</span></h4>
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
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jpenyuluhnon->jumlah?>">0</span></h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Data Penyuluh Agama</h4>
            <div class="float-end">
              <div class="dropdown">
                <a href="<?= site_url('admin/penyuluh/export')?>" class="btn btn-sm btn-primary">
                  Download Excel
                </a>
                <div class="btn-group">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tambah Data Penyuluh
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:;" onclick="addAsn()">ASN</a>
                        <a class="dropdown-item" href="javascript:;" onclick="addNon()">Non ASN</a>
                    </div>
                </div>
              </div>
            </div>
        </div>
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

<div class="modal fade" id="addNon" tabindex="-1" data-bs-focus="false" aria-labelledby="detaillabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title h4" id="detaillabel">Tambah Data Penyuluh Non ASN</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form action="<?= site_url('admin/penyuluh/savenon')?>" method="post" id="savenon">
                <div class="col-12">
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="websiteUrl" class="form-label">NIK</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="number" class="form-control" name="nik" value="" required>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="websiteUrl" class="form-label">Nama</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="nama" value="" required>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="websiteUrl" class="form-label">Jenis Kelamin</label>
                      </div>
                      <div class="col-lg-9">
                          <select class="form-select" name="jenis_kelamin">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="websiteUrl" class="form-label">Tempat Lahir</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="tempat_lahir" value="">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="websiteUrl" class="form-label">Tanggal Lahir</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="date" class="form-control" name="tanggal_lahir" value="">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="websiteUrl" class="form-label">TMT Awal</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="date" class="form-control" name="tmt_awal" value="">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="dateInput" class="form-label">Satuan Kerja</label>
                      </div>
                      <div class="col-lg-9">
                        <select class="form-select" name="unor" id="unor">
                        </select>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="dateInput" class="form-label">Kabupaten</label>
                      </div>
                      <div class="col-lg-9">
                        <select class="form-select" name="kabupaten">
                          <?php foreach ($kabupaten as $row) {
                            echo '<option value="'.$row->id_kab.'">'.$row->kabupaten.'</option>';
                          } ?>
                        </select>
                      </div>
                  </div>
                </div>
            </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" onclick="$('#savenon').submit()">Simpan</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="addAsn" tabindex="-1" data-bs-focus="false" aria-labelledby="detaillabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="detaillabel">Tambah Data Penyuluh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <form action="<?= site_url('admin/penyuluh/save')?>" method="post" id="saveasn">
                  <div class="col-12">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="dateInput" class="form-label">NIP</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="NIP Pegawai" aria-describedby="button-addon2" name="nip" id="nip2">
                                <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="searchpegawai()">Cari</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nameInput" class="form-label">Status Pegawai</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-select" name="status_pegawai" id="status_pegawai2">
                              <option value="PNS">PNS</option>
                              <option value="PPPK">PPPK</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">NIK</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="nik" id="nik2" value="" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">Nama</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama" id="nama2" value="" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-select" name="jenis_kelamin" id="jenis_kelamin2">
                              <option value="Laki-Laki">Laki-Laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                            <input type="hidden" name="jk" id="jk2" value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">pangkat/Golongan</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="pangkat" id="pangkat2" value="" readonly>
                        </div>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="golongan" id="golongan2" value="" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">Jabatan</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="jabatan" id="jabatan2" value="" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">TMT Awal</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" class="form-control" name="tmt_awal" id="tmt_awal2" value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="dateInput" class="form-label">Satuan Kerja</label>
                        </div>
                        <div class="col-lg-9">
                          <select class="form-select" name="unor" id="unor2">
                          </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="dateInput" class="form-label">Kabupaten</label>
                        </div>
                        <div class="col-lg-9">
                          <select class="form-select" name="kabupaten" id="kabupaten2">
                            <?php foreach ($kabupaten as $row) {
                              echo '<option value="'.$row->id_kab.'">'.$row->kabupaten.'</option>';
                            } ?>
                          </select>
                          <input type="hidden" name="tanggal_lahir" id="tanggal_lahir2" value="">
                          <input type="hidden" name="tempat_lahir" id="tempat_lahir2" value="">
                        </div>
                    </div>
                  </div>
              </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="$('#saveasn').submit()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url()?>assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/js/axios.min.js"></script>
<script src="<?= base_url()?>assets/js/jquery.form.js"></script>
<script>
$(document).ready(function() {

  $('#agama').on('change', function(event) {
    window.location.replace("<?= site_url('admin/penyuluh/index') ?>/"+$('#agama').val());
  });

  var table = new DataTable('#penyuluh', {
    processing: true,
    serverSide: true,
    ajax: {
      url: '<?= site_url('admin/penyuluh/getdata/'.$agama)?>',
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

  $('#unor2').select2({
    ajax: {
      url: '<?= site_url() ?>admin/ajax/searchunor/',
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public'
        }

        return query;
      },
      processResults: function (data) {
        return {
          results: data
        };
      },
      processResults: (data, params) => {
          const results = data.map(item => {
            return {
              id: item.kode_satker,
              text: item.keterangan,
            };
          });
          return {
            results: results,
          }
        },
    },
    placeholder: 'Cari Satuan Kerja',
    minimumInputLength: 5,
  });

  $('#unor').select2({
    ajax: {
      url: '<?= site_url() ?>admin/ajax/searchunor/',
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public'
        }

        return query;
      },
      processResults: function (data) {
        return {
          results: data
        };
      },
      processResults: (data, params) => {
          const results = data.map(item => {
            return {
              id: item.kode_satker,
              text: item.keterangan,
            };
          });
          return {
            results: results,
          }
        },
    },
    placeholder: 'Cari Satuan Kerja',
    minimumInputLength: 5,
  });

  $('#saveasn').submit(function() {
      loader();
      $(this).ajaxSubmit({
        success: function(responseText, statusText, xhr, $form){
          alert(responseText.message);
          if(responseText.status == 'success'){
              table.ajax.reload(null, false);
              $("#loverlay").fadeOut(300);
              $('#addAsn').modal('hide');
          }
        }
      });
      return false;
  });

  $('#savenon').submit(function() {
      $(this).ajaxSubmit({
        success: function(responseText, statusText, xhr, $form){
          alert(responseText.message);
          if(responseText.status == 'success'){
              table.ajax.reload(null, false);
              $("#loverlay").fadeOut(300);
              $('#addAsn').modal('hide');
          }
        }
      });
      return false;
  });
});

function searchpegawai() {
  axios.get('<?= site_url() ?>admin/ajax/searchpegawai/'+$('#nip2').val())
  .then(function (response) {
    // handle success
    console.log(response.data);
    $('#nama2').val(response.data.data.NAMA_LENGKAP);
    $('#unor2').html('<option value="'+response.data.data.KODE_SATUAN_KERJA+'" selected="selected">'+response.data.data.KETERANGAN_SATUAN_KERJA+'</option>');
    $('#pangkat2').val(response.data.data.PANGKAT);
    $('#golongan2').val(response.data.data.GOL_RUANG);
    $('#jabatan2').val(response.data.data.TAMPIL_JABATAN);
    $('#tempat_lahir2').val(response.data.data.TEMPAT_LAHIR);
    $('#tanggal_lahir2').val(response.data.data.TANGGAL_LAHIR);
    $('#jk2').val(response.data.data.JENIS_KELAMIN);

    if(response.data.data.JENIS_KELAMIN == '1'){
      $('#jenis_kelamin2').val('Laki-Laki');
    }else{
      $('#jenis_kelamin2').val('Perempuan');
    }
  })
  .catch(function (error) {
    alert('Data tidak ditemukan');
  })
  .finally(function () {
    // always executed
  });
}

function addNon() {
  $('#addNon').modal('show');
}

function addAsn() {
  $('#addAsn').modal('show');
}
</script>
<?= $this->endSection() ?>
