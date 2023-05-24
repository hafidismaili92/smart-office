$.fn.dataTable.ext.errMode = "none"; //disable DATATABLES ERRORS

/***********************************************EXTENT DATATBLES SEARCHS*************************************/
/***global variables for searching****/
var FilterOptions = {
	"affaires-table": {
		filterDate: {},
		filterEtat: {},
		filterAvancement: {},
	},
};

$.fn.dataTable.ext.search.push(function (
	settings,
	searchData,
	index,
	rowData,
	counter
) {
	if (settings.nTable.id == "affaires-table") {
		options = FilterOptions["affaires-table"];
		debut = options.filterDate.dateDebut;
		fin = options.filterDate.dateFin;
		etat = options.filterEtat.value;
		avancementMin = options.filterAvancement.min;
		avancementMax = options.filterAvancement.max;
		if (debut || fin) {
			cellDateValue = moment(
				searchData[options.filterDate.colIndex],
				"DD-MM-YYYY"
			).format();
			if (debut && fin) {
				if (
					!moment(cellDateValue).isAfter(moment(debut)) ||
					!moment(cellDateValue).isBefore(moment(fin))
				)
					return false;
			} else if (debut) {
				if (!moment(cellDateValue).isAfter(moment(debut))) return false;
			}
			if (fin) {
				if (!moment(cellDateValue).isBefore(moment(fin))) return false;
			}
		}
		if (etat) {
			cellEtat = searchData[options.filterEtat.colIndex];
			
			
			if (cellEtat != etat && etat != "Tout") return false;
			else return true;
		}
		if (
			avancementMin != undefined &&
			avancementMin != "" &&
			avancementMax != undefined &&
			avancementMax != ""
		) {
			cellavancement = searchData[options.filterAvancement.colIndex];
			if (cellavancement < avancementMin || cellavancement > avancementMax)
				return false;
		}
	}

	return true;
});
/************************************************************************************************************/
/*******************************************MOMENT PLUGIN***********************************************/
(function (factory) {
	if (typeof define === "function" && define.amd) {
		define(["jquery", "moment", "datatables.net"], factory);
	} else {
		factory(jQuery, moment);
	}
})(function ($, moment) {
	$.fn.dataTable.moment = function (format, locale, reverseEmpties) {
		var types = $.fn.dataTable.ext.type;

		// Add type detection
		types.detect.unshift(function (d) {
			if (d) {
				// Strip HTML tags and newline characters if possible
				if (d.replace) {
					d = d.replace(/(<.*?>)|(\r?\n|\r)/g, "");
				}

				// Strip out surrounding white space
				d = $.trim(d);
			}

			// Null and empty values are acceptable
			if (d === "" || d === null) {
				return "moment-" + format;
			}

			return moment(d, format, locale, true).isValid()
				? "moment-" + format
				: null;
		});

		// Add sorting method - use an integer for the sorting
		types.order["moment-" + format + "-pre"] = function (d) {
			if (d) {
				// Strip HTML tags and newline characters if possible
				if (d.replace) {
					d = d.replace(/(<.*?>)|(\r?\n|\r)/g, "");
				}

				// Strip out surrounding white space
				d = $.trim(d);
			}

			return !moment(d, format, locale, true).isValid()
				? reverseEmpties
					? -Infinity
					: Infinity
				: parseInt(moment(d, format, locale, true).format("x"), 10);
		};
	};
});

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
				
					showInfoBox('error',err.responseText);
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
	$.fn.dataTable.moment("DD-MM-YYYY");
	
	$(".showPopup").on("click", function (e) {
		e.stopPropagation();

		if ($(e.target).hasClass("showPopup-icon"))
			$(this).find(".popupContent").toggleClass("show");
	});
});

$(document).mouseup(function (e) {
	var container = $(".popupContent.show");

	// if the target of the click isn't the container nor a descendant of the container
	if (
		!container.is(e.target) &&
		container.has(e.target).length === 0 &&
		!$(e.target).hasClass("showPopup-icon")
	) {
		if ($(container).hasClass("show")) $(container).toggleClass("show");
	}
});
showLoader = false;
$(document).ajaxStart(function () {
	if (showLoader == true)
		if ($("#loader-container").hasClass("hidden"))
			$("#loader-container").removeClass("hidden");
});

$(document).ajaxComplete(function (event, xhr, settings) {
	if (!$("#loader-container").hasClass("hidden"))
		$("#loader-container").addClass("hidden");
	showLoader = false;
});

function customConfirmedialog(message, dta = null, yesCallback, noCallback) {
	$("#dialog-msg").html(message);
	$("#modal-dialog").modal("show");
	$("#confirm-dialog-btn").off("click");
	$("#confirm-dialog-btn").click(function () {
		$("#modal-dialog").modal("hide");
		yesCallback(dta);
	});
	$("#close-dialog-btn").off("click");
	$("#close-dialog-btn").click(function () {
		$("#modal-dialog").modal("hide");
		noCallback(dta);
	});
}

$(".refresh-table").on("click", function () {
	cible = $(this).attr("data-cible");

	if (cible) {
		$(cible).DataTable().ajax.reload(null, false);
	}
});
function showInfoBox(type,msg,delai=3000,decalage="3vh")
{
  if($.inArray(type,['warning','error','success','info'])>=0)
  {
    var itag ="fa  fa fa-exclamation-triangle";
    var className="error";
    switch(type)
    {
      case 'success':
      itag="fa fa-check";
      className="success";
      break;
      case 'warning':
      className="warning";
    }
    html = '<div class="custom-info-box '+className+'" style="bottom: '+decalage+';"><i class="'+itag+' fa-lg"></i><div>'+msg+'</div></div>';
    $('body').prepend(html);
    $('body .custom-info-box').delay(delai).hide(10, function() {
      $(this).remove();
    });
  }
}