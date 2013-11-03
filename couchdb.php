<html>
<head>
<title>PHP Task List</title>
	<script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="js/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="js/bootbox.min.js"></script>
</head>

<h1>Task List</h1>

<?php
$couch_dsn = "http://localhost:5984/";  // database host:port
$couch_db = "tasks";  					// database name

require_once "./lib/couch.php";
require_once "./lib/couchClient.php";
require_once "./lib/couchDocument.php";

$client = new couchClient($couch_dsn,$couch_db);

if ( !$client->databaseExists() ) {  	// checks if database exists already.
    $client->createDatabase();			// if not, creates database.
}

/*
try {
$dbs = $client->listDatabases();  // obtain database list (experimental)

} catch (Exception $e) {
	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";
	exit(1);
}
print_r($dbs); // display database
*/

try {

	$tasks = $client->getAllDocs(); // get all tasks (the tasklist)

} catch (Exception $e) {

	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";
	exit(1);
}

// print out database task list.

echo "Database has ".$tasks->total_rows." documents.<BR>\n";
foreach ( $tasks->rows as $row ) {
    echo "Document ".$row->id."<BR>\n";
}

?>

</body>
</html>