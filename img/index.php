  <?php
  include "inc/includes.php";
  include "header.php";
  $users= $DB->query("select id,username, email, tel, created_at, updated_at, avatar, nom, prenom, titre1, titre2 from users order by created_at limit 1 ");
   $menus= $DB->query('select id,nom,titre,contenu, afficher from menu order by id  ');
   $menus_aff= $DB->query('select id,nom,titre,contenu, afficher from menu where afficher=0 order by id  ');

   $id= $users[0]->id;
   $temoignage= $DB->query("select temoignages.id, temoignages.contenu,temoignages.pseudo,temoignages.email, temoignages.created_at, temoignages.users_id from temoignages 
                          inner join users on temoignages.users_id= users.id
                          where temoignages.users_id=$id
                          order by created_at desc limit 5");
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['poster']) ){
      $validate= false;

      if (empty($_POST['email'])) {
        $erreur_email= "Veuillez renseigner un email valide ...";
        $validate= false;
      }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $validate=false;
        $erreur_email= "Veuillez renseigner un email valide ..."; $validate=false;
      }else $email = $_POST['email'];  $validate= true;

  

    if (!empty($_POST['pseudo'])) {
        $pseudo= $_POST['pseudo'];
         $validate=true;
      }else{
        $erreur_pseudo= "Veuillez renseigner un pseudo ...";
         $validate=false;
      }

      if (!empty($_POST['contenu'])) {
        $contenu= $_POST['contenu'];
        $validate=true;
      }else{
        $erreur_contenu= "Veuillez renseigner un contenu ...";$validate=false;
      }
      
    if ($validate) {
        
        $users_id=1;
        $data = array(
          "pseudo"=>htmlspecialchars(addslashes($_POST['pseudo'])), 
           "email" =>htmlspecialchars(addslashes($_POST['email'])),
           "contenu" =>htmlspecialchars(addslashes($_POST['contenu'])),
           "users_id"=>$users_id
           );
        $sql= 'insert into `temoignages`(`pseudo`,`email`,`contenu`,`users_id`,`created_at`) values(:pseudo,:email,:contenu,:users_id,NOW())';
        $req= $DB->insert($sql,$data);
        if ($req) {
          $_SESSION['alert_success']="Merci pour votre temoignage!";
          unset($_POST);
        }else{
          $_SESSION['alert_error']="Echec lors de l'envoi de votre message, réessayez plus tard!";
        }
      }
  } 

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['valider']) ){
      $validate2= false;

      if (empty($_POST['mail'])) {
        $validate2= false;
      }elseif (!filter_var($_POST['mail'], FILTER_validate2_EMAIL)) {
        $validate2=false;
        $erreur_mail= "Veuillez renseigner un mail valide ...";
      }else $mail = $_POST['mail']; $validate2=true;

  

    if (!empty($_POST['prenom'])) {
        $prenom= $_POST['prenom'];
        $validate2=true;
      }else{
        $erreur_prenom= "Veuillez renseigner un prenom ...";$validate2=false;
      }

      if (!empty($_POST['nom'])) {
        $nom= $_POST['nom'];
        $validate2=true;
      }else{
        $erreur_nom= "Veuillez renseigner un nom ...";$validate2=false;
      }

      if (!empty($_POST['tel'])) {
        $tel= $_POST['tel'];
        $validate2=true;
      }else{
        $erreur_tel= "Veuillez renseigner un tel ...";$validate2=false;
      }
      

      if (!empty($_POST['sujet'])) {
        $sujet= $_POST['sujet'];
        $validate2=true;
      }else{
        $erreur_sujet= "Veuillez renseigner un sujet ...";$validate2=false;
      }

      if (!empty($_POST['message'])) {
        $message= $_POST['message'];
        $validate2=true;
      }else{
        $erreur_message= "Veuillez renseigner un message ...";$validate2=false;
      }
      
      if (!empty($_FILES['fichier']['name']) && $validate) {
          $extensions= array('.png','.jpg','.jpeg','.gif');
          $extension = strchr($_FILES['fichier']['name'],'.');
          $dossier = UPLOAD;
      if (!in_array($extension, $extensions)) {
          $validate2= false;
          $error_fichier= "Vous devez choisir un format de fichier parmi(png,jpeg,jpg,gif,'JPEG','JPG')";
      }else{
         $fichier= $dossier.md5($_FILES['fichier']['name'])."$extension";$validate2=true;
        
        if (!move_uploaded_file($_FILES['fichier']['tmp_name'], $fichier)) {
          $validate2= false;
          $_SESSION['alert_error']= "Un problème est survenu lors du téléchargement du fichier...";
        }
      }
    }else{
      $fichier = $_SESSION['user']['fichier'];$validate2=true;
    }

     if ($validate2) {
      $users_id=1;
      $data = array('id' => $users_id,
                    'nom' => $nom,
                    'prenom'=> $prenom,
                    'mail'=> $email,
                    'sujet'=> $sujet,
                    'messsage'=> $messsage,
                    'tel' => $tel,
                    'fichier'  => $fichier
                    );
      $res = 'insert into `contact`(`nom`,`prenom`,`email`,`sujet`,`message`,`tel`,`file`,`users_id`,`created-at`) values(:nom,:prenom,:mail,:sujet,:message,:tel,:fichier,$users_id,NOW())';
      $inc= $DB->insert($res,$data);
      if($inc){
        $_SESSION['alert_success']= "Vous avez réussi la mise à jour de votre profil";
        $_SESSION['user'] = array_merge($_SESSION['user'],$data);
        header("location: compte.php");
      }else{
        $_SESSION['alert_error'] = "Un problème est survenu lors de la mise à jour";
      }header("location: ../index.php");
      exit();
    } 
  } 



