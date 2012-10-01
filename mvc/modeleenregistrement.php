<?php
class MVC_ModeleEnregistrement extends stdClass{
    /**
     * Enregistrement dans une table de la base de données
     * @param type $table
     * @return \MVC_ModeleEnregistrement
     * @throws Exception
     */
    public function enregistrer($table = null) {
        if (is_null($table)) {
            $table = $this->_table;
        }

        $attributs = get_object_vars($this);
        //suppression des attributs de la classe ModeleEnregistrement
        foreach ($attributs as $key => $value) {
            if (substr($key, 0, 1) == '_') {
                unset($attributs[$key]);
            }
        }

        $values = array_values($attributs);
        if (isset($this->id) and !is_null($this->id)) {
            $query = 'update ' . $table . ' set ';
            $query.=implode('=?,', array_keys($attributs)) . '=?';
            $query.=' where id=?';
            $values[] = $this->id;
        } else {
            if($table=='article'){
                $query = 'insert into '
                        . $table
                        . '(' . implode(',', array_keys($attributs)) . ',date) values ('
                        . substr(str_repeat('?,', sizeof($attributs)), 0, -1) . ',"'.date('Y-m-d').'")';
            }else{
                $query = 'insert into '
                        . $table
                        . '(' . implode(',', array_keys($attributs)) . ') values ('
                        . substr(str_repeat('?,', sizeof($attributs)), 0, -1) . ')';
            }
            
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
     * Supprime un enregistrement de la table
     * @param type $table
     * @throws Exception
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
     * @param string $table
     */
    function setTable($table) {
        $this->_table = $table;
    }
    
}