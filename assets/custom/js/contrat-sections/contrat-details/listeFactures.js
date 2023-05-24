$('#contrat-menu-listeFacture').on('click',function(e){
  e.preventDefault();
  
  if($("#listeFacture-section").hasClass("hidden_section"))
  {
  $(".principal-sections").addClass("hidden_section");
  $("#listeFacture-section").removeClass("hidden_section");
  $(this).closest(".sub-menus").find("a").removeClass("active");
  $(this).addClass("active");
  $('#btn-search-factures').trigger('click');
  }
  
});
$("#search-factures-form").on('submit',function(event){
  
  event.preventDefault(); //prevent default action 

  var request_method = $(this).attr("method");
   var form_data = new FormData(this);
  
    var post_url = BaseUrl+'ListeFacture/loadFactures';
    
    getListeFacture(form_data,post_url,request_method);
    
});
var selectedFacture = null;


var listeFacturetable = $('#listeFacture-table').DataTable(
{
 orderCellsTop: true,
 fixedHeader: true,
 "processing": false,
 paging: true,
 "searching": true,
 "info": true,
 "ordering": true,
 "order": [[ 1, "desc" ]],
 columnDefs: [

 {"orderable": false, targets:[0,10,11]},
 { type: 'formatted-num', targets: [6,7] },
 
 { className:'colAction dt-center', targets: [10,11] },
 { className:'colnum dt-center', targets: [1,2] },
 { className: 'dt-center',"targets": [0,3,4,5,6,7,8,10,11]},
 {"targets": [2],"visible": false,"searchable": false},
 {"render": function ( data, type, row ) {
  if(type!='export')
  {
    var num = $.fn.dataTable.render.number(' ', '.', 2).display(data);              
    return num;
  }
  else
    return data;  
},
"targets": [6,7] },
{"render": function ( data, type, row ) {
  if(type=='display')
  {
    switch(data)
    {
     
    case 'payée':
    return '<span class="badge badge-success">Payée</span>';
    break;
    case 'en attente':
    return '<span class="badge badge-warning">En cours</span>';
    break;
    case 'refusée':
    return '<span class="badge badge-danger">Refusée</span>';
    break;
    default:
    return data; 
    break;
  
    }
  }
  else
    return data;  
},
"targets": [9] },
],
buttons:{
    dom: {
      button: {
        className: ''
      }
    },
    buttons: [

{

  text:'<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
  className:' btn btn-exportFactures',
  exportOptions: {
          columns: ":not(.colAction)",
        },
  action: function ( e, dt, node, config ) {

   window.location.href="ListeFacture/exportListeFacture?contrat="+$("#contratnum-list-facture").text();
 }

},
{
  extend: "excelHtml5",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
        className: "btn btn-exportExcel",
        filename: "Liste_Facture " + moment().format("dd-mm-yyyy"),
        title: "Liste des factures: contrat Le "+$("#contratnum-list-facture").text()+" "+ moment().format("DD-MM-YYYY"),
        exportOptions: {
          columns: ":not(.colAction)",
        },
}
]
  },

"dom": 'Btip',
"autoWidth": false,
"serverSide": false,
responsive: true,
"iDeferLoading": 20,
"lengthMenu": [15,50,100],
"pageLength": 15,
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
$(document).ready(function(){
  let container = $(".btns-group[data-table='listeFacture-table']");
  listeFacturetable.buttons().container().appendTo( container);

})
function getListeFacture(form_data,targeturl,methode,keepPage=false)
{
  $('.liste-facture-header').find('span').text('...');
  tbl = $('#listeFacture-table').dataTable();
  var p = listeFacturetable.page.info().page;
  tbl.fnClearTable();
  $.ajax({
    url : targeturl,
    type: methode,
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){

      try
      {
        var dta = JSON.parse(result);

        $('.numero-contrat-header').text(dta['contrat']['numero']);
        $('#contratnum-list-facture').text(dta['contrat']['numero']);
        $('#contratTotal-list-facture').text(numberWithSpaces(parseFloat(dta['contrat']['totalettc']).toFixed(2))+' DH TTC');
        $('#contratPaye-list-facture').text(numberWithSpaces(parseFloat(dta['contrat']['totalpaye']).toFixed(2))+' DH TTC');
        $('#contratApayer-list-facture').text(numberWithSpaces(parseFloat(dta['contrat']['nonpaye']).toFixed(2))+' DH TTC');

        if(dta['factures'].length>0)
        {
         
          tbl.fnAddData(dta['factures']);
          
          if(keepPage==true){
            
            listeFacturetable.columns.adjust().draw( 'full-hold');
          listeFacturetable.order( [[1, 'desc']]).draw('full-hold');
          }
          else
          {
            listeFacturetable.columns.adjust().draw(true);
          listeFacturetable.order( [[1, 'desc']]).draw(true);
          }
        }
      }
      catch(e)
      {
        console.log(e);
         showInfoBox('error','aucune facture pour ce contrat');
        
      }
      
    },
    error: function(err){

       showInfoBox('error',err.responseText);

     

    }
  })
}

var factureDetailTable = $('#prix-facture-detailTable').DataTable(
{
  "processing": false,
  paging: true,
  "searching": false,
  "info": true,
  columnDefs: [
  
  { "width": "5%", targets:[0,1,3] },
  {"orderable": false, targets:[1,2,3,4,5,6]},
  { "width": "35%", targets: 2 },
  { "width": "15%", targets: [4,6] },
  { responsivePriority: 1, targets: 1 },
  { responsivePriority: 2, targets: 2 },
  { responsivePriority: 3, targets: 6 },
  { className: 'dt-center',"targets": [0,2,3,4,5]},
  {"render": function ( data, type, row ) {
    if(type!='export')
    {
      var num = $.fn.dataTable.render.number(' ', '.', 2).display(data);              
      return num;
    }
    else
      return data;  
  },
  "targets": [4,6] },
  ],
  "ordering": true,
  "bSortClasses": false,
  "dom": 'Bfrtip',
  "autoWidth": false,
  "serverSide": false,
  responsive: true,
  "iDeferLoading": 20,
  "lengthMenu": [15,50,100],
  "pageLength": 15,
  buttons: [
  
  {
    extend: "excelHtml5",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
        className: "btn btn-exportExcel table-action",
        filename: "Liste_personnel " + moment().format("dd-mm-yyyy"),
        title: "Liste du Personnel Le " + moment().format("DD-MM-YYYY"),
        exportOptions: {
          columns: ":not(.colAction)",
        },
  }
  ],
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
$(document).ready(function(){
  let container = $(".btns-group[data-table='prix-facture-detailTable']");
  factureDetailTable.buttons().container().appendTo( container );

})
$('#listeFacture-table').on('click','.facture-remove',function(){
parent = $(this).closest('tr');
var data = listeFacturetable.row(parent).data();
numFacture = data[2];
numContrat = $('#contratnum-list-facture').text();
customConfirmedialog('Voulez vous supprimer définitivement cette facture',null,function(){

  form_data = new FormData();
  form_data.append('contrat-num',numContrat);
  form_data.append('facture-num',numFacture);
   $.ajax({
    url : BaseUrl+'ListeFacture/removeFacture',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
     listeFacturetable.row(parent).remove().draw();
       showInfoBox('success','Facture supprimée');

    },
    error: function(err){

     

      showInfoBox('error',err.responseText);

    }
  })
   },function(){});

})
$('#listeFacture-table').on('click','.facture-settings',function(){

  tbl = $('#prix-facture-detailTable').dataTable();
  tbl.fnClearTable();
  $('#info-facture').find('.detail-facture-item-content').text();
  parent = $(this).closest('tr');
  var data = listeFacturetable.row(parent).data();
  numFacture = data[2];
  numFactureanne= data[3];
  dateeffet = data[4];
  datepayement = data[5];
  montantTTC = data[6];
  cumulTTC = data[7];
  avancement = data[8];
  etat = data[9];
  numContrat = $('#contratnum-list-facture').text();
  montantContrat = $('#contratTotal-list-facture').text();
  
  form_data = new FormData();
  form_data.append('contrat-num',numContrat);
  form_data.append('facture-num',numFacture);
  $.ajax({
    url : BaseUrl+'ListeFacture/detailFacture',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){

      tbl = $('#prix-facture-detailTable').dataTable();
      $dta = JSON.parse(result);
      tbl.fnClearTable();
      tbl.fnAddData($dta['factures']);
      $('#item-facture-numero').text(numFacture);
      $('#item-facture-numeroannee').text(numFactureanne);
      $('#item-facture-montantTTC').text(montantTTC+' DH TTC');
      $('#item-facture-date').text(dateeffet);
      $('#item-facture-numero').text(numFacture);
      $('#item-facture-numeroContrat').text(numContrat);
      $('#item-facture-montantContratTTC').text(montantContrat);
      $('#item-facture-cumuleTTC').text(cumulTTC+' DH TTC');
      $('#item-facture-avancement').text(avancement);
      $('#item-facture-etat').text(etat);
      if(etat =="payée")
        $('#edit-facture-etat').css('display','none');
      else
      $('#edit-facture-etat').css('display','block');
      $('#item-facture-datepayement').text(datepayement);
      selectedFacture=numFacture;
      $('#detail-facture-modal').modal('show');


    },
    error: function(err){

      $('#contrat-nouvelle-facture').val("");

      showInfoBox('error',err.responseText);

    }
  })
  

})


$('#scan-accuse-facture').on('change',function()
{
  var fileName = $(this).val();//modif

  var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
  if(fileExtension=='pdf')
  {
   var file_data=$(this).prop("files")[0];
   var facture = $('#item-facture-numero').text();
   var contrat = $('#item-facture-numeroContrat').text();
   form_data = new FormData();
   form_data.append('contrat-num',contrat);
   form_data.append('facture-num',facture);
   form_data.append('fichier',file_data);
   $(this).val('');
   $.ajax({
    url : BaseUrl+'ListeFacture/addFactureAcusse',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
      if(result==1)
      {

        frmData = new FormData();
        form_data.append('contrat-search-details',contrat);
        getListeFacture(form_data,BaseUrl+'ListeFacture/loadFactures','post',true); 
      }

    },
    error: function(err){

      $('#contrat-nouvelle-facture').val("");
 showInfoBox('error',err.responseText);

    }
  })

 }
 
})
$("#detail-facture-modal").on('hide.bs.modal',function(){
  selectedFacture = null;
})
listeFacturetable.on( 'draw', function () {
  if(listeFacturetable.rows().any() && selectedFacture!=null)
  {

    selectedFacture=null;
    listeFacturetable.page.jumpToData( selectedFacture,2 );

  }
} );

