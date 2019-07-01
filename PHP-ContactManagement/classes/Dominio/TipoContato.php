<?php

require_once '../classes/DAO/tipoContatoDao.php';

class TipoContato{
	
	protected $table = 'tipocontatos';
	private $nome;

	public function setNome($nome){
		$this->nome = $nome;
	}
		
	public function getNome(){
		return $this->nome;
	}

}