<?php

require_once '../classes/DAO/arquivoDao.php';

class Arquivo{
	
	protected $table = 'upload';
    private $nome;
    private $tipo;
    private $tamanho;
    private $conteudo;

	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getNome(){
		return $this->nome;
    }
    
    public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function getTipo(){
		return $this->tipo;
    }
    
    public function setTamanho($tamanho){
		$this->tamanho = $tamanho;
	}
	
	public function getTamanho(){
		return $this->tamanho;
    }
    
    public function setConteudo($conteudo){
		$this->conteudo = $conteudo;
	}
	
	public function getConteudo(){
		return $this->conteudo;
	}

	

}