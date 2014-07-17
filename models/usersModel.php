<?php

class UsersModel extends Model {

    public function getUsers() {
        $sql = "SELECT * FROM users WHERE is_admin<=0";
        $this->_setSql($sql);
        $users = $this->getAll();
        if (empty($users)) {
            return false;
        }
        return $users;
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $this->_setSql($sql);
        $userDetails = $this->getRow(array($id));
        if (empty($userDetails)) {
            return false;
        }
        return $userDetails;
    }

    public function getUserByLoginPassword($login, $password){
        $sql = "SELECT * FROM users WHERE login = ? AND password = ?";
        $this->_setSql($sql);
        $userDetails = $this->getRow(array($login, $password));
        if (empty($userDetails)) {
            return false;
        }
        return $userDetails;
    }

    public function createUser($data) {
        if (!empty($data)) {
            $sql = "INSERT INTO users (name, login, password) VALUES (?, ?, ?)";
            $sql_data = array(
                $data['name'],
                $data['login'],
                $data['password'],
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function updateUser($data) {
        if (!empty($data) && $data['user_id']>0) {
            $sql = "UPDATE users SET name = ?, login = ?, password = ? WHERE user_id = ? ";
            $sql_data = array(
                $data['name'],
                $data['login'],
                $data['password'],
                $data['user_id']
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function deleteUser($id) {
        if ($id>0) {
            $sql = "DELETE FROM users WHERE user_id = ?";
            $sth = $this->_db->prepare($sql);
            return $sth->execute(array($id));
        }
    }
    
    public function getUserByLinkedinId($linkedInId) {
        if (!empty($linkedInId)) {
            $sql = "SELECT * FROM users WHERE linkedin_id = ?";
            $this->_setSql($sql);
            $userDetails = $this->getRow(array($linkedInId));
            if (empty($userDetails)) {
                return false;
            }
            return $userDetails;
        }
    }
    
}

?>
