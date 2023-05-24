document.getElementById('date-absence').valueAsDate = new Date();

var barOptions_stacked = {
  tooltips: {
    enabled: false
  },
  plugins: {
        datalabels: false   // disable plugin 'p1' for this instance
      },
      hover: {
        animationDuration: 0
      },
      scales: {
        xAxes: [
        {
          ticks: {
            autoSkip: false,
            beginAtZero: true,
            fontFamily: "'Open Sans Bold', sans-serif",
            fontSize: 9,
            min: 0,
            stepSize: 1,
            max: 24,
          },
          scaleLabel: {
            display: true,
            labelString: $('#date-absence').val()
          },
          gridLines: {},
          stacked: true,

        },

        ],
        yAxes: [
        {

          gridLines: {
            display: false,
            color: "#fff",
            zeroLineColor: "#fff",
            zeroLineWidth: 0
          },
          ticks: {
            fontFamily: "'Open Sans Bold', sans-serif",
            fontSize: 11
          },
          scaleLabel: {
            display: false
          },
          gridLines: {},
          stacked: true
        }
        ]
      },
      legend: {
        display: true,
        labels: {
          filter: function(legendItem, chartData) {

            return false;
          }
        }
      },
      responsive:true,
      title: {
        display: true,
        text: 'Suivi Journalier ('+configuration.heure_debut_travail.format('HH')+'h-'+configuration.heure_fin_travail.format('HH')+'h)'
      },
      animation: {
   /* onComplete: function() {
      var chartInstance = this.chart;
      var ctx = chartInstance.ctx;
      ctx.textAlign = "left";
      ctx.font = "9px Open Sans";
      ctx.fillStyle = "#fff";

      Chart.helpers.each(
        this.data.datasets.forEach(function(dataset, i) {
          var meta = chartInstance.controller.getDatasetMeta(i);
          Chart.helpers.each(
            meta.data.forEach(function(bar, index) {
              data = dataset.data[index];
              if (i == 0) {
                ctx.fillText(data, 50, bar._model.y + 4);
              } else {
                ctx.fillText(data, bar._model.x - 25, bar._model.y + 4);
              }
            }),
            this
          );
        }),
        this
      );

      // draw total count
      this.data.datasets[0].data.forEach(function(data, index) {
        var total = data + this.data.datasets[1].data[index];
        var meta = chartInstance.controller.getDatasetMeta(1);
        var posX = meta.data[index]._model.x;
        var posY = meta.data[index]._model.y;

        ctx.fillStyle = "black";
        ctx.fillText(total, posX + 4, posY + 4);
      }, this);
    }*/
  },
  pointLabelFontFamily: "Quadon Extra Bold",
  scaleFontFamily: "Quadon Extra Bold"
};

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: "horizontalBar",
  data: {
    labels: ["Evolution"],
    datasets: []
  },
  options: barOptions_stacked
});

function addData(chart, label, data) {
   // chart.data.labels.push(label);
   chart.data.datasets.push(
    data
    )
   chart.update();
 }

 function removeData(chart) {

  chart.data.datasets.forEach((dataset) => {
    dataset.data.pop();
  });
  chart.update();
}

