<?php
/* Une consultation est en cours */
$consultpatient=false;
/* Identification patient */
$identpatient="";
/* Identification fiche patient */
$identfiche="";
/* Témoin d'ajout de fiche */
$ficheajoutee="";
/* Témoin de recherche de patient */
$recherche_effectuee=false;
/* Témoin demande nouveau patient en cours */
$demandenouveaupatient=false;
/* Témoin modification patient en cours */
$modificationpatient=false;
/* Témoin pour affichage champ formulaire lors d'une modification patient */
$modif=false;
/* Témoin de modification d'une fiche d'un patient */
$demandemodiffiche=false;
/* Témoin si un patient a été ajouté */
$patientajoute="";
/* Témoin si un patient a été modifié */
$patientmodifie="";
/* Témoin modification fiche */
$fichemodif="";
/* Témoin affichage patients archivés */
$patients_archives=false;

$message_erreur="";

/* Mode affichage ajout des données administratives d'un nouveau patient */
if (isset($_GET["newpat"]) and $_GET["newpat"]==1) {
	$demandenouveaupatient=true;
}
/* Mode affichage ajout des données administratives d'un nouveau patient */
if (isset($_GET["modpat"]) and $_GET["modpat"]==1) {
	$modificationpatient=true;
}
/* Mode affichage ajout d'un nouveau patient */
if (isset($_GET["ap"]) and $_GET["ap"]==true) {
	$patientajoute=true;
}
/* Mode affichage ajout d'une fiche à un patient */
if (isset($_GET["af"]) and $_GET["af"]==true) {
	$ficheajoutee=true;
}
/* Mode affichage modification des données administratives patient */
if (isset($_GET["modpat"]) and $_GET["modpat"]==1) {
	if(isset($_GET["nump"]) and ctype_digit($_GET["nump"])) {
		include($connexion_base);
		$requete = $bd_micro->prepare("SELECT id_patient_micro, nom_patient_micro, prenom_patient_micro, naissance_patient_micro, sex_patient_micro, adresse1_patient_micro, adresse2_patient_micro, cp_patient_micro, localite_patient_micro, tel1_patient_micro, tel2_patient_micro, adresse_mail_patient_micro, archive_patient_micro, infos_complementaires FROM ".$tab_patients_micro." WHERE id_patient_micro=:ident");
		$requete->bindValue(':ident', $_GET["nump"], PDO::PARAM_STR);	
		try {
			$requete->execute();
		}
		catch (Exception $e) {
			echo "La transaction a échouée : ".$e->getMessage();
		}
		$patient=$requete->fetch();
		$modificationpatient=true;
		unset($requete);
		include($deconnexion_base);
	}
}
/* Mode affichage modification d'une fiche patient */
if (isset($_GET["modfich"]) and $_GET["modfich"]==1) {
	if(isset($_GET["nump"]) and ctype_digit($_GET["nump"]) and isset($_GET["numfich"]) and ctype_digit($_GET["numfich"])) {
		include($connexion_base);
		$identpatient=$_GET["nump"];
		$identfiche=$_GET["numfich"];
		$requete4 = $bd_micro->prepare("SELECT * FROM ".$tab_fiches_micro." WHERE id_patient_micro=:ident and id_fiche_micro=:identf");
		$requete4->bindValue(':ident', $identpatient, PDO::PARAM_STR);
		$requete4->bindValue(':identf', $identfiche, PDO::PARAM_STR);
		try {
			$requete4->execute();
		}
		catch (Exception $e) {
			echo "La transaction a échouée : ".$e->getMessage();
		}
		$donnees_fiche = $requete4->fetch();
		$demandemodiffiche=true;
		unset($requete4);
		include($deconnexion_base);
	}
}
/* Modification des données administratives d'un patient */
if (isset($_POST["Modifier"])) {
	if(isset($_GET["nump"]) and ctype_digit($_GET["nump"])) {
		$patientmodifie=false;
		$nonvide=true;
		$pas_erreur=true;
		include($verif_format_champs_patient);
		include($verif_nonvides_patient_fiche);
		if ($pas_erreur and $nonvide) {
			include($connexion_base);
			if (isset($_POST["archive_patient"])) {
				$archivep=$_POST["archive_patient"];
			}
			else $archivep=0;
			$nomcontact=htmlspecialchars($_POST["nom_patient"], ENT_QUOTES);
			$prenomcontact=htmlspecialchars($_POST["prenom_patient"], ENT_QUOTES);
			$adresse1contact=htmlspecialchars($_POST["adresse1_patient"], ENT_QUOTES);
			$adresse2contact=htmlspecialchars($_POST["adresse2_patient"], ENT_QUOTES);
			$localitecontact=htmlspecialchars($_POST["localite_patient"], ENT_QUOTES);
			$infoscomplementaires=htmlspecialchars($_POST["infos_complement"], ENT_QUOTES);
			$requete = "UPDATE ".$tab_patients_micro." SET nom_patient_micro='".mb_strtoupper($nomcontact, 'UTF-8')."', prenom_patient_micro='".mb_ucfirst($prenomcontact, 'UTF-8')."', naissance_patient_micro='".$_POST["naissance_patient"]."', sex_patient_micro='".$_POST["sexe_patient"]."', adresse1_patient_micro='".$adresse1contact."', adresse2_patient_micro='".$adresse2contact."', cp_patient_micro='".$_POST["cp_patient"]."', localite_patient_micro='".mb_strtoupper($localitecontact, 'UTF-8')."', tel1_patient_micro='".$_POST["telephone1_patient"]."', tel2_patient_micro='".$_POST["telephone2_patient"]."', adresse_mail_patient_micro='".$_POST["mail1_patient"]."', archive_patient_micro=".$archivep.", infos_complementaires='".$infoscomplementaires."' WHERE id_patient_micro=".$_POST["id_patient"];
			try {
				$bd_micro->query($requete);
			}
			catch (Exception $e) {
				echo "La transaction a échouée : ".$e->getMessage();
			}
			$patientmodifie=true;
			include($deconnexion_base);
			header ('location: index.php?nump='.$_GET["nump"]);
		}
		else { $message_erreur="<span class='alerte_erreur'>Erreur de saisie ou champ vide lors de votre tentative de modification !</span>"; }
	}
}
if (isset($_GET["arch"]) and $_GET["arch"]==1) {
	$patients_archives=true;
}
/* Recherche d'un patient en tapant les premières lettres */
if (isset($_POST["Rechercher"])) {
/*	if (isset($_POST["recherche_nom_patient"]) and strlen($_POST["recherche_nom_patient"]) > 0) {*/
		include($connexion_base);
		$requete = $bd_micro->prepare("SELECT id_patient_micro, nom_patient_micro, prenom_patient_micro, tel1_patient_micro, tel2_patient_micro FROM ".$tab_patients_micro." WHERE nom_patient_micro LIKE CONCAT(:chaine1,'%') and prenom_patient_micro LIKE CONCAT(:chaine2,'%') and (tel1_patient_micro LIKE CONCAT(:chaine3,'%') or tel2_patient_micro LIKE CONCAT(:chaine3,'%')) ORDER BY nom_patient_micro");
		$requete->bindValue(':chaine1', $_POST["recherche_nom_patient"], PDO::PARAM_STR);
		$requete->bindValue(':chaine2', $_POST["recherche_prenom_patient"], PDO::PARAM_STR);		
		$requete->bindValue(':chaine3', $_POST["recherche_tel_patient"], PDO::PARAM_STR);
		try {
			$requete->execute();
		}
		catch (Exception $e) {
			echo "La transaction a échouée : ".$e->getMessage();
		}
		$listepatients=$requete->fetchall();
		$nbpatients=count($listepatients);
		$recherche_effectuee=true;
		unset($requete);
		include($deconnexion_base);
/*	} */
}
/* Ajout d'un nouveau patient */
if (isset($_POST["Valider"])) {
	$patientajoute=false;
	$nonvide=true;
	$pas_erreur=true;
	include($verif_format_champs_patient);
	include($verif_nonvides_patient_fiche);
	if ($pas_erreur and $nonvide) {
		include($connexion_base);
		$nomcontact=htmlspecialchars($_POST["nom_patient"], ENT_QUOTES);
		$prenomcontact=htmlspecialchars($_POST["prenom_patient"], ENT_QUOTES);
		$adresse1contact=htmlspecialchars($_POST["adresse1_patient"], ENT_QUOTES);
		$adresse2contact=htmlspecialchars($_POST["adresse2_patient"], ENT_QUOTES);
		$localitecontact=htmlspecialchars($_POST["localite_patient"], ENT_QUOTES);
		$infoscomplementaires=htmlspecialchars($_POST["infos_complement"], ENT_QUOTES);
		$requete = $bd_micro->prepare("INSERT INTO $tab_patients_micro (nom_patient_micro, prenom_patient_micro, naissance_patient_micro, sex_patient_micro, adresse1_patient_micro, adresse2_patient_micro, cp_patient_micro, localite_patient_micro, tel1_patient_micro, tel2_patient_micro, adresse_mail_patient_micro, infos_complementaires) VALUES ('".mb_strtoupper($nomcontact, 'UTF-8')."','".mb_ucfirst($prenomcontact, 'UTF-8')."','".$_POST["naissance_patient"]."','".$_POST["sexe_patient"]."','".$adresse1contact."','".$adresse2contact."','".$_POST["cp_patient"]."','".mb_strtoupper($localitecontact, 'UTF-8')."','".$_POST["telephone1_patient"]."','".$_POST["telephone2_patient"]."','".$_POST["mail1_patient"]."','".$infoscomplementaires."')");
		try {
			$requete->execute();
		}
		catch (Exception $e) {
			echo "La transaction a échouée : ".$e->getMessage();
		}
        $dernier_id_insert = $bd_micro->lastInsertId();
		$patientajoute=true;
		unset($requete);
		include($deconnexion_base);
        header ('location: index.php?nump='.$dernier_id_insert.'&ap='.$patientajoute);
        exit;
	}
	else { $message_erreur="<span class='alerte_erreur'>Erreur de saisie ou champ vide lors de votre tentative d'ajout de patient !</span>"; }
}

