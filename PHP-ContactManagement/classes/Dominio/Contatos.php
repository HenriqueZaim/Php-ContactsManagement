<?php

require_once '../classes/DAO/contatoDao.php';

class Contatos{
	
	protected $table = 'contatos';
	private $nome;
	private $email;
	private $apelido;
	private $dtnasc;
	private $tipoContato;
	private $telefones = array();
	
	public function setTelefone(array $telefones){
		$this->telefones = $telefones;
	}
	
    public function getTelefone(){
		return $this->telefones;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setApelido($apelido){
		$this->apelido = $apelido;
	}
		
	public function setDtnasc($dtnasc){
		$this->dtnasc = $dtnasc;
	}
    
    public function setTipoContato($tipoContato){
        $this->tipoContato = $tipoContato;
	}
		
	public function getNome(){
		return $this->nome;
	}

	public function getEmail(){
		return $this->email;
	}
	
	public function getApelido(){
		return $this->apelido;
	}
	
	public function getDtnasc(){
		return $this->dtnasc;
	}
    
    public function getTipoContato(){
        return $this->tipoContato;
	}

}