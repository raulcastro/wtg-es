<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);
$root = $_SERVER['DOCUMENT_ROOT']."/";

require_once($root.'/Framework/locale.php');
require_once $root.'backends/admin-backend.php';
require_once $root.'/views/back/Layout_View_n.php';
	
	$infoRequest = '';
	$categoryId = '';
	$locationId = '';
	
// 	var_dump($_GET);
	
	if (isset($_GET['infoRequest']))
	{
		$infoRequest = $_GET['infoRequest'];
	}
	
	if (isset($_GET['categoryId']))
	{
		$categoryId = $_GET['categoryId'];
	}
	
	if (isset($_GET['locationId']))
	{
		$locationId = $_GET['locationId'];
	}

	switch ($infoRequest)
	{
		case 'category':
			$section = 'byCategory';
		break;
		
		case 'promoted':
			$section = 'promoted';
		break;
		
		case 'unpublished':
			$section = 'unpublished';
		break;
		
		case 'location':
			$section = 'location';
		break;
	}
	
	$data 		= $backend->loadBackend($section);
	
	switch ($infoRequest)
	{
		case 'category':
			$data['title'] 			= $data['categoryInfo']['name'];
			break;
	
		case 'promoted':
			$data['title'] 			= "Promoted";
			break;
			
		case 'unpublished':
			$data['title'] 			= "Unpublished";
		break;
		
		case 'location':
			$data['title'] 			= "Location";
		break;
	}
	
	
	$data['template-class'] = '';
	$data['icon']			= 'fa-dashboard';
	$data['section']		= 'dashboard';
	
	$view 		= new Layout_View($data);
	

	echo $view->printHTMLPage('companies');