<?php
/*
    Kullanıcıyı içeriye aldıktan sonra kullanıcının karşılaşacağı ekrandır.
    Son kullanıcılardan biri doğrudan URL aracılığıyla bu sayfaya girmesi Session ile engellendi
    Session üzerinden alınan veriler html içine gömüldü.
*/
session_start();
if(!isset($_SESSION['email'])){
    header("Location: index.html");
}
if(isset($_GET['logout'])=='yes'){
    session_destroy();
    header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><?php echo $_SESSION['email'] ?></a>
            </div>
            <p class="navbar-text navbar-right"><a href="?logout=yes">Çıkış</a></p>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h4><?php echo "Merhabalar,"?></h4>
            <h1><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h1>
            <p>Dashboard'a hoşgeldiniz.</p>
            <p><a href="?logout=yes" class="btn btn-primary">Çıkış</a></p>
        </div>
    </div>
</body>
</html>