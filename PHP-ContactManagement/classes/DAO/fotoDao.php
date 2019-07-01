<?php

require_once '../classes/Crud.php';
require_once '../classes/Dominio/Usuarios.php';

class FotoDao extends Crud{
    
    protected $table = 'foto';

    public function findContImg($id){
		$sql  = "SELECT * FROM foto WHERE idCont = :id";
		$stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
    
}

?>
	
	
	