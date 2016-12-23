<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/models/back/Media_Model.php');
require_once($root.'/models/back/Layout_Model.php');
require_once $root.'/backends/admin-backend.php';
require_once $root.'/Framework/Tools.php';

switch ($_POST['section'])
{
// 	Info
	case 'info':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($model->updateCompanyInfo($_POST))
			{
				echo 1;
			}
		}
	break;

// 	Seo
	case 'seo':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($model->updateCompanySeo($_POST))
			{
				echo 1;
			}
		}
	break;
	
	// 	Social
	case 'social':
		$model	= new Layout_Model();

		if (!empty($_POST))
		{
			if ($model->updateCompanySocial($_POST))
			{
				echo 1;
			}
		}
	break;
	
	// 	Email
	case 'email':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($_POST['emailId'] == 0)
			{
				$model->addCompanyEmail($_POST);
			}
			else 
			{
				$model->updateCompanyEmail($_POST);
				
			}
		}
	break;
	
	// 	Phones
	case 'phone':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($_POST['phoneId'] == 0)
			{
				$model->addCompanyPhone($_POST);
			}
			else
			{
				$model->updateCompanyPhone($_POST);
	
			}
		}
	break;
	
	// 	Phones
	case 'website':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($model->updateCompanyWebsite($_POST))
			{
				echo 1;
			}
		}
	break;
	
	//	Publish
	case 'publish':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($model->publishCompany($_POST['companyId'], $_POST['todo']))
				echo 1;
		}
	break;
	
	//	Close
	case 'close':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($model->closeCompany($_POST['companyId'], $_POST['todo']))
				echo 1;
		}
	break;
	
	//	Create
	case 'create':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			$companyId = 0;
			$companyId = $model->createCompany($_POST['companyName']);
			if ($companyId > 0)
			{
				echo $companyId;
			}
				
		}
	break;
	
	case 'checkPromoted':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			echo $model->countCompanyPromoted(); 
		}
	break;
	
	case 'promote':
		$model	= new Layout_Model();
		if (!empty($_POST))
		{
			if ($model->promoteCompany($_POST['companyId'], $_POST['todo']))
				echo 1;
		}
	break;
}
?>