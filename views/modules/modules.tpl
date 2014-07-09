<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">

    <h2>All modules</h2>

    <br />

    <a href="/?load=modules/create">Add module</a>

    <br /><br />

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>URL Controller</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($modules)) : ?>
                <?php foreach ($modules as $module) : ?>
                <tr>
                    <td><?php echo $module['module_id']; ?></td>
                    <td><?php echo $module['name']; ?></td>
                    <td><?php echo $module['controller']; ?></td>
                    <td><a href="/?load=modules/update&module_id=<?php echo $module['module_id']; ?>">Edit</a></td>
                        <td><a href="/?load=modules/delete&module_id=<?php echo $module['module_id']; ?>">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </tbody>
    </table>


</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>

