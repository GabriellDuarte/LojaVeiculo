<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
$arquivos = $_FILES;
foreach ($arquivos as $chave => $valor) {
    var_dump($valor);
}
class Upload {
    private $arquivo;
    private $dir_destino;

    function __construct($arquivo,$dir_destino){
        $this->arquivo = $arquivo;
        $this->dir_destino   = $dir_destino;
    }
		
    private function getExtensao(){        
        $ext = explode('.', $this->arquivo['name']);
        return $extensao = strtolower(end($ext));
    }
		
    private function ehImagem($extensao){
        $extensoes = array('gif','jpeg','jpg','png', 'gif','webp');	 // extensoes permitidas
        if (in_array($extensao, $extensoes)){
            return true;
        }                
        else{
            return false;
        }                
    }
    
		
    public function salvarImagem(){									
        $extensao = $this->getExtensao();
        if($this->ehImagem($extensao)){            
            $novo_nome = time().".$extensao";            
            $destino = "$this->dir_destino/$novo_nome";
            if (!move_uploaded_file($this->arquivo['tmp_name'], $destino)){
                if ($this->arquivo['error'] == 1){
                    return "Tamanho excede o permitido";
                }
                else{
                    return "Erro " . $this->arquivo['error'];
                }           
            }			
            if ($this->ehImagem($extensao)){												
                list($tipo, $atributo) = getimagesize($destino);//pega a largura, altura, tipo e atributo da imagem
            }
            return $destino;				
        }
        
    }
}
