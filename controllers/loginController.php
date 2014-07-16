<?php

class LoginController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);

        if ($this->_action!='logout' && isset($_SESSION['app_user'])) {
            header('Location:/?load=home/index');
        }
    }


    public function loginAction() {
        header('Location:/?load=login/index');
    }

    public function index()
    {
        try {
            
            $usersModel = new UsersModel();

            if (isset($_POST['submit']) ) {
                $user = $usersModel->getUserByLoginPassword($_POST['login'], $_POST['password']);
                if (!empty($user)) {
                    $_SESSION['app_user'] = $user['user_id'];
                    header('Location:/?load=home/index');
                } else {
                    $this->_view->set('error', 'Wrong login/password');
                }
            }
            $this->_view->set('title', 'Login page');
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function logoutAction() { 
        session_destroy();
        header('Location:/?load=login/index');
    }

}

?>
