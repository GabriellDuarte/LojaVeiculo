<?php
class ViewCategoria{

    public function exibir($retorno){
        echo json_encode($retorno);
    }
    
    public function exibirCategorias($categorias){
        if($categorias){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $categorias;
            $retorno["itens"] = count($categorias);
        }
        else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno["dados"] = [];
            $retorno["itens"] = 0;
            $retorno['info'] = "Nenhum resultado correspondente para esta consulta.";
        }
        $this->exibir($retorno);
    }

    public function exibirCategoria($categoria){
        if($categoria){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $categoria;
            $retorno["itens"] = 1;
        }
        else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno["dados"] = '';
            $retorno["itens"] = 0;
            $retorno['info'] = "Nenhum resultado correspondente para esta consulta.";
        }
        $this->exibir($retorno);
    }

    public function deleteCategoria($result, $erro){
        if($result){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["info"] = "Registro deletado com sucesso";
            $retorno["itens"] = 0;
        }
        else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno['erro'] = is_null($erro)?"Registro não encontrado":$erro;
        }
        $this->exibir($retorno);
    }
}