<?php
namespace hasnatMVC;

/**
 * Application class for hasnat MVC
 * Use namespace /hasantMVC/App/Models for Models
 * Use namespace /hasantMVC/App/Controllers for Controllers
 */
class Application
{
    /** @var null The controller name */
    private $request_controller_name = null;
    /** @var null The controller */
    private $request_controller = null;
    /** @var null The action (of the above controller), often also named "method" */
    private $request_action = null;
    /** @var [] The arguments for action (of the above controller), arguments will be passed to the action */
    private $request_action_arguments = [];
    /** @var [] The request method (Only considering GET and POST) */
    private $request_method = null;

    /**
     * Start the application:
     * Initialize the URL elements and calls the according controller/action/method 
     */
    public function __construct()
    {
    	$this->initialize_request();

    	$valid_request = true;
    	
    	if (file_exists('app/Controllers/' . $this->request_controller_name . '.php')) {

    		require 'app/Controllers/' . $this->request_controller_name . '.php';
    		$namespace_controller_name = 'hasnatMVC\\App\\Controllers\\'.$this->request_controller_name;

            $this->request_controller = new $namespace_controller_name();
            
            if(method_exists($this->request_controller, $this->request_action))
            {
	
	            call_user_func_array(array($this->request_controller,$this->request_action),$this->request_action_arguments);

	    	}
	    	else
	    	{
		    	$valid_request = false;
	    	}
    	}
    	else
    	{
	    	$valid_request = false;
    	}
    		if(!$valid_request)
    		{
    			header("HTTP/1.0 404 Not Found");
    			die('<center><h1>404</h1></center>');
    		}
    	

    }
    /**
     * 
     * Initialize the URL elements and calls the according controller/action/method 
     */
    private function initialize_request()
    {
    	//set request method (GET|POST)
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
			$this->request_method = 'post';
		}
		else
		{
			$this->request_method = 'get';
		}
        if (isset($_GET['url'])) {
        	


            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // Put URL parts into according properties
            // URL structure will be ?url=Controller/(get_|post_)Method/argument1/argument2.....
            
            $this->request_controller_name = (isset($url[0]) ? $url[0] : 'Home');
            
            //Call index of controller if action is not specified
            $this->request_action = $this->request_method.'_'.(isset($url[1]) ? $url[1] : 'index');
      
            
            unset($url[0]);		//for arguments remove controller
            unset($url[1]);		//for arguments remove action
            
            //set arguments url
            $this->request_action_arguments = (isset($url) && count($url)>0 ? $url : []);



            // for debugging. uncomment this if you are having problems with the URL
            // echo 'URL: ' . $_GET['url'] . '<br />';
            // echo 'Controller: ' . $this->request_controller_name . '<br />';
            // echo 'Controller Method: ' . $this->request_action . '<br />';
            // echo 'Controller Method Arguments: ';
            // var_dump( $this->request_action_arguments);

        }else{
	        
	        $this->request_controller_name = 'Home';
	        $this->request_action = $this->request_method.'_index';
        }
    }
    
}