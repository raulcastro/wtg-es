<?php



//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// 	var_dump($_POST);

	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once($root.'/Framework/locale.php');
	require_once $root.'/backends/general.php';

	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
	
	require_once($root.'/Framework/Mysqli_Tool.php');
	require_once($root.'/Framework/sessionControl.php');
	require_once($root.'/Framework/Connection_Data.php');
	
	$db =  new Mysqli_Tool(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$typesPages = array(1=>"dashboard/", 2=>"dashboard/");
	
	$control = new sessionControl($db,
			'users',
			'user',
			'password',
			'type',
			$typesPages,
			'index.php',
			0);

	require_once $root.'/views/back/Layout_View_n.php';
	
	$data 					= $backend->loadBackend('mainSection');
	$data['title'] 			= 'Log Out';
	$data['section'] 		= 'log-out';
	$data['template-class'] = 'login-page';
	
	$view 		= new Layout_View($data);
	
	$control->eraseSession();
	
	echo $view->printHTMLPage();