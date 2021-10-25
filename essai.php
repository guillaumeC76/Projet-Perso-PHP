<?php
	session_start();
	include('inc/function.php');
	include('inc/header.php');
	include('inc/pdo.php');
	$requete="SELECT
		users.nom as 'nom',
		users.prenom as 'prenom' ,
		users.id_client as 'client',
		SUM(panier.prix)as 'sum',
		panier.id_client 
	FROM
			`users`
	INNER JOIN 	
			panier ON users.id_client= panier.id_client
	GROUP BY panier.id_client
	ORDER BY sum DESC ";		
	$result = $pdo -> query($requete);
	$result = $result -> fetchAll(PDO::FETCH_ASSOC);
	echo "<h3 align=\"center\">Statistique du site</h3>";
	
	echo "<h4 align=\"center\">Vente par client</h4>";
	
	echo"<table align=\"center\" width=\"500\" class=\"list\">";
	echo "<th>nom</th><th>prenom</th><th>client_id</th><th>total achat</th>";
	foreach($result as $key => $row){
	echo"<tr class=\"list\">";
	echo"<td class=\"list\">".$row['nom']."</td>";
	echo"<td class=\"list\">".$row['prenom']."</td>";
	echo"<td class=\"list\">".$row['client']."</td>";
	echo"<td class=\"list\">".$row['sum']."</td>";
	echo"</tr>";
	}
	echo "</table>";
	echo "<br>";
	$best= $result[0];
	$best_nom= $best['nom'];
	$best_prenom= $best['prenom'];
	$best_sum= $best['sum'];
	echo "Notre meilleur client est $best_nom  $best_prenom qui a acheté pour $best_sum euros chez nous";
	
	echo "<br>";
	echo "<h4 align=\"center\">Homme/Femme chez nos clients</h4>";
	$requete2="
	SELECT
    COUNT(id_client) as 'client2',
 	genre as 'genre'
FROM
    `users`
GROUP BY
    genre";
	$result2 = $pdo -> query($requete2);
	$result2 = $result2 -> fetchAll(PDO::FETCH_ASSOC);
	
	echo"<table align=\"center\" width=\"500\" class=\"list\">";
	echo "<th>nombre</th><th>Homme/Femme</th>";
	foreach($result2 as $key2 => $row){
	echo"<tr class=\"list\">";
	echo"<td class=\"list\">".$row['client2']."</td>";
	echo"<td class=\"list\">".$row['genre']."</td>";
	echo"</tr>";
	}
	echo "</table>";
	
	echo"<br>";
	$femme= $result2[0];
	$homme= $result2[1];
	$pourcent= 100* $femme['client2']/($femme['client2']+$homme['client2']);
	$pourcent2= 100* $homme['client2']/($femme['client2']+$homme['client2']);
	echo "Il y a $pourcent% de femme chez nos clients et $pourcent2% d'homme.";
?>


<?php include('inc/footer.php'); ?>