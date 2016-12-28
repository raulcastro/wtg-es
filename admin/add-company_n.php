<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
	$root = $_SERVER['DOCUMENT_ROOT']."/";
	
	require_once($root.'/Framework/locale.php');
	require_once $root.'backends/admin-backend.php';
	require_once $root.'/views/back/Layout_View_n.php';
	
	$option 	= 'videos';
	
	$data 		= $backend->loadBackend($option);
	
	$data['title'] 			= "Add Company";
	$data['section'] 		= 'add-company';
	$data['icon']			= 'fa-dashboard';
	$data['template-class'] = '';
	
	$view 		= new Layout_View($data, 'Add Company');
	
	echo $view->printHTMLPage('videos');