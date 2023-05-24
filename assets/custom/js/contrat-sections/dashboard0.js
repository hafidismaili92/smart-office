 /******************************Chart config*****************************************************/
 window.chartColors = {
    white:'rgb(255,255,255)',
    red: 'rgb(255, 99, 132)',
    redFoncee:'rgb(187, 67, 67)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)',
    bluegreen:'rgb(0, 82, 106)',
    greenClear:'rgb(25, 169, 153)',
    greenFoncee:'rgb(22, 105, 122)',
    greenIntermidiaire:'rgb(150, 146, 8)',
    lightWhite:'rgb(240, 238, 238)',
};
var color = Chart.helpers.color;

//**************************************contrats/sectors*******************************************************/
var contratsSectorBar;
var ctxContratSector = document.getElementById('contrats-sectors-canvas').getContext('2d');
function generateContratSector(dataCollection,lbls,periodeString)
{
    if(contratsSectorBar)
        contratsSectorBar.destroy();
    var barContratSector = {
        labels: lbls,
        datasets: [{
            label: '',
            backgroundColor: color(window.chartColors.bluegreen).alpha(0.8).rgbString(),
            borderColor: window.chartColors.bluegreen,
            borderWidth: 1,
            barPercentage:0.2,
            data: dataCollection
        }]

    };


    //Chart.defaults.global.defaultFontColor = 'red';
    contratsSectorBar = new Chart(ctxContratSector, {

        type: 'bar',
        data: barContratSector,
        options: {

            scaleShowLabels : false,
            maintainAspectRatio: false,
            barShowLabels: true,
            responsive: true,
            legend: {
                display: false,
                //position: 'top',
            },
            title: {
                display: true,
                text: 'Répartition des Contrats par secteur '+periodeString
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision:0
                    }
                }],
                
            },
            plugins:{
                datalabels: {
                    color:'rgb(255,255,255)',
                    display: true
                }
            }

        }
    });
}

//**************************************contrats/time(months or years)*******************************************************/
var ctxContratsTime = document.getElementById('contrats-time-canvas').getContext('2d');
var contratsTimeBar;
function generateContratTime(dtaCollectionnbr,dtaCollectionMont,lbls,periodeString)
{
    if(contratsTimeBar)
        contratsTimeBar.destroy();
    var barContratTime = {
        labels: lbls,
        datasets: [{

            label: 'Nombre des contrats ',
            yAxisID: 'A',
            backgroundColor: color(window.chartColors.greenClear).alpha(0.8).rgbString(),
            borderColor: window.chartColors.greenClear,
            borderWidth: 1,
            barPercentage:0.2,
            data: dtaCollectionnbr,
            datalabels: {
          // display labels for this specific dataset
          display: true,
          
      },
      order:1
  },
  {
    label: 'Montant des contrats ',
    yAxisID: 'B',
    backgroundColor: color(window.chartColors.redFoncee).alpha(0.5).rgbString(),
    borderColor: window.chartColors.redFoncee,
    borderWidth: 1,
    barPercentage:0.2,
    type: 'line',
    data: dtaCollectionMont,
    order:2
}
]

};

    //Chart.defaults.global.defaultFontColor = 'red';
    contratsTimeBar = new Chart(ctxContratsTime, {

        type: 'bar',
        data: barContratTime,
        options: {
            plugins: {
              datalabels: {
                color:'rgb(255,255,255)',
                display: false
            }},
            scaleShowLabels : false,
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                //display: false,
                position: 'top',
            },
            title: {
                display: true,
                text: 'Répartition des Contrats par Nombre/Montants '+periodeString
            },
            /*scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                
            }*/
            scales: {
              yAxes: [{
                id: 'A',
                type: 'linear',
                position: 'left',
                ticks: {
                    beginAtZero: true,
                    precision:0
                }
            }, {
                id: 'B',
                type: 'linear',
                position: 'right',
                ticks: {
                    beginAtZero: true,

                }
            }]
        }

    }
});


}

