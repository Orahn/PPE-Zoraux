<?php

class MVC_Modele {

    static private $_pdo;
    protected $_modeleEnregistrement='MVC_ModeleEnregistrement';
    
    /**
     * Connexion à la base de données via PDO
     * @return type
     */
    static function pdo() {
        if(is_null(self::$_pdo)){
            $dsn = 'mysql:dbname='.Params_BDD::BDD.';host='.Params_BDD::HOST.'';
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
            $user = Params_BDD::USER;
            $password = Params_BDD::PWD;

            try {
                self::$_pdo= new PDO($dsn, $user, $password, $options);
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
        }
        return self::$_pdo;
    }
    
    /**
     * Liste de tous les enregistrements d'une table
     * @return type
     */
    function liste() {
        return $this->where('1=1',array());
    }
    
    /**
     * Liste les enregistrements d'une table avec clause WHERE (condition)
     * @param type $where
     * @param type $params
     * @return type
     */
    function where($where,$params){
        $query = 'select * from '.$this->_table. ' where '.$where;
        $result=self::pdo()->prepare($query);
        $result->execute($params);
        return $result->fetchAll(PDO::FETCH_CLASS, $this->_modeleEnregistrement);
    }
    
    /**
     * Retourne le premier enregistrement de la requête
     * @param string $where
     * @param array $params
     * @return \modele_enregistrement
     */
    function whereFirst($where,$params){
        $liste=$this->where($where,$params);
        return $result[0];
    }
    
    /**
     * Retourne un enregistrement par son id
     * @param type $id
     * @return type
     */
    function get($id){
        $result=$this->where('id=?',array($id));
        return $result[0];
    }
    
    /**
     * retourne un item vide (pour la création)
     * @return \modele_enregistrement
     */
    function newEnregistrement() {
        $item = new $this->_modele_enregistrement();
        $item->setTable($this->_table);
        $query='show columns from '.$this->_table;
        $colonnes=$this->pdo()->query($query)->fetchAll(PDO::FETCH_CLASS);
        foreach($colonnes as $col){
            $field=$col->Field;
            $item->$field=null;
        }
        return $item;
    }
    
    /**
     * retourne vrai si l'id existe
     * @param int $valeurClePrimaire
     * @return bool
     */
    function exists($valeurClePrimaire) { 
        return sizeof($this->where('id=?',array($valeurClePrimaire))) > 0;
    }
}