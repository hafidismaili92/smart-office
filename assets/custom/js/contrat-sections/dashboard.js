	// Global Options:
	 Chart.defaults.global.defaultFontColor = '#888888';
	 Chart.defaults.global.defaultFontSize = 12;

	 /************************************************Map*****************************************************/

var osmLayer = new ol.layer.Tile({source: new ol.source.OSM()}); 
var sourceRepartition= new ol.source.Vector();
var clusterSource = new ol.source.Cluster({
  distance: parseInt(50, 10),
  source: sourceRepartition
});
 /*var RepartitionVectorLayer = new ol.layer.Vector({
    source: sourceRepartition,
   style: new ol.style.Style({
      image: new ol.style.Icon({
        anchor: [12, 35],
        anchorXUnits: 'pixels',
        anchorYUnits: 'pixels',
        src: 'data:image/icon.png;base64,'+iconBase4
      })
    })
});*/
var styleCache = {};
var RepartitionVectorLayer = new ol.layer.Vector({
    source: clusterSource,
    style: function(feature) {
        var size = feature.get('features').length;
     
        var style = styleCache[size];
        if (!style) {
          style = new ol.style.Style({
            image: new ol.style.Circle({
              radius: 10,
              stroke: new ol.style.Stroke({
                color: '#fff'
            }),
              fill: new ol.style.Fill({
                color: '#a05aff'
            })
          }),
            text: new ol.style.Text({
              text: size.toString(),
              fill: new ol.style.Fill({
                color: '#fff'
            })
          })
        });
          styleCache[size] = style;
      }
      return style;
  }
});
var mapViewRepartition = new ol.View({
  center: [-722179.28, 4067538.48],
  zoom: 2
});
var mapRepartition = new ol.Map({
    controls: ol.control.defaults({
      attributionOptions:({
        collapsible: false
    })
  }),
    layers: [osmLayer,RepartitionVectorLayer],
    target: 'contrats-repartition-map',
    view: mapViewRepartition
});
function initRepartitionMap(geomArray){
    sourceRepartition.clear();
    var format = new ol.format.WKT();
    for (var i = 0; i < geomArray.length; i++) {

     var feature = format.readFeature(geomArray[i].geom, {
        dataProjection: 'EPSG:4326',
        featureProjection: 'EPSG:3857'
    });
     sourceRepartition.addFeature(feature);

 }

 window.setTimeout(function () { 
    mapRepartition.updateSize();

}, 200);

}
$('#print-dashboard').on('click',function(){
   window.print();

})
	/************************************************************************************************/
	allContratTable= '#general-contrat-table';

	$(document).ready(function(){loadContratsStatistics("current-year");})

	$('#periode-selector').on('change',function(){
    periode = $(this).val();
    loadContratsStatistics(periode);

})

	function reinitializeDatatable(tableName)
	{
		
	   if ($.fn.DataTable.isDataTable( tableName ) ) {
	    $(tableName).DataTable().clear().draw();
	    $(tableName).DataTable().destroy();
	    $(tableName+'>thead>tr').children().remove();
	    $(tableName+'>tfoot>tr').children().remove();

	}  
	}

	function loadContratsStatistics(periode)
	{
	    reinitializeDatatable(allContratTable);
	    $('.box-values').text('.....');
	    $('.periode-realisation').text('...');
	    form_data = new FormData();
	    form_data.append('periode',periode)
	    $.ajax({
	        url : BaseUrl+'Dashboard/getDashboardContrats',
	        type: 'post',
	        data : form_data,
	        cache:false,
	        processData:false,
	        contentType:false,
	        success: function(result){
	            /*****************************FIRST PART*****************************************/
	            dta = JSON.parse(result);
	            dataSectores = dta['parSecteur'];
	            dataEtat = dta['parEtat'];
	            dataMontant = dta['parMontant'];
	            $.each(dataSectores.columns, function (k, colObj) {
	                str = '<th>' + colObj.name + '</th>';
	                $(str).appendTo(allContratTable+'>thead>tr');
	            });

	            $.each(dataSectores.totaleRow, function (index) {

	                strFoot = '<th>' + dataSectores.totaleRow[index] + '</th>';
	                $(strFoot).appendTo(allContratTable+'>tfoot>tr');
	            });
	            $(allContratTable).DataTable({
	                "data": dataSectores.data,
	                "responsive":true,
	                "dom":"tp",
	                "columns": dataSectores.columns,
	                columnDefs: [
	                { className: 'dt-center',"targets": "_all"},
	                ],
	                fixedHeader: {
	                    header: true,
	                    footer: true
	                },
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
	            const domainesData = dta["parSecteur"]["data"];
	            
	            
	            const montantData = dta["parMontant"];
	            contratDomaineChart([...domainesData]);
	            domaineDataCopy = [...domainesData];
	            const totalContrats = domaineDataCopy.reduce(function(previous,current){
	            	var rslt = previous;
	            	Object.keys(rslt).map(function(key, index) {
	  					rslt[key] = (key!= "totale" && key!="libelle")? parseInt(rslt[key]) + parseInt(current[key]):"0";
					});
					return rslt;
	            })
	            const objToArray = Object.values(totalContrats);
	            contratMontantChart({...montantData},objToArray.filter((item,index)=>(index!=0 && index !=objToArray.length-1)));
	            contratEtatChart(dta["parEtat"]);
	            
	            /**************************************Second Part (Revenue et Réalisation)*************************************************/
            $('#revenue-realisation-table>thead>tr').children().remove();
            $('#revenue-realisation-table>tbody').find('tr').children().remove();
            $('<th></th>').appendTo('#revenue-realisation-table>thead>tr');
            let realiseeRow = $('<tr></tr>');
            $('<td>Réalisé en DH TTC</td>').appendTo(realiseeRow);
            for (var i = 0; i < dta['parRealisation']['labels'].length; i++) {
                head = '<th>' + dta['parRealisation']['labels'][i] + '</th>';
                $(head).appendTo('#revenue-realisation-table>thead>tr');
                cell= '<td>' + numberWithSpaces(parseFloat(dta['parRealisation']['dataset'][i]).toFixed(2)) + '</td>';
                $(cell).appendTo(realiseeRow);
            }
            $('<th>Totale</th>').appendTo('#revenue-realisation-table>thead>tr'); 
            $('<td>'+numberWithSpaces(parseFloat(dta['parRealisation']['sommeRealisee']).toFixed(2))+'</td>').appendTo(realiseeRow);
            $(realiseeRow).appendTo('#revenue-realisation-table>tbody');

            let regleRow = $('<tr></tr>');
            $('<td>Réglé en DH TTC</td>').appendTo(regleRow);
            for (var i = 0; i < dta['parRevenue']['labels'].length; i++) {
               
                cell= '<td>' + numberWithSpaces(parseFloat(dta['parRevenue']['dataset'][i]).toFixed(2)) + '</td>';
                $(cell).appendTo(regleRow);
            }
            
            $('<td>'+numberWithSpaces(parseFloat(dta['parRevenue']['sommeReglee']).toFixed(2))+'</td>').appendTo(regleRow);
            $(regleRow).appendTo('#revenue-realisation-table>tbody');
             //generate chart
             contratRealisation(dta['parRealisation']['dataset'],dta['parRevenue']['dataset'],dta['parRevenue']['labels'],dta['periodeLabel']);
             /***********************************************RECAP CARD PART*********************************************************/
             $('.periode-realisation').text(dta['periodeLabel']);
             let montantGlobal = 0;
             let copyMontant = {...dta["parMontant"]};
             Object.keys(copyMontant).map(function(key,index){montantGlobal+=parseFloat(copyMontant[key])});
             let objArrayCopy = [...objToArray.filter((item,index)=>(index!=0 && index !=objToArray.length-1))];
             
             let nombreContrat = objArrayCopy.reduce((a,b)=>parseInt(a)+parseInt(b),0);
             
             $('#global-montant').text(numberWithSpaces(parseFloat(montantGlobal).toFixed(2))+' DH TTC');
             $('.nombre-contrat').text( nombreContrat+' Contrats');
            $('#realise-montant').text(numberWithSpaces(parseFloat(dta['parRealisation']['sommeRealisee']).toFixed(2))+' DH TTC');
            $('#revenue-montant').text(numberWithSpaces(parseFloat(dta['parRevenue']['sommeReglee']).toFixed(2))+' DH TTC');
            $('#enattente-montant').text(numberWithSpaces(parseFloat(dta['parRevenue']['sommeEnattente']).toFixed(2))+' DH TTC');
            /*****************************************************MAP PART**********************************************************/
            initRepartitionMap(dta['geom']);
	        },
	        error:function(err){}
	    })
	}
	function contratDomaineChart(domainesData)
	{
		// Bar Chart
		$("#contrat-domaines-charts").empty();
		
	    let dta = domainesData.map(item=>{return {domaine:item.libelle,number:item.totale}});
	   
		Morris.Bar({
			element: 'contrat-domaines-charts',
			data: dta,
			xkey: 'domaine',
			ykeys: ['number'],
			labels: ['Nombre contrats'],
			lineColors: ['#9a55ff'],
			lineWidth: '3px',
			barColors: ['#9a55ff'],
			resize: true,
			redraw: true
		});
	}
	//**************************************contrats/time(months or years)*******************************************************/
	
	
	/*grouped bar chart*/
		
	function contratMontantChart(montantData,totalData = [])
	{


	let labels = [];
	let montantValues = [];
	Object.keys(montantData).map(function(key, index) {
	  labels.push(key.replace('__',''));
	  montantValues.push(montantData[key]);
	});
	    //Chart.defaults.global.defaultFontColor = 'red';
	    $('#chart-montant-container').find('canvas').remove();
	    $('#chart-montant-container').append('<canvas id="contrats-montant-canvas"><canvas>');
	    var ctxContratsTime = document.getElementById('contrats-montant-canvas').getContext('2d');

	    var contratsTimeBar = new Chart(ctxContratsTime,{
	    type: 'bar',
	    data: {
	      labels: labels,
	      datasets: [{
	          label: "Montant",
	          type: "line",
	          yAxisID: 'A',
	          borderColor: "#8e5ea2",
	          data: montantValues,
	          fill: false,
	          borderWidth: 1,
	      pointStyle: 'rectRot',
	      pointRadius: 5,
	      pointBorderColor: '#9a55ff',
	      borderColor: "#9a55ff",
	      backgroundColor: "white",
	      pointStyle: 'rectRot',

	        },
	        {
	          label: "Nombre",
	          type: "bar",
	          yAxisID: 'B',
	          backgroundColor: "rgba(0,0,0,0.2)",
	          data: totalData,
	          pointStyle:'rect'
	        }
	         
	      ]
	    },
	    options: {
	      title: {
	        display: true,
	        text: ''
	      },
	      scales: {

	                yAxes: [{
	                	id:'A',
	                	gridLines: {
	                display:true
	            },
	                	scaleLabel: {
	        display: true,
	        labelString: 'Montant DH TTC'
	      },
	                    ticks: {
	                        beginAtZero: true,
	                        precision:0,
	                        callback: function(label, index, labels) {
	        return numerFormatAddspace(label);
	    }
	                    }
	                },
	                {
	                id: 'B',
	                gridLines: {
	                display:false
	            },
	                position: 'right',
	                ticks: {
	                    beginAtZero: true,

	                },
	                scaleLabel: {
	        display: true,
	        labelString: 'Nombre Contrat'
	      },
	            }],
	                
	            },
	      legend: { display: true,labels: {
	           usePointStyle: true,
	       } }
	    }
	});

	}
	
	function contratRealisation(dtaRealise,dtaRegle,lbls,periodeString)
	{
		 $('#chart-realisation-container').find('canvas').remove();
	    $('#chart-realisation-container').append('<canvas id="contrat-realisations-charts"><canvas>');
	    var ctxContratsRealisation = document.getElementById('contrat-realisations-charts').getContext('2d');
var contratsRealisationBar = new Chart(ctxContratsRealisation, {
    type: 'bar',
    data: {
      labels: lbls,
      datasets: [
        {
          label: "Réalisé en DH TTC",
          backgroundColor: "#fe7096",
          data: dtaRealise
        }, {
          label: "Réglé en DH TTC",
          backgroundColor: "#9a55ff",
          data: dtaRegle
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: ''
      }
    }
});
	}
	function contratEtatChart(dta)
	{
		
		let valueEncours = dta["ENCOURS"]?parseInt(dta["ENCOURS"]):0;
		let valueTermine = dta["TERMINE"]?parseInt(dta["TERMINE"]):0;
		let valueArret = parseInt( dta["totale"])-valueEncours-valueTermine;
		$("#contrats-etat-chart").empty();
		Morris.Donut({
  element: 'contrats-etat-chart',
  data: [
    {label: "en cours", value:valueEncours},
    {label: "Terminé", value:valueTermine},
    {label: "en Arrêt", value:valueArret},
    
  ],
  colors:["#da8cff","#9a55ff","#be74ff"],
  resize: true,
redraw: true
}).select(0);
	}


	function numerFormatAddspace(num)
	{
	  return num.toLocaleString() + num.toString().slice(num.toString().indexOf('.'));
	}
	function numberWithSpaces(x) {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  return parts.join(".");
}