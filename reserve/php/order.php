<?php

// create DB connect string
$conn_string = "DRIVER={IBM DB2 ODBC DRIVER};DATABASE=".
   $bludb_config["db"].
   ";HOSTNAME=".
   $bludb_config["host"].
   ";PORT=".
   $bludb_config["port"].
   ";PROTOCOL=TCPIP;UID=".
   $bludb_config["username"].
   ";PWD=".
   $bludb_config["password"].
   ";";
   
// connect to BLUDB
$conn = db2_connect($conn_string, '', '');

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

if (! db2_exec($con , $sql) {
	die ( 'Error: ' . db2_conn_error() );
}

echo "<script>alert('submint successful!');location.href='../reserve.html';</script>";


db2_close($con);

?>
