<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once 'backends/public.php';
	require_once ($root . '/views/front/Layout_View.php');
	
	$data 		= $backend->loadBackend('videos');
// 	var_dump($data);
	$view 		= new Layout_View($data);
	
	echo $view->printHTMLPage('videos');