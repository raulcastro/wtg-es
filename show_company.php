<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once 'backends/public.php';
	require_once ($root . '/views/front/Layout_View.php');
	
	$data 		= $backend->loadBackend('byCompany');
// 	var_dump($data['company']['social']);
	$view 		= new Layout_View($data);
	
	echo $view->printHTMLPage('byCompany');