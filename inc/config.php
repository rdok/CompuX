<?php
	
	// these two constants are used to create root-relative web addresses
	// amd absolute server paths throught all the code
	define("BASE_URL","/compux_local/");
	define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/compux_local/");

	define("DB_HOST", "compux-db.rizartdokollari.com");
	define("DB_NAME", "compux_db");
	define("DB_PORT", "3306"); // default port.
	define("DB_USER", "rizdok");
	define("DB_PASS", "dzhxIIsnVd8dsHymbH6h");

	// mail constants
	define("CONTACT_EMAIL", "r.dokollari@acg.edu");
