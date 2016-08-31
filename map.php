<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);

	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once 'backends/public.php';
	require_once ($root . '/views/front/Layout_View.php');
	$data 		= $backend->loadBackend('map');
	
	$view 		= new Layout_View($data);
	
	echo $view->printHTMLPage('map');