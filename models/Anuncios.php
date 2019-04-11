<?php 

class Anuncios extends Model {

	private $table = 'anuncios';

	/* Busca todos os anuncios e suas imagens */
	public function getMeusAnuncios()
	{
		$sql = "SELECT *, 
		(SELECT anuncios_imagens.url FROM anuncios_imagens WHERE anuncios_imagens.id_anuncio = anuncios.id LIMIT 1) as url 
		FROM $this->table 
		WHERE id_usuario = :id_usuario ORDER BY anuncios.titulo ASC";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_usuario", $_SESSION['cLogin']);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Busca anuncio pelo $id*/
	public function getAnuncio($id)
	{
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id);
		$stmt->execute();

		return $stmt->fetch();
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

	/* Editar anuncio pelo $id */
	public function editarAnuncios($id, $categoria, $titulo, $descricao, $valor, $estado, $fotos)
	{
		$sql = "UPDATE $this->table SET id_categoria = :categoria, titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado, updated_at = NOW() WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id);
		$stmt->bindValue(":categoria", $categoria);
		$stmt->bindValue(":titulo", $titulo);
		$stmt->bindValue(":descricao", $descricao);
		$stmt->bindValue(":valor", $valor);
		$stmt->bindValue(":estado", $estado);
		$stmt->execute();

		/*
		if($stmt->rowCount() > 0){
			return true;
		} else {
			return false;
		}
		*/
		// Verifica se foi enviada alguma imagem
		if(count($fotos) > 0) {
			// percorre as imagens enviadas
			for($q=0;$q<count($fotos['tmp_name']);$q++) {
				// Cria um array para guarda os tipos das imagens
				$tipo = $fotos['type'][$q];
				// Verifica se extensao das imagens são jpeg ou png
				if(in_array($tipo, array('image/jpeg', 'image/png'))) {
					// Cria um nome aleatoria para imagem e define sua extensao jpg
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					// Move a imagem para a pasta indicada
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/anuncios/'.$tmpname);

					// Guarda as dimensoes da imagem nas variaveis da list
					list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/'.$tmpname);
					$ratio = $width_orig/$height_orig;
					// Tamanho máximo das imagens
					$width = 500;
					$height = 500;

					// Verifica se imagem enviada é maior que tamanho maximo
					if($width/$height > $ratio) {
						$width = $height*$ratio;
					} else {
						$height = $width/$ratio;
					}

					// Cria imagem
					$img = imagecreatetruecolor($width, $height);
					// Verifica se o tipo é jpeg
					if($tipo == 'image/jpeg') {
						// Cria imagem jpeg
						$origi = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
					} elseif($tipo == 'image/png') {
						// Cria imagem png
						$origi = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
					}

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
					imagejpeg($img, 'assets/images/anuncios/'.$tmpname, 80);

					$sql = "INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url";
					$stmt = $this->db->prepare($sql);
					$stmt->bindValue(":id_anuncio", $id);
					$stmt->bindValue(":url", $tmpname);
					$stmt->execute();
				}
			}
			echo "<pre>";
			print_r($fotos);
			echo "</pre>";
			exit;
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
		//$path = "/home/ieatprof/public_html/classificados.ieatprofissionalizante.com.br/assets/images/anuncios/";
		$path = "assets/images/anuncios/";
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
	/* Busca todas as imagens do Anuncio via id_anuncio 
	public function getImagensAnuncio($id_anuncio)
	{
		//$sql = "SELECT * FROM anuncios_imagens INNER JOIN anuncios ON anuncios_imagens.id_anuncio = anuncios.id WHERE id_anuncio = :id_anuncio";
		$sql = "SELECT id, url as filename FROM anuncios_imagens INNER JOIN anuncios ON anuncios_imagens.id_anuncio = anuncios.id WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return $stmt->fetchAll();
		} else {
			return false;
		}

	}*/

	public function getImagensAnuncio($id_anuncio) 
	{
		$sql = "SELECT id, url as filename FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function teste()
	{
		return 13;
	}



}