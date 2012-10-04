<?php
class MVC_ModeleEnregistrement extends stdClass {

    /**
     * Insere ou met a jour un enregistrement dans une table de la bdd
     * @param type : String - $table : table de la bdd concernee ou l'ajout ou la modification doit avoir lieu
     * valeur par defaut : null
     *      Si la table n'est pas specifiee, on considere qu'on travaille sur la table concernee par l'objet
     * @return MVC_ModeleEnregistrement : enregistrement forme a partir des donnees saisies ou crees a partir de la table
     */
    public function enregistrer($table = null) {
        if (is_null($table)) {
            $table = $this->_table;
        }

        $attributs = get_object_vars($this);
        //suppression des attributs de la classe ModeleEnregistrement commenceant par un underscore ('_')
        foreach ($attributs as $key => $value) {
            if (substr($key, 0, 1) == '_') {
                unset($attributs[$key]);
            }
        }
        
        $values = array_values($attributs);
        
        if (isset($this->id) and !is_null($this->id)) {
            //Si l'id est defini et n'est pas null, on en deduit qu'il s'agit d'une modification
            $query = 'update ' . $table . ' set ';
            $query.=implode('=?,', array_keys($attributs)) . '=?';
            $query.=' where id=?';
            $values[] = $this->id;
        } else {
            //Si l'id est null, c'est donc un nouvel enregistrement
            $query = 'insert into '
                    . $table
                    . '(' . implode(',', array_keys($attributs)) . ') values ('
                    . substr(str_repeat('?,', sizeof($attributs)), 0, -1) . ')';
        }
        $queryPrepare = MVC_Modele::pdo()->prepare($query);
        if (!$queryPrepare->execute($values)) {
            $error = $queryPrepare->errorInfo();
            throw new Exception("\nPDO::errorInfo():\n" . $error[2]);
        };
        if (!isset($this->id)) {
            $this->id = MVC_Modele::pdo()->lastInsertId();
        }
        return $this;
    }

    /**
     * Supprime un enregistrement dans une table
     * @param type : String - $table : table de la bdd concernee ou la suppression doit avoir lieu
     * valeur par defaut : null
     *      Si la table n'est pas specifiee, on considere qu'on travaille sur la table concernee par l'objet
     */
    function supprimer($table = null) {
        if (is_null($table)) {
            $table = $this->_table;
        }
        $query = 'delete from ' . $table . ' where id=?';
        $queryPrepare = MVC_Modele::pdo()->prepare($query);
        if (!$queryPrepare->execute(array($this->id))) {
            $error = $queryPrepare->errorInfo();
            throw new Exception("\nPDO::errorInfo():\n" . $error[2]);
        };
    }
    
    /**
     * Permet de définir le nom de la table
     * @param string - $table : nom de la table
     */
    function setTable($table) {
        $this->_table = $table;
    }

}