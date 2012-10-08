<?php

/**
 * Description of Form
 * 
 * Principal class
 * @package K_Form
 */
class K_Form {
    /**
     * const to indent HTML code 
     */

    const INDENT = true;
    /**
     * character added to required field
     */
    const CHARACTER_REQUIRED = '*';

    /**
     * store form's elements
     * @var AssociativeArray(K_FormField) 
     */
    private $_fields;

    /**
     * store hidden elements
     * @var array 
     */
    private $_hiddens;

    /**
     * store form's attributs
     * @var AssociativeArray
     */
    private $_attributs;

    /**
     * to display buttons 
     * @var boolean true 
     */
    private $_buttons;

    /**
     * Constructor
     * @param String $name form's name
     * @param String $action attribute action of the form
     * @param String $method attribute method of the form
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
     *  return name attribut
     * @return String
     */
    public function getName() {
        return $this->_attributs['name'];
    }

    /**
     * method to hide submit and reset buttons 
     * @return K_Form
     */
    public function noButtons() {
        $this->_buttons = false;
        return $this;
    }

    /**
     * add an attribute to the form
     * @param String $key 
     * @param String $value 
     * @return mixed
     */
    public function addAttribute($key, $value) {
        return $this->_attributs[$key] = $value;
    }

    /**
     * add a field to the form
     * @param K_FormField $field
     * @return K_FormField
     */
    private function addField(K_FormField $field) {
        return $this->_fields[$field->getName()] = $field;
    }

    /**
     * Add an input field to the form
     * @param String $name
     * @param array $attributs
     * @param String $label 
     * @return K_FormField
     */
    private function addInput($name, $attributs, $label) {
        $attributs['name'] = $name;
        return $this->addField(
                        new K_FormField('input', $attributs, $label)
        );
    }

    /**
     * magic method to add hidden field
     * @param String $key
     * @param String $value
     * @return K_FormField
     * @example $form->login='userLogin';
     */
    public function __set($key, $value) {
        return $this->addHidden($key, $value);
    }

    /**
     * Add an hidden field to the Form
     * @param String $key
     * @param String $value
     * @return K_FormField
     * @example $form->addHidden('var','test');
     */
    public function addHidden($key, $value) {
        $hidden = new K_FormField(
                        'input',
                        array('name' => $key, 'type' => 'hidden', 'value' => $value)
        );
        return $this->_hiddens[$key] = $hidden;
    }

    /**
     * Add a text input to the form
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return K_FormField 
     * @example $form->addText('date',array('size'=>10),'Date');
     * @example $form->addText('login',array(),'Username');
     */
    public function addText($name, $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['type'] = 'text';
        return $this->addInput($name, $attributs, $label);
    }

    /**
     * add a file field to the form
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return K_FormField 
     */
    public function addFile($name, $attributs = array(), $label = '') {
        $attributs['type'] = 'file';
        $attributs['name'] = $name;
        $this->_attributs['enctype'] = 'multipart/form-data';
        return $this->addInput($name, $attributs, $label);
    }

    /**
     * Add a password input to the form
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return K_FormField 
     */
    public function addPassword($name, $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['type'] = 'password';
        return $this->addInput($name, $attributs, $label);
    }

    /**
     * Add a textarea to the form
     * @param String $name
     * @param array $attributs
     * @param String $label
     * @return K_FormField 
     */
    public function addTextarea($name, $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        return $this->addField(
                        new K_FormField('textarea', $attributs, $label)
        );
    }

    /**
     * Add a select to the form
     * @param String $name
     * @param array $list
     * @param String $attributs
     * @param String $label
     * @return K_FormField 
     */
    public function addSelect($name, $list = array(), $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['_list'] = $list;
        return $this->addField(
                        new K_FormField('select', $attributs, $label)
        );
    }

    /**
     * add a checkbox to the form
     * @param String $name
     * @param array $list
     * @param array $attributs
     * @param String $label
     * @return K_FormField
     */
    public function addCheckbox($name, $list = array(), $attributs = array(), $label = '') {
        $attributs['name'] = $name;
        $attributs['_list'] = $list;
        return $this->addField(
                        new K_FormField('checkbox', $attributs, $label)
        );
    }

    /**
     * Add a submit button
     * @param array $attributs
     * @return K_FormField
     */
    public function addSubmit($attributs = array()) {
        $attributs['type'] = 'submit';
        return $this->addInput('_submit', $attributs, '');
    }

    /**
     * Add a reset button
     * @param array $attributs
     * @return K_FormField 
     */
    public function addReset($attributs = array()) {
        $attributs['type'] = 'reset';
        return $this->addInput('_reset', $attributs, '');
    }

    /**
     * return the field with the given name
     * @param String $name
     * @return K_FormField 
     */
    public function get($name) {
        if (isset($this->_fields[$name])) {
            return $this->_fields[$name];
        } elseif (isset($this->_hiddens[$name])) {
            return $this->_hiddens[$name];
        } else {
            throw new Exception("Index undefined " . $name, 1);
        }
    }

    /**
     * methods to display header form 
     * @return String
     */
    public function header() {
        return '<form ' . K_Form::attrToHTML($this->_attributs) . '>';
    }

    /**
     * method to close form tag
     * @return string 
     */
    public function footer() {
        return '</form>';
    }

    /**
     * generate html to display form with a table
     * @param array $attributs
     * @return string 
     */
    public function table($attributs = array()) {
        $html = $this->header();
        $html.=K_Form::INDENT ? "\n" : '';
        /* hiddens fields */
        foreach ($this->_hiddens as $hiddenElement) {
            $html.=$hiddenElement;
        }
        /* visible fields */
        $html .= '<table' . K_Form::attrToHTML($attributs) . '><tbody>';
        $html.=K_Form::INDENT ? "\n" : '';
        foreach ($this->_fields as $field) {
            $html.=$field->table();
            $html.=K_Form::INDENT ? "\n" : '';
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
        $html.=K_Form::INDENT ? "\n" : '';
        $html.='</tbody></table>';
        $html.=K_Form::INDENT ? "\n" : '';
        $html.=$this->footer();
        return $html;
    }

    /**
     * display the form inlin
     * @param boolean $br true: a br is added after each field
     * @return String 
     */
    public function inline($br = true) {
        $html = $this->header();
        //$html.=K_Form::INDENT?"\n":'';
        /* hiddens fields */
        foreach ($this->_hiddens as $hiddenElement) {
            $html.=$hiddenElement;
        }
        /* visible fields */
        $html.=K_Form::INDENT ? "\n" : '';
        foreach ($this->_fields as $field) {
            $html.=$field->inline() . '<br />';
            $html.=K_Form::INDENT ? "\n" : '';
        }
        if ($this->_buttons) {
            $submit = $this->addSubmit();
            $reset = $this->addReset();
            $html.=$reset
                    . $submit;
            $this->remove($submit);
            $this->remove($reset);
        }
        $html.=K_Form::INDENT ? "\n" : '';
        $html.=$this->footer();
        return $html;
    }
    /**
     * Remove a field from the Form
     * @param FormField $field
     * @return \K_Form 
     */
    function remove($field){
        unset($this->_fields[$field->getName()]);
        unset($field);
        return $this;
    }
    /**
     * static method to display attributs
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
     * to populate the form with an object
     * @param Object $object 
     * @return K_Form
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
     * to populate the form with an array
     * @param type $array
     * @return K_Form
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
     * to populate the form with an associative array or an object
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
            $e = new Exception('K_Form::populate : param must be an associative array or an object');
            throw $e;
        }
    }

}