$('#prix-facture-tab').on('shown.bs.tab', function (e) {
 factureDetailTable.columns.adjust().draw( false );
});
$('#facture-etat-selector').on('change',function(){

  $('#motif-refus-facture').closest('.form-row').css('display','none');
  $('#date-regle-facture').closest('.form-row').css('display','none');
  switch($(this).val())
  {
   case "REFUSEE":
   $('#motif-refus-facture').closest('.form-row').css('display','block');
   break;
   case "REGLEE":
   $('#date-regle-facture').closest('.form-row').css('display','block');
   break;
 }

})
$('#edit-facture-etat').on('click',function(){
  $('#motif-refus-facture').val('');
  numFacture = $('#item-facture-numero').text();
  numanneeFacture = $('#item-facture-numeroannee').text();
  numContrat = $('#item-facture-numeroContrat').text();
  if(numFacture!='')
  {

   etat = $('#item-facture-etat').text();
   $('#num-facture-etat').text(numFacture);
   $('#numannee-facture-etat').text(numanneeFacture);
   $('#num-contratfacture-etat').text(numContrat);
   switch(etat)
   {
    case 'en attente':
    $('#facture-etat-selector').val('ENATTENTE');
    break;
    case 'réglée':
    $('#facture-etat-selector').val('REGLEE');
    break;
    case 'refusée':
    $('#facture-etat-selector').val('REFUSEE');
    break;
  }
  $('#detail-facture-modal').modal('hide');
  $('#modal-change-facture-etat').modal('show');
}

})

