



$('#menu-list-devis').on('click',function(){
	$('#sidebar li').removeClass('active');
	$(this).addClass('active'); 
	$('#main-container').find('section.principal-sections').addClass('hidden_section');
	$("#devis-section").removeClass('hidden_section');
	
});
/*********************************************ORDER DATA INSIDE HTML INPUT TAG************/
$.fn.dataTable.ext.order['dom-text'] = function  ( settings, col )
{
    return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
        return $('input', td).val();
    } );
};
/***********************************************custom search plugin*************************************/
/*$.fn.dataTable.ext.search.push(
	function( settings, searchData, index, rowData,counter) {

		if (settings.nTable.id !== 'nouveau-devis-table' || $('#addDevis-search').val()==''){
			return true;
		}
		
		if (index<settings.aoData.length)
		{
			tr = settings.aoData[index].nTr;
		$(tr).find('input').each(function( ind ) {
			
			if($(this).val().toLowerCase().search($('#addDevis-search').val().toLowerCase()) >= 0)
			{
				console.log('founded');
				return true;

			}	
		});
		}
		else
		{
			return true;
		}
		
        return false;
    }
    ); */
/************************************************************************************************************/
var nouveauDevisTable = $('#nouveau-devis-table').DataTable(
{
	"processing": false,
	paging: true,
	"searching": true,
	"info": true,
	"createdRow": function( row, data, dataIndex){

		var tva = parseFloat($('#devis-tva').val());
		var totalHt = parseFloat($('#total-ht-devis').text())+parseFloat($(row).find('.tbl-total-prix').val());
		$('#total-ht-devis').text(totalHt);
		$('#total-ttc-devis').text(totalHt +(totalHt *tva/100));

	},
	
	columnDefs: [
		{targets: [1,3],className: 'centred-column'},
	{targets: [2],className: 'justif-column'},
	{ "width": "5%", targets: 0 },
	{ "width": "25%", targets: 1 },
	{ "width": "15%", targets: [2,3,4] },
	{ "width": "20%", targets: 5 },
	{ "width": "5%", targets: 6 },
	{ responsivePriority: 1, targets: 0 },
	{ responsivePriority: 2, targets: 1 },
	{ responsivePriority: 3, targets: 3 },
	{ responsivePriority: 4, targets: 2 },
	
	
	{
      targets:'_all',
      orderDataType: "dom-text", type: 'string',
      render: function (data, type, row, meta) {
        if (type === 'filter') {
          return $(data).val();
        }
        return data;
      }
    }
	],
	"ordering": false,
	"dom": 'tip',
	"autoWidth": false,
	"serverSide": false,
	responsive: true,
	"iDeferLoading": 20,
	"lengthMenu": [15,50,100],
	"pageLength": 15,
	language: {
		"sProcessing": "Traitement en cours...",
		"sSearch": "Rechercher:",
		"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
		"sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
		"sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
		"sInfoFilte#ff1a1a": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		"sInfoPostFix": "",
		"sLoadingRecords": "...",
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

$('#prix-devis-xls-file').on('change',function(){
	$('body').loadingModal({
		position:'auto',
		text:'',
		color:'#fff',
		opacity:'0.6',
		backgroundColor:'rgb(92, 150, 37)',
		animation:'wanderingCubes'
	});
	frmdta = new FormData();
	var fileName = $(this).val();
	var fileExtension = fileName.split('.').pop().toLowerCase();
	allowedExtension = ['xlsx','xls'];
	if(jQuery.inArray(fileExtension,allowedExtension) != -1)
	{
		var file_data=$(this).prop("files")[0];
		frmdta.append('fileXls',file_data);
		$(this).val('');
		$.ajax({

			type:"POST",
			url: BaseUrl+'ExcelOperations/prixFromXls',
			datatype:"text",
			cache:false,
			contentType:false,
			processData:false,
			data:frmdta,
			success: function(result){
				$('body').loadingModal('destroy');
				tbl = $('#nouveau-devis-table').dataTable();
				tbl.fnAddData(JSON.parse(result));
				nouveauDevisTable.page('last').draw('page');


			},
			error: function(error)
			{
				showInfoBox('error',err.responseText);
			}
		})
	}
	else
	{
		$('body').loadingModal('destroy');
		showInfoBox('error','Fichier Non autorisé');
		
	}
})

$('#btn-add-prix-devis').on('click',function(){
	var v = validatePriceInputs('#devis-prix-data-container');

	if(!v.valid)
	{
		showInfoBox('error',v.msg);
		
	}
	else
	{

		nouveauDevisTable.row.add(v.data).draw();
		nouveauDevisTable.page('last').draw('page');
	}
})

$('#nouveau-devis-table').on('click','.remove-prix',function(){
	trNode = $(this).parents('tr');
	var totalHt = parseFloat($('#total-ht-devis').text())-parseFloat($(trNode).find('.tbl-total-prix').val());
	$('#total-ht-devis').text(totalHt );
	var tva = parseFloat($('#devis-tva').val());
	$('#total-ttc-devis').text(totalHt +(totalHt *tva/100));
	nouveauDevisTable.row( $(trNode) )
	.remove()
	.draw();
})

$('#nouveau-devis-table').on('input','input',function(){

	if($(this).hasClass("tbl-pu-prix") || $(this).hasClass("tbl-quantite-prix") )
	{

		var parent = $(this).parents('tr');
		var tva = parseFloat($('#devis-tva').val());
		var intitialVal = $(parent).find('.tbl-total-prix').val();
		totalCol = $(parent).find('.tbl-quantite-prix').val()*$(parent).find('.tbl-pu-prix').val();
		$(parent).find('.tbl-total-prix').val(totalCol);
		totalht = parseFloat($('#total-ht-devis').text())+parseFloat(totalCol)-parseFloat(intitialVal);
		$('#total-ht-devis').text(totalht);
		$('#total-ttc-devis').text(totalht+(totalht*tva/100));
	}

})

$('#devis-tva').on('input',function(){

	var totalHt  = parseFloat($('#total-ht-devis').text());
	var tva = parseFloat($(this).val());
	$('#total-ttc-devis').text(totalHt +(totalHt *tva/100));
})




var listeDevis = $('#liste-devis-table').DataTable(
{
	orderCellsTop: true,
	"order": [[ 4, "desc" ]],
	fixedHeader: true,
	"processing": false,
	paging: true,
	"searching": true,
	"info": true,
	"ajax": {
		url: BaseUrl+'Devis/loadDevis',
		type: "post",
		datatype:"json",
		/*success:function(json)
		{	
			if(json['data'].length>0)
			{
				try
				{
					$('#liste-devis-table').dataTable().fnAddData(json['data']);
				}
				
				catch(e)
				{
					
				}
			}
			else
			{
				$('#liste-devis-table').DataTable().clear().draw();
			}
			$("#devis-section").find(".btn-exportUnpayedFacture").removeClass("dt-button");
		},*/
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{

		}
	},
	"ordering": true,
	columnDefs: [
	{targets: [0],"visible": false},
	{ type: 'formatted-num', targets: [5,6] },
	{ responsivePriority: 1, targets: 1 },
	{ responsivePriority: 2, targets: 2 },
	{ responsivePriority: 3, targets: 3 },
	{ responsivePriority: 4, targets: 6 },
	{ className:'colAction', targets: [6] },
	{ className: 'dt-center',"targets": [1,2,3,4,5,6]},
	{"render": function ( data, type, row ) {
		if(type!='export')
		{
			var num = $.fn.dataTable.render.number(' ', '.', 2).display(data);              
			return num;
		}
		else
			return data;  
	},
	"targets": [3] },
	],
	buttons:{
		dom: {
			button: {
				className: ''
			}
		},
		buttons: [
		{
			extend: 'excelHtml5',
			text:'<i class="fa fa-file-excel-o"></i>',
			className:'btn btn-exportExcel table-action',
			filename:'Liste_Factures ',
			title:'Liste Des Devis au '+moment().format('DD-MM-YYYY'),
			exportOptions: {
				columns: ':not(.colAction)',
				orthogonal: 'export'
			}
		}
		],
	},
	
	"dom": 'Btip',
	"autoWidth": false,
	"serverSide": false,
	responsive: true,
	"iDeferLoading": 20,
	"lengthMenu": [15,50,100],
	"pageLength": 15,
	language: {
		"sProcessing": "Traitement en cours...",
		"sSearch": "Rechercher:",
		"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
		"sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
		"sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
		"sInfoFilte#ff1a1a": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		"sInfoPostFix": "",
		"sLoadingRecords": "...",
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

$('#nouveau-devis-form').submit(function(e){
  e.preventDefault(); //prevent default action 
  
  var empty = true;
  var validprice=true;
  var nums =[];
  var msg='';
  nouveauDevisTable.rows().every(function (index, element) {
  	empty = false;
  	var tr = this.node();

  	var prix =$(tr).find('.tbl-numero-prix').val();
  	var lib =$(tr).find('.tbl-libelle-prix').val();
  	var unite =$(tr).find('.tbl-unite-prix').val();
  	var quanttite =$(tr).find('.tbl-quantite-prix').val();
  	var pu = $(tr).find('.tbl-pu-prix').val();
  	if([prix,lib,unite,quanttite,pu].includes(""))
  	{

  		msg='Valeur Null en ligne : '+(index+1);
  		validprice=false;
  	}
  	else if(isNaN(quanttite) || quanttite<=0)
  	{
  		msg='Quantité non valide en ligne : '+(index+1);
  		validprice=false;
  	}
  	else if(isNaN(pu) || pu<=0)
  	{
  		msg='Prix non valide en ligne : '+(index+1);
  		validprice=false;
  	}
  	else if(jQuery.inArray(prix,nums)>-1)
  	{
  		msg='Numero de prix dupliqué en ligne : '+(index+1);
  		validprice=false;

  	}
  	else
  	{
  		nums.push(prix);
  	}
  	if(validprice==false)
  	{
  		return; 
  	}
  });
  if(empty) 
  {
  	showInfoBox('error','la liste des prix est vide');
  	return;


  } 
  else if(!validprice) 
  {

  	showInfoBox('error',msg);
  	return;
  }
  else
  {
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
  var frmDta = new FormData(this);
  dtaArrayObject = prixTableToArrayObject(nouveauDevisTable);
  if(dtaArrayObject.length>0)
  {
  	frmDta.append('prixArray',JSON.stringify(dtaArrayObject));
  }

  $.ajax({
  	url : post_url,
  	type: request_method,
  	data : frmDta,
  	cache:false,
  	processData:false,
  	contentType:false,
  	success: function(result){
  		$('body').loadingModal('destroy');
  		listeDevis.ajax.reload(null,true);
  		location.href = result;
  	},
  	error: function(err){
		$('body').loadingModal('destroy');
  		showInfoBox('error',err.responseText);
  		

  	}
  })
}
})

$('#edit-devis-form').submit(function(e){
	e.preventDefault(); //prevent default action 
	
	
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
	var frmDta = new FormData(this);
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : frmDta,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$('body').loadingModal('destroy');
			listeDevis.ajax.reload(null,true);
			showInfoBox('success',result);
		},
		error: function(err){
			$('body').loadingModal('destroy');
			showInfoBox('error',err.responseText);
			
  
		}
	})
  
  })
  $('#edit-btn-add-prix-devis').on('click',function(){
	var v = validatePriceInputs('#edit-devis-prix-data-container');

	if(!v.valid)
	{
		showInfoBox('error',v.msg);
		
	}
	else
	{
		dta = new FormData();
		dta.append('numero',$('#edit-serial-devis').val())
		dta.append('numero-prix',$('#edit-numero-prix-devis').val())
		dta.append('libelle-prix',$('#edit-libelle-prix-devis').val())
		dta.append('unite-prix',$('#edit-unite-prix-devis').val())
		dta.append('pu-prix',$('#edit-prix-prix-devis').val())
		dta.append('quantite-prix',$('#edit-quantite-prix-devis').val())
		$.ajax({
			url : BaseUrl+'Devis/addPrixToDevis',
			type: "POST",
			data : dta,
			cache:false,
			processData:false,
			contentType:false,
			success: function(result){
				$('body').loadingModal('destroy');
				$('#edit-montantTTC-devis').val(0);
				$('#edit-montanttHT-devis').val(0);
				editDevisTable.ajax.reload(null,true);
				showInfoBox('success',result);
				listeDevis.ajax.reload(null,true);
			},
			error: function(err){
				$('body').loadingModal('destroy');
				showInfoBox('error',err.responseText);
				
	  
			}
		})
	}
})

$('#btn-removeAllprix-devis').on('click',function(){
	if(confirm('Voulez vous vider la table des prix?'))
	{
		nouveauDevisTable.clear().draw();
	}
})

$('#devis-aff-length').change( function() { 
	listeDevis.page.len( $(this).val() ).draw();
});

$('#devis-search').keyup(function(){

	listeDevis.search($(this).val()).draw() ;
});
$('#addDevis-aff-length').change( function() { 
	nouveauDevisTable.page.len( $(this).val() ).draw();
});

$('#addDevis-search').keyup(function(){
	//nouveauDevisTable.draw();
	nouveauDevisTable.search($(this).val()).draw() ;
});

$('#nouveau-devis-table').on( 'change', 'input', function () {
  //Get the cell of the input
  var cell = $(this).closest('td');

  //update the input value
  $(this).attr('value', $(this).val());

  //invalidate the DT cache
  nouveauDevisTable.cell($(cell)).invalidate().draw();
            
} );

$('#liste-devis-table').on('click','.devis-remove',function(){
	parent = $(this).closest('tr');
	var data = listeDevis.row(parent).data();
	numdevis = data[0];
	
	customConfirmedialog('Voulez vous supprimer définitivement ce devis',null,function(){
	
	  form_data = new FormData();
	  form_data.append('devis-num',numdevis);
	 
	   $.ajax({
		url : BaseUrl+'Devis/removeDevis',
		type: 'post',
		data : form_data,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			listeDevis.row(parent).remove().draw();
		   showInfoBox('success','Devis supprimée',3000,0);
		  
	
		},
		error: function(err){
	
		 
	
		  showInfoBox('error',err.responseText);
	
		}
	  })
	   },function(){});
	
	})

	

		/************************************************************************************************************/
var editDevisTable = $('#edit-devis-table').DataTable(
	{
		"processing": false,
		paging: true,
		"searching": true,
		"info": true,
		"ajax": {
			url: BaseUrl+'Devis/loadDevisPrix',
			type: "post",
			datatype:"json",
			data:function(d){d.numero=$('#edit-serial-devis').val();},
			
			error:function(XMLHttpRequest, textStatus, errorThrown)
			{
	
			}
		},
		"createdRow": function( row, data, dataIndex){
			
			var tva = parseFloat($('#edit-devis-tva').val());
			var totalHt = parseFloat($('#edit-montanttHT-devis').val())+parseFloat($(row).find('.tbl-total-prix').text());
			$('#edit-montanttHT-devis').val(totalHt);
			$('#edit-montantTTC-devis').val(totalHt +(totalHt *tva/100));
			
	
		},
		columnDefs: [
			{targets: [2,4],className: 'centred-column'},
		{targets: [3],className: 'justif-column'},
		{targets: [7],className: 'tbl-total-prix'},
		{targets: [0,1],"visible": false},
		
		
		],
		buttons:{
			dom: {
				button: {
					className: ''
				}
			},
			buttons: [
			{
				extend: 'excelHtml5',
				text:'<i class="fa fa-lg fa-file-excel-o"></i>',
				className:'btn btn-exportExcel table-action',
				filename:'Liste_prix ',
				title:'Liste Des prix',
				exportOptions: {
					columns: ':not(.colAction)',
					orthogonal: 'export'
				}
			}
			],
		},
		"ordering": false,
		"dom": 'Btip',
		"autoWidth": false,
		"serverSide": false,
		responsive: true,
		"iDeferLoading": 20,
		"lengthMenu": [15,50,100],
		"pageLength": 15,
		language: {
			"sProcessing": "Traitement en cours...",
			"sSearch": "Rechercher:",
			"sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
			"sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
			"sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
			"sInfoFilte#ff1a1a": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			"sInfoPostFix": "",
			"sLoadingRecords": "...",
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

	$('#liste-devis-table').on('click','.devis-edit',function(){
		parent = $(this).closest('tr');
		var data = listeDevis.row(parent).data();
		numdevis = data[0];
			
		  form_data = new FormData();
		  form_data.append('devis-num',numdevis);
		 
		   $.ajax({
			url : BaseUrl+'Devis/getDevisData',
			type: 'post',
			data : form_data,
			cache:false,
			processData:false,
			contentType:false,
			success: function(result){
				dta = JSON.parse(result);
				$('#edit-serial-devis').val(dta['attributes']['numerodevis']);
				$('#edit-numero-devis').val(dta['attributes']['numero_officiel']);
				$('#edit-objet-devis').val(dta['attributes']['objet']);
				$('#edit-client-devis').val(dta['attributes']['client']);
				$('#edit-devis-tva').val(dta['attributes']['tva']);
				$('#edit-montantTTC-devis').val(0);
				$('#edit-montanttHT-devis').val(0);
				editDevisTable.ajax.reload(null,true);
				$('a[href="#edit-devis"]').trigger("click");
				
			},
			error: function(err){
			  showInfoBox('error',err.responseText);
		
			}
		  })
		   
		
		})	

		$('#edit-devis-table').on('click','.devisprix-remove',function(){
			parent = $(this).closest('tr');
	var data = editDevisTable.row(parent).data();
	numero = data[0];
	devis = data[1];
	customConfirmedialog('Voulez vous supprimer définitivement ce prix',null,function(){
	
	  form_data = new FormData();
	  form_data.append('prix-num',numero);
	  form_data.append('devis-num',devis);
	   $.ajax({
		url : BaseUrl+'Devis/removePrix',
		type: 'post',
		data : form_data,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			showInfoBox('success','prix supprimée',3000,0);
			$('#edit-montantTTC-devis').val(0);
				$('#edit-montanttHT-devis').val(0);
			editDevisTable.ajax.reload(null,true);
			listeDevis.ajax.reload(null,true);
	
		},
		error: function(err){
	
		 
	
		  showInfoBox('error',err.responseText);
	
		}
	  })
	   },function(){});
		})

		$(document).ready(function(){
			listeDevis.buttons().container()
			.appendTo( '#btns-devis-exports' );
			editDevisTable.buttons().container()
			.appendTo( '#btns-prix-exports' );
			
		
		})