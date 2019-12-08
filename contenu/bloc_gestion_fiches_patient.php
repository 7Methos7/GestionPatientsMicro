<form method="post" action=<?php if ($demandemodiffiche) echo "index.php?nump=".$donnees["id_patient_micro"]."&vmod=1"; else echo "index.php?nump=".$donnees["id_patient_micro"]; ?>>
	<fieldset id="data_patient">
		<?php if ($demandemodiffiche) { ?>
		<input type="hidden" value="<?php echo $donnees_fiche['id_fiche_micro']; ?>" name="id_fiche" id="id_fiche" />
		<?php 	$ladate=substr($donnees_fiche['date_fiche_micro'], 8,2)."-".substr($donnees_fiche['date_fiche_micro'], 5,2)."-".substr($donnees_fiche['date_fiche_micro'], 0,4);
		   } ?>
		<label class="label_fiche" for="date_fiche">Date consultation :</label> <input type="text" value="<?php if ($demandemodiffiche) echo $ladate; else echo date("d-m-Y"); ?>" name="date_fiche" id="date_fiche" /><br /><br />
		<label class="label_fiche" for="cpt_rendu_fiche">Compte rendu consultation :</label> <textarea name="cpt_rendu_fiche" id="cpt_rendu_fiche"><?php if ($demandemodiffiche) echo $donnees_fiche["cpt_rendu_fiche_micro"]; ?></textarea><br /><br />
		<input type="submit" class="bouton_bd" value="Valider" name="ValiderF" id="creer_fiche"/> <input type="button" class="bouton_bd" value="Annuler" name="AnnulerF" id="annuler_fiche" onClick="document.location.href='index.php?nump=<?php echo $donnees["id_patient_micro"]; ?>';"/>
	</fieldset>
</form>