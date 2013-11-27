tasks
=====


PHP Task List with CouchDB
--------------------------

The purpose of this project is demonstrate CRUD functionality in the Stackato CouchDB Service written by our project team.  This is a simple to-do list that allows you to add a short one-line task, view a list of tasks, edit tasks, and delete tasks.  


JavaScript Libraries in \js:

	*	JQuery 1.10
	*	BootStrap.js

PHP-on-CouchDB libraries in \lib

For localhost testing:

	* 	$couch_dsn = "http://localhost:5984/";  // database host:port
	* 	$couch_db = "tasks";  			// database name
							// The database will be created if it does not exist.

For use in Stackato:  

	*	Use "connect-stackato.php" for stackato connection
	*	Use "connect.php" for localhost
