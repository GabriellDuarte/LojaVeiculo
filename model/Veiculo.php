<?php
require_once "BaseDeDados.php";
class Veiculo {
    public $id;
    public $modelo;
    public $ano_fabricacao;
    public $ano_modelo;
    public $cor;
    public $num_portas;
    public $foto;
    public $categoria_id;
    public $montadora_id;
    public $tipo_cambio;
    public $tipo_direcao;
    public $data_cadastro;
    public $data_alteracao;

    private $erro;

    public function getErro(){
        return $this->erro;
    }

    private function cx(){
        return (new BaseDeDados())->getConexao();
    }
     
    public function cadastrar(): bool | Veiculo {
        try {
            $cmdSql = 'INSERT INTO veiculo(modelo,ano_fabricacao,ano_modelo,cor,num_portas,foto,categoria_id,montadora_id,tipo_cambio,tipo_direcao) VALUES (:modelo,:ano_fabricacao,:ano_modelo,:cor,:num_portas,:foto,:categoria_id,:montadora_id,:tipo_cambio,:tipo_direcao)';
            $pdo = $this->cx();
            $cx_declarada = $pdo->prepare($cmdSql);
            $cx_declarada->bindParam('modelo', $this->modelo);            
            $cx_declarada->bindParam('ano_fabricacao', $this->ano_fabricacao);            
            $cx_declarada->bindParam('ano_modelo', $this->ano_modelo);            
            $cx_declarada->bindParam('cor', $this->cor);            
            $cx_declarada->bindParam('num_portas', $this->num_portas);            
            $cx_declarada->bindParam('foto', $this->foto);            
            $cx_declarada->bindParam('categoria_id', $this->categoria_id);            
            $cx_declarada->bindParam('montadora_id', $this->montadora_id);            
            $cx_declarada->bindParam('tipo_cambio', $this->tipo_cambio);            
            $cx_declarada->bindParam('tipo_direcao', $this->tipo_direcao);      
            $cx_declarada->execute();
            return $this->consultarPorId($pdo->lastInsertId());
        } catch (\PDOException $e) {
            $this->erro = "Erro ao cadastrar veículo: " . $e->getMessage();
            return false;
        }
    }

    public function alterar() {
		try {
            $cmdSql = 'UPDATE veiculo SET modelo = :modelo ,ano_fabricacao = :ano_fabricacao ,ano_modelo = :ano_modelo ,cor = :cor ,num_portas = :num_portas ,foto = :foto ,categoria_id = :categoria_id ,montadora_id = :montadora_id ,tipo_cambio = :tipo_cambio ,tipo_direcao = :tipo_direcao WHERE veiculo.id = :id';
            $pdo = $this->cx();
            $cx_declarada = $pdo->prepare($cmdSql);
            $cx_declarada->bindParam('modelo', $this->modelo);            
            $cx_declarada->bindParam('ano_fabricacao', $this->ano_fabricacao);            
            $cx_declarada->bindParam('ano_modelo', $this->ano_modelo);            
            $cx_declarada->bindParam('cor', $this->cor);            
            $cx_declarada->bindParam('num_portas', $this->num_portas);            
            $cx_declarada->bindParam('foto', $this->foto);            
            $cx_declarada->bindParam('categoria_id', $this->categoria_id);            
            $cx_declarada->bindParam('montadora_id', $this->montadora_id);            
            $cx_declarada->bindParam('tipo_cambio', $this->tipo_cambio);            
            $cx_declarada->bindParam('tipo_direcao', $this->tipo_direcao);  
            $cx_declarada->bindParam(':id', $this->id);
            $cx_declarada->execute();
            return $this->consultarPorId($this->id);
        } catch (PDOException $e) {
            $this->erro = "Erro ao alterar veículo: " . $e->getMessage();
            return false;
        }
    }

    public function excluir($id) {
		try {
            $cmdSql = 'DELETE FROM veiculo WHERE veiculo.id = :id';
            $cx_declarada = $this->cx()->prepare($cmdSql);
            $cx_declarada->bindParam(':id', $id);            
            $cx_declarada->execute();
            return ($cx_declarada->rowCount() != 0);
        } catch (PDOException $e) {
            $this->erro = ["Erro ao excluir veículo", "Código do erro: {$e->getCode()}", "{$e->getMessage()}"];
            return false;
        }
    }

    public function consultar($filtro='') {
        try {
            $query = "SELECT * FROM veiculo WHERE modelo LIKE :filtro";
            $stmt = $this->cx()->prepare($query);
            $stmt->bindValue(':filtro', '%'.$filtro.'%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        } catch (PDOException $e) {
            echo "Erro ao consultar montadora por nome: " . $e->getMessage();
            return false;
        }
    }


    private function carregar(Veiculo $v){
        $this->id             = $v->id;
        $this->modelo         = $v->modelo;
        $this->ano_fabricacao = $v->ano_fabricacao;
        $this->ano_modelo     = $v->ano_modelo;
        $this->cor            = $v->cor;
        $this->num_portas     = $v->num_portas;
        $this->foto           = $v->foto;
        $this->categoria_id   = $v->categoria_id;
        $this->montadora_id   = $v->montadora_id;
        $this->tipo_cambio    = $v->tipo_cambio;
        $this->tipo_direcao   = $v->tipo_direcao;
        $this->data_cadastro  = $v->data_cadastro;
        $this->data_alteracao = $v->data_alteracao;
    }

    public function consultarPorId($id) {
        try {
            $cmdSql = "SELECT * FROM veiculo WHERE veiculo.id = :id";
            $cx_declarada = $this->cx()->prepare($cmdSql);
            $cx_declarada->bindParam('id', $id);          
            $cx_declarada->execute();
            $cx_declarada->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
            return $cx_declarada->fetch();           
        } catch (\PDOException $e) {
            $this->erro = "Erro ao consultar categoria: " . $e->getMessage();
            return false;
        }
    }
}
