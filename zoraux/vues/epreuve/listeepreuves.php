<?php
echo $this->templateHaut();
/* On définit les headers de la table */
echo '<div class="table-header blue-gradient button-height">
        <div class="float-right">
		Search&nbsp;<input type="text" name="table_search" id="table_search" value="" class="input mid-margin-left">
	</div>
        </div>
        <div class="table">
        <table class="table" style="background-color:white;color:black">
        <thead>
		<tr align="center">
			<th scope="col">Classe</th>
			<th scope="col">Epreuve</th>
			<th scope="col">Membres de Jury affectés</th>
                        <th scope="col">Salles affectées</th>
		</tr>
	</thead>
        <tbody>';
foreach($this->epreuves as $epreuve){
    $classeA = $epreuve->getClasse();
    @$membresA = $epreuve->getMembresJury();
    @$sallesA = $epreuve->getSalles();
    echo '<tr><td>'.$classeA->libelle.'</td>';
    echo '<td>'.$epreuve->libelle.'</td>';
    echo '<td>';
    foreach($membresA as $m){
        if(!empty($m)){
            echo $m->nom.' '.$m->prenom.'<br/>';
        }
    }
    echo '</td><td>';
    foreach($sallesA as $s){
        if(!empty($s)){
            echo $s->libelle.'<br/>';
        }
    }
    echo '</td></tr>';
}
echo '</tbody>
      </table>
      </div>
      <div class="table-footer">
                
      </div>';
echo $this->templateBas();
