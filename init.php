<?php

 	$start_time = microtime();
	define("HOST_DIR", $_SERVER["DOCUMENT_ROOT"]);
	define("ROOT_DIR", HOST_DIR);
	define("LIB_DIR", HOST_DIR . "/lib");
	define("LOG_DIR", HOST_DIR . "/.log");
	define("DEBUG_LEVEL", 1);

	// php 환경설정
	ini_set("include_path" , LIB_DIR); // path 설정

	// 에러리포트 설정
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
	ini_set("display_errors", DEBUG_LEVEL);

	// 공통 인클루드
	require "lib.common.php";
	require "./.Secret/secret.php";
?>