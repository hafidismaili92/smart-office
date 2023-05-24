document.addEventListener('DOMContentLoaded', function() {

  jQuery.extend(jQuery.validator.messages, {
    required: 'Champs obligatoire',
    max: 'invalide',
    min:'invalide'
  });
  
},false);

function customConfirmedialog(message, dta = null, yesCallback, noCallback) {
  $("#dialog-msg").html(message);
  $("#modal-dialog").modal("show");
  $("#confirm-dialog-btn").off("click");
  $("#confirm-dialog-btn").click(function () {
    $("#modal-dialog").modal("hide");
    yesCallback(dta);
  });
  $("#close-dialog-btn").off("click");
  $("#close-dialog-btn").click(function () {
    $("#modal-dialog").modal("hide");
    noCallback(dta);
  });
}
/****************************************CUSTOM : DATATABLE TO JSON*****************************************/

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
/****************************************CUSTOM : validate prix before add to datatable*****************************************/
function validatePriceInputs(containerID)
{
  var validdata = true;
  var msgdata ="";
  var totalPrix=1;
  dta=[];
  $(containerID).find('.prix-field').not('#prix-xls-file').each(function(){
    var arr = [ "prix-prix", "quantite-prix","prix-prix-devis", "quantite-prix-devis"];   
    if($(this).val()==''){
      validdata =false;
      msgdata ="champs vides détectés";

    }
    else if ((jQuery.inArray($(this).attr('id'),arr)>-1 || jQuery.inArray('edit-'+$(this).attr('id'),arr)>-1) && (isNaN($(this).val()) || $(this).val()<=0) )
    {

      validdata =false;
      msgdata ="valeurs invalides ou null détectées";
    }
    else
    {
      switch($(this).attr('id'))
      {

        case 'numero-prix':
        case 'numero-prix-devis':
        dta.push('<input type ="text" class="tbl-numero-prix" value ="'+$(this).val()+'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">');
        break;
        case 'libelle-prix':
        case 'libelle-prix-devis':
        dta.push('<input type ="text" class="tbl-libelle-prix" value ="'+$(this).val()+'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">');
        break;
        case 'unite-prix':
        case 'unite-prix-devis':
        dta.push('<input type ="text" class="tbl-unite-prix" value ="'+$(this).val()+'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">');
        break;
        case 'prix-prix':
        case 'prix-prix-devis':
        dta.push('<input type ="number" step="0.01" class="tbl-pu-prix" value ="'+$(this).val()+'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">')
        totalPrix=totalPrix*$(this).val();
        break;
        case 'quantite-prix':
        case 'quantite-prix-devis':
        dta.push('<input type ="number" step="0.01" class="tbl-quantite-prix" value ="'+$(this).val()+'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">');
        totalPrix=totalPrix*$(this).val();
        break;

      }

    }

  });
  dta.push('<input type ="number" class="tbl-total-prix" value ="'+totalPrix+'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;" readonly>');
  dta.push('<button type="button" class="btn btn-outline-danger btn-xs remove-prix" style="padding:0;border:none;"><i class="fa  fa-trash"></i></button>');

  return {"valid":validdata,"msg":msgdata,"data":dta};

}
function numberWithSpaces(x) {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  return parts.join(".");
}
/*****************************************COLVIS plugin**************************************************/
(function(g){"function"===typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(d){return g(d,window,document)}):"object"===typeof exports?module.exports=function(d,f){d||(d=window);if(!f||!f.fn.dataTable)f=require("datatables.net")(d,f).$;f.fn.dataTable.Buttons||require("datatables.net-buttons")(d,f);return g(f,d,d.document)}:g(jQuery,window,document)})(function(g,d,f,h){d=g.fn.dataTable;g.extend(d.ext.buttons,{colvis:function(a,b){return{extend:"collection",
  text:function(b){return b.i18n("buttons.colvis","Column visibility")},className:"buttons-colvis",buttons:[{extend:"columnsToggle",columns:b.columns,columnText:b.columnText}]}},columnsToggle:function(a,b){return a.columns(b.columns).indexes().map(function(a){return{extend:"columnToggle",columns:a,columnText:b.columnText}}).toArray()},columnToggle:function(a,b){return{extend:"columnVisibility",columns:b.columns,columnText:b.columnText}},columnsVisibility:function(a,b){return a.columns(b.columns).indexes().map(function(a){return{extend:"columnVisibility",
    columns:a,visibility:b.visibility,columnText:b.columnText}}).toArray()},columnVisibility:{columns:h,text:function(a,b,c){return c._columnText(a,c)},className:"buttons-columnVisibility",action:function(a,b,c,e){a=b.columns(e.columns);b=a.visible();a.visible(e.visibility!==h?e.visibility:!(b.length&&b[0]))},init:function(a,b,c){var e=this;a.on("column-visibility.dt"+c.namespace,function(b,d){!d.bDestroying&&d.nTable==a.settings()[0].nTable&&e.active(a.column(c.columns).visible())}).on("column-reorder.dt"+
    c.namespace,function(){1===a.columns(c.columns).count()&&(e.text(c._columnText(a,c)),e.active(a.column(c.columns).visible()))});this.active(a.column(c.columns).visible())},destroy:function(a,b,c){a.off("column-visibility.dt"+c.namespace).off("column-reorder.dt"+c.namespace)},_columnText:function(a,b){var c=a.column(b.columns).index(),e=a.settings()[0].aoColumns[c].sTitle.replace(/\n/g," ").replace(/<br\s*\/?>/gi," ").replace(/<select(.*?)<\/select>/g,"").replace(/<!\-\-.*?\-\->/g,"").replace(/<.*?>/g,
    "").replace(/^\s+|\s+$/g,"");return b.columnText?b.columnText(a,c,e):e}},colvisRestore:{className:"buttons-colvisRestore",text:function(a){return a.i18n("buttons.colvisRestore","Restore visibility")},init:function(a,b,c){c._visOriginal=a.columns().indexes().map(function(b){return a.column(b).visible()}).toArray()},action:function(a,b,c,d){b.columns().every(function(a){a=b.colReorder&&b.colReorder.transpose?b.colReorder.transpose(a,"toOriginal"):a;this.visible(d._visOriginal[a])})}},colvisGroup:{className:"buttons-colvisGroup",
    action:function(a,b,c,d){b.columns(d.show).visible(!0,!1);b.columns(d.hide).visible(!1,!1);b.columns.adjust()},show:[],hide:[]}});return d.Buttons});
