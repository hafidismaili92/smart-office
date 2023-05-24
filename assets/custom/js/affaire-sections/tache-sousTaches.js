$('#sous-taches-items').on('click',function(){

	$('.principal-items').removeClass('active');
	$('li').removeClass('active');
	$(this).addClass('active');
	
	$('#main-container').find('section').addClass('hidden_section');
	$("#affaire-sTaches-section").removeClass('hidden_section');
	
})

var sTachesTable = $('#sTaches-table').DataTable(
{
	"processing": false,
	"stateSave": true,
	"ajax": {
		url: BaseUrl+'Tache_Staches/loadStaches',
		type: "post",
		datatype:"json",
		data:function(d){d.affaire=selectedAffaireTache;d.tache=selectedTache},

		error:function(XMLHttpRequest, textStatus, errorThrown)
		{
			//$('#sTaches-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','','','','','','','','','']).draw();
			
		}
	},
	"serverSide": false,
	responsive: true,
	"iDeferLoading": 20,
	"lengthMenu": [8,10],
	"pageLength": 8,
	"bSortClasses": false,
	columnDefs : [
	{ "width": "5%", "targets": [0] },
	{ "width": "10%", "targets": [1] },
	{ "width": "40%", "targets": [2] },
	{ "width": "15%", "targets": [4,5] },
	{ className: 'dt-center',"targets": [0]},
	{"targets": [ 3,6,8,9,10,11,12,13,14,15],"visible": false,"searchable": false}
	],
	"order": [[ 1, "desc" ]],
	"createdRow": function( row, data, dataIndex){
		
		if( data[12] == -1 ){
			$(row).addClass('tache-redRow');
		}
		if( data[12] == 1 ){
			$(row).addClass('tache-greenRow');
		}
	},
	language: {
		"sProcessing": "Traitement en cours...",
		"sSearch": "Rechercher:",
		"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
		"sInfo": "",
		"sInfoEmpty": "",
		"sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		"sInfoPostFix": "",
		"sLoadingRecords": "Chargement en cours...",
		"sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
		"sEmptyTable": "Aucune sous-tache programmées",
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

$("#nouveau-sTaches-form").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	var stacheData = new FormData(this);
	stacheData.append('affaire',selectedAffaireTache);
	stacheData.append('tache',selectedTache);
	$.ajax({
		url : post_url,
		type: request_method,
		data : stacheData,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			sTachesTable.ajax.reload( null, false );
		},
		error: function(err){

			$('body').append('<div class="custom-alert" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #B00F04; opacity:0.9; color: white;z-index:1000;padding:20px;">' +err.responseText+'</div>');
			$('body .custom-alert').delay(3000).hide(10, function() {
				$(this).remove();
			});

		}
	})
});

$('#sTaches-table tbody').on('click', 'tr', function () {

	var data = $('#sTaches-table').DataTable().row( this ).data();
	$('#sTache-num').text(data[1]);
	$('#sTache-label').text(data[2]);
	$('#sTache-createur').text(data[4]);
	$('#sTache-date-creation').text(data[6]);
	$('#sTache-date-finPrevue').text(data[8]);
	$('#sTache-validation-date').text(data[9]);
	$('#avancement-sTache-bar').css('width', data[5]).attr('aria-valuenow', data[5].replace('%','')).text(data[5]); 
	$('#sTache-observation').val(data[14]);
	$('#sTache-affaire').text(data[3]);
	switch(data[12])
	{
		case 1:
		$('#sTache-etat').text('validée');
		$('#sTache-etat').css('color','green');
		break;
		case -1:
		$('#sTache-etat').text('En souffrance');
		$('#sTache-etat').css('color','red');
		break;
		default:
		$('#sTache-etat').text('En cours');
		$('#sTache-etat').css('color','black');

	}

} );

$('#valider-Stache').on('click',function(){
	dta = new FormData();
	dta.append('numero',$('#sTache-num').text());
	dta.append('numero_affaire',$('#sTache-affaire').text());
	$.ajax({
		url : BaseUrl+'Tache_Staches/validateTache',
		type: 'post',
		data : dta,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			
			$('#sTache-etat').text('validée');
			$('#sTache-etat').css('color','green');

			sTachesTable.ajax.reload();
		},
		error: function(err){

			$('body').append('<div class="custom-alert" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #B00F04; opacity:0.9; color: white;z-index:1000;padding:20px;">' +err.responseText+'</div>');
			$('body .custom-alert').delay(3000).hide(10, function() {
				$(this).remove();
			});

		}
	})

})