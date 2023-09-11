<?php
require_once 'model/Categoria.php';
require_once 'view/categoria.php';

# Removendo 'categoria' da array $url;
array_shift($url);

function get($consulta){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();
    if(count($consulta) == 1 && $consulta[0] == ""){
        $categorias = $categoria->consultar();
        $viewCategoria->exibirCategorias($categorias);
    }
    elseif(count($consulta) == 1){
        $categoria = $categoria->consultarPorId($consulta[0]);
        $viewCategoria->exibirCategoria($categoria);
    }    
    elseif(count($consulta) == 2 && $consulta[0] == "tipo"){       
        $categorias = $categoria->consultar($consulta[1]);
        $viewCategoria->exibirCategorias($categorias);
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

function post($dados_categoria){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();
    $categoria->tipo     = $dados_categoria->tipo;
    $categoria->icone    = $dados_categoria->icone;    
    $viewCategoria->exibirCategoria($categoria->cadastrar());
}

function delete($registro){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();
    $result = false;
    $erro = "";
    if($categoria->excluir($registro)){
        $result = true;
    }
    else{
        $erro = $categoria->getErro();
    }
    $viewCategoria->deleteCategoria($result, $erro);

}

function put($registro, $dados_categoria){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();
    $categoria->id       = $registro;
    $categoria->tipo     = $dados_categoria->tipo;
    $categoria->icone    = $dados_categoria->icone;   
    $viewCategoria->exibirCategoria($categoria->alterar());
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