/*******************************************JUMP TO PAGE PLUGIN*******************************************/
jQuery.fn.dataTable.Api.register( 'page.jumpToData()', function ( data, column ) {
  var pos = this.column(column, {order:'current'}).data().indexOf( data );

  if ( pos >= 0 ) {
    var page = Math.floor( pos / this.page.info().length );
    this.page( page ).draw( false );
  }

  return this;
} );
/********************************************SORT PLUGIN FORMATTED NUMBER**************************/
jQuery.extend( jQuery.fn.dataTableExt.oSort, {
  "formatted-num-pre": function ( a ) {
    a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
    return parseFloat( a );
  },

  "formatted-num-asc": function ( a, b ) {
    return a - b;
  },

  "formatted-num-desc": function ( a, b ) {
    return b - a;
  }
} );
/*******************************************MOMENT PLUGIN***********************************************/
(function (factory) {
  if (typeof define === "function" && define.amd) {
    define(["jquery", "moment", "datatables.net"], factory);
  } else {
    factory(jQuery, moment);
  }
}(function ($, moment) {

  $.fn.dataTable.moment = function ( format, locale, reverseEmpties ) {
    var types = $.fn.dataTable.ext.type;

    // Add type detection
    types.detect.unshift( function ( d ) {
      if ( d ) {
            // Strip HTML tags and newline characters if possible
            if ( d.replace ) {
              d = d.replace(/(<.*?>)|(\r?\n|\r)/g, '');
            }
            
            // Strip out surrounding white space
            d = $.trim( d );
          }

        // Null and empty values are acceptable
        if ( d === '' || d === null ) {
          return 'moment-'+format;
        }
        
        return moment( d, format, locale, true ).isValid() ?
        'moment-'+format :
        null;
      } );
    
    // Add sorting method - use an integer for the sorting
    types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
      if ( d ) {
            // Strip HTML tags and newline characters if possible
            if ( d.replace ) {
              d = d.replace(/(<.*?>)|(\r?\n|\r)/g, '');
            }
            
            // Strip out surrounding white space
            d = $.trim( d );
          }

          return !moment(d, format, locale, true).isValid() ?
          (reverseEmpties ? -Infinity : Infinity) :
          parseInt( moment( d, format, locale, true ).format( 'x' ), 10 );
        };
      };

    }));

$.fn.dataTable.moment( 'DD-MM-YYYY' );

/****************************************MAP PART***************************************************/

if(typeof ol !=='undefined')
{
  var mapcontrat;
var sourcecontrat;
var contratVectorLayer;
var mapView = new ol.View({
  center: [-722179.28, 4067538.48],
  zoom: 8
});
function initcontratMap(){

  sourcecontrat = new ol.source.Vector();
  var iconBase4 = "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";
  var osmLayer = new ol.layer.Tile({source: new ol.source.OSM()});
  contratVectorLayer = new ol.layer.Vector({
    source: sourcecontrat,
    style: new ol.style.Style({
      image: new ol.style.Icon({
        anchor: [12, 35],
        anchorXUnits: 'pixels',
        anchorYUnits: 'pixels',
        src: 'data:image/icon.png;base64,'+iconBase4
      })
    })
  });
  mapcontrat = new ol.Map({
    controls: ol.control.defaults({
      attributionOptions:({
        collapsible: false
      })
    }),
    layers: [osmLayer,contratVectorLayer],
    target: 'contrat-detail-map',
    view: mapView
  });
  window.setTimeout(function () { 
    mapcontrat.updateSize();
  }, 200);

}

$(document).ready(function() {

  initcontratMap();
  
});
}

function showInfoBox(type,msg,delai=3000,decalage="3vh")
{
  if($.inArray(type,['warning','error','success','info'])>=0)
  {
    var itag ="fa  fa fa-exclamation-triangle";
    var className="error";
    switch(type)
    {
      case 'success':
      itag="fa fa-check";
      className="success";
      break;
      case 'warning':
      className="warning";
    }
    html = '<div class="custom-info-box '+className+'" style="bottom: '+decalage+';"><i class="'+itag+' fa-lg"></i><div>'+msg+'</div></div>';
    $('body').prepend(html);
    $('body .custom-info-box').delay(delai).hide(10, function() {
      $(this).remove();
    });
  }
}


