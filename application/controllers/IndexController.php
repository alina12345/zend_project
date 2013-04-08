<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    public function lfcmsAction()
    {
        echo 'ldsdlasdf';
        $test='hello test';//$this->render('scripts/lfcms/lfcms');
        $this->view->tdata =  $test;
        
    }
    public function frontAction()
    {
        
    }

}

