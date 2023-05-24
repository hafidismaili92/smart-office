// Global Options:
	 Chart.defaults.global.defaultFontColor = '#888888';
	 Chart.defaults.global.defaultFontSize = 12;

var globalAffairesTable;
var categorie;
$(document).ready(function(){
	
	$.ajax({
	        url : BaseUrl+'GlobalAffaires/loadGlobalAffDB',
	        type: 'post',
	        cache:false,
	        processData:false,
	        contentType:false,
	        accept:'application/json',
	        success: function(result){

	        	//par Mois
	        	dta = JSON.parse(result);
	        	updateView(dta);
	        
	        },
	        error:function(err)
	        {

	        }
})
	
	globalAffairesTable = $('#globalAffaires-table').DataTable(
{
	"processing": false,
	"stateSave": false,
	"ajax": {
		url: BaseUrl+'GlobalAffaires/loadGlobalAffaires',
		type: "post",
		datatype:"json",
		data:function(d){d.categorie=categorie;},
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{
			//$('#globalAffaires-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','']).draw();
			
		}
	},
	"serverSide": false,
	//"scrollX": true,
	"iDeferLoading": 20,
	"dom": 'Btip',
	"lengthMenu": [10,15,25,50,100],
	"pageLength": 10,
	"bSortClasses": false,
	"order": [[ 4, "desc" ]],
	columnDefs : [
	{
			render: function (data, type, row) {
				if(type=="display")
				{
				color = "#e6a40f";
				if (data == "En souffrance") {
					return '<label class="badge badge-gradient-danger">En Souffrance</label>';
				} 
				else if (data == "Terminee") {
					return '<label class="badge badge-gradient-success">Terminée</label>';
				}
				
				else
				{
					return '<label class="badge badge-gradient-warning">En Cours</label>';
				}
			}
			else return data;
			},
			targets: 2,
		}
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
			className:'btn btn-success',
			filename:'Liste-globales-Affaires ',
			title:'Liste Des Affaires globales',
			exportOptions: {
				columns: ':not(.colAction)'
			}
		}
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
			"sPrevious": "Pr&eacute;c&eacute;dent",
			"sNext": "Suivant",
			"sLast": "&nbsp;&nbsp;Dernier"
		},
		"oAria": {
			"sSortAscending": ": activer pour trier la colonne par ordre croissant",
			"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
		}

	},
});
})
function updateView(dta)
{

	        	let labels = [];
				let values = [];
	        	dta.parMois.forEach(item=>{
	        		labels.push(item.dte);
	        		values.push(item.nbr);
	        	})
	        	
	        	
	        	affairesByMonthGraphic(labels,values);
	        	let pielabels = [];
	        	let piedata = [];
	        	let colors = [];
	        	let total = parseInt(0);
	        	let acheve = 0;
	        	let encours=0;
	        	let ensouffrance =0;
	        	dta.parEtat.forEach(item=>{
	        		
	        		pielabels.push(item.etat);
	        		piedata.push(item.nbr);
	        		total+=parseInt(item.nbr);
	        		switch(item.etat)
	        		{
	        			case 'Achevé':
	        			colors.push("#07cdae");
	        			acheve =parseInt(item.nbr);
	        			break;
	        			case 'En Cours':
	        			colors.push("#ffbc34");
	        			encours =parseInt(item.nbr);
	        			break;
	        			case 'En Souffrance':
	        			colors.push("#ff728c");
	        			ensouffrance =parseInt(item.nbr);
	        			break;
	        			default:
	        			colors.push("#ffffff");
	        			break;
	        		}
	        	});
	        	let acheveprct =Math.round(acheve*100/total);
	        	let encoursprct = Math.round(encours*100/total) ;
	        	let ensouffranceprct = Math.round(ensouffrance*100/total);
	        	$('.projets-total-nbr').text(total);
	        	$('.projets-acheve-nbr').text(acheve);
	        	$('.projets-encours-nbr').text(encours);
				$('.projets-souffrance-nbr').text(ensouffrance);
				$('.projets-acheve-percent:not(.progress-bar)').text(acheveprct+"%");
	        	$('.projets-encours-percent:not(.progress-bar)').text(encoursprct+"%");
				$('.projets-souffrance-percent:not(.progress-bar)').text(ensouffranceprct+"%");
				$('.progress-bar.projets-acheve-percent').css('width',acheveprct+ "%");
	        	$('.progress-bar.projets-encours-percent').css('width',encoursprct + "%");
				$('.progress-bar.projets-souffrance-percent').css('width',ensouffranceprct + "%");
				$('.progress-bar.projets-acheve-percent').attr('aria-valuenow',acheveprct);
	        	$('.progress-bar.projets-encours-percent').attr('aria-valuenow',encoursprct);
				$('.progress-bar.projets-souffrance-percent').attr('aria-valuenow',ensouffranceprct);
				
				pourcentRoundPie(document.getElementById('progress-total'),100,'#047edf');
				pourcentRoundPie(document.getElementById('progress-acheve'),acheveprct,'#07cdae');
				pourcentRoundPie(document.getElementById('progress-encours'),encoursprct,'#ffbc34');
				pourcentRoundPie(document.getElementById('progress-ensouffrance'),ensouffranceprct,'#fe7096');
				
				evolutionPieChart(pielabels, piedata,colors);
				
				//update texts and progress bars;

}
function affairesByMonthGraphic(labels,values)
	{


	    //Chart.defaults.global.defaultFontColor = 'red';
	    
	    
	    var ctx = document.getElementById('affaires-months-charts').getContext('2d');

	    var barCharte = new Chart(ctx,{
	    type: 'line',
	    data: {
	      labels: labels,

	      
	      datasets: [{
	      	
	      	
	          label: "Nombre de projets",
	          type: "line",
	          yAxisID: 'A',
	          borderColor: "#8e5ea2",
	          data: values,
	          fill: true,
	          borderWidth: 1,
	      pointStyle: 'rectRot',
	      pointRadius: 3,
	      pointBorderColor: '#ffbc34',
	      borderColor: "#ffbc34",
	      backgroundColor: 'rgba(255, 188, 52, 0.1)',
      borderColor: '#ffbc34',
      pointBackgroundColor: 'white',
  
	     

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
	        labelString: 'Nombre de projets par mois'
	      },
	                    ticks: {
	                        beginAtZero: true,
	                        precision:0,
	                        /*callback: function(label, index, labels) {
	        return numerFormatAddspace(label);
	    }*/
	                    }
	                }],
	                
	            },
	      legend: { display: true,labels: {
	           usePointStyle: true,
	       } }
	    }
	});

	}
