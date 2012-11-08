<?php
if (isset($_SESSION['login'])) {
    echo $this->templateHaut();
    ?>
    <center>
        <?php
        /* On construit un tableau vide */
        $epreuves = array();
        $form = new MVC_Formulaire('inscriptionepreuve', 'index.php?controleur=zoraux_controleurs_passage&action=enregistrerInscription');
        /* On remplit le tableau associatif avec l'id et le libelle des épreuves */
        foreach ($this->epreuves as $epreuve) {
            $epreuves[$epreuve->id] = $epreuve->libelle;
        }
        /* On se sert ensuite de ce tableau comme liste pour la liste déroulante */
        $form->addSelect('epreuve_id', $epreuves, array('class' => 'select multiple check-list'));
        $form->addHidden('eleve_id', $this->utilisateur->id);
        echo $form->table(array(), 'Inscription');
        ?>
    </center>
    <?php
    echo $this->templateBas();
} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}
