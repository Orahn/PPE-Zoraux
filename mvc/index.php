<?php
/**
 * Trouve automatiquement une classe appelee dans les dossiers en fonction de son nom
 * @param type : String - $nomClasse : nom de la classe recherchee
 */
function __autoload($nomClasse){
    $fichier=  str_replace('_', '/', $nomClasse);
    $fichier= strtolower($fichier);
    $fichier.='.php';
    include(Params_Chemins::ROOT.$fichier);
}

/**
 * Definit le controleur et l'action selon la methode GET (qui est ici prioritaire)
 * Si au moins une des deux variables n'est pas definie, on essaie avec la methode POST
 * Si encore au moins une des deux variables n'est pas definie, on leur attribut une valeur par defaut
 * $controleur=new $controleurNom() : Genere le controleur automatiquement en fonction du nom de la classe appelee precedement
 */
if(isset($_GET['controleur']) && isset($_GET['action'])){
    $controleurNom=$_GET['controleur'];
    $controleur=new $controleurNom();
    $action=$_GET['action'];
}elseif(isset($_POST['controleur']) && isset($_POST['action'])){
    $controleurNom=$_POST['controleur'];
    $controleur=new $controleurNom();
    $action=$_POST['action'];
}else{
    $controleurNom='blog_controleurs_accueil';
    $controleur=new $controleurNom();
    $action='principale';
}

/**
 * Cree la vue en lien avec le controleur
 */
$vue=new MVC_Vue($controleurNom,$action);
$controleur->vue=$vue;
/**
 * Appelle l'action passee en POST, GET ou definit par defaut
 */
$controleur->$action();
/**
 * Affiche la vue generee, qui s'adapte a l'action demandee
 */
echo $vue->head();
echo $vue->menu();
$vue->display();
echo $vue->foot();