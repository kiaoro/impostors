<?php
// extends AuthController
class CompaniesController extends Controller
{

    // http://blog.softfluent.fr/2013/12/06/la-motivation-des-dveloppeurs/
    // http://bitconfig.com/chart/bitconfig_radar_chart.html
    
    public function __construct($model, $action) {
        parent::__construct($model, $action);
        $this->_view->set('title', 'Modules');
        $this->_view->set('user_name', "");
    }

    public function index() {
        header('Location:/?load=companies/list');
    }

    public function listAction()
    {
        $companiesModel = new CompaniesModel();
        $company = $companiesModel->getCompanyById(1);
        print_r($company);
        $this->_view->set('company', $company);
        $this->_view->setFile(ROOT.DS.'views'.DS.'companies'.DS.'index.tpl');
        return $this->_view->output();
    }

}

?>
