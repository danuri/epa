<?= $this->extend('admin/template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link href="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0">Laporan Penyuluhan</h4>

      <div class="page-title-right">
      <ol class="breadcrumb m-0">
          <li class="breadcrumb-item">
            <select class="form-select filter" id="tahun">
              <?php
              for ($i=2020; $i <= date('Y'); $i++) {
                $select = ($tahun == $i)?'selected':'';
                echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
              }
              ?>
            </select>
          </li>
        <li><select class="form-select filter" name="" id="bulan">
          <?php
          $bulans = bulans();
          foreach ($bulans as $key => $value) {
            $select = ($bulan == $key)?'selected':'';
            echo '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
          }
          ?>
        </select></li>
        <li>

        <select class="form-select filter" name="" id="statusx">
          <option value="1">Dikirim</option>
          <option value="2">Diterima</option>
          <option value="3">Ditolak</option>
        </select>

        </li>
        </ol>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <table class="table table-centered table-bordered table-nowrap mb-0" id="laporan">
          <thead class="table-light">
            <tr>
              <th>id</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Status</th>
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

<div class="modal fade" id="detail" tabindex="-1" data-bs-focus="false" aria-labelledby="detaillabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="detaillabel">Detail Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="detailbody">

              </div>
              <input type="hidden" id="detailid" name="" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" onclick="terima()">Terima</button>
                <button type="button" class="btn btn-danger" onclick="tolak()">Tolak</button>
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
<script src="https://d2mj1s7x3czrue.cloudfront.net/hrms/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script>
$(document).ready(function() {
var laporanTable = $('#laporan').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '<?= site_url('admin/laporan/getdata')?>',
        method: 'POST',
        data: function (d) {
              d.tahun = $('#tahun').val(),
              d.bulan = $('#bulan').val();
              d.status = $('#statusx').val();
        }
      },
      columns: [
            {data: 'id'},
            {data: 'nama'},
            {data: 'waktu'},
            {data: 'deskripsi'},
            {data: 'status'},
            {data: 'action', orderable: false},
        ]
  });

  $('#tahun').change(function(event) {
        laporanTable.ajax.reload();
    });

  $('#bulan').change(function(event) {
        laporanTable.ajax.reload();
    });

  $('#statusx').change(function(event) {
        laporanTable.ajax.reload();
    });
});

function detail(id) {
  $('#detailbody').html('Sedang memuat...');
  $('#detailid').val(id);
  $('#detailbody').load('<?= site_url('admin/laporan/detail')?>/'+id);

  $('#detail').modal('show');
}

function terima() {
  id = $('#detailid').val();

  if (confirm("Laporan diterima?") == true) {
    axios.get('<?= site_url('admin/laporan/terima')?>/'+id)
    .then(function (response) {
      location.reload();
    });
  }
}

function tolak() {
  id = $('#detailid').val();

  Swal.fire({
    text: 'Masukan informasi penolakan!',
    input: 'text',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Tolak Laporan',
    confirmButtonColor: "#f06548",
    showLoaderOnConfirm: true,
    preConfirm: (data) => {
      return fetch('<?= site_url('admin/laporan/tolak')?>/'+id, {
        method: "POST",
        body: JSON.stringify({ keterangan: data }),
        headers: {"Content-type": "application/json; charset=UTF-8"}})
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.json()
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace("<?= site_url('admin/laporan')?>");
      }
    });
  }
</script>
<?= $this->endSection() ?>
