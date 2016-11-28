<?php
  include "inc/includes.php";
  include "header.php";
  if (USER::isLog($DB)){
    $id= $_SESSION['user']['id'];
    $contacts= $DB->query("select contact.id, contact.nom, contact.prenom, contact.tel, contact.sujet, contact.message, contact.users_id from contact
                        inner join users on contact.users_id=users.id
                        where contact.users_id=$id"); 

   

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
           <!-- <div id="box_infos">-->
                <h4>Vos Informations</h4>
                   <div class="panel panel-info">
                    <!-- Default panel contents -->
                    <div class="panel-heading">INFOS PROFIL</div>
                      <div class="panel-body">
                        <p> Retrouvez ici vos informations de profil sur la partie de gauche de votre site.</p>
                      </div>
                                        <!-- Table -->
                    <table class="table">
                      <tr>
                        <th>USERNAME</th>
                       
                        <th><strong>TEL</strong></th>
                        <th><strong>TITRE 1</strong></th>   
                        <th><strong>TITRE 2</strong></th> 
                        <th><strong>CREE LE</strong></th> 
                        <th><strong>MODIFIE LE</strong></th>
                        <th><strong>DERNIERE CONNEXION</strong></th>
                      </tr>
                      <tr>
                        <td><?php echo $_SESSION['user']['username'];?></strong></td>
                        <td><?php echo $_SESSION['user']['tel'];?></strong></td>
                        <td><?php echo $_SESSION['user']['titre1'];?></strong></td>
                        <td><?php echo $_SESSION['user']['titre2'];?></strong></td>
                        <td><?php echo Texte::date_french_time($_SESSION['user']['created_at']);?></strong></td>
                        <td><?php echo Texte::date_french_time($_SESSION['user']['updated_at']);?></strong></td>
                        <td><?php echo Texte::date_french_time($_SESSION['user']['last_login']);?></strong></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                <div class="panel panel-info">
                    <!-- Default panel contents -->
                    <div class="panel-heading">INFOS DE CONTACT</div>
                      <div class="panel-body">
                        <p> Retrouvez ici vos iformations de contact dans la partie rubrique contact de votre site.</p>
                      </div>
                                        <!-- Table -->
                    <table class="table">
                      <tr>          
                        <th><strong>NOM</strong></th>
                        <th><strong>PRENOM</strong></th>   
                        <th><strong>INTRO</strong></th> 
                        <th><strong>RUE</strong></th> 
                        <th><strong>CODE POSTALE</strong></th>
                        <th><strong>VILLE</strong></th>
                        <th><strong>PAYS</strong></th>
                      </tr>
                      <tr>
                        <td><?php echo $_SESSION['user']['nom'];?></strong></td>
                        <td><?php echo $_SESSION['user']['prenom'];?></strong></td>
                        <td><?php echo $_SESSION['user']['intro'];?></strong></td>
                        <td><?php echo $_SESSION['user']['rue'];?></strong></td>
                        <td><?php echo $_SESSION['user']['cp'];?></strong></td>
                        <td><?php echo $_SESSION['user']['ville'];?></strong></td>
                        <td><?php echo $_SESSION['user']['pays'];?></strong></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                              
             <!-- </div>-->

              <!-- Début last_posts -->  
               <!-- Début last_posts -->  
             
              
                       
              <div class="last_content">
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">DERNIERS MESSAGES</div>
                      <div class="panel-body">
                        <p> Retrouvez ici votre boite de réception des messages.</p>
                      </div>
                                        <!-- Table -->
                    <table class="table">
                      <tr>          
                        <th><strong>NOM</strong></th>
                        <th><strong>PRENOM</strong></th>   
                        <th><strong>TEL</strong></th> 
                        <th><strong>RUE</strong></th> 
                        <th><strong>SUJET</strong></th>
                        <th><strong>MESSAGE</strong></th>
                      </tr>

                      <?php foreach ($contacts as $contact ): ?> 
                      <tr>                        
                        <td><strong><?php echo $contact->nom;?></strong></td>
                         <td><strong><?php echo $contact->prenom;?></strong></td>
                         <td><strong><?php echo $contact->tel;?></strong></td>
                         <td><strong><?php echo $contact->sujet;?></strong></td>
                         <td><strong><?php echo $contact->message;?></strong></td>     
                      </tr>
                      <?php endforeach ?>
                    </table>
                  </div>              
           </div>
              
          </div><!-- fin article -->  
  			</div><!-- fin Post -->


  			 <div id="boxComments_compte">
          <div class="box_modif">
            <h2> Modifications </h2><br>
            <ul>
                <li ><a href="profil.php">Modifier mon profil</a></li><br>
                <li ><a href="addonglet.php">ajouter un onglet au menu</a></li><br>
                <li ><a href="changemenu1.php">modifier le premier onglet menu</a></li><br>
                <li ><a href="changemenu2.php">modifier le second onglet menu</a></li><br>
                <li ><a href="changemenu3.php">modifier le troisième onglet menu</a></li><br>
                <li ><a href="deletetemoignage.php">supprimer un témoignage</a></li><br>
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
