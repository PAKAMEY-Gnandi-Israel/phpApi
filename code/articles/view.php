<?php

require_once('./access.php');

$ac = new Access();
$con= $ac->connection();

error_reporting(E_ERROR);
/*

$users =[];

 $req = $con->prepare("SELECT * FROM user ");
 $req->execute();
 $row = $req->fetchAll();

if ($con && $req)
{
	$cr=0;
	while ($row) {
		$users[$cr]['id']= $row['id'];
		$users[$cr]['Nom']= $row['Nom'];
		$users[$cr]['Prenom']= $row['Prenom'];
		$users[$cr]['email']= $row['email'];
		$users[$cr]['num_tel']= $row['num_tel'];
		$users[$cr]['adresse']= $row['adresse'];
		$users[$cr]['date_naiss']= $row['date_naiss'];

		$cr++;
		
	}
		echo json_encode($users);


}
else{
	http_response_code(404);
}*/

if( !empty($_GET['libelle_art'])  ){

	
	$requete = $con->prepare("SELECT * FROM `article` WHERE `libelle_art`  LIKE :libelle_art ");
	$requete->bindParam(':libelle_art', $_GET['libelle_art'] );
	

} 
else {
	//Sinon on affiche tous les utilisateurs
	
	$requete = $con->prepare("SELECT * FROM `article`");
	$requete->execute();
	$resultats = $requete->fetchAll();
}


if( $resultats ){
	

	$success = true;
	$data[] = $resultats;

	
echo json_encode($data);

	
}
else{
	http_response_code(404);
}
















?>