var absenceJournalierTable = $('#absence-journalier').DataTable(
{
  "processing": false,
  paging: false,
  "searching": false,
  "info": false,
  "ajax": {
    url: BaseUrl+'GestionAbsence/absenceJournalier',
    data:function(d){d.dateAbsence=$('#date-absence').val();d.matricule=$('#matricule-form-absence').val();},
    type: "post",
    datatype:"json",
    
    error:function(XMLHttpRequest, textStatus, errorThrown)
    {


    }
  },
  "serverSide": false,
  responsive: true,
  "iDeferLoading": 20,
  "lengthMenu": [8,25,50,100],
  "pageLength": 25,
  columnDefs : [
  
  {"targets": [4,5,7],"visible": false,"searchable": false},
 
  {
      render: function (data, type, row) {
        if (type == "display")
          return '<i class="fa fa-trash fa-lg delete-absence table-actions" style="color:#ff5722;"></i>';
        else return data;
      },
      targets: 6,
    }
  ],

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

$("#gestion-absence-form").submit(function(event){
  event.preventDefault(); //prevent default action 
  var post_url = $(this).attr("action"); //get form action url
  var request_method = $(this).attr("method"); //get form GET/POST method
  var form_data = new FormData(this); //Encode form elements for submission
  $.ajax({
    url : post_url,
    type: request_method,
    data : form_data,
    cache:false,
    processData:false,
    contentType:false,
    success: function(result){
      absenceJournalierTable.ajax.reload();
      absenceTotalTable.ajax.reload();
      
    },
    error: function(err){
       showInfoBox('error','fichier "'+err.responseText+'" invalide');
      

    }
  })
});



var absenceTotalTable = $('#absence-total').DataTable(
{
  "processing": false,
  paging: true,
  "dom": 'tp',
  "searching": true,
  "info": false,
  "ajax": {
    url: BaseUrl+'GestionAbsence/absencePeroid',
    data:function(d){d.period=$('#absence-period').val();d.matricule=$('#matricule-form-absence').val()},
    type: "post",
    datatype:"json",
    
    error:function(XMLHttpRequest, textStatus, errorThrown)
    {

    },
    /*success:function(json)
    {
      console.log(json);
    }*/
  },
  "serverSide": false,
  responsive: true,
  "iDeferLoading": 20,
  "lengthMenu": [8,15],
  "pageLength": 8,
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

$('#absence-period').on('change',function(){
  absenceTotalTable.ajax.reload();
})
$('#date-absence').change(function() {
  absenceJournalierTable.ajax.reload();
});
$('#absence-journalier').on( 'draw.dt', function () {
  var compteur=0;
  endInterval = 0+configuration.heure_debut_travail.format('H');
  var datasets = [];
  var firstData = {
    data: [endInterval],
    backgroundColor: "#eeeeee",
    barPercentage: 0.5,
    hoverBackgroundColor: "#eeeeee"
  }
  
  removeData(myChart);
  //myChart.data.datasets.push(firstData);
  addData(myChart,'fff',firstData);
  
  absenceJournalierTable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
    dta = this.data();

    var sortie = dta[4];
    var entree = dta[5];
    var secondData = {
      data: [sortie-endInterval],
      backgroundColor: "rgba(0,223,115,0.6)",
      barPercentage: 0.5,
      hoverBackgroundColor: "rgba(0,223,115,0.6)"
    }
    addData(myChart,null,secondData);
    //myChart.data.datasets.push(secondData);
    var thirdData = {
      data: [entree-sortie],
      backgroundColor: "RGBA(221,74,84,0.6)",
      barPercentage: 0.5,
      hoverBackgroundColor: "RGBA(221,74,84,0.6)"
    }
    //myChart.data.datasets.push(thirdData);
    addData(myChart,'fff',thirdData);
    endInterval = entree;
    
    compteur++;
  } );
  var fourthData = {
    data: [configuration.heure_fin_travail.format('H')-endInterval],
    backgroundColor: "rgba(0,223,115,0.6)",
    barPercentage: 0.5,
    hoverBackgroundColor: "rgba(0,223,115,0.6)"
  }
  addData(myChart,'fff',fourthData);
  var lastData = {
    data: [24-configuration.heure_fin_travail.format('H')],
    backgroundColor: "#eeeeee",
    barPercentage: 0.5,
    hoverBackgroundColor: "#eeeeee"
  }
  addData(myChart,'fff',lastData);
  myChart.options.scales.xAxes[0].scaleLabel.labelString = $('#date-absence').val();
} );
var AbsenceTDiagramme = document.getElementById("absenceTotal-ratio");
var options = {
  responsive:true,
  tooltips: {
   enabled: false
 },
 plugins: {
   datalabels: {
     formatter: (value, ctx) => {
       let datasets = ctx.chart.data.datasets;
       if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
         let sum = datasets[0].data.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
         let percentage = value+'h \n ('+Math.round((parseFloat(value) / sum) * 100) + '% )';
         return percentage;
       } else {
         return percentage;
       }
     },
     color: '#fff',
   }
 }
};
var config = {
  type: 'pie',
  data: {
    datasets: [],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
    'Absent',
    'Present',

    ]
  },
  options: options
}
var tChart = new Chart(AbsenceTDiagramme,config);

$('#absence-total').on( 'draw.dt', function () {
  var absenceHeure=0;
  var totalHeure=0;
  absenceTotalTable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
    dta = this.data();

    absenceHeure = absenceHeure+parseFloat(dta[2]);
    
  } );
  
