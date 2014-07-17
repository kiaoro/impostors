<!DOCTYPE html>
<html>
<head>
     <title><?php echo $title; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link href="/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <form id="login_form" name="login_form" action="" method="post">
        <h1>Back-office</h1><br />
        <?php if (isset($error)) : ?><span style="color:red;"><?php echo $error; ?></span><br /><?php endif; ?>
        <label>Login :</label><input type="text" name="login" value="" /><br />
        <label>Password :</label><input type="password" name="password" value="" /><br />
        <input type="submit" name="submit" value="Submit" class="button" />
        
        <br />
        <br />
    
        <a href="http://dev.impostors.fr/index.php?load=login/index&linkedin=1">Linkedin</a>
    </form>
    
    
    
    <!--<div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>-->

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>