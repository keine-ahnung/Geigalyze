<?php
header("Cache-Control: no-cache, must-revalidate"); 
header("Content-Type: image/png");
include("database.php");
$handle = popen ("../analyse/plot-weekly.sh", "r");
$img = new Imagick();
$img->readImageFile($handle);
pclose($handle);

include("generate-latest-mesurement-array.php");

$comment = 'Latest Data available at http://geigalyse.starletp9.de/'."\n";
$comment .= "\n";
$comment .= "Information about latest measurement:\n";

foreach($table as $key => $value) {
  $comment .= "$key: $value\n";
}


$img->commentImage($comment);
echo $img;
