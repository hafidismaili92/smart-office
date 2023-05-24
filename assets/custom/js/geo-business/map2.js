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

/***********************************************control selectedFeatures Style**********************************************/
selectedFeatures = [];
/*******************************************editingState******************************************/
var drawMode = {
  none : 0,
  addAffaireMode:{projection:availableProjections['4326'].value,geomType:'Point'},
}
var editingState = {
state : "none",
projection : null,
geomType : null,
};

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

var testgeoserver = new ol.source.TileWMS({
url:'http://127.0.0.1:8080/geoserver/geobusiness/wms?service=WMS&version=1.1.0&request=GetMap&layers=geobusiness%3Attms&bbox=-2.0037508342789244E7%2C-1.9971868880408555E7%2C2.0037508342789244E7%2C1.9971868880408563E7&width=768&height=765&srs=EPSG%3A3857&styles=&format=application/openlayers',
serverType:'geoserver'
});
var featureLayer = new ol.layer.Tile({
source : testgeoserver,
})
/*var tomtomBaseMap = new ol.layer.Tile({
            source: new ol.source.XYZ({
              url: 'http://api.tomtom.com/map/1/tile/basic/main/{z}/{x}/{y}.png?tileSize=512&view=MA&key=zJGTjkv8uPoyCdES0F0xxXH30YP0mC11',
            })
          })*/
//EditGeoBusiness/
var tomtomBaseMap = new ol.layer.Tile({
            source: new ol.source.XYZ({
              url: BaseUrl+'Bmap/{z}/{x}/{y}',
            })
          })
/****************************************Add MAP**********************************************************************/
window.app = {};
var app = window.app;
var map = new ol.Map({
  controls: [new ol.control.Zoom({
    className: 'custom-zoom marginOnSidebare'
})],
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
/*************************************************CUSTOM CONTROLS FOR PRINT SEARCH..............***************************************/
app.mapTools = function(opt_options)
{
  mapToolsContainer = document.createElement('div');
  var options = opt_options || {};
  mapToolsContainer.className = 'ol-mapTool-container ol-control marginOnRightSideBare';
  var this_ = this;
  elementsArray = [
  {icon:'fa fa-plus',text:'Nouvelle Couche',id:'ajouter-couche',action:showRhiteSDB,params:"add-layer-section"},
  {icon:'fa fa-print',text:'imprimer',id:'imprimer-carte',action:showPrintDialogs,params:null},
  {icon:'fa fa-search',text:'Chercher Lieu',id:'chercher-lieu'},
  {icon:'fa fa-map-marker-alt',text:'Go To x,y',id:'chercher-coord'},
  {icon:'fa fa-search-plus',text:'zoome fenêtre',id:'map-zoom'},
  {icon:'fa fa-ruler',text:'Mesurer une distance',id:'mesure-distance'},
  {icon:'fa fa-draw-polygon',text:'Mesurer une superficie',id:'mesure-surface'},
  ]
  $.each(elementsArray,function(i,val){
    
      var toolElement  = $('<div><button class="btn bg-transparent" data-toggle="tooltip" data-placement="left" title="'+val.text+'" id="'+val.id+'"><i class="'+val.icon+' fa-lg"></i></button></div>');   
   
    $(toolElement).on('click','button',function(){
      val.action(val.params);
      
    });             

    $(mapToolsContainer).append(toolElement);
  })
  ol.control.Control.call(this, {
    element: mapToolsContainer,
    target: options.target,
  });
}

ol.inherits(app.mapTools, ol.control.Control);

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
      //popups
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
      
/************************************START ADD GEOMS*********************************/


$('#add-geoComposantes').on('click',function(){
  
         startAddGeometries();
       })
function startAddGeometries()
       {
         
         geomType = $('#geom-selector div.active').attr('data-geomType');
         
         editingState.state = "ADDAFFAIRE";
         editingState.projection=availableProjections[$('#projection-selector').val()].value;
         editingState.geomType = geomType;
         addInteractions(sourceOnAdd,geomType);
       }
/**************************************PASS TO PRINT MODE****************************************/
function updatePrintZone()
{
  if($('#main-page-wrapper').hasClass('print-mode'))
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
  if($('.right-sidebar').hasClass('shown')) $('.right-sidebar').removeClass('shown');
  if($(document).find('.marginOnRightSideBare').hasClass('sideBarActif')) $(document).find('.marginOnRightSideBare').removeClass('sideBarActif');
  //hide header 
  $('#heading').addClass('hidden');
  //hide left sidebare
  
  if(!$('#sidebar').hasClass('hidden')) $('#sidebar').addClass('hidden');
  if($(document).find('.marginOnSidebare').hasClass('sideBarActif')) $(document).find('.marginOnSidebare').removeClass('sideBarActif');
  if($('#print-dialog').hasClass('hidden')) $('#print-dialog').removeClass('hidden');
  $('#main-page-wrapper').addClass('print-mode');
  $(Popupelement).popover('dispose');
  $('#map-mask').removeClass('hidden');
  $('#map-wrapper').find('.ol-control').addClass('hidden');
  updatePrintZone();
}
function closePrintDialogs()
{

  $('#print-dialog').addClass('hidden');
  $('#main-page-wrapper').removeClass('print-mode');
 
  AxisLayer.getSource().clear();
  map.updateSize();
  $('#map-mask').addClass('hidden');
  $('#map-wrapper').find('.ol-control').removeClass('hidden');
  $('#map-wrapper').height('100%');
  $('#heading').removeClass('hidden');
  if(parseFloat($('#sidebar').css('width'))==400 && $('#sidebar').hasClass('hidden'))
  {
    $('#sidebar').removeClass('hidden');
    $(document).find('.marginOnSidebare').addClass('sideBarActif');
  }
}
/**********************************************Print LOGIQUE*******************************************************/
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
    var source = tomtomBaseMap.getSource();
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

/******************************************GESTION EVENTS ON DRAW END, START,.....**********/
const onAddhtmlActions = '<div class="customtooltip onAdd-actions"><i class="fa  fa-trash  remove-feature "></i><span class="tooltiptext">Supprimer</span></div><div class="customtooltip onAdd-actions"><i class="fa  fa-user feature-showBorne"></i><span class="tooltiptext">Afficher les bornes</span></div>';
vectorOnAdd.getSource().on('addfeature', function(event){
       feature = event.feature;
       if(!feature.get('dataSource')) feature.set('dataSource','draw');
       featureProprieties = feature.getProperties();
       switch(editingState.state)
       {
        case "ADDAFFAIRE":
        
        compostantesTAble = '#add-geoComposantes-tables table tbody';
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
          else{
            attributes = [idFeature,onAddhtmlActions];
            attributesAddTable.row.add(attributes).draw(false);
          };
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
  
  $("#perform-add-composanteForm").submit(function(event){
  event.preventDefault(); //prevent default action 
  attributes = [$(this).find('.hidden-featureID').val()];
  $(this).find('input:not(.hidden-item)').each(function(){
    attributes.push($(this).val());
  })
  attributes.push(onAddhtmlActions);
  attributesAddTable.row.add(attributes).draw(false);
  if(($("#attributes-modal").data('bs.modal') || {})._isShown )  $("#attributes-modal").modal('hide');
});

  function geomToWKT(geom)
{
  var format = new ol.format.WKT();
  var wktRepresenation  = format.writeGeometry(geom);
  return wktRepresenation;
}
