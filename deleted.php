<?php 
include "inc/includes.php";


$temoignages= $DB->query("select temoignages.id, temoignages.contenu,temoignages.pseudo,temoignages.email, temoignages.created_at, temoignages.users_id from temoignages ");

	if (isset($_GET['id'])) {
		$id= $_GET['id'];
		$sql= "DELETE FROM temoignages WHERE id = $id" ; 
		$DB->delete($sql);
	header("location:deletetemoignage.php ");
        }
 ?>
