/********************************************manupilate the DATATABLES SEARCH************************************/
ol.ProxyHost = BaseUrl+'EditComoposantes/GetLayer?url=';
var RowIdToHide = [];
$.fn.dataTable.ext.search.push( //like that we can hide rows on delete without remove theme so that we ca take theme back when non confirm Add
  function( settings, searchData, index, rowData,counter) {
    if(settings.nTable.id=='add-geoComposantes-tables')
    {
      if ($.inArray(searchData[0],RowIdToHide)<0)
      {
        return true;
      }
      return false;
    }
    return true;
  }
  );
/**************************************define Projections*****************************************/
proj4.defs([
  ["EPSG:26191","+proj=lcc +lat_1=33.3 +lat_0=33.3 +lon_0=-5.4 +k_0=0.999625769 +x_0=500000 +y_0=300000 +a=6378249.2 +b=6356515 +towgs84=31,146,47,0,0,0,0 +units=m +no_defs"],
  ["EPSG:26192","+proj=lcc +lat_1=29.7 +lat_0=29.7 +lon_0=-5.4 +k_0=0.9996155960000001 +x_0=500000 +y_0=300000 +a=6378249.2 +b=6356515 +towgs84=31,146,47,0,0,0,0 +units=m +no_defs"],
  ["EPSG:26194","+proj=lcc +lat_1=26.1 +lat_0=26.1 +lon_0=-5.4 +k_0=0.999616304 +x_0=1200000 +y_0=400000 +a=6378249.2 +b=6356515 +towgs84=31,146,47,0,0,0,0 +units=m +no_defs"],
  ["EPSG:26195","+proj=lcc +lat_1=22.5 +lat_0=22.5 +lon_0=-5.4 +k_0=0.999616437 +x_0=1500000 +y_0=400000 +a=6378249.2 +b=6356515 +towgs84=31,146,47,0,0,0,0 +units=m +no_defs"]
  ]);
ol.proj.setProj4(proj4);
const availableProjections ={
  '26191' : {libelle:'Maroc Lambert Z1',value:ol.proj.get('EPSG:26191')},
  '26192' : {libelle:'Maroc Lambert Z2',value:ol.proj.get('EPSG:26192')},
  '26194' : {libelle:'Maroc Lambert Z3',value:ol.proj.get('EPSG:26194')},
  '26195' : {libelle:'Maroc Lambert Z4',value:ol.proj.get('EPSG:26195')},
  '4326' : {libelle:'World-WGS84',value:ol.proj.get('EPSG:4326')}
}
onAddhtmlActions = '<div class="customtooltip onAdd-actions"><i class="far fa-trash-alt remove-feature "></i><span class="tooltiptext">Supprimer</span></div><div class="customtooltip onAdd-actions"><i class="fas fa-vector-square feature-showBorne"></i><span class="tooltiptext">Afficher les bornes</span></div>';
/***********************************************control selectedFeatures Style**********************************************/
selectedFeatures = [];
/*******************************************editingState******************************************/
var drawMode = {
  none : 0,
  addAffaireMode:{projection:availableProjections['4326'].value,geomType:'Point'},
}
var editingState = drawMode.none;
/**********************************************set Datatable for affaire attributes-table************************************************/
var dataTableoptions = {
  "ordering": false,
  "paging": false,
  "processing": false,
  responsive: false,
  "scrollY":"55vh",
  "scrollX": false,
  "scrollCollapse": true,
  rowId: 0,
  "fixedColumns":   {
    leftColumns:2
  },
  "createdRow": function( row, data, dataIndex){
    $(row).attr('id',data[0]);
  },
  "dom": 'tip',
  "lengthMenu": [8,12,50,100],
  "pageLength": 8,
  "bSortClasses": false,
  columnDefs : [
  { className: 'dt-center',"targets": "_all"},
  //{"targets": 0,"visible": false,"searchable": false},
  {"targets": 1,"searchable": false},
  ],
  //"order": [[ 1, "desc" ]],
  language: datatableLangage,
};
var attributesAddTable = $('#add-geoComposantes-tables').DataTable(dataTableoptions);
/********************************************set vector layers******************************************/
var sourceOnAdd = new ol.source.Vector();// contient les dessins ajoutées non confirmés
var onAddStyle = new ol.style.Style({
  fill: new ol.style.Fill({
    color: 'rgba(67, 210, 223, 0.28)'
  }),
  stroke: new ol.style.Stroke({
    color: 'red',
    width: 1
  }),
  image: new ol.style.Circle({
    radius: 7,
    fill: new ol.style.Fill({color: 'rgba(243, 73, 57, 0.8)'}),
    stroke: new ol.style.Stroke({
      color: [255,255,255], width: 1
    })
  })
});
var selectedStyle = new ol.style.Style({
  fill: new ol.style.Fill({
    color: 'rgba(210, 210,0, 0.28)'
  }),
  stroke: new ol.style.Stroke({
    color: 'rgba(70, 238, 241, 1)',
    width: 1
  }),
  image: new ol.style.Circle({
    radius: 7,
    fill: new ol.style.Fill({color: 'rgba(70, 238, 241, 1)'}),
    stroke: new ol.style.Stroke({
      color: [255,255,255], width: 2
    })
  })
});
var vectorOnAdd = new ol.layer.Vector({
  source: sourceOnAdd,
  style: onAddStyle
});
var baseMap = new ol.layer.Tile({
  source: new ol.source.OSM()
});
var tomtomBaseMap = new ol.layer.Tile({
            source: new ol.source.XYZ({
              url: 'https://api.tomtom.com/map/1/tile/basic/main/{z}/{x}/{y}.png?tileSize=512&view=MA&key=zJGTjkv8uPoyCdES0F0xxXH30YP0mC11',
            })
          })
