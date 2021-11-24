<?php
require_once( '../src/model/singleton.php');
require_once('../src/model/singletonConfig.php');




function getReponse(){   //marche
    
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


function getQuestionbyIdFormation($idFormation){ //marche
    $pdo = Singleton::getInstance() -> cnx; 
    $req ="Select QUESTIONS.idQuestion ,QUESTIONS.libelle From QUESTIONS,FORMATION where FORMATION.idFormation= :id AND QUESTIONS.idQuestionFormation=FORMATION.idFormation";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$idFormation,PDO::PARAM_STR);
    $var=$stmt->execute();
    if ($var==false){
        
        var_dump($stmt->errorInfo());
    }
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
     //mettre dans le array l'id quest
    $reponses.    $stmt->closeCursor();
    $rep = getReponseFromIdQuestion($reponses[0]["idQuestion"]);
    //arraypush($reponses,$rep);
    $reponses["rep"]=$rep;
    sendJSON($reponses);

}
function getReponseFromIdQuestion($idQuestion){
    var_dump("is",$idQuestion);
    $pdo = Singleton::getInstance() -> cnx; 
    $req ="Select libelle From REPONSES where idReponseQuestion= :id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$idQuestion,PDO::PARAM_STR);
    $var=$stmt->execute();
    if ($var==false){
        
        var_dump($stmt->errorInfo());
    }
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump("rep",$reponses);
   return $reponses;
}


function sendJSON($info){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($info,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    
}

