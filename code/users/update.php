<?php

require_once('./access.php');

$ac = new Access();
$con= $ac->connection();

$postdata = file_get_contents("php://input");


if (isset($postdata) && !empty($postdata)) {
	$request = json_decode($postdata);
		
//sanitize.
	$id= $_GET['id'];
	$Nom= $request->Nom;
	$Prenom=$request->Prenom;
	$num_tel=$request->num_tel;
	$adresse=$request->adresse;
	$date_naiss=$request->date_naiss;
	


	$req = $con->prepare("UPDATE user SET
	                        Nom = '$Nom' ,
	                        Prenom ='$Prenom' ,
	                        num_tel =$num_tel , 
	                        adresse ='$adresse',
	                        date_naiss ='$date_naiss'
	                        
	 where id =$id");
	$req->execute();

while($con && $req) {

http_response_code(201);
exit();



}

http_response_code(422);


}
?>

























?>