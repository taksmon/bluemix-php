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

// sql to create table ITEM
$sql = "DROP TABLE ITEM";
$result = db2_exec($conn, $sql);

if ($result) {
  print "Drop Table  ITEM";
}
else {print "Fail to drop table ITEM";}

$sql = "CREATE TABLE ITEM (ID BIGINT NOT NULL, DESCRIPTION VARCHAR(255), IMGSRC VARCHAR(255), PRICE INTEGER, QUAN INTEGER, TITLE VARCHAR(255), PRIMARY KEY (ID))";

$result = db2_exec($conn, $sql);

if ($result) {
    echo "Table ITEM created successfully. ";
} else {
    echo "Error creating table! ";
}


// Populate the test table
$items = array(
    array(1, "The most reliable mobile",
     'nokia.jpeg', 4500, 6, 'Nokia Mobile'),

    array(2, "The cheapest smartphone. New, shipping with tracking number",
     'xiaomi.jpg', 3000, 10, 'Xiaomi Phone'),
	 
    array(3, "The best smartphone",
     'iphone.jpg', 5000, 5, 'Apple iPhone4'),

    array(4, "Samsung Galaxy",
     'samsung.jpg', 4000, 20, 'samsung'),

    array(5, "Acer Digital Phone",
     'acer.jpeg', 2000, 10, 'acer'),

    array(6, "htc smart phone",
     'htc.jpg', 3500, 30, 'htc')
    
);

foreach ($items as $item) {
    // single quotes MUST be doubled up for DB2
	$desc = str_replace("'","''",$item[1]);
	// print "INSERT INTO print (id, description, imgsrc, price, quan, title) VALUES ({$print[0]}, '{$desc}', '{$print[2]}', {$print[3]}, {$print[4]}, '{$print[5]}')";

    $rc = db2_exec($conn, "INSERT INTO item (id,  description, imgsrc, price, quan, title) VALUES ( {$item[0]}, '${desc}' , '{$item[2]}', {$item[3]}, {$item[4]}, '{$item[5]}'   )");
    if ($rc) {
        print "Insert succeded. ";
    }
	else {print "Insert failed! ";}
}

// sql to create table Order
$sql = "DROP TABLE ORDERS";
$result = db2_exec($conn, $sql);



$sql = "CREATE TABLE ORDERS (EMAIL VARCHAR(255) NOT NULL, 
                            FIRSTNAME VARCHAR(255) NOT NULL, 
                            LASTNAME VARCHAR(255) NOT NULL, 
                            MODEL VARCHAR(255) NOT NULL, 
                            ORDERDATE VARCHAR(255) NOT NULL, 
                            PHONE VARCHAR(255) NOT NULL,
                            STORE VARCHAR(255) NOT NULL
                            )";

$result = db2_exec($conn, $sql);

if ($result) {
    echo "Table ORDERS created successfully. ";
} else {
    echo "Error creating table ORDERS! ";
}

db2_close($conn);
?>
