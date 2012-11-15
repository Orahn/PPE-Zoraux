<?php
    echo $this->templateHaut();
?>
<center>
    <?php
    $epreuves = array();
    $salles = array();
    $form = new MVC_Formulaire('epreuve','index.php?controleur=Zoraux_Controleurs_SalleEpreuve&action=enregistrerSalleEpreuve');
    foreach($this->epreuves as $epreuve){
        $epreuves[$epreuve->id]=$epreuve->libelle;
    }
    $form->addSelect('epreuve_id',$epreuves,array('class'=>'select full-width'),'Epreuve');
    
    foreach($this->salles as $salle){
        $salles[$salle->id]=$salle->libelle;
    }
    $form->addCheckbox('salle_id',$salles,array(),'Liste des salles');
    
    echo $form->table(array(),'Affectation des salles aux épreuves');
?>
</center>
<?php
    echo $this->templateBas();
