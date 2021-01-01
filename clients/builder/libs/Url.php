<?php


/**
* 
*/
class Url
{

	public function __construct() {
		$this->get = $this->clean($_GET);
		$this->post = $this->clean($_POST);
		$this->request = $this->clean($_REQUEST);
		$this->cookie = $this->clean($_COOKIE);
		$this->files = $this->clean($_FILES);
		$this->server = $this->clean($_SERVER);
	}

	public function clean($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);

				$data[$this->clean($key)] = $this->clean($value);
			}
		} else {
			$data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
		}

		return $data;
	}
	
	public function post($key)
	{
		return (isset($_POST[$key])) ?  $this->clean($_POST[$key]) : false;
	}

	public function get($key)
	{
		return (isset($_GET[$key])) ?  Urldecode($_GET[$key]) : false;
	}

	public function request($key)
	{
		if (url::get($key)) {
			return url::get($key);
		} elseif (url::post[$key]) {
			return url::post($key);
		} else{
			return false;;
		}
	}

	public function build($url, $params = array())
	{
		if(strpos($url, '//')  === false ) {
			$prefix = '//'.$GLOBALS['config']['domain'];
		} else {
			$prefix = '';
		}
		$append = '';
		foreach ($params as $key => $param) {
			$append .= ($append == '') ? '?' : '&' ;
			$append .= Urlencode($key). '='.Urlencode($param);
		}
		return $prefix.$append;
	}

	public function redirect($to, $exit = true)
	{
		if (headers_sent()) {
			echo '<script>window.location ='. URL_CLIENTS . DIR_ROUTE . $to .'</script>';
		} else {
			header('location:'.URL_CLIENTS.DIR_ROUTE.$to);
		}

		if ($exit) {
			die('Redirection Failed!');
		}
	}
}