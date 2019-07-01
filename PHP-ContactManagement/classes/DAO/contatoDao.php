<?php

require_once '../classes/Crud.php';
require_once '../classes/Dominio/Contatos.php';
require_once '../classes/Dominio/Foto.php';

class ContatoDao extends Crud{
    
    protected $table = 'contatos';

    public function insert($contato, $foto){
		$sql  = "INSERT INTO $this->table (nome, apelido, email, dtnasc, idTipo) VALUES (:nome, :apelido, :email, :dtnasc, :idTipo)";
        
		$stmt = DB::prepare($sql);
		$stmt->bindValue(':nome', $contato->getNome());
		$stmt->bindValue(':email', $contato->getEmail());
		$stmt->bindValue(':apelido', $contato->getApelido());
		$stmt->bindValue(':dtnasc', $contato->getDtnasc());
		$stmt->bindValue(':idTipo', $contato->getTipoContato());
		$stmt->execute(); 

		$sql2 ="SELECT MAX(id) as id FROM $this->table";
        $stmt2 = DB::prepare($sql2);
        $stmt2->execute();
		$dado = $stmt2->fetch();
		
		$sql4 = "INSERT INTO foto (nome, tipo, tamanho, conteudo, idCont) VALUES (:nome, :tipo, :tamanho, :conteudo, :idCont)";
		$stmt4 = DB::prepare($sql4);
		$stmt4->bindValue(':nome', $foto->getNome());
		$stmt4->bindValue(':tipo', $foto->getTipo());
		$stmt4->bindValue(':tamanho', $foto->getTamanho());
		$stmt4->bindValue(':conteudo', $foto->getConteudo());
		$stmt4->bindValue(':idCont', $dado->id);
		$stmt4->execute();
        
        foreach($contato->getTelefone() as $value){
			$sql3 = "INSERT INTO telefones (id_cont, telefone) VALUES (:id_cont, :telefone)";
			$stmt3 = DB::prepare($sql3);
				$stmt3->bindValue(':id_cont', $dado->id);
				$stmt3->bindValue(':telefone', $value);
				$stmt3->execute();
		}
        return true;
	}
       
	public function update($contato, $foto, $id){

		$sql  = "UPDATE $this->table 
                SET 
                nome = :nome, 
                email = :email, 
                apelido = :apelido, 
                dtnasc = :dtnasc,
                idTipo = :idTipo
                WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindValue(':nome', $contato->getNome());
		$stmt->bindValue(':email', $contato->getEmail());
		$stmt->bindValue(':apelido', $contato->getApelido());
		$stmt->bindValue(':dtnasc', $contato->getDtnasc());
        $stmt->bindValue(':idTipo', $contato->getTipoContato());
		$stmt->bindValue(':id', $id);
		return $stmt->execute();

		$sql4 = "UPDATE foto 
				SET 
				nome = :nome, 
                tipo = :tipo, 
                tamanho = :tamanho, 
                conteudo = :conteudo
				WHERE idCont = :id";
		$stmt4 = DB::prepare($sql4);
		$stmt4->bindValue(':nome', $foto->getNome());
		$stmt4->bindValue(':tipo', $foto->getTipo());
		$stmt4->bindValue(':tamanho', $foto->getTamanho());
		$stmt4->bindValue(':conteudo', $foto->getConteudo());
		$stmt4->bindValue(':idCont', $dado->id);
		$stmt4->execute();

	}
    
    public function delete($id){
		$sql  = "DELETE FROM $this->table WHERE id = :id;
                 DELETE FROM telefones WHERE id_cont = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		return $stmt->execute(); 
	}
    
	public function findAllTels($id){
		$sql  = "SELECT telefone FROM telefones WHERE id_cont = :id";
		$stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function deleteTelefone($telefone){
		$sql = "DELETE FROM telefones WHERE telefone = :telefone";
		$stmt = DB::prepare($sql);
		$stmt->bindValue(':telefone', $telefone);
		return $stmt->execute(); 
	}

	public function graficoTeste(){
		$sql = "SELECT count(idTipo) as qtddtipo, t.nome as nome
				FROM contatos c
				JOIN tipocontatos t
				ON c.idTipo = t.id
				GROUP BY t.nome";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

	}
}

?>