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

	// Carrega os dados do form no modal
	public function adicionar()
	{
		// Verifica se usuário está logado
		$this->verificarSessao();
		
		$c = new Categorias();

		$data['categorias'] = $c->getCategorias();
		$this->loadView('anuncio-adicionar', $data);

		
	}
	// Add novo anuncio no banco de dados
	public function insert()
	{
		// Verifica se usuário está logado
		$this->verificarSessao();

		$a = new Anuncios();

		$categoria = $_POST['categoria'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$valor = $_POST['valor'];
		$estado = $_POST['estado'];
		if(isset($_FILES['fotos'])) {
			$fotos = $_FILES['fotos'];
		} else {
			$fotos = array();
		}

		if($a->addAnuncios($categoria, $titulo, $descricao, $valor, $estado, $fotos)) {
			header("Location: ".BASE_URL."anuncios");
			exit;
		}
	}

	// Carrega os dados do anuncio no modal
	public function editar($id = null)
	{	

		// Verifica se usuário está logado
		$this->verificarSessao();

		if(!empty($id)) {

			$a = new Anuncios();
			$c = new Categorias();

			$data['anuncio'] = $a->getAnuncio($id);
			$data['categorias'] = $c->getCategorias();
			$data['fotos'] = $a->getImagensAnuncio($id);
			$this->loadView('anuncio-editar', $data);
		} else {
			header("Location: ".BASE_URL."anuncios");
			exit;
		}
	}

	// Edita anuncio no banco de dados
	public function update()
	{
		// Verifica se usuário está logado
		$this->verificarSessao();

		$a = new Anuncios();

		// Recupera os dados do formulário
		$id = $_POST['id'];
		$categoria = $_POST['categoria'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$valor = $_POST['valor'];
		$estado = $_POST['estado'];

		// Verifica se alguma imagem foi enviada
		if(isset($_FILES['fotos'])) {
			$fotos = $_FILES['fotos'];
		} else {
			$fotos = array();
		}
		
		if($a->editarAnuncios($id, $categoria, $titulo, $descricao, $valor, $estado, $fotos)) {
			header("Location: ".BASE_URL."anuncios");
			exit;
		} else {
			echo "Erro no envio tente novamente mais tarde!";
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
}