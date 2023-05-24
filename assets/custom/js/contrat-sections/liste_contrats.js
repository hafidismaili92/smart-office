
$('#contrat-menu-listeContrat').on('click',function(e){
  e.preventDefault();
  
  if($("#listeContrats-section").hasClass("hidden_section"))
  {
  $(".principal-sections").addClass("hidden_section");
  $("#listeContrats-section").removeClass("hidden_section");
  $(this).closest(".sub-menus").find("a").removeClass("active");
  $(this).addClass("active");
  $('#listeContrats-table').dataTable().fnClearTable();
  listeContratTable.columns.adjust().draw( false );
  listeContratTable.ajax.reload( null, false );
  }
  
});

var listeContratTable = $('#listeContrats-table').DataTable(
{
	orderCellsTop: true,
	fixedHeader: true,
	"processing": false,
	"serverSide": false,
	"info": false,
	"ajax": {
		url: BaseUrl+'Contrats/loadContrats',
		type: "post",
		datatype:"json",
		/*success:function(json)
		{	
			if(json['data'].length>0)
			{
				try
				{
					$('#listeContrats-table').dataTable().fnAddData(json['data']);
				}
				
				catch(e)
				{
					
				}
			}
			else
			{
				$('#listeContrats-table').DataTable().clear().draw();
			}
			
		},*/
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{

		}
	},

	"autowidth":true,
	responsive:true,
	"dom": 'Btp',
	paging: true,
	"lengthMenu": [10,25,50,100],
	"pageLength": 25,
	"bSortClasses": false,
	
	columnDefs : [
	{ type: 'formatted-num', targets: [3,4,6] },
	{ responsivePriority: 1, targets: 0 },
	{ responsivePriority: 2, targets: 1 },
	{ responsivePriority: 3, targets: 10 },
	{ responsivePriority: 4, targets: 2 },
	{ responsivePriority: 5, targets: 3 },
	{ responsivePriority: 6, targets: 4 },
	{ responsivePriority: 7, targets: 5 },
	{ responsivePriority: 8, targets: 6 },
	{ responsivePriority: 9, targets: 8 },
	{ className:'colAction', targets: 10 },
	{targets: [0,1,8,10],className: 'colVisible'},
	{targets: [2,5,7,9],"visible": false},
	{"render": function ( data, type, row ) {
		if(type!='export')
		{
			var num = $.fn.dataTable.render.number(' ', '.', 2).display(data);              
			return num;
		}
		else
			return data; 
	},
	"targets": [3,4,6] },
	{
			render: function (data, type, row) {
				if(type=="display")
				{
				
				if (data == "En Arrêt") {
					return '<label class="badge badge-gradient-danger">'+data+'</label>';
				} 
				else if (data == "Terminé") {
					return '<label class="badge badge-gradient-success">'+data+'</label>';
				}
				
				else if (data == "En cours") {
					return '<label class="badge badge-gradient-warning">'+data+'</label>';
				}
				else
				{
					return '<label class="badge badge-gradient-info">'+data+'</label>';
				}
			}
			else return data;
			},
			targets: 8,
		},
	{ "type": "num-fmt", "targets": 3 }
	],
	buttons:{
		dom: {
			button: {
				className: ''
			}
		},
		buttons: [
		{
			extend: "colvis",
				text: '<i class="fa fa-eye" aria-hidden="true"></i>',
				className: "btn btn-setVisibility table-action",
				columns: ":not(.colVisible)",
		},
		{

			
				text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
				className: "btn btn-exportContrats table-action",
				filename: "Liste_Contrat " + moment().format("dd-mm-yyyy"),
				title: "Liste des contrats Le " + moment().format("DD-MM-YYYY"),
				exportOptions: {
					columns: ":not(.colAction)",
				},
				action: function ( e, dt, node, config ) {
				window.location.href="Contrats/ExportActifContrats";
			}

		},
		{
			extend: "excelHtml5",
				text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
				className: "btn btn-exportExcel table-action",
				filename: "Liste_contrats " + moment().format("dd-mm-yyyy"),
				title: "Liste des contrats Le " + moment().format("DD-MM-YYYY"),
				exportOptions: {
					columns: ":not(.colAction)",
				},
		},
		
		],
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

$(document).ready(function(){
	let container = $(".btns-group[data-table='listeContrats-table']");
	listeContratTable.buttons().container().appendTo( container );

})
$('#listeContrats-table').on('click','.contrat-actions',function(){
	parent = $(this).closest('tr');
	numero = $(parent).find("td").eq(0).text();
	$('#contrat-search-details').val(numero);
	
	if($(this).hasClass('action-info'))
	{
		$('#contrat-details').modal('show');
		let dta = new FormData();
		dta.append('contrat-search-details',numero);
		var post_url = BaseUrl+'Contrats/loadDetailsContrat';
		getDetailContrat(dta,post_url,'post');
		
		
	}
	else if($(this).hasClass('action-liste-facture'))
	{
		$('#num-contrat-factures').val(numero);
		$('#num-contrat-nouvelleFacture').val(numero);
		$('#contrat-menu-listeFacture').trigger('click');
		
	}
	else if($(this).hasClass('action-nouvelle-facture'))
	{
		
		$('#num-contrat-factures').val(numero);
		$('#num-contrat-nouvelleFacture').val(numero);
		$('#contrat-menu-addFacture').trigger('click');
	}
	else if($(this).hasClass('action-delete-contrat'))
	{
		showLoader = true;
	parent = $(this).closest("tr");
	row = listeContratTable.row(parent);
	numero = row.data()[0];
	customConfirmedialog('Voulez vous supprimer définitivement ce contrat et ses dépendances?',null,function(){

	form_data = new FormData();
	form_data.append("numero", numero);
	$.ajax({
		url: BaseUrl + "Contrats/deleteContrat",
		type: "post",
		data: form_data,
		cache: false,
		processData: false,
		contentType: false,
		success: function (result) {
			listeContratTable.ajax.reload(function(){
				$("#listeContrats-section").find(".btn-exportUnpayedFacture").removeClass("dt-button");
			},false);
		},
		error: function (err) {
			showInfoBox('error',err.responseText);
		},
	});
	 },function(){});
	}
	
})

$('#listeContrats-table').on( 'column-visibility.dt', function ( e, settings, column, state ) {
	listeContratTable.columns.adjust().draw( false );
} );

$('#listeContrats-table').on( 'draw.dt', function () {
	$('#nbr-contrat').text(listeContratTable.rows().count());

} );

listeContratTable.on( 'search.dt', function () {
	calculStatistics(listeContratTable);
} );
function calculStatistics(dttable)
{
	var sommeContrats=0;
	var sommeRealise=0;
	var sommeReglee=0;
	var sommeApayer=0;
	
	dttable.rows({search:'applied'}).every( function ( rowIdx, tableLoop, rowLoop ) {
		
		sommeContrats+=parseFloat(this.data()[3]);
		sommeRealise+=parseFloat(this.data()[4]);
		sommeReglee+=parseFloat(this.data()[6]);
		
	});
	sommeApayer=sommeRealise-sommeReglee;
	$('#contratnbr-list-contrat').text(numberWithSpaces(dttable.rows({search:'applied'}).count()+' Contrats'));
	$('#contratTotal-list-contrat').text(numberWithSpaces(sommeContrats.toFixed(2))+' DH TTC');
	$('#contratPaye-list-contrat').text(numberWithSpaces(sommeReglee.toFixed(2))+' DH TTC');
	$('#contratApayer-list-contrat').text(numberWithSpaces(sommeApayer.toFixed(2))+' DH TTC');

}

$('#ct-length').change( function() { 
	listeContratTable.page.len( $(this).val() ).draw();
});

$('#ct-search').keyup(function(){
	listeContratTable.search($(this).val()).draw() ;
});

$('#add-contrat-btn').on('click',function(){
	$('#menu-list-nouveauContrat').trigger('click');
})
$('#localisation-navTab').on('click',function(){
	setTimeout(function(){mapcontrat.updateSize();}, 500);
	
})
function getDetailContrat(form_data,targeturl,methode)
{
  

  $('.detail-contrat-item-content').text('...');
  sourcecontrat.clear();
  $('.detail-contrat-item').find('a').removeAttr("href");;
  tbl = $('#listeFacture-table').dataTable();
  tbl.fnClearTable();
  $.ajax({
    url : targeturl,
    type: methode,
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
      var dta = JSON.parse(result);
      $('#item-contrat-numero').text(dta['numero']);
      $('#item-contrat-libelle').text(dta['libelle']);
      $('#item-contrat-date').text(dta['date_signature']);
      $('#item-contrat-delai').text(dta['delai']+' '+dta['unite_delai']);
      $('#item-contrat-client').text(dta['libelleclient']);
      $('#item-contrat-ville').text(dta['secteur']+'-'+dta['ville']);
      $('#item-contrat-domaine').text(dta['secteurlibelle']+'('+dta['domainelibelle']+')');
      $('#item-contrat-observation').text(dta['observation']);
      $('#item-contrat-montantTTC').text(numberWithSpaces(dta['montant_ttc']));
      $('#item-contrat-cumuleTTC').text(numberWithSpaces(dta['realise']));
      $('#item-contrat-avancement').text(dta['avancement']);
      $('#item-contrat-paye').text(numberWithSpaces(dta['paye_ttc']));
      $('#item-contrat-nonPaye').text(numberWithSpaces(dta['nonPaye'])); 
      $('#item-contrat-etat').text(dta['etatcontrat']);
      $('#bpLink').attr('href','Contrats/exportBP?contrat='+dta['numero']);
      $('#AvancementLink').attr('href','Contrats/exportAvancement?contrat='+dta['numero']);
      $('.detail-contrat-montant').text(dta['montant_ttc']+' DH TTC');
      $('.detail-contrat-client').text(dta['libelleclient']);
      $('.detail-contrat-realisation').text(dta['realise']+' DH TTC');
      /*if(dta['etat']=='en cours')
      {
        $('#contrat-etat-switch').prop('checked', true);
        $('#label-contrat-etat-switch').text('Oui');
      }
      else 
      {
        $('#contrat-etat-switch').prop('checked', false);
        $('#label-contrat-etat-switch').text('Non');
      }*/
        if(dta['geom']!='')
        {
          var format = new ol.format.WKT();
          var feature = format.readFeature(dta['geom'], {
            dataProjection: 'EPSG:4326',
            featureProjection: 'EPSG:3857'
          });
          sourcecontrat.addFeature(feature);
          var point = feature.getGeometry();
          mapView.fit(point, {padding: [170, 50, 30, 150], minResolution: 50});
        }


},
error: function(err){


showInfoBox('error',err.responseText);

}
})
}

$('#confirmer-terminer').on('click',function(){
  $('#modalconfirm-contrat-termine').modal('show');
})

$('#contrat-etat-switch').on('change',function(){
  var contrat = $('#item-contrat-numero').text();
  
  if($(this).prop( "checked" ))
    $('#label-contrat-etat-switch').text('Oui');
  else
    $('#label-contrat-etat-switch').text('Non');
  form_data = new FormData();
  form_data.append('contrat-num',contrat);
  form_data.append('contrat-state',$(this).prop( "checked" ));
  $.ajax({
    url : BaseUrl+'Contrats/updateEtat',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){


    },
    error: function(err){



     showInfoBox('error',err.responseText);

    }
  })
})

$('#edit-contrat-etat').on('click',function(){
  numContrat = $('#item-contrat-numero').text();
  if(numContrat!='')
  {

   etat = $('#item-contrat-etat').text();
   $('#num-contrat-etat').text(numContrat);
   switch(etat)
   {
    case 'En cours':
    $('#contrat-etat-selector').val('ENCOURS');
    break;
    case 'Terminé':
    $('#contrat-etat-selector').val('TERMINE');
    break;
    case 'Résilie':
    $('#contrat-etat-selector').val('RESILIE');
    break;
    case 'ARRET':
    $('#contrat-etat-selector').val('En Arrêt');
    break;
  }

  $('#modal-change-contrat-etat').modal('show');
}

})

$('#btn-update-contrat-etat').on('click',function(){
  form_data = new FormData();
  form_data.append('etat',$('#contrat-etat-selector').val());
  form_data.append('numero',$('#num-contrat-etat').text());
  $.ajax({

    url : BaseUrl+'Contrats/updateState',
    type: 'post',
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success:function(result)
    {
      frm = new FormData();
      frm.append('contrat-search-details',$('#num-contrat-etat').text());
      getDetailContrat(frm,BaseUrl+'Contrats/loadDetailsContrat','post');
      $('#modal-change-contrat-etat').modal('hide');
      listeContratTable.ajax.reload(null,true);
    },
   error: function(err){



  showInfoBox('error',err.responseText);

}


  })
  
})

