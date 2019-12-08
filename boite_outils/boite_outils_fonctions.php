<?php
function liste_elements_commence_par($lettre,$liste) {
	$liste_alphabetique="<li class='lettre_liste'>".$lettre."</li>";
	foreach($liste as $patient) {
		$liste_alphabetique=$liste_alphabetique."<li class='liste_patients'><a href='index.php?nump=".$patient["id_patient_micro"]."' target='_self'>".strToUpper($patient["nom_patient_micro"])." ".ucFirst($patient["prenom_patient_micro"]);
		if ($patient["archive_patient_micro"]==1) $liste_alphabetique=$liste_alphabetique." (Patient archivé)";
		$liste_alphabetique=$liste_alphabetique."</a> <a href='index.php?modpat=1&nump=".$patient["id_patient_micro"]."' target='_self'>[Modifier]</a></li>";
	}
	return $liste_alphabetique;
}

/* Vérifier format numéro de téléphone */

function est_un_numero_telephone($numero) {
	return preg_match("#^0[1-9]([ -.]?[0-9]{2}){4}$#", $numero);
}

function format_telephone_fr($numero) {
	$bonnumero="";
	if (is_numeric($numero) and strlen($numero)==10) {
		$bonnumero=substr($numero,0,2)." ".substr($numero,2,2)." ".substr($numero,4,2)." ".substr($numero,6,2)." ".substr($numero,8,2);
	}
	return $bonnumero;
}

/* Vérifier format adresse mail */

function est_une_adresse_mail($chaine) {
	return preg_match("#^[a-z0-9-._]+@[a-z0-9-._]{2,}\.[a-z]{2,4}$#", $chaine);
}

/* Vérifier format date */

function est_une_date_valide($chaine) {
	return preg_match("#^((0[1-9])|([1-2][0-9])|(3[0-1]))[-/. ]((0[1-9])|(1[0-2]))[-/. ]((19)|(20))[0-9]{2}$#", $chaine);
}

function mb_ucfirst($chaine,$encoding)
{
    return mb_strtoupper(mb_substr($chaine,0,1,$encoding),$encoding).mb_substr($chaine,1,null,$encoding);
}

function age_patient($date_naissance)
{
 	$age = date('Y') - date('Y', strtotime($date_naissance));
	if (date('md') < date('md', strtotime($date_naissance))) {
		return $age - 1;
		}
	return $age;   
}
?>