<?php
$root = $_SERVER['DOCUMENT_ROOT'].'/';
require_once $root.'models/back/Layout_Model.php';

class generalBackend
{
	protected  $model;
	
	public function __construct()
	{
		$this->model = new Layout_Model();
	}
	
	public function loadBackend($section = '')
	{
		$data 		= array();
		
// 		Info of the Application
		
		$appInfoRow = $this->model->getGeneralAppInfo();
		
		$appInfo = array( 
				'title' 		=> $appInfoRow['title'],
				'siteName' 		=> $appInfoRow['site_name'],
				'url' 			=> $appInfoRow['url'],
				'content' 		=> $appInfoRow['content'],
				'description'	=> $appInfoRow['description'],
				'keywords' 		=> $appInfoRow['keywords'],
				'location'		=> $appInfoRow['location'],
				'creator' 		=> $appInfoRow['creator'],
				'creatorUrl' 	=> $appInfoRow['creator_url'],
				'twitter' 		=> $appInfoRow['twitter'],
				'facebook' 		=> $appInfoRow['facebook'],
				'googleplus' 	=> $appInfoRow['googleplus'],
				'pinterest' 	=> $appInfoRow['pinterest'],
				'linkedin' 		=> $appInfoRow['linkedin'],
				'youtube' 		=> $appInfoRow['youtube'],
				'instagram'		=> $appInfoRow['instagram'],
				'email'			=> $appInfoRow['email'],
				'lang'			=> $appInfoRow['lang']
				
		);
		
		$data['appInfo'] = $appInfo;
		
		// 		Categories
		$data['categories'] = $this->model->getCategoriesWithCompanies();
		
		// 		Locations
		$data['locations'] = $this->model->getLocations();
		
		$data['userInfo'] 	= $this->model->getUserInfo();

		$data['nCompanies'] = $this->model->getTotalCompanies();
		
		$data['nPromoted'] = $this->model->getTotalMainPromotedCompanies();
		
		$data['nNoPublish'] = $this->model->getTotalNotPublisedCompanies();
		
		switch ($section) 
		{
			case 'companies':
				// 		get All companies
				$data['companies'] = $this->model->getCompanies();
				
			break;
			
			case 'promoted':
				// 		get Promoted companies
				$data['companies'] = $this->model->getMainPromotedCompanies();
			break;
			
			case 'byCategory':
				$data['companies'] = $this->model->getCompaniesByCategoryId($_GET['categoryId']);
				$data['categoryInfo'] = $this->model->getCategoryInfoById($_GET['categoryId']);
			break;
			
			case 'location':
				// 		get Promoted companies
				$data['companies'] = $this->model->getCompaniesByLocation($_GET['locationId']);
			break;
			
			case 'unpublished':
				// 		get Promoted companies
				$companiesArray = $this->model->getMainUnpublishedCompanies();
				$data['companies'] = $companiesArray;
			break;
			
			case 'main-sliders':
				// 		array of the main sliders
				$slidersArray = $this->model->getMainSliders();
				$data['mainSliders'] = $slidersArray;
			break;
			
			case 'edit-company' :
				$companyId = '';
				$categoryId = '';
				
				if (isset($_GET['company']))
				{
					$companyId 		= $_GET['company'];
				}
				
				if (isset($_GET['category']))
				{
					$categoryId 		= $_GET['category'];
				}
				
				$background = $this->model->getCompanyLogo($companyId);
				$data['background'] = $background;
				
				$companySeoInfo		  = $this->model->getCompanySeoInfo($companyId);
				$general	     	  = $this->model->companyInfo($companyId);
				$lastSlider			  = $this->model->getLastSlider($companyId);
				$sliders			  = $this->model->getCompanySliders($companyId);
				$gallery			  = $this->model->getCompanyGaleries($companyId);
				$social			      = $this->model->getCompanySocialInfo($companyId);
				$emails           	  = $this->model->getEmails($companyId);
				$phones               = $this->model->getPhones($companyId);
				
				$companyInfo = array(
						'seo'			=> $companySeoInfo,
						'logo' 			=> $background,
						'lastSlider' 	=> $lastSlider,
						'general'		=> $general,
						'emails' 		=> $emails,
						'phones' 		=> $phones,
						'gallery' 		=> $gallery,
						'sliders' 		=> $sliders,
						'social'		=> $social
				);
				
				$data['company'] = $companyInfo;
				
				$categoryId	= $general['category'];
				
				//		get the category's subcategories
				$subcategoryArray 		= $this->model->getSubcategoriesByCategoryId($categoryId);
				$data['subcategories'] 	= $subcategoryArray;
				
				$belongSubcategoriesArray 	= $this->model->belongSubcategories($companyId);
				$data['belongSubcategories'] = $belongSubcategoriesArray;
				
				$companiesLocationsArray	= $this->model->getCompanyLocations($companyId);
				$data['companiesLocations'] = $companiesLocationsArray;
				
				// get All Events
				$data['events'] = $this->model->getEvents();
				
				$data['associated'] = $this->model->getEventsByCompany($companyId);
			break;
			
			case 'events' :
				$companyId 		= $_GET['company'];
			
				$categoryId 	= $_GET['category'];
			
				// 		get the background file for use as blur
				$background = $this->model->getCompanyLogo($companyId);
				$data['background'] = $background;
			
				$companySeoInfo		  = $this->model->getCompanySeoInfo($companyId);
				$general	     	  = $this->model->companyInfo($companyId);
				$lastSlider			  = $this->model->getLastSlider($companyId);
				$sliders			  = $this->model->getCompanySliders($companyId);
				$gallery			  = $this->model->getCompanyGaleries($companyId);
				$social			      = $this->model->getCompanySocialInfo($companyId);
				$emails           	  = $this->model->getEmails($companyId);
				$phones               = $this->model->getPhones($companyId);
			
				$companyInfo = array(
						'seo'			=> $companySeoInfo,
						'logo' 			=> $background,
						'lastSlider' 	=> $lastSlider,
						'general'		=> $general,
						'emails' 		=> $emails,
						'phones' 		=> $phones,
						'gallery' 		=> $gallery,
						'sliders' 		=> $sliders,
						'social'		=> $social
				);
			
				$data['company'] = $companyInfo;
			
				$categoryId	= $general['category'];
			
				//		get the category's subcategories
				$subcategoryArray 		= $this->model->getSubcategoriesByCategoryId($categoryId);
				$data['subcategories'] 	= $subcategoryArray;
			
				$belongSubcategoriesArray 	= $this->model->belongSubcategories($companyId);
				$data['belongSubcategories'] = $belongSubcategoriesArray;
			
				$companiesLocationsArray	= $this->model->getCompanyLocations($companyId);
				$data['companiesLocations'] = $companiesLocationsArray;
				
				$eventsArray = $this->model->getEventsByCompany($companyId);
				$data['events'] = $eventsArray;
			break;
			
			case 'videos':
					
				$videosArray = $this->model->getVideos();
				$data['videos'] = $videosArray;
			
			break;
			
			case 'members':
				$membersArray = $this->model->getAllMembers();
				$data['members'] = $membersArray;
			break;
			
			case 'member-detail':
				$memberId = $_GET['member'];
				$membersInfoRow = $this->model->getMemberDetail($memberId);
				$data['memberInfo'] = $membersInfoRow;
				$memberEmailsArray = $this->model->getMemberEmails($memberId);
				$data['memberEmails'] = $memberEmailsArray;
				$memberPhonesArray = $this->model->getMemberPhones($memberId);
				$data['memberPhones'] = $memberPhonesArray;
			break;
			
			default:
			break;
		}
		
		return $data;
	}
}

$backend = new generalBackend();

// $info = $backend->loadBackend();
// var_dump($info['categoryInfo']);
