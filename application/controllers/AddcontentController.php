<?php

class AddcontentController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function addcontentAction()
    {
        $request = $this->getRequest(); 
        $form    = new Application_Form_Addcontent();
//         if ($this->getRequest()->isPost()) 
//         {
//            if ($form->isValid($request->getPost()))
//            {
//                $data = new Application_Model_addcontent($form->getValues());
//                return $this->_helper->redirector('index');
//            }
//        }
 
        $this->view->form = $form;
        
//        $this->view->headScript()->appendFile($this->view->baseUrl().'/includes/ckeditor/ckeditor.js');
//        // if the form is submitted
//	if($this->_request->isPost()) 
//        {
//	    $editor1 = stripslashes($this->_request->getPost('editor1'));
//	    echo $editor1;
//	    exit();
//	}
    }
}
?>
