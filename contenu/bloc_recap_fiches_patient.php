<?php if ($nbfiches>0) {
				foreach ($fiches as $fiche) {
					$tabledate=explode("-",$fiche["date_fiche_micro"]);
					$madate=$tabledate[2]."-".$tabledate[1]."-".$tabledate[0];
					echo "<a class='lien_fiches' href='index.php?modfich=1&nump=".$donnees["id_patient_micro"]."&numfich=".$fiche["id_fiche_micro"]."' target='_self'><p class='champ_date_fiche label_consult'>".$madate."</p><p class='champ_consult_fiche'>".nl2br($fiche["cpt_rendu_fiche_micro"])."</p></a><br /><br />";
				}
			}
	   else echo "Aucune fiche trouvée...";
?>