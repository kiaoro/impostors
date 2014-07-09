<?php

class ModulesModel extends Model {

    public function getModules() {
        $sql = "SELECT * FROM modules";
        $this->_setSql($sql);
        $modules = $this->getAll();
        if (empty($modules)) {
            return false;
        }
        return $modules;
    }

    public function getModuleById($id) {
        $sql = "SELECT * FROM modules WHERE module_id = ?";
        $this->_setSql($sql);
        $module = $this->getRow(array($id));
        if (empty($module)) {
            return false;
        }
        return $module;
    }

    public function createModule($data) {
        if (!empty($data)) {
            $sql = "INSERT INTO modules (name, controller) VALUES (?, ?)";
            $sql_data = array(
                $data['name'],
                $data['controller']
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function updateModule($data) {
        if (!empty($data) && $data['module_id']>0) {
            $sql = "UPDATE modules SET name = ?, controller = ? WHERE module_id = ? ";
            $sql_data = array(
                $data['name'],
                $data['controller'],
                $data['module_id']
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function deleteModule($id) {
        if ($id>0) {
            $sql = "DELETE FROM modules WHERE module_id = ?";
            $sth = $this->_db->prepare($sql);
            return $sth->execute(array($id));
        }
    }
    
}

?>
