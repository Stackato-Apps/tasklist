<?php

require_once "./connect-stackato.php";  // connect to CouchDB database


// var_dump($_POST);

if(isset($_POST['hidden_id']) && isset($_POST['edit'])){
	$task_id = $_POST['hidden_id'];
	$task = $client->getDoc($task_id);

	$text = $_POST['edit'];
	$task->task = $text;

	$client->storeDoc($task);
}

header('Location:'.$INDEX_PAGE);

?>


