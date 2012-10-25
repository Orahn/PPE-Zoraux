<?php
    class MVC_Periode 
    {
        private $periode;
        /**
         * Constructeur de la classe periode (calcul la difference de temps entre deux dates)
         * @param MVC_Date $date1 recupere une premiere date de la classe date
         * @param MVC_Date $date2 recupere une seconde date de la classe date
         */
        function __construct(MVC_Date $date1,  MVC_Date $date2) 
        {
            $this->periode=$date1->diff($date2);
        }
        /**
         * Renvoie la periode entre deux dates (de la classe date)
         * @return string une chaine indiquant la periode
         */
        public function getPeriode() 
        {
            $string='';
            if($this->periode->y==1) {
                $string.=$this->periode->y.' an ';
            }
            if($this->periode->y>1) {
                $string.=$this->periode->y.' ans ';    
            }
            if($this->periode->m>=1) {
                $string.=$this->periode->m.' mois ';    
            }
            if($this->periode->d==1) {
                $string.=$this->periode->d.' jour ';
            }
            if($this->periode->d>1) {
                $string.=$this->periode->d.' jours ';
            }
            if($this->periode->h==1) {
                $string.=$this->periode->h.' heure ';
            }
            if($this->periode->h>1) {
                $string.=$this->periode->h.' heures ';
            }
            if($this->periode->i==1) {
                $string.=$this->periode->i.' minute ';
            }
            if($this->periode->i>1) {
                $string.=$this->periode->i.' minutes ';
            }
            return $string;
        }
               
    }

