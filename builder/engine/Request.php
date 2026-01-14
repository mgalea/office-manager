<?php

/**
* 
*/
class Request
{
	public static function uri()
	{
		if (isset($_GET['route'])) {
			return trim($_GET['route'], '/');
		}
		$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$path = parse_url($uri, PHP_URL_PATH);
		$path = is_string($path) ? trim($path, '/') : '';
		$base = '';
		if (defined('URL')) {
			$base_path = parse_url(URL, PHP_URL_PATH);
			$base = is_string($base_path) ? trim($base_path, '/') : '';
		}
		if ($base !== '' && strpos($path, $base) === 0) {
			$path = ltrim(substr($path, strlen($base)), '/');
		}
		if (strpos($path, 'index.php') === 0) {
			$path = ltrim(substr($path, strlen('index.php')), '/');
		}
		if (strpos($path, '&') !== false) {
			list($route, $param_string) = explode('&', $path, 2);
			$path = $route;
			if (!empty($param_string)) {
				parse_str($param_string, $params);
				if (is_array($params)) {
					foreach ($params as $key => $value) {
						if (!isset($_GET[$key])) {
							$_GET[$key] = $value;
						}
					}
				}
			}
		}
		return $path === '' ? 'login' : $path;
	}

	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}
