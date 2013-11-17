<?php

require_once "./connect-stackato.php";

if(isset($_POST['hidden_id']) && isset($_POST['edit'])){
	$task_id = $_POST['hidden_id'];
	$task = $client->getDoc($task_id);

	$text = $_POST['edit'];
	$task->task = $text;

	$client->storeDoc($task);
}

header('Location:couchdb.php');

?>


