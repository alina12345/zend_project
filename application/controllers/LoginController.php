<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }
    
    public function usercheckAction()
    {

        $form = new Application_Form_Loginform();
        $request = $this->getRequest();

        if ($request->isPost()) {

            if ($form->isValid($request->getPost())) {

                if ($this->_process($form->getValues())) {

                    // We're authenticated! Redirect to the home page

                    $this->_helper->redirector('dashboard', 'cms');

                }
            else {
                    echo 'Wrong username or password. Please try again!';
                    exit;
                }
            }

        }

        $this->view->form = $form;
    }
    
    protected function _process($values)

    {

        // Get our authentication adapter and check credentials

        $adapter = $this->_getAuthAdapter();

        $adapter->setIdentity($values['username']); 

        $adapter->setCredential($values['password']);



        $auth = Zend_Auth::getInstance();

        $result = $auth->authenticate($adapter);

        if ($result->isValid()) {

            $user = $adapter->getResultRowObject();

            $auth->getStorage()->write($user);

            return true;

        }

        return false;

    }
    
    protected function _getAuthAdapter() {

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();

        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        

        $authAdapter->setTableName('tbl_user')

            ->setIdentityColumn('username')

            ->setCredentialColumn('password')

            ->setCredentialTreatment('MD5(?)');

        return $authAdapter;

    }
    
   

}

