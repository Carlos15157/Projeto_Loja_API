<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/produto.php";

$database = new Database();

$db = $database->getConnection();

$produto = new Produto($db);

$rs = $produto->listar();

if($rs->rowCount()>0){
    $produto_arr["saida"] = array();
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idproduto"=>$idproduto,
            "nomeproduto"=>$nomeproduto,
            "descricao"=>$descricao,
            "preco"=>$preco,
            "idfoto"=>$idfoto
        );

        array_push($produto_arr["saida"],$array_item);

    }

    header("HTTP/1.0 200");
    echo json_encode($produto_arr);
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há produtos cadastrados"));
}
?>