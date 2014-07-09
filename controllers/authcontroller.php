<?php

class AuthController extends Controller
{
    protected $_user;

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);

        // authenticate user
        if (isset($_SESSION['app_user'])) {
            $usersModel = new UsersModel();
            $this->_user = $usersModel->getUserById($_SESSION['app_user']);
        }
        if (empty($this->_user)) {
            header('Location:/?load=login/index');
        } else {
            $this->_view->set('user_name', $this->_user['name']);
        }

        // basic check : check if user allowed to access (except for controller 'home' and action 'index')
        if ($this->_controller!="home" && $this->_action!="index" && $this->_user['is_admin']<=0 && !$this->_isAllowed()) {
            $this->_showForbidden(); die;
        }

        // build menu 
        $this->_buildMenu();
    }

    public function index()
    {
        header('Location:/?load=login/index');
    }


    private function _isAllowed() {
        if ($this->_user['is_admin']>0) {
            return true;
        } else {
            $rightsModel = new RightsModel();
            $right = $rightsModel->getRight($this->_user['user_id'], $this->_controller, $this->_action);
            if (!empty($right)) {
                return true;
            } else {
                return false;
            }
        }
    }


    private function _buildMenu() {
        $menu = array();
        // basic check : admin or not ?
        if ($this->_user['is_admin']>0) {
            // retrieve all modules
            $modulesModel = new ModulesModel();
            $modules = $modulesModel->getModules();
            if (!empty($modules)) {
                foreach ($modules as $module) {
                    $menu[] = array('name' => $module['name'], 'controller' => $module['controller']);
                }
            }
        } else {
            // retrieve all user rights
            $rightsModel = new RightsModel();
            $allUserRights = $rightsModel->getRightsByUserIdGroupModule($this->_user['user_id']);
            // build menu according to user rights
            if (!empty($allUserRights)) {
                foreach ($allUserRights as $right) {
                    $menu[] = array('name' => $right['name'], 'controller' => $right['controller']);
                }
            }
        }
        $this->_view->set('menu', $menu);
    }


    private function _showForbidden() {
        $this->_view = new View(ROOT.DS.'views'.DS.'forbidden.tpl');
        $this->_view->set('title', 'Access forbidden');
        return $this->_view->output();
    }
}

?>
