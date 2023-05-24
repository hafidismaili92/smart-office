
$('#infoContrat-li').on('click',function(){

  $('#sidebar li').removeClass('active');
  $(this).addClass('active'); 
  var parent = $('#contrat-details');
  if($(parent).hasClass('hidden_section'))
  {
    $('#main-container').find('section.principal-sections').not('.hidden_section').addClass('hidden_section');
    $(parent).removeClass('hidden_section');
  }
  $(parent).find('section').not('.hidden_section').addClass('hidden_section');
  $('#details-title').text('Info Contrat');
  $('#infoContrat-section').removeClass('hidden_section');
  $('#btn-search-contrat').click();
  
});


/****************************************MAP PART***************************************************/



$('#confirmer-terminer').on('click',function(){
  $('#modalconfirm-contrat-termine').modal('show');
})

$('#contrat-etat-switch').on('change',function(){
  var contrat = $('#item-contrat-numero').text();
  
  if($(this).prop( "checked" ))
    $('#label-contrat-etat-switch').text('Oui');
  else
    $('#label-contrat-etat-switch').text('Non');
  form_data = new FormData();
  form_data.append('contrat-num',contrat);
  form_data.append('contrat-state',$(this).prop( "checked" ));
  $.ajax({
    url : BaseUrl+'Contrats/updateEtat',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){


    },
    error: function(err){


 showInfoBox('error',err.responseText);

    }
  })
})

$('#edit-contrat-etat').on('click',function(){
  numContrat = $('#item-contrat-numero').text();
  if(numContrat!='')
  {

   etat = $('#item-contrat-etat').text();
   $('#num-contrat-etat').text(numContrat);
   switch(etat)
   {
    case 'En cours':
    $('#contrat-etat-selector').val('ENCOURS');
    break;
    case 'Terminé':
    $('#contrat-etat-selector').val('TERMINE');
    break;
    case 'Résilie':
    $('#contrat-etat-selector').val('RESILIE');
    break;
    case 'ARRET':
    $('#contrat-etat-selector').val('En Arrêt');
    break;
  }

  $('#modal-change-contrat-etat').modal('show');
}

})

$('#btn-update-contrat-etat').on('click',function(){
  form_data = new FormData();
  form_data.append('etat',$('#contrat-etat-selector').val());
  form_data.append('numero',$('#num-contrat-etat').text());
  $.ajax({

    url : BaseUrl+'Contrats/updateState',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success:function(result)
    {
      frm = new FormData();
      frm.append('contrat-search-details',$('#num-contrat-etat').text());
      getDetailContrat(frm,BaseUrl+'Contrats/loadDetailsContrat','post');
      $('#modal-change-contrat-etat').modal('hide');
    },
   error: function(err){
 showInfoBox('error',err.responseText);

}


  })
  
})