<?php

/**
 * Description de MVC_Formulaire
 * 
 * Classe principale
 * @package MVC_Formulaire
 */
class MVC_Formulaire {
    
    /**
     * Constante pour identer le code
     */
    const INDENT = true;
    
    /**
     * Le caractère ajouté pour un champ obligatoire
     */
    const CHARACTER_REQUIRED = '*';

    /**
     * Stocke les champs du formulaire
     * @var AssociativeArray(MVC_FormulaireChamp) 
     */
    private $_fields;

    /**
     * Stocke les champs cachés
     * @var array 
     */
    private $_hiddens;

    /**
     * Stocke les attributs des champs
     * @var AssociativeArray
     */
    private $_attributs;

    /**
     * Pour afficher les boutons 
     * @var boolean true 
     */
    private $_buttons;

    /**
     * Constructeur de la classe MVC_Formulaire
     * @param String $name nom du formulaire
     * @param String $action attribut action du formulaire
     * @param String $method attribut méthode du formulaire
     */
    public function __construct($name, $action = 'index.php', $method = "POST") {
        $this->_fields = array();
        $this->_hiddens = array();
        $this->_buttons = true;
        $this->_attributs = array(
            'name' => $name,
            'action' => $action,
            'method' => $method
        );
    }

    /**
     * Retourne l'attribut nom
     * @return String
     */
    public function getName() {
        return $this->_attributs['name'];
    }

    /**
     * Permet de cacher les boutons envoyer et reset
     * @return MVC_Formulaire
     */
    public function noButtons() {
        $this->_buttons = false;
        return $this;
    }

    /**
     * Permet d'ajouter un attribut au formulaire
     * @param String $key 
     * @param String $value 
     * @return mixed
     */
    public function addAttribute($key, $value) {
        return $this->_attributs[$key] = $value;
    }

    /**
     * Permet d'ajouter un champ au formulaire
     * @param MVC_FormulaireChamp $field
     * @return MVC_FormulaireChamp
     */
    private function addField(MVC_FormulaireChamp $field) {
        return $this->_fields[$field->getName()] = $field;
    }

    /**
     * Permet d'ajouter un champ input au formulaire
     * @param String $name
     * @param array $attributs
     * @param String $label 
     * @return MVC_FormulaireChamp
     */
    private function addInput($name, $attributs, $label) {
        $attributs['name'] = $name;
        return $this->addField(
                        new MVC_FormulaireChamp('input', $attributs, $label)
        );
    }

    /**
     * Méthode magique pour ajouter un champ caché
     * @param String $key
     * @param String $value
     * @return MVC_FormulaireChamp
     * @example $form->login='userLogin';
     */
    public function __set($key, $value) {
        return $this->addHidden($key, $value);
    }

    /**
     * Permet d'ajouter un champ caché au formulaire
     * @param String $key
     * @param String $value
     * @return MVC_FormulaireChamp
     * @example $form->addHidden('var','test');
     */
    public function addHidden($key, $value) {
        $hidden = new MVC_FormulaireChamp(
                        'input',
                        array('name' => $key, 'type' => 'hidden', 'value' => $value)
        );
        return $this->_hiddens[$key] = $hidden;
    }

    /**
     * Permet d'ajouter un champ texte au formulaire
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return MVC_FormulaireChamp 
     * @example $form->addText('date',array('size'=>10),'Date');
     * @example $form->addText('login',array(),'Username');
     */
    public function addText($name, $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['type'] = 'text';
        return $this->addInput($name, $attributs, $label);
    }

    /**
     * Permet d'ajouter un champ selecteur de fichiers au formulaire
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return MVC_FormulaireChamp 
     */
    public function addFile($name, $attributs = array(), $label = '') {
        $attributs['type'] = 'file';
        $attributs['name'] = $name;
        $this->_attributs['enctype'] = 'multipart/form-data';   //Obligatoire pour l'upload
        return $this->addInput($name, $attributs, $label);
    }

    /**
     * Permet d'ajouter un champ password au formulaire
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return MVC_FormulaireChamp 
     */
    public function addPassword($name, $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['type'] = 'password';
        return $this->addInput($name, $attributs, $label);
    }

    /**
     * Permet d'ajouter un champ textarea au formulaire
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return MVC_FormulaireChamp
     */
    public function addTextarea($name, $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        return $this->addField(
                        new MVC_FormulaireChamp('textarea', $attributs, $label)
        );
    }

    /**
     * Permet d'ajouter un champ select au formulaire
     * @param String $name
     * @param array $list
     * @param String $attributs
     * @param String $label
     * @return MVC_FormulaireChamp
     */
    public function addSelect($name, $list = array(), $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['_list'] = $list;
        return $this->addField(
                        new MVC_FormulaireChamp('select', $attributs, $label)
        );
    }

    /**
     * Permet d'ajouter un champ checkbox au formulaire
     * @param String $name
     * @param array $list
     * @param array $attributs
     * @param String $label
     * @return MVC_FormulaireChamp
     */
    public function addCheckbox($name, $list = array(), $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['_list'] = $list;
        return $this->addField(
                        new MVC_FormulaireChamp('checkbox', $attributs, $label)
        );
    }

