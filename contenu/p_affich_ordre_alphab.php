<?php
include($connexion_base);
$requete = $bd_micro->prepare("SELECT id_patient_micro, nom_patient_micro, prenom_patient_micro, archive_patient_micro FROM ".$tab_patients_micro." WHERE nom_patient_micro LIKE CONCAT(:lettre,'%') ORDER BY nom_patient_micro");
if (isset($_GET["alphab"])) {
	$lalettre=$_GET["alphab"];
	$requete->bindValue(':lettre', $lalettre, PDO::PARAM_STR);
	$requete->execute();
	$liste_par_lettre=$requete->fetchall();
	$nbfiches=count($liste_par_lettre);
	if ($nbfiches>0) {
		$laliste=liste_elements_commence_par($lalettre,$liste_par_lettre);
		echo "<ul>".$laliste."</ul>";	
	}
	else echo "Aucun patient(s) trouvé(s)";
}
else {
	$pointeur="";
	$requete = $bd_micro->prepare("SELECT id_patient_micro, nom_patient_micro, prenom_patient_micro, archive_patient_micro FROM ".$tab_patients_micro." WHERE nom_patient_micro LIKE CONCAT(:lettre,'%') ORDER BY nom_patient_micro");
	foreach(range('A','Z') as $lalettre) {
		$requete->bindValue(':lettre', $lalettre, PDO::PARAM_STR);
		$requete->execute();
		$liste_par_lettre=$requete->fetchall();
		$nbfiches=count($liste_par_lettre);
		if ($nbfiches>0) {
			$pointeur=$pointeur.liste_elements_commence_par($lalettre,$liste_par_lettre)."<li></li>";
		}
	}
	if ($pointeur=="") echo "Aucun patient(s) trouvé(s)";
	else echo "<ul>".$pointeur."</ul>";
}
$bd_micro=null;
include($deconnexion_base);
?>
