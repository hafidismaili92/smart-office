
$('#menu-list-nouveauContrat').on('click',function(){
  $('#sidebar li').removeClass('active');
  $(this).addClass('active'); 
  $('#main-container').find('section.principal-sections').addClass('hidden_section');
  $("#addContrat-section").removeClass('hidden_section');
  
});

var form = $("#nouveau-contrat-form").show();

form.steps({
  headerTag: "h3",
  bodyTag: "fieldset",
  transitionEffect: "slideLeft",
  labels: {
    current: "current step:",
    pagination: "Pagination",
    finish: "Ajouter",
    next: "<i class='fa  fa-arrow-circle-right'></i> Suivant",
    previous: "<i class='fa  fa-arrow-circle-left'></i> Précédent",
    loading: "Loading ..."
  },
  onStepChanging: function (event, currentIndex, newIndex)
  {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
          return true;
        }
        // Valider le tableau des prix
        if (newIndex === 2)
        {
          var empty = true;
          var validprice=true;
          var nums =[];
          var msg='';
          nouvelleContratTable.rows().every(function (index, element) {
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
            return false; 
          }
        });
          if(empty) 
          {
            showInfoBox('error','la liste des prix est vide');
          
           return false;


         } 
         else if(!validprice) 
         {

          showInfoBox('error',msg);
          return false;
        }
      }

      if (currentIndex < newIndex)
      {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
          }
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {

          if(currentIndex===2)
          {

            window.setTimeout(function () { 
              map.updateSize();


            }, 100);
          }
          
        /*if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
        {
            form.steps("next");
        }
        
        if (currentIndex === 2 && priorIndex === 3)
        {
            form.steps("previous");
          }*/
        },
        onFinishing: function (event, currentIndex)
        {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
        },
        onFinished: function (event, currentIndex)
        {

          form.submit();
        }
      }).validate({
       errorPlacement: function errorPlacement(error, element) { element.after(error); },  
       rules: {
        confirm: {
          equalTo: "#password-2"
        },

      },
      messages:
      {
        confirm: {
          equalTo: "ce champs est différent"
        },
      },


    });

      var nouvelleContratTable = $('#nouveau-contrat-table').DataTable(
      {
        "processing": true,
        paging: true,
        "searching": false,
        "info": true,

        "createdRow": function( row, data, dataIndex){

          var tva = parseFloat($('#contrat-tva').val());
          var totalHt = parseFloat($('#total-ht').text())+parseFloat($(row).find('.tbl-total-prix').val());
          $('#total-ht').text(totalHt);
          $('#total-ttc').text(totalHt +(totalHt *tva/100));

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

        ],
        "ordering": false,
        "dom": 'frtip',
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


      $("#nouveau-contrat-form").submit(function(event){
        $('body').loadingModal({
          position:'auto',
          text:'',
          color:'#fff',
          opacity:'0.6',
          backgroundColor:'rgb(171, 15, 255)',
          animation:'doubleBounce'
        });
  event.preventDefault(); //prevent default action 
  var post_url = $(this).attr("action"); //get form action url
  var request_method = $(this).attr("method"); //get form GET/POST method
  var frmDta = new FormData(this);
  dtaArrayObject = prixTableToArrayObject(nouvelleContratTable);
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
      showInfoBox('success',result);
      
    },
    error: function(err){
      $('body').loadingModal('destroy');
      showInfoBox('error',err.responseText);
      

    }
  })
});

      $('#btn-add-prix').on('click',function(){
        var v = validatePriceInputs('#prix-data-container');

        if(!v.valid)
        {
          showInfoBox('error',v.msg);
         
        }
        else
        {
          nouvelleContratTable.row.add(v.data).draw();
          nouvelleContratTable.page('last').draw('page');
        }
      })
      
      $('#prix-xls-file').on('change',function(){
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
              tbl = $('#nouveau-contrat-table').dataTable();
              tbl.fnAddData(JSON.parse(result));
              nouvelleContratTable.page('last').draw('page');
              //nouvelleContratTable.columns.adjust().draw();

            },
            error: function(error)
            {
              $('body').loadingModal('destroy');
              showInfoBox('error',err.responseText);
             
            }
          })
        }
        else
        {
        $('body').loadingModal('destroy');
        showInfoBox('error','fichier non autorisé');
        
       }
     })

      $("#ville-contrat").on('change',function() {
        $('#secteur-ville').children().remove();
        if(this.value!='')
        {
          frm= new FormData();
          frm.append('ville',this.value)
          $.ajax({
            url : BaseUrl+'NouveauContrat/loadSectors',
            type: 'post',
            data : frm,
            cache:false,
            processData:false,
            contentType:false,
            success: function(result){
              dta = JSON.parse(result);
              for (var i=0;i<dta.length;i++)
              {
                $('#secteur-ville').append('<option value="'+dta[i].code+'"><span style="color: rgba(0,0,0,0.2);font-size: 12px;">'+dta[i].secteur+'</span></option>'); 
              }
              $('#secteur-ville').val(dta[0].code);
            },
            error: function(err){


            }
          })  
        }
        else
        {
          $('#secteur-ville').append('<option value="" selected><span style="color: rgba(0,0,0,0.2);font-size: 12px;">Selectionner</span></option>');
        }

      });

      $("#domaine-contrat").on('change',function() {
        $('#secteur-contrat').children().remove();
        if(this.value!='')
        {
          frm= new FormData();
          frm.append('domaine',this.value)
          $.ajax({
            url : BaseUrl+'NouveauContrat/loadDomaineSectors',
            type: 'post',
            data : frm,
            cache:false,
            processData:false,
            contentType:false,
            success: function(result){
              dta = JSON.parse(result);
              for (var i=0;i<dta.length;i++)
              {
                $('#secteur-contrat').append('<option value="'+dta[i].code+'"><span style="color: rgba(0,0,0,0.2);font-size: 12px;">'+dta[i].libelle+'</span></option>'); 
              }
              $('#secteur-contrat').val(dta[0].code);
            },
            error: function(err){


            }
          })  
        }
        else
        {
          $('#secteur-contrat').append('<option value="" selected><span style="color: rgba(0,0,0,0.2);font-size: 12px;">Selectionner</span></option>');
        }

      });

      $('#nouveau-contrat-table').on('click','.remove-prix',function(){
        trNode = $(this).parents('tr');
        var totalHt = parseFloat($('#total-ht').text())-parseFloat($(trNode).find('.tbl-total-prix').val());
        $('#total-ht').text(totalHt );
        var tva = parseFloat($('#contrat-tva').val());
        $('#total-ttc').text(totalHt +(totalHt *tva/100));
        nouvelleContratTable.row( $(trNode) )
        .remove()
        .draw();
      })
      $('#nouveau-contrat-table').on('input','input',function(){

        if($(this).hasClass("tbl-pu-prix") || $(this).hasClass("tbl-quantite-prix") )
        {

          var parent = $(this).parents('tr');
          var tva = parseFloat($('#contrat-tva').val());
          var intitialVal = $(parent).find('.tbl-total-prix').val();
          totalCol = $(parent).find('.tbl-quantite-prix').val()*$(parent).find('.tbl-pu-prix').val();
          $(parent).find('.tbl-total-prix').val(totalCol);
          totalht = parseFloat($('#total-ht').text())+parseFloat(totalCol)-parseFloat(intitialVal);
          $('#total-ht').text(totalht);
          $('#total-ttc').text(totalht+(totalht*tva/100));
        }
        
      })

      $('#contrat-tva').on('input',function(){

        var totalHt  = parseFloat($('#total-ht').text());
        var tva = parseFloat($(this).val());
        $('#total-ttc').text(totalHt +(totalHt *tva/100));
      })



      /****************************************DATATABLE TO JSON*****************************************/

      function prixTableToArrayObject(dtable) {


        dtaObjects=[];
        dtable.rows().every(function (index, element) {
          var tr = this.node();
          dtaObjects.push ( {

            'num_prix':$(tr).find('.tbl-numero-prix').val(),
            'lib_prix':$(tr).find('.tbl-libelle-prix').val(),
            'unite_prix':$(tr).find('.tbl-unite-prix').val(),
            'quantite_prix':parseFloat($(tr).find('.tbl-quantite-prix').val()),
            'pu_prix':parseFloat($(tr).find('.tbl-pu-prix').val()),

          } );
        });

        return dtaObjects;
      }

      /****************************************MAP PART***************************************************/

