<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/produto.php";

$database = new Database();

$db = $database->getConnection();

$id=$_GET['idproduto'];

$produto = new Produto($db);

$rs = $produto->detalheProduto($id);

if($rs->rowCount()>0){
    $produto_arr["saida"] = array();
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        $array_item = array(
            "idproduto"=>$linha["idproduto"],
            "nomeproduto"=>$linha["nomeproduto"],
            "descricao"=>$linha["descricao"],
            "preco"=>$linha["preco"],
            "foto1"=>$linha["foto1"],
            "foto2"=>$linha["foto2"],
            "foto3"=>$linha["foto3"],
            "foto4"=>$linha["foto4"]
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