<?php //

class ViewcontentController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function viewcontentAction()
    {
        $Fetchdata = new Application_Model_DbTable_cms();
        $fetch = $Fetchdata->fetchAll();
        $this->view->show = $fetch->toArray(); 
    }


}

?>
