<?php

$table = $_GET['table']; 
$fields = $_GET['fields'];
$fieldsArray = explode(",", $_GET['fields']);
$nbFields = count($fieldsArray);

$upsertDataTxt = $fieldsUpdateTxt = $fieldsInsertTxt = ""; 
if ($nbFields>0) {
    foreach ($fieldsArray as $field) { $upsertDataTxt .= '$data["'.$field.'"],'; }
    $upsertDataTxt = rtrim($upsertDataTxt, ",");
    foreach ($fieldsArray as $field) { $fieldsUpdateTxt .= $field.' = ?,'; }
    $fieldsUpdateTxt = rtrim($fieldsUpdateTxt, ",");
    foreach ($fieldsArray as $field) { $fieldsInsertTxt .= '?,'; }
    $fieldsInsertTxt = rtrim($fieldsInsertTxt, ",");
}
        
$myfile = fopen("models/".$table."Model.php", "w") or die("Unable to open file!");

$txt = '
<?php

class XxxModel extends Model {

    public function getXxx() {
        $sql = "SELECT * FROM xxx ;";
        $this->_setSql($sql);
        $xxx = $this->getAll();
        if (empty($xxx)) {
            return false;
        }
        return $xxx;
    }

    public function getYyyById($id) {
        $sql = "SELECT * FROM xxx WHERE yyy_id=? LIMIT 1;";
        $this->_setSql($sql);
        $yyyDetails = $this->getRow(array($id));
        if (empty($yyyDetails)) {
            return false;
        }
        return $yyyDetails;
    }
    
    public function createYyy($data) {
        if (!empty($data)) {
            $sql = "INSERT INTO xxx ('.$fields.') VALUES ('.$fieldsInsertTxt.')";
            $sql_data = array(
            '.$upsertDataTxt.'
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function updateYyy($data) {
        if (!empty($data) && $data["yyy_id"]>0) {
            $sql = "UPDATE xxx SET '.$fieldsUpdateTxt.' WHERE yyy_id = ? LIMIT 1;";
            $sql_data = array(
            '.$upsertDataTxt.'
            );
            $sth = $this->_db->prepare($sql);
            return $sth->execute($sql_data);
        }
    }

    public function deleteYyy($id) {
        if ($id>0) {
            $sql = "DELETE FROM xxx WHERE yyy_id = ? LIMIT 1;";
            $sth = $this->_db->prepare($sql);
            return $sth->execute(array($id));
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