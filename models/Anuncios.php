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
}