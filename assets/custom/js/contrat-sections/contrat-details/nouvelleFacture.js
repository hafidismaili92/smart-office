$('#contrat-menu-addFacture').on('click',function(e){
  e.preventDefault();
  
  if($("#nouvelleFacture-section").hasClass("hidden_section"))
  {
  $(".principal-sections").addClass("hidden_section");
  $("#nouvelleFacture-section").removeClass("hidden_section");
  $(this).closest(".sub-menus").find("a").removeClass("active");
  $(this).addClass("active");
  $('#btn-search-Nouvellefacture').trigger('click');
  }
  
});


var nouvelleFactureTable = $('#nouvelleFacture-table').DataTable(
{
  orderCellsTop: true,
    fixedHeader: true,
  "processing": false,
  paging: true,
  "searching": true,
  "info": true,
  columnDefs: [
  
  
  {"orderable": false, targets:[1,2,3,4,5,6,7,8]},
  
  { responsivePriority: 1, targets: 0 },
  { responsivePriority: 2, targets: 1 },
  { responsivePriority: 3, targets: 6 },
  { responsivePriority: 4, targets: 8 },
  { className: 'dt-center',"targets": [0,2,3,4,5,7,8]}
  ],
  "ordering": false,
  "dom": 'tip',
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

function getFactureData(form_data,targeturl,methode)
{
  $('#nouvelleFacture-inputs').find('input').val('');
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
        $dta = JSON.parse(result);
        $('#contrat-nouvelle-facture').val($dta['contrat']['numero']);
        $('#tva-facture').text($dta['contrat']['tva']);
        tbl = $('#nouvelleFacture-table').dataTable();
        tbl.fnClearTable();
        tbl.fnAddData($dta['factures']);
      }
      catch(e)
      {
         showInfoBox('error','aucun contrat trouvé');
      }

    },
    error: function(err){



      showInfoBox('error',err.responseText);

    }
  })

}
$("#search-nouvellefacture-form").on('submit',function(event){
  
  event.preventDefault(); //prevent default action 

  var request_method = $(this).attr("method");
   var form_data = new FormData(this);
  
    var post_url = BaseUrl+'NouvelleFacture/loadDataFacture';
    
    getFactureData(form_data,post_url,request_method);
    
});
$("#nouvelleFacture-form").on('submit',function(event){
  event.preventDefault(); //prevent default action 
  $('body').loadingModal({
    position:'auto',
    text:'',
    color:'#fff',
    opacity:'0.6',
    backgroundColor:'rgb(171, 15, 255)',
    animation:'doubleBounce'
  });
  var post_url = $(this).attr("action"); //get form action url
  var request_method = $(this).attr("method"); //get form GET/POST method
  var arr = prixFactureToArrayObject(nouvelleFactureTable);
  if(arr.valide==true)
  {
    var frmDta = new FormData(this);
    frmDta.append('prixFacture',JSON.stringify(arr.dtaObjects));
    $.ajax({
      url : post_url,
      type: request_method,
      data : frmDta,
      cache:false,
      processData:false,
      contentType:false,
      success: function(result){
        $('body').loadingModal('destroy');
        $('#date-nouvelle-facture').val('');
        location.href = result;
      },
      error: function(err){
        $('body').loadingModal('destroy');
        showInfoBox('error',err.responseText);

      }
    })
  }
  else
  {
    $('body').loadingModal('destroy');
     showInfoBox('error',arr.msg);
  }
});

function prixFactureToArrayObject(dtable) {

  var obj = {
    dtaObjects:[],
    valide : true,
    msg:"",
  }


  dtable.rows().every(function (index, element) {

    var tr = this.node();
    var quantite = $(tr).find('.quante-prix-facture').val();
    if(isNaN(quantite))
    {

      obj.valide = false;
      obj.msg="quantite invalide en ligne: "+index;
      return false;
    }
    else
    {
      if(quantite!="" && quantite!="0")
      {
        obj.dtaObjects.push ( {

          'quantite_prix':parseFloat($(tr).find('.quante-prix-facture').val()),
          'numero_prix':$(tr).find("td").eq(0).text(),

        } );
      } 
      else
      {

      }

    }


  });
  if($(obj.dtaObjects).length<=0)
  {

    obj.msg="Quantités Vides!";
    obj.valide=false;
  }
  return obj;
}
$('#nouvelleFacture-table').on('keyup','.quante-prix-facture',function(){
  var parent = $(this).closest('tr');
  if($(this).val()!='')
  {
    if(!$(parent).hasClass('addedTofacture'))
      $(parent).addClass('addedTofacture')
    parent =$(this).closest('tr');
    pu = parseFloat($(parent).find('td').eq(3).text());
    quantite = parseFloat($(this).val());
    $(parent).find('td').eq(7).text(parseFloat(pu*quantite).toFixed(2));
    $(parent).find('td').eq(8).find('i').css('color','#597eff');
  }
  else
  {
    if($(parent).hasClass('addedTofacture'))
      $(parent).removeClass('addedTofacture')
    $(parent).find('td').eq(7).text('');
    $(parent).find('td').eq(8).find('i').css('color','#9ba09b');
  }
  var totalht=0;
  tva = parseFloat($('#tva-facture').text());
  nouvelleFactureTable.rows('.addedTofacture').every(function (index, element) {
    var tr = this.node();
    val = $(tr).find('td').eq(7).text()
    if(!isNaN(val) && val!='')
    {

     totalht+= parseFloat($(tr).find('td').eq(7).text());


   }

 });
  
  $('#contrat-totalHT-facture').val(numberWithSpaces(totalht.toFixed(2)));
  $('#contrat-totalTTC-facture').val(numberWithSpaces(totalht*(1+(tva/100)).toFixed(2)));
})
