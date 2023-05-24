$.getScript(BaseUrl+"assets/custom/js/contrat-sections/contrat-details/nouvelleFacture.js");
$.getScript(BaseUrl+"assets/custom/js/contrat-sections/contrat-details/listeFactures.js");

$(document).ready(function(){
  $("#search-contrat-form").on('submit',function(event){
	
  event.preventDefault(); //prevent default action 
  parent = $('#contrat-details');
  visibleSection = $(parent).find('section').not('.hidden_section');
  var request_method = $(this).attr("method");
   var form_data = new FormData(this);
  switch(visibleSection.attr('id'))
  {
    case 'infoContrat-section':
    var post_url = BaseUrl+'Contrats/loadDetailsContrat';
    
    getDetailContrat(form_data,post_url,request_method);
    break;
    case 'nouvellFacture-section':
    var post_url = BaseUrl+'NouvelleFacture/loadDataFacture';
    
    getFactureData(form_data,post_url,request_method);
    break;
    case 'listeFacture-section':
    var post_url = BaseUrl+'ListeFacture/loadFactures';
    
    getListeFacture(form_data,post_url,request_method);
    break;
  }
   
 
});
})
