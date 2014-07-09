<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">

    <h2>All users</h2>

    <br />

    <a href="/?load=users/create">Add user</a>

    <br /><br />

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><a href="/?load=users/update&user_id=<?php echo $user['user_id']; ?>">Edit</a></td>
                    <td><a href="/?load=users/delete&user_id=<?php echo $user['user_id']; ?>">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </tbody>
    </table>


</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>

