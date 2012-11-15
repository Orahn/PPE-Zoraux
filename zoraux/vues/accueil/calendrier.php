<?php
    echo $this->templateHaut();
?>
<h3>Ceci est un exemple pour l'instant</h3>
<div class="agenda with-header auto-scroll anthracite-gradient">

    <!-- Marqueurs de temps -->
    <ul class="agenda-time">
            <li class="from-7 to-8"><span>7h00</span></li>
            <li class="from-8 to-9"><span>8h00</span></li>
            <li class="from-9 to-10"><span>9h00</span></li>
            <li class="from-10 to-11"><span>10h00</span></li>
            <li class="from-11 to-12"><span>11h00</span></li>
            <li class="from-12 to-13 blue"><span>Midi</span></li>
            <li class="from-13 to-14"><span>13h00</span></li>
            <li class="from-14 to-15"><span>14h00</span></li>
            <li class="from-15 to-16"><span>15h00</span></li>
            <li class="from-16 to-17"><span>16h00</span></li>
            <li class="from-17 to-18"><span>17h00</span></li>
            <li class="from-18 to-19"><span>18h00</span></li>
            <li class="from-19 to-20"><span>19h00</span></li>
            <li class="at-20"><span>20h00</span></li>
    </ul>

    <div class="agenda-wrapper">

            <!-- Liste des evenements (le but serait de les construire via BDD) -->
            <div class="agenda-events agenda-day1">

                    <div class="agenda-header">
                            Lundi
                    </div>

                    <a href="#" class="agenda-event silver-gradient from-8 to-11">
                            <time>8h00 - 11h00</time>
                            Mathématiques<br />
                            Salle A114<br />
                            Jury 3
                            <span class="ribbon tiny"><span class="ribbon-inner red-gradient">CCF</span></span>
                    </a>

            </div>

            <div class="agenda-events agenda-day2">
                    <div class="agenda-header">
                            Mardi
                    </div>
            </div>

            <div class="agenda-events agenda-day3">
                    <div class="agenda-header">
                            Mercredi
                    </div>
            </div>

            <div class="agenda-events agenda-day4">
                    <div class="agenda-header">
                            Jeudi
                    </div>
                
                    <a href="#" class="agenda-event silver-gradient from-14 to-16-30">
                            <time>14h00 - 16h30</time>
                            Français<br />
                            Salle C13<br />
                            Jury 1
                            <span class="ribbon tiny"><span class="ribbon-inner red-gradient">ORAL</span></span>
                    </a>
            </div>

            <div class="agenda-events agenda-day5">
                    <div class="agenda-header">
                            Vendredi
                    </div>
            </div>

            <div class="agenda-events agenda-day6">
                    <div class="agenda-header">
                            Samedi
                    </div>
            </div>

            <div class="agenda-events agenda-day7">
                    <div class="agenda-header">
                            Dimanche
                    </div>
            </div>

    </div>

</div>

<?php
    echo $this->templateBas();
