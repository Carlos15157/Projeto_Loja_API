<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:PUT");

include_once "../../config/database.php";
include_once "../../domain/usuario.php";

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);


$data = json_decode(file_get_contents("php://input"));

if(!empty($data->idusuario) && !empty($data->senha)){

    $usuario->senha = $data->senha;
    $usuario->idusuario=$data->idusuario;

    if($usuario->alterarSenha()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Senha alterada com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível alterar a senha"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>