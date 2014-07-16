<?php

$table = $_GET['table']; 
        
$myfile = fopen("controllers/".$table."Controller.php", "w") or die("Unable to open file!");

$txt = '
<?php

class XxxController extends AuthController
{

    public function __construct($model, $action) {
        parent::__construct($model, $action);
        $this->_view->set("title", "Xxx");
    }

    public function index() {
        header("Location:/?load=xxx/list");
    }

    public function listAction() {
        $xxxModel = new XxxModel();
        $xxx = $xxxModel->getXxx();
        $this->_view->set("xxx", $xxx);
        $this->_view->setFile(ROOT.DS."views".DS."xxx".DS."xxx.tpl");
        return $this->_view->output();
    }

    public function updateAction() {
        $xxxModel = new XxxModel();
        if (isset($_POST["submit"])) {
            // todo : data check
            $result = $xxxModel->updateYyy($_POST);
            header("Location:/?load=xxx/list");
        }
        if (isset($_GET["yyy_id"])) {
            $yyy = $xxxModel->getYyyById($_GET["yyy_id"]);
            $this->_view->set("yyy", $yyy);
        } 
        $this->_view->setFile(ROOT.DS."views".DS."xxx".DS."yyy.tpl");
        return $this->_view->output();
    }

    public function createAction() {
        if (isset($_POST["submit"])) {
            // todo : data check
            $xxxModel = new XxxModel();
            $result = $xxxModel->createYyy($_POST);
            header("Location:/?load=xxx/list");
        }
        $this->_view->setFile(ROOT.DS."views".DS."xxx".DS."yyy.tpl");
        $this->_view->set("yyy", null); // to avoid template error
        return $this->_view->output();
    }

    public function deleteAction() {
        if (isset($_GET["yyy_id"])) {
            // todo : right mgmt
            $xxxModel = new XxxModel();
            $result = $xxxModel->deleteYyy($_GET["yyy_id"]);
            header("Location:/?load=xxx/index");
        }
    }

}

?>';

// PLURAL 
$txt = str_replace("Xxx", ucfirst($table), $txt);
$txt = str_replace("xxx", $table, $txt);
// SINGULAR
$txt = str_replace("Yyy", ucfirst(rtrim($table,'s')), $txt);
$txt = str_replace("yyy", rtrim($table, 's'), $txt);

fwrite($myfile, $txt);

fclose($myfile);

?>