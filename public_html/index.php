<?php
include '../api.php';
require_once( '../src/model/singleton.php');
require_once('../src/model/singletonConfig.php');

getQuestionbyIdFormation($_GET["id"]);  //reucup l'id mis dans l'url api et pas celui envoyer
//var_dump($_GET["id"]);

