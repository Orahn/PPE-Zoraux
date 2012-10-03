<?php

/**
 * Description of FormField
 * 
 * used with Form
 * @package K_Form
 */
class K_FormField {

    /**
     * label
     * @var string
     */
    private $_label;

    /**
     * attributes
     * @var array
     */
    private $_attr;

    /**
     * tag
     * @var string
     */
    private $_tag;

    /**
     * to define a required field
     * @var boolean
     */
    private $_required;

    /**
     * Constructeur
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
     * Add a character to show a required field 
     * @return FormField
     */
    function required() {
        $this->_required = true;
        return $this;
    }

    /**
     * return the field id attribute
     * if the id attribute is not defined, one is create
     * @return String 
     */
    function getId() {
        if (!isset($this->_attr['id'])) {
            $this->_attr['id'] = uniqid();
        }
        return $this->_attr['id'];
    }

    /**
     * return name attribut
     * @return string
     */
    function getName() {
        return $this->_attr['name'];
    }

    /**
     * return the label
     * @return string
     */
    function getLabel() {
        return $this->_label;
    }

    /**
     * set an attribute
     * @param string $attr
     * @param string $value 
     */
    function __set($attr, $value) {
        $this->_attr[$attr] = $value;
    }

    /**
     * test the attribute existence
     * @param String $attr
     * @return Boolean 
     */
    function __isset($attr) {
        return isset($this->_attr[$attr]);
    }

    /**
     * generate the HTML string field
     * @return string
     */
    public function __toString() {
        $method = 'toString' . ucFirst($this->_tag);
        return $this->$method();
    }

    /**
     * generate the HTML string for an input field
     * @return string
     */
    private function toStringInput() {
        return '<input' . K_Form::attrToHTML($this->_attr) . ' />';
    }

    /**
     * generate the HTML string for an textarea field
     * @return string
     */
    private function toStringTextarea() {
        if (isset($this->_attr['value'])) {
            $_value = $this->_attr['value'];
            unset($this->_attr['value']);
        } else {
            $_value = '';
        }

        return '<textarea' . K_Form::attrToHTML($this->_attr) . ' >' . $_value . '</textarea>';
    }

    /**
     * generate the HTML string for a select field
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

        $html = '<select ' . K_Form::attrToHTML($this->_attr) . '>';
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
     * generate the HTML string for an input checkbox field
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
            $html.='<input  type="checkbox" ' . K_Form::attrToHTML($this->_attr) .' id="'.$id.'_'.$val.'" value="' . $val . '"> ';
            $html.= $label . '</label>';
        }
        return $html;
    }

    /**
     * generate the HTML string for the field label
     * @return string 
     */
    function labelToString() {
        $html='';
        if ($this->_label != '') {
            $html.= '<label for="' . $this->getId() . '">';
            if ($this->_required) {
                $this->_label.=K_Form::CHARACTER_REQUIRED;
            }
            $html.=$this->_label . ':&nbsp;';
            $html.='</label>';
        } else {
            $html.=$this->_label;
        }
        return $html;
    }

    /**
     * generate the HTML string to display the form in a table
     * @return string 
     */
    function table() {
        return '<tr><td>'
                . $this->labelToString()
                . '</td><td>'
                . $this->__toString()
                . '</td></tr>';
    }
    /**
     * generate the HTML string to display form fields inline
     * @return String
     */
    function inline() {
        return $this->labelToString()
                . $this->__toString();
    }

}
