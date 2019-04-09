<?php

class anunciosController extends Controller {

	public function index()
	{
		// Verifica se existe usuário logado
		$this->verificarSessao();

		$a = new Anuncios();
		$c = new Categorias();

		$data['anuncios'] = $a->getMeusAnuncios();
		$data['categorias'] = $c->getCategorias();
		$this->loadTemplate('anuncios', $data);
	}

	// Add novo anuncio
	public function adicionar()
	{
		// Verifica se usuário está logado
		$this->verificarSessao();

		$categoria = $_POST['categoria'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$valor = $_POST['valor'];
		$estado = $_POST['estado'];

		$a = new Anuncios();
		if($a->addAnuncios($categoria, $titulo, $descricao, $valor, $estado)) {
			header("Location: ".BASE_URL."anuncios");
			exit;
		}
	}

	// Exclui anuncio
	public function excluir($id)
	{
		// Verifica se usuário está logado
		$this->verificarSessao();

		$a = new Anuncios();
		if($a->excluirAnuncios($id)) {
			header("Location: ".BASE_URL."anuncios");
			exit;
		}
	}

	public function imagem($id) 
	{
		$a = new Anuncios();
		$data['imagens'] = $a->excluirAnunciosImagens($id);
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}