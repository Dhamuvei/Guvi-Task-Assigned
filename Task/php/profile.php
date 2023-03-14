<?php

require '../vendor/autoload.php';

$mcon = new MongoDB\Client("mongodb://localhost:27017");

$username = $_POST["username"];
$phonenumber = $_POST["phonenumber"];


$db = $mcon->taskAssigned->users;

$db->updateOne(['username'=>$username],['$set'=>['phonenumber'=>$phonenumber]]);
echo "User Update Successfully"
?>