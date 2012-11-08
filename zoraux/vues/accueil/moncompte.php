<?php

if (isset($_SESSION['login'])) {
    echo $this->templateHaut();
    echo $this->templateBas();
} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}

