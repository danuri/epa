<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">
      <h4 class="mb-0">Tambah Data Penyuluh</h4>

      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">ePA</a></li>
          <li class="breadcrumb-item active">Data Penyuluh</li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <form action="">
    <div class="card">
      <div class="card-body">
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="status" class="form-label">Status Pegawai</label>
              </div>
              <div class="col-lg-9">
                  <select class="form-select" name="statuspegawai" id="statuspegawai">
                    <option value="1">Non ASN</option>
                    <option value="2">PNS</option>
                    <option value="3">PPPK</option>
                  </select>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="nameInput" class="form-label">Kabupaten Tugas</label>
              </div>
              <div class="col-lg-9">
                  <select class="form-select" name="kabupaten">
                    <?php foreach ($kabupaten as $row) {
                      echo '<option value="'.$row->id_kab.'">'.$row->kabupaten.'</option>';
                    } ?>
                  </select>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-lg-3">
                  <label for="websiteUrl" class="form-label">Satuan Kerja</label>
              </div>
              <div class="col-lg-9">
                <select class="form-select" name="unor" id="unor">
                </select>
              </div>
          </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="dateInput" class="form-label">NIP (Jika ASN)</label>
            </div>
            <div class="col-lg-9">
              <div class="input-group">
                  <input type="text" class="form-control" aria-label="NIP Pegawai" aria-describedby="button-addon2" name="nip" id="nip">
                  <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="searchpegawai()">Cari</button>
              </div>
              <p>Isikan jika Penyuluh berstatus PNS/PPPK</p>
            </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="nameInput" class="form-label">Nama</label>
        </div>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="nama" id="nama">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="websiteUrl" class="form-label">NIK</label>
        </div>
        <div class="col-lg-9">
            <input type="url" class="form-control" id="nik" name="nik">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="timeInput" class="form-label">Time</label>
        </div>
        <div class="col-lg-9">
            <input type="time" class="form-control" id="timeInput">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="leaveemails" class="form-label">Email Id</label>
        </div>
        <div class="col-lg-9">
            <input type="email" class="form-control" id="leaveemails" placeholder="Enter your email">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="contactNumber" class="form-label">Contact Number</label>
        </div>
        <div class="col-lg-9">
            <input type="number" class="form-control" id="contactNumber" placeholder="+91 9876543210">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="meassageInput" class="form-label">Message</label>
        </div>
        <div class="col-lg-9">
            <textarea class="form-control" id="meassageInput" rows="3" placeholder="Enter your message"></textarea>
        </div>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Add Leave</button>
    </div>
      </div>
    </div>
  </form>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
  $(document).ready(function() {
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

</script>
<?= $this->endSection() ?>
