  <?php
  include "inc/includes.php";
  include "header.php";
 if (USER::isLog($DB)){
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $validate= false;

   

      if (empty($_POST['nom'])){
        $erreur_nom= "Veuillez renseigner un nom valide ...";
         $validate=false;
      }
      else $validate=true;

      if (empty($_POST['titre'])){
        $erreur_titre= "Veuillez renseigner un titre valide ...";
         $validate=false;
      }
      else $validate=true;

      if (empty($_POST['contenu'])){
        $erreur_contenu= "Veuillez renseigner un contenu valide ...";
         $validate=false;
      }
      else $validate=true;
      
  if ($validate) {
        $id= $_SESSION['user']['id'];
        $data = array(
          "nom"=>htmlspecialchars(addslashes($_POST['nom'])), 
           "titre" =>htmlspecialchars(addslashes($_POST['titre'])),
           "contenu" =>htmlspecialchars(addslashes($_POST['contenu'])),
           "users_id"=>$users_id
           );
        $sql= 'insert into `menu`(`nom`,`titre`,`contenu`, `users_id`) values(:nom,:titre,:contenu,:users_id)';
        $req= $DB->insert($sql,$data);
        if ($req) {
          $_SESSION['alert_success']="Vous avez ajouté un onglet au menu avec succès";
          unset($_POST);
        }else{
          $_SESSION['alert_error']="Echec lors de la création de l'onglet";
        }
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
                  <form action = "addonglet.php" method= "POST" enctype = "multipart/form-data">
                    <input type="hidden" name ="id" value= "<?php echo $_SESSION['user']['id']; ?>">
                    <p>
                      <label for="nom" >Nom onglet:</label>
                      <input type = "text" name = "nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ""; ?>">                 
                    </p>
                    <?php if (!empty($erreur_nom)): ?>
                        <div class="error"><?php echo $erreur_nom ?></div>
                      <?php endif ?>
                    <p>
                      <label for= "titre">Titre onglet:</label>
                      <input type = "text" name = "titre" value="<?php echo isset($_POST['titre']) ? $_POST['titre'] : ""; ?>">
                    </p>
                    <?php if (!empty($erreur_titre)): ?>
                        <div class="error"><?php echo $erreur_titre; ?></div>
                      <?php endif ?>

                    <p>
                      <label for= "contenu">Pseudo:</label>
                      <textarea  name= "contenu" cols="30" rows="10" value="<?php echo isset($_POST['pseudo']) ? $_POST['pseudo'] : ""; ?>"></textarea>
                    </p>         
                    <?php if (!empty($erreur_contenu)): ?>
                        <div class="error"><?php echo $erreur_contenu; ?></div>
                      <?php endif ?>
                 

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