<?php
namespace hasnatMVC\App\Models;
/**
* Home model class 
*/
class Home extends \hasnatMVC\BaseModel
{
	
	/** @var string message */
	public $message;
	
	/**
	* Home class contructor
	* @param string message must be shown on web
	*/
	public function __construct($message)
	{
		
		
		$this->message = $message;
	}
	
}



