<?php
namespace hasnatMVC;
/**
 * Application base controller
 * For view it adds /Views/template/header and /Views/template/footer
 */
class BaseController
{
	/**
	* load Model for controller
	* @param string model name
	*/
	protected function loadModel($model_name)
	{
		require 'app/Models/'.$model_name.'.php';
	}
	/**
	* load data to View and show View
	* @param string view location/name
	* @param mixed data to pass to view
	* @param boolean load template
	*/
	protected function loadView($view,$data=null,$template = true)
	{
		//check is there is any data to be passed to view
		if($data && is_array($data))
		{
			extract($data);
		}
		if($template)
		{
			require 'app/Views/template/header.php';
		}
		require 'app/Views/'.$view.'.php';
		if($template)
		{
			require 'app/Views/template/footer.php';
		}
	}
	/**
	* load HTML to View and show View
	* @param string view location/name
	* @param boolean load template
	*/
	protected function loadHTML($html,$template = true)
	{
		//check is there is any data to be passed to view
		
		if($template)
		{
			require 'app/Views/template/header.php';
		}
		echo $html;
		if($template)
		{
			require 'app/Views/template/footer.php';
		}
	}
	
}

