$('.dropify').dropify({
	messages: {
		'default': 'Glisser la photo ici',
		'replace': 'clicker ou glisser pour remplacer',
		'remove':  'Supprimer',
		'error':   'une erreur s est produite!.'
	}
});

$("#nouveau-employe-form").submit(function(event){
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
	var form_data = new FormData(this); //Encode form elements for submission
	var droits = [];
	$("[name='droitEmployee[]']:checked").each(function (i) {
		droits[i] = $(this).val();
	});
	form_data.delete('droitEmployee[]');
	form_data.append('droits-employee', droits);
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$('body').loadingModal('destroy');
			$("#nouveau-employe-form").find('input').not("[name='droitEmployee[]']").val('');
			$('#nouveau-employe-form').find('.dropify-clear').trigger("click");
			
			var dta = JSON.parse(result);
			$('#success-nouveau-employe .modal-body').children().remove();
			$('#success-nouveau-employe .modal-body').append('<p>'+dta[3]+' '+dta[1]+' '+dta[2]+'</p><p>Matricule : '+dta[0]+'</p>');
			$('#success-nouveau-employe .modal-body').append('<p><small style="color:rgba(0,0,0,0.5)">'+dta[4]+'</small></p>');
			$('#success-nouveau-employe .modal-body').append(dta[5]);
			$('#success-nouveau-employe .modal-body').append(dta[6]);
			$('#success-nouveau-employe').modal('show');


		},
		error: function(err){
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
			$('body').loadingModal('destroy');
			

		},

	})
});

$('#employe-scan-diplome').change(function() {
	var i = $(this).next('label').clone();
	var file = $('#employe-scan-diplome')[0].files[0].name;
	$(this).next('label').text(file);
});
$('#employe-scan-contrat').change(function() {
	var i = $(this).next('label').clone();
	var file = $('#employe-scan-contrat')[0].files[0].name;
	$(this).next('label').text(file);
});


/*$('#confirm-ajouter-employee').on('click',function(){
	$('#droit-employe-modal').modal('hide');
	$('#submit-employee').trigger('click');
	//$("#nouveau-employe-form").submit();	
});*/

$('#edit-recrue-btn').on('click',function(){

	$('#edit-recrue-modal').modal('show');
})