?>
  
    <div id="content">
      <div class="row ">
        <?php  ?>
        <section class="col-md-4 col-xs-12 body-left" >
          <?php foreach($users as $user): ?>
          <div class="col-md-8 col-xs-12 profil">
            <div class="titres">
              <h1><?php echo $user->username; ?></h1>
            <h3><?php echo $user->titre1; ?></h3>
            <h3><?php echo $user->titre2; ?></h3>
            </div>
            
            <a href="#" class="thumbnail">
              <img src="img/thumbnail.jpg" alt="image">
            </a>
            <p class='tel'>Tel.:  <?php echo $user->tel; ?></p>
          </div>
         <?php endforeach  ?>
          <div class="col-md-4 col-xs-12 menu">
            <div class="col-xs-3 nav-float"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    
                    <ul class="nav nav-tabs tabs-left">                
                      <li class="active"><a href="#accueil" data-toggle="tab">accueil</a></li>
                      <?php foreach($menus_aff as $menu): ?>
                      <li><a href="#<?php echo $menu->nom; ?>" data-toggle="tab"><?php echo $menu->nom; ?></a></li>
                       <?php endforeach; ?>
                       <li><a href="#contact" data-toggle="tab">contact</a></li>
                    </ul>       
            </div>
          </div>
        </section> 
         
            <section class="col-md-8 col-xs-12 body">
                <div class="col-md-12 col-xs-12">
                    <!-- Tab panes -->
                    <div class="tab-content">
                      
                      <div class="tab-pane active" id="<?php echo $menus[0]->nom; ?>"><h1><?php echo $menus[0]->titre; ?> </h1>
                        <p>
                         <?php echo $menus[0]->contenu; ?>
                        </p>
                      </div>
                      <?php foreach($menus_aff as $menu): ?>
                        <div class="tab-pane " id="<?php echo $menu->nom; ?>"><h1><?php echo $menu->titre; ?> </h1>
                        <p>
                         <?php echo $menu->contenu; ?>
                        </p>
                     </div> 
                     <?php endforeach; ?>                     
                      <div class="tab-pane" id="contact">
                        <form method="POST" action="index.php">
                          <h4>Formulaire de contact</h4>
                          
                          <input type="text" id="nom" name="nom" placeholder ="nom"  value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ""; ?>">
                           <?php if (!empty($erreur_nom)): ?>
                            <div class="error"><?php echo $erreur_nom; ?></div>
                           <?php endif ?>
                         
                          <input type="text" id="prenom" name="prenom" placeholder ="prenom" value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : ""; ?>">
                          <?php if (!empty($erreur_prenom)): ?>
                            <div class="error"><?php echo $erreur_prenom; ?></div>
                           <?php endif ?>
                          
                          <input type="email" id="mail" name="mail" placeholder ="mail" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ""; ?>">
                          <?php if (!empty($erreur_mail)): ?>
                            <div class="error"><?php echo $erreur_mail; ?></div>
                           <?php endif ?>
                         
                         <input type="tel" id="tel" name="telephone" placeholder ="telephone" value="<?php echo isset($_POST['tel']) ? $_POST['tel'] : ""; ?>"> 
                         <?php if (!empty($erreur_tel)): ?>
                            <div class="error"><?php echo $erreur_tel; ?></div>
                           <?php endif ?>
                         
                          <input type="text" id="sujet" name="sujet" placeholder ="sujet"value="<?php echo isset($_POST['sujet']) ? $_POST['sujet'] : ""; ?>">
                          <?php if (!empty($erreur_sujet)): ?>
                            <div class="error"><?php echo $erreur_sujet; ?></div>
                           <?php endif ?>
                         
                          <textarea id="message" placeholder ="Ecrivez ici votre message" value="<?php echo isset($_POST['message']) ? $_POST['message'] : ""; ?>">
                          </textarea>
                          <?php if (!empty($erreur_message)): ?>
                            <div class="error"><?php echo $erreur_message; ?></div>
                           <?php endif ?>

                          <input type="file" name="fichier"><br>
                          <p><input type="submit" class="btn btn-primary btn-md" name="valider" role="button" value="valider" ></a></p>
                          <?php if (!empty($error_fichier)): ?>
                           <div class= "error"><?php echo $error_fichier; ?></div>
                          <?php endif ?>

                        </form>
                      </div>
                    </div>
                </div>   
                <div class="col-md-12 col-xs-12 temoignage"> 

                  <!--  Message de session -->
                    <?php if (isset($_SESSION['alert_success'])): ?>
                        <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
                        <?php unset($_SESSION['alert_success']); ?>
                    <?php endif ?>
                    <?php if (isset($_SESSION['alert_error'])): ?>
                        <div class="alert_error"><?php echo $_SESSION['alert_error'];?></div>
                        <?php unset($_SESSION['alert_error']); ?>
                    <?php endif ?>

                   <form action="index.php" method="POST">
          
                    <h5>LAISSEZ VOTRE TEMOIGNAGE</h5>
                      <p>
                        <label for="pseudo">Pseudo </label>
                        <input type="text" name="pseudo" value="<?php echo isset($_POST['pseudo']) ? $_POST['pseudo'] : ""; ?>">
                      </p>
                      <?php if (!empty($erreur_pseudo)): ?>
                        <div class="error"><?php echo $erreur_pseudo; ?></div>
                      <?php endif ?>
                      <p>
                        <label for="email">Email </label>
                        <input type="text" name="email" value='<?php echo isset($_POST["email"])? $_POST["email"] : "" ?>'>
                      </p>
                      <?php if (!empty($erreur_email)): ?>
                       <div class="error"> <?php echo $erreur_email; ?> </div>
                      <?php endif ?>
                      
                      <p>
                        <label for="contenu">contenu</label>
                        <textarea name="contenu" id="" cols="30" rows="10"><?php echo isset($_POST['contenu'])?$_POST['contenu']:""; ?></textarea>
                        <?php if (!empty($erreur_contenu)): ?>
                        <div class="error"><?php echo $erreur_contenu; ?></div>
                      <?php endif ?>
                      </p>
                      
                      
                        <p><input type="submit" class="btn btn-primary btn-md" role="button" name="poster" value="poster"></p>
                      
                    </form> 

                </div>  
                 <div class="col-md-12">
              <h2>Vos Derniers temoignages</h2>
              <?php foreach ($temoignage as $temoignage): ?>
              <span>témoignage de : <?php echo $temoignage->pseudo; ?></span>
              <span>&quot;<?php echo $temoignage->contenu; ?>&quot;</span>
                <span>via email: <?php echo $temoignage->email; ?>;</span><br>
              <?php endforeach ?>    
            </div>
    
          </section>

      </div>
  
    </div>

           <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Likebox facebook button-->
    <div id="fb-root"></div>
          <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.4";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
          </script>
    
  </body>
  
</html>