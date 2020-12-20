<?php

require_once('./access.php');

$ac = new Access();
$con= $ac->connection();



$id = $_GET['id'];

  $req = $con->prepare("DELETE FROM user WHERE id= $id LIMIT 1");
 $req->execute();

 while ($con && $req) {
 	http_response_code(204);
 echo json_encode('suppression réussie');
 }
 
 	 http_response_code(422);
 	
 }
?>                           