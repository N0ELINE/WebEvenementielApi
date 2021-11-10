<?php
include '../api.php';
require_once( '../src/model/singleton.php');
require_once('../src/model/singletonConfig.php');


echo ("---------------------------------------------------------------------<br>");
getReponse();
echo ("<br>---------------------------------------------------------------------<br>");
getReponsebyId(1);
echo ("<br>---------------------------------------------------------------------<br>");
getQuestionbyIdFormation(2);
sendJSON();

?>
