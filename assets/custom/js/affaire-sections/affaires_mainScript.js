

/***************************************************************************************************************/
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/mesAffaires.js");
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/affaire-missions.js");
/*$.getScript(BaseUrl + "assets/custom/js/affaire-sections/details.js");
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/eDocuments.js");
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/mes_taches.js");
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/tache-sousTaches.js");
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/nouvelle-affaire.js");
$.getScript(BaseUrl + "assets/custom/js/affaire-sections/globalAffaires.js");*/
/***************************************************************************************************************/
$("#toggle-sidebar").on("click", function () {
	$("#left-SideBar").toggleClass("hidden");
	$("#main-container").toggleClass("addMargeL");
});

$("#add-rangee").on("click", function () {
	$("#add-rangee-modal").modal("show");
});
$("body").on("click", "#create-rangee", function () {
	if (!$("#nouveau-rangee").val()) {
		$("#rangee-error").css("display", "block");
	} else {
		$.ajax({
			url: BaseUrl + "Users_main/addRangee",
			type: "post",
			data: { rangee: $("#nouveau-rangee").val() },
			success: function (result) {
				updateRangees();
			},
			error: function (err) {
				console.log(err);
				$("body").append(
					'<div class="custom-alert" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #B00F04; opacity:0.9; color: white;z-index:1000;padding:20px;">' +
						err.responseText +
						"</div>"
				);
				$("body .custom-alert")
					.delay(3000)
					.hide(10, function () {
						$(this).remove();
					});
			},
		});
	}
});
function updateRangees() {
	$.ajax({
		url: BaseUrl + "Users_main/getRangeeListHtml",
		type: "post",
		success: function (result) {
			var dta = JSON.parse(result);
			$("body #rangee-container").html(dta["list"]);
			$("body #classement").html(dta["select"]);
		},
		error: function (err) {
			console.log(err);
			$("body").append(
				'<div class="custom-alert" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #B00F04; opacity:0.9; color: white;z-index:1000;padding:20px;">' +
					err.responseText +
					"</div>"
			);
			$("body .custom-alert")
				.delay(3000)
				.hide(10, function () {
					$(this).remove();
				});
		},
	});
}


$(document).ready(function () {
	
	$(".load-employees").on("click", function () {
	$("#employees-modal").modal("show");
	
	
});

	var employeesTable = $("#employees-table").DataTable({
		processing: false,
		stateSave: true,
		ajax: {
			url: BaseUrl + "Affaires/loadEmployees",
			type: "post",
			datatype: "json",

			error: function (XMLHttpRequest, textStatus, errorThrown) {
				// $('#employees-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','']).draw();
			},
		},
		serverSide: false,
		responsive: true,
		iDeferLoading: 20,
		lengthMenu: [8, 25, 50, 100],
		pageLength: 8,
		/*columnDefs : [

{ "width": "7%", "targets": [0] },
{ "width": "34%", "targets": [6] },
{ "width": "28%", "targets": [1] },
],*/

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
	$("#employees-table tbody").on("click", "tr", function () {
		var data = $("#employees-table").DataTable().row(this).data();
		$("#selected-responsable").val(data[0]);
	});
	$("#employees-modal").on("show.bs.modal", function () {
		employeesTable.ajax.reload(null, false);
	});
});
$("#select-responsable").on("click", function () {
	var activeSection = $(".principal-sections").not(".hidden_section").first();
	switch ($(activeSection[0]).attr("id")) {
		case "affaire-missions-section":
			if ($("#modal-edit-mission").is(":visible")) {
				$("#edit-missions-responsable").val($("#selected-responsable").val());
			} else {
				$("#missions-responsable").val($("#selected-responsable").val());
			}

			break;
		case "affaire-sTaches-section":
			$("#sTaches-responsable").val($("#selected-responsable").val());
			break;
		case "nouvelleAffaire-section":
			$("#responsable").val($("#selected-responsable").val());
			break;
	}

	$("#employees-modal").modal("hide");
});

$(document).ready(function () {
	/*window.addEventListener("resize", function () {
		missionsTable.columns.adjust().responsive.recalc();
		affairesTable.columns.adjust().responsive.recalc();
	});*/
	setInterval(function () {
		missionsTable.ajax.reload(null, false);
		
		setTimeout(function () {
			affairesTable.ajax.reload(null, false);
		}, 1000);
	}, 11000);

	
});


