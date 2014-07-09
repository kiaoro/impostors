<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">

    <h2><?php if (isset($user['user_id'])) : ?>User #<?php echo $user['user_id']; ?><?php else : ?>New user<?php endif ?></h2>

    <br />

    <a href="/?load=users/index">All users</a>

    <br /><br />

    <form name="user_form" action="<?php if (isset($user['user_id'])) : ?>/?load=users/update<?php else : ?>/?load=users/create/<?php endif; ?>" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>" />
        <label>Name :</label><input type="text" name="name" value="<?php echo $user['name']; ?>" /><br />
        <label>Login :</label><input type="text" name="login" value="<?php echo $user['login']; ?>" /><br />
        <label>Password :</label><input type="password" name="password" value="<?php echo $user['password']; ?>" /><br />

        <br />

        <fieldset>
            <legend>Rights</legend>
            <?php if (!empty($modules)) : ?>
            
            <span style="color:grey;">Note : Module is visible to user only if at least one right is set.</span><br />
            <?php foreach ($modules as $module) : ?>
            <div style="padding:10px;">
            Module <a href="/?load=modules/update&module_id=<?php echo $module['module_id']; ?>"><?php echo $module['name']; ?></a> :<br />
                <?php if (!empty($modulesActions)) : ?>
                <?php foreach ($modulesActions as $module_id => $actions) : ?>
                    <?php if ($module_id==$module['module_id']) : ?>
                    <?php if (!empty($actions)) : ?>
                    <?php foreach ($actions as $action) : ?>
                        <?php $checked=""; ?>
                        <?php if (!empty($rights)) : ?>
                        <?php foreach ($rights as $right) : ?>
                            <?php if ($right['action_id']==$action['action_id'] && $action['module_id']==$module_id) { $checked = "checked='checked'"; } ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <input type="checkbox" name="rights[<?php echo $action['action_id']; ?>]" value="<?php echo $action['action_id']; ?>" style="margin:2px;" <?php echo $checked; ?>/>&nbsp;&nbsp;<?php echo $action['name']; ?><br />
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
                You must create user first.
            <?php endif; ?>
        </fieldset>

        <br />


        <input type="submit" name="submit" value="Submit" />
    </form>




</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>

