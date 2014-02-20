<?php
	/*	PDO function:
	*	@param mysql:host=localhost;dbname=compux_db identifies database
	*	1st part of string: type of database
	*	2nd depending on type of db, on this case host=...
	*	3rd name of database
	*	4th if sql uses default port, this is not need. else you need to specify it like:
	*	';port=8889'
	*	@param admn_db the user name
	*	@param QQ09AgIEAjIDA6yOkuYN the password of the 'admn_db'
	*/

	try { // connects to database
		$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // CHANGE THE ERROR MODE, THROW AN EXCEPTION WHEN AN ERROR IS FOUND
		$db->exec("SET NAMES 'utf8'");
	} catch (Exception $e) { // program ends if exception is found
		echo "Could not connect to the database: <br>" . $e;
		exit;
	}
?>