<?php 

class Categorias extends Model {

	private $table = 'categorias';

	/* Busca todas as categorias */
	public function getCategorias()
	{
		$array = array();
		$sql = "SELECT * FROM $this->table";
		$stmt = $this->db->query($sql);
		if($stmt->rowCount() > 0) {
			$array = $stmt->fetchAll();			
		}
		return $array;
	}
}