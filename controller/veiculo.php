<?php
require_once 'model/Veiculo.php';
require_once 'view/Veiculo.php';

# Removendo 'veiculo' da array $url;
array_shift($url);

function get($consulta){
    $veiculo = new Veiculo();
    $viewVeiculo = new ViewVeiculo();
    if(count($consulta) == 1 && $consulta[0] == ""){
        $veiculos = $veiculo->consultar();
        $viewVeiculo->exibirVeiculos($veiculos);
    }
    elseif(count($consulta) == 1){
        $veiculo = $veiculo->consultarPorId($consulta[0]);
        $viewVeiculo->exibirVeiculo($veiculo);
    }    
    elseif(count($consulta) == 2 && $consulta[0] == "modelo"){       
        $veiculos = $veiculo->consultar($consulta[1]);
        $viewVeiculo->exibirVeiculos($veiculos);
    }
    else{
        $codigo_resposta = 404;
        $erro = [
            'result'=>false,
            'erro'  => 'Erro: 404 - Recurso não encontrado'
        ];
        require_once 'view/erro404.php';
    }   
} 

function post($dados_veiculo){
    $veiculo = new Veiculo();
    $viewVeiculo = new ViewVeiculo();
    $veiculo->modelo            = $dados_veiculo->modelo;
    $veiculo->ano_fabricacao    = $dados_veiculo->ano_fabricacao;
    $veiculo->ano_modelo        = $dados_veiculo->ano_modelo;
    $veiculo->cor               = $dados_veiculo->cor;
    $veiculo->num_portas        = $dados_veiculo->num_portas;
    $veiculo->foto              = $dados_veiculo->foto;
    $veiculo->categoria_id      = $dados_veiculo->categoria_id;
    $veiculo->montadora_id      = $dados_veiculo->montadora_id;
    $veiculo->tipo_cambio       = $dados_veiculo->tipo_cambio;
    $veiculo->tipo_direcao      = $dados_veiculo->tipo_direcao;    
    $viewVeiculo->exibirVeiculo($veiculo->cadastrar());
}

function delete($registro){
    $veiculo = new Veiculo();
    $viewVeiculo = new ViewVeiculo();
    $result = false;
    $erro = "";
    if($veiculo->excluir($registro)){
        $result = true;
    }
    else{
        $erro = $veiculo->getErro();
    }
    $viewVeiculo->deleteVeiculo($result, $erro);

}

function put($registro, $dados_veiculo){
    $veiculo = new Veiculo();
    $viewVeiculo = new ViewVeiculo();
    $veiculo->id                = $registro;
    $veiculo->modelo            = $dados_veiculo->modelo;
    $veiculo->ano_fabricacao    = $dados_veiculo->ano_fabricacao;
    $veiculo->ano_modelo        = $dados_veiculo->ano_modelo;
    $veiculo->cor               = $dados_veiculo->cor;
    $veiculo->num_portas        = $dados_veiculo->num_portas;
    $veiculo->foto              = $dados_veiculo->foto;
    $veiculo->categoria_id      = $dados_veiculo->categoria_id;
    $veiculo->montadora_id      = $dados_veiculo->montadora_id;
    $veiculo->tipo_cambio       = $dados_veiculo->tipo_cambio;
    $veiculo->tipo_direcao      = $dados_veiculo->tipo_direcao;    
    $viewVeiculo->exibirVeiculo($veiculo->alterar());
}

switch($method){    
    // case "GET":get(@$url[0],@$url[1]);
    case "GET":get($url);
    break;
    case "POST":post($dadosRecebidos);
    break;
    case "PUT":put(@$url[0],$dadosRecebidos);
    break;
    case "DELETE":delete(@$url[0]);
    break;
    default:{
        echo json_encode(["method"=>"ERRO"]);
    }
    break;
}