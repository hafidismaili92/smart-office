var affairesTable = $("#affaires-table").DataTable({
	processing: false,
	stateSave: false,
	/*"scrollY":        "70vh",
	"scrollCollapse": true,*/
	ajax: {
		url: BaseUrl + "Affaires/loadAffaires",
		type: "post",
		datatype: "json",

		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//$('#affaires-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','']).draw();
			console.log(XMLHttpRequest.responseText);
		},
	},
	serverSide: false,
	responsive: {
		details: {
			renderer: function (api, rowIdx, columns) {
				var data = $.map(columns, function (col, i) {
					return col.hidden
						? '<tr data-dt-row="' +
								col.rowIndex +
								'" data-dt-column="' +
								col.columnIndex +
								'" style="width:100%;">' +
								"<td>" +
								col.title +
								":" +
								"</td> " +
								"<td>" +
								col.data +
								"</td>" +
								"</tr>"
						: "";
				}).join("");

				return data ? $("<table/>").append(data) : false;
			},
		},
	},
	iDeferLoading: 20,
	"order": [[ 3, "desc" ]],
	dom: "Btip",
	lengthMenu: [15, 50, 100],
	pageLength: 15,
	bSortClasses: false,
	columnDefs: [
		
		{
			render: function (data, type, row) {
				if(type=="display")
				{
					return  '<div class="dropdown dropdown-action"><a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a><div class="dropdown-menu dropdown-menu-right"><span class="dropdown-item affaires-actions show-missions" >Liste des missions</span><span class="dropdown-item affaires-actions show-details" >Détails</span><span class="dropdown-item affaires-actions delete-affaire" >Supprimer</span></div></div>';
				
				}
			},
			targets: 6,
		},
		{
			render: function (data, type, row) {
				if(type=="display")
				{
				color = "#e6a40f";
				if (data == "En souffrance") {
					return '<label class="badge badge-gradient-danger">En Souffrance</label>';
				} 
				else if (data == "Terminee") {
					return '<label class="badge badge-gradient-success">Terminée</label>';
				}
				else if(row[2]==0)
					{
					return '<label class="badge badge-gradient-info">Non Commencée</label>';
				}
				else
				{
					return '<label class="badge badge-gradient-warning">En Cours</label>';
				}
			}
			else return data;
			},
			targets: 4,
		},
		{
			render: function (data, type, row) {
				if(type=="display"){
					var classeName = "bg-gradient-warning";
				if(row[4]=="Terminee") {classeName = "bg-gradient-success"}
				else if(row[4]=="En souffrance") {classeName = "bg-gradient-danger"}
				return '<div class="progress"><div class="progress-bar '+classeName+'" role="progressbar" style="width:'+data+'%" aria-valuenow="'+data+'" aria-valuemin="0" aria-valuemax="100"></div></div>';
				
				}
				else return data;
				
			},
			targets: 2,
		},
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
	language: {
		sProcessing: "Traitement en cours...",
		sSearch: "Rechercher:",
		sLengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
		sInfo:
			"Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
		sInfoEmpty:
			"Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
		sInfoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		sInfoPostFix: "",
		sLoadingRecords: "Chargement en cours...",
		sZeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
		sEmptyTable: "Aucune donn&eacute;e disponible dans le tableau",
		oPaginate: {
			sFirst: "Premier&nbsp;&nbsp;",
			sPrevious: "<",
			sNext: ">",
			sLast: "&nbsp;&nbsp;Dernier",
		},
		oAria: {
			sSortAscending: ": activer pour trier la colonne par ordre croissant",
			sSortDescending:
				": activer pour trier la colonne par ordre d&eacute;croissant",
		},
	},
});

$("#mesaffaires").on("click", function (e) {
	e.preventDefault();
	if($("#mesAffaires-section").hasClass("hidden_section"))
	{
	$(".principal-sections").addClass("hidden_section");
	$("#mesAffaires-section").removeClass("hidden_section");
	$(this).closest(".sub-menus").find("a").removeClass("active");
	$(this).addClass("active");
	}
	
	
});

$(document).ready(function () {
	affairesTable.buttons().container().appendTo("#btns-group");
});
$("#aff-length").change(function () {
	affairesTable.page.len($(this).val()).draw();
});

$("#search-Affaires").keyup(function () {
	affairesTable.search($(this).val()).draw();
});

$("#aff-period").on("change", function () {
	affairesPeriode = $(this).val();
	affairesTable.ajax.reload(null, false); //prevent page reset
});

$("#affaires-table").on("draw.dt", function () {
	$countTermine = affairesTable
		.rows()
		.column(3)
		.data()
		.filter(function (val, index) {
			return (value = "Terminee" ? true : false);
		}).length;
	$countEnCours = affairesTable
		.rows()
		.column(3)
		.data()
		.filter(function (val, index) {
			return (value = "En cours" ? true : false);
		}).length;
	$countEnSouffrance = affairesTable
		.rows()
		.column(3)
		.data()
		.filter(function (val, index) {
			return (value = "En Souffrance" ? true : false);
		}).length;

	$countGlobal = $countTermine + $countEnCours;

	if (
		$.isNumeric($countEnSouffrance) &&
		$.isNumeric($countEnCours) &&
		$.isNumeric($countTermine)
	) {
		$("#count-enSouffrance-affaires").text(
			$countEnSouffrance + "/" + $countEnCours
		);
		$("#count-enCours-affaires").text($countEnCours + "/" + $countGlobal);
		$("#count-terminee-affaires").text($countTermine + "/" + $countGlobal);
		$("#count-global-affaires").text($countGlobal);
	} else {
		$("#count-enSouffrance-affaires").text("--");
		$("#count-enCours-affaires").text("--");
		$("#count-terminee-affaires").text("--");
		$("#count-global-affaires").text("--");
	}
});

