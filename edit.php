<?php

function update_task($task, $edit) {
	try {
        
        $doc = $client.getDoc($task->id);
        $doc->task = $edit;
        
    } catch (Exception $e) {  // if fail to get all docs, print error msg.

	    echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")<br/>\n";  
	    exit(1);
    }
}

?>


