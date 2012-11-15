<?php
    echo $this->templateHaut();
?>
<center>
    <?php
    $epreuves = array();
    $professeurs = array();
    $professionnels = array();
    $form = new MVC_Formulaire('epreuve','index.php?controleur=Zoraux_Controleurs_MembreJuryEpreuve&action=enregistrerMembreJuryEpreuve');
    foreach($this->epreuves as $epreuve){
        $epreuves[$epreuve->id]=$epreuve->libelle;
    }
    $form->addSelect('epreuve_id',$epreuves,array('class'=>'select full-width'),'Epreuve');
    
    foreach($this->professeurs as $professeur){
        $professeurs[$professeur->id]=$professeur->nom.' '.$professeur->prenom;
    }
    $form->addCheckbox('professeur_id',$professeurs,array(),'Liste des professeurs');
    
    foreach($this->professionnels as $professionnel){
        $professionnels[$professionnel->id]=$professionnel->nom.' '.$professionnel->prenom;
    }
    $form->addCheckbox('professionnel_id',$professionnels,array(),'Liste des professionnels');
    
    echo $form->table(array(),'Affectation des membres du jury aux épreuves');
?>
</center>
<?php
    echo $this->templateBas();
