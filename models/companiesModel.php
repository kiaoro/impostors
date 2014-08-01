<?php

class CompaniesModel extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getCompanyById($id) {
        $sql = "SELECT * FROM companies WHERE company_id = ?";
        $this->_setSql($sql);
        $company = $this->getRow(array($id));
        if (empty($company)) {
            return false;
        }
        return $company;
    }
    
}

?>