/********************************NOUVEL AFFAIRE*********************************/
/*autocomplete contrat suggestions*/
$( "#numero-contrat" ).autocomplete({
	source: function (request, response) {
			 $.ajax({
		  url: "Affaires/suggestContrats",
			 type: "POST",
			 data: request,
			 dataType: 'json',
			 success: function (data) {
				
			   response($.map(data, function (el) {
				
				 return {
							 label: el.numerocontrat,
							 value: el.numerocontrat
						 };
				}));
			  }
			});
		},
	});




$("#add-affaire-btn").on("click", function () {
	$("#add-affaire-modal").modal("show");
});

$("#affaire-form").submit(function (event) {
	event.preventDefault(); //prevent default action
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	$.ajax({
		url: post_url,
		type: request_method,
		data: new FormData(this),
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			if(result==2)
				{
					showInfoBox('warning','Ce numero d\'affaire est déja utilisé, Veuillez choisir un autre',4000);
				}
				else
				{
					affairesTable.ajax.reload(null, false); //prevent page reset
			$("#geom-type").val("");
			$("#geom-coordonnees").val("");
			$("#add-affaire-modal").modal("hide");
			$("#feature-added-notify").css("display", "none");
			showInfoBox('success',result);
			
				}
			
		},
		error: function (err) {
			console.log(err);
			showInfoBox('error',err.responseText);
			
			
		},
	});
});

$(".showPopup").on("click", "#apply-date-affaire-filter", function (e) {
	dte_debut = $(this).closest(".popupContent").find(".date-filter-start").val();
	dte_fin = $(this).closest(".popupContent").find(".date-filter-end").val();

	if (dte_fin || dte_debut) {
		console.log(dte_debut);
		FilterOptions["affaires-table"].filterDate = {
			dateDebut: dte_debut,
			dateFin: dte_fin,
			colIndex: 2,
		};
		tble = $(this).closest("table").DataTable();
		tble.draw();
	} else {
		FilterOptions["affaires-table"].filterDate = {};
	}
	$(this).closest(".popupContent").toggleClass("show");
});
$('.filterAffaire').on('click',function(e){

e.preventDefault();

	val = $(this).attr("data-value");
	let colIndex = 4;
	let text = "";
	switch(val){
		
		case '1':
		text = "En cours"
		break;
		case '2':
		text = "Terminee"
		break;
		case '3':
		text = "En souffrance"
		break;
		default:
		text = ""
		break;
	}
	
	if(text!=""){
			FilterOptions["affaires-table"].filterEtat = {
			value: text,
			colIndex: 4,
		}
		}
		else
		{
			FilterOptions["affaires-table"].filterEtat = {};
		}
		affairesTable.draw();
})
/*$(".showPopup").on("click", "#apply-etat-affaire-filter", function (e) {
	etat = $(this).closest(".popupContent").find("select").val();

	if (etat) {
		FilterOptions["affaires-table"].filterEtat = {
			value: etat,
			colIndex: 3,
		};
		tble = $(this).closest("table").DataTable();
		tble.draw();
	} else {
		FilterOptions["affaires-table"].filterEtat = {};
	}
	$(this).closest(".popupContent").toggleClass("show");
});*/

$("#reset-affaire-filter").on("click", function () {
	FilterOptions["affaires-table"].filterEtat = {};
	FilterOptions["affaires-table"].filterDate = {};
	tble.draw();
});

$("#affaires-table").on("click", ".delete-affaire", function () {
	showLoader = true;
	parent = $(this).closest("tr");
	row = affairesTable.row(parent);
	numero = row.data()[0];
	customConfirmedialog('Voulez vous supprimer définitivement cette affaire et ses tâches?',null,function(){

	form_data = new FormData();
	form_data.append("numero", numero);
	$.ajax({
		url: BaseUrl + "Affaires/deleteAffaire",
		type: "post",
		data: form_data,
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			affairesTable.ajax.reload();
			selectedAffaire = '';
			$('.numero-affaire-title').text('');
			missionsTable.ajax.reload( null, false );
		},
		error: function (err) {
			showInfoBox('error',err.responseText);
			
		},
	});
	 },function(){});
	
});

/************************************DETAILS*****************************************/
$(document).ready(function(){
	$('#affaires-table').on('click','.show-details',function(){
		let parent = $(this).closest('tr');
		var data = affairesTable.row(parent).data();
		selectedAffaire = data[0];
		getDetails(selectedAffaire)
		$('#affaire-details').modal('show');
		

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
				
				$(statuText).css('color','green');
				
			}
			else if (dta['statut']=='2')
			{
				$(statuText).text('En souffrance');
				
				$(statuText).css('color','red');
			}
			else
			{
				$(statuText).text('En cours');
				
				$(statuText).css('color','#ff7600');
			}
			$('.num-affaire-text').text(dta['numero_affaire']);
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
			$('#detail-tacheEnSouffrance').text(dta['tachesensouffrance']);
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
			showInfoBox('error',err.responseText)
		}
	})
});
$('#modal-edit-affaire').on('hidden.bs.modal', function () {
	
    $('#edit-missions-form').find('input,textarea,select').val("");
});
