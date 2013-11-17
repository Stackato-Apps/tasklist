<?php

require_once "./connect-stackato.php";

if(isset($_POST['hidden_id'])){
	$task_id = $_POST['hidden_id'];
	$task = $client->getDoc($task_id);
	$client->deleteDoc($task);
}

header('Location:'.$INDEX_PAGE);

?>
