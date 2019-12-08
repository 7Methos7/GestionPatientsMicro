<?php
echo "<p class='champ_consult_base'><span class='label_consult'>Id patient :</span><span class='donnees_consult'> ".$donnees["id_patient_micro"]."</span></p><br />";
echo "<p class='champ_consult_base'><span class='label_consult'>Patient :</span><span class='donnees_consult'> ".strToUpper($donnees["nom_patient_micro"])." ".ucFirst($donnees["prenom_patient_micro"])."</span>";
if ($donnees["naissance_patient_micro"]<>"") echo "<span class='label_consult'> né le</span><span class='donnees_consult'> ".$donnees["naissance_patient_micro"]."</span> <span class='donnees_consult'>(".age_patient($donnees["naissance_patient_micro"])." ans)</span>";
echo "</p>";
if ($donnees["adresse1_patient_micro"]<>"" or $donnees["adresse2_patient_micro"]<>"" or $donnees["cp_patient_micro"]<>"" or $donnees["localite_patient_micro"]<>"") echo "<br /><p class='champ_consult_base'><span class='label_consult'>Adresse : </span><span class='donnees_consult'>";
if ($donnees["adresse1_patient_micro"]<>"") echo $donnees["adresse1_patient_micro"];
if ($donnees["adresse2_patient_micro"]<>"") echo ", ".$donnees["adresse2_patient_micro"];
if (($donnees["adresse1_patient_micro"]<>"" or $donnees["adresse2_patient_micro"]<>"") and ($donnees["cp_patient_micro"]<>"" or $donnees["localite_patient_micro"]<>"")) { echo " -- "; }
if ($donnees["cp_patient_micro"]<>"") echo $donnees["cp_patient_micro"];
if ($donnees["localite_patient_micro"]<>"") echo " ".$donnees["localite_patient_micro"];
if ($donnees["adresse1_patient_micro"]<>"" or $donnees["adresse2_patient_micro"]<>"" or $donnees["cp_patient_micro"]<>"" or $donnees["localite_patient_micro"]<>"") echo "</span></p>";
if ($donnees["tel1_patient_micro"]<>"") echo "<br /><p class='champ_consult_base telephone'><span class='label_consult'>Tel1 :</span><span class='donnees_consult'> ".format_telephone_fr($donnees["tel1_patient_micro"])."</span></p>";
if ($donnees["tel2_patient_micro"]<>"") echo "<p class='champ_consult_base telephone'><span class='label_consult'>Tel2 :</span><span class='donnees_consult'> ".format_telephone_fr($donnees["tel2_patient_micro"])."</span></p>";
if ($donnees["adresse_mail_patient_micro"]<>"") echo "<p class='champ_consult_base'><span class='label_consult'>Adresse mail :</span><span class='donnees_consult'> ".$donnees["adresse_mail_patient_micro"]."</span></p>";
if ($donnees["infos_complementaires"]<>"") echo "<br /><p class='champ_consult_base'><span class='label_consult'>Infos complémentaires :</span><span class='donnees_consult'> ".$donnees["infos_complementaires"]."</span></p>";
?>