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
		// Exclui imagens do anuncio
		$this->excluirAnunciosImagens($id);

		// Exclui o anuncio
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			return true;
		} else {
			//return false;
			echo "erro";
		}
	}

	public function excluirAnunciosImagens($id_anuncio)
	{
		//echo "<img src='/assets/images/anuncios/64be2b2cfa6df4cb8a01db46d3f66419.jpg'";


		// Deleta imagem
		$imagens = $this->getImagensAnuncio($id_anuncio);
		//$path = BASE_URL."assets/images/anuncios/";

			$filename = '/caminho/para/arquivo.txt';

			if (file_exists($filename)) {
			    echo "O arquivo $filename existe";
			} else {
			    echo "O arquivo $filename não existe";
			}

		$path = "../../assets/images/anuncios/";
		foreach ($imagens as $key => $value) {
			$caminho = $path.$value['filename'];
			//echo $caminho." <br />";
			//echo "<img src='$caminho' /><br />";
			//unlink($caminho);
			
		}
		// Detela imagem do banco de dados		
		/*
		$sql = "DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			echo "imagens apagada";
		} else {
			echo "Erro ao apagar imagem";
		}
		*/
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