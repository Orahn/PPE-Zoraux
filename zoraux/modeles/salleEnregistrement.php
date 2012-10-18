<?php

class Zoraux_Modeles_SalleEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='salle';
    /**
     * Recupere la liste de toutes les classes
     */
    function listeSalles(){
        $tableSalles=new Zoraux_Modeles_Salle();
        $salles=$tableSalles->liste();
        $this->vue->salles=$salles;
    }
}