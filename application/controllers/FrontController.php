<?php
class FrontController extends Zend_Controller_Action{
    
    public function init(){
        $this->_layout = Zend_Layout::getMvcInstance();
        $this->_layout->setLayout('front_display');
        
    }
  
    public function homeAction()
    {
       // echo 'asdf'; die;
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('home');
        //print_r($data);die;
        $this->view->listdata = $data;
 
    }
    
    public function aboutusAction()
    {
        
    }
    
    public function departmentsAction()
    {
        
    }
    
    public function galleryAction()
    {
        
    }
    
    public function contactusAction()
    {
                
    }
    
}

?>
