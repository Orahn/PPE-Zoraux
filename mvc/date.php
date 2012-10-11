<?php
class MVC_Date extends DateTime{
    /**
     * Constructeur de la classe MVC_Date
     * La date peut-être au format français ou américain
     * @param string $time
     */
    public function __construct($time){
        if(stripos($time, '/')){
            $arrayTime=  explode('/', $time);
            $time=$arrayTime[2].'-'.$arrayTime[1].'-'.$arrayTime[0];
        }
        $object=new DateTimeZone('UTC');
        parent::__construct($time, $object);
    }
    /**
     * Retourne la date au format américain
     * @return type
     */
    public function getUs(){
        return $this->format('Y-m-d');
    }
    /**
     * Retourne la date au format français
     * @return type
     */
    public function getFr(){
        return $this->format('d/m/Y');
    }
}
