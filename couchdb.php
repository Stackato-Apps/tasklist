<html>
<head>
<title>PHP Task List</title>
	<script src="js/jquery-1.10.2.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<link href="js/bootstrap.min.css" rel="stylesheet" media="screen">    
</head>
<div class="container">
<h1>Task List</h1>
</div>
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

function delete_task($task) {
	try {

	$client->deleteDoc($task);

} catch (Exception $e) {  // if fail to get all docs, print error msg.

	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")<br/>\n";  
	exit(1);
}

}

$newtask = new couchDocument($client);


if(isset($_POST['submit']))
{	
	$newtask->set( array('task' => $_POST['newtask']) );		
}

try {

	$tasks = $client->getAllDocs(); // get all tasks (id's only)

} catch (Exception $e) {  // if fail to get all docs, print error msg.

	echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";  
	exit(1);
}

// print out database task list.
echo "<div class=\"container\">";
echo "You have ".$tasks->total_rows." tasks.<br/>\n";
echo "</div>";

echo "<div class=\"container\">";
echo "<table class=\"table table-striped table-condensed table-hover\">";

foreach ( $tasks->rows as $task ) {

	$desc = $client->getDoc($task->id);
	
	echo "<tr>";

	echo "<td style=\"width: 90%\">";
	echo $desc->task;
	echo "</td>";

	echo "<td style=\"width: 5%\">";
	echo "<input type=\"button\" class=\"btn btn-primary\" name=\"edit\" value=\"Edit\">";
	
	echo "</td>";

	echo "<td style=\"width: 5%\">";
	echo "<input type=\"button\" class=\"btn btn-danger\" name=\"delete\" value=\"Delete\">";
	echo "</td>";

	echo "</tr>";
}


echo "</table>";
echo "</div>";
?>
<div class="container">

<form role="form" action="couchdb.php" method="post">
<br/>
<h2><small>Enter Task: </small> </h2><input type="text" class="form-control" placeholder="New Task" name="newtask"><br/>
<br/>
<input type="submit" name="submit" class="btn btn-success" value="Add Task"><br/>
</form>

</div>

</body>
</html>
