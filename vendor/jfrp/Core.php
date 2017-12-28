<?php

namespace jfrp;


class Core {
	public static function run(){
		// try {
		spl_autoload_register("self::registerAutoload");
		// if(spl_autoload_register("self::registerAutoload"));
		// else throw new \Exception("splautoloadregister");

		define('WEBROOT',str_replace('vendor/index.php','',$_SERVER['SCRIPT_NAME']));
		define('ROOT',str_replace('vendor/index.php','',$_SERVER['SCRIPT_FILENAME']));
		$params = explode('/',$_GET['p']);
		$controller = !empty($params[0]) ? $params[0] : 'IndexController';
		$action = (isset($params[1]) && $params[1] !== '' )? $params[1] : 'indexAction';
		$controller = 'app\controllers\\'.$controller;
		if (method_exists($controller, $action)){
            unset($params[0]);
            unset($params[1]);
			if (class_exists($controller)) $controller = new $controller();
			else throw new \Exception("ErrorProcessingRequest");

			call_user_func_array(array($controller, $action),$params);

        } else {
			unset($params[0]);
			if(substr($controller, -1) == 's'){
				$controller = substr($controller, 0,-1);
				$action = 'findall';
			}
			if(method_exists($controller, $action)){
					if(class_exists($controller)) $controller = new $controller();
					else throw new \Exception("ErrorProcessingRequest");
					call_user_func_array(array($controller, $action),$params);
			}else{
				if(class_exists($controller)) $controller = new $controller();
				else throw new \Exception("ErrorProcessingRequest");
				call_user_func_array(array($controller, 'indexAction'),$params);
			}
			// if (class_exists($controller)) $controller = new $controller();
			// else throw new \Exception("ErrorProcessingRequest");
			//throw new \Exception("NotFoundException", 1);
        }
	//  } catch ( \Exception $e) {
		/*if($e instanceof NotFoundException){
			header("HTTP/1.1 404 Not found");
		} else {
			header ("HTTP/1.1 500 Internal Server Error");
		}
	// }*/
	}

	public static function registerAutoload($controller){
		require_once ROOT.'vendor/jfrp/Controller.php';
		require_once ROOT.'vendor/jfrp/Model.php';
		$controller = str_replace( '\\', '/',$controller);
		if (file_exists(ROOT.$controller.'.php')){
			require  ROOT.$controller.'.php';
			return true;
		}
		return false;
	}
}
?>