function showUserProfil($dta)
{
	
	$('#info-recrue-matricule').val($dta['char_matricule']);
	$("#info-recrue-prenom").val($dta['prenom']);
	$("#info-recrue-nom").val($dta['nom']);
	$("#info-recrue-cin").val($dta['cin']);
	$("#info-recrue-residence").val($dta['ville_residence']);
	$("#info-recrue-sexe").val($dta['sexe']);
	$("#info-recrue-recrutement").val($dta['date_recrutement']);
	$("#info-recrue-email").val($dta['email']);
	$("#info-recrue-entite").val($dta['et_libelle']);
	$("#info-recrue-fonction").val($dta['f_libelle']);
	$("#info-recrue-statut").val($dta['situation_famille']);
	$("#info-recrue-lieunaissance").val($dta['ville_origine']);
	$("#info-recrue-adresse").val($dta['adresse']);
	$("#info-recrue-tel").val($dta['telephone']);
	$("#info-recrue-contrat").val($dta['lib_contrat']);
	$("#info-recrue-banque").val($dta['agence_bancaire']);
	$("#info-recrue-rib").val($dta['compte_bancaire']);
	$("#info-recrue-diplome").val($dta['libelle_diplome']);
	$('#info-recrue-naissance').val($dta['date_naissance']);
	$('#profil-photo-recrue').attr('src','data:'+$dta['photoMime']+';base64,'+$dta['photo64']);
	$('#download-contrat').html($dta['lien_contrat']);
	$('#download-diplome').html($dta['lien_diplome']);
	$('.selected-emp-name').text($dta['prenom']+" "+$dta['nom']);
	$('.selected-emp-fonction').text($dta['f_libelle']);
	$('.selected-emp-etablissement').text($dta['et_libelle']);
	$('.selected-emp-email').text($dta['email']);
	$('.selected-emp-tel').text($dta['telephone']);
	$('.selected-emp-adresse').text($dta['adresse']);
	/***************************fill modal********************************/
	$('#employe-editMatricule').text($dta['char_matricule']);
	$("#employe-editprenom").val($dta['prenom']);
	$("#employe-editnom").val($dta['nom']);
	$("#employe-editcin").val($dta['cin']);
	$("#employe-editresidence").val($dta['ville_residence']);
	$("#employe-editsexe").val($dta['sexe']);
	$("#employe-editemail").val($dta['email']);
	$("#employe-editsituation").val($dta['situation_famille']);
	$("#employe-editlieu-naissance").val($dta['ville_origine']);
	$("#employe-editadresse").val($dta['adresse']);
	$("#employe-edittel").val($dta['telephone']);
	
	$("#employe-editbanque").val($dta['agence_bancaire']);
	$("#employe-editrib").val($dta['compte_bancaire']);
	$("#employe-editdiplome").val($dta['libelle_diplome']);
	if($dta['hasPhoto']==1)
	{

		setDropifyPreview('edit-employe-form','employe-photo','data:'+$dta['photoMime']+';base64,'+$dta['photo64'],'employe-photo.jpg');
	}

	var codeEtablissement = $("#employe-editetablissement option").filter(function() {
		
		return $(this).text() === $dta['et_libelle'];
		
	}).first().attr("value");
	
	if($dta['isdg']=="true" || $dta['isdg']=="t" )
	{
		$("#employe-editetablissement").prop( "disabled", true );
		$("#employe-editfonction").prop( "disabled", true );
		$("#employe-edittype-contrat").prop( "disabled", true );
		$("#employe-editdiplome").prop( "disabled", true );
		$("#employe-editscan-contrat").prop( "disabled", true );
		$("#employe-editscan-diplome").prop( "disabled", true );
	}
	else
	{
		$("#employe-editetablissement").prop( "disabled", false );
		$("#employe-editfonction").prop( "disabled", false );
		$("#employe-edittype-contrat").prop( "disabled", false );
		$("#employe-editdiplome").prop( "disabled", false );
		$("#employe-editscan-contrat").prop( "disabled", false );
		$("#employe-editscan-diplome").prop( "disabled", false );
	}
	$("#employe-editetablissement").val(codeEtablissement);
	var codeFonction = $("#employe-editfonction option").filter(function() {
		
		return $(this).text() === $dta['f_libelle'];
	}).first().attr("value");
	$("#employe-editfonction").val(codeFonction);
	var typeContrat = $("#employe-edittype-contrat option").filter(function() {
		return $(this).text() === $dta['lib_contrat'];
	}).first().attr("value");
	$("#employe-edittype-contrat").val(typeContrat);
	var dateArr = $dta['date_naissance'].split('/');
	var date = new Date();
	date.setYear(dateArr[2]);
date.setMonth(dateArr[1] -1); //month starts from 0
date.setDate(dateArr[0]);

$('#employe-editdate-naissance').val(date.toISOString().split('T')[0]);
dateArr = $dta['date_recrutement'].split('/');
date.setYear(dateArr[2]);
date.setMonth(dateArr[1] -1); //month starts from 0
date.setDate(dateArr[0]);
$('#employe-editdate-recrutement').val(date.toISOString().split('T')[0]);
}

function setDropifyPreview(parentID,name, src, fname=''){
	let input 	 = $('#'+parentID+' input[name="'+name+'"]');
	let wrapper  = input.closest('.dropify-wrapper');
	let preview  = wrapper.find('.dropify-preview');
	let filename = wrapper.find('.dropify-filename-inner');
	let render 	 = wrapper.find('.dropify-render').html('');

	input.val('').attr('title', fname);
	wrapper.removeClass('has-error').addClass('has-preview');
	filename.html(fname);

	render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
	preview.fadeIn();
}


$('#edit-recrue-modal').on('submit','#edit-employe-form',function(event){
	event.stopImmediatePropagation();
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
	var form_data = new FormData(this); //Encode form elements for submission
	form_data.append('employe-matricule',$('#employe-editMatricule').text());
	/*imgInput = $('#edit-employe-form input[name="employe-photo"]');
	imgSrc = imgInput.closest('.dropify-wrapper').find('.dropify-render').find('img').attr('src');
	if(imgSrc!=undefined && $('#edit-employe-form input[name="employe-editphoto"]').val()=='')
	{
		form_data.append('img',imgSrc);
	}*/

	/**var droits = [];
	$("[name='droitEmployee[]']:checked").each(function (i) {
		droits[i] = $(this).val();
	});
	form_data.append('droits-employee', droits);*/
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			employeesTable.ajax.reload();
			$('body').loadingModal('destroy');
			$('#search-gestion-employee').trigger('click');
			$('#edit-recrue-modal').modal('hide');


		},
		error: function(err){
			$('body').loadingModal('destroy');
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
			

		},

	})
});

