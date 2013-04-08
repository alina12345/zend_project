<?php

class Application_Form_Loginform extends Zend_Form
{
    
    
    public function init()
    {
        $this->setMethod('post');
        $this->setAction('auth');
        $this->setName('loginform');
        
        
        //text input for username
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:*')
                 ->setOptions(array('size'=>'25'))
                 ->setRequired(true);
                 
                 
        
        //text input for password
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:*')
                 ->setOptions(array('size'=>'25'))
                 ->setRequired(true);
        
        
        //text input for submit button
        $submit = new Zend_Form_Element_Submit(
        'submit', array('class' => 'submit'),array(
            'ignore'   => true));
        $submit->setLabel('Login')
               ->setIgnore(true);
                           
        // attach elements to form
        $this->addElement($username)
             ->addElement($password)
             ->addElement($submit);
             
    }
}