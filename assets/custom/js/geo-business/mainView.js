/**********************************************DATATABLE LANGUAGE OPTIONS********************************/
var datatableLangage = {
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
};
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
/******************************************LIMIT TEXT LENGHT PLUGIN***************************************************/
$.fn.dataTable.render.ellipsis = function (length) {
  
    return function ( data, type, row ) {
    return type === 'display' && data!=null && data.length > length ?
    data.substr( 0, length ) +'…' :
    data;
  }
  
  
};
/********************************************************************************************************************/
document.addEventListener('DOMContentLoaded', function() {
 $("body").tooltip({ selector: '[data-toggle=tooltip]' });
 
  $.fn.dataTable.ext.errMode = 'none';//disable DATATABLES ERRORS
  $.getScript(BaseUrl+"assets/custom/js/geo-business/map2.js");
  $.getScript(BaseUrl+"assets/custom/js/geo-business/GeoAffaires.js");
  //$.getScript(BaseUrl+"assets/custom/js/geo-business/Geocomposantes.js");
  $('.draggable').on(
  'dragover',
  function(e) {
    e.preventDefault();
    e.stopPropagation();
  }
  )
$('.draggable').on(
  'dragenter',
  function(e) {
    html = '<div class="on-drag-view" ><div style="text-align: center;"><i class="fas fa-file-import fa-3x"></i><h5>déposez ici!</h5></div></div>';
    e.preventDefault();
    e.stopPropagation();
    if(containsFiles(e)) {
      $(event.target).append(html);
    }
  }
  )
$('.draggable').on(
  'dragleave',
  function(e) {
    e.preventDefault();
    e.stopPropagation();
    if($(event.target).find('.on-drag-view').length>0) $(event.target).find('.on-drag-view').remove();
  }
  )
$('.draggable').on(
  'drop',
  function(e){
    if(e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
      e.preventDefault();
      e.stopPropagation();
      if($(e.target).find('.on-drag-view').length>0) $(e.target).find('.on-drag-view').remove();
      var fd = new FormData();
      fd.append('file', e.originalEvent.dataTransfer.files[0]);
      var url ;
      if($(this).hasClass('drag-add-composante') ) parseComposante(fd);
      else if($(this).hasClass('drag-add-affaire'))
      {
        
        customConfirmedialog('vos donnees seront écrasées, voulez vous continuer?',fd,parseAffaire,function(){});
      }
    }
  }
  );
$( window ).resize(function() {
  affairesTable.columns.adjust().draw();
  attachementsTable.columns.adjust().draw();
});
},false);
function checkNameValidity(value,maxLength,minLength,regex=false,notIn = [])
{
  if(!value || value.length<=minLength)
  {
    return {valid:false,errorMsg :'champs vide ou invalide' };
  }
  else if(champs.length>maxLength)
  {
    return {valid:false,errorMsg :'Champs trop long' };
  }
  else if(regex != false)
  {
    return;
  }
  else if($.inArray(value,notIn)>=0)
  {
    return {valid:false,errorMsg :'Nom de champs déja utilisé, choisissez un autre' };
  }
  else
  {
    return {valid:true};
  }
}
function containsFiles(event) {
  if (event.originalEvent.dataTransfer.types) {
    for (var i = 0; i <event.originalEvent.dataTransfer.types.length; i++) {
      if (event.originalEvent.dataTransfer.types[i] == "Files") {
        return true;
      }
    }
  }
  return false;
}

$( document ).ajaxStart(function() {
 $('#loader-container').removeClass('hidden');
});
$( document ).ajaxComplete(function( event, xhr, settings ) {
  $('#loader-container').addClass('hidden');
});
function customConfirmedialog(message,dta=null, yesCallback, noCallback) {
  $('#dialog-msg').html(message);
  $('#modal-dialog').modal('show');
  $('#confirm-dialog-btn').off("click");
  $('#confirm-dialog-btn').click(function() {
    $('#modal-dialog').modal('hide')
    yesCallback(dta);
  });
  $('#close-dialog-btn').off('click');
  $('#close-dialog-btn').click(function() {
    $('#modal-dialog').modal('hide')
    noCallback(dta);
  });
}
$('.search-in-table').keyup(function(){
  table = $('#'+$(this).attr('data-targetTable')).DataTable();
  table.search($(this).val()).draw() ;
});

