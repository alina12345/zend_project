<?php

class Application_Form_Signup extends Zend_Form
{
 public function init()
    {
        $this->setMethod('post');
        
        $this->setName('loginform');
        
        //text input for firstname
        $firstname = new Zend_Form_Element_Text('firstname');
        $firstname->setLabel('First Name:*')
                  ->setOptions(array('size'=>'25'))
                  ->setRequired(true);
        
        //text input for middlename
        $middlename = new Zend_Form_Element_Text('middlename');
        $middlename->setLabel('Middle Name')
                   ->setOptions(array('size'=>'25'))
                  ->setRequired(false);
        
        //text input for lastname
        $lastname = new Zend_Form_Element_Text('lastname');
        $lastname->setLabel('Last Name:*')
                 ->setOptions(array('size'=>'25'))
                  ->setRequired(true);
        
        //text input for email
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:*')
              ->setOptions(array('size'=>'25'))
              ->addFilters(array('StringTrim','StripTags'))
              ->addValidator('EmailAddress',TRUE)
              ->setRequired(true);
        
        
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
                
                 
        
        $confirmPassword=new Zend_Form_Element_Password('confirmPassword');
        $confirmPassword->setLabel('ConfirmPassword:*')
                        ->setOptions(array('size'=>'25'))
                        ->setRequired(true);
                        //->setMd5($confirmPassword);
                 
        
        
        //text input for submit button
        $submit = new Zend_Form_Element_Submit(
        'submit', array('class' => 'submit'));
        $submit->setLabel('Login')
               ->setIgnore(true);
                           
        // attach elements to form
        $this->addElement($firstname)
             ->addElement($middlename)
             ->addElement($lastname)
             ->addElement($username)
             ->addElement($password)
             ->addElement($confirmPassword)
             ->addElement($email)
             ->addElement($submit);
             
    }
}