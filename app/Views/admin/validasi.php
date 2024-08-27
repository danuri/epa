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
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jpenyuluhnonasn->jumlah?>">0</span></h4>
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
                      <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Non Penyuluh</p>
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jpenyuluhnon->jumlah?>">0</span></h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="card card-danger">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="flex-grow-1 ms-3">
                      <p class="text-uppercase fw-semibold fs-12 mb-1"> Belum Validasi</p>
                      <h4 class=" mb-0"><span class="counter-value" data-target="<?= $jnonvalid->jumlah?>">0</span></h4>
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
                <a href="<?= site_url('admin/validasi/export')?>" class="btn btn-sm btn-primary">
                  Download Excel
                </a>
              </div>
            </div>
        </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0" id="penyuluh">
            <thead class="table-light">
              <tr>
                <th>NIPA</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Satuan Kerja</th>
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

<div class="modal fade" id="detail" tabindex="-1" data-bs-focus="false" aria-labelledby="detaillabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="detaillabel">Detail Penyuluh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <table class="table table-bordered table-striped">
                    <tbody>
                      <tr>
                        <td>NIPA</td>
                        <td id="tabnipa"></td>
                      </tr>
                      <tr>
                        <td>NAMA</td>
                        <td id="tabnama"></td>
                      </tr>
                      <tr>
                        <td>NIK</td>
                        <td id="tabnik"></td>
                      </tr>
                      <tr>
                        <td>NIP</td>
                        <td id="tabnip"></td>
                      </tr>
                      <tr>
                        <td>TUGAS KUA</td>
                        <td id="tabkua"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-6">
                  <form action="<?= site_url('admin/validasi/save')?>" method="post">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nameInput" class="form-label">Status Pegawai</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-select" name="status_pegawai" id="status_pegawai">
                              <option value="NON ASN">NON ASN</option>
                              <option value="PNS">PNS</option>
                              <option value="PPPK">PPPK</option>
                              <option value="NON PENYULUH">NON PENYULUH</option>
                              <option value="PENSIUN">PENSIUN</option>
                              <option value="MENINGGAL DUNIA">MENINGGAL DUNIA</option>
                            </select>
                            <p>Non Penyuluh adalah Penyuluh yang sudah tidak aktif sebagai penyuluh. Bisa dikarenakan selesai masa kerja atau perubahan status kepegawaian ke jabatan lain selain penyuluh.</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">Keterangan</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea name="keterangan" class="form-control" rows="3" id="keterangan"></textarea>
                            <p>Isi keterangan jika status NON PENYULUH</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">NIK</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="nik" id="nik" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="dateInput" class="form-label">NIP</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="NIP Pegawai" aria-describedby="button-addon2" name="nip" id="nip">
                                <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="searchpegawai()">Cari</button>
                            </div>
                            <p>Isikan jika Penyuluh berstatus PNS/PPPK</p>
                            <input type="hidden" name="id" id="detailid" value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="websiteUrl" class="form-label">Nama</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama" id="nama" value="" disabled>
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
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
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
<script>
$(document).ready(function() {

  $('#agama').on('change', function(event) {
    window.location.replace("<?= site_url('admin/validasi/index') ?>/"+$('#agama').val());
  });

  $('#penyuluh').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '<?= site_url('admin/validasi/getdata/'.$agama)?>',
      method: 'POST'
    },
    columns: [
      {data: 'nipa'},
      {data: 'nik'},
      {data: 'nama'},
      {data: 'status_pegawai_validasi'},
      {data: 'keterangan'},
      {data: 'nama_satker'},
      {data: 'action', orderable: false},
    ]
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
});

function detail(id) {
  // $('#detailbody').html('Sedang memuat...');
  // $('#detailid').val(id);
  // $('#detailbody').load('<?= site_url('admin/validasi/detail')?>/'+id);

  axios.get('<?= site_url('admin/validasi/detail')?>/'+id)
  .then(function (response) {
    $('#tabnipa').html(response.data.nipa);
    $('#tabnama').html(response.data.nama);
    $('#tabnik').html(response.data.nik);
    $('#tabnip').html(response.data.nip);
    $('#tabtugas').html(response.data.nipa);
    $('#detailid').val(response.data.id);

    $('#nik').val(response.data.nik);
    $('#keterangan').val(response.data.keterangan);
    $('#nip').val(response.data.nip);
    $('#status_pegawai').val(response.data.status_pegawai_validasi);
    $('#kode_satker').val(response.data.kode_satker);
    $('#nama_satker').val(response.data.nama_satker);

    if(response.data.kode_satker){
      $('#unor').html('<option value="'+response.data.kode_satker+'" selected="selected">'+response.data.nama_satker+'</option>');
    }


    console.log(response.data);
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .finally(function () {
    // always executed
  });

  $('#detail').modal('show');

}

function searchpegawai() {
  axios.get('<?= site_url() ?>admin/ajax/searchpegawai/'+$('#nip').val())
  .then(function (response) {
    // handle success
    console.log(response.data);
    $('#nama').val(response.data.data.NAMA_LENGKAP);
    $('#unor').html('<option value="'+response.data.data.KODE_SATUAN_KERJA+'" selected="selected">'+response.data.data.KETERANGAN_SATUAN_KERJA+'</option>');
  })
  .catch(function (error) {
    alert('Data tidak ditemukan');
  })
  .finally(function () {
    // always executed
  });
}
</script>
<?= $this->endSection() ?>
