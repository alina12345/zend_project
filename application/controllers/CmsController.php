<?php

class CmsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {
            $this->_redirect('login/usercheck');
        }
    }

    public function addcontentAction() {
        $form = new Application_Form_Addform();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            //print_r($formData);

            if ($form->isValid($formData)) {

                $values = $form->getValues();
                if (isset($values['page_publish'])) {
                    if ($values['page_publish'] == yes) {
                        $values['page_publish'] = 1;
                    }
                    else
                        $values['page_publish'] = 0;
                }
                $Savedata = new Application_Model_DbTable_Cmsform();

                $check = $Savedata->insert($values);
                if ($check) {
                    echo 'Page saved successfully';
                    $this->_helper->redirector->gotoRoute(array
                        ('controller' => 'cms',
                        'action' => 'showcontents'));
                } else {
                    echo 'Insertion error';
                    die;
                }
            } else {
                echo 'Invalid form data';
            }
        }
    }

    public function showcontentsAction() {
        $Objshow = new Application_Model_DbTable_Cmsform();
        $data = $Objshow->getPages();

        $this->view->listdata = $data;
    }

    public function deletecontentsAction() {
        $objdelete = new Application_Model_DbTable_Cmsform();
        $id = $this->_getParam('page_id');
        $data = $objdelete->deletePage($id);
        $this->_helper->redirector('showcontents');

        // $this->view->del = $data;
    }

    public function addimagesAction() {
        //echo 'asdffasd';die;

        $form = new Application_Form_Addimages();

        // print_r($form);die;
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads';
            // print_r($uploadPath);die;
            $adapter = new Zend_File_Transfer_Adapter_Http();
            $adapter->setDestination($uploadPath);

            $upload = new Zend_File_Transfer();
            $info = $upload->getFileInfo();



            if ($form->isValid($formData) && $adapter->receive()) {


                $values = $form->getValues();
                $values['photo_name'] = $info['photo_name']['name'];

                $Savedata = new Application_Model_DbTable_Gallerymodel();

                $check = $Savedata->insert($values);
                if ($check) {
                    echo 'Image saved successfully';
                    $this->_helper->redirector->gotoRoute(array
                        ('controller' => 'cms',
                        'action' => 'showimages'));
                } else {
                    echo 'Insertion error';
                    die;
                }
            } else {
                echo 'Invalid form data';
            }
        }
    }

    public function showimagesAction() {
        $Objshow = new Application_Model_DbTable_Cmsform();
        $data = $Objshow->getImages();

        $this->view->listdata = $data;
    }

    public function deletephotoAction() {
        $objdelete = new Application_Model_DbTable_Cmsform();
        $id = $this->_getParam('photo_id');
        $deletecheck = $objdelete->deletePhoto($id);

        $this->_helper->redirector('showimages');
    }

    public function dashboardAction() {
        /* Initialize action controller here */
        //$storage = new Zend_Auth_Storage_Session();
        $auth = Zend_Auth::getInstance();
        //print_r($auth->getIdentity());die;
        if (!$auth->hasIdentity()) {
            $this->_redirect('login/usercheck');
        }

        $this->view->username = $auth->getIdentity()->username;
    }

    public function logoutAction() {

        Zend_Auth::getInstance()->clearIdentity();

        $this->_helper->redirector->gotoRoute(array
            ('controller' => 'login',
            'action' => 'usercheck')); // back to login page
    }
    
    public function siteAction(){
        Zend_Layout::getMvcInstance()->setLayout('front_display');
        //$this->_helper->_layout->setLayout('application/layouts/scripts/front_layout');
        $test='test data  for view';
        $this->view->contents = $test;
        
    }

}
