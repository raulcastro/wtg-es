<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once 'backends/general.php';
	require_once ($root . '/views/front/Layout_View.php');
	
	$section = '';
	
	if ($_GET['category']){
		$section = 'byCategory';
	}
	
	if ($_GET['subcategory'])
	{
		$section = 'bySubcategory';
	}
	
	if ($_GET['location'])
	{
		$section = 'byLocation';
	}
	
	$data 		= $backend->loadBackend($section);
// 	var_dump($data);
	$view 		= new Layout_View($data);
	
	echo $view->printHTMLPage('byCategory');