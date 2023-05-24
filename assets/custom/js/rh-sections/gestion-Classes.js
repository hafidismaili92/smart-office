var classeTable = $("#classes-table").DataTable({
	processing: true,
	dom: "tip",
	ajax: {
		url: BaseUrl + "Classes/loadClasses",
		type: "post",
		datatype: "json",

		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//$('#classes-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','']).draw();
		},
	},
	serverSide: false,
	responsive: true,
	iDeferLoading: 20,
	lengthMenu: [15, 50, 100],
	pageLength: 15,

	bSortClasses: false,
	columnDefs: [
		{ width: "20%", targets: [0] },
		{ width: "50%", targets: [1] },
		{ width: "30%", targets: [2] },
		{ className: "dt-center", targets: "_all" },
		{
			render: function (data, type, row) {
				return data + " DH";
			},
			targets: 2,
		},
		{
			render: function (data, type, row) {
				if (type == "display")
					return '<i class="fa fa-lg fa-trash delete-classe table-actions" style="color:#ff5722;cursor:pointer;"></i>';
				else return data;
			},
			targets: 3,
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
		sEmptyTable: "Aucune Classe trouvée",
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
$("#nouvelle-classe-form").submit(function (event) {
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
			$("#nouvelle-classe-form").closest('.modal').modal('hide');
			classeTable.ajax.reload();
		},
		error: function (err) {
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
		},
	});
});

$("#classes-table").on("draw.dt", function () {
	$("#fonction-classe").empty();

	classeTable.rows().every(function (rowIdx, tableLoop, rowLoop) {
		var tr = this.node();
		var id = tr.cells[0].textContent;
		var libelle = tr.cells[1].textContent;
		$("#fonction-classe").append(
			'<option value="' + id + '">' + libelle + "</option>"
		);

		// ... do something with data(), or this.node(), etc
	});
});

$("#classes-tab").on("click", ".delete-classe", function () {
	parent = $(this).closest("tr");
	row = classeTable.row(parent);
	code = row.data()[0];
	form_data = new FormData();
	form_data.append("code", code);
	$.ajax({
		url: BaseUrl + "Classes/hideClasse",
		type: "post",
		data: form_data,
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			classeTable.ajax.reload();
		},
		error: function (err) {
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
		},
	});
});
