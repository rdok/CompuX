<?php
	
	// these two constants are used to create root-relative web addresses
	// amd absolute server paths throught all the code
	define("BASE_URL","/compux_local/");
	define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/compux_local/");

	// removed for safety reasons.
	
	define("DB_HOST", "");
	define("DB_NAME", "");
	define("DB_PORT", ""); // default port.
	define("DB_USER", "");
	define("DB_PASS", "");

	// mail constants
	define("CONTACT_EMAIL", "r.dokollari@acg.edu");
