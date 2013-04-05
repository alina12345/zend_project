<?php

class Application_Form_Addcontent extends Zend_Form
{
    public function init() 
    {
        $this->setName("addcontent");
        $this->setMethod('post');
        // create text input for name
        $page_title = new Zend_Form_Element_Text('page_title');
        $page_title->setLabel('Page Title:')
                ->setOptions(array('size' => '40'))
                ->setRequired(true)
                ->setValidators(array
                    (array
                        ('stringLength',false,array(0,255))));
        // create text input for email address
        $page_content = new Zend_Form_Element_Textarea('page_content');
        $page_content->setLabel('Content:');
        $page_content->setOptions(array('size' => '500'))
                ->setRequired(true)
                ->setValidators(array
                    (array
                        ('stringLength',false,array(0,500))));
  $page_publish = new Zend_Form_Element_Radio('page_publish');
 $page_publish->setLabel('Publish :')
                     ->addMultiOptions(array(
                        'yes' => 'Publish',
                        'no' => 'Do not Publish'))
                     ->setValue('yes')
                     ->setSeparator('');
               
// create submit button
        $submit = new Zend_Form_Element_Submit(
                'submit', array('class' => 'submit'));
        $submit->setLabel('Save');
// attach elements to form
        $this->addElement($page_title)
                ->addElement($page_content)
                ->addElement($page_publish)
                ->addElement($submit);
    }
}
?>
