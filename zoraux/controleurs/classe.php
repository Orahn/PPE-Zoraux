<?php

class Zoraux_Controleurs_Classe {
    
     /**
     * Formulaire de saisie d'une classe
     */
    function formClasse(){
        $tableClasses=new Blog_Modeles_Classe();
        if(isset($_GET['id'])){
            $classe=$tableClasses->get($_GET['id']);
        }else{
            $classe=$tableClasses->newClasse();
        }
        $this->vue->classe=$classe;
    }
    
    /**
     * Enregistrement d'une nouvelle classe
     */
    function enregistrerClasse(){
        $tableClasses=new Blog_Modeles_Classe();
        if($_POST['id']==''){
            $classe=$tableClasses->newClasse();
        }else{
            $classe=$tableClasses->get($_POST['id']);
        }
        if ($_POST['id']!= '' && $_POST['libelle']!='') {
            $classe->id=$_POST['id'];
            $classe->libelle=$_POST['libelle'];
            $classe->enregistrer();
        } else {
            header('Location: ../');
        }
    }
}
