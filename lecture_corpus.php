<P>
<B>DEMARRAGE DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>
<?php

include 'indexationV6.php';

//Augmentation du temps
//d'exécution de ce script
set_time_limit (500);
$path= "ccm";

explorerDir($path);

function explorerDir($path)
{
	$folder = opendir($path);
	while($entree = readdir($folder))
	{
		//On ignore les entrées . ..
		if($entree != "." && $entree != "..")
		{
			// On vérifie si il s'agit d'un répertoire
			if(is_dir($path."/".$entree))
			{
				$sav_path = $path;
				// Construction du path jusqu'au nouveau répertoire
				$path .= "/".$entree;
				//echo "DOSSIER = ", $path, "<BR>";
				// On parcours le nouveau répertoire
				explorerDir($path);
				$path = $sav_path;
			}
			else // C'est un fichier
			{
				//C'est un fichier html ou pas
				$path_source = $path."/".$entree;
				if( preg_match("/.htm/i", $path_source) )
				{
					echo "fichier indexé : $path_source ", "<br>";
					//appel au module d'indexation
					indexation($path_source);
					//echo "--FIN indexation : $path_source ", "<br>";
				}
			}
		}
	}
	closedir($folder);
}
?>
<P>
<B>ARRÊT DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>