<?php
namespace hasnatMVC\App\Models;
/**
* ContactSender model sender details of sender (name ,email, phone)
*/
class ContactSender extends \hasnatMVC\BaseModel
{
	/** @var string sender name */
	public $name;
	/** @var string sender email */
	public $email;
	/** @var string sender phone */
	public $phone;
	/** @var string array validation errors */
	public $validation_errors;
	/**
	* Message class contructor
	* @param string name of sender
	* @param string email of sender
	* @param stringphone of sender
	*/
	public function __construct($name, $email, $phone)
	{
		//echo 'Contact Form';
		$this->name = $name;
		$this->email = $email;
		$this->phone = $phone;
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
	* Check is Contact is valid checking (sender and message)
	* @return true if valid data or false if not valid
	*/
	public function is_valid()
	{
		$this->validation_errors = [];
		$this->is_name_valid();
		$this->is_email_valid();
		$this->is_phone_valid();
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
	* Checks if sender name is valid 
	* Name cannot be blank and must only contain english alphabets and spaces
	* @param boolean return error message if data is not valid
	* @return (if param1 is false) true if data is valid
	* @return (if param1 is true)false if no error in data or string error message if data is not valid
	*/
	public function is_name_valid($return_if_error = false)
	{
		if( empty($this->name) )
		{
			$error = 'Name cannot be blank';
			if($return_if_error)
			{
				return $error;
			}
			$this->validation_errors[] = $error;
			return false;
		}
		else if(!preg_match("/^[a-zA-Z ]*$/",$this->name) ) 
		{
			$error = 'Name can only english contain alphabets and spaces';
			if($return_if_error)
			{
				return $error;
			}
			$this->validation_errors[] = $error;
			return false;
		}
		else
		{
			if($return_if_error)
			{
				return false;
			}
			return true;
		}
		
	}
	/**
	* Checks if sender email is valid 
	* Email cannot be blank and must be valid Email
	* @param boolean return error message if data is not valid
	* @return (if param1 is false) true if data is valid
	* @return (if param1 is true)false if no error in data or string error message if data is not valid
	*/
	public function is_email_valid($return_if_error = false)
	{
		if( empty($this->email) )
		{
			$error = 'Email cannot be blank';
			if($return_if_error)
			{
				return $error;
			}
			$this->validation_errors[] = $error;
			return false;
		}
		else if( !filter_var($this->email, FILTER_VALIDATE_EMAIL) )
		{
			$error = 'Email not valid';
			if($return_if_error)
			{
				return $error;
			}
			$this->validation_errors[] = $error;
			return false;
		}
		else
		{
			if($return_if_error)
			{
				return false;
			}

			return true;
		}
		
	}
	/**
	* Checks if sender phone is valid 
	* Phone number cannot be blank and must be valid phone number
	* @param boolean return error message if data is not valid
	* @return (if param1 is false) true if data is valid
	* @return (if param1 is true)false if no error in data or string error message if data is not valid
	*/
	public function is_phone_valid($return_if_error = false)
	{
		if( empty($this->phone) )
		{
			$error = 'Phone cannot be blank';
			if($return_if_error)
			{
				return $error;
			}
			$this->validation_errors[] = $error;
			return false;
		}
		else if(!preg_match( '/^[+]?([\d]{0,3})?[\(\.\-\s]?([\d]{3})[\)\.\-\s]*([\d]{3})[\.\-\s]?([\d]{4})$/', $this->phone ))
		{
			$error = 'Invalid phone number';
			if($return_if_error)
			{
				return $error;
			}
			$this->validation_errors[] = $error;
			return false;
		}
		else
		{
			if($return_if_error)
			{
				return false;
			}
			return true;
		}
		
		
	}
}


