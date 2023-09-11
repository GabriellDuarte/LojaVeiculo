<?php
require_once "BaseDeDados.php";
class Montadora {
    public $id;
    public $nome;
    public $logotipo;
    public $data_cadastro;
    public $data_alteracao;

    private $erro;

    public function getErro(){
        return $this->erro;
    }

    private function cx(){
        return (new BaseDeDados())->getConexao();
    }

    public function cadastrar(): bool | Montadora  {
        try {
            $cmdSql = "INSERT INTO montadora (nome, logotipo) VALUES (:nome, :logotipo)";
            $pdo = $this->cx();
            $cx_declarada = $pdo->prepare($cmdSql);
            $cx_declarada->bindParam(':nome', $this->nome);
            $cx_declarada->bindParam(':logotipo', $this->logotipo);    
            $cx_declarada->execute();        
            return $this->consultarPorId($pdo->lastInsertId());
        } catch (\PDOException $e) {
            $this->erro = "Erro ao cadastrar montadora: " . $e->getMessage();
            return false;
        }
    }

    public function alterar() {
		try {
            $cmdSql = "UPDATE montadora SET nome = :nome, logotipo = :logotipo WHERE montadora.id = :id";
            $pdo = $this->cx();
            $cx_declarada = $pdo->prepare($cmdSql);
            $cx_declarada->bindParam(':nome', $this->nome);
            $cx_declarada->bindParam(':logotipo', $this->logotipo);
            $cx_declarada->bindParam(':id', $this->id);
            $cx_declarada->execute();
            return $this->consultarPorId($this->id);
        } catch (PDOException $e) {
            $this->erro = "Erro ao alterar montadora: " . $e->getMessage();
            return false;
        }
    }

    public function excluir($id) {
		try {
            $cmdSql = 'DELETE FROM montadora WHERE montadora.id = :id';
            $cx_declarada = $this->cx()->prepare($cmdSql);
            $cx_declarada->bindParam(':id', $id);            
            $cx_declarada->execute();
            return ($cx_declarada->rowCount() != 0);
        } catch (PDOException $e) {
            $this->erro = ["Erro ao excluir montadora", "Código do erro: {$e->getCode()}", "{$e->getMessage()}"];
            return false;
        }
    }

    public function consultar($filtro="") {
        try {
            $cmdSql = "SELECT * FROM montadora WHERE montadora.nome LIKE :filtro";
            $cx_declarada = $this->cx()->prepare($cmdSql);
            $cx_declarada->bindValue(':filtro', '%'.$filtro.'%');          
            $cx_declarada->execute();
            $cx_declarada->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
            return $cx_declarada->fetchAll();
        } catch (\PDOException $e) {
            $this->erro = "Erro ao listar montadoras: " . $e->getMessage();
            return false;
        }
    }

    private function carregar(Montadora $m){
        $this->id = $m->id;
        $this->nome = $m->nome;
        $this->logotipo = $m->logotipo;
        $this->data_cadastro = $m->data_cadastro;
        $this->data_alteracao = $m->data_alteracao;
    }

    public function consultarPorId($id) {
        try {
            $cmdSql = "SELECT * FROM montadora WHERE montadora.id = :id";
            $cx_declarada = $this->cx()->prepare($cmdSql);
            $cx_declarada->bindParam('id', $id);          
            $cx_declarada->execute();
            $cx_declarada->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
            return $cx_declarada->fetch();           
        } catch (\PDOException $e) {
            $this->erro = "Erro ao consultar montadora: " . $e->getMessage();
            return false;
        }
    }
}