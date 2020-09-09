<?php
class Fornecedor {
    private $id;
    private $nome;
    private $endereco;
    private $telefone;
    private $categoria;
    private $cidade;
    private $estado;

    public function __construct(string $nome="", string $endereco="",string $telefone, string $categoria="", string $cidade="", string $estado="", string $nome="", int $id=-1) {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->categoria = $categoria;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }

    public function setId(int $id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setNome(string $nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setEndereco(string $endereco) {
        $this->endereco  = $endereco ;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setTelefone(string $telefone) {
        $this->telefone  = $telefone ;
    }

    public function getTelefone() {
        return $this->telefone;
    }
  
    public function setCategoria(string $categoria) {
        $this->categoria  = $categoria ;
    }

    public function getCategoria() {
        return $this->categoria;
    }


    public function setCidade(string $cidade) {
        $this->cidade  = $cidade ;
    }

    public function getCidade() {
        return $this->cidade;
    }
  
    public function setCidade(string $estado) {
        $this->estado  = $estado ;
    }

    public function getEstado() {
        return $this->estado;
    }
  
 
    

    
}