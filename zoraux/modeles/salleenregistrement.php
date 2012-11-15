<?php

class Zoraux_Modeles_SalleEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='salle';
    
        /*
     * Permet de récupérer les passages de la salle
     */
    function getPassages(){
        $tablePassages=new Zoraux_Modeles_Passage();
        $passages=$tablePassages->where('salle_id',array($this->id));
        return $passages;
    }

}