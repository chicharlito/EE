<?php
$files = glob("img/*.*");
$compteur = count($files);
echo "Il y a <font color=#FF0000>$compteur</font>";
if ($compteur > 1) { echo " fichiers dans ce répertoire"; }
else { echo " fichier dans ce répertoire"; }
?>