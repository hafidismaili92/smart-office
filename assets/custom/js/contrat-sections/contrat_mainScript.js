 
document.addEventListener('DOMContentLoaded', function() {
  //$.fn.dataTable.ext.errMode = 'none';//disable DATATABLES ERRORS
  

  $.getScript(BaseUrl+"assets/custom/js/contrat-sections/liste_contrats.js");
  $.getScript(BaseUrl+"assets/custom/js/contrat-sections/contrat-details/listeFactures.js");
 $.getScript(BaseUrl+"assets/custom/js/contrat-sections/contrat-details/nouvelleFacture.js");
  /*$.getScript(BaseUrl+"assets/custom/js/contrat-sections/ajouter_contrat.js");
  $.getScript(BaseUrl+"assets/custom/js/contrat-sections/clients.js");
  $.getScript(BaseUrl+"assets/custom/js/contrat-sections/dashboard.js");
  $.getScript(BaseUrl+"assets/custom/js/contrat-sections/profilEntreprise.js");
  $.getScript(BaseUrl+"assets/custom/js/contrat-sections/devis.js");*/
  
},false);


