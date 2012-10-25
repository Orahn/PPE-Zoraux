<?php

function __autoload($nomClasse){
    $fichier=  str_replace('_', '/', $nomClasse);
    $fichier=  strtolower($fichier);
    $fichier.='.php';
    include(Params_Chemins::ROOT.$fichier);
}
?>