/***************************************Contrats par Etat (diagramme en secteur)*************************/
    //encours
    var ctxEtatEncours = document.getElementById('contrats-enCours-canvas').getContext('2d');
    var enCoursDoughnut;
    //Arret
    var ctxEtatArret = document.getElementById('contrats-arret-canvas').getContext('2d');
    var arretDoughnut;
    //Terminé
    var ctxEtatTermine = document.getElementById('contrats-termine-canvas').getContext('2d');
    var termineDoughnut;
    function generateDought(dtaSetLabel,value,totale,doughtColor,ctx,DoughnutChart,prcentElementID,graphlabel)
    {
        if(isNaN(value)||isNaN(totale))
        {
            value=0;totale=10;
        }
        if(DoughnutChart)
            DoughnutChart.destroy();
        var doughtDta = {
            datasets: [{
                data: [value,totale-value],
                backgroundColor: [
                color(doughtColor).alpha(1).rgbString(),
            //color(window.chartColors.greenIntermidiaire).alpha(1).rgbString(),
            color(window.chartColors.lightWhite).alpha(1).rgbString()],
            label: dtaSetLabel
        }
        ],
        labels: [graphlabel,'']
    };
    var configdought = {
        type: 'doughnut',
        data: doughtDta,
        options: {
            maintainAspectRatio : false,
            cutoutPercentage: 70,
            responsive: true,
            legend: {
                display:false,
                position: 'top',
            },
            title: {
                display: true,
                text: dtaSetLabel
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            plugins:{
                datalabels: {
                    display: false
                }
            }
        }
    };  

    DoughnutChart = new Chart(ctx,configdought);
    precent = (value*100/totale).toFixed(2);
    $('#'+prcentElementID).text(precent+'%');
}
//**************************************contrats/time(months or years)*******************************************************/
var ctxRealisationRevenue = document.getElementById('revenue-realisation-canvas').getContext('2d');
var revenueRealisationBar;
function generateRealisationRevenue(dtaRealise,dtaRegle,lbls,periodeString)
{
    if(revenueRealisationBar)
        revenueRealisationBar.destroy();
    var barRealisationRevenue = {
        labels: lbls,
        datasets: [{

            label: 'Réalisé en DH TTC',
            yAxisID: 'A',
            backgroundColor: color(window.chartColors.greenClear).alpha(0.8).rgbString(),
            borderColor: window.chartColors.greenClear,
            borderWidth: 1,
            barPercentage:0.2,
            data: dtaRealise,
            datalabels: {
          // display labels for this specific dataset
          display: false,
          
      },
      order:1
  },
  {
    label: 'Réglé en DH TTC',
    yAxisID: 'B',
    fill: false,
    //backgroundColor: color(window.chartColors.bluegreen).alpha(0.8).rgbString(),
    borderColor: window.chartColors.redFoncee,
    borderWidth: 1,
    barPercentage:0.2,
    data: dtaRegle,
    order:2
}
]

};

contratsTimeBar = new Chart(ctxRealisationRevenue, {

    type: 'line',
    data: barRealisationRevenue,
    options: {
        plugins: {
          datalabels: {

            display: false
        }},
        scaleShowLabels : false,
        maintainAspectRatio: false,
        responsive: true,
        legend: {
                //display: false,
                position: 'top',
            },
            title: {
                display: true,
                text: 'Réalisation / Réglement '+periodeString
            },
            /*scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                
            }*/
            scales: {
              yAxes: [{
                id: 'A',
                type: 'linear',
                position: 'left',
                ticks: {
                    beginAtZero: true,
                    precision:0
                }
            }, {
                id: 'B',
                type: 'linear',
                position: 'right',
                ticks: {
                    beginAtZero: true,

                }
            }]
        }

    }
});


}
/*********************************DTATABLE TO CHARTSET******************************************/

function tableToChart(table,labelsIncolumn) {



    tbleNode = table.table().node();

    if(labelsIncolumn=='col')
    {
        lastcolumnIndex = $('#'+$(tbleNode).attr('id')+' thead th').length-1;
        labels = table.columns(0).data()[0]; 
        dataset = table.columns(lastcolumnIndex).data()[0]; 
        return {'labels':labels,'dataset':dataset};
    }
    else if(labelsIncolumn=='row')
    {
        labels=[];
        dataset=[];
        lastrowIndex = table.rows(table.rows().count()-1);
        labelObj = $('#'+$(tbleNode).attr('id')+' thead th');
        labelDataset = table.rows(lastrowIndex).data()[0];
        $.each(labelObj,function(key,val){
            labels.push($(val).text());
        })
        $.each(labelDataset,function(key,val){
            dataset.push(val);
        })

        labels.shift();
        labels.pop();
        dataset.shift();
        dataset.pop();

        return {'labels':labels,'dataset':dataset};
    }
    else if(labelsIncolumn=='footer')
    {
        labels=[];
        dataset=[];
        labelObj = $('#'+$(tbleNode).attr('id')+' thead th');
        $.each(labelObj,function(key,val){
            labels.push($(val).text());
        })
        datasetObj = $('#'+$(tbleNode).attr('id')+' tfoot th');
        $.each(datasetObj,function(key,val){
            dataset.push($(val).text());
        })

        labels.shift();
        labels.pop();
        dataset.shift();
        dataset.pop();

        return {'labels':labels,'dataset':dataset};
    }

}
/************************************************************************************************/
allContratTable= '#general-contrat-table';
$('#menu-list-dashboard').on('click',function(){
    $('#sidebar li').removeClass('active');
    $(this).addClass('active'); 
    $('#main-container').find('section.principal-sections').addClass('hidden_section');
    $("#dashboard-section").removeClass('hidden_section');
    $('#periode-selector').trigger('change');
});

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
              "fnInitComplete": function (settings,json) {
                $('.peroide-label').text(dta['periodeLabel']);
                dtaParSector = tableToChart(this.api(),'col');
                generateContratSector(dtaParSector.dataset,dtaParSector.labels,dta['periodeLabel']);

                dtaParTime = tableToChart(this.api(),'footer');
                dtaParMontant = [];
                $.each(dataMontant, function (index) {
                    dtaParMontant.push(dataMontant[index]);

                });

                generateContratTime(dtaParTime.dataset,dtaParMontant,dtaParTime.labels,dta['periodeLabel']);
                generateDought('Contrats en cours '+dta['periodeLabel'],dta['parEtat'].ENCOURS,dta['parEtat'].totale,window.chartColors.orange,ctxEtatEncours,enCoursDoughnut,'encours-doughnut-pourcent','En cours');
                generateDought('Contrats en Arrêt '+dta['periodeLabel'],dta['parEtat'].ARRET,dta['parEtat'].totale,window.chartColors.redFoncee,ctxEtatArret,arretDoughnut,'arret-doughnut-pourcent','en Arrêt');
                generateDought('Contrats Terminés '+dta['periodeLabel'],dta['parEtat'].TERMINE,dta['parEtat'].totale,window.chartColors.greenClear,ctxEtatTermine,termineDoughnut,'termine-doughnut-pourcent','Terminés');

            }

        });
            /**************************************Second Part (Revenue et Réalisation)*************************************************/
            $('#revenue-realisation-table>thead>tr').children().remove();
            $('#revenue-realisation-table>tbody>tr').children().remove();
            $('<th></th>').appendTo('#revenue-realisation-table>thead>tr');
            $('<td>Réglé en DH TTC</td>').appendTo('#revenue-realisation-table>tbody>tr');
            for (var i = 0; i < dta['parRevenue']['labels'].length; i++) {
                head = '<th>' + dta['parRevenue']['labels'][i] + '</th>';
                $(head).appendTo('#revenue-realisation-table>thead>tr');
                body = '<td>' + numberWithSpaces(parseFloat(dta['parRevenue']['dataset'][i]).toFixed(2)) + '</td>';
                $(body).appendTo('#revenue-realisation-table>tbody>tr');
            }
            $('<th>Totale</th>').appendTo('#revenue-realisation-table>thead>tr'); 
            $('<td>'+numberWithSpaces(parseFloat(dta['parRevenue']['sommeReglee']).toFixed(2))+'</td>').appendTo('#revenue-realisation-table>tbody>tr');
            generateRealisationRevenue(dta['parRealisation']['dataset'],dta['parRevenue']['dataset'],dta['parRevenue']['labels'],dta['periodeLabel'])
            $('.periode-realisation').text(dta['periodeLabel']);
            $('#realise-montant').text(numberWithSpaces(parseFloat(dta['parRealisation']['sommeRealisee']).toFixed(2))+' DH TTC');
            $('#revenue-montant').text(numberWithSpaces(parseFloat(dta['parRevenue']['sommeReglee']).toFixed(2))+' DH TTC');
            $('#enattente-montant').text(numberWithSpaces(parseFloat(dta['parRevenue']['sommeEnattente']).toFixed(2))+' DH TTC');

            initRepartitionMap(dta['geom']);
        },
        error: function(err){

          $('body').append('<div class="custom-alert" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #B00F04; opacity:0.9; color: white;z-index:1000;padding:20px;">' +err.responseText+'</div>');
          $('body .custom-alert').delay(3000).hide(10, function() {
            $(this).remove();
        });

      }
  })

}

function reinitializeDatatable(tableName)
{
   if ($.fn.DataTable.isDataTable( tableName ) ) {
    $(tableName).DataTable().clear().draw();
    $(tableName).DataTable().destroy();
    $(tableName+'>thead>tr').children().remove();
    $(tableName+'>tfoot>tr').children().remove();

}  
}
$('#periode-selector').on('change',function(){
    periode = $(this).val();
    loadContratsStatistics(periode);

})
$('#print-dashboard').on('click',function(){
   window.print();

})
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
        console.log(size);
        var style = styleCache[size];
        if (!style) {
          style = new ol.style.Style({
            image: new ol.style.Circle({
              radius: 10,
              stroke: new ol.style.Stroke({
                color: '#fff'
            }),
              fill: new ol.style.Fill({
                color: '#BA4242'
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