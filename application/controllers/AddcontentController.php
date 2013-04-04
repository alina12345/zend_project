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
        
        
    }
}
?>
