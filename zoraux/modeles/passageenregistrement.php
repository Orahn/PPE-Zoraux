<?php

class Zoraux_Modeles_PassageEnregistrement extends MVC_ModeleEnregistrement  {
    
    protected $_table = 'passage';
    
    /**
     * Retourne la classe concernée par le passage
     * @return type
     */
    function getClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $classe=$tableClasses->get($this->classe_id);
        return $classe;
    }
    
    /**
     * Retourne l'épreuve concernée par le passage
     * @return type
     */
    function getEpreuve(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $epreuve=$tableEpreuves->get($this->epreuve_id);
        return $epreuve;
    }
    /**
     * Retourne l'élève concerné par le passage
     * @return type
     */
    function getEleve(){
        $tableEleves=new Zoraux_Modeles_Eleve();
        return $tableEleves->get($this->eleve_id);        
    }
    /**
     * Retourne la salle concernée par le passage
     * @return type
     */
    function getSalle(){
        $tableSalles=new Zoraux_Modeles_Salle();
        return $tableSalles->get($this->salle_id);        
    }
    
    /**
     * retourne vrai si tous les champs sont affectés
     * @return bool
     */
    function estComplet(){
        if(is_null($this->date)){
            return false;
        }
        if(is_null($this->heurePassage)){
            return false;
        }
        if(is_null($this->jury_id)){
            return false;
        }
        if(is_null($this->salle_id)){
            return false;
        }        
        return true;
    }
    function heureDebutPreparation(){
        $epreuve=$this->getEpreuve();
        $heurePassage=new MVC_Date($this->date.' '.$this->heurePassage);
        $timestampHeurePassage=$heurePassage->getTimestamp();
        
        $preparation=explode(':',$epreuve->dureePreparation);
        
        $timestampDebutPreparation=$timestampHeurePassage-$preparation[0]*3600-$preparation[1]*60-$preparation[2];
        return date('H:i:s',$timestampDebutPreparation);
        
    }
    function heureDebutOccupe(){
        $epreuve=$this->getEpreuve();
        $timestampDebutPreparation=$this->heureDebutPreparation();
        $libreAvant=expldoe(':',$epreuve->dureeLibreAvant);
        $timestampDebutOccupe=$timestampDebutPreparation-$libreAvant[0]*3600-$libreAvant[1]*60-$libreAvant[2];
        return date('H:i:s',$timestampDebutoccupe);
    }
    function heureFinPassage(){
        $epreuve=$this->getEpreuve();
        $heurePassage=new MVC_Date($this->date.' '.$this->heurePassage);
        $timestampDebutPassage=$heurePassage->getTimestamp();
        
        $dureePassage=explode(':',$epreuve->dureePassage);
        $timestampFinPassage=$timestampDebutPassage-$dureePassage[0]*3600-$dureePassage[1]*60-$dureePassage[2];
        return date('H:i:s',$timestampFinPassage);                
    }
    function estEnParallele($passage){
        if($this->heureDebutOccupe()<$passage->heureFinPassage()
           and $this->heureFinPassage()>$passage->heureDebutOccupe())
        {
            return true;
        }
        return false;
    }
    function affecterHeurePassage(){
        $epreuve=$this->getEpreuve();
        $dates=$epreuve->getDates();
        $i=0;
        $affecte=false;
        $debut=strtotime($dates[0].' '.HEURE_DEBUT_MATIN);
        $dureePassage=explode(':',$epreuve->dureePassage);
        $duree=$dureePassage[0]*3600+$dureePassage[1]*60+$dureePassage[2];
        $passagesEleve=$this->getEleve()->getPassages();
        $passagesJury=$this->getJury()->getPassages();
        $passagesSalle=$this->getSalle()->getpassages();
        while(!$affecte){
            $this->heurePassage=date('H:i:s',$debut);
            $this->date=date('Y-m-d',$debut);
            $eleveOccupe=false;
            foreach($passagesEleve as $p){
                $eleveOccupe=$eleveOccupe or $this->estEnParallele($p);                
            }
            $juryOccupe=false;
            foreach($passagesJury as $p){
                $juryOccupe=$juryOccupe or $this->estEnParallele($p);
            }
            $salleOccupee=false;
            foreach($passagesSalle as $p){
                $salleOccupee=$salleOccupee or $this->estEnParallele($p);
            }
            $affecte=!$eleveOccupe and !$juryOccupe and !$salleOccupee;
            
            $debut+=$duree;
        }
    }
}