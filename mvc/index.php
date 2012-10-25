<?php
/**
 * Construction du chemin automatique
 * @param type $nomClasse
 */
function __autoload($nomClasse){
    $fichier=  str_replace('_', '/', $nomClasse);
    $fichier=  strtolower($fichier);
    $fichier.='.php';
    include(Params_Chemins::ROOT.$fichier);
}

/* L'action et le contrôleur peuvent être en POST ou GET */
if(isset($_GET['controleur']) && isset($_GET['action'])){
    $controleurNom=$_GET['controleur'];
    $controleur=new $controleurNom();
    //création de la vue
    $action=$_GET['action'];
}elseif(isset($_POST['controleur']) && isset($_POST['action'])){
    $controleurNom=$_POST['controleur'];
    $controleur=new $controleurNom();
    //création de la vue
    $action=$_POST['action'];
}else{
    $controleurNom='zoraux_controleurs_login';
    $controleur=new $controleurNom();
    $action='auth';
}

$vue=new MVC_Vue($controleurNom,$action);
$controleur->vue=$vue;
//appel de l'action
$controleur->$action();
//affichage de la vue
echo $vue->header();
$vue->display();
echo $vue->footerJS();
if($controleurNom=='zoraux_controleurs_login'){
    echo $vue->footerLogin();
}
echo $vue->footer();



