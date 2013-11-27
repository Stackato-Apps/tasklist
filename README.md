tasks
=====


PHP Task List with CouchDB
--------------------------

JavaScript Libraries in \js:

	*	JQuery 1.10
	*	BootStrap.js

PHP-on-CouchDB libraries in \lib

For basic localhost testing:

	* 	$couch_dsn = "http://localhost:5984/";  // database host:port
	* 	$couch_db = "tasks";  			// database name
		The database will be created if it does not exist.

For use in Stackato:  

	*	Use "connect-stackato.php" for stackato connection
	*	Use "connect.php" for localhost
