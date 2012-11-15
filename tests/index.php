<?php

session_start();
    error_reporting(E_ALL);
    ini_set('display_errors','1');
    include_once('./params/params_chemins.php');
    include_once('./params/params_bdd.php');
    //require_once '//usr/share/php/PHPUnit/Framework/MockObject/Autoload.php';
    require_once '//usr/share/php/PHPUnit/TextUI/TestRunner.php';
    require_once '//usr/share/php/PHPUnit/Framework.php';
    //require_once '//usr/share/php/PHPUnit/Framework/TestCase.php';
   
    
function __autoload($nomClasse){
    $fichier=  str_replace('_', '/', $nomClasse);
    $fichier=  strtolower($fichier);
    $fichier.='.php';
    require_once(Params_Chemins::ROOT.$fichier);
}

$suite = new PHPUnit_Framework_TestSuite('Framework');
$suite -> addTestSuite('Tests_Zoraux_Modeles_TestEleveEnregistrement');
//$suite -> addTestSuite('ArticleTests');

$result = PHPUnit_TextUI_TestRunner::run($suite);
return $result;
?>
