<?php 

class Core {

	public function run()
	{
		// Verifica se $_GET['url'] existe
		$url = (isset($_GET['url'])) ? '/'.$_GET['url'] : '/';

		$params = array();

		if(!empty($url) && $url != '/') {

			$url = explode('/', $url);

			// Remove indice 0 que está vázio
			array_shift($url);

			// Concatena Valor do $url[0].'Controller' ex: galeriaController
			$currentController = $url[0].'Controller';

			// Remove indice referente ao [$valor]Controller
			array_shift($url);

			// Verifica se foi passado um action ou método
			if(isset($url[0]) && !empty($url[0])) {

				// Valor $url[0] ref.: método do controller
				$currentAction = $url[0];
				array_shift($url);
			} else {
				// Chama método padrão index()
				$currentAction = 'index';
			}

			// Se ainda existir indice no array $url
			// Passa para array params
			if(count($url) > 0) {
				$params = $url;
			}
		} else {
			// S~e não for passado nada na url, define controller e método padrão
			$currentController = 'homeController';
			$currentAction = 'index';
		}
		/*
		echo "CONTROLLER: ".$currentController."<br />";
		echo "ACTION: ".$currentAction."<br />";
		echo "PARAMS: ".print_r($params);
		*/

		// Instancia o controller
		$c = new $currentController();

		call_user_func_array(array($c, $currentAction), $params);
	}
}