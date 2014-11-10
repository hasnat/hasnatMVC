<?php
namespace hasnatMVC\App\Controllers;

/**
 * Class for Contact controller
 */
class Home extends \hasnatMVC\BaseController
{
	/**
	 * This will be called if no action is provided in url
	 */
	public function get_index()
	{
		// Home Model
		$this->loadModel('Home');
		$home = new \hasnatMVC\App\Models\Home('Hello World');
		$data['message'] = $home->message;
		$this->loadView('home/index',$data);
	}
	


}