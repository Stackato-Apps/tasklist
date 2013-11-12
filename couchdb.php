<html>
<head>
<title>PHP Task List</title>
	<script src="js/jquery-1.10.2.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<link href="js/bootstrap.min.css" rel="stylesheet" media="screen">    
</head>

<h1>Task List</h1>

<?php

$couch_dsn = "http://localhost:5984/";  // database host:port
$couch_db = "tasks";  			// database name

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

/*
try {
$dbs = $client->listDatabases();  // obtain database list (experimental)

} catch (Exception $e) {
	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";
	exit(1);
}
print_r($dbs); // display database
*/

$newtask = new couchDocument($client);

if(isset($_POST['submit']))
{	
	$newtask->set( array('task' => $_POST['newtask']) );		
}

try {

	$tasks = $client->getAllDocs(); // get all tasks (the tasklist)

} catch (Exception $e) {  // if fail to get all docs, print error msg.

	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";  
	exit(1);
}

// print out database task list.

echo "Database ".$couch_db." has ".$tasks->total_rows." documents.<BR>\n";

echo "<table>";

foreach ( $tasks->rows as $task ) {

	$desc = $client->getDoc($task->id);
	
	echo "<tr>";

	echo "<td>";
	echo $desc->task;
	echo "</td>";

	echo "<td>";
	echo "<input type=\"button\" name=\"edit\" value=\"Edit\">";
	echo "</td>";

	echo "<td>";
	echo "<input type=\"button\" name=\"delete\" value=\"Delete\">";
	echo "</td>";

	echo "</tr>";
}


echo "</table>";

?>
<form action="couchdb.php" method="post">
<br/>
Enter Task: <input type="text" name="newtask"><br/>
<br/>
<input type="submit" name="submit" value="Add Task"><br/>



</form>
</body>
</html>
