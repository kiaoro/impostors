<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">

    <h2><?php if (isset($action['action_id'])) : ?>Action #<?php echo $action['action_id']; ?><?php else : ?>New action<?php endif ?></h2>

    <br />

    <a href="/?load=actions/index">All actions</a>

    <br /><br />

    <form name="action_form" action="<?php if (isset($action['action_id'])) : ?>/?load=actions/update<?php else : ?>/?load=actions/create<?php endif; ?>" method="post">
        <input type="hidden" name="action_id" value="<?php echo $action['action_id']; ?>" />
        <label>Name :</label><input type="text" name="name" value="<?php echo $action['name']; ?>" /><br />
        <label>URL Action :</label><input type="text" name="action" value="<?php echo $action['action']; ?>" />
        <span style="margin-left:15px;color:#CCCCCC;display:inline-block;">ex: http://?load=
            users/<span style="font-weight:bold;color:black;">action</span></span><br />
        <label>Module :</label>
        <select name="module_id">
        <?php if (!empty($modules)) : ?>
            <?php foreach ($modules as $module) : ?>
                <option value="<?php echo $module['module_id']; ?>" <?php if ($module['module_id']==$action['module_id']) : ?>selected='selected'<?php endif ;?>><?php echo $module['name']; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
        </select><br />
        <input type="submit" name="submit" value="Submit" class='button' />
    </form>


</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>

