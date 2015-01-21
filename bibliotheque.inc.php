<?php


//Fonction découpage chaine de caratères 
function tokenisation ($separateurs, $texte)
{
	$arrayElements = array();
	
	$tok = strtok($texte, $separateurs);

	while ($tok !== false) 
	{
		if( strlen($tok) > 2 )$arrayElements[] = $tok;
		$tok = strtok($separateurs);
	}
	return $arrayElements;
}

//Afficher un tableau
function print_tab($tab_mots)
{
	foreach ( $tab_mots  as  $position => $valeur )
	{
		echo $position , " => " , $valeur,  "<br>" ;
	}
}

//Récupération du title
function  get_title($html)
{
	$modele = '/<title>(.*)<\/title>/i' ;

	preg_match($modele, $html, $tab_resultat) ;

    return $tab_resultat[1];
}

//Recupération du meta description
function  get_description($file_html)
{
	
	$tab_metas = get_meta_tags($file_html);
	if( isset($tab_metas['description']) ) return $tab_metas['description'];
	else return "";
}

//Recupération du meta keywords
function  get_keywords($file_html)
{
	
	$tab_metas = get_meta_tags($file_html);
	if( isset( $tab_metas['keywords'] ) ) return $tab_metas['keywords'];
	else return "";
}

//Récupération du title
function  get_body($html)
{
	$modele = '/<body>(.*)<\/body>/is' ;

	preg_match($modele, $html, $tab_resultat) ;

    return $tab_resultat[0];
}

//passer des occurrences aux poids des mots
function  occurrences2poids($tab_mots_occurrences, $coefficient)
{

	$tab_mots_poids = array();
	foreach ($tab_mots_occurrences as $mot=>$valeur)
	{
		$tab_mots_poids[$mot] = $valeur * $coefficient ;	
	}
	//retourne les mots et les poids
	return $tab_mots_poids;
}

//fusionner les résultats des traitements head et body)
function fusionner_head_body($tab_head, $tab_body)
{

	if( count($tab_head) > count($tab_body) )
	{
		//head plus grand que body
		$tab_grand = $tab_head;
		$tab_petit = $tab_body ;
	}
	else
	{
		//body plus grand que head
		$tab_petit = $tab_head ;
		$tab_grand = $tab_body;
	}
	
	foreach ( $tab_petit  as $mot=>$valeur )
	{
			if( array_key_exists( $mot, $tab_grand) )
			{
				//si le mot est dans le 2ème
				//additionne les valeurs
				$tab_grand[$mot] += $valeur ;
			}
			else
			{
				//rajouter l'élément au 2ème tableau
				$tab_grand[$mot] = $valeur;
			}
	}
	return $tab_grand ;
}

//Conversion des caractères HTML
//de la chaine $html en ascii
function caractHTML2ASCII($html)
{
	$texteAscii="";
	//Conversion des caractères HTML
	//de la chaine $html en ascii
	
	
	//retourner le texte après la conversions 
	//des caractères HTML 2 ASCII
	return  $texteAscii;
}

//Supprimer les scripts (javascript) 
//dans le html
function strip_javascript($chaine_html)
{
	$modele_balises_scripts = '/<script[^>]*?>.*?<\/script>/is';
	
	$html_sans_script = preg_replace($modele_balises_scripts, '', $chaine_html) ;
	return $html_sans_script;
}

// Afficher un résumé des résultats de 
// l'indexation d'un document
function print_resume($source, $titre, $description, $nbr_mots, $nbr_mots_final)
{
	 echo "<table width='500' align='center' border='1'>";
	 echo "<tr><td>Document</td><td>",$source, "</td></tr>" ;
	 echo "<tr><td>Titre</td><td>",$titre, "</td></tr>" ;
	 echo "<tr><td>Desccription</td><td>",$description, "</td></tr>" ;
	 echo "</table>";
}

?>