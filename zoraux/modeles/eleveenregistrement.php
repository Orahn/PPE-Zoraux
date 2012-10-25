<?php

class Zoraux_Modeles_EleveEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='eleve';
    
    /**
     * Permet de récupérer la classe de l'élève
     * @return classe
     */
    function getClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $classe=$tableClasses->get($this->classe_id);
        return $classe;
    }
    
    /*
     * Permet de récupérer les passages de l'élève
     */
    function getPassages(){
        $tablePassages=new Zoraux_Modeles_Passage();
        $passages=$tablePassages->where('eleve_id',array($this->id));
        return $passages;
    }
    
    /**
     * Permet de récupếrer la liste des élèves pour une classe
     */
    function listeElevesClasse(){
        $this->vue->titre='Liste des élèves par classe';
        $id=$_GET['id'];
        $tableClasses=new Zoraux_Modeles_Classe();
        $classe=$tableClasses->get($id);
        $this->vue->classe=$classe;
        $tableEleves=new Zoraux_Modeles_Eleve();
        $eleves=$tableEleves->where('classe_id=?',array($id));
        $this->vue->eleves=$eleves;
    }
}
