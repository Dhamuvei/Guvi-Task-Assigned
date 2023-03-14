<?php

require '../vendor/autoload.php';

$con = new mysqli('localhost:3308', 'root', '', 'taskAssigned');
$mcon = new MongoDB\Client("mongodb://localhost:27017");

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM users where email=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $stmt->close();
    if ($user['pass'] == $password) {
        $db = $mcon->guvitask->users;
        $dbuser = $db->findOne(['email' => $email]);
        echo json_encode(array("status" => "Login Successfully", "email" => $user['email'], "email" => $user['email'], "dbuser" => $dbuser));
    } else {
        echo json_encode(array("error" => "Check the enterd password password"));
    }
} else {
    echo json_encode(array("error" => "Registered user cannot find"));
}

?>
