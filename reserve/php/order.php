<?php

//parse vcap
if( getenv("VCAP_SERVICES") ) {
    $json = getenv("VCAP_SERVICES");
} 
# No DB credentials
else {
    echo "No vcap services available.";
    return;
}
# Decode JSON and gather DB Info
$services_json = json_decode($json,true);
$blu = $services_json["sqldb"];
if (empty($blu)) {
    echo "No dashDB service instance is bound. Please bind a SQLDB service instance.";
    return;
}
$bludb_config = $services_json["sqldb"][0]["credentials"];

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

if (!$conn) {
    die("SQSLSTATE value: " . db2_conn_error());
}

$fname = $_POST ["fname"];
$lname = $_POST ["lname"];
$email = $_POST ["email"];
$phone = $_POST ["rphone"];
$store = $_POST ["rstore"];
$model = $_POST ["model"];
//$_POST is a v_array

//$orderdate = "8-4-2016";
$orderdate = date ( "Y-m-d H:i:s", time() );

//echo "Firstname is " . gettype($fname) . "  <br />";
//echo "Lastname is " . gettype($lname) . "  <br />";
//echo "Email is " . gettype($email) . "  <br />";
//echo "phone is " . gettype($phone) . "  <br />";
//echo "store is " . gettype($store) . "  <br />";
//echo "model is " . gettype($model) . "  <br />";
//echo "orderdate is " . gettype($orderdate) . "  <br />";


$sql = "INSERT INTO Orders(FirstName, LastName, Email, Phone, Store, Model, OrderDate)
        VALUES('$fname','$lname','$email','$phone','$store','$model','$orderdate')";
// ($fname,$lname,$email,$phone,$store,$model,$orderdate)";

$stmt = db2_prepare($conn, $sql);

$rc= db2_exec($conn , $sql);

if ($rc) {
        print "Insert suceeded. ";
        echo "<script>alert('Order placed successfully!');location.href='/';</script>";
    }
	else {
		print "Insert failed! ";
    echo 'Execution Error: ' . db2_stmt_error($stmt) . '<br />' ;
		echo 'Execution Error: ' . db2_stmt_errormsg($stmt) . '<br />' ;
	}





db2_close($conn);

?>
