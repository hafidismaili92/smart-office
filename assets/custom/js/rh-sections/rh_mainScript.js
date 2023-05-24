document.addEventListener('DOMContentLoaded', function() {


	/*
	$.getScript(BaseUrl+"assets/custom/js/rh-sections/gestion-Fonctions.js");
	$.getScript(BaseUrl+"assets/custom/js/rh-sections/gestion-Etablissements.js");
	$.getScript(BaseUrl+"assets/custom/js/rh-sections/gestion-Classes.js");*/
  
	$.getScript(BaseUrl+"assets/custom/js/rh-sections/liste-employee.js");
	$.getScript(BaseUrl+"assets/custom/js/rh-sections/gestion-employee.js");
	$.getScript(BaseUrl+"assets/custom/js/rh-sections/add_edit_employe.js");
	

},false);


/*$('#sidebar .principal-items').click(function(){

 
  $('#main-container').find('section').addClass('hidden_section');
  $(this).addClass('active'); 
  id = $(this).attr('id');
  var concernedSection;
  switch (id)
  {
    
    case 'liste-employe':
 concernedSection=$("#liste-employee-section");
  $('#search-gestion-employee').trigger('click');
    break;
    case 'gestion-employee':
concernedSection=$("#gestion-employee-section");
  $('#search-gestion-employee').trigger('click');
    break;

  }
  if (concernedSection!=undefined)
  {
    $(concernedSection).removeClass('hidden_section');
    $(concernedSection).find('table').each(function(){
      if($.fn.DataTable.isDataTable(this))
    {
     
      $(this).css('width', '100%');
      $(this).DataTable().columns.adjust().draw();
    }

  })
  }
  
})*/
