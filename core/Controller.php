<?php 

abstract class Controller {

	// Carrega a view
	protected function loadView($viewName, $viewData = array())
	{
		// Transforma chave do array em variável
		extract($viewData);
		require 'views/'.$viewName.'.php';
	}

	// Carrega view dentro do template padrão
	protected function loadTemplate($viewName, $viewData = array())
	{
		// Transforma chave do array em variável
		extract($viewData);
		require 'views/template.php';
	}
}