<?php


$couch_dsn = "http://localhost:5984/";  									// database host:port
$couch_db = "tasks";  	// "tasks"?			// database name

require_once "./lib/couch.php";
require_once "./lib/couchClient.php";
require_once "./lib/couchDocument.php";

try {

	$client = new couchClient($couch_dsn,$couch_db);  // connect to database.

} catch (Exception $e) {
	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";
	exit(1);
}

if ( !$client->databaseExists() ) {  	// checks if database exists already.
    $client->createDatabase();			// if not, creates database.
}

?>
