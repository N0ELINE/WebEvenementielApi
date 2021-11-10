<?php
require_once( '../src/model/singleton.php');
require_once('../src/model/singletonConfig.php');




function getReponse(){   //renvoi bien donnée
    
    $pdo =  Singleton::getInstance() -> cnx; 
    $req ="Select * From REPONSES";
    $stmt = $pdo->prepare($req);
    $var=$stmt->execute();
    if ($var==false){
        
        var_dump($stmt->errorInfo());
    }
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($reponses);
    $stmt->closeCursor();
    sendJSON($reponses);
    

}

function getReponsebyId($id){ //renvoie donnée
    $pdo = Singleton::getInstance() -> cnx; 
    $req ="Select REPONSES.* From QUESTIONS,REPONSES where REPONSES.idReponseQuestion= :id AND QUESTIONS.idQuestion=REPONSES.idReponseQuestion";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$id,PDO::PARAM_STR);
    $var=$stmt->execute();
    if ($var==false){
        
        var_dump($stmt->errorInfo());
    }
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //$stmt->closeCursor();
    //var_dump($reponses);
    sendJSON($reponses);
    

}

function getQuestionbyIdFormation($idFormation){ //renvoie donnée
    $pdo = Singleton::getInstance() -> cnx; 
    $req ="Select QUESTIONS.libelle From QUESTIONS,FORMATION where FORMATION.idFormation= :id AND QUESTIONS.idQuestionFormation=FORMATION.idFormation";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$idFormation,PDO::PARAM_STR);
    $var=$stmt->execute();
    if ($var==false){
        
        var_dump($stmt->errorInfo());
    }
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($reponses);

}


function sendJSON($info){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($info,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    
}

?>