$('#details-items').on('click',function(){
	$('.principal-items').removeClass('active');
	$('li').removeClass('active');
	$(this).addClass('active');	
	
	$('#main-container').find('section').addClass('hidden_section');
	$("#details-section").removeClass('hidden_section');
	getDetails(selectedAffaire);

});

$(document).ready(function(){
	$('#affaires-tableContainer').on('click','.show-details',function(){

		$('#details-items').trigger('click');

	});
})

function getDetails(affaireTo)
{
	frmData = new FormData();
	frmData.append('affaire',affaireTo);
	$.ajax({
		url : BaseUrl+'Details/getDetails',
		type: 'post',
		data : frmData,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			avancement=0;
			
			dta = JSON.parse(result);
			
			if(dta['avancement']>0)
			{
				avancement =dta['avancement'];
			}
			statuText = $('#detail-StatutAffaire');
			iTag = $(statuText).closest('.detail-affaire-item').find('i');
			$(iTag).removeClass("fa-hourglass-start fa-exclamation-triangle fa-check-circle");
			
			if(dta['statut']=='1')
			{
				
				$(statuText).text('Terminée');
				$(iTag).addClass("fa-check-circle");
				$(iTag).css('color','green');
				
			}
			else if (dta['statut']=='2')
			{
				$(statuText).text('En souffrance');
				$(iTag).addClass("fa-exclamation-triangle");
				$(iTag).css('color','red');
			}
			else
			{
				$(statuText).text('En cours');
				$(iTag).addClass("fa-hourglass-start");
				$(iTag).css('color','#ff7600');
			}
			
			$('#detail-numAffaire').text(dta['numero_affaire']);
			$('#detail-createurAffaire').text(dta['creer_par']);
			$('#detail-libelleAffaire').text(dta['libelle']);
			$('#detail-typeAffaire').text(dta['typeaffaire']);
			$('#detail-dateCreationAffaire').text(dta['date_creation']);
			$('#detail-datefinAffaire').text(dta['date_fin']);
			$('#detail-responsableAffaire').text(dta['responsable']);
			$('#detail-observationAffaire').text(dta['observation']);
			$('#detail-montantAffaire').text(dta['montant_ttc']+' DH TTC');
			$('#detail-delaiAffaire').text(dta['delai']+' jours');
			$('#detail-classementAffaire').text(dta['id_rangee']);
			$('#avancement-bar').css('width', avancement+'%').attr('aria-valuenow', avancement).text(avancement+'%'); 
			$('#detail-tacheTermineeAffaire').text(dta['tachesvalide']);
			$('#detail-tacheEnCoursAffaire').text(dta['tachesnonvalide']);
		},
		error: function(err){

		}
	})
}
$('#edit-affaire-btn').on('click',function(){

	if($('#detail-numAffaire').text()!='')
	{
		numero=$('#detail-numAffaire').text();
		libelle = $('#detail-libelleAffaire').text();
		observation = $('#detail-observationAffaire').text();
		statut = $('#detail-StatutAffaire').text();
		delai = $('#detail-delaiAffaire').text();
		$('#edit-num-affaire').val(numero);
		$('#edit-affaire-observations').val(observation);
		$('#edit-affaire-delai').val(delai.replace(/[^0-9.]/g, ""));
		$('#edit-affaires-libelle').val(libelle);
		statut=='Terminée'? $('#edit-affaire-statut').val("1") : $('#edit-affaire-statut').val("0");
		$('#modal-edit-affaire').modal('show');	
	}
	

})
$("#edit-affaires-form").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	var missionsData = new FormData(this);
	missionsData.append('affaire',selectedAffaire);
	$.ajax({
		url : post_url,
		type: request_method,
		data : missionsData,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			getDetails(selectedAffaire);
			affairesTable.ajax.reload( null, false );//prevent page reset
			$('#modal-edit-affaire').modal('hide');
		},
		error: function(err){

			$('body').append('<div class="custom-alert" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #B00F04; opacity:0.9; color: white;z-index:1000;padding:20px;">' +err.responseText+'</div>');
			$('body .custom-alert').delay(3000).hide(10, function() {
				$(this).remove();
			});

		}
	})
});
$('#modal-edit-affaire').on('hidden.bs.modal', function () {
	
    $('#edit-missions-form').find('input,textarea,select').val("");
});