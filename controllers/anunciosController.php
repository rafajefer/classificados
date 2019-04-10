<?php

class anunciosController extends Controller {

	public function index()
	{
		// Verifica se existe usuário logado
		$this->verificarSessao();

		$a = new Anuncios();

		$data['anuncios'] = $a->getMeusAnuncios();;
		$this->loadTemplate('anuncios', $data);
	}

	public function adicionar()
	{
		// Verifica se usuário está logado
		$this->verificarSessao();
		
		$c = new Categorias();


		$data['categorias'] = $c->getCategorias();
		$this->loadView('anuncio-adicionar', $data);
		
		
	}
	// Add novo anuncio
	public function insert()
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

	// Carrega informações do anuncio pelo $id
	public function editar($id = null)
	{	

		// Verifica se usuário está logado
		$this->verificarSessao();

		if(!empty($id)) {

			$a = new Anuncios();
			$c = new Categorias();

			$data['anuncio'] = $a->getAnuncio($id);
			$data['categorias'] = $c->getCategorias();
			$this->loadView('anuncio-editar', $data);
		} else {
			header("Location: ".BASE_URL."anuncios");
			exit;
		}
	}
	public function update()
	{
		// Verifica se usuário está logado
		$this->verificarSessao();

		$a = new Anuncios();

		$id = $_POST['id'];
		$categoria = $_POST['categoria'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$valor = $_POST['valor'];
		$estado = $_POST['estado'];
		
		if($a->editarAnuncios($id, $categoria, $titulo, $descricao, $valor, $estado)) {
			header("Location: ".BASE_URL."anuncios");
			exit;
		}
	}

	// Exclui anuncio pelo $id
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