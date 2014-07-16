<?php

class Controller
{

    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_view;
    protected $_modelBaseName;

    public function __construct($model, $action)
    {
        $this->_controller = trim(str_replace("controller", "", strtolower(get_class($this)))); //ucwords(__CLASS__);
        $this->_action = str_replace("Action", "", $action);
        $this->_modelBaseName = $model;

        $this->_view = new View(ROOT.DS.'views'.DS.strtolower($this->_modelBaseName).DS.$action.'.tpl');

        $this->_view->set('controller', $this->_controller);
    }

    protected function _setModel($modelName)
    {
        $modelName .= 'Model';
        $this->_model = new $modelName();
    }

    protected function _setView($viewName)
    {
        $this->_view = new View(ROOT.DS.'views'.DS.strtolower($this->_modelBaseName).DS.$viewName.'.tpl');
    }
}

?>
