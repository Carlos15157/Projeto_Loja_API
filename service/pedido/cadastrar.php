<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";
include_once "../../domain/pedido.php";

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->idcliente)){

    $pedido->idcliente = $data->idcliente;

    $rs = $pedido->cadastro();
    if($rs != 0){
        header("HTTP/1.0 201");
        echo json_encode($rs);
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