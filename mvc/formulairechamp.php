<?php

/**
 * Description de FormulaireChamp
 * 
 * Utilisé avec MVC_Formulaire
 * 
 * @package MVC_FormulaireChamp
 */
class MVC_FormulaireChamp {

    /**
     * libellé
     * @var string
     */
    private $_label;

    /**
     * attributs
     * @var array
     */
    private $_attr;

    /**
     * TAG
     * @var string
     */
    private $_tag;

    /**
     * Pour définir un champ obligatoire
     * @var boolean
     */
    private $_required;

    /**
     * Constructeur de la classe MVC_FormulaireChamp
     * @param string $tag
     * @param array $attributs
     * @param string $label 
     */
    function __construct($tag, $attributs = array(), $label = null) {
        $this->_tag = $tag;
        $this->_attr = $attributs;
        $this->_label = $label;
        $this->_required = false;
    }
    /**
     * Ajoute un caractère pour montrer un champ obligatoire
     * @return FormField
     */
    function required() {
        $this->_required = true;
        return $this;
    }

    /**
     * Retourne l'attribut id du champ
     * Si l'id n'est pas défini, il sera créé automatiquement avec uniqid()
     * @return String 
     */
    function getId() {
        if (!isset($this->_attr['id'])) {
            $this->_attr['id'] = uniqid();
        }
        return $this->_attr['id'];
    }

    /**
     * Retourne l'attribut nom du champ
     * @return string
     */
    function getName() {
        return $this->_attr['name'];
    }

    /**
     * Retourne le libellé du champ
     * @return string
     */
    function getLabel() {
        return $this->_label;
    }

    /**
     * Permet de définir un attribut
     * @param string $attr
     * @param string $value 
     */
    function __set($attr, $value) {
        $this->_attr[$attr] = $value;
    }

    /**
     * Teste l'existence d'un attribut
     * @param String $attr
     * @return Boolean 
     */
    function __isset($attr) {
        return isset($this->_attr[$attr]);
    }

    /**
     * Permet de générer le HTML en string d'un champ
     * @return string
     */
    public function __toString() {
        $method = 'toString' . ucFirst($this->_tag);
        return $this->$method();
    }

    /**
     * Permet de générer le HTML d'un champ input
     * @return string
     */
    private function toStringInput() {
        return '<input' . MVC_Formulaire::attrToHTML($this->_attr) . ' />';
    }

    /**
     * Permet de générer le HTML d'un champ textarea
     * @return string
     */
    private function toStringTextarea() {
        if (isset($this->_attr['value'])) {
            $_value = $this->_attr['value'];
            unset($this->_attr['value']);
        } else {
            $_value = '';
        }

        return '<textarea' . MVC_FormulaireChamp::attrToHTML($this->_attr) . ' >' . $_value . '</textarea>';
    }

    /**
     * Permet de générer le HTML d'un champ select
     * @return string 
     */
    private function toStringSelect() {
        if (isset($this->_attr['value'])) {
            $_value = $this->_attr['value'];
            unset($this->_attr['value']);
        } else {
            $_value = '';
        }

        $list = $this->_attr['_list'];
        unset($this->_attr['list']);

        $html = '<select ' . MVC_Formulaire::attrToHTML($this->_attr) . '>';
        foreach ($list as $val => $label) {
            if ($val == $_value) {
                $html.='<option value="' . $val . '" selected>' . $label . '</option>';
            } else {
                $html.='<option value="' . $val . '">' . $label . '</option>';
            }
        }
        $html.='</select>';
        return $html;
    }

    /**
     * Permet de générer le HTML d'un champ checkbox
     * @return string 
     */
    private function toStringCheckbox() {

        if (isset($this->_attr['value'])) {
            $_value = $this->_attr['value'];
            if(!is_array($_value)){
                $_value=array($_value);
            }
            unset($this->_attr['value']);
        } else {
            $_value = array();
        }

        $list = $this->_attr['_list'];
        unset($this->_attr['list']);
        if (substr($this->_attr['name'], -2) != '[]') {
            $this->_attr['name'].='[]';
        }
        $html = '';
        $id=$this->getId();
        unset($this->_attr['id']);
        foreach ($list as $val => $label) {
            if (in_array($val, $_value)) {
                $this->_attr['checked'] = 'checked';
            } else {
                unset($this->_attr['checked']);
            }
            $html.='<label for="' . $id.'_'.$val. '">';
            $html.='<input  type="checkbox" ' . MVC_Formulaire::attrToHTML($this->_attr) .' id="'.$id.'_'.$val.'" value="' . $val . '"> ';
            $html.= $label . '</label>';
        }
        return $html;
    }

    /**
     * Permet de générer le HTML d'un champ label
     * @return string 
     */
    function labelToString() {
        $html='';
        if ($this->_label != '') {
            $html.= '<label class="input blue-gradient full-width" style="text-align:center" for="' . $this->getId() . '">';
            if ($this->_required) {
                $this->_label.=K_Form::CHARACTER_REQUIRED;
            }
            $html.=$this->_label . '&nbsp;';
            $html.='</label>';
        } else {
            $html.=$this->_label;
        }
        return $html;
    }

    /**
     * Permet de générer le HTML pour placer le formulaire dans un tableau
     * @return string 
     */
    function table() {
        return '<tr><td style="vertical-align:middle" align="right">'
                . $this->labelToString()
                . '</td><td style="vertical-align:middle">'
                . $this->__toString()
                . '</td></tr><tr><td><br /></td><td></td></tr>';
    }
    
    /**
     * Permet de générer le HTML pour afficher les champs du formulaire "inline"
     * @return String
     */
    function inline() {
        return $this->labelToString()
                . $this->__toString();
    }

}
