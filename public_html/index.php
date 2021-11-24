<?php
include '../api.php';
require_once( '../src/model/singleton.php');
require_once('../src/model/singletonConfig.php');

//to do determiner quelle fonction appeller
// si user abonner à la formation on peut deduire l'id formation et l'envoyer a l'api pour faire 
// en fonction de la formation


getQuestionbyIdFormation($_GET["id"]);


