var etablissementTable = $("#etablissements-table").DataTable({
	processing: true,
	dom: "tip",
	ajax: {
		url: BaseUrl + "Etablissements/loadEtablissements",
		type: "post",
		datatype: "json",

		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//$('#etablissements-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','','','','','','','','']).draw();
		},
	},
	serverSide: false,
	responsive: true,
	iDeferLoading: 20,
	lengthMenu: [15, 50, 100],
	pageLength: 15,
	bSortClasses: false,
	columnDefs: [
		{ width: "5%", targets: [0] },
		{ width: "50%", targets: [1] },
		{ width: "15%", targets: [2] },
		{ width: "15%", targets: [3] },
		{ width: "15%", targets: [4] },
		{ className: "dt-center", targets: "_all" },
		{
			render: function (data, type, row) {
				if (type == "display"){
				if(data=='action')
					return '<div style="display:flex;justify-content:space-evenly;"><i class="fa fa-lg fa-trash delete-etablissement table-actions" style="color:#ff5722;cursor:pointer;"></i><i class="fa fa-lg fa-pencil-square-o update-etablissement table-actions text-info" style="cursor:pointer;"></i></div>';
				else
					return '<div style="display:flex;justify-content:space-evenly;"><i class="fa fa-lg fa-trash text-secondary"></i><i class="fa fa-lg fa-pencil-square-o text-secondary"></i></div>';
				}
				else return data;
			},
			targets: 5,
		},
	],
	order: [[0, "desc"]],
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
		sEmptyTable: "Aucune missions programmées",
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
$("#nouvelle-etablissement-form").submit(function (event) {
	event.preventDefault(); //prevent default action
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission

	$.ajax({
		url: post_url,
		type: request_method,
		data: new FormData(this),
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			$("#nouvelle-etablissement-form").closest('.modal').modal('hide');
			etablissementTable.ajax.reload();

		},
		error: function (err) {
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
		},
	});
});
$("#update-etablissement-form").submit(function (event) {
	event.preventDefault(); //prevent default action
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url: post_url,
		type: request_method,
		data: new FormData(this),
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			$("#update-etablissement-form").closest('.modal').modal('hide');
			etablissementTable.ajax.reload(null,false);

		},
		error: function (err) {
			 showInfoBox('error',err.responseText);
		},
	});
});
$("#etablissements-table").on("draw.dt", function () {
	$("#employe-etablissement").empty();
	$("#etablissement-mere").empty();
	$("#etablissement-mere-update").empty();
	etablissementTable.rows().every(function (rowIdx, tableLoop, rowLoop) {
		var tr = this.node();
		var id = tr.cells[0].textContent;
		var libelle = tr.cells[1].textContent;
		
		$("#etablissement-mere").append(
			'<option value="' + id + '">' + libelle + "</option>"
		);
		$("#etablissement-mere-update").append(
			'<option value="' + id + '">' + libelle + "</option>"
		);
		// ... do something with data(), or this.node(), etc
	});
});
$("#etablissement-tab").on("click", ".delete-etablissement", function () {
	parent = $(this).closest("tr");
	customConfirmedialog('Voulez vous supprimer définitivement cette entité?',null,function(){
  
  row = etablissementTable.row(parent);
	code = row.data()[0];
	form_data = new FormData();
	form_data.append("code", code);
	$.ajax({
		/*url: BaseUrl + "Etablissements/hideEtablissement",*/
		url: BaseUrl + "Etablissements/deleteEtablissement",
		type: "post",
		data: form_data,
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			etablissementTable.ajax.reload();
		},
		error: function (err) {
			 showInfoBox('error',err.responseText,5000);
		},
	});
},function(){});
	
});
$("#etablissement-tab").on('click', ".update-etablissement", function(){
	parent = $(this).closest('tr');
	row = etablissementTable.row(parent);
	var libelle = row.data()[1];
	var mere_libelle = row.data()[3];
	var mere_index = -1;
	
	$('#etablissement-mere-update > option').each(function(index){

		if($( this ).attr('value')==row.data()[0])
			$(this).css('display','none');
		else
			$(this).css('display','block');

		if($( this ).text()==mere_libelle)
		{
			mere_index = index;

			$(this).prop('selected', true);
			return false;
		}
	})
	if(mere_index == -1) 
		$('#etablissement-mere-update').val($('#etablissement-mere-update').find('option').length-1);
	var typeLib = row.data()[2];
	var typeindex = -1;
	$('#etablissement-type-update').find('option').each(function(index){
		if($( this ).text()==typeLib)
		{
			$(this).prop('selected', true);
			return false;
		}
	})
	
	$('#etablissements-Libelle-update').text(row.data()[1]);
	$('#code-update').val(row.data()[0]);
	$('#update-etablissement-modal').modal('show');
})
/*********************************ORGANIGRAMME*************************************/
google.charts.load("current", { packages: ["orgchart"] });
// Create the chart.
var chart;

$("#updateOrganigramme").on("click", function () {
	$.ajax({
		url: BaseUrl + "Etablissements/getOrganigramme",
		type: "post",
		data: null,
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			drawChart(JSON.parse(result));
		},
		error: function (err) {
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
		},
	});
});
$("#download-organigramme").on("click", function () {
	var node = document.getElementById("organigramme_div");
	domtoimage
		.toPng(node)
		.then(function (dataUrl) {
			var pdf = new jsPDF("landscape", "mm", "a4");
			pdf.addImage(dataUrl, "PNG", 3, 3);
			//doc.addImage(imgData, 'PNG', 0, 0);
			pdf.save("sample-file.pdf");
		})
		.catch(function (error) {
			console.error("oops, something went wrong!", error);
		});
});
function drawChart($organigrammeRows) {
	var data = new google.visualization.DataTable();
	data.addColumn("string", "Name");
	data.addColumn("string", "Manager");
	data.addColumn("string", "ToolTip");

	data.addRows($organigrammeRows);
	chart = new google.visualization.OrgChart(
		document.getElementById("organigramme_div")
	);
	// Draw the chart, setting the allowHtml option to true for the tooltips.
	chart.draw(data, { allowHtml: true, nodeClass: "organigramme-block" });
	$colors = [
		"redborder",
		"blueborder",
		"greenborder",
		"magentaborder",
		"cyanborder",
	];
	$("#organigramme_div")
		.find(".google-visualization-orgchart-noderow-medium")
		.each(function (index) {
			if (index < 5)
				$(this).find(".organigramme-block").addClass($colors[index]);
			else if (index % 5 == 0)
				$(this)
					.find(".organigramme-block")
					.addClass($colors[index % 5]);
		});
}
