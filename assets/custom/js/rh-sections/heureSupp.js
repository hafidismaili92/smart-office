var heureSupTable = $('#heureSup-table').DataTable(
{
  "processing": true,
  paging: true,
  "searching": false,
  "info": false,
  "ajax": {
    url: BaseUrl+'GestionHeuresSup/currentYear_HSP',
    data:function(d){d.matricule=$('#heureSup-matricule').val();},
    type: "post",
    datatype:"json",
    
    error:function(XMLHttpRequest, textStatus, errorThrown)
    {


    }
  },
  columnDefs: [
  {targets: [4],"visible": false,"searchable": false},
  {targets: [1],className: 'centred-column'},
  {targets: [3],className: 'flex-table-col'},
  {targets: [2],className: 'justif-column'},
  { "width": "50%", targets: 2 },
  { "width": "40%", targets: 0 },
  { responsivePriority: 1, targets: 0 },
  { responsivePriority: 2, targets: 1 },
  { responsivePriority: 3, targets: 3 },
  { responsivePriority: 4, targets: 2 },

  ],
  "ordering": false,
  autoWidth: false,
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

$("#add-heureSup-form").submit(function(event){

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
     heureSupTable.ajax.reload();
     
     $('#add-deplacement-form').find('input').not('#deplacement-matricule').val('');
   },
   error: function(err){
 showInfoBox('error','fichier "'+err.responseText+'" invalide');
    

  }
})
});

$('#export-heureSupSuivi').on('click',function(){
  var user = $('#heureSup-matricule').val();
  location.href = 'GestionHeuresSup/export_SuiviHSP?user='+user;
});
$('#export-HSPimpayee').on('click',function(){
 var user = $('#heureSup-matricule').val();
  location.href = 'GestionHeuresSup/export_unPayedHSP?user='+user;
})

$("#heures-sup-tab").on("click", ".delete-heuresup", function () {
  parent = $(this).closest("tr");
  customConfirmedialog('Voulez vous supprimer définitivement ces heures Supp?',null,function(){
  
  row = heureSupTable.row(parent);
  code = row.data()[4];
  form_data = new FormData();
  form_data.append("code", code);
  form_data.append("matricule", $('#heures-sup-tab').find('#heureSup-matricule').val());
  $.ajax({
    url: BaseUrl + "GestionHeuresSup/removeHeureSup",
    type: "post",
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (result) {

      heureSupTable.ajax.reload();
      
    },
    error: function (err) {
       showInfoBox('error','fichier "'+err.responseText+'" invalide');
    },
  });
},function(){});
});