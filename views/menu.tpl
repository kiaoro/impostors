<!--<div id="menu">
    <ul>
        <li><a href="/?load=home/index" <?php if ($controller=='home') : ?>class='active'<?php endif; ?>>Home</a></li>
        <?php if (!empty($menu)) : ?>
            <?php foreach ($menu as $menu_item) : ?>
                <li><a href="/?load=<?php echo (!empty($menu_item['controller']) ? $menu_item['controller'] : 'home'); ?>/index" <?php if ($controller==$menu_item['controller']) : ?>class='active'<?php endif; ?>><?php echo $menu_item['name']; ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>-->