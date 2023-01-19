<?php 
session_start();
include('../config/config.php');


$date=$_POST['sel_date'];
$hour=$_POST['sel_hour'];


echo $date;
echo '</br>';
echo $hour;
//exit();

if (isset($date) && isset($hour) && $date!="" && $hour!="") {
    $date="'".$date."'";
    $hour="'".$hour."'";

    $stmt = $conn->prepare("SELECT * FROM rdv WHERE rdv_date=$date AND rdv_hour=$hour");

	$stmt->execute();
	$hourList = $stmt->fetchAll();
	if($stmt->rowCount() == 0) {   

try {
    
$sql=$conn->prepare ("
INSERT INTO rdv (`name`,`rdv_date`,`rdv_hour`) 
VALUES ( ?, ?,?)
");
$sql->bindParam(1, $_POST['username']);
$sql->bindParam(2, $_POST['sel_date']);
$sql->bindParam(3,  $_POST['sel_hour']);
$sql->execute();

$_SESSION['message'] = 'The appointment is saved !';

	header('Location: ../index.php');
} catch (Exception $e) {
    echo $e->getMessage();
}

} else {
    $_SESSION['message'] = 'that time is not available select another date !';
    header('Location: ../index.php');
}

} else {
$_SESSION['message'] = 'you should select date and hour !';
header('Location: ../index.php');
}