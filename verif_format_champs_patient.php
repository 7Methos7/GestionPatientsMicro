<?php
if(isset($_POST["telephone1_patient"]) and $_POST["telephone1_patient"]<>"") {
		if (!est_un_numero_telephone($_POST["telephone1_patient"])) {$pas_erreur=false;}
	}
if(isset($_POST["telephone2_patient"]) and $_POST["telephone2_patient"]<>"") {
		if (!est_un_numero_telephone($_POST["telephone2_patient"])) {$pas_erreur=false;}
	}
if(isset($_POST["mail1_patient"]) and $_POST["mail1_patient"]<>"") {
		if (!est_une_adresse_mail($_POST["mail1_patient"])) {$pas_erreur=false;}
	}
if(isset($_POST["naissance_patient"]) and $_POST["naissance_patient"]<>"") {
		if (!est_une_date_valide($_POST["naissance_patient"])) {$pas_erreur=false;}
	}
?>