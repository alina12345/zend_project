<?php

class LoginController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        // if not logged in, redirect to login form 
//        if(!Zend_Auth::getInstance()->hasIdentity())  
//        {  
//            $this->_redirect('/login/login');  
//        } 
//        $request = $this->getRequest();  
//            $form = $this->init();  
//      
//            $errorMessage = "";  
    }

    public function dashboardAction() {
        /* Initialize action controller here */
        //$storage = new Zend_Auth_Storage_Session();
        $auth = Zend_Auth::getInstance();
        //print_r($auth->getIdentity());die;
        if (!$auth->hasIdentity()) {
            $this->_redirect('login/login');
        }

        $this->view->username = $auth->getIdentity()->username;
    }

    public function loginAction() {
        $form = new Application_Form_Loginform();

        $this->view->form = $form;
    }

    public function authAction() {
        $form = new Application_Form_Loginform();

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                //get username and password from the form
                $username = $form->getValue('username');
                $password = $form->getValue('password');

                // Get our authentication adapter and check credentials
                $adapter = $this->_getAuthAdapter();

                // pass to the adapter the submitted username and password
                $adapter->setIdentity($username)
                        ->setCredential($password);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);

                // is the user a valid one?
                if ($result->isValid()) {
                    //echo "hello";
                    //exit;
                    // get all info about this user from the login table  
                    // ommit only the password, we don't need that  
                    $userInfo = $adapter->getResultRowObject(null, 'password');

                    // the default storage is a session with namespace Zend_Auth
                    $authStorage = $auth->getStorage();
                    $authStorage->write($userInfo);

                    $this->_redirect('/login/dashboard');
                } else {

                    $errorMessage = "Wrong username or password provided. Please try again.";
                    echo $errorMessage;
                    //$this->_redirect('/login/login');

                    exit;
                }
            }
        }
//        else{
//            echo "error";
//            exit;
//        }
        $this->view->errorMessage = $errorMessage;
        $this->view->form = $form;
    }

    protected function _getAuthAdapter() {



        $dbAdapter = Zend_Db_Table::getDefaultAdapter();

        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);



        $authAdapter->setTableName('tbl_user')
                ->setIdentityColumn('username')
                ->setCredentialColumn('password');
                //->setCredentialTreatment('MD5(?)');


        return $authAdapter;
    }

    public function logoutAction() {
        //clear everything - session is cleared also!  
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        //print_r($auth->getIdentity());die;
        $this->_redirect('/login/login');
    }

    public function signupAction() {
        $form = new Application_Form_Signup();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            //print_r($formData);

            if ($form->isValid($formData)) {

                $values = $form->getValues();
                
                //To check if password & confirm password matches
                if ($values['password']!=$values['confirmPassword'])
                {
                    $this->view->errorMessage = "Password & Confirm Password don't match.";
                    
                    return;
                }
                
                
               $Savedata = new Application_Model_DbTable_Signupmodel();
                if ($Savedata->checkUnique($values['username']))
                {
                    $this->view->errorMessage = "Username already taken. Please choose another one.";
                    return;
                }
                
                unset($values['confirmPassword']);

                

                $check = $Savedata->insert($values);


                if ($check) {
                    $this->view->errorMessage = "Page saved successfully";
                    return;
                    //echo 'Page saved successfully';
//                    $this->_helper->redirector->gotoRoute(array
//                        ('controller' => 'login',
//                       'action' => 'login'));
                } else {
                    $this->view->errorMessage = 'Insertion error';
                    die;
                }
            } else {
                echo 'Invalid form data';
            }
        }
    }

    public function giveAction() {
        $ObjData = new Application_Model_DbTable_Signupmodel();
        $data = $ObjData->fetchAll()->toArray();
        $this->view->listdata = $data;
    }

}
