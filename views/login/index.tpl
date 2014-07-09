<html>
<head>
     <title>
      <?php echo $title; ?>
     </title>
    <link href="/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <form id="login_form" name="login_form" action="" method="post">
        <h1>Back-office</h1><br />
        <?php if (isset($error)) : ?><span style="color:red;"><?php echo $error; ?></span><br /><?php endif; ?>
        <label>Login :</label><input type="text" name="login" value="" /><br />
        <label>Password :</label><input type="password" name="password" value="" /><br />
        <input type="submit" name="submit" value="Submit" class="button" />
    </form>

</body>
</html>