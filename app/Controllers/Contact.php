<?php
namespace hasnatMVC\App\Controllers;

/**
 * Class for Contact controller
 */
class Contact extends \hasnatMVC\Controller
{
	/**
	 * This will be called if no action is provided in url
	 */
	public function get_index()
	{

		$this->loadView('contact/form');

	}
	
	
	/**
	 * Handles the data submitted from contact form page
	 * @param boolean ajax submit
	 */
	public function post_submit($ajax = false)
	{
		//save all post data
		$data = $_POST;
		$this->loadModel('ContactSender');
		$this->loadModel('Contact');
		
		$sender = new \hasnatMVC\App\Models\ContactSender($data['name'],$data['email'],$data['phone']);
		$message = new \hasnatMVC\App\Models\Contact($data['message'],$sender);
		
		//check if message is valid (Message model will check if sender data is valid)
		if($message->is_valid())
		{
			//load success page with posted data (if data is valid)
			if($ajax)
			{
				$this->loadView('contact/success',$data,false);				
			}
			else
			{
				$this->loadView('contact/success',$data);				
			}
		}
		else
		{
			//load validation errors
			$validation_errors = $message->validation_errors();
			
			//get individual errors to show in view
			$data['name_error'] = $sender->is_name_valid(true);
			$data['email_error'] = $sender->is_email_valid(true);
			$data['phone_error'] = $sender->is_phone_valid(true);
			$data['message_error'] = $message->is_message_valid(true);
			$data['validation_errors'] = $validation_errors;
			
			if($ajax)
			{
				header('HTTP/1.1 401 Unauthorized', true, 401);
				$this->loadHTML(implode("\r\n",$validation_errors),false);				
			}
			else
			{	
				//load form again
				$this->loadView('contact/form',$data);				
			}		
		}
		



	}

}