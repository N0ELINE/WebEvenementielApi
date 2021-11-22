<?php
include '../api.php';
require_once( '../src/model/singleton.php');
require_once('../src/model/singletonConfig.php');

//to do determiner quelle fonction appeller
// si user abonner à la formation on peut deduire l'id formation et l'envoyer a l'api pour faire 
// en fonction de la formation


//getReponse();
// echo ("<br>---------------------------------------------------------------------<br>");
getReponsebyId(2);
// echo ("<br>---------------------------------------------------------------------<br>");
getQuestionbyIdFormation(2);

 for ($i =0;$i<10;$i++){
    //getQuestionbyIdFormation($i);
    //getReponsebyId($i);
 }

?>
