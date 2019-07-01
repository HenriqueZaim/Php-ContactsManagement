<?php

require_once '../classes/Crud.php';
require_once '../classes/Dominio/TipoContato.php';

class ArquivoDao extends Crud{
    
    protected $table = 'upload';

    public function insert($arquivo){
		$sql  = "INSERT INTO $this->table (nome, tipo, tamanho, conteudo) VALUES (:nome, :tipo, :tamanho, :conteudo)";
		$stmt = DB::prepare($sql);
        $stmt->bindValue(':nome', $arquivo->getNome());
        $stmt->bindValue(':tipo', $arquivo->getTipo());
        $stmt->bindValue(':tamanho', $arquivo->getTamanho());
        $stmt->bindValue(':conteudo', $arquivo->getConteudo());
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


