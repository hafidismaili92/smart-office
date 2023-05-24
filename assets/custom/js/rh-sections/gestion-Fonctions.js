$("#main-gestions-container .nav-item a").on("click", function () {
	$("#main-gestions-container .nav-item").removeClass("active");
	$(this).closest(".nav-item").addClass("active");
});


var functionsTable = $("#fonctions-table").DataTable({
	processing: true,
	dom: "tip",
	//scrollY: "70vh",
	scrollCollapse: true,
	ajax: {
		url: BaseUrl + "Fonctions/loadFonctions",
		type: "post",
		datatype: "json",

		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//$('#fonctions-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','','','','','','','','']).draw();
		},
	},
	serverSide: false,
	responsive: true,
	iDeferLoading: 20,
	lengthMenu: [15, 50, 100],
	pageLength: 15,

	bSortClasses: false,
	columnDefs: [

		{ targets: [6], visible: false, searchable: false },
		{ className: "dt-center", targets: "_all" },
		{
			render: function (data, type, row) {
				if (type == "display")
					return '<i class="fa fa-lg fa-trash delete-fonction table-actions" style="color:#ff5722;cursor:pointer;"></i>';
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
		sEmptyTable: "Aucune Fonction trouvée",
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
$("#nouvelle-fonction-form").submit(function (event) {
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
			$("#nouvelle-fonction-form").closest('.modal').modal('hide');
			functionsTable.ajax.reload();
		},
		error: function (err) {
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
		},
	});
});

$("#fonctions-table").on("draw.dt", function () {
	$("#employe-fonction").empty();

	functionsTable.rows().every(function (rowIdx, tableLoop, rowLoop) {
		dta = this.data();
		var tr = this.node();
		var id = dta[0];
		var libelle = dta[1];

		if (dta[6] != "t") {
			$(".employe-fonction-list").append(
				'<option value="' + id + '">' + libelle + "</option>"
			); //exclude Director
		}
	});
});



$(".header-tab").click(function (e) {
	parent = e.target.closest(".header-tab");
	position = $(parent).offset();

	$(".header-tab").removeClass("active");

	$(parent).addClass("active");
});
$("#fonctions-tab").on("click", ".delete-fonction", function () {
	parent = $(this).closest("tr");
	row = functionsTable.row(parent);
	code = row.data()[0];
	form_data = new FormData();
	form_data.append("code", code);
	$.ajax({
		url: BaseUrl + "Fonctions/hideFonction",
		type: "post",
		data: form_data,
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			functionsTable.ajax.reload();
		},
		error: function (err) {
			 showInfoBox('error','fichier "'+err.responseText+'" invalide');
		},
	});
});
