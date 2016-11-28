  <?php
  include "inc/includes.php";
  include "header.php";
 if (USER::isLog($DB)){
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $validate= true;   

    $id= $_SESSION['user']['id'];
    $menus= $DB->query('select id,nom,titre,contenu, afficher from menu order by id  ');  

      if (empty($_POST['email'])) {
        $email= $_SESSION['user']['email'];
      }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $validate=false;
        $error_email= "Veuillez renseigner un email valide...";
      }else $email = $_POST['email'];

      if (empty($_POST['password'])) {
        $password = $_SESSION['user']['password'];
      }elseif (empty($_POST['confirm_password'])) {
         $error_confirm_password= "Veuillez confirmer votre mot de passe...";
         $validate=false;
      }
      elseif ($_POST['confirm_password'] != $_POST['password']) {
        $validate= false;
       $error_confirm_password= "Le mot de passe de confirmation est différente...";
      }
      else{
        $password = USER::hashPassword($_POST['password']);
        $validate= true;
      }

    if (!empty($_FILES['avatar']['name']) && $validate) {
      $extensions= array('.png','.jpg','.jpeg','.gif');
      $extension = strchr($_FILES['avatar']['name'],'.');

      $dossier = UPLOAD;
      if (!in_array($extension, $extensions)) {
        $validate= false;
        $error_avatar= "Vous devez choisir un format de fichier parmi(png,jpeg,jpg,gif,'JPEG','JPG')";
      }else{
        $avatar= $dossier.md5($_FILES['avatar']['name'])."$extension";
        
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar)) {
                $validate= false;
                $_SESSION['alert_error']= "Un problème est survenu lors du téléchargement du fichier...";
        }
      }
    }else{
      $avatar = $_SESSION['user']['avatar'];
    }


    if (!empty($_FILES['musique']['name']) && $validate) {
      $extensions= array('.png','.jpg','.jpeg','.gif');
      $extension = strchr($_FILES['musique']['name'],'.');

      $dossier = UPLOAD;
      if (!in_array($extension, $extensions)) {
        $validate= false;
        $error_musique= "Vous devez choisir un format de fichier parmi(png,jpeg,jpg,gif,'JPEG','JPG')";
      }else{
        $musique= $dossier.md5($_FILES['musique']['name'])."$extension";
        
        if (!move_uploaded_file($_FILES['musique']['tmp_name'], $musique)) {
                $validate= false;
                $_SESSION['alert_error']= "Un problème est survenu lors du téléchargement du fichier...";
        }
      }
    }else{
      $musique = $_SESSION['user']['musique'];
    }


    if (!empty($_POST['nom'])) {
        $nom= $_POST['nom'];
        $validate=true;
      }else{
        $nom= $_SESSION['user']['nom'];
      }

      if(!empty($_POST['prenom'])){
        $prenom = $_POST['prenom'];
        $validate = true;
      }else{
        $prenom= $_SESSION['user']['prenom'];
      }

      if(!empty($_POST['username'])){
        $username = $_POST['username'];
      }else{
        $username= $_SESSION['user']['username'];
      }

      if(!empty($_POST['tel'])){
        $tel = $_POST['tel'];
      }else{
        $tel= $_SESSION['user']['tel'];
      }

      if(!empty($_POST['rue'])){
        $rue = $_POST['rue'];
      }else{
        $rue= $_SESSION['user']['rue'];
      }

      if(!empty($_POST['cp'])){
        $cp = $_POST['cp'];
      }else{
        $cp= $_SESSION['user']['cp'];
      }

      if(!empty($_POST['ville'])){
        $ville = $_POST['ville'];
      }else{
        $ville= $_SESSION['user']['ville'];
      }

      if(!empty($_POST['pays'])){
        $pays = $_POST['pays'];
      }else{
        $pays= $_SESSION['user']['pays'];
      }

      if(!empty($_POST['intro'])){
        $intro = $_POST['intro'];
      }else{
        $intro= $_SESSION['user']['intro'];
      }

      if(!empty($_POST['titre1'])){
        $titre1 = $_POST['titre1'];
      }else{
        $titre1= $_SESSION['user']['titre1'];
      }

      if(!empty($_POST['titre2'])){
        $titre2 = $_POST['titre2'];
      }else{
        $titre2= $_SESSION['user']['titre2'];
      }

    if ($validate) {
      $data = array('id' => $_SESSION['user']['id'],
                    'nom' => $nom,
                    'prenom'=> $prenom,
                    'username'=> $username,
                    'intro'=> $intro,
                    'tel'=> $tel,
                    'rue'=> $rue,
                    'cp'=> $cp,
                    'ville'=> $ville,
                    'pays'=> $pays,
                    'titre1'=> $titre1,
                    'titre2'=> $titre2,
                    'email' => $email,
                    'password'=> $password,
                    'avatar'  => $avatar,
                    'musique'  => $musique
                    );
      $inc = $DB->insert('update users set nom =:nom,prenom=:prenom,username=:username,tel=:tel,rue=:rue,cp=:cp,ville=:ville,pays=:pays,intro=:intro,titre1=:titre1,titre2=:titre2, email=:email, password=:password, avatar=:avatar,musique=:musique, updated_at =NOW() where id=:id',$data);
      if($inc){
        $_SESSION['alert_success']= "Vous avez réussi la mise à jour de votre profil";
        $_SESSION['user'] = array_merge($_SESSION['user'],$data);
        header("location: ../localhost/timamaraboutvoyant/compte.php");
      }else{
        $_SESSION['alert_error'] = "Un problème est survenu lors de la mise à jour";
      }header("location: ../index.php");
      exit();
    } 
  } 
}
   else{
    header("location: login.php");
   $_SESSION["alert_error"]= "Cet espace est réservé aux abonnés...";
    exit();
  }
