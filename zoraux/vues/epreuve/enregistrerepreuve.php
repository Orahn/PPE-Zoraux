<?php
    echo $this->templateHaut();
    echo '<script language="javascript">
            alert(\'Epreuve enregistr\351e\');
        </script>';
    echo '<meta http-equiv="Refresh" content="0;URL=index.php?controleur=zoraux_controleurs_accueil&action=principale">';
    echo $this->templateBas();
