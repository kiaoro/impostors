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
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}

?>