/*import 'ol/ol.css';
import Map from 'ol/Map';
import View from 'ol/View';
import {Draw, Modify, Snap} from 'ol/interaction';
import {Tile as TileLayer, Vector as VectorLayer} from 'ol/layer';
import {OSM, Vector as VectorSource} from 'ol/source';
import {Circle as CircleStyle, Fill, Stroke, Style} from 'ol/style';
import {Icon, Style} from 'ol/style';*/
var map;
var draw, snap; 
var source;
var lastFeature;
var geomType ='Point';
function init(){

  source = new ol.source.Vector();
  var iconBase4 = "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";
  var osmLayer = new ol.layer.Tile({source: new ol.source.OSM()});
  var affaireVectorLayer = new ol.layer.Vector({
    source: source,
    style: new ol.style.Style({
      fill: new ol.style.Fill({
        color: 'rgba(255, 0, 0, 0.2)'
      }),
      stroke: new ol.style.Stroke({
        color: '#ffcc33',
        width: 2
      }),
      image: new ol.style.Icon({
        anchor: [12, 35],
        anchorXUnits: 'pixels',
        anchorYUnits: 'pixels',
        src: 'data:image/icon.png;base64,'+iconBase4
      })
    })
  });
  map = new ol.Map({
    controls: ol.control.defaults({
      attributionOptions:({
        collapsible: false
      })
    }),
    layers: [osmLayer,affaireVectorLayer],
    target: 'map',
    view: new ol.View({
      center: [-722179.28, 4067538.48],
      zoom: 8
    })
  });
  window.setTimeout(function () { 

    addInteractions(geomType);

  }, 100);

}
function addInteractions(geom) {
  draw = new ol.interaction.Draw({
    source: source,
    type: geom,
    
  });
  draw.on('drawstart', function (e) {

    source.clear();
    $('#geom-type').val("");
    $('#geom-coordonnees').val(""); 
  });
  
  draw.on('drawend', function (e) {

    ftgeom = e.feature.getGeometry();
    geom =ftgeom.transform('EPSG:3857', 'EPSG:4326');
    var format = new ol.format.WKT();
    var wktRepresenation  = format.writeGeometry(geom);
    $('#geom-type').val(ftgeom.getType());
    $('#geom-coordonnees').val(wktRepresenation); 
    var feature = new ol.Feature({
      geometry: e.feature.getGeometry().transform('EPSG:4326','EPSG:3857'),
      labelPoint: "localisation",
      name: 'My point'
    });
    source.addFeature(feature);
  });
  map.addInteraction(draw);
  snap = new ol.interaction.Snap({source: source});
  map.addInteraction(snap);

}
$(document).ready(function() {

  init();
});

$('#reset-emplacement').on('click',function(){  
  //source.clear();
  $('#geom-type').val('');
  $('#geom-coordonnees').val('');

})

$('#btn-removeAllprix-contrat').on('click',function(){
  if(confirm('Voulez vous vider la table des prix?'))
  {
    nouvelleContratTable.clear().draw();
  }
})
