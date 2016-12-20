<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once 'backends/public.php';
	require_once ($root . '/views/front/Layout_View.php');
	
	$section = '';
	
	if (isset($_GET['category']))
	{
		$section = 'byCategory';
	}
	
	if (isset($_GET['subcategory']))
	{
		$section = 'bySubcategory';
	}
	
	if (isset($_GET['location']))
	{
		$section = 'byLocation';
	}
	
	$data 		= $backend->loadBackend($section);
	$view 		= new Layout_View($data);
	
	echo $view->printHTMLPage('byCategory');