<?php

class Application_Form_Addcontent extends Zend_Form
{
    public function init() 
    {
        $this->setName('addcontent');
        $this->setMethod('post');
        
        $pagetitle = new Zend_Form_Element_Text('pagetitle');
        $pagetitle->setLabel('Page Title')
                  ->setOptions(array('size' =>'50'))
                  ->setRequired(true)
                  ->setValidators(array(array('stringlength',false,array(0,50))));
        
        $pagecontent = new Zend_Form_Element_Textarea('pagecontent');
        $pagecontent->setLabel('Content')
                  ->setOptions(array('size' =>'500'))
                  ->setRequired(true)
                  ->setValidators(array(array('stringlength',false,array(0,500))));
        
        $page_publish = new Zend_Form_Element_Radio('page_publish');
        $page_publish->setLabel('Publish :')
                     ->addMultiOptions(array(
                        'yes' => 'Publish',
                        'no' => 'Do not Publish'))
                     ->setValue('yes')
                     ->setSeparator('');
        
        $submit = new Zend_Form_Element_Submit('submit', array(
                        'label' => 'Submit',
                        'class' => 'submit'));
        
        $this->addElement($pagetitle)
             ->addElement($pagecontent)
             ->addElement($page_publish)
             ->addElement($submit);
    }
}
?>
