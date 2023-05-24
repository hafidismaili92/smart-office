$(document).ready(function(){
	affairesTable.buttons().container().appendTo("#btns-missions-group");
	$('#affaires-table').on('click','.show-missions',function(){
		let parent = $(this).closest('tr');
		var data = affairesTable.row(parent).data();
		selectedAffaire = data[0];

		$('#affaire-missions-items').trigger('click');

	});
})

var missionsTable = $('#missions-table').DataTable(
{
	"processing": false,
	"stateSave": false,
	//"scrollY":        "70vh",
	
	ajax: {
		url: BaseUrl+'Affaire_missions/loadMissions',
		type: "post",
		datatype:"json",
		data:function(d){d.affaire=selectedAffaire;},
		
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{
			/*$('#missions-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>']).draw();*/
			
		}
	},

	"serverSide": false,
	responsive: true,
	"dom": 'tp',
	"iDeferLoading": 20,
	"lengthMenu": [15,50,100],
	"pageLength": 15,
	"bSortClasses": false,
	"autoWidth":false,
	columnDefs : [

	{ "orderable": false, "targets": [0,1,6,17]},
	{
			render: function (data, type, row) {
				
				var classeName = "bg-gradient-warning";
				if(row[14]==1) {classeName = "bg-gradient-success"}
				else if(row[14]==-1) {classeName = "bg-gradient-danger"}
				return '<div class="progress"><div class="progress-bar '+classeName+'" role="progressbar" style="width:'+data+'%" aria-valuenow="'+data+'" aria-valuemin="0" aria-valuemax="100"></div></div>';
				
			},
			targets: 6,
		},
	{"targets": [ 8,9,10,11,12,13,14,15,16],"visible": false,"searchable": false}
	],
	buttons: {
		dom: {
			button: {
				className: "",
			},
		},
		buttons: [
			{
				extend: "excelHtml5",
				text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
				className: "btn btn-primary-outline",
				filename: "Liste-globales-Affaires ",
				title: "Liste Des Affaires globales",
				exportOptions: {
					columns: ":not(.colAction)",
				},
			},
		],
	},
	"order": [[ 7, "desc" ]],
	/*"createdRow": function( row, data, dataIndex){

		if( data[13] == -1 ){
			$(row).addClass('tache-redRow');
		}
		if( data[13] == 1 ){
			$(row).addClass('tache-greenRow');
		}
	},*/
	language: {
		"sProcessing": "Traitement en cours...",
		"sSearch": "Rechercher:",
		"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
		"sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
		"sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
		"sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		"sInfoPostFix": "",
		"sLoadingRecords": "Chargement en cours...",
		"sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
		"sEmptyTable": "Aucune missions programmées",
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

$("#nouveau-missions-form").submit(function(event){
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
	var form_data = $(this).serialize(); //Encode form elements for submission
	var missionsData = new FormData(this);
	missionsData.append('affaire',selectedAffaire);

	for(i=0;i<attachList.length;i++)
    {
        var filesize = ((attachList[i].size/1024)/1024).toFixed(4); // MB
        if (typeof attachList[i].name == "undefined") { 
        	showInfoBox('error','fichier "'+attachList[i].name+'" invalide',4000);
        	return;
        }
        if(filesize >= 10)
        {
        	showInfoBox('error','fichier "'+attachList[i].name+'" dépassant taille maximal 10MB!');	
        	return;
        }
        missionsData.append('file'+i,attachList[i]);  
    }
	$.ajax({

		url : post_url,
		type: request_method,
		data : missionsData,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$('body').loadingModal('destroy');

			$('#add-mission-modal').modal('hide');
			missionsTable.ajax.reload( null, false );//prevent page reset
		},
		error: function(err){
			showInfoBox('error',err.responseText);
			

		}
	})
});
$('#affaire-missions-items').on('click',function(e){
	e.preventDefault();
	
	if($("#affaire-missions-section").hasClass("hidden_section"))
	{
	$(".principal-sections").addClass("hidden_section");
	$("#affaire-missions-section").removeClass("hidden_section");
	$(this).closest(".sub-menus").find("a").removeClass("active");
	$(this).addClass("active");
	$('.numero-affaire-title').text(selectedAffaire);
	}
	missionsTable.ajax.reload( null, false );
});

/*$( window ).resize(function() {
	$('#missions-table').resize();
});*/
$('#missions-table').on('click', '.missions-actions-detail', function (e) {
	
	$('#mission-details').modal('show');
	
	let parent = $(this).closest("tr");
	$('#t-attach-detail').html("");
	var data = $('#missions-table').DataTable().row(parent).data();

	$('#mission-num').text(data[2]);
	$('#mission-label').text(data[3]);
	$('#mission-createur').text(data[5]);
	$('#mission-date-creation').text(data[7]);
	$('#mission-date-finPrevue').text(data[10]);
	$('#mission-validation-date').text(data[11]);
	$('#avancement-mission-bar').css('width', data[6]+"%").attr('aria-valuenow', data[6]).text(data[6]+"%"); 
	$('#mission-observation').text(data[16]);
	$('#mission-affaire').text(data[8]);
	$('#mission-etat').css('color','white');
	switch(data[14])
	{
		case 1:
		$('#mission-etat').html('<span style="background-color:green;padding: 1px 3px;border-radius:5px;">validée<span>');
		
		break;
		case -1:
		$('#mission-etat').html('<span style="background-color:red;padding: 1px 3px;border-radius:5px;">En souffrance<span>');
		break;
		default:
		$('#mission-etat').html('<span style="background-color:orange;padding: 1px 3px;border-radius:5px;">En cours<span>');


	}
var missionsData = new FormData();
missionsData.append('affaire',selectedAffaire);
missionsData.append('numero',data[2]);
missionsData.append('resp','OWNER');
	$.ajax({
		url : BaseUrl+'Affaire_missions/getAttachements',
		type: "POST",
		data : missionsData,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
				dta = JSON.parse(result);
				html="";
				for(var i=0;i<dta.length;i++)
				{
					var icon = "fa  fa-file";
					var color ="gray";
					if($.inArray(dta[i].extension,['png','jpeg','jpg','tiff','ico','gif','svg'])>=0)
			{
				icon = "fa fa-file-image";
				color = "rgba(227, 203, 43, 1)";
			}
			else if ($.inArray(dta[i].extension,['xls','xlsx'])>=0)
			{
				icon = "fa  fa-file-excel-o";
				color = "green";
			}
			else if ($.inArray(dta[i].extension,['txt','dat'])>=0)
			{
				icon = "far fa-file-text";
			}
			else if ($.inArray(dta[i].extension,['doc','docx'])>=0)
			{
				icon = "fa  fa-file-word-o";
				color = "blue";
			}
			else if ($.inArray(dta[i].extension,['ppt','pptx'])>=0)
			{
				icon = "fa  fa-file-powerpoint-o";
				color = "orange";
			}
			else if ($.inArray(dta[i].extension,['pdf'])>=0)
			{
				icon = "fa fa-file-pdf-o";
				color = "red";
			}
			else if ($.inArray(dta[i].extension,['zip','rar'])>=0)
			{
				icon = "fa fa-file-archive-o";
				color = "rgba(190, 96, 25, 1)";
			}
			else if(data=="csv")
			{
				icon = "far fa-file-csv";
			}
				html +='<tr><td style="width:10%"><i class="'+icon+'" style="color:'+color+'"></i></td><td style="width:80%">'+dta[i].name+'</td><td style="width:10%">'+dta[i].download+'</td></tr>';
				}
				$('#t-attach-detail').html(html);
		},
		error: function(err){

		}
	})
} );


$('#missions-table').on('click','.missions-actions',function(e){
	
	parent = $(this).closest('tr');
	dta = missionsTable.row(parent).data();
	numero = dta[2];

	$('#contrat-search-details').val(numero);
	if($(this).hasClass('missions-actions-edit'))
	{
		dta = missionsTable.row(parent).data();
		delai = dta[9].replace(/[^0-9.]/g, "");
		responsable = dta[5];
		libelle = dta[3];
		
			$('#edit-num-mission').val(numero);
			$('#edit-missions-responsable').val(responsable);
			$('#edit-mission-delai').val(delai);
			$('#edit-missions-libelle').val(libelle);
			$('#modal-edit-mission').modal('show');
		
	}
	else if($(this).hasClass('missions-actions-remove'))
	{
		customConfirmedialog('Voulez vous supprimer définitivement cette mission',null,function(){

			frmdta = new FormData();
		frmdta.append('numero',numero);
		frmdta.append('affaire',selectedAffaire);
		$.ajax({
    url : BaseUrl+'Affaire_missions/removeMission',
    type: "post",
    data : frmdta,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
      missionsTable.ajax.reload( null, false );//prevent page reset
      
    },
    error: function(err){

    	showInfoBox('error',err.responseText);
    }
  })
		},function(){})
		
	}
	else if($(this).hasClass('missions-actions-validate'))
	{
		dta = new FormData();
	dta.append('numero',numero);
	dta.append('numero_affaire',selectedAffaire);
	dta.append('validate',1);
	$.ajax({
		url : BaseUrl+'Affaire_missions/toggleValidateMission',
		type: 'post',
		data : dta,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){

			missionsTable.ajax.reload( null, false );
			
		},
		error: function(err){
			showInfoBox('error',err.responseText);

		}
	})
	}
	else if($(this).hasClass('missions-actions-unvalidate'))
	{
		dta = new FormData();
	dta.append('numero',numero);
	dta.append('numero_affaire',selectedAffaire);
	dta.append('validate',0);
	$.ajax({
		url : BaseUrl+'Affaire_missions/toggleValidateMission',
		type: 'post',
		data : dta,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){

			missionsTable.ajax.reload( null, false );
			
		},
		error: function(err){
			showInfoBox('error',err.responseText)

		}
	})
	}
	
	
});
$("#edit-missions-form").submit(function(event){
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
			missionsTable.ajax.reload( null, false );//prevent page reset
			$('#modal-edit-mission').modal('hide');
		},
		error: function(err){
			showInfoBox('error',err.responseText)
		}
	})
});

