<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/foto.php";

$database = new Database();

$db = $database->getConnection();

$foto = new Foto($db);

$rs = $foto->listar();

if($rs->rowCount()>0){
    $foto_arr["saida"] = array();
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idfoto"=>$idfoto,
            "foto1"=>$foto1,
            "foto2"=>$foto2,
            "foto3"=>$foto3,
            "foto4"=>$foto4
        );

        array_push($foto_arr["saida"],$array_item);

    }

    header("HTTP/1.0 200");
    echo json_encode($foto_arr);
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há fotos cadastradas"));
}
?>