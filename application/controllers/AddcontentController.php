<?php

class AddcontentController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function addcontentAction()
    {
        $form  = new Application_Form_Addcontent();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) 
         {
            $formData = $this->getRequest()->getPost();
             if ($form->isValid($formData))
            {
                 
                 $values = $form->getValues();   //copy values from form
                        
                //print_r($values);die;
                        // check if the published is checked or not and set value in database
                if(isset($values['page_publish']))
                {
                    if($values['page_publish']==yes)
                    {
                        $values['page_publish']=1;
                    }
                    else {$values['page_publish']=0;}
                }
                
                        //insert into database
                $Savedata = new Application_Model_DbTable_cms();
                $save = $Savedata->insert($values);
                
                if($save)
                {
                    echo 'Page saved successfully!'; 
                    $this->_helper->redirector('addcontent');
                }
                else { echo 'Insertion error!'; die;}
            }
        }
  
    }      
}
?>