$('#btn-update-facture-etat').on('click',function(){
  var contrat = $('#num-contratfacture-etat').text();
  form_data = new FormData();
  form_data.append('etat',$('#facture-etat-selector').val());
  form_data.append('numeroFacture',$('#num-facture-etat').text());
  form_data.append('numeroContrat',$('#num-contratfacture-etat').text());
  form_data.append('motifRefus',$('#motif-refus-facture').val());
  form_data.append('dateReglement',$('#date-regle-facture').val());
  form_data.append('modePayement',$('#facture-mode-paiement').val());
  $.ajax({

    url : BaseUrl+'ListeFacture/updateFactureState',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success:function(result)
    {

      selectedFacture = $('#num-facture-etat').text();
      $('#modal-change-facture-etat').modal('hide');
      //$('#detail-facture-modal').modal('show');
      form_data = new FormData();
      form_data.append('contrat-search-details',contrat);
      getListeFacture(form_data,BaseUrl+'ListeFacture/loadFactures','post',true);
    },
    error: function(err){


       showInfoBox('error',err.responseText);
     
    }


  })
  
})
$('#facture-aff-length').change( function() { 
  listeFacturetable.page.len( $(this).val() ).draw();
});

$('#facture-search').keyup(function(){
  listeFacturetable.search($(this).val()).draw() ;
});






