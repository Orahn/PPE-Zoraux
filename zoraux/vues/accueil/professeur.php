<?php

if (isset($_SESSION['login'])) {

    function professeur() {
        echo $this->menu();
    }

} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}