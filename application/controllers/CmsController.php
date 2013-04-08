<?php

class CmsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
         $auth = Zend_Auth::getInstance();
        //print_r($auth->getIdentity());die;
        if(!$auth->hasIdentity()){$this->_redirect('login/login');}

        $this->view->username = $auth->getIdentity()->username;
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
                
                
                if (!$check) {
                    echo 'Page saved successfully';
                    $this->_helper->redirector->gotoRoute(array
                        ('controller' => 'cms',
                        'action' => 'show'));
                } else {
                    echo 'Insertion error';
                    die;
                }
            } else {
                echo 'Invalid form data';
            }
        }
    }

    public function showAction() {
        $ObjData = new Application_Model_DbTable_Cmsform();
        $data = $ObjData->fetchAll()->toArray();
        $this->view->listdata = $data;
    }

    function deletecontentAction() {
        $objdelete = new Application_Model_DbTable_Cmsform();
        $id = $this->_getParam('page_id');
        $data = $objdelete->deleteProfile($id);
        $this->_helper->redirector('show');

        // $this->view->del = $data;
    }

    public function editcontentAction() {
        $form = new Application_Form_Addform();
        $form->submit->setLabel('Update')
                      ->setValue('yes');
                      

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData))
            {
                $albums = new Application_Model_DbTable_Cmsform();
                $id = (int)$form->getValue('page_id');
                
                
               $row = $albums->fetchRow('page_id='.$id);
                $row->page_title = $form->getValue('page_title');
                $row->page_content = $form->getValue('page_content');
                
                if (isset($row['page_publish'])) {
                    if (!$row['page_publish'] == yes) {
                        $row['page_publish'] = 1;
                        
                    }
                    else
                        $row['page_publish'] = 0;
                }
                
                $row->save();

               
//                $albums->updateAlbum($id, $name, $address);
//                echo '<pre>';
//                print_r($albums);die;
                $this->_redirect('/cms/show');

            }
            else
            {
                $form->populate($formData);

            }
        } else {
            //uses model to retrieve the database row & toArray() is used to populate the form directly
         $id = (int) $this->_request->getParam('page_id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Cmsform();
                $album = $albums->fetchRow('page_id=' . $id);
                $form->populate($album->toArray());
            }
        }
    }

    function addimagesAction() {
        //echo 'asdffasd';die;

        $form = new Application_Form_Addimages();

        // print_r($form);die;
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads';

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
                        'action' => 'addimages'));
                } else {
                    echo 'Insertion error';
                    die;
                }
            } else {
                echo 'Invalid form data';
            }
        }
    }

}
