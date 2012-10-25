<?php
echo $this->templateHaut();
/* On définit les headers de la table */
echo '<div class="table-header">
	Pour la classe de '.$this->classe->libelle.'
        </div>

        <table class="table" style="background-color:white;color:black">
        <thead>
		<tr align="center">
			<th scope="col">Epreuve</th>
			<th scope="col">Temps de préparation</th>
			<th scope="col">Temps de passage</th>
                        <th scope="col">Durée libre avant</th>
                        <th scope="col">Inscrit</th>
                        <th scope="col">Désinscription</th>
		</tr>
	</thead>
        <tbody>';
/* Création de tableaux vides pour la suite */
$passages = array();
$passages_id = array();
/* On enregistre les données qui nous interessent dans ces tableaux */
foreach($this->passages as $passage){
    array_push($passages,$passage->epreuve_id);
    $passages_id[$passage->epreuve_id]=$passage->id;
}
/* On construit une ligne de tableau pour chaque épreuve de la classe */
foreach($this->epreuves as $epreuve){
    echo '<tr>
                <td>'.$epreuve->libelle.'</th>
                <td>'.$epreuve->dureePreparation.'</td>
                <td>'.$epreuve->dureePassage.'</td>
                <td>'.$epreuve->dureeLibreAvant.'</td>';
    /* Si l'id de l'épreuve se trouve aussi dans le tableau construit, c'est que l'élève est inscrit */
    if(in_array($epreuve->id,$passages)){
        echo '<td><span class="icon-tick"></span></td>';
    }else{
        echo '<td></td>';
    }
    /* Si l'epreuve existe dans le tableau des id de passages on affiche un bouton pour se désinscrire */
    if(isset($passages_id[$epreuve->id])){
        echo '<td>'.$this->lien('zoraux_controleurs_passage','supprimerPassage','Se désinscrire',array('id'=>$passages_id[$epreuve->id]),array('class'=>'button compact')).'</td></tr>';
    }else{
        echo '<td></td></tr>';
    }  
}
    echo '</tbody>
        </table>

        <div class="table-footer">
                
        </div>';
echo $this->templateBas();
