<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_layout = Zend_Layout::getMvcInstance();
        $this->_layout->setLayout('front_layout');
    }

    public function indexAction()
    {
        // action body
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('home');
        //print_r($data);die;
        $this->view->listdata = $data;
        
        $Objshow1 = new Application_Model_DbTable_Frontmodel();
        $dataa = $Objshow1->getPages('homee');
        $this->view->listdata1 = $dataa;
    }
    
    public function lfcmsAction()
    {
        echo 'ldsdlasdf';
        $test='hello test';//$this->render('scripts/lfcms/lfcms');
        $this->view->tdata =  $test;
        
    }
    public function partpageAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('homee');
        $this->view->listdataa = $data;
    }
    
    
    
    public function aboutusAction()
    {
         
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('about_us');
        $this->view->listdata = $data;
    }
    
    public function departmentAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('department');
        $this->view->listdata = $data;
    }
    
    public function galleryAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('gallery');
        $this->view->listdata = $data;
    }
    
    public function contactusAction()
    {
        $Objshow = new Application_Model_DbTable_Frontmodel();
        $data = $Objshow->getPages('contact_us');
        $this->view->listdata = $data;
    }

}

