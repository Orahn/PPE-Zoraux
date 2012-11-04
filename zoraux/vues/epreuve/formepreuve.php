<?php
    echo $this->templateHaut();
?>
<center>
<?php
    /* Les classes CSS utilisées pour les input sont celles données dans la doc du template */
    $classes = array();
    $temps = array();
    $form = new MVC_Formulaire('epreuve','index.php?controleur=zoraux_controleurs_epreuve&action=enregistrerEpreuve');
    $form->addText('libelle',array('class'=>'input'),'Nom de l\'épreuve');
    foreach($this->classes as $classe){
        $classes[$classe->id]=$classe->libelle;
    }
    $form->addSelect('classe_id',$classes,array('class'=>'select full-width'),'Classe');
    for($i=10;$i<60;$i+=5){
        $temps['00:'.$i.':00']=$i.' minutes';
    }
    $temps['01:00:00']='1 heure';
    $form->addSelect('dureePreparation',$temps,array('class'=>'select full-width'),'Temps de préparation');
    //$form->addText('dureePreparation',array('class'=>'input'),'Temps de préparation');
    $form->addSelect('dureePassage',$temps,array('class'=>'select full-width'),'Temps de passage');
    //$form->addText('dureePassage',array('class'=>'input'),'Temps de passage');
    $form->addText('dureeLibre',array('class'=>'input disabled','disabled'=>'disabled','value'=>'10'),'Durée libre avant');
    $form->addHidden('dureeLibreAvant','10');
    echo $form->table(array(),'Epreuve (les temps sont exprimés en minutes)');
?>
</center>
<?php
    echo $this->templateBas();
