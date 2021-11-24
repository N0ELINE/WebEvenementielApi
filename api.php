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
   // var_dump("dump",$reponses);    ///return que les id +libelle questions
    $stmt->closeCursor();
    $resp = [];
    foreach ($reponses as $yo){
        //var_dump("yo",$yo["idQuestion"]);
        $reponses = getReponseFromIdQuestion($yo["idQuestion"]);
        $yo['reponses'] = $reponses;
        array_push($resp,$yo);
        //var_dump($resp);
    }
    //var_dump($resp);
    //$reponses["rep"]=$rep;
    sendJSON($resp);

    
    //var_dump("rep",$rep);
    

    

}
function getReponseFromIdQuestion($idQuestion){

    $pdo = Singleton::getInstance() -> cnx; 
    $req ="Select REPONSES.libelle,REPONSES.bonne_rep From REPONSES,QUESTIONS where idReponseQuestion= :id AND QUESTIONS.idQuestion=REPONSES.idReponseQuestion ";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$idQuestion,PDO::PARAM_STR);
    $var=$stmt->execute();
    if ($var==false){
        
        var_dump($stmt->errorInfo());
    }
    $reponses=$stmt->fetchAll(PDO::FETCH_ASSOC);
   
   return $reponses;
}


function sendJSON($info){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($info,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    
}

