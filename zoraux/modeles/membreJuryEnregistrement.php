<?php

class Zoraux_Modeles_MembreJuryEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='membreJury';
    /**
     * Recupere la liste des profs d'une classe dont l'id est passe en parametre par la methode GET
     */
    function listeProfsClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $id=$_GET['id'];
        $classe=$tableClasses->get($id);
        $this->vue->classe=$classe;
        $tableMembresJury=new Zoraux_Modeles_MembreJury();
        $membresJury=$tableMembresJury->where('classe_id=?',array($id));
        $this->vue->membresJury=$membresJury;
    }
}