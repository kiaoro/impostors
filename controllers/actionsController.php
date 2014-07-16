<?php

class ActionsController extends AuthController
{

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_view->set('title', 'Actions');
    }

    public function index()
    {
        header('Location:/?load=actions/list');
    }

    public function listAction()
    {
        $actionsModel = new ActionsModel();
        $actions = $actionsModel->getActions();
        $this->_view->set('actions', $actions);
        $this->_view->setFile(ROOT.DS.'views'.DS.'actions'.DS.'actions.tpl');
        // get modules 
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->getModules();
        $this->_view->set('modules', $modules);
        return $this->_view->output();
    }

    public function updateAction()
    {
        $actionsModel = new ActionsModel();
        if (isset($_GET['action_id'])) {
            $action = $actionsModel->getActionById($_GET['action_id']);
            $this->_view->set('action', $action);
        } else {
            header('Location:/?load=actions/list');
        }
        if (isset($_POST['submit'])) {
            // todo : data check
            $result = $actionsModel->updateAction($_POST);
            header('Location:/?load=actions/list');
        }
        // get modules 
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->getModules();
        $this->_view->set('modules', $modules);
        $this->_view->setFile(ROOT.DS.'views'.DS.'actions'.DS.'action.tpl');
        return $this->_view->output();
    }

    public function createAction()
    {
        if (isset($_POST['submit'])) {
            // todo : data check
            $actionsModel = new ActionsModel();
            $result = $actionsModel->createAction($_POST);
            header('Location:/?load=actions/list');
        }
        $this->_view->setFile(ROOT.DS.'views'.DS.'actions'.DS.'action.tpl');
        $this->_view->set('action', null); // to avoid template error
        // get modules 
        $modulesModel = new ModulesModel();
        $modules = $modulesModel->getModules();
        $this->_view->set('modules', $modules);
        return $this->_view->output();
    }

    public function deleteAction()
    {
        if (isset($_GET['action_id'])) {
            if ($this->_action['action_id']!=$_GET['action_id']) {
                $actionsModel = new ActionsModel();
                $result = $actionsModel->deleteAction($_GET['action_id']);
                header('Location:/?load=actions/index');
            } else {
                die("You can't delete yourself !");
            }
        }
    }

}

?>
