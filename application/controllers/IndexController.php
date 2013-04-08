<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_layout = Zend_Layout::getMvcInstance();
        $this->_layout->setLayout('front_display');
    }
    
    public function indexAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('home');
        //print_r($data);die;
        $this->view->listdata = $data;
    }
  
    public function homeAction()
    {
      
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('home');
        //print_r($data);die;
        $this->view->listdata = $data;
 
    }
    
    public function aboutusAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('about_us');
        //print_r($data);die;
        $this->view->listdata = $data;
    }
    
    public function departmentsAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('departments');
        //print_r($data);die;
        $this->view->listdata = $data;
        
    }
    
    public function galleryAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('gallery');
        //print_r($data);die;
        $this->view->listdata = $data;  
    }
    
    public function contactusAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('contact_us');
        //print_r($data);die;
        $this->view->listdata = $data;
                
    }

}

