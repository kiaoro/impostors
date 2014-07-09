<?php

class UsersController extends AuthController
{

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_view->set('title', 'Users');
    }

    public function index()
    {
        header('Location:/?load=users/list');
    }

    public function listAction()
    {
        $usersModel = new UsersModel();
        $users = $usersModel->getUsers();
        $this->_view->set('users', $users);
        $this->_view->setFile(ROOT.DS.'views'.DS.'users'.DS.'users.tpl');
        return $this->_view->output();
    }

    public function updateAction()
    {
        $usersModel = new UsersModel();
        if (isset($_POST['submit'])) {
            // todo : data check
            $result = $usersModel->updateUser($_POST);
            // update rights
            $rightsModel = new rightsModel();
            $result = $rightsModel->updateRightsByUserId($_POST['user_id'], (!empty($_POST['rights']) ? $_POST['rights'] : null));
            header('Location:/?load=users/list');
        }
        if (isset($_GET['user_id'])) {
            
            $user = $usersModel->getUserById($_GET['user_id']);
            
            // get modules 
            $modulesModel = new ModulesModel();
            $modules = $modulesModel->getModules();
            $this->_view->set('modules', $modules);
            
            // get modules actions 
            $modulesActions = array();
            $actionsModel = new ActionsModel();
            if (!empty($modules)) {
                foreach ($modules as $module) {
                    // todo : avoid doing SQL queries within a loop
                    $modulesActions[$module['module_id']] = $actionsModel->getActionsByModuleId($module['module_id']);
                }
            }
            $this->_view->set('modulesActions', $modulesActions);
            
            // get user rights
            if (!empty($user)) {
                $rightsModel = new RightsModel();
                $this->_view->set('rights', $rightsModel->getRightsByUserId($user['user_id']));
            }
            
            $this->_view->set('user', $user);
        } 
        $this->_view->setFile(ROOT.DS.'views'.DS.'users'.DS.'user.tpl');
        return $this->_view->output();
    }

    public function createAction()
    {
        if (isset($_POST['submit'])) {
            // todo : data check
            $usersModel = new UsersModel();
            $result = $usersModel->createUser($_POST);
            header('Location:/?load=users/list');
        }
        $this->_view->setFile(ROOT.DS.'views'.DS.'users'.DS.'user.tpl');
        $this->_view->set('user', null); // to avoid template error
        return $this->_view->output();
    }

    public function deleteAction()
    {
        if (isset($_GET['user_id'])) {
            if ($this->_user['user_id']!=$_GET['user_id']) {
                $usersModel = new UsersModel();
                $result = $usersModel->deleteUser($_GET['user_id']);
                header('Location:/?load=users/index');
            } else {
                die("You can't delete yourself !");
            }
        }
    }

}

?>