/****************************************Add MAP**********************************************************************/
/*testgeoserver = new ol.source.TileWMS({
url:BaseUrl+'EditComoposantes/GetLayer',
params : {'LAYERS':'geobusiness:geocomposante','tiled':true},
serverType:'geoserver'
});
var featureLayer = new ol.layer.Tile({
source : testgeoserver,
})*/
var map = new ol.Map({
  controls: ol.control.defaults({
    attributionOptions: {
      collapsible: false
    }
  }),
  layers: [tomtomBaseMap,vectorOnAdd],
  target: 'main-map',
  loadTilesWhileAnimating: true,
  view: new ol.View({
    center: [-6,39],
    zoom: 6,
    projection:availableProjections['4326'].value
  })
});
/********************************************set custom controls*************************************************/
window.app = {};
var app = window.app;
app.drawControl = function(opt_options) {
  ControlsContainer = document.createElement('div');
  var options = opt_options || {};
  ControlsContainer.className = 'ol-draw-container ol-control';
  var buttons = {
    'Polygon':document.createElement('button'),
    'Point':document.createElement('button'),
    'LineString':document.createElement('button')
  }
  buttons['Polygon'].innerHTML = '<i class="fas fa-draw-polygon fa-2x"></i>';
  buttons['LineString'].innerHTML = '<i class="fas fa-road fa-lg"></i>';
  buttons['Point'].innerHTML = '<i class="fas fa-map-marker-alt fa-lg"></i>';
  var this_ = this;
  $.each(['Polygon','Point','LineString'],function(i,val){
    var element = document.createElement('div');
    element.className = 'draw-'+val;
    element.appendChild(buttons[val]);
    element.addEventListener('click', function(){addInteractions(sourceOnAdd,val)}, false);
    element.addEventListener('touchstart',function(){addInteractions(sourceOnAdd,val)}, false);
    ControlsContainer.appendChild(element);
  })
  ol.control.Control.call(this, {
    element: ControlsContainer,
    target: options.target,
  });
};
var drawZone;
var sourcePrint = new ol.source.Vector({wrapX: false});
var vectorPrint = new ol.layer.Vector({
  source: sourcePrint
});
map.addLayer(vectorPrint);
function updatePrintZone()
{
  if($('#map-wrapper').hasClass('print-mode'))
  {
    widthPage = $('#map-wrapper').width();
    heightPage = widthPage*0.7070;
    $('#map-wrapper').height(heightPage);
    initialSize = map.getSize(); 
    initialRes = map.getView().getResolution();
    map.setSize([ widthPage,heightPage]);
    map.updateSize();
    ratio = map.getSize()[0]/initialSize[0];
    map.getView().setResolution( initialRes/ratio);
    $('#map-mask').width($('#map-wrapper').outerWidth());
    $('#map-mask').height($('#map-wrapper').outerHeight());

    $('#map-mask').offset({'top':$('#map-wrapper').offset().top,'left':$('#map-wrapper').offset().left});
  }
}
function showPrintDialogs()
{
  $('.custom-modal-left').addClass('hidden');
  if($('#print-dialog').hasClass('hidden')) $('#print-dialog').removeClass('hidden');
  $('#map-wrapper').addClass('print-mode');
  $(Popupelement).popover('dispose');
  $('#map-mask').removeClass('hidden');
  $('#map-wrapper').find('.ol-control').addClass('hidden');
  updatePrintZone();
}
function closePrintDialogs()
{

  $('#print-dialog').addClass('hidden');
  $('#map-wrapper').removeClass('print-mode');
  $('#map-wrapper').css('height','100%');
  AxisLayer.getSource().clear();
  map.updateSize();
  $('#map-mask').addClass('hidden');
  $('#map-wrapper').find('.ol-control').removeClass('hidden');
}
$( window ).resize(function() {
  updatePrintZone();
});
app.mapTools = function(opt_options)
{
  mapToolsContainer = document.createElement('div');
  var options = opt_options || {};
  mapToolsContainer.className = 'ol-mapTool-container ol-control';
  var this_ = this;
  elementsArray = [
  {icon:'fas fa-print',text:'imprimer',id:'imprimer-carte',action:showPrintDialogs},
  {icon:'fas fa-search',text:'Chercher Lieu',id:'chercher-lieu'},
  {icon:'fas fa-map-marker-alt',text:'Go To x,y',id:'chercher-coord'},
  {icon:'fas fa-search-plus',text:'zoome fenêtre',id:'map-zoom'},
  {icon:'fas fa-ruler',text:'Mesurer une distance',id:'mesure-distance'},
  {icon:'fas fa-draw-polygon',text:'Mesurer une superficie',id:'mesure-surface'},
  ]
  $.each(elementsArray,function(i,val){
    var toolElement  = $('<div><button class="btn bg-transparent" data-toggle="tooltip" data-placement="right" title="'+val.text+'" id="'+val.id+'"><i class="'+val.icon+' fa-lg"></i></button></div>');   
   
    $(toolElement).on('click','button',function(){
      val.action();
    });             

    $(mapToolsContainer).append(toolElement);
  })
  ol.control.Control.call(this, {
    element: mapToolsContainer,
    target: options.target,
  });
}
ol.inherits(app.drawControl, ol.control.Control);
ol.inherits(app.mapTools, ol.control.Control);
map.addControl(new app.drawControl());
map.addControl(new app.mapTools());
/****************************************INTERACTIONS************************************************/
      var draw, snap,modify; // global so we can remove them later
      function removeInteractions()
      {
        //map.removeInteraction(modify);
        if(draw!=null ) map.removeInteraction(draw);
        if(snap!=null ) map.removeInteraction(snap);
        draw = snap = null;
      }
      function addInteractions(source,typeGeom) {
        removeInteractions();
        //modify = new ol.interaction.Modify({source: source});
        //map.addInteraction(modify);
        draw = new ol.interaction.Draw({
          source: source,
          type: typeGeom,
          style: new ol.style.Style({
            fill: new ol.style.Fill({
              color: 'rgba(255, 0, 0, 0.3)'
            }),
            stroke: new ol.style.Stroke({
              color: 'rgba(255,0,0,1)',
              width: 2,
              lineDash: [.1, 10],
              lineDashOffset: 6
            }),
            image: new ol.style.Circle({
              radius: 7,
              fill: new ol.style.Fill({
                color: '#ffcc33'
              })
            })
          })
        })
        map.addInteraction(draw);
        snap = new ol.interaction.Snap({source: source});
        map.addInteraction(snap);
      }
      var popup = new ol.Overlay({
        element: document.getElementById('ol-map-popup'),
      });
      map.addOverlay(popup);
      var Popupelement = popup.getElement();
      map.on('click', function(evt) {

        var coordinate = evt.coordinate;
        isDraw = function(){ return draw};
        if(isDraw()!=null) return;
        var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
          return feature;
        });
        if (feature) {
          html = '<ul class ="featurPopupList list-group">';
          idFeature = feature.getId();

          if(idFeature.startsWith("userGeocomposantes."))
          {
            idFeature= idFeature.replace('userGeocomposantes.','');
            var geomProp = feature.get('geomprop').split(";");
            var geomType = feature.getGeometry().getType();
            geomProp = $.map( geomProp, function( val, i ) {return round(val,5).toLocaleString()});
            htmlLine = '<li class="list-group-item list-group-item-info"><h6>Geometrie Info</h6></li><li class="list-group-item"><span>SRID: </span> '+feature.get('srid')+'('+availableProjections[feature.get('srid')].libelle+')';
            switch(geomType){
              case 'Point':
              htmlLine = htmlLine+'<li class="list-group-item"><span>X:</span> '+geomProp[0]+'</li><li class="list-group-item"><span> Y :</span> '+geomProp[1]+'</li>';
              break;
              case 'LineString':
              htmlLine = htmlLine+'<li class="list-group-item"> <span>Longueur :</span> '+geomProp[1]+' m</li>';
              break;
              case 'Polygon':
              htmlLine = htmlLine+'<li class="list-group-item"><span>Surface:</span> '+geomProp[0]+' m²</li><li class="list-group-item"><span>Perimetre :</span> '+geomProp[1]+' m</li>';
              break;
            }
            htmlLine = htmlLine+'<li class="list-group-item list-group-item-info"><h6>Info. Attributaires</h6></li>';
            if(feature.get('fvalues') && feature.get('flibelle'))
            {
              var fvalues = feature.get('fvalues').split("&&");
              var flibelle= feature.get('flibelle').split("&&");
              if(fvalues.length==flibelle.length)
              {
                for(i=0;i<flibelle.length;i++)
                {
                  htmlLine = htmlLine+'<li class="list-group-item"> <span>'+flibelle[i]+':</span> '+fvalues[i]+'</li>';
                }
              }
            }
            html = html+htmlLine;
          }
          var affaireName = affairesTable.row('#'+feature.get('idgeoaffaire')).data()[2];
          $(Popupelement).popover('dispose');
          popup.setPosition(coordinate);
        // the keys are quoted to prevent renaming in ADVANCED mode.
        $(Popupelement).popover({
          'placement': 'top',
          'animation': false,
          'title': '<h6>Affaire :'+affaireName+'</h6>',
          'html': true,
          'content': html
        });
        $(Popupelement).popover('show');
      } else {
        $(Popupelement).popover('dispose');
      }
    });
      map.on('pointermove', function(e) {

        if (e.dragging) {
          $(Popupelement).popover('dispose');
          return;
        }
        var pixel = map.getEventPixel(e.originalEvent);
        var hit = map.hasFeatureAtPixel(pixel);
        map.getTargetElement().style.cursor = hit ? 'pointer' : '';
      });
      /*map.on('click', function(evt) {
        map.updateSize();
        evt.stopPropagation();
        isDraw = function(){ return draw};
        if(isDraw()!=null) return;
        var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
          return feature;
        });
        if (feature) {
          popup.setPosition(evt.coordinate);
          console.log(evt.coordinate);
          $(element).popover({
            'placement': 'top',
            'html': true,
            'content': 'bbfbf'
          });
          $(element).popover('show');
        } else {
          $(element).popover('dispose');
        }
      });*/
       // change mouse cursor when over marker
       /********************************************************************************************/
       $('.header-tab').click(function(e){
        $('#affaires-content .tab-section').removeClass('active');
        $($(this).attr('data-target')).addClass('active');
        parent = e.target.closest('.header-tab');
        position = $(parent).offset();
        $('.header-tab.active .tab-active-focus').offset({top:position.top,left:position.left});
        setTimeout(function () { 
          $('.header-tab').removeClass('active');
          tabActivFocus = $(parent).find('.tab-active-focus');
          $(tabActivFocus).css('top',0);
          $(tabActivFocus).css('left',0);
          $(parent).addClass('active');
        }, 1000);
      });
       $('#geom-selector div').click(function()
       {
        element = $(this);
        if(attributesAddTable.rows().count()>0)
        {
          customConfirmedialog('les enregistrements déja créés seront supprimés, voulez vous continuer?',null, function(event,triggeEvent=true){
           
            if(triggeEvent)
            {
              attributesAddTable.clear().draw();
            sourceOnAdd.clear();
            $('#geom-selector input[name="add-radio"]').removeAttr('checked');
            $(element).find('input[name="add-radio"]').attr('checked','checked');
            $('#geom-selector div').removeClass('active');
            $(element).addClass('active');
            }
          }, function(){})
        }
        else
        {
          $('#geom-selector input[name="add-radio"]').removeAttr('checked');
          $(element).find('input[name="add-radio"]').attr('checked','checked');
          $('#geom-selector div').removeClass('active');
          $(element).addClass('active');
        }
      })
       $('#add-geoComposantes').click(function(){
         startAddGeometries();
       })
       function startAddGeometries()
       {
         if($('#add-geometries-data-modal').hasClass('hidden')) $('#add-geometries-data-modal').removeClass('hidden')
           attributesAddTable.columns.adjust().responsive.recalc();
         geomType = $('#geom-selector div.active p').attr('data-geomType');
         $('#main-map-container').find('.ol-draw-container div').removeClass('active');
         $('#main-map-container').find('.draw-'+geomType).addClass('active');
         editingState= drawMode.addAffaireMode;
         editingState.projection=availableProjections[$('#projection-selector').val()].value;
         editingState.geomType = geomType;
         $('#main-map-container').find('.draw-'+geomType).trigger('click');
       }
       function stopAddGeometries(parentTocloseID)
       {
        removeInteractions();
        RowIdToHide=[];
        attributesAddTable.draw();
        editingState= drawMode.none;
        $('#main-map-container').find('.ol-draw-container div').removeClass('active');
        if(!$(parentTocloseID).hasClass('hidden')) $(parentTocloseID).addClass('hidden');
      }
      vectorOnAdd.getSource().on('addfeature', function(event){
       feature = event.feature;
       if(!feature.get('dataSource')) feature.set('dataSource','draw');
       featureProprieties = feature.getProperties();
       switch(editingState)
       {
        case (drawMode.addAffaireMode):
        compostantesTAble = '#add-geometries-data-modal table tbody';
        countExistingComposantes = $(compostantesTAble+' tr').length;
        idFeature=featureProprieties['idFeature'];
        if(!idFeature)
        {
          dte = new Date();
          idFeature= dte.getTime()+'_'+(countExistingComposantes+1);
          feature.setProperties({'idFeature':idFeature});
          feature.setId(idFeature);
        }
        else if(feature.getId()!=idFeature) feature.setId(idFeature);
        if(!feature.get('fieldsRow'))
        {
          /**********************DYNAMIC ATTRIBUTES MODAL****************************************/
          $('#attributes-modal .hidden-featureID').val(idFeature);
          if($('#attributes-modal input:not(.hidden-item)').length>0)
          {
            $('#attributes-modal').modal('show');
          }
          else{$("#perform-add-composanteForm").trigger('submit')};
        }
        else
        {
          attributesAddTable.row.add(feature.get('fieldsRow')).draw(false);
          feature.unset('fieldsRow');
        }
        iswktGeom = featureProprieties['wktGeom'];
        if(!iswktGeom){
          src=availableProjections['4326'].value;
          dest = editingState.projection;
          geometry = feature.clone().getGeometry();
          labels=[];
          if(src != dest) coord = geometry.transform(src,dest).getCoordinates()
            else coord = geometry.getCoordinates()
              wktGeom = geomToWKT(geometry);
            if(geometry.getType()!='Point' ) 
            {
              if(geometry.getType()=='Polygon' ) coord = coord[0]
               for(i=0;i<coord.length;i++)
               {
                labels.push('p'+i);
              }
            }
            else
            {
             labels=['P1'];
           };
           feature.setProperties({'labels':labels,'wktGeom':wktGeom});
         }
         if(feature.get('confirmed')==undefined) feature.set('confirmed',false);
         if(feature.get('deleted')==undefined) feature.set('deleted',false);
         break;
       }
     });
      $('#add-geometries-data-modal table tbody').on('click','.feature-showBorne',function(){
       bornesDomTable = $("#ShowBornes-modal #bornes-table tbody");
       $(bornesDomTable).empty();
       parent = $(this).closest('tr');
       row = attributesAddTable.row(parent);
       featureID = row.id();
       $('#ShowBornes-modal .hidden-featureID').text(featureID);
       feature =sourceOnAdd.getFeatureById(featureID);
       geomType =  feature.getGeometry().getType();
       wktGeom = feature.getProperties().wktGeom;
       wktFormat= new ol.format.WKT;
       geom = wktFormat.readGeometry(wktGeom);
       labels = feature.getProperties().labels;
       coord = geom.getCoordinates();
       switch(geomType)
       {
        case 'Polygon':
        coord = coord[0];
        break;
        case 'Point':
        coord = [coord];
        break;
      }
      
      if(feature && coord.length>0 && coord.length==labels.length)
      {
        for(i=0;i<labels.length;i++)
        {
          html = '<tr><td><input type="text" value="'+labels[i]+'"></input></td><td>'+coord[i][0]+'</td><td>'+coord[i][1]+'</td></tr>';
          $(bornesDomTable).append(html);
        }
        $('#ShowBornes-modal').modal('show');
      }
    })
      $('#updateBornes').click(function(){
        newLabels = [];
        parent = $('#ShowBornes-modal');
        $(parent).find('input').each(function(){
          newLabels.push($(this).val());
        })
        feature = sourceOnAdd.getFeatureById(featureID);
        feature.set('labels',newLabels);
      })
      $('#btn-add-attributes').click(function(e){
        e.preventDefault();
        champs = $('#addgeoffaire-add-attributes').val();
        createAttributes([champs],reInitializeDatatable);
      })
      $('#attributes-container').on('click','.remove-champs-value',function(){
        champs = $(this).closest('.champsView').find('label').text();
        removeAttributes([champs],false,reInitializeDatatable);
      })
      $('#ignore-add-attributes').on('click',function(){
        parent = $(this).closest('form');
        attributes = [$(parent).find('.hidden-featureID').val(),onAddhtmlActions];
        $(parent).find('input:not(.hidden-item)').each(function(){
          attributes.push('');
        })
        attributesAddTable.row.add(attributes).draw(false);
      })
      $("#perform-add-composanteForm").submit(function(event){
  event.preventDefault(); //prevent default action 
  attributes = [$(this).find('.hidden-featureID').val(),onAddhtmlActions];
  $(this).find('input:not(.hidden-item)').each(function(){
    attributes.push($(this).val());
  })
  attributesAddTable.row.add(attributes).draw(false);
  if(($("#attributes-modal").data('bs.modal') || {})._isShown )  $("#attributes-modal").modal('hide');
});
      function parseComposante(formdData)
      {
        geomType = $('#geom-selector div.active p').attr('data-geomType');
        if(geomType != 'Polygon')
        {
          showInfoBox('error','geometry invalide');
          return;
        }
        else
        {
          url = BaseUrl+'CustomReader/parseComposante';
          $.ajax({
            url: url,
            data : formdData,
            type: 'POST',
            cache:false,
            processData:false,
            contentType:false,
            success: function(result){
              dta = JSON.parse(result);
            const coord= dta.coord.map((i) => i.map((j)=>Number(j))); // convert to numbers.
            geom = new ol.geom.Polygon([coord]);
            validGeom = checkValidateGeom(geom,editingState.projection,availableProjections['4326'].value,'Polygon',geomType);
            if(!validGeom.isValid) 
            {
              showInfoBox('error',validGeom.errorMsg,5000);
              return;
            }
            var featuredta = new ol.Feature({
              geometry: validGeom.mapGeom,
              idFeature:dta.id,
              dataSource:'excel',
              wktGeom : validGeom.wktForm,
              labels:dta.labels,
              confirmed:false,
              deleted:false
            });
            featuredta.setId(dta.id);
            sourceOnAdd.addFeature( featuredta);
            var composanteName =  dta.composanteName;
            attributeName = $('#champs-selector').val();
            $('#attributes-modal').find('input[id="attribute-'+attributeName+'"]').val(composanteName);
            //var extent = sourceOnAdd.getExtent();
            var extent = validGeom.mapGeom.getExtent();
            flyTo(map.getView(),extent);
          },
          error:function(error){
          }
        })
        }
      }
      function parseAffaire(formdData)
      {
        removeAttributes([],true,reInitializeDatatable);
        $('.loader-container').addClass('active');
        editingState= drawMode.addAffaireMode;
        url = BaseUrl+'CustomReader/parseAffaire';
        $.ajax({
          url: url,
          data : formdData,
          type: 'POST',
          cache:false,
          processData:false,
          contentType:false,
          success: function(result){

            dataArray = JSON.parse(result);
            shpProjection = dataArray.proj;
            if($.inArray(dataArray.geomType,['Polygon','PolyLine','Point'])>=0)
            {
              $('#add-geom-'+dataArray.geomType).closest('div').trigger('click',[false]);
            }
            else
            {
              alert('format non prise en charge');
              return;
            }
            features = dataArray.record.features;
            var geojsonObject = {
              'type': 'FeatureCollection',
              'crs': {
                'type': 'name',
                'properties': {
                  'name': 'EPSG:'+shpProjection,
                },
              },
              'features':features
            };
            
            $('#projection-selector').val(shpProjection);

            featuresSource = new ol.format.GeoJSON().readFeatures(geojsonObject,{dataProjection: availableProjections[shpProjection].value,featureProjection: availableProjections['4326'].value});
            
              createAttributes(dataArray.fieldsName,reInitializeDatatable,function(){
              sourceOnAdd.clear();
              sourceOnAdd.addFeatures(featuresSource);
              vectorOnAdd.getSource().changed();
              var extent = sourceOnAdd.getExtent();
              flyTo(map.getView(),extent);
            });
            
          },
          error:function(error){
            showInfoBox('error',error.responseText);
          }
        })
      }
      $('#add-manual-composante').on('click',function(){
        $('#add-manual-compo-modal').modal('show');
      })
      $('#add-manual-borne').on('click',function(){
        parent = $('#manual-Geom');
        label = $(parent).find('.manual-borne-label').val();
        x= $(parent).find('.manual-borne-x').val();
        y= $(parent).find('.manual-borne-y').val();
        if(x !='' && y !='' && label!='') 
        {
          if(editingState.geomType == 'Point')
          {
            $('#manual-bornes-table tbody').children().remove();
          }
          $('#manual-bornes-table tbody').append('<tr><td>'+label+'</td><td>'+x+'</td><td>'+y+'</td><td><i class="far fa-trash-alt removeBorne" style="color:red;cursor:pointer;"></i></td></tr>');
        }  
      })
      $('#perform-manual-composante').on('click',function(e){
        e.preventDefault();
        projection = editingState.projection;
        geomtype = editingState.geomType;
        var originalGeom;
        var coord = [];
        var labels= [];
        parent = $('#manual-bornes-table tbody');
        switch(geomtype){
          case 'Point':
          row = $(parent).find('tr').eq(0);
          label = $(row).find('td').eq(0).text();
          x = $(row).find('td').eq(1).text();
          y = $(row).find('td').eq(2).text();
          coord=[Number(x),Number(y)];
          labels = [label];
          geom = new ol.geom.Point(coord);
          validGeom = checkValidateGeom(geom,projection,availableProjections['4326'].value,geomtype,geomtype);
          break;
          case 'LineString':
          case 'Polygon':
          $(parent).find('tr').each(function(){
            label = $(this).find('td').eq(0).text();
            x = $(this).find('td').eq(1).text();
            y = $(this).find('td').eq(2).text();
            coord.push([Number(x),Number(y)]);
            labels.push(label);
          })
          if(geomtype=='LineString') geom = new ol.geom.LineString(coord)
            else {
              coord.push(coord[0]);
              geom = new ol.geom.Polygon([coord]);
            };
            validGeom = checkValidateGeom(geom,projection,availableProjections['4326'].value,geomtype,geomtype);
            break;
          }
          if(!validGeom.isValid) 
          {
            showInfoBox('error',validGeom.errorMsg,5000);
            return;
          }
          dte = new Date();
          idFeature= dte.getTime()+'_1';
          attributes = [idFeature,onAddhtmlActions];
          $('#manual-attributes').find('input:not(.hidden-item)').each(function(){
            attributes.push($(this).val());
          })
          var featuredta = new ol.Feature({
            geometry: validGeom.mapGeom,
            idFeature:idFeature,
            dataSource:'manual',
            wktGeom:validGeom.wktForm,
            confirmed:false,
            labels: labels,
            deleted:false,
            fieldsRow:attributes
          });
          featuredta.setId(idFeature);
          sourceOnAdd.addFeature( featuredta);
          var extent = geom.getExtent();
          flyTo(map.getView(),extent);
          $('#add-manual-compo-modal').modal('hide');
        })
      $('body').on('click','.removeBorne',function(){
        $(this).closest('tr').remove();
      })
      $('#add-geoComposantes-tables').on('click','.remove-feature',function(){
        parent = $(this).closest('tr');
        row = attributesAddTable.row(parent);
        parentRowId = row.id();
        feature = sourceOnAdd.getFeatureById(parentRowId);
        if(!feature || !feature.getProperties().confirmed)
        {
          row.remove();
          if(feature) sourceOnAdd.removeFeature(feature);
        }
        else
        {
          RowIdToHide.push(parentRowId);
          feature.setStyle(new ol.style.Style({}));   
          feature.set('deleted',true);
        }
        attributesAddTable.draw();
      })
      $('#confirm-add-geocomposantes').click(function(){
        sourceOnAdd.getFeatures().forEach(function(f) {
          id = f.getId();
          if(f.getProperties().deleted) 
          {
            sourceOnAdd.removeFeature(f);
            attributesAddTable.row('#'+id).remove();
          }
          else
          {
           f.set('confirmed',true);
         }
       });
        stopAddGeometries('#add-geometries-data-modal');
      })
      $('#close-add-geocomposantes').click(function(){
        if(attributesAddTable.rows().count()>0)
        {
          customConfirmedialog('vos modification seront ignorées, voulez-vous continuez?',null,function(dta){
            sourceOnAdd.getFeatures().forEach(function(f) {
              id = f.getId();
              if(!f.getProperties().confirmed)
              {
                sourceOnAdd.removeFeature(f);
                attributesAddTable.row('#'+id).remove();
              }
              else if(f.getProperties().deleted) 
              {
                f.setStyle(onAddStyle);
                f.setProperties({'deleted':false});
              }
            });
            stopAddGeometries('#add-geometries-data-modal');
          },function(dta){});
        }
        else
        {
          stopAddGeometries('#add-geometries-data-modal');
        }
      })
      $('#insert-affaire').click(insertAffaire);
      function insertAffaire()
      {
        affName = $('#addgeoffaire-name').val();
        fields = $.map($('#add-geoComposantes-tables thead th'),function(val,index){return $(val).text()});
        globalAffData = {
          'affName':affName,
          'geocomposantes':[],
          'srid':$('#projection-selector').val(),
          'geomType':$('#geom-selector div.active p').attr('data-geomType'),
          'fields':fields.slice(2) 
        };
        attributesAddTable.rows().every(function ( rowIdx, tableLoop, rowLoop ) {
          var data = this.data().slice(2);
          feature = sourceOnAdd.getFeatureById(this.id());
          if(feature)
          {
            globalAffData['geocomposantes'].push({
              wktGeom: feature.get('wktGeom'),
              labels: feature.get('labels'),
              fieldsValues: data,
            })
          }
        } );
        url = BaseUrl+'EditGeoBusiness/insertAffaire';
        $.ajax({
          url: url,
          data : globalAffData,
          type: 'POST',
          dataType: 'JSON',
          success: function(result){
            if($.isNumeric(result))
            {
              showInfoBox('success','Votre affaire a été ajoutée');
               sourceOnAdd.clear();
              $('#affaire-tab').trigger('click');
              affairesTable.ajax.reload(addAffToMap(result));
            }
          },
          error:function(error){
            showInfoBox('error',error.responseText,3000);
          }
        })
      }
      /***********************GENERAL PURPOSE FUNCTIONS*********************************************/
      function createAttributes(attributesArray,callback,callback2=function(){}){
        arr = []
        $('#attributes-container').find('.champsView label').each(function(index){
          arr.push($(this).text());
        });
        for(i=0;i<attributesArray.length;i++)
        {
          champs = attributesArray[i];
          validity = checkNameValidity(champs,40,0,false,arr);
          if (!validity.valid && attributesArray.length==1){
            alert(validity.errorMsg)
          }
          else
          {
           var val = '<label>'+champs+'</label><span class="remove-champs-value">x</span>';
           var div = document.createElement("div"); 
           div.innerHTML =val;
           $(div).addClass('champsView')
           $('#attributes-container').append(div);
           arr.push(champs);
         }
       }
       callback(attributesAddTable,attributesArray,'add',dataTableoptions,false,actualizeAtrributesContainer,callback2);
     }
     function removeAttributes(attributesArray,isRemoveAll=false,callback,callback2=function(){})
     {
      if(isRemoveAll)
      {
        $('#attributes-container').find('.champsView').remove();
      }
      else{
       for(i=0;i<attributesArray.length;i++)
       {
        champs = attributesArray[i];
        $('#attributes-container').find('.champsView').each(function(){
          if(champs == $(this).find('label').text())
          {
            $(this).remove();
          }
        })
      }
    }
    console.log(isRemoveAll);
    callback(attributesAddTable,attributesArray,'remove',dataTableoptions,isRemoveAll,actualizeAtrributesContainer,callback2);
  }
  function reInitializeDatatable(table,attributesArray,addOrRemove,dataTableoptions,isAll=false,callback,callback2)
  {
    idTable = $(table.table().node()).attr('id');
    if($.fn.DataTable.isDataTable('#'+idTable))
    {
      table.destroy();
      switch (addOrRemove)
      {
        case 'add':
        
        for(i=0;i<attributesArray.length;i++)
        {
          attribute = attributesArray[i];
          $('#'+idTable+' thead tr').append('<th>'+attribute+'</th>');
          $('#'+idTable+' tbody tr').each(function(){
            $(this).append('<td></td>');
          })
        }
        break;
        case 'remove':
        if(isAll)
        {

          $('#'+idTable+' thead tr th').each(function(index){
            if (index != 0 && index != 1)
            {


             $(this).remove();
           }
         })
          $('#'+idTable+' tbody tr').remove();
        }
        else
        {
          for(i=0;i<attributesArray.length;i++)
          {
            attribute = attributesArray[i];
            $('#'+idTable+' thead tr th').each(function(index){
              if($(this).text()==attribute)
              {
                $('#'+idTable+' tbody tr').each(function(){
                  $(this).find('td').eq(index).remove();
                });
                $(this).remove();
                return false;
              }
            })
          }
        }
        break;
        default:
        return;
        break;
      }
     console.log($('#'+idTable).html());
     
      attributesAddTable = $('#'+idTable).DataTable(dataTableoptions);
      callback2();
      callback('.add-attributes-modal',attributesArray,addOrRemove,isAll);
    }
  }
  function actualizeAtrributesContainer(container,attributesArray,addOrRemove,isAll=false)
  {
   switch (addOrRemove)
   {
    case 'add':
    for(i=0;i<attributesArray.length;i++)
    {
      attribute = attributesArray[i];
      newElement = $( container+" .attributesValues-container .attr-val-template" ).clone();
      $(newElement).removeClass('attr-val-template');
      input = $(newElement).find('input');
      $(input).attr('name','attribute-'+attribute);
      $(input).removeClass('hidden-item');
      $(newElement).find('label').text(attribute);
      $(container+" .attributesValues-container").append(newElement);
      $('#champs-selector').append('<option value="'+attribute+'">'+attribute+'</option>')
    }
    break;
    case 'remove':
    if(isAll)
    {
      $(container+" .attributesValues-container .value-attribute:not(.attr-val-template)").remove();
      $('#champs-selector').find('option').remove();
    }
    else
    {
      for(i=0;i<attributesArray.length;i++)
      {
        attribute = attributesArray[i];
        $(container+" .attributesValues-container").each(function(index){
          $(this).find('.value-attribute:not(.attr-val-template)').each(function(index){
            if($(this).find('input').attr('name') == 'attribute-'+attribute)
            {
              $(this).remove();
              $('#champs-selector option[value="'+attribute+'"]').remove();
              return false;
            }
          })
        })
      }
    }
    break;
  }
}
function flyTo(view,myExtent) {
  var duration = 2000;
  var resolution = view.getResolutionForExtent(myExtent);
  var zoom = view.getZoomForResolution(resolution);
  var center = ol.extent.getCenter(myExtent);
  view.animate({
    center: center,
    duration: duration
  });
  view.animate({
    zoom: view.getZoom()-1,
    duration: duration / 2
  }, {
    zoom: zoom,
    duration: duration / 2
  });
}
function geomToWKT(geom)
{
  var format = new ol.format.WKT();
  var wktRepresenation  = format.writeGeometry(geom);
  return wktRepresenation;
}
function checkValidateGeom(geom,srcProjection,mapProjection,geomType,validGeomType)
{
  if(geomType !=validGeomType) //if created feature dont correspond to selected geom
  {
    return {isValid:false,errorMsg : 'le type de geometrie ('+geomType+') ne correspond pas au type selectionné ('+validGeomType+')'}
  }
  else {
    try{
      wktForm = geomToWKT(geom);
      
      var reader = new jsts.io.WKTReader();
      var geomwkt = reader.read(wktForm);
    }
    catch(er)
    {
      return {isValid:false,errorMsg : 'topologie invalide!'}
    }
    if(srcProjection.projection != mapProjection) geom = geom.transform(srcProjection,mapProjection)     
  if(!geomwkt.isValid()) // if geometry not valid; JSTS LIBRARY
{
  return {isValid:false,errorMsg : 'topologie invalide!'}
}
else
{
  if(!ol.extent.containsExtent(mapProjection.getWorldExtent(), geom.getExtent()))
  {
    return {isValid:false,errorMsg : 'Geometry hors limites de la map! avez-vous choisi la bonne projection?'}
  }
  else
  {
    return {isValid:true,wktForm :wktForm,mapGeom:geom }
  }
}
}
}
$('.geom-info-tables tbody').on('click','tr',function(){
  $('.geom-info-tables tbody tr').removeClass('clicked');
  $(this).addClass('clicked');
  rowId = attributesAddTable.row(this).id();
  if(selectedFeatures.length>0)
  {
    for(i=0;i<selectedFeatures.length;i++)
    {
      selectedFeatures[i].setStyle(onAddStyle);
    }
    selectedFeatures=[];
  }
  feature = sourceOnAdd.getFeatureById(rowId);
  if(feature)
  {
    feature.setStyle(selectedStyle);
  selectedFeatures.push(feature);
  }
  
  /*extent = feature.getGeometry().getExtent();
  map.getView().fit(extent,{size:map.getSize(), maxZoom:14});*/
})
/**********************************************Print*******************************************************/
var createTextStyle = function (feature, resolution) {

  return new ol.style.Text({
    textAlign: 'start',
    textBaseline: 'top',
    font: '12px sans-serif',
    text: feature.get('text'),
    fill: new ol.style.Fill({color: "black"}),
    stroke: new ol.style.Stroke({color: "white", width: '1'}),
    offsetX: 0,
    offsetY: 0,
    placement: 'point',
    maxAngle: Math.PI / 4,
    overflow: false,
    rotation: feature.get('axis')==='x'?0:(Math.PI / 2),
  });
};
function lineStyleFunction(feature, resolution) {
  return new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'rgb(181, 181, 181)',
      width: 0.5
    }),
    //text: createTextStyle(feature, resolution),
  })
}
const AxisLayer = new ol.layer.Vector({ source: new ol.source.Vector(),style:lineStyleFunction });
map.addLayer(AxisLayer);
var gridData={};
function drawAxis(densiteX = 5,densiteY=5,projection='26191',removeAffter=false,scalingX = 1,scalingY=1)
{

  if(removeAffter==true)
  {
    src = AxisLayer.getSource();
    src.getFeatures().forEach(function(f) {
      f.set('hidden',true);
      f.setStyle(new ol.style.Style({}));
    });
    $('#map-mask').find('.virtual-label').addClass('hidden');
    toRemoveClass='mapBox clonedMapBox';
    origineX=0;
    origineY=0;
  }
  else
  {
    AxisLayer.getSource().clear();
    $('#map-mask').find('.map-grid-labels').remove();
    toRemoveClass='virtual-label';
    origineX = ($('#map-wrapper').outerWidth()-$('#map-wrapper').width())/2;
    origineY = ($('#map-wrapper').outerHeight()-$('#map-wrapper').height())/2;
  }
  pointsLabel = [];
  boxPosition = $('#print-zone').position();
  topLeftPointPx = [0,0];
  bottomRightPointPx = [map.getSize()[0],map.getSize()[1]];
  width = map.getSize()[0];
  height = map.getSize()[1];
  stepX =width/densiteX;
  stepY = height/densiteY;
  startX = stepX;
  startY = stepY;
  extent = map.getView().calculateExtent(map.getSize());
  roundX = 1;
  roundY = 1;
  ratioX = (extent[2]-extent[0])/densiteX;
  ratioY = (extent[3]-extent[1])/densiteY;
  src=availableProjections['4326'].value;
  dest = availableProjections[projection].value;
  if(ratioX>2) roundX=0;
  else if(ratioX<1)
  {
    var exponentialX = Number.parseFloat(ratioX).toExponential().split("e");
    roundX= Math.abs(exponentialX[1])+1;
  }
  if(ratioY>2) roundY=0;
  else if(ratioY<1)
  {
    var exponentialY = Number.parseFloat(ratioY).toExponential().split("e");
    roundY= Math.abs(exponentialY[1])+1;
  }
  
  topPoint = map.getCoordinateFromPixel([startX,0]);
  bottomPoint = map.getCoordinateFromPixel([startX,height]);
  topPoint = [round(topPoint[0],roundX),topPoint[1]];
  while(topPoint[0]<extent[2])
  {
    var axisX = new ol.geom.LineString([ topPoint,[topPoint[0],bottomPoint[1]]]);
    var featureX = new ol.Feature({ geometry: axisX, axis: 'x',text: topPoint[0].toString(),removeAffter:removeAffter});
    AxisLayer.getSource().addFeatures([featureX]);
    exactPixelTop = map.getPixelFromCoordinate(topPoint);
    
    var coord = src == dest?topPoint:ol.proj.transform(topPoint,src,dest);
    pointsLabel.push({top:origineY+exactPixelTop[1]/scalingY,left:exactPixelTop[0]/scalingX+origineX,text:Math.round(coord[0]).toString(),axis:'x',secondPoint:height/scalingY});
    topPoint = [round(topPoint[0]+ratioX,roundX),topPoint[1]];
    bottomPoint = [topPoint[0],bottomPoint[1]];
  }
  leftPoint = map.getCoordinateFromPixel([0,startY]);
  leftPoint = [leftPoint[0],round(leftPoint[1],roundY)];
  rightPoint = map.getCoordinateFromPixel([width,startY]);
  while (leftPoint[1]>extent[1])
  {
    var axisY  = new ol.geom.LineString([leftPoint,[rightPoint[0],leftPoint[1]]]);
    const featureY = new ol.Feature({ geometry: axisY, axis: 'y',text: leftPoint[1].toString(),removeAffter:removeAffter})
    AxisLayer.getSource().addFeatures([featureY]);
    exactPixelLeft = map.getPixelFromCoordinate(leftPoint);
    var coord = src == dest?leftPoint:ol.proj.transform(leftPoint,src,dest);
    pointsLabel.push({top:origineY+exactPixelLeft[1]/scalingY,left:exactPixelLeft[0]/scalingX+origineX,text:Math.round(coord[1]).toString(),axis:'y',secondPoint:width/scalingX});
    leftPoint = [leftPoint[0],round(leftPoint[1]-ratioY,roundY)];
    rightPoint = [rightPoint[0],leftPoint[1]];
  }
  if(removeAffter==true) return pointsLabel;
  else
  {

    pointsLabel.forEach(function(pointLabel){

      if(pointLabel.axis==='x')
      {
        html= $('<div class="map-grid-labels '+toRemoveClass+'" style="position:absolute;top:'+(pointLabel.top)+'px;left:'+(pointLabel.left)+'px;"><span>'+pointLabel.text+'</span></div>');
        $('#map-mask').append(html);
        offset = $(html).offset(); 
      $(html).offset({top:offset.top-$(html).height(),left:offset.left-$(html).width()/2})
      html = $('<div class="map-grid-labels  '+toRemoveClass+'" style="position:absolute;top:'+(pointLabel.top+pointLabel.secondPoint)+'px;left:'+(pointLabel.left)+'px;"><span>'+pointLabel.text+'</span></div>');
      $('#map-mask').append(html);
      offset = $(html).offset(); 
      $(html).offset({top:offset.top,left:offset.left-$(html).width()/2});
    }
    else
    {
      html= $('<div class="map-grid-labels rotate '+toRemoveClass+'" style="position:absolute;top:'+pointLabel.top+'px;left:'+(pointLabel.left)+'px;"><span>'+pointLabel.text+'</span></div>');
      $('#map-mask').append(html);
      offset = $(html).offset(); 
      $(html).offset({top:offset.top-($(html).height()/2),left:offset.left-($(html).width()/2)-$(html).height()/2})
      html = $('<div class="map-grid-labels rotate '+toRemoveClass+'" style="position:absolute;top:'+pointLabel.top+'px;left:'+(pointLabel.left+pointLabel.secondPoint)+'px;"><span>'+pointLabel.text+'</span></div>');
      $('#map-mask').append(html);
      offset = $(html).offset();
      $(html).offset({top:offset.top-($(html).height()/2),left:offset.left-($(html).width()/2)+$(html).height()/2})
    }
  })
  }
  
}

