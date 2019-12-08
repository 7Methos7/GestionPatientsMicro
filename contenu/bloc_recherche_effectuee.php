<?php
if ($nbpatients > 0) {
	echo "<h3>Patients correspondants à votre recherche</h3>";
	$i=0;
	echo "<ul>";
		foreach($listepatients as $patient) {
			echo "<li class='liste_patients'><a href='index.php?ajfich=1&nump=".$patient["id_patient_micro"]."' target='_self'>".$patient["nom_patient_micro"]." ".$patient["prenom_patient_micro"]."</a> <a href='index.php?modpat=1&nump=".$patient["id_patient_micro"]."' target='_self'>[Modifier]</a></li>";
		}
	echo "</ul>";
	}
else echo "Aucun(s) patient(s) ne correspond(ent) à votre recherche";
?>