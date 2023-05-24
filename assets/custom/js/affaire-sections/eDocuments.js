$('#e-Documents').on('click',function(){
	$('.principal-items').removeClass('active');
	$('li').removeClass('active');
	$(this).addClass('active');	
	
	$('#main-container').find('section').addClass('hidden_section');
	$("#eDocuments-section").removeClass('hidden_section');
	//getDocuments(selectedAffaire);
	$('html,body').animate({
        scrollTop: $("#eDocuments-section").offset().top},
        'slow');

});

function getDocuments(affaireTo)
{
	frmData = new FormData();
	frmData.append('affaire',affaireTo);
	$.ajax({
		url : BaseUrl+'Documents/getDocuments',
		type: 'post',
		data : frmData,
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			$arr = JSON.parse(result);
			
  

  
			$.each($arr, function( index, value ) {
				
     		  $('#folders-tree').jstree("create_node", selectedAffaire, value,'inside');
   });
		/*var v = $('#folders-tree').jstree(true).get_json(selectedAffaire, {flat:true})

console.log(v[5].data);	*/
		},
		error: function(err){

		}
	})
}

