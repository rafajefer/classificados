<?php 

abstract class AnunciosImagens extends Model {

	//protected $table ='anuncios_imagens';
	protected $table_pai = 'anuncios_imagens';


	/* Insere imagen no banco */
	public function AddImagens($fotos, $id_anuncio)
	{
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

					$sql = "INSERT INTO $this->table_pai SET id_anuncio = :id_anuncio, url = :url";
					$stmt = $this->db->prepare($sql);
					$stmt->bindValue(":id_anuncio", $id_anuncio);
					$stmt->bindValue(":url", $tmpname);
					$stmt->execute();

				}
			}
		}
		return true;
	}
	/* Busca todas as imagens do Anuncio via id_anuncio */
	public function getImagensAnuncio($id_anuncio) 
	{
		$array = array();
		$sql = "SELECT id, url as filename FROM $this->table_pai WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			$array = $stmt->fetchAll();
		}
		return $array;
		
	}

	/* Excluir imagem do diretório e do banco */
	public function excluirAnunciosImagens($id_anuncio)
	{
		// Busca imagens do banco
		$imagens = $this->getImagensAnuncio($id_anuncio);
			
		// Encontra todas imagens relacionada com anuncio no diretório e excluir todas 		
		$path = "assets/images/anuncios/";
		foreach ($imagens as $key => $value) {
			$caminho = $path.$value['filename'];
			if (file_exists($caminho)) {
			    unlink($caminho);
			}			
		}

		// Em seguida detela imagem do banco de dados			
		$sql = "DELETE FROM $this->table_pai WHERE id_anuncio = :id_anuncio";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_anuncio", $id_anuncio);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}		
	}
}