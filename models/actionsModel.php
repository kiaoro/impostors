<?php

class ActionsModel extends Model {

    public function getActions() {
        $sql = "SELECT * FROM actions";
        $this->_setSql($sql);
        $actions = $this->getAll();
        if (empty($actions)) {
            return false;
        }
        return $actions;
    }

    public function getActionById($id) {
        $sql = "SELECT * FROM actions WHERE action_id = ?";
        $this->_setSql($sql);
        $action = $this->getRow(array($id));
        if (empty($action)) {
            return false;
        }
        return $action;
    }
    
    public function getActionsByModuleId($moduleId) {
        $sql = "SELECT * FROM actions WHERE module_id = ?";
        $this->_setSql($sql);
        $actions = $this->getAll(array($moduleId));
        if (empty($actions)) {
            return false;
        }
        return $actions;
    }

    public function createAction($data) {
        if (!empty($data)) {
            $sql = "INSERT INTO actions (name, action, module_id) VALUES (?, ?, ?)";
            $sql_data = array(
                $data['name'],
                $data['action'], 
                $data['module_id']
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function updateAction($data) {
        if (!empty($data) && $data['action_id']>0) {
            $sql = "UPDATE actions SET name = ?, action = ?, module_id = ? WHERE action_id = ? ";
            $sql_data = array(
                $data['name'],
                $data['action'],
                $data['module_id'],
                $data['action_id']
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function deleteAction($id) {
        if ($id>0) {
            $sql = "DELETE FROM actions WHERE action_id = ?";
            $sth = $this->_db->prepare($sql);
            return $sth->execute(array($id));
        }
    }
    
}

?>
