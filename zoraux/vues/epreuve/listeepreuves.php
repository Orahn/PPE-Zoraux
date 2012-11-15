<?php
echo $this->templateHaut();
/* On définit les headers de la table */
echo '<div class="table-header blue-gradient">
        </div>
        <div class="table">
        <table class="table" style="background-color:white;color:black">
        <thead>
		<tr align="center">
			<th scope="col">Classe</th>
			<th scope="col">Epreuve</th>
			<th scope="col">Membres de Jury affectés</th>
                        <th scope="col">Salles affectées</th>
                        <th scope="col">Passages</th>
                        <th></th>
		</tr>
	</thead>
        <tbody>';
foreach($this->epreuves as $epreuve){
    $classeA = $epreuve->getClasse();
    $membresA = $epreuve->getMembresJury();
    $sallesA = $epreuve->getSalles();
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
    echo '</td><td>';
    $passages=$epreuve->getPassages();
    $nbPassagesComplets=0;
    foreach($passages as $p){
        if($p->estComplet()){
            $nbPassagesComplets++;
        }
    }
    echo sizeof($passages),' (',$nbPassagesComplets,' complets)';
    echo '</td><td>';
    echo $this->lien('Zoraux_controleurs_affectation','affecter','Affecter',array('epreuve_id'=>$epreuve->id));
    echo '</td></tr>';
}
echo '</tbody>
      </table>
      </div>
      <div class="table-footer">
                
      </div>';
echo $this->templateBas();
