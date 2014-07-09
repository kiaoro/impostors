<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">

    <h2>All actions</h2>

    <br />

    <a href="/?load=actions/create">Add action</a>

    <br /><br />

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>URL Action</th>
                <th>Module</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($actions)) : ?>
                <?php foreach ($actions as $action) : ?>
                <tr>
                    <td><?php echo $action['action_id']; ?></td>
                    <td><?php echo $action['name']; ?></td>
                    <td><?php echo $action['action']; ?></td>
                    <td>
                        <?php if (!empty($modules)) : ?>
                        <?php foreach ($modules as $module) : ?>
                        <?php if ($module['module_id']==$action['module_id']) : ?><?php echo $module['name']; ?><?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </td>    
                    <td><a href="/?load=actions/update&action_id=<?php echo $action['action_id']; ?>">Edit</a></td>
                    <td><a href="/?load=actions/delete&action_id=<?php echo $action['action_id']; ?>">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </tbody>
    </table>


</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>

