<?php
$stmt = $con->prepare("SELECT * FROM videos where video_type=1");
$stmt->execute();

$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo"<div class ='row'>";

foreach ($videos as $video ) {

echo"<div class='col-md-6'>";
echo "<label>".$video['title']."</label"
echo '<iframe width="650" height="315"
src="https://www.youtube.com/embed/'.$video['video_id']....'"
}

';
















?>