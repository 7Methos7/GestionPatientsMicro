<?php
if ($recherche_effectuee and $nbpatients==0) { echo "<span class='alerte_info'>Aucun patient ne correspond à votre recherche...</span>";$recherche_effectuee=false;$fermer=false; }
if ($ficheajoutee) { echo "<span class='alerte_succes'>Fiche ajoutée avec succés.</span>";$ficheajoutee="";$fermer=false; } elseif (!$ficheajoutee and $ficheajoutee<>"") { echo "<span class='alerte_erreur'>Problème lors de la tentative d'ajout de la fiche patient.</span>";$fermer=false; }
if ($patientmodifie) { echo "<span class='alerte_succes'>Patient modifié avec succés.</span>";$patientmodifie="";$fermer=false; } elseif (!$patientmodifie and $patientmodifie<>"") { echo "<span class='alerte_erreur'>Problème lors de la tentative de modification du patient.</span>";$fermer=false; }
if ($patientajoute) { echo "<span class='alerte_succes'>Patient ajouté avec succés.</span>";$patientajoute="";$fermer=false; } elseif (!$patientajoute and  $patientajoute<>"") { echo "<span class='alerte_erreur'>Problème lors de la tentative d'ajout du patient.</span>";$fermer=false; }
if ($message_erreur<>"") { echo $message_erreur;$fermer=false; }
?>