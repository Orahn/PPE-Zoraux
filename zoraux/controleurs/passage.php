<?php

class Zoraux_Controleurs_Passage {

    /**
     * Enregistrement d'un nouveau passage 
     */
    function enregistrerPassage() {
        $tablePassages = new Zoraux_Modeles_Passage();
        if ($_POST['id'] == '') {
            $passage = $tablePassages->newPassage();
        } else {
            $passage = $tablePassages->get($_POST['id']);
        }
        if ($_POST['date'] != '' && $_POST['heurePassage'] != '' && $_POST['eleve_id'] != '' && $_POST['epreuve_id'] != '' && $_POST['jury_id'] != '' && $_POST['salle_id']) {
            $passage->date = $_POST['date'];
            $passage->heurePassage = $_POST['heurePassage'];
            $passage->eleve_id = $_POST['eleve_id'];
            $passage->epreuve_id = $_POST['epreuve_id'];
            $passage->jury_id = $_POST['jury_id'];
            $passage->salle_id = $_POST['salle_id'];
            $passage->enregistrer();
        } else {
            header('Location: ../');
        }
    }

}

