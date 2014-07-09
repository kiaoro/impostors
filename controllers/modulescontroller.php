<?php

class ModulesController extends AuthController
{

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_view->set('title', 'Modules');
    }

    public function index()
    {
        header('Location:/?load=modules/list');
    }

    public function listAction()
    {
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->getModules();
        $this->_view->set('modules', $modules);
        $this->_view->setFile(ROOT.DS.'views'.DS.'modules'.DS.'modules.tpl');
        return $this->_view->output();
    }

    public function updateAction()
    {
        $modulesModel = new ModulesModel();
        if (isset($_POST['submit'])) {
            // todo : data check
            $result = $modulesModel->updateModule($_POST);
            header('Location:/?load=modules/list');
        }
        if (isset($_GET['module_id'])) {
            $module = $modulesModel->getModuleById($_GET['module_id']);
            $this->_view->set('module', $module);
        } 
        $this->_view->setFile(ROOT.DS.'views'.DS.'modules'.DS.'module.tpl');
        return $this->_view->output();
    }

    public function createAction()
    {
        if (isset($_POST['submit'])) {
            $modulesModel = new ModulesModel();
            // todo : data check
            $result = $modulesModel->createModule($_POST);
            header('Location:/?load=modules/list');
        }
        $this->_view->setFile(ROOT.DS.'views'.DS.'modules'.DS.'module.tpl');
        $this->_view->set('module', null); // to avoid template error
        return $this->_view->output();
    }

    public function deleteAction()
    {
        if (isset($_GET['module_id'])) {
            $modulesModel = new ModulesModel();
            $module = $modulesModel->getModuleById($_GET['module_id']);
            if ($this->_controller!=$module['controller']) {
                $result = $modulesModel->deleteModule($_GET['module_id']);
                header('Location:/?load=modules/index');
            } else {
                die("You can't delete module 'modules' !");
            }
        }
    }

}

?>
