$(function() {
  
  //init ajax switch
  $("#ajax").bootstrapSwitch();
  $("#js_validate").bootstrapSwitch();
  //on contact form submission
  $( "#contactform" ).submit(function( event ) {
  	  var validate_using_js = ($("#js_validate:checked").length>0);
  	  var ajax_form_submit = ($("#ajax:checked").length>0);
	  if(validate_using_js)
	  {
		  	var name = $( "#name" ).val();
		  	var email = $( "#email" ).val();
		  	var phone = $( "#phone" ).val();
		  	var message = $( "#message" ).val();
		  	var errors = [];
		  	
		  	
		  	//check name
		  	var check_name = /^[A-Za-z\d\s]+$/;	//regex for name check
		  	if(name.trim().length==0)
		  	{
			  	error = 'Name cannot be blank';
			    errors.push(error);
				showErrorForInput(error,'#name');
		  	}
		  	else if(!check_name.test(name))
		    {
			    error = 'Invalid Name (only english alphabets and spaces allowed)';
			    errors.push(error);
				showErrorForInput(error,'#name');
			    
		    }
		    else
		    {
			    showErrorForInput('','#name');	//clear error
		    }
		  	
		  	//check email
		  	var check_email = /\S+@\S+\.\S+/;	//regex for email check
		  	if(email.trim().length==0)
		  	{
			  	error = 'Email cannot be blank';
			    errors.push(error);
				showErrorForInput(error,'#email');
		  	}
		  	else if(!check_email.test(email))
		    {
			    error = 'Invalid Email';
			    errors.push(error);
				showErrorForInput(error,'#email');
			    
		    }
		    else
		    {
			    showErrorForInput('','#email');	//clear error
		    }
		    
		    
		    //check phone
		  	var check_phone = /^\d{3}\-?\d{3}\-?\d{4}$/;	//regex for phone check
		  	if(phone.trim().length==0)
		  	{
			  	error = 'Phone number cannot be blank';
			    errors.push(error);
				showErrorForInput(error,'#phone');
		  	}
		  	else if(!check_phone.test(phone))
		    {
			    error = 'Invalid Phone (must be 10 digits number)';
			    errors.push(error);
				showErrorForInput(error,'#phone');
			    
		    }
		    else
		    {
			    showErrorForInput('','#phone');	//clear error
		    }
		    
		    //check message
		  	if(message.trim().length==0)
		  	{
			  	error = 'Message cannot be blank';
			    errors.push(error);
				showErrorForInput(error,'#message');
		  	}
		  	else if(message.trim().length<10)
		    {
			    error = 'Message must be more than 10 characters';
			    errors.push(error);
				showErrorForInput(error,'#message');
			    
		    }
		    else
		    {
			    showErrorForInput('','#message');	//clear error
		    }
		    
		    
		    if(errors.length>0)
		    {
			  	event.preventDefault();
			  	return;
			}
	}	
	
	if(ajax_form_submit)
	{
		// DO AJAX
		ajax_submit_form();
		 
		
		event.preventDefault();
		
		
	}
	else
	{
		// DO simple post
		//event.preventDefault();
	}
  });
  
  
  
});

function ajax_submit_form(){
	var jqxhr = $.post( "/ContactForm/Contact/submit/1",
		{ name: $('#name').val(), 
		  phone: $('#phone').val(), 
		  email:$('#email').val(), 
		  message:$('#message').val() 
		  }, function(data) {
			
			$('#formholder').html(data);
			
		})
		  .fail(function(data) {

		    alert( "Some error(s) occured \r\n"+data.responseText );
		  });
	
}
function showErrorForInput(error,input)
{

	$(input).siblings('label').children().html(error);

}