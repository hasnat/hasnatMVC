<div class="row" id="formholder">
	<?php if(isset($validation_errors) && count($validation_errors)>0)
		  { ?>
		  <div class="errors">
		    <h4>Following Errors Occured</h4>
			<p><?= implode('<br />',$validation_errors);?></p>
		  </div>
	<?php } ?>
	<form id="contactform" role="form"  method="post" action="/ContactForm/Contact/submit">
		<h2>Contact Us</h2>
        
		<div class="form-group <?=(@$name_error ? 'has-error':'');?>">
		<label for="name">Name <small><?=@$name_error;?></small></label>
		<input id="name" name="name" type="text" class="form-control" value="<?=@$name;?>" >

	</div>
	<div class="form-group <?=(@$email_error ? 'has-error':'');?>">
		<label for="email">Email <small><?=@$email_error;?></small></label>
		<input id="email" name="email" type="text" class="form-control" value="<?=@$email;?>" >

	</div>
	<div class="form-group <?=(@$phone_error ? 'has-error':'');?>">
		<label for="phone">Phone <small><?=@$phone_error;?></small></label>
		<input id="phone" name="phone" type="text" class="form-control" value="<?=@$phone;?>" >

	</div>
	<div class="form-group <?=(@$message_error ? 'has-error':'');?>">
		<label for="message">Message <small><?=@$message_error;?></small></label>
		<textarea id="message" name="message" class="form-control" ><?=@$message;?></textarea>

	</div>
	<div class="form-group">
	  <label>
      	<input type="checkbox" id="js_validate" checked> JS Validation
      </label>
    </div>
	<div class="form-group">
	  <label>
      	<input type="checkbox" id="ajax"> Ajax Submission
      </label>
    </div>
    <div class="form-group">
	  <label>
	<button type="submit" class="btn btn-default">Send</button>
	  </label>
    </div>

	</form>
    
</div>