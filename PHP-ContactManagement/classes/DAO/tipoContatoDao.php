<?php

require_once '../classes/Crud.php';
require_once '../classes/Dominio/TipoContato.php';

class TipoContatoDao extends Crud{
    
    protected $table = 'tipocontatos';

    public function insert($tipo){
		$sql  = "INSERT INTO $this->table (nome) VALUES (:nome)";
		$stmt = DB::prepare($sql);
		$stmt->bindValue(':nome', $tipo->getNome());
		return $stmt->execute(); 
	}

	public function update($tipo,$id){

		$sql  = "UPDATE $this->table SET nome = :nome WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $tipo->getNome());
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}    
}

?>


