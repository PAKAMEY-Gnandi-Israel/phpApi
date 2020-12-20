<?php

require_once('./access.php');

$ac = new Access();
$con= $ac->connection();


$postdata = file_get_contents("php://input");


if(isset($postdata) && !empty($postdata))
{
	$request = json_decode($postdata);

	//sanitize.
	$libelle_art = $request->$libelle_art;
	$prix_art= $request->$prix_prod;
	$contact_vend= $request->$contact_vend;
	


	 $req = $con->prepare("INSERT INTO article(libelle_art,prix_art,contact_vend)
VALUES('$libelle_art','$prix_prod','$contact_vend')
");
 $req->execute();

while($con && $req) {

http_response_code(201);
echo json_encode('insertion réussie');
}

http_response_code(422);
echo json_encode('insertion échouée');


}


?>