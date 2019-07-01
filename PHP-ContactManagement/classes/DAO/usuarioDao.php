<?php

require_once '../classes/Crud.php';
require_once '../classes/Dominio/Usuarios.php';

class UsuarioDao extends Crud{
    
    protected $table = 'usuarios';

    public function insert($usuario){
		
            $sql  = "INSERT INTO $this->table (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            return $stmt->execute();
        
	}

	public function update($usuario, $id){

		$sql  = "UPDATE $this->table SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindValue(':nome', $usuario->getNome());
		$stmt->bindValue(':email', $usuario->getEmail());
		$stmt->bindValue(':senha', $usuario->getSenha());
		$stmt->bindParam(':id', $id);
		return $stmt->execute();

	}
    
    
}

?>
	
	
	