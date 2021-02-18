<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";
include_once "../../domain/produto.php";

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nomeproduto) && !empty($data->descricao) && !empty($data->preco) && !empty($data->idfoto)){

    $produto->nomeproduto=$data->nomeproduto;
    $produto->descricao=$data->descricao;
    $produto->preco=$data->preco;
    $produto->idfoto=$data->idfoto;

    if($produto->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Produto cadastrado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível cadastrar"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>