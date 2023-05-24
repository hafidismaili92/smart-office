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
    center: [-6,30],
    zoom: 10,
  })
});
setTimeout( function() { map.updateSize();}, 200);
window.onresize = function()
{
  setTimeout( function() { map.updateSize();}, 200);
}

/********************************************set custom controls*************************************************/
window.app = {};
var app = window.app;
/*app.drawControl = function(opt_options) {
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
};*/
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
       /******************************************************************************************/

app.mapTools = function(opt_options)
{
  mapToolsContainer = document.createElement('div');
  var options = opt_options || {};
  mapToolsContainer.className = 'ol-mapTool-container ol-control';
  var this_ = this;
  elementsArray = [
  {icon:'fas fa-print',text:'imprimer',id:'imprimer-carte',/*action:showPrintDialogs*/},
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
//ol.inherits(app.drawControl, ol.control.Control);
ol.inherits(app.mapTools, ol.control.Control);
//map.addControl(new app.drawControl());
map.addControl(new app.mapTools());


/**********************************ADDING DRAWS*******************************/
$('#add-geoComposantes').on('click',function(){
  
         startAddGeometries();
       })
function startAddGeometries()
       {
         
         geomType = $('#geom-selector div.active').attr('data-geomType');
         
         editingState.projection=availableProjections[$('#projection-selector').val()].value;
         editingState.geomType = geomType;
         addInteractions(sourceOnAdd,geomType);
       }