switch($('#absence-period').val())
{
  case 'j':
  var now = moment();
 var nowHour = moment().format('HH'); //todays date
var end = moment(moment().format("YYYY-MM-DD")+" "+"09:00:00.000"); // another date

if(parseInt(nowHour)>configuration.heure_fin_travail.format('H') || parseInt(nowHour)<configuration.heure_debut_travail.format('H'))
{
  now = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_fin_travail.format('HH')+":00:00.000");
}
totalHeure=moment.duration(now.diff(end)).asHours();
break;
case 's':

var now = moment().format('d');
if(now=='0' || now=='6')
{
  now = '5';
}
var jNmoinsUn=(parseInt(now)-1)*configuration.h_travail_semaine/configuration.nbrJ_travail_semaine

var nowJ = moment();
 var nowJHour = moment().format('HH'); //todays date
var endJ = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_debut_travail.format('HH')+":00:00.000"); // another date

if(parseInt(nowJHour)>configuration.heure_fin_travail.format('H') || parseInt(nowJHour)<configuration.heure_debut_travail.format('H'))
{
  nowJ = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_fin_travail.format('HH')+":00:00.000");
}
NbrheureJ=moment.duration(nowJ.diff(endJ)).asHours();
totalHeure=NbrheureJ+jNmoinsUn;

break;
case 'm':
var firstDMonth =moment().startOf('month').format('YYYY-MM-DD hh:mm');
NbrJMonth=moment.duration(moment().diff(firstDMonth)).asDays();
if(parseFloat(NbrJMonth)<1){NbrJMonth=1;}
NbrHMonth=(NbrJMonth-1)*configuration.h_travail_mois/configuration.nbrJ_travail_mois;
var nowJ = moment();
 var nowJHour = moment().format('HH'); //todays date
var endJ = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_debut_travail.format('HH')+":00:00.000"); // another date

if(parseInt(nowJHour)>configuration.heure_fin_travail.format('H') || parseInt(nowJHour)<configuration.heure_debut_travail.format('H'))
{
  nowJ = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_fin_travail.format('HH')+":00:00.000");
}
NbrheureJ=moment.duration(nowJ.diff(endJ)).asHours();
totalHeure=NbrheureJ+NbrHMonth;

break;
case 'a':
var firstYear =moment().startOf('year');
NbrJYear=moment.duration(moment().diff(firstYear)).asDays();
if(parseFloat(NbrJYear)<1){NbrJYear=1;}
NbrHYear=(NbrJYear-1)*configuration.h_travail_annee/configuration.nbrJ_travail_annee;
var nowJ = moment();
 var nowJHour = moment().format('HH'); //todays date
var endJ = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_debut_travail.format('HH')+":00:00.000"); // another date

if(parseInt(nowJHour)>configuration.heure_fin_travail.format('H') || parseInt(nowJHour)<configuration.heure_debut_travail.format('H'))
{
  nowJ = moment(moment().format("YYYY-MM-DD")+" "+configuration.heure_fin_travail.format('HH')+":00:00.000");
}
NbrheureJ=moment.duration(nowJ.diff(endJ)).asHours();
totalHeure=NbrheureJ+NbrHYear;

break;

}
presenceHeure =(totalHeure-absenceHeure).toFixed(2);
var Data = {
  data: [absenceHeure, presenceHeure],
  backgroundColor: [
  "RGBA(221,74,84,0.75)","rgba(0,223,115,0.75)"

  ]
}
config.data.datasets.splice(0, 1);
config.data.datasets.push(Data);
tChart.update();
console.log(absenceHeure+' '+presenceHeure);
} );

$("#absence-tab").on("click", ".delete-absence", function () {
  parent = $(this).closest("tr");
  customConfirmedialog('Voulez vous supprimer cette absence?',null,function(){
  
  row = absenceJournalierTable.row(parent);
  code = row.data()[7];
  form_data = new FormData();
  form_data.append("code", code);
  form_data.append("matricule", $('#matricule-form-absence').val());
  $.ajax({
    url: BaseUrl + "GestionAbsence/removeAbsence",
    type: "post",
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (result) {

      absenceJournalierTable.ajax.reload();
      absenceTotalTable.ajax.reload();
    },
    error: function (err) {
       showInfoBox('error','fichier "'+err.responseText+'" invalide');
    },
  });
  },function(){});
});