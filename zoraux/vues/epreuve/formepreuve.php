<?php
if (isset($_SESSION['login'])) {

    echo $this->templateHaut();
    ?>
    <center>
        <?php
        /* Les classes CSS utilisées pour les input sont celles données dans la doc du template */
        $classes = array();
        $form = new MVC_Formulaire('epreuve', 'index.php?controleur=zoraux_controleurs_epreuve&action=enregistrerEpreuve');
        $form->addText('libelle', array('class' => 'input'), 'Nom de l\'épreuve');
        foreach ($this->classes as $classe) {
            $classes[$classe->id] = $classe->libelle;
        }
        $form->addSelect('classe_id', $classes, array('class' => 'select full-width'), 'Classe');
        $form->addText('dureePreparation', array('class' => 'input'), 'Temps de préparation');
        $form->addText('dureePassage', array('class' => 'input'), 'Temps de passage');
        $form->addText('dureeLibre', array('class' => 'input disabled', 'disabled' => 'disabled', 'value' => '10'), 'Durée libre avant');
        $form->addHidden('dureeLibreAvant', '10');
        echo $form->table(array(), 'Epreuve (les temps sont exprimés en minutes)');
        ?>
    </center>
    <?php
    echo $this->templateBas();
} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}