/* Récupération des données administratives, fiches pour consultation d'un patient et validation d'une nouvelle fiche */
if(isset($_GET["nump"]) and ctype_digit($_GET["nump"]) and !isset($_GET["modpat"])) {
	include($connexion_base);
	$identpatient=$_GET["nump"];
	if (isset($_POST["ValiderF"])) {
		$nonvide=true;
		$pas_erreur=true;
		include($verif_nonvides_patient_fiche);
		$fichemodif=false;
		$ficheajoutee=false;
		if ($_POST["date_fiche"]==NULL or $_POST["date_fiche"]=="") {
			$ladate=date("Y-m-d");
		}
		elseif (!est_une_date_valide($_POST["date_fiche"])) {$pas_erreur=false;}
			else { $ladate=substr($_POST["date_fiche"], 6,4)."-".substr($_POST["date_fiche"], 3,2)."-".substr($_POST["date_fiche"], 0,2); }
		if ($pas_erreur and $nonvide) {
			$chaine=htmlspecialchars($_POST["cpt_rendu_fiche"], ENT_QUOTES);
			if (isset($_GET["vmod"]) and $_GET["vmod"]==1) { $identfiche=$_POST["id_fiche"];$fichemodif=true;$requete3 = "UPDATE ".$tab_fiches_micro." SET date_fiche_micro='".$ladate."', cpt_rendu_fiche_micro='".$chaine."' WHERE id_fiche_micro=".$identfiche; }
			else { $ficheajoutee=true;$requete3 = "INSERT INTO $tab_fiches_micro (id_patient_micro, date_fiche_micro, cpt_rendu_fiche_micro) VALUES ('".$identpatient."','".$ladate."','".$chaine."')"; }
			try {
				$bd_micro->query($requete3);
			}
			catch (Exception $e) {
				echo "La transaction a échouée : ".$e->getMessage();
			}
			header ('location: index.php?nump='.$identpatient.'&af='.$ficheajoutee);
			exit;
		}
		else { $message_erreur="<span class='alerte_erreur'>Erreur de saisie ou champ vide lors de votre tentative d'ajout de fiche !</span>"; }		
	}
	$requete = $bd_micro->prepare("SELECT * FROM ".$tab_patients_micro." WHERE id_patient_micro=:ident");
	$requete2 = $bd_micro->prepare("SELECT * FROM ".$tab_fiches_micro." WHERE id_patient_micro=:ident ORDER BY date_fiche_micro DESC");
	$requete->bindValue(':ident', $identpatient, PDO::PARAM_STR);
	$requete2->bindValue(':ident', $identpatient, PDO::PARAM_STR);		
	try {
		$requete->execute();
		$requete2->execute();
		}
	catch (Exception $e) {
		echo "La transaction a échouée : ".$e->getMessage();
		}
	$donnees = $requete->fetch();
	$fiches = $requete2->fetchall();
	$nbfiches = count($fiches);
	$consultpatient=true;
	include($deconnexion_base);
}

?>