function showInfoBox(type,msg,delai=3000,decalage="3vh")
{
  if($.inArray(type,['warning','error','success','info'])>=0)
  {
    var itag ="fas fa-exclamation-triangle";
    var className="error";
    switch(type)
    {
      case 'success':
      itag="far fa-check-circle";
      className="success";
      break;
      case 'warning':
      className="warning";
    }
    html = '<div class="custom-info-box '+className+'" style="top: '+decalage+';"><i class="'+itag+' fa-lg"></i><div>'+msg+'</div></div>';
    $('body').prepend(html);
    $('body .custom-info-box').delay(delai).hide(10, function() {
      $(this).remove();
    });
  }
}
function hexColortoRGB(color) {
  const r = parseInt(color.substr(1,2), 16)
  const g = parseInt(color.substr(3,2), 16)
  const b = parseInt(color.substr(5,2), 16)
  return 'rgb('+r+','+g+','+b+')';
}
/****************************************GENERAL SPATIAL FONCTIONS*************************************************************/
function getLayerById(map,id)
{
  var layer;
  map.getLayers().forEach(function (lyr) {
    if (id == lyr.get('id')) {
      layer = lyr;
    }            
  });
  return layer;
}
function zoomToLayer(map,layer){
  vectorSource = layer.getSource();

      //map.getView().fit(layer.getSource().getExtent(), (map.getSize()));
      //vectorSource.once('change',function(e){
        //if(vectorSource.getState() === 'ready') { 
          if(vectorSource.getFeatures().length>0) {
            map.getView().fit(vectorSource.getExtent(), map.getSize());
          }
       // }

    };
    function round(value, exp) {
      if (typeof exp === 'undefined' || +exp === 0)
        return Math.round(value);

      value = +value;
      exp = +exp;

      if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
        return NaN;

  // Shift
  value = value.toString().split('e');
  value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

  // Shift back
  value = value.toString().split('e');
  return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}


//control the controls display basing on sidebar and right modal shown or not


$(document).ready(function(){

  if(parseFloat($('#sidebar').css('width'))==400){ 
    $(document).find('.marginOnSidebare').addClass('sideBarActif');
  }
  else
  {
    $('#sidebar').addClass('hidden');
  }

})

/*****************************control Left and rightSideBArre regarding required Action******************************************/
function showRhiteSDB(sectionID="")
{

 //hide left sidebare
  
if(!$('#sidebar').hasClass('hidden')) $('#sidebar').addClass('hidden');
if($(document).find('.marginOnSidebare').hasClass('sideBarActif')) $(document).find('.marginOnSidebare').removeClass('sideBarActif');
//display correct content for the Right DB

$('section.right-section').not('#'+sectionID).each(function(index)
{
  if (!$(this).hasClass('hidden')) $(this).addClass('hidden');
})
$('#'+sectionID).removeClass('hidden');
//show right SB
if(!$('.right-sidebar').hasClass('shown')) $('.right-sidebar').addClass('shown');
if(!$(document).find('.marginOnRightSideBare').hasClass('sideBarActif')) $(document).find('.marginOnRightSideBare').addClass('sideBarActif');
}
$(document).on('click','.showRSideBare',function(){
 targetSectionId = $(this).attr('data-showRightsection');
 showRhiteSDB(targetSectionId);
})

$(document).on('click','.hideRSideBare',function(){
 
//hide right SB
if($('.right-sidebar').hasClass('shown')) $('.right-sidebar').removeClass('shown');
if($(document).find('.marginOnRightSideBare').hasClass('sideBarActif')) $(document).find('.marginOnRightSideBare').removeClass('sideBarActif');
})
$(document).on('click', '#toggle_btn', function(e) {
    e.stopPropagation();
    if($('.right-sidebar').hasClass('shown')) $('.right-sidebar').removeClass('shown');
    $('#sidebar').toggleClass('hidden');
    $(document).find('.marginOnSidebare').toggleClass('sideBarActif');
    return false;
    });
$(document).on('click', '#mobile_btn', function(e) {
  
    e.stopPropagation();
    
        if($('.right-sidebar').hasClass('shown')) $('.right-sidebar').removeClass('shown');
        $('#sidebar').toggleClass('hidden');
         $(document).find('.marginOnSidebare').toggleClass('sideBarActif');
        return false;
    });
$('.close-rightSDB').on('click',function(){
  //hide right SB
if($('.right-sidebar').hasClass('shown')) $('.right-sidebar').removeClass('shown');
if($(document).find('.marginOnRightSideBare').hasClass('sideBarActif')) $(document).find('.marginOnRightSideBare').removeClass('sideBarActif');
if(parseFloat($('#sidebar').css('width'))==400 && $('#sidebar').hasClass('hidden')){ 
    $(document).find('.marginOnSidebare').addClass('sideBarActif');
    $('#sidebar').removeClass('hidden');
    
  }
})
    
   
