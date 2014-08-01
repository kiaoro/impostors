<html>
<head>
    <title><?php echo $title; ?></title>
    <link href="/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/chartjs/Chart.min.js"></script>
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
</head>
<body>

<div id="header">
    <!--<div style="float:left;width:200px;">
        <h1>Back-office</h1>
    </div>-->
    <div style="float:right;">
        <span>Welcome <?php echo $user_name; ?> !</span><br />
        <a href="/?load=login/logout">Logout</a>
    </div>
    <div style="clear:both"></div>
</div>

<?php include ROOT.DS.'views'.DS.'menu.tpl'; ?>