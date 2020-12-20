<?php


require_once('./access.php');

$ac = new Access();
$con= $ac->connection();

$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{

//$id = $_GET['id'];

echo  $req = $con->prepare("DELETE FROM article WHERE id_art ='".$postdata->id."' LIMIT 1");
 $req->execute();


 while ($con && $req) {
 	http_response_code(204);
 	return reponse_json(' article supprimé');
 }
 
 	 http_response_code(422);
 	reponse_json(' article non  supprimé');
 }
?>