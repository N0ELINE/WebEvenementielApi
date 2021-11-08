<?php
include '../src/model/singleton.php';



function getReponse(){
    $pdo = _construct();
    $req ="Select * From Reponse";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    //print_r($reponses);
    sendJSON($reponses);

}

function getReponsebyId($id){
    $pdo = _construct();
    $req ="Select REPONSES.* From QUESTION,REPONSES where REPONSES.idReponseQuestion:=id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$id,PDO::PARAM_STR);
    $stmt->execute();
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    //print_r($reponses);
    sendJSON($reponses);

}

//recup quizz en fonction de l'id + tester que recup bien données 
//+ mettre data/table dans bdd

function sendJSON($info){
    header("Content-Type : application/json");
    header("Accesss-Control-Allow-Origin:*");
    echo json_encode($info,JSON_UNESCAPED_UNICODE);
}

?>