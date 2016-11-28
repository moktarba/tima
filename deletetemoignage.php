  <?php
  include "inc/includes.php";
  include "header.php";
  

 if (USER::isLog($DB)){
   
         $id= $_SESSION['user']['id'];
        $temoignages= $DB->query("select temoignages.id, temoignages.contenu,temoignages.pseudo,temoignages.email, temoignages.created_at, temoignages.users_id from temoignages 
                          inner join users on temoignages.users_id= users.id
                          where temoignages.users_id=$id
                          order by created_at desc limit 5");
     
    
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
                
                  <div class="panel panel-default">
                    <!-- Default panel contents -->
                      <div class="panel-heading">Panneau de suppression des témoignages</div>
                       <div class="panel-body">
                          <p>Vous pouvez supprimer un témoignage en cliquant sur le bouton supprmer</p>
                       </div>

                    <!-- Table -->
                    <table class="table">
                      <tr>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Supprimer</th>
                      </tr>
                      
                        <?php foreach ($temoignages as $temoignage): ?>
                        <tr>
                          <td><?php echo $temoignage->pseudo; ?></td>
                          <td><?php echo $temoignage->email; ?></td>
                          <td><?php echo $temoignage->contenu; ?></td>
                          <td><?php echo $temoignage->created_at; ?></td>
                          <td><button class="btn btn-primary" type="button" ><a href="deleted.php?id=<?php echo $temoignage->id ?>">supprimer</a></button></td>
                           </tr>
                        <?php endforeach ?>
                       
                    </table>
                  </div>
                    
             </div> 
        </section>
         
      </div>
      </div>
    </div>
    
  </body>
  </html>