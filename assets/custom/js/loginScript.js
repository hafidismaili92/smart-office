const loginValidator = $('#loginForm').validate({
    onfocusout: function (e) {
        this.element(e);
    },
    onkeyup: function(e){if(!$('.customError').hasClass('hidden')) $('.customError').addClass('hidden')},

    highlight: function (element) {
        jQuery(element).closest('.form-control').addClass('is-invalid');
        
    },
    unhighlight: function (element) {
        jQuery(element).closest('.form-control').removeClass('is-invalid');
        jQuery(element).closest('.form-control').addClass('is-valid');
        ;
    },

    errorElement: 'div',
    errorClass: 'invalid-feedback',
    errorPlacement: function (error, element) {
        if (element.parent('.input-group-prepend').length) {
            $(element).siblings(".invalid-feedback").append(error);
            //error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    messages: {
        
        'emp-matricule': {
            required: "Veuillez ajouter le matricule",
           /* minlength: jQuery.format("Enter at least {0} characters"),
            remote: jQuery.format("{0} is already in use")*/
        },
        'emp-Password': {
            required: "Veuillez saisir le mot de passe",
           /* minlength: jQuery.format("Enter at least {0} characters"),
            remote: jQuery.format("{0} is already in use")*/
        }
    }
});

const resetLoginValidator = $('#reset-passwordForm').validate({
    onfocusout: function (e) {
        this.element(e);
    },
    onkeyup: function(e){if(!$('.customError').hasClass('hidden')) $('.customError').addClass('hidden')},

    highlight: function (element) {
        jQuery(element).closest('.form-control').addClass('is-invalid');
        
    },
    unhighlight: function (element) {
        jQuery(element).closest('.form-control').removeClass('is-invalid');
        jQuery(element).closest('.form-control').addClass('is-valid');
        ;
    },

    errorElement: 'div',
    errorClass: 'invalid-feedback',
    errorPlacement: function (error, element) {
        if (element.parent('.input-group-prepend').length) {
            $(element).siblings(".invalid-feedback").append(error);
            //error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    rules:
    {
    	'emp-confirmPassword':
    	{
    		equalTo:'#emp-newPassword',

    	}
    },
    messages: {
        
        'emp-matricule': {
            required: "Veuillez ajouter le matricule",
          
        },
        'emp-oldPassword': {
            required: "Champs obligatoire",
           
        },
        'emp-newPassword': {
            required: "Champs obligatoire",
           
        },
        'emp-confirmPassword': {
            required: "Champs obligatoire",
            equalTo:'les mots de passe ne sont pas identiques'
           
        }
    }
});

$('#loginForm').on('submit',function(event){

	if(loginValidator.valid() != true) return;
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : new FormData(this),
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			var data = $.parseJSON(result);
			(data.page!=null) ? window.location.href = data.page  : location.reload(true);
		},
		error: function(err){

			if($('.customError').hasClass('hidden')) $('.customError').removeClass('hidden');
			loginValidator.showErrors({'emp-matricule':'','emp-Password':''});
			//showInfoBox('error',err.responseText);

		}
	})
});

$('#reset-passwordForm').on('submit',function(event){
	if(resetLoginValidator.valid() != true) return;
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : new FormData(this),
		cache:false,
		processData:false,
		contentType:false,
		success: function(result){
			
				location.reload(true);
		},
		error: function(err){
			if($('.customError').hasClass('hidden')) $('.customError').removeClass('hidden');
			resetLoginValidator.showErrors({'emp-matricule':'','emp-oldPassword':'','emp-newPassword':'','emp-confirmPassword':''});
			//showInfoBox('error',err.responseText);
			

		}
	})
});





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