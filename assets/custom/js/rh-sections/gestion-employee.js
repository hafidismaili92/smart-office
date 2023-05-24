
$.getScript(BaseUrl+"assets/custom/js/rh-sections/add_edit_employe.js");
$.getScript(BaseUrl+"assets/custom/js/rh-sections/absence.js");
$.getScript(BaseUrl+"assets/custom/js/rh-sections/conges.js");
$.getScript(BaseUrl+"assets/custom/js/rh-sections/deplacement.js");
$.getScript(BaseUrl+"assets/custom/js/rh-sections/heureSupp.js");

var activeTab = '#absence-tab';

$('#gestionEmployee-tabs a').on('click',function(e){
  activeTab = $(this).attr('href');
  $('#search-gestion-employee').trigger('click');
})

$("#gestion-employee").on("click", function (e) {
  e.preventDefault();
  if($("#gestion-employee-section").hasClass("hidden_section"))
  {

  $(".principal-sections").addClass("hidden_section");
  $("#gestion-employee-section").removeClass("hidden_section");
  $(this).closest(".sub-menus").find("a").removeClass("active");
  $(this).addClass("active");
  $('#search-gestion-employee').trigger('click');
  }
  
  
});

$(document).ready(function(){
	$("#gestion-employee-form").submit(function(event){
		
  event.preventDefault(); //prevent default action 
  var post_url = $(this).attr("action"); //get form action url
  var request_method = $(this).attr("method"); //get form GET/POST method
  var form_data = new FormData(this); //Encode form elements for submission
  
  
  if(activeTab=="#info-tab")
  {
    post_url=BaseUrl+'Employes/employeeProfil';
  }
  $.ajax({
    url : post_url,
    type: request_method,
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
    	dta = JSON.parse(result);
    $('#nomPrenom-gestion').val(dta[0]['nom_complet']);
    
    
  switch(activeTab)
  {
  	case '#absence-tab':
    $('#matricule-form-absence').val(dta[0]['matricule']);
  	absenceJournalierTable.ajax.reload();
    absenceTotalTable.ajax.reload();
  	break;
  	case '#conges-tab':
    $('#conge-matricule').val(dta[0]['matricule']);
    congeTable.ajax.reload();
  	break;
    case '#deplacement-tab':
    $('#deplacement-matricule').val(dta[0]['matricule']);
    deplacementTable.ajax.reload();
    break;
  case '#heures-sup-tab': 
    $('#heureSup-matricule').val(dta[0]['matricule']);
    heureSupTable.ajax.reload();
    
    break;
    case '#info-tab': 
   
    showUserProfil(dta[0]);
    
    
    break;
  	/*case '#heures-sup-tab':
  	break;*/
  	default:
  	

  }
      
    },
    error: function(err){
      showInfoBox('error',err.responseText);
      

    }
  })
  
})
});
