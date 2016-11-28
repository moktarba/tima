<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html lang="en">
  <head>
    
  <title>Tima marabout voyant</title> 
  <html class="no-js" lang="fr"> <!--<![endif]-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
 
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
   <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-vertical-tabs-master/bootstrap.vertical-tabs.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->  
  </head> 
  <body>

    <?php if (USER::auth()){
      echo "<nav>";
      echo "<div id='menu'>";
        
        echo '<ul id="reseaux">';
          
           echo "<a href='login.php?logout'><li>Déconnexion</li></a>"; 
            echo "<a href='compte.php'><li>Mon compte</li></a>";
            echo '<a><li>Bonjour '.$_SESSION['user']['username'].'</li></a>';
            echo '<a href="../timamaraboutvoyant/index.php?id=<?php '.$_SESSION['user']['id'].'"><li>Retour au site</li></a>';
        
            //<!--<a href="login.php"><li>se connecter</li></a> -->
            //<!--<a href="signup.php"><li>s'inscrire</li></a> -->
      
        echo "</ul>";
     echo "</div>"; 
    echo "</nav>";
    
    }
  	
