$('#menu-list-client').on('click',function(){
	$('#sidebar li').removeClass('active');
	$(this).addClass('active'); 
	$('#main-container').find('section.principal-sections').addClass('hidden_section');
	$("#addclient-section").removeClass('hidden_section');
	clientsTable.ajax.reload( null, false );
});

var clientsTable = $('#clients-table').DataTable(
{
	"processing": true,
	"serverSide": false,
	"initComplete": function() {
		this.fnAdjustColumnSizing(true);
	},
	"info": false,
	"ajax": {
		url: BaseUrl+'Clients/loadClients',
		type: "post",
		datatype:"json",
		
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{


			//$('#clients-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','']).draw();
		}
	},
	responsive: true,
	"autowidth":false,
	"bSortClasses": false,
	"dom": 'Btip',
	paging: true,
	
	buttons: {
		dom: {
			button: {
				className: ''
			}
		},
		buttons: [
		
		{
			extend: 'excelHtml5',
			text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
			className: "btn btn-exportExcel table-action",
			filename:'Liste_Clients ',
			title:'Liste Des Clients',

		}

		]},
		"lengthMenu": [8,25,50,100],
		"pageLength": 25,
		columnDefs : [

		{"orderable": false, "targets":  [2,3,4,5,6]},
		{ "width": "15%", "targets": [1,5,6] },
		{ "width": "12%", "targets": 1 },
		{ "width": "8%", "targets": 0},
		{ "width": "10%", "targets": [2,3,4] },
		{"className": "dt-center", "targets": [9]}

		],

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
$(document).ready(function(){
	clientsTable.buttons().container()
	.appendTo( '#btns-client-exports' );

})
$("#nouveau-client-form").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : new FormData(this),
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$('#add-client-modal').modal('hide');
			clientsTable.ajax.reload( null, false );


		},
		error: function(err){

			 showInfoBox('error',err.responseText);

		}
	})
});
$('#clients-table').on('click','.client-actions-edit',function(){
	
	parent = $(this).closest('tr');
	dta = clientsTable.row(parent).data();
	$('#edit-client-nom').val(dta[1]);
	$('#edit-client-identifiant').val(dta[0]);
	$('#ancien-client-identifiant').val(dta[0]);
	$('#edit-client-representant').val(dta[5]);
	$('#edit-client-email').val(dta[4]);
	$('#edit-client-fax').val(dta[3]);
	$('#edit-client-tel').val(dta[2]);
	$('#edit-client-ice').val(dta[7]);
	$('#edit-client-adresse').val(dta[6]);
	$('#edit-client-modal').modal('show');
})
$('#edit-client-modal').on('hidden.bs.modal', function () {
	
	$('#edit-client-form').find('input,textarea,select').val("");
});
$("#edit-client-form").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : new FormData(this),
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$('#edit-client-modal').modal('hide');
			clientsTable.ajax.reload( null, false );


		},
		error: function(err){

			 showInfoBox('error',err.responseText);

		}
	})
});
$('#clients-table').on( 'draw.dt', function () {
	$('#nbr-client').text(clientsTable.rows().count());
	$('#client-contrat').empty();
	$('#client-contrat').append('<option selected></option>');
	clientsTable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
		var tr = this.node();
		var id = tr.cells[0].textContent;
		$('#client-contrat').append('<option value="'+id+'">'+id+'</option>');
    // ... do something with data(), or this.node(), etc
} );

} );

$('#client-length').change( function() { 
	clientsTable.page.len( $(this).val() ).draw();
});

$('#client-search').keyup(function(){
	clientsTable.search($(this).val()).draw() ;
});

