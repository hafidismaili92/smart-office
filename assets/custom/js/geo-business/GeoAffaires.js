
var affairesTable = $('#geoAffaires-table').DataTable(
{
	"processing": false,
	"stateSave": false,
	//"scrollY":        "80vh",
	//"scrollCollapse": true,
	"order": [[ 0, "desc" ]],
	"ajax": {
		url: BaseUrl+'EditGeoBusiness/load_GeoAffaires',
		type: "post",
		datatype:"json",
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{
		}
	},
	"serverSide": false,
	rowId: 0,
	responsive :false,
	"iDeferLoading": 20,
	"dom": 't',
	//"lengthMenu": [15,50,100],
	//"pageLength": 15,
	"paging":false,
	"bSortClasses": false,
	columnDefs:[
	{"orderable": false, "targets": [0,2]},
	
	{"targets": [0],"visible": false,"searchable": false},
	{"render": function ( data, type, row ) {
		if(type=="display")
		{
			let geomTypeIcon = "unknown";
			dtaArray = data.split(';');
			switch (dtaArray[0])
			{
				case 'LineString':
					geomTypeIcon = 'line';
					break;
				case 'Point': 
					geomTypeIcon = 'point';
					break;
				case 'Polygon': 
					geomTypeIcon = 'polygon';
					break;
				default : 
					geomTypeIcon = "unknown";
					break;

			}
			html = '<div class="layer-list-item"> <div class="layerIcon-container bg-gradient-success" > <img class="img-fluid" src="'+BaseUrl+'images/geometries/'+geomTypeIcon+'.png" alt=""> </div> <div class="layer-details-container"> <div class="layer-name"> <h5 class="text-dark">'+dtaArray[1]+'</h5> </div> <div class="layer-info"> <ul><li class="text-secondary "><i class="fa fa-calendar pr-1"></i>'+dtaArray[2]+'</li></ul> </div> </div> </div>';
			return html;
		}
		else
		{
			return data;
		}
		/*color = "#e6a40f";
		switch(data)
		{
			case "Point":
			return '<i class="fa fa-map addAff-toMap"></i>';
			break;
			case "Polygon":
			return '<i class="fa fa-draw-polygon addAff-toMap "></i>';
			break;
			case "LineString":
			return '<i class="fa fa-road addAff-toMap "></i>';
			break;
			default:
			return '<i class="fa fa-question-circle"></i>';
			break;
		}*/
	},
	"targets": 1
},
{"render": function ( data, type, row ) {
	actionDetails = '<li class="affaire-showDetails geoAff-actions">Details <i class="fa fa-info-circle  "></i></li>';
	attributesTable = '<li class="affaire-showAttrTable geoAff-actions">Table Attributaire <i class="fas fa-table "></i></li>';
	attachements = '<li class="affaire-showAttachements geoAff-actions">Attachements<i class="fas fa-file-alt "></i></li>';
	exporter = '<li class="affaire-export geoAff-actions">Exporter <i class="fas fa-download "></i></li>';
	addToMap = '<li class="affaire-addToMap geoAff-actions">Ajouter à la carte <i class="fas fa-map-marked-alt"></i></li>';
	showBornes = '<li class="affaire-bornes geoAff-actions">Afficher les bornes <i class="fas fa-border-none"></i></li>';
	style = '<li class="affaire-style geoAff-actions">style<i class="fas fa-palette"></i></li>';
	zoom = '<li class="affaire-zoom geoAff-actions">Zoomer <i class="fas fa-search-location"></i></li>'
	menuContent = actionDetails+attributesTable+attachements+addToMap+zoom+showBornes+exporter+style;
	html = '<div class="layer-action btn-group dropleft show"><a href="#"  data-toggle="dropdown"><i class="fa fa-ellipsis-v tree-points-menu"></i></a><div class="dropdown-menu"><ul>'+menuContent+'</ul></div></div>';
	return html;
},
"targets": 2
},
],
language: datatableLangage,
});


