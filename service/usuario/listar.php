<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/usuario.php";

$database = new Database();

$db = $database->getConnection();

$usuario = new Usuario($db);

$rs = $usuario->listar();

if($rs->rowCount()>0){
    $usuario_arr["saida"] = array();
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idusuario"=>$idusuario,
            "nomeusuario"=>$nomeusuario,
            "senha"=>$senha,
            "foto"=>$foto
        );

        array_push($usuario_arr["saida"],$array_item);

    }

    header("HTTP/1.0 200");
    echo json_encode($usuario_arr);
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há usuários cadastrados"));
}
?>