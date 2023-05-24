var congeTable = $('#conge-table').DataTable(
{
  "processing": true,
  paging: false,
  "searching": false,
  "info": false,
 "ajax": {
    url: BaseUrl+'GestionConges/currentYear_conge',
    data:function(d){d.matricule=$('#conge-matricule').val();},
    type: "post",
    datatype:"json",
    
    error:function(XMLHttpRequest, textStatus, errorThrown)
    {

        console.log(errorThrown);
    }
  },
  columnDefs: [{
  targets: [3],
  className: 'centred-column'
},
{className:'flex-table-col',targets:5},
{targets: 6,"visible": false,"searchable": false}
],
  "ordering": false,
  "autoWidth": false,
  "serverSide": false,
  responsive: true,
  "iDeferLoading": 20,
  "lengthMenu": [8,25,50,100],
  "pageLength": 8,
  language: {
    "sProcessing": "Traitement en cours...",
    "sSearch": "Rechercher:",
    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
    "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
    "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
    "sInfoFilte#ff1a1a": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
    "sInfoPostFix": "",
    "sLoadingRecords": "...",
    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
    "oPaginate": {
      "sFirst": "Premier&nbsp;&nbsp;",
      "sPrevious": "<",
      "sNext": ">",
      "sLast": "&nbsp;&nbsp;Dernier"
    },
    "oAria": {
      "sSortAscending": ": activer pour trier la colonne par ordre croissant",
      "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
    }

  },

});

$("#add-conge-form").submit(function(event){
  event.preventDefault(); //prevent default action 
  var post_url = $(this).attr("action"); //get form action url
  var request_method = $(this).attr("method"); //get form GET/POST method
  var form_data = new FormData(this); //Encode form elements for submission
  $.ajax({
    url : post_url,
    type: request_method,
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
      congeTable.ajax.reload();
      $('#add-conge-form').find('input').not('#conge-matricule').val('');
    },
    error: function(err){
       showInfoBox('error','fichier "'+err.responseText+'" invalide');
      

    }
  })
});

$('#export-congeSuivi').on('click',function(){
  var user = $('#conge-matricule').val();
  location.href = 'GestionConges/export_SuiviConge?user='+user;
})
$("#conges-tab").on("click", ".delete-conge", function () {
  parent = $(this).closest("tr");
  customConfirmedialog('Voulez vous supprimer définitivement cette période?',null,function(){
  
  row = congeTable.row(parent);
  code = row.data()[6];
  form_data = new FormData();
  form_data.append("code", code);
  form_data.append("matricule", $('#conges-tab').find('#conge-matricule').val());
  $.ajax({
    url: BaseUrl + "GestionConges/removeConge",
    type: "post",
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (result) {

      congeTable.ajax.reload();
      
    },
    error: function (err) {
       showInfoBox('error','fichier "'+err.responseText+'" invalide');
    },
  });
},function(){});
});