<?php
    echo $this->templateHaut();
?>
<script type="text/javascript" language="javascript" language="Javascript">
    if (confirm("Continuer les saisies ?")){
        window.location="?controleur=Zoraux_Controleurs_SalleEpreuve&action=formSalleEpreuve";
    }else{
        window.location="?controleur=zoraux_controleurs_accueil&action=principale";
    }
</script>
<?php
    echo $this->templateBas();