function evolutionPieChart(labels,data,colors)
{
	
	var ctx = document.getElementById("evolution-pie-chart")
	new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: "Evolution Projets %",
        backgroundColor: colors,
        data: data
      }]
    },
    options: {
      title: {
        display: false,
        
      },
      
            legend: {
            	display : true,
            	labels: {
                
                fontSize:10
            }
            }
        
    }
});
}

$('.show-detail').on('click',function()
{
	categorie = $(this).attr('data-target');
	
	globalAffairesTable.ajax.reload(function(){
		$('#global-table-modal').modal('show');
		globalAffairesTable.columns.adjust();
	},true)
	
})

function pourcentRoundPie(container,value,color)
{
	
var bar = new ProgressBar.Circle(container, {
  color: '#aaa',
  // This has to be the same size as the maximum width to
  // prevent clipping
  strokeWidth: 2,
  trailWidth: 3,
  easing: 'easeInOut',
  duration: 1400,
  text: {
    autoStyleContainer: false,
    
  },
  from: { color: color, width: 4 },
  to: { color: color, width: 4 },
  // Set default step function for all animate calls
  step: function(state, circle) {
    circle.path.setAttribute('stroke', state.color);
    circle.path.setAttribute('stroke-width', state.width);

   
    if (value === 0) {
      circle.setText('0%');
    } else {
      circle.setText(value+"%");
    }

  }
});
bar.text.style.fontSize = '12px';
bar.animate(value/100);  // Number from 0.0 to 1.0
}





