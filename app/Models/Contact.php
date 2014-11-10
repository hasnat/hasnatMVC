<?php
namespace hasnatMVC\App\Models;
/**
* Contact model class has sender and message
*/
class Contact extends \hasnatMVC\BaseModel
{
	/** @var ContactSender sender */
	public $sender;
	/** @var string message */
	public $message;
	/** @var string array validation errors */
	public $validation_errors = [];
	/**
	* Message class contructor
	* @param string message must be greater than 10 characters to pass validation
	* @param MessageSender $sender
	*/
	public function __construct($message,ContactSender $sender)
	{
		//echo 'Contact Form';
		$this->sender = $sender;
		$this->message = $message;
	}
	/**
	* Check is Contact is valid checking (sender and message)
	* @return true if valid data or false if not valid
	*/
	public function is_valid()
	{
		$this->validation_errors = [];
		$this->is_sender_valid();
		$this->is_message_valid();
		if(count($this->validation_errors)==0)
		{
			
			return true;
		}
		else
		{
			return false;
		}
		
	}
	/**
	* Returns validation errors array
	* @return String array of validation errors empty array if no errors
	*/
	public function validation_errors()
	{
		return $this->validation_errors;
		
	}
	/**
	* Checks if sender data is valid (sender name, phone and email)
	* @param boolean return error message if data is not valid
	* @return (if param1 is false) true if data is valid
	* @return (if param1 is true)false if no error in data or string error message if data is not valid
	*/
	public function is_sender_valid($return_if_error = false)
	{
		if(!$this->sender->is_valid())
		{
			$error = $this->sender->validation_errors();
			$this->validation_errors = array_merge($this->validation_errors, $error);
			if($return_if_error)
			{
				return $error;
			}
			else
			{
				return false;
			}
		}
		
		return true;
	}
	/**
	* Checks if message is valid 
	* Message must be greater than 10 characters to be valid
	* @param boolean return error message if data is not valid
	* @return (if param1 is false) true if data is valid
	* @return (if param1 is true)false if no error in data or string error message if data is not valid
	*/
	public function is_message_valid($return_if_error = false)
	{
		
		if(empty($this->message))
		{
			$error = 'Message cannot be blank';
			$this->validation_errors[] = $error;
			if($return_if_error)
			{
				return $error;
			}
			else
			{
				return false;
			}
			
			
		}
		else if(strlen($this->message)<10)
		{
			$error = 'Message must be at least 10 characters';
			$this->validation_errors[] = $error;
			if($return_if_error)
			{
				return $error;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if($return_if_error)
			{
				return false;
			}
			else
			{
			return true;
			}
		}
	}


}



