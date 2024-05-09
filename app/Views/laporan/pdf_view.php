<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN KINERJA PENYULUH AGAMA ISLAM</title>

    <style media="screen">
      body {
        display: block;
        margin: 0;
        font-family: "Poppins",sans-serif;
        font-size: 0.8125rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
      }

      .d-flex {
          display: flex !important;
      }

      .mb-0 {
          margin-bottom: 0 !important;
      }

      .text-reset {
          color: inherit !important;
      }

      .mt-1 {
          margin-top: .25rem !important;
      }

      .ms-auto {
          margin-left: auto !important;
      }

      .my-auto {
          margin-top: auto !important;
          margin-bottom: auto !important;
      }

      .h5, h5 {
          font-size: 1.25rem;
      }

      .h6, h6 {
          font-size: 1rem;
      }

      table {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.9em;
          font-family: sans-serif;
          width: 100%;
          min-width: 400px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }

      table thead tr {
          background-color: #5c7a84;
          color: #ffffff;
          text-align: left;
      }

      table th,
      table td {
          padding: 12px 15px;
      }

      table tbody tr {
          border-bottom: 1px solid #dddddd;
      }

      table tbody tr:nth-of-type(even) {
          background-color: #f3f3f3;
      }

      table tbody tr:last-of-type {
          border-bottom: 2px solid #009879;
      }
    </style>
</head>

<body>
  <div class="">

    <div class="page-header page-header-light">
      <div class="page-header-content d-flex">
        <div class="page-title">
          <h5 class="mb-0">Laporan Kinerja Penyuluh Agama</h5>
          <div class="text-reset mt-1">E-PA Kementerian Agama</div>
        </div>
        <div class="my-auto ms-auto">
          Periode Laporan <b>Januari 2022</b>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center bg-table">
              <th colspan="2">DATA PEGAWAI</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="bg-table" width="30%">Nama</td>
              <td><?= session('nama')?></td>
            </tr>
            <tr>
              <td class="bg-table">NIPA</td>
              <td><?= session('nipa')?></td>
            </tr>
            <tr>
              <td class="bg-table">Jenis Pegawai</td>
              <td><?= ($penyuluh->status_pegawai == 'NON PNS')?$penyuluh->status_pegawai:$penyuluh->status_pegawai.'/ '.$penyuluh->nip?></td>
            </tr>
            <tr>
              <td class="bg-table">Tempat Tugas</td>
              <td><?= $kua->kua?>, <?= $kua->kabupaten?>, <?= $kua->provinsi?></td>
            </tr>
          </tbody>
        </table>

        <h6>A. LAPORAN KEPENYULUHAN</h6>

        <?php foreach ($laporans as $row) {?>
        <table class="table table-bordered">
          <thead>
            <tr class="table-primary">
              <th width="30%">Tanggal Pelaksanaan</th>
              <th><?= $row->waktu?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Kelompok Sasaran</td>
              <td><?= $row->sasaran_nama?></td>
            </tr>
            <tr>
              <td>Jumlah Jamaah</td>
              <td><?= $row->jumlah_jamaah?></td>
            </tr>
            <tr>
              <td>Tema Materi</td>
              <td><?= $row->nama_materi?></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td><?= $row->deskripsi?></td>
            </tr>
            <tr>
              <td>Publikasi Sosial Media</td>
              <td><?= $row->publish_link?></td>
            </tr>
          </tbody>
        </table>
      <?php } ?>

      <h6>A. LAPORAN HARIAN LAINNYA</h6>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lains as $row) {?>
            <tr>
              <td><?= $row->waktu?></td>
              <td><?= $row->judul?></td>
              <td><?= $row->deskripsi?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>

    </div>
  </div>
</body>

</html>
