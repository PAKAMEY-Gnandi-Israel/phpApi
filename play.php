<?php
session_start();

$key="";
$base_url="";
$channelId="";
$maxResult=;
$video_type= !isset($_GET['vtype'])? 1:2;


$videos=json_decode(file_get_contents($API_URL));

if ($video_type ==1) {
	$API_URL=$base_url."search?.. ";

	getVideos($API_URL);
}
else {
	
		$API_URL=$base_url."playlists?.. ";

	getPlaylists($API_URL);
}

function getPlaylists($API_URL){

foreach ($playlists->items as $video) {
	$video->id->videoId
	$video->snippet->title
	 $req = $con->prepare("INSERT INTO youtube('id','video_type','video_id','title','thumbnail_url','published_at')
VALUES(NULL,2,:vid,:title,:turl,:pdate, CURRENT_TIMESTAMP)
");

  $req->bindParam(":vid",$video->id );
   $req->bindParam(":title",$video->snippet->title);
    $req->bindParam(":turl",$video->snippet->thumbnails->high->url);
     $req->bindParam(":pdate",$video->snippet->published);
      $req->execute();
}

}

function getVideos($API_URL){
	$videos=json_decode(file_get_contents($API_URL));

foreach ($videos->items as $video) {
	$video->id->videoId
	$video->snippet->title
	 $req = $con->prepare("INSERT INTO youtube('id','video_type','video_id','title','thumbnail_url','published_at')
VALUES(NULL,1,:vid,:title,:turl,:pdate, CURRENT_TIMESTAMP)
");
 $req->bindParam(":vtype",1);
  $req->bindParam(":vid",$video->id->videoId);
   $req->bindParam(":title",$video->snippet->title);
    $req->bindParam(":turl",$video->snippet->thumbnails->high->url);
     $req->bindParam(":pdate",$video->snippet->published);
      $req->execute();
}

function random_1($car) {
    $string = "";
    $chaine = "AZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) {
    $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
   
    }

$API_KEY ='8650f78c-dbef-47a1-aeb6-7e5013373c3c';
//il faut passer les valeurs définis en paramètre
function checkout( $AMOUNT , $DESCRIPTION , $PHONE_NUMBER){
	$payementUid= random_1(5);
	$token =$API_KEY;
	$amount =$AMOUNT;
	$phone_number =$PHONE_NUMBER;
	$note =$DESCRIPTION;
	$dateop =date("Y-m-d H:i:s");
	$methode_paiement ='PAYGATE';
	$devise ='CFA';
	$call_back_url ='https://projet-armand.web.app/';

 return redirect('https://paygateglobal.com/v1/page?token='.$token.'&amount='.$amount.'&description=Paiement&identifier='.$payementUid.'&phone='. $phone_number.'&url='.$call_back_url);

$_SESSION['amount'] = $amount;
$_SESSION['methode'] = $methode_paiement;
$_SESSION['uid'] = $payementUid;
$_SESSION['date'] = $dateop;
$_SESSION['numero'] = $phone_number;
$_SESSION['devise'] = $devise;

}



}

























?>