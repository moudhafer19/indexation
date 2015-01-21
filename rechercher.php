<form action="" method="post">
<input type='text'  name='query' size='50'> 
<input type='submit'  value='chercher'> 
</form>

<?php

if( isset($_POST['query']) )
{
	$mot = $_POST['query'] ;

	$connect= mysqli_connect('localhost', 'root', '', 'bddmi4');
	mysqli_select_db($connect, 'bddmi4');

	$sql = "SELECT * FROM indexation WHERE mot='$mot' ORDER BY poids DESC" ;

	$resultats = mysqli_query($connect, $sql);

	$nombre = mysqli_num_rows ( $resultats) ;
	
	echo "<p>Environ $nombre résultats</p>" ;
	
	$i=1;
	
	while ( $ligne  = mysqli_fetch_row( $resultats) )
	{
		$mot = $ligne[0];
		$poids = $ligne[1];
		$source = $ligne[2];
		
		echo "<p>$i. <a href=\"$source\">$source<a> : $poids</p>" ;
		$i++;
	}
}
else // pas de recherche alors nuages mots-clés
{
	include 'tags.php';
}

?>