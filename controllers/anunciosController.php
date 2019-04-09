<?php

class anunciosController extends Controller {

	public function index()
	{
		// Verifica se existe usuário logado
		$this->verificarSessao();

		$a = new Anuncios();

		$data['anuncios'] = $a->getMeusAnuncios();
		$this->loadTemplate('anuncios', $data);
	}

	public function adicionar()
	{
		echo "teste";
	}
}