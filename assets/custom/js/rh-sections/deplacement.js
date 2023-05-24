var deplacementTable = $('#deplacement-table').DataTable(
{
  "processing": true,
  paging: true,
  "searching": false,
  "info": false,
 "ajax": {
    url: BaseUrl+'GestionDeplacement/currentYear_deplacement',
    data:function(d){d.matricule=$('#deplacement-matricule').val();},
    type: "post",
    datatype:"json",
    
    error:function(XMLHttpRequest, textStatus, errorThrown)
    {

        console.log(errorThrown);
    }
  },
  columnDefs: [
  {targets: [5],"visible": false,"searchable": false},
  {targets: [3],className: 'centred-column'},
  {targets: [4],className: 'flex-table-col'},
  {targets: [2],className: 'objet-column'},
  { "width": "40%", targets: 2 },
  { "width": "15%", targets: 0 },
  { "width": "15%", targets: 1 },
  { "width": "15%", targets: [3,4] },
  { responsivePriority: 1, targets: 0 },
  { responsivePriority: 2, targets: 1 },
  { responsivePriority: 3, targets: 3 },
  { responsivePriority: 4, targets: 4 },
  { responsivePriority: 5, targets: 2 }],
  "ordering": false,
  "serverSide": false,
  autoWidth:false,
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

$("#add-deplacement-form").submit(function(event){
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
      deplacementTable.ajax.reload();
      $('#add-deplacement-form').find('input').not('#deplacement-matricule').val('');
    },
    error: function(err){
 showInfoBox('error','fichier "'+err.responseText+'" invalide');
      

    }
  })
});

$('#export-deplacementSuivi').on('click',function(){
  var user = $('#deplacement-matricule').val();
  location.href = 'GestionDeplacement/export_SuiviDeplacement?user='+user;
});
$('#export-impayee').on('click',function(){
  var user = $('#deplacement-matricule').val();
  location.href = 'GestionDeplacement/export_unPayedDeplacement?user='+user;
})

$("#deplacement-tab").on("click", ".delete-deplacement", function () {
  parent = $(this).closest("tr");
  customConfirmedialog('Voulez vous supprimer définitivement ce déplacement?',null,function(){
  
  row = deplacementTable.row(parent);
  code = row.data()[5];
  form_data = new FormData();
  form_data.append("code", code);
  form_data.append("matricule", $('#deplacement-tab').find('#deplacement-matricule').val());
  $.ajax({
    url: BaseUrl + "GestionDeplacement/removeDeplacement",
    type: "post",
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (result) {

      deplacementTable.ajax.reload();
      
    },
    error: function (err) {
       showInfoBox('error','fichier "'+err.responseText+'" invalide');
      
    },
  });
},function(){});
});