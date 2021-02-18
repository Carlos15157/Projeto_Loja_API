<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/produto.php";

$database = new Database();

$db = $database->getConnection();

$produto = new Produto($db);

$id = $_GET['produtos'];

$rs = $produto->carrinho($id);

if($rs->rowCount()>0){
    $produto_arr["saida"] = array();
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        $array_item = array(
            "idproduto"=>$linha["idproduto"],
            "nomeproduto"=>$linha["nomeproduto"],
            "preco"=>$linha["preco"],
            "foto"=>$linha["foto1"]
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