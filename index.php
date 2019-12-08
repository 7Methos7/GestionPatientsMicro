<?php
/* Paramètres et variables globales */
include("params_intranet/param_appli_micro.php");
include("boite_outils/boite_outils_fonctions.php");
/* Gestion des interactions avec la base de données */
include("gestion_pdo.php");
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR" "http://www.w3.org/TR/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, target-densitydpi=device-dpi"/>
	<title>Microkinésithérapie - Gestion des patients</title>
<?php
	include("params_intranet/param_styles.php");
?>
</head>
<body>
<div id="conteneur_global">
  <div id="entete_appli"><img id="nuage_titre" src="images/nuage-iridescent.jpg"><span id="titre_appli">Microkinésithérapie - Gestion des patients</span></div>

  <div id="barre_alphabet">
    <ul><li><a href="index.php" target="_self">Tous</a></li><?php
	  foreach(range('A','Z') as $i) {
		echo "<li><a href='index.php?alphab=$i' target='_self'>$i</a></li>";
	  }
    ?></ul>
  </div>
	
  <div id="barre_action"><p class="field_action"><button class="bouton_menu"><a href="index.php?newpat=1" target="_self">Ajout d'un patient</a></button></p><?php include("recherche_patient_micro.php"); ?><?php if ($identpatient<>"") { echo "<p class='field_action'><button class='bouton_menu'><a href='index.php?nump=".$identpatient."&modpat=1' target='_self'>Modifier données patient</a></button></p>"; } if ($modificationpatient and $identpatient<>"") { echo "<p class='field_action'><button class='bouton_menu'><a href='index.php?nump=".$identpatient."' target='_self'>Retour consultation patient</a></button></p>"; } ?></div>
	<div id="barre_information">
	<?php
	/* Barre Informations */
	include("contenu/barre_information.php");
	?>
	</div>
	<div id="corps_appli">
	<?php
	/* Affichage par défaut : Liste entière des patients */
	if (!$consultpatient and !$recherche_effectuee and !$demandenouveaupatient and !$modificationpatient) {
		?>
		<h3>Liste alphabétique des patients<?php if (isset($_GET["alphab"])) { echo " commençant par ".$_GET["alphab"]; } ?></h3>
		<?php
		include($affich_ordre_alphab);
	}
	elseif ($consultpatient and !$demandenouveaupatient and !$modificationpatient) {
		?>
		<div id="bloc_donnees_patient"><?php include("contenu/bloc_donnees_patient.php"); ?></div>
		<div id="bloc_recap_fiches_patient"><?php include("contenu/bloc_recap_fiches_patient.php"); ?></div>
	<?php
		include("contenu/bloc_gestion_fiches_patient.php");
		}
		elseif ($recherche_effectuee) {
			include("contenu/bloc_recherche_effectuee.php");
		}
	if ($demandenouveaupatient or $modificationpatient) {
		if ($modificationpatient) {$modif=true;}
		if (!$modificationpatient) {
			
	?>
		<h3>Informations administratives du nouveau Patient</h3>
		<?php }
		else {
		?>
		<h3>Modification des données administratives de <?php echo $patient['nom_patient_micro']." ".$patient['prenom_patient_micro']; ?></h3>
		<?php } 
		include("contenu/bloc_gestion_patients.php");
	}
	echo "</div>";
	?>
</div>
</body>
</html>