<?php

class Application_Form_Loginform extends Zend_Form {

    public function init() {
        $this->setName("loginform");
        $this->setMethod('post');
        $this->setAction(login/usercheck);
        //print_r($pat);
        // create text input for username
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:')
                ->setOptions(array('size' => '20'))
                ->setRequired(true)
                ->addFilter('stringTrim')
                ->setValidators(array
                    (array
                        ('stringLength',false,array(0,50))));
        // create text input for password
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:');
        $password->setOptions(array('size' => '20'))
                ->setRequired(true)
                ->addFilter('stringTrim')
                ->addValidators(array(array('stringLength',false,array(0,50))));
       
// create submit button
        $submit = new Zend_Form_Element_Submit(
                'submit', array('class' => 'submit'));
        $submit->setLabel('Login');
// attach elements to form
        $this->addElement($username)
                ->addElement($password)
                ->addElement($submit);

    }

}
