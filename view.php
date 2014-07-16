<?php

$table = $_GET['table']; 
$fields = $_GET['fields'];
$fieldsArray = explode(",", $_GET['fields']);
$nbFields = count($fieldsArray);

$fieldsTH = $fieldsTD = $fieldsInputForm = ""; 
if ($nbFields>0) {
    foreach ($fieldsArray as $field) { $fieldsTH .= '<th>'.$field.'</th>'; }
    $fieldsTH = rtrim($fieldsTH, ",");
    foreach ($fieldsArray as $field) { $fieldsTD .= '<td><?php echo $yyy["'.$field.'"]; ?></td>'; }
    $fieldsTD = rtrim($fieldsTD, ",");
    foreach ($fieldsArray as $field) { 
        $fieldsInputForm .= '<label>'.ucfirst($field).' :</label><input type="text" name="'.$field.'" value="<?php echo $yyy["'.$field.'"]; ?>" /><br />'; 
    }
}

mkdir("views/".$table."/");
$myfile = fopen("views/".$table."/".$table.".tpl", "w") or die("Unable to open file!");

$txt = '
<?php include ROOT.DS."views".DS."header.tpl"; ?>

<div class="content">

    <h2>All xxx</h2>

    <br />

    <a href="/?load=xxx/create">Add yyy</a>

    <br /><br />

    <table border="1">
        <thead>
            <tr>
                '.$fieldsTH.'
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($xxx)) : ?>
                <?php foreach ($xxx as $yyy) : ?>
                <tr>
                    '.$fieldsTD.'
                    <td><a href="/?load=xxx/update&yyy_id=<?php echo $yyy["yyy_id"]; ?>">Edit</a></td>
                    <td><a href="/?load=xxx/delete&yyy_id=<?php echo $yyy["yyy_id"]; ?>">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </tbody>
    </table>


</div>

<?php include ROOT.DS."views".DS."footer.tpl"; ?>';

// PLURAL 
$txt = str_replace("Xxx", ucfirst($table), $txt);
$txt = str_replace("xxx", $table, $txt);
// SINGULAR
$txt = str_replace("Yyy", ucfirst(rtrim($table,'s')), $txt);
$txt = str_replace("yyy", rtrim($table, 's'), $txt);

fwrite($myfile, $txt);

fclose($myfile);

/* ---------------------------------------------------------------------------------------------------------------------- */

$txt = "";

$myfile = fopen("views/".$table."/".substr($table, 0, strlen($table)-1).".tpl", "w") or die("Unable to open file!");

$txt = '
<?php include ROOT.DS."views".DS."header.tpl"; ?>

<div class="content">

    <h2><?php if (isset($yyy["yyy_id"])) : ?>Yyy #<?php echo $yyy["yyy_id"]; ?><?php else : ?>New yyy<?php endif ?></h2>

    <br />

    <a href="/?load=xxx/index">All xxx</a>

    <br /><br />

    <form name="yyy_form" action="<?php if (isset($yyy["yyy_id"])) : ?>/?load=xxx/update<?php else : ?>/?load=xxx/create<?php endif; ?>" method="post">
    
        <input type="hidden" name="yyy_id" value="<?php echo $yyy["yyy_id"]; ?>" />
        
        '.$fieldsInputForm.'
            
        <input type="submit" name="submit" value="Submit" class="button" />
    </form>


</div>

<?php include ROOT.DS."views".DS."footer.tpl"; ?>
';

// PLURAL 
$txt = str_replace("Xxx", ucfirst($table), $txt);
$txt = str_replace("xxx", $table, $txt);
// SINGULAR
$txt = str_replace("Yyy", ucfirst(rtrim($table,'s')), $txt);
$txt = str_replace("yyy", rtrim($table, 's'), $txt);

fwrite($myfile, $txt);

fclose($myfile);

?>