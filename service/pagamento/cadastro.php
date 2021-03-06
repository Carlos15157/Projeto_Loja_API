<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";
include_once "../../domain/pagamento.php";

$database = new Database();
$db = $database->getConnection();

$pagamento = new Pagamento($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->idcliente)){

$pagamento->idpagamento=$data->idpagamento;
$pagamento->idpedido=$data->idpedido;
$pagamento->tipo;=$data->tipo
$pagamento->descricao=$data->descricao;
$pagamento->valor=$data->valor;
$pagamento->parcelas=$data->parcelas;
$pagamento->valorparcela=$data->valorparcela;
$pagamento->idcliente=$data->idcliente;


    if($pagamento->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"pagamento cadastrado com sucesso!"));
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