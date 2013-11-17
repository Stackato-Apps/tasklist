<html>
<head>
<title>PHP Task List</title>
	<script src="js/jquery-1.10.2.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<script src="js/bootbox.min.js"></script>
    	<link href="js/bootstrap.min.css" rel="stylesheet" media="screen"> 
 	<script>
		$(document).ready(function () {
			$(".btn-primary").click(function () {
				var edit_id = $(this).attr('id');
				
				var edit_task = bootbox.prompt("Please edit the task:");
				
				if (edit_task != null){
					$(this).attr('value', edit_task); 
				}
			});
		});
    	</script>   
</head>

<div class="container">
<h1>Task List</h1>
</div>

<?php

require_once "./connect-stackato.php";  // connect to CouchDB database

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
	
	echo "<tr >";

	echo "<td style=\"width: 90%\"  >";

	echo $desc->task;

	echo "</td>";

	echo "<td style=\"width: 5%\">";
	echo "<form action=\"edit.php\" method=\"post\" >";
	echo "<input type=\"hidden\" name=\"hidden_id\" value=$task->id >";
	echo "<input type=\"submit\" class=\"btn btn-primary\" name=\"edit\" id=$task->id value=\"Edit\" >";
	echo "</form>";
	
	echo "</td>";

	echo "<td style=\"width: 5%\">";
	echo "<form action=\"delete.php\" method=\"post\" >";
	echo "<input type=\"hidden\" name=\"hidden_id\" value=$task->id >";
	echo "<input type=\"submit\"  class=\"btn btn-danger\" name=\"delete\" id=$task->id value=\"Delete\" >";
	echo "</form>";
	echo "</td>";

	echo "</tr>";
}

echo "</table>";
echo "</div>";
?>

<div class="container">
<form role="form" action="add.php" method="post">
<h2><small>Enter Task: </small> </h2>
<div class="row">
<input type="text" class="form-control" placeholder="New Task" name="newtask">
</div><input type="submit" name="submit" class="btn btn-success pull-right" value="Add Task" style="margin:10px"></div>
</form>
</div>
</body>
</html>
