<?php


require_once('./access.php');

$ac = new Access();
$con= $ac->connection();


$postdata = file_get_contents("php://input");


if(isset($postdata) && !empty($postdata))
{
	$request = json_decode($postdata);

	//sanitize.
	$Nom = $request->Nom;
	$Prenom= $request->Prenom;
	$Email= $request->Email;
	$num_tel= $request->num_tel;
	$adresse= $request->adresse;
	$date_naiss= $request->date_naiss;
	$uidFirebase= $request->uidFirebase;
	$Mdp = $request->Mdp;


	 $req = $con->prepare("INSERT INTO user(Nom,Prenom,Email, num_tel,adresse , date_naiss , uidFirebase ,mdp)
VALUES('$Nom','$Prenom','$Email','$num_tel','$adresse','$date_naiss','$uidFirebase','$Mdp')" );
 $req->execute();

while($con && $req) {

http_response_code(201);
echo json_encode('insertion réussie');

}

http_response_code(422);



}
























?>