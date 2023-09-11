<?php
class ViewVeiculo{

    public function exibir($retorno){
        echo json_encode($retorno);
    }
    
    public function exibirVeiculos($veiculos){
        if($veiculos){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $veiculos;
            $retorno["itens"] = count($veiculos);
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

    public function exibirVeiculo($veiculo){
        if($veiculo){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $veiculo;
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

    public function deleteVeiculo($result, $erro){
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
