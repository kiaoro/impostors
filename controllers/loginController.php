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

            // NORMAL LOGIN 
            if (isset($_POST['submit']) ) {
                $user = $usersModel->getUserByLoginPassword($_POST['login'], $_POST['password']);
                if (!empty($user)) {
                    $_SESSION['app_user'] = $user['user_id'];
                    header('Location:/?load=home/index');
                } else {
                    $this->_view->set('error', 'Wrong login/password');
                }
            }
            
            if (isset($_GET['linkedin'])) {
                // You'll probably use a database
                //$_SESSION['linkedin'];
                // OAuth 2 Control Flow
                if (isset($_GET['error'])) {
                    // LinkedIn returned an error
                    print $_GET['error'] . ': ' . $_GET['error_description'];
                    exit;
                } elseif (isset($_GET['code'])) {
                    // User authorized your application
                    if ($_SESSION['linkedin']['state'] == $_GET['state']) {
                        
                        // Get token so you can make API calls
                        $this->_getLinkedInAccessToken();
                        $linkedinModel = new LinkedinModel($_SESSION['linkedin']['access_token']); 
                        $linkedInUser = $linkedinModel->getCurrentUser();
                        
                        if (!empty($linkedInUser)) {
                            $usersModel = new UsersModel();
                            $user = $usersModel->getUserByLinkedinId($linkedInUser->id);
                            $_SESSION['app_user'] = $user['user_id'];
                            header('Location:/?load=home/index');
                        } else {
                            header('Location:/?load=login/index');
                        }
                        
                    } else {
                        // CSRF attack? Or did you mix up your states?
                        exit;
                    }
                } else {
                    if ((empty($_SESSION['linkedin']['expires_at'])) || (time() > $_SESSION['linkedin']['expires_at'])) {
                        // Token has expired, clear the state
                        $_SESSION['linkedin'] = array();
                    }
                    if (empty($_SESSION['linkedin']['access_token'])) {
                        // Start authorization process
                        $this->_getLinkedInAuthorizationCode();
                    }
                }
            }
            
            $this->_view->set('title', 'Login page');
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
     
    private function _getLinkedInAuthorizationCode() {
        $params = array(
            'response_type' => 'code',
            'client_id' => API_KEY,
            'scope' => SCOPE,
            'state' => uniqid(STATE_PREFIX, true), 
            'redirect_uri' => REDIRECT_URI,
          );
        $url = 'https://www.linkedin.com/uas/oauth2/authorization?'.http_build_query($params);
        $_SESSION['linkedin']['state'] = $params['state'];
        header("Location: $url");
        exit;
    }
     
    private function _getLinkedInAccessToken() {
        $params = array(
            'grant_type' => 'authorization_code',
            'client_id' => API_KEY,
            'client_secret' => API_SECRET,
            'code' => $_GET['code'],
            'redirect_uri' => REDIRECT_URI,
        );
        $url = 'https://www.linkedin.com/uas/oauth2/accessToken?'.http_build_query($params);
        $context = stream_context_create(array('http' => array('method' => 'POST')));
        $response = file_get_contents($url, false, $context);
        $token = json_decode($response);
        $_SESSION['linkedin']['access_token'] = $token->access_token; // guard this!
        $_SESSION['linkedin']['expires_in']   = $token->expires_in; // relative time (in seconds)
        $_SESSION['linkedin']['expires_at']   = time() + $_SESSION['linkedin']['expires_in']; // absolute time
        return true;
    }
 
    public function logoutAction() { 
        session_destroy();
        header('Location:/?load=login/index');
    }

}

?>