$('#search-Affaires').keyup(function(){
	affairesTable.search($(this).val()).draw() ;
});
$('#att-add-file').on('change',function(e){
	var files = e.currentTarget.files; 
	affName = $('#att-selected-geoaffName').text();
	affId = $('#att-selected-geoaffId').text();
	uploadAttachements(files,affName,affId);
	$(this).val('');
})
function uploadAttachements(files,affName,affId)
{
	/*if(files['length']>5)
    {
    	showInfoBox('error','maximum 5 fichiers à la fois',4000);
    	return;
    }*/
    var form_data = new FormData();   
    for(i=0;i<files['length'];i++)
    {
        var filesize = ((files[i].size/1024)/1024).toFixed(4); // MB
        if (typeof files[i].name == "undefined") { 
        	showInfoBox('error','fichier "'+files[i].name+'" invalide',4000);
        	return;
        }
        /*if(filesize >= 10)
        {
        	showInfoBox('error','fichier "'+files[i].name+'" dépassant taille maximal 10MB!');	
        	return;
        }*/
        form_data.append('file'+i,files[i]);  
    }
    form_data.append('geoaffaire',affName);
    form_data.append('id',affId);
    $.ajax({
    	url: BaseUrl+'Attachements/addAttachements', 
    	cache: false,
    	contentType: false,
    	processData: false,
    	data: form_data,                         
    	type: 'post',
    	success: function(rslt){
    		rslt = JSON.parse(rslt);
    		if(rslt[0]>0)
    			showInfoBox('success',rslt[1]);

    		if(rslt[2]!="")
    			showInfoBox('warning',rslt[2],3000,"150px");
    		attachementsTable.ajax.reload();
    	},
    	error:function(error){
    		showInfoBox('error',error.responseText);	
    	}
    });
}
var attachementsTable = $('#attachements-table').DataTable(
{
	"processing": false,
	"stateSave": false,
	"paging":false,
	"scrollCollapse": true,
	"deferLoading": 0, // here
	"order": [[ 0, "desc" ]],
	"ajax": {
		url: BaseUrl+'Attachements/loadAttachements',
		type: "post",
		datatype:"json",
		data:function(d){d.geoaffaire=$('#att-selected-geoaffName').text();d.id=$('#att-selected-geoaffId').text();d.toDatatable=1},
		error:function(XMLHttpRequest, textStatus, errorThrown)
		{
			showInfoBox('error',XMLHttpRequest.responseText);
		}
	},
	"serverSide": false,
	responsive :false,
	"iDeferLoading": 20,
	"dom": 't',
	"bSortClasses": false,
	columnDefs:[
	{"orderable": false, "targets": [1,2,3]},
	{className:"dt-left","targets": [2]},
	{className:"dt-right","targets": [1,3]},
	{ "width": "80%", "targets": 2 },
	{"targets": [0],"visible": false,"searchable": false},
	{"render": $.fn.dataTable.render.ellipsis(35),"targets": 2},
	{"render":function(data, type, row){
		var icon = "fas fa-file";
		var color ="gray";
		if (type==='display')
		{
			if($.inArray(data,['png','jpeg','jpg','tiff','ico','gif'])>=0)
			{
				icon = "far fa-file-image";
				color = "rgba(227, 203, 43, 1)";
			}
			else if ($.inArray(data,['xls','xlsx'])>=0)
			{
				icon = "far fa-file-excel";
				color = "green";
			}
			else if ($.inArray(data,['txt','dat'])>=0)
			{
				icon = "far fa-excel";
			}
			else if ($.inArray(data,['doc','docx'])>=0)
			{
				icon = "far fa-file-word";
				color = "blue";
			}
			else if ($.inArray(data,['ppt','pptx'])>=0)
			{
				icon = "far fa-file-powerpoint";
				color = "orange";
			}
			else if ($.inArray(data,['pdf'])>=0)
			{
				icon = "far fa-file-pdf";
				color = "red";
			}
			else if ($.inArray(data,['zip','rar'])>=0)
			{
				icon = "far fa-file-archive";
				color = "rgba(190, 96, 25, 1)";
			}
			else if(data=="csv")
			{
				icon = "far fa-file-csv";
			}
		}
		return '<i class="'+icon+'" style="color:'+color+'"></i>';
	},"targets":1
}
],
language: datatableLangage,
});
function getImgAttachements(affName,affId,callback)
{	$('#attachementsImg-shower .carousel-inner').children().remove();
var form_data = new FormData(); 
form_data.append('geoaffaire',affName);
form_data.append('id',affId);
form_data.append('Img',1);
$.ajax({
	url: BaseUrl+'Attachements/loadAttachements', 
	cache: false,
	contentType: false,
	processData: false,
	data: form_data,                         
	type: 'post',
	success: function(rslt){
		dta = JSON.parse(rslt);
		for(index in dta)
		{
			caption = '<div class="carousel-caption d-block text-left" style="padding: 5px;background-color: rgba(169,181,189,0.7);"><h5>'+dta[index].download+'</h5></div>'
			html = '<div class="carousel-item"><div style="display:flex;justify-content:center;"><div style="position:relative"><img class="d-block" style="max-width:100%;max-height:100%;margin: auto;" src="'+dta[index].src+'" alt="'+dta[index].name+'">'+caption+'</div></div><div>';
			$('#attachementsImg-shower .carousel-inner').append(html);
		}
		$('#attachementsImg-shower .carousel-inner').find('.carousel-item').first().addClass('active');
		callback();
	},
	error:function(error){
		showInfoBox('error',error.responseText);	
	}
});
}
function downloadAllAttachements(affName,affId,callback=function(){})
{
	var form_data = new FormData(); 
	form_data.append('geoaffaire',affName);
	form_data.append('id',affId);
	$.ajax({
		url: BaseUrl+'Attachements/downloadAllAttachements', 
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		success: function(rslt){
		},
		error:function(error){
			showInfoBox('error',error.responseText);	
		}
	});
}
$('#att-show-slider').on('click',function(){
	affName = $('#att-selected-geoaffName').text();
	affId = $('#att-selected-geoaffId').text();
	getImgAttachements(affName,affId,function(){
		$('#slidershow-modal').modal('show');
	});
})
$('#att-download-allAttachements').on('click',function(){
	affName = $('#att-selected-geoaffName').text();
	affId = $('#att-selected-geoaffId').text();
	downloadAllAttachements(affName,affId);
})

