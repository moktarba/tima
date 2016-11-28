  <?php
  include "inc/includes.php";
  include "header.php";

 
    
 if (USER::isLog($DB)){

   $id= $_SESSION['user']['id'];
    $menus= $DB->query("select menu.id, menu.nom, menu.titre, menu.contenu, menu.users_id from menu where id=1
              
                        ");  

    if($_SERVER['REQUEST_METHOD']=="POST"){
      $validate= false;   

  

      if (!empty($_POST['nom'])) {
          $nom= $_POST['nom'];
          $validate=true;
        }

        if(!empty($_POST['titre'])){
          $titre = $_POST['titre'];
          $validate = true;
        }

        if(!empty($_POST['contenu'])){
          $contenu = $_POST['contenu'];
          $validate = true;
        }

    

    if ($validate) {
       
       
        
        
      $data = array(
                    'nom' => $_POST['nom'],
                    'titre'=> $_POST['titre'],
                    'contenu'=> $_POST['contenu']
                    
                 );
         $inc = $DB->insert('update menu set nom=:nom,titre=:titre,contenu=:contenu where id="1" ',$data);
        
       
     
      } 
   
   if($inc){
        $_SESSION['alert_success']= "Vous avez réussi la mise à jour de votre menu";
        
        header("location: compte.php");
      }else{
        $_SESSION['alert_error'] = "Un problème est survenu lors de la mise à jour";
      }header("location: compte.php");
      exit();
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
                <h4>Modifier mon menu</h4>

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

                    <form action = "changemenu1.php" method= "POST" enctype = "multipart/form-data">
                    <input type="hidden" name ="id" value= "<?php echo $_SESSION['user']['id']; ?>">

                         <div class="panel panel-default">
                          <!-- Default panel contents -->
                          <div class="panel-heading">Modifier Menu</div>
                          <div class="panel-body">
                            <p>Changez ici le nom de l'onglet dans le menu, son titre dans la page ainsi que son contenu.</p>
                          </div>

                          <!-- Table -->
                          <table class="table">
                            <tr>
                              <th>NOM MENU</th>
                              <th>TITRE MENU</th>
                              <th>CONTENU TEXTE DU MENU</th>
                            </tr>

                                                  
                            <tr>
                              <td> 
                                <input type = "text" name = "nom" value="<?php echo isset($_POST['nom']) ? $menus->nom : ""; ?>">
                              </td>   
                              <td>                 
                                 <input type = "text" name = "titre" value="<?php echo isset($_POST['titre']) ? $menus->titre : ""; ?>">
                               </td>
                              <td>  
                                <input type = "text" name = "contenu" value="<?php echo isset($_POST['contenu']) ? $menus->contenu : ""; ?>">
                              </td>
                            </tr>
                         
                           
                          </table>
                     
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