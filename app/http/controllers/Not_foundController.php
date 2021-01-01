<?php

/**
* Not_found Controller
*/
class Not_foundController extends Controller
{
	static function show($error) {
		$notFound = new Not_foundController();
		$notFound->not_found($error);
	}
	/**
	* Not Found method
	* This method will be called on When page hase error like 403, 404 etc.
	**/
	protected function not_found($error)
	{
		$this->commons = new CommonsController();
		/*Get SUer name and role*/
		$data = $this->commons->getUser();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;

		if ($error === '403') {
			$this->view->render('not_found/403.tpl', $data );
		}
		else {
			$this->view->render('not_found/404.tpl', $data );
		}
	}
}