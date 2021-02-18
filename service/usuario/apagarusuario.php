<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:DELETE");

include_once "../../config/database.php";
include_once "../../domain/usuario.php";

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->idusuario)){

    $usuario->idusuario=$data->idusuario;

    if($usuario->apagarUsuario()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"Usuário apagado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível apagar o usuário"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>