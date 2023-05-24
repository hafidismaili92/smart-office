$('#taches-items').on('click',function(){

	$('.principal-items').removeClass('active');
	$('li').removeClass('active');
	$(this).addClass('active');
	
	$('#main-container').find('section').addClass('hidden_section');
	$("#mesTaches-section").removeClass('hidden_section');
	$('#taches-table').DataTable().columns.adjust().responsive.recalc();
})

var tachesTable = $('#taches-table').DataTable(
{
	"processing": false,
	
	"ajax": {
		url: BaseUrl+'Taches/loadTaches',
		type: "post",
		datatype:"json",
		
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{
			//$('#taches-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','','','','','','','','','','']).draw();
		
		}
	},
	"serverSide": false,
	"stateSave": true,
	responsive: true,
	"dom": 'Btip',
	"iDeferLoading": 20,
	"lengthMenu": [8,12],
	"pageLength": 12,
	"bSortClasses": false,
	columnDefs : [
	{
			render: function (data, type, row) {

				if(type=="display"){
					var classeName = "bg-gradient-warning";
				if(row[12]==1) {classeName = "bg-gradient-success"}
				else if(row[12]==-1) {classeName = "bg-gradient-danger"}
				return '<div class="progress"><div class="progress-bar '+classeName+'" role="progressbar" style="width:'+data+'%" aria-valuenow="'+data+'" aria-valuemin="0" aria-valuemax="100"></div></div>';
				}
				else return data;
			},
			targets: 5,
		},
	{"targets": [ 7,8,9,10,11,12,13,14,15 ],"visible": false,"searchable": false}
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
				filename: "Liste-mes-Taches ",
				title: "Liste de mes tâches",
				exportOptions: {
					columns: ":not(.colAction)",
				},
			},
		],
	},
	"order": [[ 6, "desc" ]],
	"createdRow": function( row, data, dataIndex){

		if( data[12] == -1 ){
			$(row).addClass('tache-redRow');
		}
		if( data[12] == 1 ){
			$(row).addClass('tache-greenRow');
		}
		else if(data[15]=='f')
		{
			$(row).addClass('tache-blueRow');
		}
	},
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
		"sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
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

$('#taches-table tbody').on('click','.tache-actions-detail', function () {
	$('#tache-details').modal('show');
	$('#soustache-attach-detail').html("");
	let parent = $(this).closest("tr");
	var data = $('#taches-table').DataTable().row( parent ).data();
	
	$('#tache-num').text(data[1]);
	$('#tache-label').text(data[2]);
	$('#tache-createur').text(data[4]);
	$('#tache-date-creation').text(data[6]);
	$('#tache-date-finPrevue').text(data[8]);
	$('#tache-validation-date').text(data[9]);
	$('#tache-avancement').val(data[5].replace('%',''));
	$('#taches-observation').text(data[14]);
	$('#tache-affaire').text(data[3]);
	$('#tache-etat').css('color','white');
	switch(data[12])
	{
		case 1:
		//$('#tache-etat').text('validée');
		$('#tache-etat').html('<span style="background-color:green;padding: 1px 3px;border-radius:5px;">validée<span>');
		break;
		case -1:
		//$('#tache-etat').text('En souffrance');
		$('#tache-etat').html('<span style="background-color:red;padding: 1px 3px;border-radius:5px;">En souffrance<span>');
		break;
		default:
		//$('#tache-etat').text('En cours');
		$('#tache-etat').html('<span style="background-color:orange;padding: 1px 3px;border-radius:5px;">En cours<span>');

	}

	
	var missionsData = new FormData();
missionsData.append('affaire',data[3]);
missionsData.append('numero',data[1]);
missionsData.append('resp','RESP');
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
				$('#soustache-attach-detail').html(html);
		},
		error: function(err){

		}
	})
	

} );
$('#mise-ajour-tache').on('click',function(){
	dta = new FormData();
	dta.append('numero',$('#tache-num').text());
	dta.append('numero_affaire',$('#tache-affaire').text());
	dta.append('avancement',$('#tache-avancement').val());
	dta.append('observation',$('#taches-observation').val());
	$.ajax({
		url : BaseUrl+'Taches/UpdateTache',
		type: 'post',
		data : dta,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$('#tache-details').modal('hide');
			tachesTable.ajax.reload( null, false );
			
		},
		error: function(err){
			showInfoBox('error',err.responseText);
		}
	})

})

$(document).ready(function(){
	tachesTable.buttons().container().appendTo("#btns-group");
	window.addEventListener("resize", function () {
		
		tachesTable.columns.adjust().responsive.recalc();
	});
	tacheNonconsulte();
	setTimeout(function () {
			tachesTable.ajax.reload(null, false);
		}, 2000);
})


function tacheNonconsulte()
{
	$.ajax({
		url : BaseUrl+'Taches/nonConsulteTaches',
		type: 'post',
		data : null,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			dta = JSON.parse(result);
			$('#countUnconselted-tache').text(dta['nonconsulte']);
			if(dta['nonconsulte']>0)
			{
				$('#taches-bell').css('color','rgb(242,186,13)');
			}
			else
			{
				$('#taches-bell').css('color','#3c485878');
			}
			if(dta['nonvu']>0)
			{
				tachesTable.ajax.reload( null, false );
				$('body').append('<div class="custom-notification" style="position: absolute;right: 10px;bottom: 10px;width: 300px;height: 200px;background-color: white;-webkit-box-shadow: -1px -2px 14px 0px rgba(0,0,0,0.75);-moz-box-shadow: -1px -2px 14px 0px rgba(0,0,0,0.75);box-shadow: -1px -2px 14px 0px rgba(0,0,0,0.75);" id="notification-pannel"><div style="text-align: center;width: 100%; border-bottom: 2px solid rgba(0,0,0,0.1);margin-top: 10px;"><i class="fas fa-bell fa-2x" style="color:rgba(65, 95, 241, 1);" id="taches-bell"></i></div><div style="display: flex;flex-direction: column;justify-content: center;height: 100px;padding-left: 25px;"><h6>vous avez '+dta['nonvu']+' nouvelle(s) Taches</h6></div></div>');
			$('body .custom-notification').delay(4000).hide(10, function() {
				$(this).remove();
			})
			}
			
			
		},
		error: function(err){

		}
	})
	.always(function () {
            setTimeout(tacheNonconsulte, 5000);
        });
}

$('#taches-table-length').change( function() { 
	tachesTable.page.len( $(this).val() ).draw();
});

$('#search-taches').keyup(function(){
	tachesTable.search($(this).val()).draw() ;
});