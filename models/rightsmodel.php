<?php

class RightsModel extends Model
{

    public function getRightsByUserId($id) {
        $sql = "SELECT r.* FROM rights AS r WHERE r.user_id = ?";
        $this->_setSql($sql);
        $rights = $this->getAll(array($id));
        if (empty($rights)) {
            return false;
        }
        return $rights;
    }

    public function getRightsByUserIdGroupModule($id) {
        $sql = "SELECT r.*, m.name, m.controller
            FROM rights AS r 
            INNER JOIN actions AS a ON (a.action_id=r.action_id)
            INNER JOIN modules AS m ON (m.module_id=a.module_id)
            WHERE r.user_id = ?
            GROUP BY m.module_id;";
        $this->_setSql($sql);
        $rights = $this->getAll(array($id));
        if (empty($rights)) {
            return false;
        }
        return $rights;
    }

    public function getRight($userId, $moduleController, $moduleAction) {
        $sql = "SELECT r.* 
            FROM rights AS r
            INNER JOIN actions AS a ON (a.action_id=r.action_id)
            INNER JOIN modules AS m ON (a.module_id=m.module_id)
            WHERE r.user_id = ? AND m.controller = ? AND a.action = ? LIMIT 1";
        $this->_setSql($sql);
        $right = $this->getRow(array($userId, $moduleController, $moduleAction));
        if (empty($right)) {
            return false;
        }
        return $right;
    }

    public function updateRightsByUserId($userId, $rights) {
        if ($userId>0) {
            $this->deleteRightsByUserId($userId);
            // delete old user rights
            if (!empty($rights)) {
                $queryInsertValues = array();
                foreach ($rights as $action_id) {
                    $queryInsertValues[] = "('".$action_id."', '".$userId."')";
                }
                if (!empty($queryInsertValues)) {
                    $sql = 'INSERT INTO rights (action_id, user_id) VALUES' . implode(',', $queryInsertValues);
                    $sth = $this->_db->prepare($sql);
                    return $sth->execute();
                }
            }
        }
    }

    public function deleteRightsByUserId($userId) {
        if ($userId>0) {
            $sql = "DELETE FROM rights WHERE user_id = ?";
            $sth = $this->_db->prepare($sql);
            return $sth->execute(array($userId));
        }
    }



}

?>
