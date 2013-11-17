<?php

require_once "./connect-stackato.php";  // connect to CouchDB database


$newtask = new couchDocument($client);


if(isset($_POST['submit']) && (strlen($_POST['newtask']) != 0))
{	
	$newtask->set( array('task' => $_POST['newtask']) );		
}

header('Location:'.$INDEX_PAGE);
?>
