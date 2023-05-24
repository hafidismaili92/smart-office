var employeesTable = $("#employees-table").DataTable({
	processing: false,

	ajax: {
		url: BaseUrl + "Employes/listeEmployees",
		type: "post",
		datatype: "json",

		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//$('#affaires-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','']).draw();
		},
	},
	serverSide: false,
	responsive: true,
	"order": [[ 12, "desc" ]],
	dom: "Btip",
	iDeferLoading: 20,
	lengthMenu: [15, 30, 50, 100],
	pageLength: 15,
	bSortClasses: false,
	autoWidth: true,
	columnDefs: [
		{ targets: [0, 1, 2, 3, 4,6,7, 20], className: "colVisible dt-center" },
		{
			targets: [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
			className: "dt-center",
		},
		{ targets: [5, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,18,19], visible: false },
		{ targets: 17, className: "dt-body-right colAction dt-center" },
	],
	buttons: {
		dom: {
			button: {
				className: "",
			},
		},
		buttons: [
			{
				extend: "colvis",
				text: '<i class="fa fa-eye" aria-hidden="true"></i>',
				className: "btn btn-setVisibility",
				columns: ":not(.colVisible)",
			},
			{
				extend: "excelHtml5",
				text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
				className: "btn btn-exportExcel",
				filename: "Liste_personnel " + moment().format("dd-mm-yyyy"),
				title: "Liste du Personnel Le " + moment().format("DD-MM-YYYY"),
				exportOptions: {
					columns: ":not(.colAction)",
				},
				/*customize: function ( xlsx ) {
			var sheet = xlsx.xl.worksheets['sheet1.xml'];

			$('row c[r=2]', sheet).attr( 's', '6' );
		}*/
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
$(document).ready(function () {
	let container = $(".btns-group[data-table='employees-table']");
	employeesTable.buttons().container().appendTo(container);
});
$("#employees-table").on("click", ".employee-action", function () {
	var trNode = $(this).closest("tr");
	var rowData = employeesTable.row(trNode).data();
	$("#matricule-gestion").val(rowData[1]);
	$("#gestion-employee").trigger("click");
});
$("#employees-table").on(
	"column-visibility.dt",
	function (e, settings, column, state) {
		employeesTable.columns.adjust().draw(false);
	}
);
$("#personnel-length").change(function () {
	employeesTable.page.len($(this).val()).draw();
});

$("#search-personnel").keyup(function () {
	employeesTable.search($(this).val()).draw();
});

$("#liste-employe").on("click", function (e) {
	e.preventDefault();
	if($("#liste-employee-section").hasClass("hidden_section"))
	{
	$(".principal-sections").addClass("hidden_section");
	$("#liste-employee-section").removeClass("hidden_section");
	$(this).closest(".sub-menus").find("a").removeClass("active");
	$(this).addClass("active");
	}
	
	
});

