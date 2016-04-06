<?php
include 'config.php';

$fname = $_POST ["fname"];
$lname = $_POST ["lname"];
$email = $_POST ["email"];
$phone = $_POST ["rphone"];
$store = $_POST ["rstore"];
$model = $_POST ["model"];
//$_POST is a v_array

$orderdate = date ( "Y-m-d H:i:s" );

$sql = "INSERT INTO Orders(FirstName, LastName, Email, Phone, Store, Model, OrderDate)
VALUES
('$fname','$lname','$email','$phone','$store','$model','$orderdate')";

if (! mysql_query ( $sql, $con )) {
	die ( 'Error: ' . mysql_error () );
}

echo "<script>alert('submint successful!');location.href='../reserve.html';</script>";


mysql_close ( $con );

?>
