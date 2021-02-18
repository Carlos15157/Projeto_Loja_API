<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";
include_once "../../domain/usuario.php";

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nomeusuario) && !empty($data->senha) && !empty($data->foto)){

    $usuario->nomeusuario = $data->nomeusuario;
    $usuario->senha = $data->senha;
    $usuario->foto=$data->foto;

    if($usuario->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Usuário cadastrado com sucesso!"));
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