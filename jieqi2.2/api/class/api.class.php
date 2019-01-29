<?php


class api 
{
	function run()
	{
		$params = array_merge($_GET, $_POST);
		return $this->callback($params);
	}
	
	function callback($params) {
		$module = $params['module'];
		$method = $params['method'];
		@include_once JIEQI_ROOT_PATH. '/api/class/' . $module . '.class.php';
		$class = new $module();
		 @call_user_func(array(&$class, $method), $params);
		//$response = call_user_func(array(&$class, $method), $params);
		//return $response;
	}
}
?>