$('#Affaires').on('click','.geoAff-actions',function(){
	parent = $(this).closest('tr');
	row = affairesTable.row(parent);
	id = row.id();
	nom = row.data()[2];
	if($(this).hasClass('affaire-showAttachements'))
	{
		$('#att-selected-geoaffName').text(nom);
		$('#att-selected-geoaffId').text(id);
		$('#attachement-tab').trigger('click');
		attachementsTable.ajax.reload();
	}
	else if ($(this).hasClass('affaire-showAttrTable'))
	{
		getAttributesTable(id,nom);
	}
	else if($(this).hasClass('affaire-addToMap'))
	{
		addAffToMap(id,function(map,layer){
			
			vectorSource = layer.getSource();
			vectorSource.once('change',function(e){
				if(vectorSource.getState() === 'ready') { 
					zoomToLayer(map,layer);
				}
			})
		});
	}
	else if($(this).hasClass('affaire-style'))
	{
		$('#changeStyleForm').attr('data-target',id)
		$('#setStyle-modal').modal('show');
	}
	else if($(this).hasClass('affaire-zoom'))
	{
		parent = $(this).closest('tr');
		row = affairesTable.row(parent);
		layerID = row.id();
		layer = getLayerById(map,layerID);
		if(layer) zoomToLayer(map,layer);
		else showInfoBox('warning','Veuillez ajouter l\'affaire à la carte');
	}
	else if($(this).hasClass('affaire-export'))
	{
		$('#export-modal').attr('data-affaire',id);
		$('#export-modal').attr('data-name',nom);
		$('#export-modal').modal('show');
	}
})
$("#changeStyleForm").submit(function(event){
	event.preventDefault();
	var formData = new FormData(this);
	formData.append('affaire',$(this).attr('data-target'));
	$.ajax({
		url: BaseUrl+'EditGeoBusiness/setStyle', 
		cache: false,
		contentType: false,
		processData: false,
		data: formData,                         
		type: 'post',
		success: function(rslt){
			if(rslt!=0)
			{
				layer = getLayerById(map,id);
				if(layer)
				{
					dta = JSON.parse(rslt);
					layer.getStyle().getFill().setColor(dta.fill);
					layer.getStyle().getStroke().setColor(dta.strokecolor);
					layer.getStyle().getStroke().setWidth(dta.strokewidth);
					layer.getStyle().setImage(new ol.style.Circle({
						radius: 7,
						fill: new ol.style.Fill({color: dta.fill}),
						stroke: new ol.style.Stroke({
							color: dta.strokecolor, width: dta.strokewidth
						})
					}));
					layer.getSource().clear();
				}
				showInfoBox('success','le style a été modifié');
			}
			$('#setStyle-modal').modal('hide');
		},
		error:function(error){
			showInfoBox('error',error.responseText);	
		}
	});
});
function addAffToMap(aff,callback=null)
{
	layer = getLayerById(map,aff);
	if(layer)
	{
		layer.getSource().clear();
	}
	else
	{
		var compteur =0;
		var fstyle = new ol.style.Style({
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
		sourceWFS = new ol.source.Vector({
			url: BaseUrl+'EditComoposantes/GetLayer?aff='+aff,
			format: new ol.format.GeoJSON(),
			serverType: 'geoserver'
		});
		layer = new ol.layer.Vector({ source: sourceWFS,id:aff});
		map.addLayer(layer);
		
		 setTimeout(function () {
		 	row = affairesTable.row('#'+aff);
		  $(row.node()).find('.addAff-toMap').addClass('shown fa-lg');
		},300);
		
		sourceWFS.on('addfeature', function(event){

			if(compteur == 0)
			{

				feature = event.feature;
				props = feature.getProperties();
				
				fstyle = new ol.style.Style({
					fill: new ol.style.Fill({
						color: props.fill
					}),
					stroke: new ol.style.Stroke({
						color: props.strokecolor,
						width: props.strokewidth
					}),
					image: new ol.style.Circle({
						radius: 7,
						fill: new ol.style.Fill({color: props.fill}),
						stroke: new ol.style.Stroke({
							color: props.strokecolor, width: props.strokewidth
						})
					})
				});
				layer.setStyle(fstyle);
				compteur =1;
			}
		})
	}
	if (callback) callback(map,layer);
}
$('#style-strokecolorHex').on('change',function(e){
	rgb = hexColortoRGB($(this).val());
	$('#style-strokecolor').val(rgb);
})

$('#ExporteAffaire').click(function(e){
	id = $('#export-modal').attr('data-affaire');
	name = $('#export-modal').attr('data-name');
	format = $('#export-format-selector').val();
	$(this).closest('a').attr('href',BaseUrl+'EditGeoBusiness/export_Geoaffaire?geoaffaire='+name+'&id='+id+'&format='+format);
	$(this).closest('a').trigger('click');
})

$('#geom-selector div').click(function()
       {
        element = $(this);
        if(/*attributesAddTable.rows().count()>0*/ 1!=1)
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

$('#attributes-container').on('click','.remove-champs-value',function(){
        champs = $(this).closest('.champsView').find('label').text();
        removeAttributes([champs],false,reInitializeDatatable);
      })
//control add field
    $('#btn-add-attributes').click(function(e){
        e.preventDefault();
        champs = $('#addgeoffaire-add-attributes').val();
        createAttributes([champs],reInitializeDatatable);
      })


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
          $( ".inner" ).before( "<p>Test</p>" );
          let actionCol = $('#'+idTable+' thead tr').find('th:last');
          $(actionCol).before('<th>'+attribute+'</th>');
          $('#'+idTable+' tbody tr').each(function(){
          	actionCol = $(this).find('td:last');
            $(actionCol).before('<td></td>');
          })
        }
        break;
        case 'remove':
        if(isAll)
        {

          $('#'+idTable+' thead tr th').each(function(index){
            if (index != 0 && index != $('#'+idTable+' thead tr th').length-1)
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
