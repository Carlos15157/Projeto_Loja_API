<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");
header("Access-Controll-Allow-Methods:POST");

include_once "../../config/database.php";
include_once "../../domain/login.php";

$database = new Database();

$db = $database->getConnection();

$usuario = new Login($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->nomeusuario = $data->nomeusuario;
$usuario->senha = $data->senha;

$rs = $usuario->login();

if($rs->rowCount()>0){
    $usuario_arr["saida"] = array();
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idusuario"=>$idusuario,
            "nomeusuario"=>$nomeusuario,
            "foto"=>$foto,
            "idcliente"=>$idcliente,
            "nomecliente"=> $nomecliente,
             "cpf"=>$cpf,
             "sexo"=>$sexo,
             "email"=>$email,
             "telefone"=>$telefone,
             "tipo"=>$tipo,
             "logradouro"=>$logradouro,
             "numero"=>$numero,
             "complemento"=>$complemento,
             "bairro"=>$bairro,
             "cep"=>$cep
        );

        array_push($usuario_arr["saida"],$array_item);

    }

    header("HTTP/1.0 200");
    echo json_encode($usuario_arr);
}
else{
    header("HTTP/1.0 400");
    echo json_encode(0);
}
?>