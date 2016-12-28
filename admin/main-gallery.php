<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
	$root = $_SERVER['DOCUMENT_ROOT']."/";
	
	require_once($root.'/Framework/locale.php');
	require_once $root.'backends/admin-backend.php';
	require_once $root.'/views/back/Layout_View_n.php';

	$option 	= 'main-sliders';
	
	$data 		= $backend->loadBackend($option);
	
	$data['title'] = "Main Sliders";
	$data['section'] 		= 'main-gallery';
	$data['icon']			= 'fa-dashboard';
	$data['template-class'] = '';
	
	
	$view 		= new Layout_View($data, 'Main Sliders');
	
	echo $view->printHTMLPage($option);