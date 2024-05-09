axios.get('/ajax/getprofil')
.then(function (response) {
  var template = Handlebars.compile(document.getElementById("profil-template").innerHTML);
  var context = response.data;
  var html = template(context);

  $("#profil").html(html);

  $("#nama").html(context.nama);
  $("#tugas").html(context.tugas.kua);
  $("#statuspegawai").html(context.status_pegawai);
});
