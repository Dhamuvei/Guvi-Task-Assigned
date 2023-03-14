<?php

require '../vendor/autoload.php';

$con = new mysqli('localhost:3308', 'root', '', 'guvi_task');
$mcon = new MongoDB\Client("mongodb://localhost:27017");

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$phonenumber = $_POST["phonenumber"];

$sql = "SELECT * FROM users WHERE username=?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    echo "User Already Exists";
} else {
    $sql = "INSERT into users (username,pass,email) VALUES (?,?,?)";
    $stmti = $con->prepare($sql);
    $stmti->bind_param('sss', $username, $password, $email);
    $stmti->execute();
    $stmti->close();

    $db = $mcon->guvitask->users;
    $db->insertOne(['username' => $username, 'phonenumber' => $phonenumber]);
    echo "Registration Successfully";
}

?>