<?php

class Database{
    public $conexao;
    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host=localhost;port=3306;dbname=dbnike","root","");
            $conexao->exec("set name utf8");
        }
        catch(PDOException $e){
            echo "Erro a estabelecer a conexão com o banco. "+$e->getMessage();
        }
        return $conexao;
    }    
}










?>