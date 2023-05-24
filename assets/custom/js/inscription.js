jQuery.extend(jQuery.validator.messages, {
    required: "Champs Obligatoire.",
    equalTo: "les deux champs ne sont pas identiques.",
    // remote: "Please fix this field.",
    email: "Veuillez saisir un Email Valide.",
    // url: "Please enter a valid URL.",
    // date: "Please enter a valid date.",
    // dateISO: "Please enter a valid date (ISO).",
    // number: "Please enter a valid number.",
    // digits: "Please enter only digits.",
    // creditcard: "Please enter a valid credit card number.",
    // equalTo: "Please enter the same value again.",
    // accept: "Please enter a value with a valid extension.",
    // maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    // minlength: jQuery.validator.format("Please enter at least {0} characters."),
    // rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    // range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    // max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    // min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

document.addEventListener('DOMContentLoaded', function() {
			$('#entreprise-logo').dropify({
				messages: {
					'default': 'Glisser la photo ici',
					'replace': 'clicker ou glisser pour remplacer',
					'remove':  'Supprimer',
					'error':   'une erreur s est produite!.'
				}
			});

		},false);
		
		var form = $("#inscription-form").show();

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
	errorPlacement: function errorPlacement(error, element) { $(element).closest('.input-group').after(error); },  
	rules: {
		confirm: {
			equalTo: "#password-2"
		},

	},
	
});
$("#inscription-form").submit(function(event){
	$('#success-nouvel-entreprise .modal-body').children().remove();
	 $('body').loadingModal({
          position:'auto',
          text:'',
          color:'#fff',
          opacity:'0.7',
          backgroundColor:'rgb(214, 101, 101)',
          animation:'chasingDots'
        });
  event.preventDefault(); //prevent default action 
  var post_url = $(this).attr("action"); //get form action url
  var request_method = $(this).attr("method"); //get form GET/POST method
  var frmDta = new FormData(this);
  $.ajax({
  	url : post_url,
  	type: request_method,
  	data : frmDta,
  	cache:false,
  	processData:false,
  	contentType:false,
  	success: function(result){
  		$('body').loadingModal('destroy');
  		var dta = JSON.parse(result);
  		
  		$('#success-nouvel-entreprise .modal-body').append('<p> Bienvenue '+dta[1]+' '+dta[2]+'</p><p>Matricule : '+dta[0]+'</p>');
  		$('#success-nouvel-entreprise .modal-body').append('<p><small style="color:rgba(0,0,0,0.5);border-bottom:1px solid #064982">Connexion</small></p>');
  		$('#success-nouvel-entreprise .modal-body').append('<p>'+dta[3]+'</p>');
  		
  		$('#success-nouvel-entreprise').modal('show');
  	},
  	error: function(err){
  		$('body').loadingModal('destroy');
      showInfoBox('error',err.responseText);
  		

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