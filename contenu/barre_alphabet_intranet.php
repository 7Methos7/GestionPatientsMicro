<div id="barre_alphabet"><ul><li><a href="index.php" target="_self">Tous</a></li><?php
foreach(range('A','Z') as $i) {
	echo "<li><a href='index.php?alphab=$i' target='_self'>$i</a></li>";
}
?></ul></div>