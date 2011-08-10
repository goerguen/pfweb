<?php

class Application_Form_LogIn extends Zend_Form
{
    public function init()
    {
        $this->setName('logIn');

        $verlag = new Zend_Form_Element_Text('Verlag');
        $verlag->setLabel('Verlag')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $username = new Zend_Form_Element_Text('Username');
        $username->setLabel('Username')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $password = new Zend_Form_Element_Password('Passwort');
        $password->setLabel('Passwort')
        		 ->addValidator('NotEmpty')
         		 ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($verlag, $username, $password, $submit));
    }
}