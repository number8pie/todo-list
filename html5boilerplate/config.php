<?php

	// these two constants are used to create root-relative web addresses
	// and absolute server paths throughout our code

	define("BASE_URL", "/");
	define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/");

	define("DB_HOST", "localhost");
	define("DB_NAME", "todo_list");
	define("DB_USER", "lee");
	define("DB_PASS", "lee1");