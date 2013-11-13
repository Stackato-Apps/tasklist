<?php

function delete_task($task) {
	try {

	    $client->deleteDoc($task->id);

    } catch (Exception $e) {  // if fail to get all docs, print error msg.

	    echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")<br/>\n";  
	    exit(1);
    }
}

?>