$('#modal-edit-mission').on('hidden.bs.modal', function () {
	
    $('#edit-missions-form').find('input,textarea,select').val("");
});

$('#missions-table-length').change( function() { 
	missionsTable.page.len( $(this).val() ).draw();
});

$('#search-Missions').keyup(function(){
	missionsTable.search($(this).val()).draw() ;
});

var attachList = new Array();

updateList = function () {
    var input = document.getElementById('tache-attach-add');
    var output = document.getElementById('divFiles');

    
    for (var i = 0; i < input.files.length; ++i) {
    	var filesize = ((input.files.item(i).size/1024)/1024).toFixed(4); // MB
        if (typeof input.files.item(i).name == "undefined") { 
        	showInfoBox('error','fichier "'+input.files.item(i).name+'" invalide',4000);
        	continue;
        }
        else if(filesize >= 10)
        {
        	showInfoBox('error','fichier "'+input.files.item(i).name+'" dépassant taille maximal 10MB!');	
        	continue;
        }
        else if (attachList.filter(function(e) { return e.name === input.files.item(i).name; }).length > 0) continue;  
        attachList.push(input.files.item(i)) ;
    }
    var HTML ="";
    for(var j=0;j<attachList.length;j++)
    {
    	HTML += '<tr data-index="'+j+'" style="border-bottom: solid 1px #f0f0f0;"><td style="width:80%">' 
              + attachList[j].name
              + '</td><td style="width:10%"><i class="fa fa-trash delete-tache-attach" style="color:#f95e66"></i></td></tr>';
              
    }
   $('#t-attach-list').html(HTML); 
    $('#tache-attach-add').val("");
}
$('#show-addMission-modal').on('click',function(e){
	$('#modal-add-mission').modal('show');

})

$('#tache-attach-add').on('change',function(e){
	updateList();
})

$('#t-attach-list').on('click','.delete-tache-attach',function(){
	let parent = $(this).closest('tr');
	let index = $(parent).attr('data-index');
	attachList.splice(index, 1);
	var HTML ="";
    for(var j=0;j<attachList.length;j++)
    {
    	HTML += '<tr data-index="'+j+'" style="border-bottom: solid 1px #f0f0f0;"><td style="width:80%">' 
              + attachList[j].name
              + '</td><td style="width:10%"><i class="fa fa-trash delete-tache-attach" style="color:#f95e66"></i></td></tr>';
              
    }
   $('#t-attach-list').html(HTML); 
})
$('#modal-add-mission').on('show.bs.modal', function () {
	$(this).find('form').find("input[type=text],input[type=number], textarea").val("");
	attachList.splice(0, attachList.length);
    $('#t-attach-list').html("");
});
