<?
class MVC_Date{
	
	private $annee;
	private $mois;
	private $jour;
	
        /**
         * Constructeur de la classe Date
         * @param type $date
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
         * Retourne la date au format dd/mm/yyyy
         * @return type
         */
	function fr(){
                //var_dump($this);
		return $this->jour.'/'.$this->mois.'/'.$this->annee;
	}
	
        /**
         * Retourne la date au format yyyy-mm-dd
         * @return type
         */
	function us(){
		return $this->annee.'-'.$this->mois.'-'.$this->jour;
	}
        
        /**
         * Retourne la date au format dd mmmm yyyy
         * @return type
         */
        function ecrite(){
            $douzeMois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
            return $this->jour.' '.$douzeMois[($this->mois)-1].' '.$this->annee;
        }
	
        /**
         * Retourne le jour
         * @return type
         */
	function getJour(){
			return $this->jour;
	}
	
        /**
         * Retourne le mois
         * @return type
         */
	function getMois(){
			return $this->mois;
	}
        
        /**
         * Retourne l'année
         * @return type
         */
	function getAnnee(){
			return $this->annee;
	}
}
