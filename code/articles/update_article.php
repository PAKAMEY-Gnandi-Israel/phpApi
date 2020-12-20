<?php

require_once('./access.php');

$ac = new Access();
$con= $ac->connection();

$postdata = file_get_contents("php://input");


if (isset($postdata) && !empty($postdata)) {
	$request = json_decode($postdata);

	$id= mysql_real_escape_string($con, (int)$_GET['id']);
	$libelle_art= mysql_real_escape_string($con, trim($request->libelle_art));
	$Prix_art=mysql_real_escape_string($con, trim($request->Prix_art));
	$contact_vend=mysql_real_escape_string($con, trim($request->contact_vend));

	$req = $con->prepare("UPDATE article SET libelle_art =$libelle_art
	                        Prix_art =$Prix_art
	                        contact_vend =$contact_vend
	                    
	 where id =$id");
	$req->execute();


while($con && $req) {

http_response_code(201);
return reponse_json(' modification  réussie');

}

http_response_code(422);
 reponse_json(' modification échouée');


}
?>
























?>