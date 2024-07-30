$(document).ready(function() {
  $('#kabupatenx').select2({
    dropdownParent: $('#addUser'),
    ajax: {
      url: site_url+'ajax/getkabupaten',
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
              id: item.id_kab,
              text: item.kabupaten,
            };
          });
          return {
            results: results,
          }
        },
    },
    placeholder: 'Cari Kabupaten',
    minimumInputLength: 3,
  });
});
