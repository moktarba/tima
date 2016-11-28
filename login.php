<?php
  include "inc/includes.php";
  include "header.php"; 
  //$posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");
  if (isset($_GET['logout'])) {
    if (isset($_SESSION['user'])) {
      unset($_SESSION['user']);
    }
     if (isset($_SESSION['uncrypted_token'])) {
      unset($_SESSION['uncrypted_token']);
    }
     if (isset($_SESSION['token'])) {
      unset($_SESSION['token']);
    }
    $_SESSION['authentificated']=false;
    $_SESSION['alert_success']= "Vous etes déconnecté avec succès!";
    unset($_SESSION['alert_success']);
    unset($_SESSION['alert_error']);
    header("location: ../timamaraboutvoyant/index.php");
     
  }
  if($_SERVER['REQUEST_METHOD']=="POST"){
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email= $_POST['email'];
    $password= USER::hashPassword($_POST['password']);
    $data = array(
      'email' => $email, 
      'password'=>$password
      );
    $alpha=$DB->tquery("select * from users where email=:email and password=:password limit 1",$data);
    if (!empty($alpha)) {
      if ($alpha[0]['active']==1) {
        session_name("connexion");
        $_SESSION['user']=$alpha[0];
        $_SESSION['authentificated']=true;
        $_SESSION['uncrypted_token']=uniqid();
        $_SESSION['token']=USER::hashPassword($_SESSION['uncrypted_token']);

        $_SESSION['alert_success']="Vous etes maintenant connecté !";
        unset($_SESSION['alert_error']);
        $beta=$DB->insert("update users set last_login=NOW() where email=:email",array('email' => $email ));
        header("location: ../timamaraboutvoyant/index.php"); 
        
      }else{
        $_SESSION['alert_error']='Votre compte n\'est pas activé, veuillez vérifier dans vos mails...';
        unset($_SESSION['alert_success']);
      }
    }else{
      $_SESSION['alert_error']= "Veuillez vérifier votre email et/ou votre mot de passe...";
        unset($_SESSION['alert_success']);
    }
  }else{
    if (empty($_POST['email'])) {
      $erreur_email="Vous devez renseigner votre email...";
    }
    if (empty($_POST['password'])) {
      $erreur_password="Vous devez renseigner votre mot de passe...";
    }
  }

}/*else{
    $_SESSION['alert_error']= "Veuillez renseigner votre email et votre mot de passe...";
        unset($_SESSION['alert_success']);
  }*/
?>
  	
  		<div id="content" class="content row">
        <div class="col-md-3 "></div>
  			<div class=" col-md-4 col-xs-12 ">
            <?php if (isset($_SESSION['alert_success'])): ?>
              <div class="alert_success"><?php echo $_SESSION['alert_success']; ?></div>
            <?php endif ?>
            <?php if (isset($_SESSION['alert_error'])): ?>
              <div class="alert_error"><?php echo $_SESSION['alert_error']; ?></div>
            <?php endif ?>
            
              <h2>Administration : Bienvenue !</h2>
              <br>
               <form action="login.php" method="post">
              <p><label for ="email">Email</label></p>
              <p><input type="text" name="email" value='<?php echo isset($_POST['email'])?$_POST['email']: "" ?>'></p>
                <?php if (!empty($erreur_email)): ?>
                  <div class="error"><?php echo $erreur_email; ?></div>
                <?php endif ?>
              <p><label for ="password">Password</label></p>
              <p><input type="password" name="password" value='<?php echo isset($_POST['password'])?$_POST['password']: "" ?>'></p>
                <?php if (!empty($erreur_password)): ?>
                  <div class="error"><?php echo $erreur_password; ?></div>
                <?php endif ?>
              <p><a href="password.php"> mot de passe oublié? </a></p>
              <p><input type="submit" value="valider"></p>
            </form> <!-- fin div login -->
  			</div>	
        <div class="col-md-4 "></div>
  	</div><!-- fin content -->
    
    <div class="clearfix"></div>
       
    </div>
  </body>
