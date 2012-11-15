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
			<th scope="col">Date</th>
			<th scope="col">Heure</th>
			<th scope="col">Membres de Jury affectés</th>
                        <th scope="col">Salles affectées</th>
                        <th scope="col">Elève</th>
                        <th></th>
		</tr>
	</thead>
        <tbody>';
foreach($this->passages as $passage){
    $epreuve=$this->epreuve;
    $membresA = $epreuve->getMembresJury();
    $salle= $passage->getSalle();
    $date=new MVC_Date($passage->date);
    echo '<tr><td>'.$date->getFr().'</td>';
    echo '<td>'.$passage->heurePassage.'</td>';
    echo '<td>';
    foreach($membresA as $m){
        if(!empty($m)){
            echo $m->nom.' '.$m->prenom.'<br/>';
        }
    }
    echo '</td><td>';
    echo $salle->libelle;
    echo '</td><td>';
    $eleve=$passage->getEleve();
    echo $eleve->nom,' ',$eleve->prenom;
    echo '</td></tr>';
}
echo '</tbody>
      </table>
      </div>
      <div class="table-footer">
                
      </div>';
echo $this->templateBas();
