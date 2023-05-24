function attributesTableoptions(dta,columns){
	
	if (columns.length<1) columns=[{'data':'empty'}];
	return {
		data:dta,
		columns:columns,
		"ordering": false,
		"paging": false,
		"processing": false,
		responsive: true,
		"scrollY":"50vh",
		"scrollX": true,
		"scrollCollapse": true,
		"dom": 'tp',
		"lengthMenu": [8,12,50,100],
		"pageLength": 8,
		"columnDefs": [
		{
			"data": "Action",
			"defaultContent": "<button>Edit</button>",
			"targets": 0
		}
		],
		language: datatableLangage,
	};
}
var attributesTable = $('#attributes-tables').DataTable(attributesTableoptions([],[]));
function getAttributesTable(idAffaire,nomAffaire)
{
	var form_data = new FormData(); 
	form_data.append('geoaffaire',nomAffaire);
	form_data.append('id',idAffaire);
	$.ajax({
		url: BaseUrl+'EditComoposantes/AttributesTable', 
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		success: function(rslt){
			try
			{
				
				dta = JSON.parse(rslt);
				reinitializeAttributesTable('attributes-tables',dta.rows,dta.col,function(){
					if($('#attributes-data-modal').hasClass('hidden')) $('#attributes-data-modal').removeClass('hidden');
					attributesTable.columns.adjust().responsive.recalc();
				});
			}
			catch(err)
			{
				reinitializeAttributesTable('attributes-tables',[],[],function(){
					if($('#attributes-data-modal').hasClass('hidden')) $('#attributes-data-modal').removeClass('hidden')
						attributesTable.columns.adjust().responsive.recalc();
				});
			}  
		},
		error:function(error){
			showInfoBox('error',error.responseText);	
		}
	});
}
function reinitializeAttributesTable(tableID,dta,columns,callback)
{
	
	if($.fn.DataTable.isDataTable('#'+tableID))
	{
		html = '<thead><tr>';
		for(i=0;i<columns.length;i++)
		{
			html = html+'<th>'+columns[i].data+'</th>';
		}
		html = html+'</tr></thead>';
		$('#'+tableID).DataTable().clear().destroy();
		$('#'+tableID).empty();
		$('#'+tableID+'').append(html);
		attributesTable = $('#'+tableID).DataTable(attributesTableoptions(dta,columns));
	}
	callback();
}
$('#close-attributes-table').on('click',function(){
	$(this).closest('.custom-modal-left').addClass('hidden');
})