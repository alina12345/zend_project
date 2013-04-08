<?php

class Application_Form_Addimages extends Zend_Form {

    public function init() {
        $this->setName("addimage");
        $this->setMethod('post');
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
        // create text input for name
        $photo_title = new Zend_Form_Element_Text('photo_title');
        $photo_title->setLabel('Photo Title:')
                ->setOptions(array('size' => '30'))
                ->setRequired(true)
                ->setValidators(array
                    (array
                        ('stringLength', false, array(0, 255))));
        $photo_name = new Zend_Form_Element_File('photo_name');
        $photo_name->setLabel('Upload an image (jpg,jpeg,png,gif):');
   
        // limits the filesize on the client side
        $photo_name->addValidator('Count', false, 1);                // ensure only 1 file
        $photo_name->addValidator('Size', false, 10240000);            // limit to 10 meg
        $photo_name->addValidator('Extension', false, 'jpg,jpeg,png,gif')
                ->setRequired(TRUE); // only JPEG, PNG, and GIFs
       
// create submit button
        $submit = new Zend_Form_Element_Submit(
                'submit', array('class' => 'submit'));
        $submit->setLabel('Save');
// attach elements to form
        $this->addElement($photo_title)
                ->addElement($photo_name)
                //->addElement($page_publish)
                ->addElement($submit);
    }

}
