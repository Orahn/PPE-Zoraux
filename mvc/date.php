<?
class MVC_Date{
	
	private $annee;
	private $mois;
	private $jour;
	
        /**
         * Constructeur de la classe Date
         * @param date- $date : date au format americain 'Y-m-d' ou francais 'd/m/Y'
         */
	function __construct($date){
            if(strpos($date,'-')){
		$dateExplose=explode('-', $date);
		$this->annee = $dateExplose[0];
		$this->mois = $dateExplose[1];
		$this->jour = $dateExplose[2];
            }else{
                $dateExplose=explode('/', $date);
		$this->annee = $dateExplose[2];
		$this->mois = $dateExplose[1];
		$this->jour = $dateExplose[0];
            }
	}
        /**
         * Retourne la date au format francais 'd/m/Y'
         * @return string : date au format francais 'd/m/Y'
         */
        
	function fr(){
		return $this->jour.'/'.$this->mois.'/'.$this->annee;
	}
	
        /**
         * Retourne la date au format americain 'Y-m-d'
         * @return string : date au format americain 'Y-m-d'
         */
	function us(){
		return $this->annee.'-'.$this->mois.'-'.$this->jour;
	}
        
        /**
         * Retourne la date au format francais 'd/m/Y'
         * @return string : date au format francais 'd/m/Y'
         */
        function ecrite(){
            $douzeMois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
            return $this->jour.' '.$douzeMois[($this->mois)-1].' '.$this->annee;
        }
	
        /**
         * Retourne le jour
         * @return string : jour
         */
	function getJour(){
			return $this->jour;
	}
	
        /**
         * Retourne le mois
         * @return string : mois
         */
	function getMois(){
			return $this->mois;
	}
        
        /**
         * Retourne l'annee
         * @return string : annee
         */
	function getAnnee(){
			return $this->annee;
	}
}
