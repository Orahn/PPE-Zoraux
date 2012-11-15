<?php

class Zoraux_Modeles_JuryEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='jury';

    /*
     * Permet de récupérer les passages du jury
     */
    function getPassages(){
        $tablePassages=new Zoraux_Modeles_Passage();
        $passages=$tablePassages->where('jury_id',array($this->id));
        return $passages;
    }
    
}