
<!DOCTYPE html>
<html lang="en">
<head>
<title>Bob Airways</title>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="<?php echo Yii::$app->request->baseUrl;?>/assets/jquery.min.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl;?>/assets/jquery.validate.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/assets/bootstrap/css/bootstrap.min.css">  
<script src="<?php echo Yii::$app->request->baseUrl;?>/assets/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
  
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl;?>/assets/sweetalert.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl;?>/assets/fileinput/fileinput.css">
<script src="<?php echo Yii::$app->request->baseUrl;?>/assets/fileinput/fileinput.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl;?>/assets/sweetalert.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">

</head>
<body>

<div class="container-fluid" style="background-color:#F44336;color:#fff;height:120px;">   
    <h1>Bob Airways</h1>
    <h3>An online ticket booking system </h3> 
</div>


<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="13320">
    <ul class="nav navbar-nav">
        <li class=""><a href="" class="glyphicon glyphicon-triangle-left" onclick="history.go(-1);">Back</button></a></li>
        <li class="active"><a href="<?php echo Yii::$app->request->baseUrl;?>/ticket/index/"><span class="glyphicon glyphicon-home"></span>Home</a></li>
        <?php
            if (Yii::$app->user->isGuest)
            {
                ?><li class=""><a href="<?php echo Yii::$app->request->baseUrl;?>/site/login"><span class="glyphicon glyphicon-user"></span> Login</a></li>
                <li class=""><a href="<?php echo Yii::$app->request->baseUrl;?>/ticket/signup-form/"><span class="glyphicon glyphicon-log-in"></span> SignUp</a></li> <?php       
            }
            else
            {
                ?><li class=""><a href="<?php echo Yii::$app->request->baseUrl;?>/site/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout(<?php echo Yii::$app->user->identity->username;?>)</a></li> <?php 
            }
        ?> 
    </ul> 
</nav>

   <?= $content ?>

</body>
</html>

