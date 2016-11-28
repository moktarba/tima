<?php
  include "inc/includes.php";
  include "header.php";
  if (USER::isLog($DB)){
    $id= $_SESSION['user']['id'];
    $contacts= $DB->query("select contact.id, contact.nom, contact.prenom, contact.tel, contact.sujet, contact.message, contact.users_id from contact
                        inner join users on contact.users_id=users.id
                        where contact.users_id=$id
                        order by created_at desc"); 

   

    $temoignage= $DB->query("select temoignages.id, temoignages.contenu, temoignages.created_at, temoignages.users_id from temoignages 
                          inner join users on temoignages.users_id= users.id
                          where temoignages.users_id=$id
                          order by created_at desc");
    $nbr_temoignages= count($temoignage);
  }
?>
  	<div id="page">
      <!--  Message de session -->
                    <?php if (isset($_SESSION['alert_success'])): ?>
                        <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
                        <?php unset($_SESSION['alert_success']); ?>
                    <?php endif ?>
                    <?php if (isset($_SESSION['alert_error'])): ?>
                        <div class="alert_error"><?php echo $_SESSION['alert_error'];?></div>
                        <?php unset($_SESSION['alert_error']); ?>
                    <?php endif ?>
                    
  		<div id="contenuPage">
  			<div id="Post">
          <div id="article">
           
  				  <div id="box_name">
              <div id="thumb"><img src="<?php echo isset($_SESSION['user']['avatar'])?$_SESSION['user']['avatar']:"img/avatar.png"; ?>"></div>
              <div id="infos">
                <h4>BONJOUR <?php echo strtoupper($_SESSION['user']['username']); ?></h4>
                <p> Inscrit depuis le <?php echo Texte:: date_french($_SESSION['user']['created_at']); ?> avec (<?php echo $nbr_temoignages; ?>) contacts, (<?php echo $nbr_temoignages; ?>)temoignages</p>
              </div>
            </div>
            <div id="box_infos">
                <h4>Vos Informations</h4>
               
                  <p id="nom">Nom: <strong><?php echo $_SESSION['user']['prenom'];?></strong></p>  
                <p id="prenom">Prénom: <strong><?php echo $_SESSION['user']['nom']; ?></strong></p>
                <p id="mail">Email: <strong><?php echo $_SESSION['user']['email'] ?></strong> </p> 
                <p id="mail">Email: <strong><?php echo $_SESSION['user']['titre1'] ?></strong> </p> 
                <p id="mail">Email: <strong><?php echo $_SESSION['user']['titre2'] ?></strong> </p> 
                    
                <p id="connex">date de la dernière connexion: le <?php echo Texte::date_french_time($_SESSION['user']['last_login']); ?></p>  
           
                              
              </div>

              <!-- Début last_posts -->  
               <!-- Début last_posts -->  
              <div id="last_posts">
             <h2>MES DERNIERS MESSAGES</h2>
              <?php foreach ($contacts as $contact): ?>
           <div class="lastArticles">              
              <div class="last_content">

                <h3> nom: </h3><h4><?php echo $contact->nom; ?></h4>
               <h3> prenom:</h3> <h4> <?php echo $contact->prenom; ?></h4>
                <h3> tél: </h3> <h4><?php echo $contact->tel; ?></h4><br>
               <h3>Le sujet: </h3> <h4> <?php echo $contact->sujet; ?></h4>
                <h3>Le message: </h3>
                 <p>
                    <?php echo Texte::limit($contact->message, 70); ?>
                </p>    
              </div>
            </div>
              <?php endforeach ?>
           </div>
              
          </div><!-- fin article -->  
  			</div><!-- fin Post -->


  			 <div id="boxComments_compte">
          <div class="box_modif">
            <h2> Modifications </h2><br>
            <ul>
                <li ><a href="profil.php">Modifier mon profil</a></li><br>
                <li ><a href="addonglet.php">ajouter un onglet</a></li><br>
                <li></li>
            </ul>
              
              
            </ul>
          </div> <!--  fin lastPosts -->

            <div class="lastComments">
              <h2>Vos Derniers temoignages</h2>
              <?php foreach ($temoignage as $temoignage): ?>
                <p>&quot;<?php echo $temoignage->contenu; ?>&quot;</p>
              <?php endforeach ?>    
            </div>

  
          
        </div><!-- boxComments_compte -->
  		</div>
  	</div>
    
    </div>
  </body>
