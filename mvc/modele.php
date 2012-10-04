<?php

class MVC_Modele {
    static private $_pdo;
    protected $_modeleEnregistrement='MVC_ModeleEnregistrement';
    
    /**
     * Connecte l'application a la base de donnees
     * Les variables utiles a la connexion se trouve dans public/params/params_chemins.php
     * @return type : connexion 
     */
    static function pdo() {
        if(is_null(self::$_pdo)){
            $dsn = 'mysql:dbname='.Params_BDD::BDD.';host='.Params_BDD::HOST;
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
     *
     * @param string - $where : clause where de la requete permettant de restreindre la recherche
     * valeur par defaut : '1=1'
     * @param tableau de parametres - $params : valeur permettant de restreindre la recherche selon le type de restriction choisi avec $where
     * valeur par defaut : 'array()'
     *      lorsque where() est appele sans specifier les parametres, la fonction retourne tous les resultats de la table
     *      on peut egalement ne preciser que le premier parametre
     *          exemple : recuperer tous les resultats mais par ordre croissant/alphabétique, ou avec une limite du nombre de resultats
     * @return enregistrements (object) 
     */
    function where($where = '1=1',$params = array()){
        $query = 'select * from '.$this->_table. ' where '.$where;
        $result=self::pdo()->prepare($query);
        $result->execute($params);
        return $result->fetchAll(PDO::FETCH_CLASS, $this->_modeleEnregistrement);

        //PDO::FETCH_CLASS : permet de renvoyer les resultats sous forme d'objets plutot qu'un tableau
    }
    
    /**
     * Retourne le premier enregistrement de la requete
     * @param cf where()
     * @return enregistrement (object)
     */
    function whereFirst($where ,$params){
        $liste=$this->where($where,$params);
        return $result[0];
    }
    /**
     * Retourne un enregistrement, precise par un id
     * @param int - $id : id de l'enregistrement a recuperer
     * @return enregistrement (object)
     */
    function get($id){
        $result=$this->where('id=?',array($id));
        return $result[0];
    }
    
    /**
     * Retourne un item vide (pour la création)
     * @return modeleenregistrement (object)
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
     * Permet de s'avoir si un id existe ou non vrai si l'id existe
     * @param int - $valeurClePrimaire : id dont on souhaite connaitre l'existence
     * @return vrai si l'id existe, sinon faux
     */
    function exists($valeurClePrimaire) { 
        return sizeof($this->where('id=?',array($valeurClePrimaire))) > 0;
    }
}