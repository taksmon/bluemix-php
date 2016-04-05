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

// sql to create table
$sql = "DROP TABLE STOCK";
$result = db2_exec($conn, $sql);

$sql = "CREATE TABLE STOCK (ID BIGINT NOT NULL, DESCRIPTION VARCHAR(255), IMGSRC VARCHAR(255), PRICE INTEGER, QUAN INTEGER, TITLE VARCHAR(255), PRIMARY KEY (ID))";

$result = db2_exec($conn, $sql);

if ($result) {
    echo "Table STOCK created successfully. ";
} else {
    echo "Error creating table! ";
}


// Populate the test table
$prints = array(
    array(1, "An advanced digital camera with interchangable lenses.",
     'nokiajpg', 9000, 6, 'nokia'),

    array(2, "This external HDD is compatible with USB 3.0 for fast transfers.",
     'xiaomi.jpg', 600, 10, 'xiaomi'),
	 
    array(3, "A stylish watch that can pair with your smartphone to show notifications.",
     'iphone.jpg', 100, 0, 'iphone')

    array(4, "A stylish watch that can pair with your smartphone to show notifications.",
     'sumsung.jpg', 100, 0, 'sumsung')

    array(5, "A stylish watch that can pair with your smartphone to show notifications.",
     'acer.jpg', 100, 0, 'acer')

    array(6, "A stylish watch that can pair with your smartphone to show notifications.",
     'htc.jpg', 100, 0, 'htc')
    
);

foreach ($prints as $print) {
    // single quotes MUST be doubled up for DB2
	$desc = str_replace("'","''",$print[1]);
	// print "INSERT INTO print (id, description, imgsrc, price, quan, title) VALUES ({$print[0]}, '{$desc}', '{$print[2]}', {$print[3]}, {$print[4]}, '{$print[5]}')";

    $rc = db2_exec($conn, "INSERT INTO stock (id,  description, imgsrc, price, quan, title) VALUES ( {$print[0]}, '${desc}' , '{$print[2]}', {$print[3]}, {$print[4]}, '{$print[5]}'   )");
    if ($rc) {
        print "Insert succeded. ";
    }
	else print "Insert failed! ";
}

db2_close($conn);
?>
