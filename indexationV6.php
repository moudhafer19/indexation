<?PHP
//Bibliotheque des fonctions
include ('bibliotheque.inc.php');

//$source = "test.html";

//indexation($source);

//Processus de traitement et d'indexation
//d'une source html
function indexation($source)
{
	//----------------1 : traitement du head------------//
	//Récupération le descriptif
	$description = get_description($source);

	//Récupération les mots-clés
	$keywords = get_keywords($source);

	//Récupération du title
	$html = file_get_contents($source) ;
	$title = get_title( $html ) ;

	$texte_head_description_keywords_title = $title . " " . $description . " " . $keywords;

	//Mise en min
	$texte_head_description_keywords_title = strtolower($texte_head_description_keywords_title);

	//Conversion de caratères HTML en ASCII
	//$texte_head_description_keywords_title = caractHTML2ASCII($texte_head_description_keywords_title);
	
	//Faire une indexation du head du HTML =  description + keywords + titre 
	// à faire 
	//Découpage par liste de séparateurs
	$tab_mots  = tokenisation (" ,«;.»’'\"()", $texte_head_description_keywords_title ) ;

	//Affiche de la trace du découpage
	//print_tab($tab_mots);

	//Calculer le nombre d'occurrences de chaque mois
	$tab_mots_occurrences_head = array_count_values($tab_mots);

	//Affiche de la trace du découpage
	//print_tab($tab_mots_occurrences);

	//passer des occurrences aux poids
	$coefficient = 2 ;
	$tab_mots_poids_head = occurrences2poids($tab_mots_occurrences_head, $coefficient);

	//----------------2 : traitement du body------------//
	//Récupération du body
	$html = file_get_contents($source) ;
	$body_html = get_body( $html ) ;

	//Suppression du javascript avant le débalisage HTML
	$body_html = strip_javascript($body_html);
	
	//Suppression des balises HTML du body
	$body_texte = strip_tags ($body_html);

	//Mise en min
	$body_texte = strtolower($body_texte);
	
	//Conversion de caratères HTML en ASCII
	//$body_texte = caractHTML2ASCII($body_texte);
	
	//Faire une indexation du head du HTML =  description + keywords + titre 
	// à faire 
	//Découpage par liste de séparateurs
	$tab_mots  = tokenisation (" ,«;.»’'\"()!?", $body_texte ) ;

	//Affiche de la trace du découpage
	//print_tab($tab_mots);

	//Calculer le nombre d'occurrences de chaque mois
	$tab_mots_occurrences_body = array_count_values($tab_mots);
	//Coefficient = 1  alors pas de calcul
	$tab_mots_poids_body = $tab_mots_occurrences_body;

	//Affiche de la trace du découpage
	//print_tab($tab_mots_occurrences);


	//----------------3 : fusion head et body------------//
	//Fusionner le tableau head avec body, obtenir
	//Un seul tableau mots=>poids pour le document
	$tab_mots_poids = fusionner_head_body($tab_mots_poids_head, $tab_mots_poids_body);

	//Affiche de la trace du découpage
	//print_tab($tab_mots_poids);
	
	//------------4 : Mise des résultats en bdd----------//
	//connexion à mysql
	$connect= mysqli_connect('localhost', 'root' , '', 'bddmi4');
	mysqli_select_db($connect, 'bddmi4');
	
	//1 : Insertion des éléments du document
	$sql1 =  "INSERT INTO document VALUES (
				'',
				'$source',
				'$titre',
				'$description')
			";
	mysqli_query($connect, $sql1);
	
	//Récupération de l'id du document
	$id_document = mysqli_insert_id($connect);
	
	//2 : Insertion des éléments mots
	foreach($tab_mots_poids as $mot => $poids)
	{
		$sql2 =  "INSERT INTO mot VALUES (
				'',
				'$mot')
			";
		mysqli_query($connect, $sql2);
		
		//Récupération de l'id du mot
		$id_mot = mysqli_insert_id($connect);
		
		 //3: Mettre en relation document <--> mot <--> poids
		$sql3 =  "INSERT INTO document_mot VALUES (
				$id_document,
				$id_mot,
				$poids)
			";
		mysqli_query($connect, $sql3);

	}
	//Fermeture de SQL
	mysqli_close($connect);	
}
	//Affichage résumé du processus d'indexation du document en cours
	//print_resume($source, $title, $description, $nbr_mots_total, $nbr_final_mots);
?>
	
