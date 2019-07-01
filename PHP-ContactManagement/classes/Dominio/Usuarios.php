<?php

require_once '../classes/DAO/usuarioDao.php';

class Usuarios{
	
    protected $table = 'usuarios';
	private $nome;
	private $email;
	private $senha;
    
    public function getTable(){
        return $this->table;
    }

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getNome(){
		return $this->nome;
	}

	public function getEmail(){
		return $this->email;
	}
	
	public function getSenha(){
		return $this->senha;
	}
    

}