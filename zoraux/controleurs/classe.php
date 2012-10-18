<?php
class Zoraux_Controleurs_Classe {
<<<<<<< HEAD
<<<<<<< HEAD
   
}
=======

}
>>>>>>> 272d8326a7ab2121bcf8a51f46c601bc99e5787c
=======
    
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
            $classe=$tableClasses->get($_GET['id']); //On recupere l'article correspondant à cet id dans la table article
            $classe->supprimer(); //On fait appel à la methode supprimer sur cet article
        }
    }
}
>>>>>>> aaaa54478572a69c45f49bd379d83c275894ddfb
