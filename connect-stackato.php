<?php

$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services,true);
$couchdb_conf = $services_json["couchdb"][0]["credentials"];


$couch_dsn = "http://".$couchdb_conf["username"].":"
      .$couchdb_conf["password"]."@".$couchdb_conf["host"].":"
      .$couchdb_conf["port"];  									// database host:port
$couch_db = $couchdb_conf["name"];  	// "tasks"?			// database name

$INDEX_PAGE = "index.php";

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
