<?php
// connect to the DB
require_once("db.php");

if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
} else {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br />";
  $filecontent = file($_FILES["file"]["tmp_name"]);
  echo "Header:" . array_shift($filecontent) . "<br />";
  foreach($filecontent as $line => $content) {
	print_r($line . ":" . $content . "<br />");
  }
}
/*
while(! feof($file))
  {
  print_r(fgetcsv($file));
  }
  */
  ?>

