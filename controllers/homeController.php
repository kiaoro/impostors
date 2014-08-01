<?php

class homeController extends authController
{
    
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_view->set('title', 'Home page');
    }

    
    public function index()
    {
        try {
            
            $linkedinModel = new LinkedinModel($_SESSION['linkedin']['access_token']);
            //$connections = $linkedinModel->getCurrentUserConnections();
            
            $linkedinModel->getConnection("c1ilIWdFwm");
            
            
            $user = $linkedinModel->getCurrentUser(true);
            $this->_view->set('user', $user);
            $this->_view->set('connections', array());
            
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}

?>
