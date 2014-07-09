<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">

    <h2><?php if (isset($module['module_id'])) : ?>Module #<?php echo $module['module_id']; ?><?php else : ?>New module<?php endif ?></h2>

    <br />

    <a href="/?load=modules/index">All modules</a>

    <br /><br />

    <form name="module_form" action="<?php if (isset($module['module_id'])) : ?>/?load=modules/update<?php else : ?>/?load=modules/create<?php endif; ?>" method="post">
        <input type="hidden" name="module_id" value="<?php echo $module['module_id']; ?>" />
        <label>Name :</label><input type="text" name="name" value="<?php echo $module['name']; ?>" /><br />
        <label>URL Controller :</label><input type="text" name="controller" value="<?php echo $module['controller']; ?>" />
        <span style="margin-left:15px;color:#CCCCCC;display:inline-block;">ex: http://?load=
            <span style="font-weight:bold;color:black;">controller</span>/index</span><br />
        <input type="submit" name="submit" value="Submit" class='button' />
    </form>


</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>

