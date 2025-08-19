<?php 

require_once('../db/connection.php');
require('../utils/helpers.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    try{
        $con = getConnection();
        $body = file_get_contents('php://input');

        $data = json_decode($body, true);

        $stmt = $con->prepare("INSERT INTO administrador (email, senha) VALUES (:email, :senha)");

        $stmt->execute([
            "email"=> $data['email'],
            "senha"=> password_hash($data['senha'], PASSWORD_DEFAULT)
        ]);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            "message" => "Administrador criado com sucesso",
            "data" => $con->lastInsertId(),
            "error" => false,
        ]);

    } catch(Exception $e){
        echo json_encode([
            "message" => "Não foi possivel criar o Administrador",
            "data" => null,
            "error" => true,
        ]);
    }
}else{
    echo json_encode([
            "message" => "Método inválido.",
            "data" => null,
            "error" => true,
        ]);
}