$('#toggle-show-grid').on('change',function(){
  if($(this).is(':checked'))
  {
    densiteX = $('#densite-grid-x').val();
    densiteY = $('#densite-grid-y').val();
    drawAxis(densiteX,densiteY,$('#print-coord-system').val(),false);
  }
  else
  {
    AxisLayer.getSource().clear();
    $('#map-mask').find('.map-grid-labels').remove();
  }
});
$('#refresh-grid').on('click',function(){
  if($('#toggle-show-grid').is(':checked'))
  {
    densiteX = $('#densite-grid-x').val();
    densiteY = $('#densite-grid-y').val();
    drawAxis(densiteX,densiteY,$('#print-coord-system').val(),false);
  }
})
$('#close-print-dialog').on('click',closePrintDialogs);
$('#print-add-text').on('click',function(){
  $('#map-mask').append('<div class="mapBox textBox" data-isDown="false"><button class="btn btn-sm btn-danger remove-mapBox"><i class="fas fa-times"></i></button><input readOnly="false" value="Votre text ici"></input><div> ');
})
$('#print-add-legend').on('click',function(){
  var idlegendBox= $('#map-mask').find('.legendBox').length+'_'+Date.now();
  $('#map-mask').append('<div class="mapBox legendBox" id="'+idlegendBox+'" data-isDown="false"><button class="btn btn-sm btn-danger remove-mapBox"><i class="fas fa-times"></i></button><button class="btn btn-sm btn-secondary config-legend"><i class="fas fa-cog"></i></button></div> ');
})
$('#print-coord-system').on('change',function(){
  if($('#toggle-show-grid').is(':checked'))
  {
    densiteX = $('#densite-grid-x').val();
    densiteY = $('#densite-grid-y').val();
    drawAxis(densiteX,densiteY,$(this).val(),false);
  }
  $('#map-mask').find('.crsText').find('label').text("CRS: "+availableProjections[$(this).val()].libelle+"(EPSG:"+$(this).val()+")");
})
$('#print-add-crs').on('click',function(){
  crs = availableProjections[$('#print-coord-system').val()];
  text = "CRS: "+crs.libelle+"(EPSG:"+$('#print-coord-system').val()+")";
  $('#map-mask').append('<div class="mapBox textBox crsText" data-isDown="false" style="bottom:5px;left:100px;"><button class="btn btn-sm btn-danger remove-mapBox"><i class="fas fa-times"></i></button><label style="font-size:12px;">'+text+'</label><div> ');
})
$('#map-mask').on('click','.remove-mapBox',function(){
  $(this).closest('.mapBox').remove();
})
$('#map-mask').on('click','.config-legend',function(){
  $('#couche-legend-selector').children().remove();
  $('#couche-legend-selected').children().remove();
  existingElements = $(this).closest('.mapBox').find('.legend-row').clone();
  $('#couche-legend-selected').append(existingElements);
  
  
  map.getLayers().forEach(function (layer) {
    var id = layer.get('id');
    if (id) {
      row = affairesTable.row('#'+id);
      dta = row.data();
      var html;
      switch(dta[1])
      {
        case 'Polygon':
        var fill = layer.getStyle().getFill().getColor();
        var borderColor = layer.getStyle().getStroke().getColor();
        var borderWidth = layer.getStyle().getStroke().getWidth();
        html = $('#couche-legend-selector').append('<option value="'+id+'" data-fillColor="'+fill+'" data-strokeColor="'+borderColor+'" data-strokeWidth="'+borderWidth+'" data-geomType="Polygon">'+dta[2]+'</option>');
        break;
        case 'LineString':
        var borderColor = layer.getStyle().getStroke().getColor();
        var borderWidth = layer.getStyle().getStroke().getWidth();
        html = $('#couche-legend-selector').append('<option value="'+id+'" data-strokeColor="'+borderColor+'" data-strokeWidth="'+borderWidth+'" data-geomType="LineString">'+dta[2]+'</option>');
        break;
        case 'Point':
        fill = layer.getStyle().getImage().getFill().getColor();
        var borderColor = layer.getStyle().getImage().getStroke().getColor();
        var borderWidth = layer.getStyle().getImage().getStroke().getWidth();
        html = $('#couche-legend-selector').append('<option value="'+id+'" data-fillColor="'+fill+'" data-strokeColor="'+borderColor+'" data-strokeWidth="'+borderWidth+'" data-geomType="Point">'+dta[2]+'</option>');
        break;
      }
      if(html) 
      {
        $('#couche-legend-selector').append(html);
      }
    }            
  });
  $('#legend-config-modal').attr('data-legendId',$(this).closest('.legendBox').attr('id'));
  $('#legend-config-modal').modal('show');
})
$('#add-layer-ToLegend').on('click',function(){
  val = $('#couche-legend-selector').val();
  if(val!='')
  {
    optionTag = $('#couche-legend-selector option[value="'+val+'"]');
    geomType = $(optionTag).attr('data-geomType');
    var html;
    switch(geomType)
    {
      case 'Polygon':
      html = '<div class="col-8"><div class="legend-symbol " style="background-color:'+$(optionTag).attr('data-fillColor')+';border: '+$(optionTag).attr('data-strokeWidth')+'px solid '+$(optionTag).attr('data-strokeColor')+' "></div><input readOnly="true" value="'+$(optionTag).text()+'"></input></div>';
      break;
      case 'LineString':
      html = '<div class="col-8"><div class="legend-symbol LineString"><div style="position:absolute;top:'+(12.5 - $(optionTag).attr('data-strokeWidth'))+'px;left:0;width:100%;background-color:'+$(optionTag).attr('data-strokeColor')+';border: none;height:'+$(optionTag).attr('data-strokeWidth')+'px"></div></div><input readOnly="true" value="'+$(optionTag).text()+'"></input></div>';
      break;
      case 'Point':
      html = '<div class="col-8"><div class="legend-symbol Point" style="background-color:'+$(optionTag).attr('data-fillColor')+';border: '+$(optionTag).attr('data-strokeWidth')+'px solid '+$(optionTag).attr('data-strokeColor')+' "></div><input readOnly="true" value="'+$(optionTag).text()+'"></input></div>';
      break;
    }
    if(html)
    {

      $('#couche-legend-selected').append('<div class="row legend-row">'+html+'<button class="btn col-1 ml-auto btn-sm btn-outline-danger btn-removeFromLegend" ><i class="fas fa-times"></i></button></div>'); 
    }
  }
})
$('#legend-config-modal').on('click','.btn-removeFromLegend',function(){
  $(this).closest('.legend-row').remove();
})
$('#apply-legend').on('click',function(){
  targetBox = $('#map-mask').find('#'+$('#legend-config-modal').attr('data-legendId'));
  $legendRows = $('#couche-legend-selected').children().clone();
  $(targetBox).find('.legend-row').remove();
  $(targetBox).append($legendRows);
  $('#legend-config-modal').modal('hide');
})
function handleDragBoxStart(e) {
  this.style.opacity = '0.4';

}
function handleDragEnd(e) {
  this.style.opacity = '1';
}
var divOverlay = document.getElementById ("overlay");
var deltaX ;
var deltaY;
$('#map-mask').on('mousedown','.mapBox',function(e) {
  e.stopPropagation();
  initialPosition = $(this).offset();
  width = $(this).width();
  height = $(this).height();
  if(event.pageX<(initialPosition.left+width-10) && event.pageY<(initialPosition.top+height-10))
  {
    deltaX = event.pageX-initialPosition.left;
    deltaY = event.pageY-initialPosition.top;
    $(this).attr('data-isDown',"true");
    $(this).find('input').attr('readOnly',true);
  }
});
$('#map-mask').on('mouseup','.mapBox',function(e) {
  e.stopPropagation();
  $(this).attr('data-isDown',"false");
  $(this).find('input').attr('readOnly',false);
});
$('#map-mask').on('mouseleave','.mapBox',function(e) {
  e.stopPropagation();
  $(this).attr('data-isDown',"false");
  $(this).find('input').attr('readOnly',false);
});
$('#map-mask').on('mousemove','.mapBox',function(e){
  e.stopPropagation();
  e.preventDefault();
  if ($(this).attr('data-isDown')=="true") {
    $(this).offset({top:event.pageY-deltaY,left:event.pageX-deltaX});
  }
});
var dims = {
  a0: [1189, 841],
  a1: [841, 594],
  a2: [594, 420],
  a3: [420, 297],
  a4: [297, 210],
  a5: [210, 148]
};
var loading = 0;
var loaded = 0;
var exportButton = document.getElementById('print-map');
exportButton.addEventListener(
  'click',
  function () {
    exportButton.disabled = true;
    $('#print-progression').removeClass('hidden');
    tileLoadSide = false;
    document.body.style.cursor = 'progress';
    var source = baseMap.getSource();
    var resolution = $('#page-resolution').val();
    var margin = 15;
    var dim = dims[$('#page-format').val()];
    var width = Math.round(((dim[0]-(2*margin)) * resolution) / 25.4);
    var height = Math.round(((dim[1]-(2*margin)) * resolution) / 25.4);
    var printSize = [width,height];
    var initialMapSize = map.getSize();
    var scaling = Math.min(width / initialMapSize[0], height / initialMapSize[1]);
    var viewResolution = map.getView().getResolution();
    var paperConfig = {
      format : $('#page-format').val(),
      margin : 15,
      dimensions:dim,
      resolution:resolution
    }
    var tileLoadStart = function() {
      ++loading;
    };
    var tileLoadEnd = function() {
     tileLoadSide = true;
     ++loaded;
     if (loading === loaded) {
      var canvas = this;
      setTimeout(function(){
        loading = 0;
        loaded = 0;
        prepareMap(canvas,'#map-mask',paperConfig,printSize,pointsLabel).then(function(pdf){
          pdf.save('map.pdf');
          $('#map-mask').find('.virtual-label').removeClass('hidden');
          src = AxisLayer.getSource();
          src.getFeatures().forEach(function(f) {

            if(f.get('removeAffter')) 
            {

              src.removeFeature(f);
            }
            else if(f.get('hidden'))
            {

              f.setStyle(lineStyleFunction);
              f.unset('hidden');
            }
          });
          $('#print-progression').addClass('hidden');

          source.un('tileloadstart', tileLoadStart);
          source.un('tileloadend', tileLoadEnd, canvas);
          source.un('tileloaderror', tileLoadEnd, canvas);
            // Reset original map size
            map.setSize(initialMapSize);
            map.getView().setResolution(viewResolution);
            exportButton.disabled = false;
            document.body.style.cursor = 'auto';
          });
      },500);
    }
  };
  map.once('postcompose', function(event) {
    pointsLabel=[];
    if($('#toggle-show-grid').is(':checked'))
    {
      densiteX = $('#densite-grid-x').val();
      densiteY = $('#densite-grid-y').val();
      
      pointsLabel = drawAxis(densiteX,densiteY,$('#print-coord-system').val(),true,width / initialMapSize[0],height / initialMapSize[1]);

    }
    source.on('tileloadstart', tileLoadStart);
    source.on('tileloadend', tileLoadEnd, event.context.canvas);
    source.on('tileloaderror', tileLoadEnd, event.context.canvas);
    setTimeout(function(){
      if(tileLoadSide===false)
      {
        source.un('tileloadstart', tileLoadStart);
        source.un('tileloadend', tileLoadEnd, event.context.canvas);
        source.un('tileloaderror', tileLoadEnd, event.context.canvas);
        prepareMap(event.context.canvas,'#map-mask',paperConfig,printSize,pointsLabel).then(function(pdf){
          pdf.save('map.pdf');
          $('#print-progression').addClass('hidden');
          $('#map-mask').find('.virtual-label').removeClass('hidden');
          src = AxisLayer.getSource();

          src.getFeatures().forEach(function(f) {

            if(f.get('removeAffter')) 
            {

              src.removeFeature(f);
            }
            else if(f.get('hidden'))
            {

              f.setStyle();
              f.unset('hidden');
            }
          });
          map.setSize(initialMapSize);
          map.getView().setResolution(viewResolution);
          exportButton.disabled = false;
          document.body.style.cursor = 'auto';
        });
      }
    },1000)
  });
  map.setSize(printSize);
  
  map.getView().setResolution(viewResolution / scaling);
},
false
);
function prepareMap(canvas,maskId,paperConfig,printSize,pointsLabel){
  var format = paperConfig.format;
  var margin= paperConfig.margin ;
  var dim = paperConfig.dimensions;
  var resolution = paperConfig.resolution;
  var printMap = new Promise((resolve,reject)=>{
    var pdf = new jsPDF('landscape', "mm",format);
    var data = canvas.toDataURL('image/png');
    pdf.addImage(data, 'JPEG', margin, margin,dim[0]-2*margin,dim[1]-2*margin);
    var widthMaskmm = $(maskId).outerWidth();
    var heightMaskmm = $(maskId).outerHeight();
    mmResolution = resolution/25.4;
    widthP = dim[0]*mmResolution;
    heightP= dim[1]*mmResolution;
    ratioW = dim[0]/widthMaskmm;
    ratioH = dim[1]/heightMaskmm;

    pointsLabel.forEach(function(label){

      origineX=margin;
      origineY=margin;
      xmm = label.left*ratioW+origineX;
      ymm = label.top*ratioH+origineY;
      pdf.setTextColor(150,150,150);
      pdf.setFontSize(8);

      if (label.axis==='x') 
      {
        pdf.setFillColor(255,255,200);
        //pdf.rect(xmm,margin-2, 10, 10, 'S');
        pdf.text(xmm,margin-2,label.text,null,0);

        pdf.text(xmm,dim[1]-margin+2,label.text,null,0);
      }
      else {
        pdf.text(margin-2,ymm,label.text,null,90);
        pdf.text(dim[0]-margin+2,ymm,label.text,null,90);
      }


    })
    mapBox = $(maskId).find('.mapBox');
    var CountMapBox = mapBox.length;
    if(CountMapBox==0) 
    {
      setTimeout(function(){
        resolve(pdf);
      },100);
    }
    else
    {

      mapBoxsCanevas = [];
      $(mapBox).each(function(index){
        pixelPosition = $(this).position();
        xmm = pixelPosition.left*ratioW;
        ymm = pixelPosition.top*ratioH;
        var  wmm = $(this).outerWidth()*ratioW;
        var hmm = $(this).outerHeight()*ratioH;
        element = this.cloneNode(true);
        $(element).addClass('clonedMapBox');
        $(maskId).append(element);
        
        mapBoxsCanevas.push({
          canvas:html2canvas(element),
          x:xmm+0.1,
          y:ymm+0.1,
          width:wmm,
          height:hmm
        });

      })
      
      var compteur =0;
      mapBoxsCanevas.forEach(function(obj){
        obj.canvas.then(canvasLegend => {
          var dataLegend = canvasLegend.toDataURL('image/png',1);

          pdf.addImage(dataLegend, 'png',obj.x,obj.y,obj.width,obj.height);
          compteur++;
          if (compteur == mapBoxsCanevas.length) setTimeout(function(){
            resolve(pdf);
            $(maskId).find('.clonedMapBox').remove();
          },100);
        });
      })

    }
  });

  return printMap;
}