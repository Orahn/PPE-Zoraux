<?php
class Zoraux_Controleurs_Classe {
<<<<<<< HEAD
<<<<<<< HEAD
   
}
=======

}
>>>>>>> 272d8326a7ab2121bcf8a51f46c601bc99e5787c
=======
    
    /**
     * Permet de récupérer les informations de l'utilisateur
     */
    private function informations(){
        if(isset($_SESSION['rang'])){
            if($_SESSION['rang']=='eleve'){
                $tableEleves = new Zoraux_Modeles_Eleve();
                $eleve = $tableEleves->get($_SESSION['id']);
                $classe = $eleve->getClasse();
                $epreuves = $classe->getEpreuves();
                $passages = $eleve->getPassages();
                $this->vue->utilisateur = $eleve;
                $this->vue->classe = $classe;
                $this->vue->epreuves = $epreuves;
                $this->vue->passages = $passages;
                $this->vue->rang = $_SESSION['rang'];
            }elseif($_SESSION['rang']=='professeur'){
                $tableMembreJurys = new Zoraux_Modeles_MembreJury();
                $membreJury = $tableMembreJurys->get($_SESSION['id']);
                $this->vue->utilisateur = $membreJury;
                $this->vue->rang = $_SESSION['rang'];
            }
        }
    }
    
    /**
     * Charge une liste des classes par professeur
     */
    function listeProfesseur(){
        $tableProfesseurs=new Zoraux_Modeles_MembreJury();
        $id=$_GET['id'];
        $professeur=$tableProfesseurs->get($id);
        $this->vue->auteur=$professeur;
        $tableClasses=new Zoraux_Modeles_Classe();
        $classes=$tableClasses->where('id=?',array($id));
        $this->vue->articles=$classes;
    }
    
    /**
     * Permet de supprimer une classe de la base de donnees
     */
    function supprimerClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        if(isset($_GET['id'])){ //Si l'id existe dans l'URL
            $classe=$tableClasses->get($_GET['id']);
            $classe->supprimer();
        }
    }
}
>>>>>>> aaaa54478572a69c45f49bd379d83c275894ddfb
