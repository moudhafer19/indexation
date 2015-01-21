<?php
$fichier = "mots-vides.txt";

$tableau_mots_vides  = chargerDicoMotsVides($fichier);
print_r($tableau_mots_vides);

$tableau_mots_vides  = array_flip ( $tableau_mots_vides  ) ;
print_r($tableau_mots_vides);


if( array_key_exists( "les" , $tableau_mots_vides) )
{
	echo "mot vraiment vide" ;
}
else
{
	echo "mot non vide" ;
}

function chargerDicoMotsVides($fichier)
{
	$tableau_mots_vides = file($fichier) ;
	return $tableau_mots_vides ;
}

?>