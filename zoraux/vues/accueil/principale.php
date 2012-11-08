<?php
if (isset($_SESSION['login'])) {
    echo $this->templateHaut();
    echo '<div class="block">
            <h3 class="block-title">A propos</h3>
            <div class="with-padding">
                Bienvenue sur l\'application "Zoraux", cette application permet la gestion des épreuves CCF et oraux des Lycées professionnels et hôteliers.<br />
                Elle est actuellement développée par la section SLAM du BTS SIO 2ème année.<br />
                '.$this->admin.'
            </div>
        </div>';
    echo $this->templateBas();
} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}