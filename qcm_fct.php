<!DOCTYPE HTML>

<html>

  <head>
    <meta charset="UTF-8">
    <title>ECO3</title>
    <meta content="Le projet ECO3">   
    <link rel="stylesheet" href="gestion_batiment.css" />
  </head>
  
  <body>
    <div>
	<?php
	
	function connexion_bd($srv, $login, $mdp, $bd){
        /*Connexion à la base de données*/
        $conn = mysqli_connect($srv, $login, $mdp);

		if (mysqli_connect_errno()) {
            $msg = "erreur ". mysqli_connect_error();
        } else {  
            $msg = "connecté au serveur " . mysqli_get_host_info($conn);
            /*Sélection de la base de données*/
            mysqli_select_db($conn, $bd); 
            /*Encodage UTF8 pour les échanges avec la BD*/
            mysqli_query($conn, "SET NAMES UTF8");
        }	
        return $conn;
	}
	
	function affiche_capteur_salle($conn, $salle){
		$sql = "SELECT c.nom,c.type_capteur FROM capteur c JOIN zone z WHERE c.id_zone=z.id_zone AND z.nom LIKE \"". $salle . "\""; 
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		echo "<ul>";
		while ($row = mysqli_fetch_assoc($result)) { //on extrait les capteurs 
			echo "<li>\n";
			echo "<span>". $row["nom"]." </span> : <span>" .$row["type_capteur"] . "</span>";
			echo "</li>\n";
		} 
		 echo "</ul>";
	}
 
    
	$c=connexion_bd( "tp-epua:3308", "lival", "8rxas75m", "lival");
    $liste = array("C213", "C214", "C215", "C209");
 	
 	echo "<ul>";
	foreach( $liste as $salle){
        echo "<li> ". $salle ;
        affiche_capteur_salle($c, $salle);
        echo "</li>";
    }
    echo "</ul>";
 
 ?>
 
  </div>
  </body>
</html>  
 
