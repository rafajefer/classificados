<?php 

class Anuncios extends Model {

	private $table = 'anuncios';

	/* Busca todos os anuncios e suas imagens */
	public function getMeusAnuncios()
	{
		$sql = "SELECT *, 
		(SELECT anuncios_imagens.url FROM anuncios_imagens WHERE anuncios_imagens.id_anuncio = anuncios.id LIMIT 1) as url 
		FROM $this->table 
		WHERE id_usuario = :id_usuario";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_usuario", $_SESSION['cLogin']);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Adicionar um novo anuncio */
	public function addAnuncios($categoria, $titulo, $descricao, $valor, $estado)
	{
		$sql = "INSERT INTO $this->table (id_usuario, id_categoria, titulo, descricao, valor, estado) VALUES (?,?,?,?,?,?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(1, $_SESSION['cLogin'], PDO::PARAM_INT);
		$stmt->bindValue(2, $categoria, PDO::PARAM_STR);
		$stmt->bindValue(3, $titulo);
		$stmt->bindValue(4, $descricao);
		$stmt->bindValue(5, $valor);
		$stmt->bindValue(6, $estado);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* Excluir anuncio */
	public function excluirAnuncios($id)
	{

		// Verifica se foi encontrada imagens no anuncio
		if($this->getImagensAnuncio($id)){

			// Se foi encontrada imagens então exclui
			$this->excluirAnunciosImagens($id);
		}

		// Em seguida exclui o anuncio
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

		
	}

	public function excluirAnunciosImagens($id_anuncio)
	{
		// Busca imagens do banco
		$imagens = $this->getImagensAnuncio($id_anuncio);
			
		// Encontra todas imagens relacionada com anuncio no diretório e excluir todas 
		$path = "/home/ieatprof/public_html/classificados.ieatprofissionalizante.com.br/assets/images/anuncios/";
		foreach ($imagens as $key => $value) {
			$caminho = $path.$value['filename'];
			if (file_exists($caminho)) {
			    unlink($caminho);
			}			
		}

		// Em seguida detela imagem do banco de dados			
		$sql = "DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	/* Busca todas as imagens do Anuncio via id_anuncio */
	public function getImagensAnuncio($id_anuncio)
	{
		//$sql = "SELECT * FROM anuncios_imagens INNER JOIN anuncios ON anuncios_imagens.id_anuncio = anuncios.id WHERE id_anuncio = :id_anuncio";
		$sql = "SELECT url as filename FROM anuncios_imagens INNER JOIN anuncios ON anuncios_imagens.id_anuncio = anuncios.id WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return $stmt->fetchAll();
		} 

	}

}