    /**
     * Permet d'ajouter un bouton submit au formulaire
     * @param array $attributs
     * @return MVC_FormulaireChamp
     */
    public function addSubmit($attributs = array()) {
        $attributs['type'] = 'submit';
        return $this->addInput('_submit', $attributs, '');
    }

    /**
     * Permet d'ajouter un bouton reset au formulaire
     * @param array $attributs
     * @return MVC_FormulaireChamp
     */
    public function addReset($attributs = array()) {
        $attributs['type'] = 'reset';
        return $this->addInput('_reset', $attributs, '');
    }

    /**
     * Retourne un champ grâce à son attribut nom
     * @param String $name
     * @return MVC_FormulaireChamp
     */
    public function get($name) {
        if (isset($this->_fields[$name])) {
            return $this->_fields[$name];
        } elseif (isset($this->_hiddens[$name])) {
            return $this->_hiddens[$name];
        } else {
            throw new Exception("Index introuvable " . $name, 1);
        }
    }

    /**
     * Permet d'afficher le header (haut) du formulaire
     * @return String
     */
    public function header() {
        return '<form ' . MVC_Formulaire::attrToHTML($this->_attributs) . '>';
    }

    /**
     * Permet d'afficher le footer (la fin) du formulaire
     * @return string 
     */
    public function footer() {
        return '</form>';
    }

    /**
     * Permet de générer le HTML pour afficher le formulaire dans un tableau
     * @param array $attributs
     * @return string 
     */
    public function table($attributs = array()) {
        $html = $this->header();
        $html.=MVC_Formulaire::INDENT ? "\n" : '';
        /* champs cachés */
        foreach ($this->_hiddens as $hiddenElement) {
            $html.=$hiddenElement;
        }
        /* champs visibles */
        $html .= '<table' . MVC_Formulaire::attrToHTML($attributs) . '><tbody>';
        $html.=MVC_Formulaire::INDENT ? "\n" : '';
        foreach ($this->_fields as $field) {
            $html.=$field->table();
            $html.=MVC_Formulaire::INDENT ? "\n" : '';
        }
        if ($this->_buttons) {
            $submit = $this->addSubmit();
            $reset = $this->addReset();
            $html.='<tr><td colspan="2" align="center">'
                    . $reset
                    . $submit
                    . '</td></tr>';
            $this->remove($submit);
            $this->remove($reset);
        }
        $html.=MVC_Formulaire::INDENT ? "\n" : '';
        $html.='</tbody></table>';
        $html.=MVC_Formulaire::INDENT ? "\n" : '';
        $html.=$this->footer();
        return $html;
    }

    /**
     * Permet d'afficher le formulaire "inline"
     * @param boolean $br true: un br est ajouté après chaque champ
     * @return String 
     */
    public function inline($br = true) {
        $html = $this->header();
        //$html.=K_Form::INDENT?"\n":'';
        /* champs cachés */
        foreach ($this->_hiddens as $hiddenElement) {
            $html.=$hiddenElement;
        }
        /* champs visibles */
        $html.=MVC_Formulaire::INDENT ? "\n" : '';
        foreach ($this->_fields as $field) {
            $html.=$field->inline() . '<br />';
            $html.=MVC_Formulaire::INDENT ? "\n" : '';
        }
        if ($this->_buttons) {
            $submit = $this->addSubmit();
            $reset = $this->addReset();
            $html.=$reset
                    . $submit;
            $this->remove($submit);
            $this->remove($reset);
        }
        $html.=MVC_Formulaire::INDENT ? "\n" : '';
        $html.=$this->footer();
        return $html;
    }
    /**
     * Permet d'enlever un champ du formulaire
     * @param FormField $field
     * @return \MVC_Formulaire
     */
    function remove($field){
        unset($this->_fields[$field->getName()]);
        unset($field);
        return $this;
    }
    /**
     * Méthode statique pour afficher les attributs
     * @param array $attr
     * @return string 
     */
    public static function attrToHTML($attr) {
        $html = '';
        foreach ($attr as $key => $value) {
            if (substr($key, 0, 1) != '_')
            //$html.=' ' . $key . '="' . htmlentities($value) . '"';
                $html.=' ' . $key . '="' . $value . '"';
        }
        return $html;
    }

    /**
     * Permet de peupler le formulaire avec un objet
     * @param Object $object 
     * @return MVC_Formulaire
     */
    private function populateObject($object) {
        foreach ($this->_fields as $element) {
            $name = $element->getName();
            if (!isset($element->value) and isset($object->$name)) {
                $element->value = $object->$name;
            }
        }
        return K_Form;
    }

    /**
     * Permet de peupler le formulaire avec un tableau
     * @param type $array
     * @return MVC_Formulaire
     */
    private function populateArray($array) {
        foreach ($this->_fields as $element) {
            $name = $element->getName();
            if (!isset($element->value) and isset($array[$name])) {
                $element->value = $array[$name];
            }
        }
        return $this;
    }

    /**
     * Permet de peupler le formulaire avec un objet ou un tableau associatif
     * @param type $values
     * @return type
     * @throws Exception 
     */
    public function populate($values) {
        if (is_array($values)) {
            return $this->populateArray($values);
        } elseif (is_object($values)) {
            return $this->populateObject($values);
        } else {
            $e = new Exception('MVC_Formulaire::populate : le paramètre doit être un objet ou un tableau associatif');
            throw $e;
        }
    }

}
