$(document).ready(function(){
	loadEntrepriseProfil();
})
var drEvent = $('#entreprise-logo-update').dropify({
	messages: {
		'default': 'Glisser la photo ici',
		'replace': 'clicker ou glisser pour remplacer',
		'remove':  'Supprimer',
		'error':   'une erreur s est produite!.'
	}
});
$("#entreprise-logo-update").change(function(){
	
	var fileName = $(this).val();
	var fileExtension = fileName.split('.').pop().toLowerCase();
	allowedExtension = ['jpg','png','jpeg'];
	if(jQuery.inArray(fileExtension,allowedExtension) != -1)
	{
		frmData = new FormData();
		var file_data=$(this).prop("files")[0];
		frmData.append('entreprise-logo',file_data);
		$.ajax({
			url : BaseUrl+'Entreprise/updatePhoto',
			data:frmData,
			type: 'post',
			cache:false,
			processData:false,
			contentType:false,
			success: function(result){

				$('#logo-entreprise').attr('src',result);
				 showInfoBox('success','Photo modifié');
				
			},
			error: function(err){
				showInfoBox('error',err.responseText);
				

			}
		})	
	}
	else
	{

		showInfoBox('error','Fichier non autorisé');
	}
	
});
drEvent.on('dropify.beforeClear', function(event, element) {


	if(confirm("Voulez vous vraiment supprimer la photo ?"))
	{
		$.ajax({
			url : BaseUrl+'Entreprise/ClearPhoto',
			type: 'post',
			cache:false,
			processData:false,
			contentType:false,
			success: function(result){
				element.value=""; 
				$('#logo-entreprise').attr('src','');
				drdta = drEvent.data('dropify');
				drdta.resetPreview();

			},
			error: function(err){

				showInfoBox('error',err.responseText);

			}
		})


	}
	return false;


});
function loadEntrepriseProfil()
{
	$.ajax({
		url : BaseUrl+'Entreprise/getEntrepriseDta',
		type: 'post',
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			var dta = JSON.parse(result);
			$.each(dta,function(key,val){
				$('#item-entreprise-'+key).text(val);

			})     
		},
		error: function(err){



			showInfoBox('error',err.responseText);

		}
	})
}

$('.edit-entreprise').on('click',function(){

	parent = $(this).closest('.detail-entreprise-item');
	idField= parent.find('.detail-entreprise-item-content').attr('id');
	contentField = parent.find('.detail-entreprise-item-content').text();

	$('#attribute-to-update').text(idField);
	$('#entreprise-attribute-modify').text(parent.find('.detail-entreprise-item-title').text());
	$('#selectAttribute').css('display','none');
	$('#inputAtrribute').css('display','none');
	if(idField=='item-entreprise-ville')
	{
		
		$('#selectAttribute').css('display','block');
		$('#selectAttribute').val(contentField);
	}
	else
	{
		$('#inputAtrribute').css('display','block');
		$('#inputAtrribute').val(contentField);
	}
	$('#modal-update-entreprise').modal('show');

})
$('#edit-entreprise-config').on('click',function(){
	$('#conge_annee').val($('#item-entreprise-conge_annee').text());
	$('#jour_semaine').val($('#item-entreprise-jsemaine').text());
	$('#heure_debut_travail').val($('#item-entreprise-hdebut').text());
	$('#heure_fin_travail').val($('#item-entreprise-hfin').text());
	$('#modal-update-config').modal('show');
})

$("#edit-config-form").submit(function(event){
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
    	dta = JSON.parse(result);
    	$('#item-entreprise-conge_annee').text(dta.conge_annee);
		$('#item-entreprise-jsemaine').text(dta.jour_semaine);
		$('#item-entreprise-hdebut').text(dta.heure_debut_travail);
		$('#item-entreprise-hfin').text(dta.heure_fin_travail);
      	$('#modal-update-config').modal('hide');
    },
    error: function(err){
    	
       showInfoBox('error',err.responseText);
      

    }
  })
});
$('#btn-update-entreprise').on('click',function(){
  form_data = new FormData();
  form_data.append('attribute',$('#attribute-to-update').text());
  if($('#attribute-to-update').text()=='item-entreprise-ville')
	form_data.append('val',$('#selectAttribute').val());
	else
	form_data.append('val',$('#inputAtrribute').val());
  $.ajax({

    url : BaseUrl+'Entreprise/updateField',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success:function(result)
    {
     $('#modal-update-entreprise').modal('hide'); 
     loadEntrepriseProfil();
    },
   error: function(err){
   	$('#modal-update-entreprise').modal('hide');
  showInfoBox('error',err.responseText);

}


  })
  
})
