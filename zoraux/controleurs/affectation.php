<?php
class Zoraux_Controleurs_Affectation {
    function affecter(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $this->vue->epreuve=$tableEpreuves->get($_GET['epreuve_id']);
        $this->vue->passages=$this->vue->epreuve->getPassages();        
    }
}