?>
<div id="page">
      <div id="contenuPage">
          <div id="article">
           
            <div id="box_profil">
              <div id="thumb"><img src="<?php echo isset($_SESSION['user']['avatar'])?$_SESSION['user']['avatar']:"img/avatar.png"; ?>"></div>
              <div id="infos">
                <h4>BONJOUR <?php echo strtoupper($_SESSION['user']['username']); ?></h4>
                <p> Inscrit depuis le <?php echo Texte::date_french($_SESSION['user']['created_at']) ?></p>
                <p>Username: <?php echo $_SESSION['user']['username'] ?></p>
              </div>
            </div>
            <div id="box_modif">
                <h4>Modifier mon profil</h4>

                            <!--  Message de session -->
                    <?php if (isset($_SESSION['alert_success'])): ?>
                        <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
                        <?php unset($_SESSION['alert_success']); ?>
                    <?php endif ?>
                    <?php if (isset($_SESSION['alert_error'])): ?>
                        <div class="alert_error"><?php echo $_SESSION['alert_error'];?></div>
                        <?php unset($_SESSION['alert_error']); ?>
                    <?php endif ?>
                <div class="col-md-12">
                  <form action = "profil.php" method= "POST" enctype = "multipart/form-data">
                    <input type="hidden" name ="id" value= "<?php echo $_SESSION['user']['id']; ?>">
                    <p>
                      <label for="nom" >Nom:</label>
                      <input type = "text" name = "nom" value="<?php echo $_SESSION['user']['prenom'] ?>">
                     
                    </p>

                    <p>
                      <label for= "prenom">Prénom:</label>
                      <input type = "text" name = "prenom" value="<?php echo $_SESSION['user']['nom'] ?>">
                    </p>

                    <p>
                      <label for= "username">Pseudo:</label>
                      <input type = "text" name = "username" value="<?php echo $_SESSION['user']['username'] ?>">
                    </p>    

                    <p>
                      <label for= "tel">Tel:</label>
                      <input type = "text" name = "tel" value="<?php echo $_SESSION['user']['tel'] ?>">
                    </p>   

                    <p>
                      <label for= "rue">Rue:</label>
                      <input type = "text" name = "rue" value="<?php echo $_SESSION['user']['rue'] ?>">
                    </p>   

                    <p>
                      <label for= "cp">Code postal:</label>
                      <input type = "text" name = "cp" value="<?php echo $_SESSION['user']['cp'] ?>">
                    </p>        

                    <p>
                      <label for= "ville">Ville:</label>
                      <input type = "text" name = "ville" value="<?php echo $_SESSION['user']['ville'] ?>">
                    </p>   

                    <p>
                      <label for= "pays">Pays:</label>
                      <input type = "text" name = "pays" value="<?php echo $_SESSION['user']['pays'] ?>">
                    </p>   

                    <p>
                      <label for= "intro">Intro:</label>
                      <textarea cols=30 rows=15 name="intro"><?php echo $_SESSION['user']['intro'] ?></textarea>
                    </p>

                    <p>
                      <label for= "titre1">Premier titre:</label>
                      <input type = "text" name = "titre1" value="<?php echo $_SESSION['user']['titre1'] ?>">
                    </p>

                    <p>
                      <label for= "prenom">Second titre:</label>
                      <input type = "text" name = "titre2" value="<?php echo $_SESSION['user']['titre2'] ?>">
                    </p>

                    <p>
                      <label for="email">Email:</label>
                      <input type = "email" name = "email" value="<?php echo $_SESSION['user']['email'] ?>">
                    </p>
                     <?php if (!empty($error_email)): ?>
                        <div class= "error"><?php echo $error_email; ?></div>
                      <?php endif ?>

                    <p>
                      <label for="password">Mot de passe:</label>
                     <input type = "password" name = "password">
                    </p>
                     

                    <p>
                      <label for="confirm_password">Confirmer mot de passe:</label>
                      <input type = "password" name = "confirm_password">
                    </p>
                     <?php if (!empty($error_confirm_password)): ?>
                        <div class= "error"><?php echo $error_confirm_password; ?></div>
                      <?php endif ?>

                     <?php if (!empty($error_avatar)): ?>
                       <div class= "error"><?php echo $error_avatar; ?></div>
                      <?php endif ?>
                    <p>
                     <label for= "avatar">avatar:</label>
                     <input type = "file" name = "avatar">
                    </p>

                    <p>
                     <label for= "musique">musique:</label>
                     <input type = "file" name = "musique">
                    </p>

                    <p>
                     <input type="submit" name= "valider">
                    </p>
                    
                  </form>
               </div>    
             </div> 
        </section>
         
      </div>
      </div>
    </div>
  </body>
  </html>