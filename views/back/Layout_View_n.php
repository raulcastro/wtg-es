<?php
/**
 * This file has the main view of the project
 *
 * @package    Helpdesk System
 * @subpackage BCM Telematics
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Raul Castro <rd.castro.silva@gmail.com>
 */

$root = $_SERVER['DOCUMENT_ROOT'];
/**
 * Includes the file /Framework/Tools.php which contains a 
 * serie of useful snippets used along the code
 */
require_once $root.'/Framework/Tools.php';

/**
 * 
 * Is the main class, almost everything is printed from here
 * 
 * @package 	Reservation System
 * @subpackage 	Tropical Casa Blanca Hotel
 * @author 		Raul Castro <rd.castro.silva@gmail.com>
 * 
 */
class Layout_View
{
	/**
	 * @property string $data a big array cotaining info for especified sections
	 */
	private $data;
	
	/**
	 * get's the data *ARRAY* and the title of the document
	 * 
	 * @param array $data Is a big array with the whole info of the document 
	 * @param string $title The title that will be printed in <title></title>
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param int $this->data['section'] the section that define what will be printed
	 * 
	 */
	
	public function printHTMLPage()
    {
    ?>
	<!DOCTYPE html>
	<html class='no-js' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
			<meta charset="utf-8" >
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<title><?php echo $this->data['title']; ?> - <?php echo $this->data['appInfo']['title']; ?></title>
			<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
			<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
			<meta property="og:type" content="website" /> 
			<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
			<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
			<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
			<?php echo self::getCommonStyleDocuments(); ?>			
			<?php 
			
			$section = '';
			if (isset($this->data['section'])){ $section = $this->data['section'];}
			
			switch ($section) 
			{
				case 'log-in':
 					echo self :: getLogInHead();
				break;

				case 'dashboard':
					# code...
				break;
				
				case 'settings':
					echo self :: getSettingsHead();
				break;
				
				case 'inventory-category':
					echo self::getCategoryHead();
 				break;
				
				case 'add-owner':
					echo self::getAddOwnerHead();
				break;
				
				case 'member':
					echo self::getMemberHead();
				break;
				
				case 'rooms':
					echo self::getRoomsHead();
				break;
				
				case 'room':
					echo self::getRoomHead();
				break;
				
				case 'tasks':
					echo self::getTasksHead();
				break;
				
				case 'edit-company':
					echo self::getEditCompanyHead();
				break;
			}
			?>
		</head>
		<body id="<?php echo $this->data['section']; ?>" class="hold-transition <?php echo $this->data['template-class']; ?> skin-blue sidebar-mini ">
			<?php 
			if ($section != 'log-in' && $section != 'log-out')
			{
			?>
			<div class="wrapper">
				<?php echo self :: getHeader(); ?>
				<?php echo self :: getSidebar(); ?>
				
				<!-- =============================================== -->
				
				<!-- Content Wrapper. Contains page content -->
		        <div class="content-wrapper">
		            <!-- Content Header (Page header) -->
		            <section class="content-header">
		                <h1><?php echo $this->data['title']; ?></h1>
		                <ol class="breadcrumb">
		                    <li><a href="#"><i class="fa <?php echo $this->data['icon']; ?>"></i><?php echo $this->data['title']; ?></a></li>
		                    <!-- <li class="active">Here</li> -->
		                </ol>
		            </section>
		            <!-- Main content -->
            		<section class="content">
						<?php 
						switch ($this->data['section']) {

							case 'dashboard':
								echo self::getGridContent();
							break;
							
							case 'owners':
								echo self::getRecentMembers();
 							break;
							
							case 'settings':
								echo self::getSettingsContent();
							break;
							
							case 'inventory-category':
								echo self::getCategoryContent();
							break;
							
							case 'add-owner':
								echo self::getAddOwnerContent();
							break;

							case 'member':
								echo self::getMemberContent();
							break;
							
							case 'members':
								echo self::getAllMembers();
							break;
							
							case 'condo':
								echo self::getRoomsByCondo();
							break;
							
							case 'rooms':
								echo self::getRoomsContent();
							break;
							
							case 'room':
								echo self::getRoomContent();
							break;
							
							case 'tasks':
								echo self :: getAllTasks();
							break;

							case 'edit-company':
								echo self::getEditCompanyContent();
							break;
								
							default :
								# code...
							break;
						}
						?>
					</section>
				</div>
			</div>
			<?php
				echo self::getFooter();
			}
			else
			{
				switch ($this->data['section']) 
				{
					case 'log-in':
						echo self::getLogInContent();
					break;
				
					case 'log-out':
						echo self::getSignOutContent();
					break;
					
					default:
					break;
				}
			}
			
			echo self::getCommonScriptDocuments();
			
			switch ($this->data['section'])
			{
				case 'log-in':
					echo self::getLogInScripts();
				break;
				
				case 'settings':
					echo self::getSettingsScripts();
				break;
				
				case 'inventory-category':
					echo self::getCategoryScripts();
				break;
				
				case 'add-owner':
					echo self::getAddOwnerScripts();
				break;
				
				case 'member':
					echo self::getMemberScripts();
				break;
				
				case 'rooms':
					echo self::getRoomsScripts();
				break;
				
				case 'room':
					echo self::getRoomScripts();
				break;
				
				case 'tasks':
					echo self::getTasksScripts();
				break;
				
				case 'edit-company':
					echo self::getEditCompanyScripts();
				break;
			}
			?>
		</body>
	</html>
    <?php
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonStyleDocuments()
    {
    	ob_start();
    	?>
    	<!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="/dist/font-awesome-4.5.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
	    <!-- Theme style -->
	    <link rel="stylesheet" href="/dist/css/AdminLTE.css">
	    <!-- iCheck -->
	    <!-- iCheck for checkboxes and radio inputs -->
    	<link rel="stylesheet" href="/plugins/iCheck/all.css">
	
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">
       	<link href="/css/back/style_n.css" media="screen" rel="stylesheet" type="text/css" />
    	
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonScriptDocuments()
    {
    	ob_start();
    	?>
    	<!-- jQuery 2.1.4 -->
    	<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    	<!-- Bootstrap 3.3.5 -->
    	<script src="/bootstrap/js/bootstrap.min.js"></script>
    	<!-- AdminLTE App -->
    	<script src="/dist/js/app.min.js"></script>
    	<!-- SlimScroll -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	<script src="/js/back/bootbox.js"></script>
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * The main menu
     *
     * it's the top and main navigation menu
     * if is logged shows a sign-in | sign-up links
     * but if is logged it shows other menus included the sign-out
     *
     * @return string HTML Code of the main menu 
     */
    public function getHeader()
    {
    	ob_start();
    	$active='class="active"';
    	?>  		
		<!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo $this->data['appInfo']['title']; ?></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?php echo $this->data['appInfo']['title']; ?></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="label label-success">4</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo _("You have"); ?> 4 <?php echo _("messages"); ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li><!-- start message -->
											<a href="#">
												<div class="pull-left">
													<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													Support Team
													<small><i class="fa fa-clock-o"></i> 5 mins</small>
												</h4>
												<p>mensaje de ejemplo ...</p>
											</a>
										</li>
										<!-- end message -->
									</ul>
								</li>
								<li class="footer"><a href="#"><?php echo _("See All Messages"); ?></a></li>
							</ul>
						</li>
						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning">10</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo _("You have"); ?> 10 <?php echo _("notifications"); ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li>
											<a href="#">
												<i class="fa fa-users text-aqua"></i> 5 new members joined today
											</a>
										</li>
									</ul>
								</li>
								<li class="footer"><a href="#"><?php echo _("View all"); ?></a></li>
							</ul>
						</li>
						<!-- Tasks: style can be found in dropdown.less -->
						<li class="dropdown tasks-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">9</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo _("You have"); ?> 9 <?php echo _("tasks"); ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li><!-- Task item -->
											<a href="#">
												<h3>
													Design some buttons
													<small class="pull-right">20%</small>
												</h3>
												<div class="progress xs">
													<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
														<span class="sr-only">20% Complete</span>
													</div>
												</div>
											</a>
										</li>
										<!-- end task item -->
									</ul>
								</li>
								<li class="footer">
								<a href="#"><?php echo _("View all tasks"); ?></a>
								</li>
							</ul>
						</li>                    
                    
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $this->data['userInfo']['name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $this->data['userInfo']['name']; ?> - Administrator
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                	<div class="pull-left">
                  						<a href="#" class="btn btn-default btn-flat"><?php echo _("Profile"); ?></a>
                					</div>
                                    <div class="pull-right">
                                        <a href="/sign-out/" class="btn btn-default btn-flat"><?php echo _("Sign Out"); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
							<a href="/settings/" ><i class="fa fa-gears"></i></a>
						</li>
                    </ul>
                </div>
            </nav>
        </header>
    	<?php
    	$header = ob_get_contents();
    	ob_end_clean();
    	return $header;
    }
    
    /**
     * it is the head that works for the sign in section, aparently isn't getting 
     * any parameter, I just left it here for future cases
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     * @todo 		Delete it?
     * 
     * @return string
     */
    public function getLogInHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    public function getLogInScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/back/log-in.js"></script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    /**
     * getSignInContent
     * 
     * the sign-in box
     * 
     * @package Reservation System
     * @subpackage Sign-in
     * 
     * @return string
     */
    public function getLogInContent()
    {
    	ob_start();
    	?>
		<div class="login-box">
	        <div class="login-logo">
	            <a href="/"><b><?php echo $this->data['appInfo']['siteName']; ?></b></a>
	        </div>
	        <!-- /.login-logo -->
	        <div class="login-box-body">
	            <p class="login-box-msg"><?php echo _("Sign in to start your session"); ?></p>
	            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="logInForm">
	                <div class="form-group has-feedback">
	                    <input type="email" class="form-control" placeholder="<?php echo gettext("E-Mail"); ?>" name='loginUser'>
	                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	                </div>
	                <div class="form-group has-feedback">
	                    <input type="password" class="form-control" placeholder="<?php echo gettext("Password"); ?>" name='loginPassword'>
	                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	                </div>
	                <div class="row">
	                    <div class="col-xs-8">
	                        <!-- <div class="checkbox icheck">
	                            <label>
	                                <input type="checkbox"> Remember Me
	                            </label>
	                        </div>
	                       	 -->
	                    </div>
	                    <!-- /.col -->
	                    <div class="col-xs-4">
	                    	<input type="hidden" name="submitButton" value="1">
	                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="logins"><?php echo gettext("Log In"); ?></button>
	                    </div>
	                    <!-- /.col -->
	                </div>
	            </form>
	        </div>
	        <!-- /.login-box-body -->
	    </div>
	    <!-- /.login-box -->
        <?php
        $wideBody = ob_get_contents();
        ob_end_clean();
        return $wideBody;
    }
    
    /**
     * getSignOutContent
     *
     * It finish the session
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     *
     * @return string
     */
    public function getSignOutContent()
    {
    	ob_start();
    	?>
       	<div class="row login-box" id="sign-in">
    		<div class="col-md-12">
    			<h3 class="text-center"><?php echo _("You've been logged out successfully"); ?></h3>
    			<br />
    	    	<div class="panel panel-default">
					<div class="panel-body">
						<a href="/" class="btn btn-lg btn-success btn-block"><?php echo _("Log In"); ?></a>
					</div>
    			</div>
    		</div>
    	</div>
		<?php
		$wideBody = ob_get_contents();
		ob_end_clean();
		return $wideBody;
    }
   	
    /**
     * The side bar of the apliccation
     * 
     * Is the side-bar of the application where the main sections are as links
     * 
     * @return string
     */
   	public function getSidebar()
   	{
   		ob_start();
   		$active = 'class="active"';
   		?>
   		<!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->data['userInfo']['name']; ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> <?php echo _("Online"); ?></a>
                    </div>
                </div>
				<!-- search form -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="<?php echo _("Search"); ?> ...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<!-- /.search form -->
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header"><?php echo _("MAIN NAVIGATION"); ?></li>
                    <li class="active"><a href="/admin/dashboard/"><i class="fa fa-dashboard"></i> <span><?php echo _("Dashboard"); ?></span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-bank"></i>
                            <span><?php echo _("Companies"); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"><?php echo $this->data['nCompanies']; ?></small>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/add-client/"><i class="fa fa-circle-o"></i> <?php echo _("Add company"); ?></a></li>
                            <?php
		   				    foreach ($this->data['categories'] as $c)
		   				    {
		   				    ?>
		   			        <li>
		   						<a href="/admin/grid/category/<?php echo $c['category_id']; ?>/<?php echo Tools::slugify($c['name']); ?>/">
		   							<i class="fa fa-circle-o"></i>
		   							<?php echo $c['name']; ?>
		   						</a>
		   					</li>
		   				    <?php
		   				    }
		   				    ?>
                        </ul>
                    </li>
                    
                    <li>
						<a href="/admin/grid/promoted/">
						<i class="fa fa-star"></i> <span>Promoted</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-blue"><?php echo $this->data['nPromoted']; ?></small>
							</span>
						</a>
					</li>
					
					<li>
						<a href="/admin/grid/unpublished/">
						<i class="fa fa-ban"></i> <span>Unpublished</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-red"><?php echo $this->data['nNoPublish']; ?></small>
							</span>
						</a>
					</li>
                    <!-- 
                    <li>
						<a href="calendar.html">
							<i class="fa fa-calendar"></i> <span>Events</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-gray">17</small>
							</span>
						</a>
					</li>
					 -->
					<li class="treeview">
                        <a href="#">
                            <i class="fa fa-map"></i>
                            <span><?php echo _("Locations"); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php
		   				    foreach ($this->data['locations'] as $c)
		   				    {
		   				    ?>
		   			        <li>
		   						<a href="/admin/grid/location/<?php echo $c['location_id']; ?>/<?php echo Tools::slugify($c['name']); ?>/">
		   							<i class="fa fa-circle-o"></i>
		   							<?php echo $c['name']; ?>
		   						</a>
		   					</li>
		   				    <?php
		   				    }
		   				    ?>
                        </ul>
                    </li>
					
					<li>
						<a href="calendar.html">
							<i class="fa fa-file-photo-o"></i> <span>Main Gallery</span>
						</a>
					</li>
					
					<li>
						<a href="calendar.html">
							<i class="fa  fa-video-camera"></i> <span>Videos</span>
						</a>
					</li>
                    
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
   		<?php
   		$sideBar = ob_get_contents();
   		ob_end_clean();
   		return $sideBar;
   	}
   	
   	/**
   	 * getGridContent
   	 * it returns the structure of the grid 
   	 * @return string
   	 */
    public function getGridContent()
    {
    	ob_start();
    	?>
    	<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
				echo self::getGrid();
			?>
		</section>
    	<?php
    	$grid = ob_get_contents();
    	ob_end_clean();
    	return $grid;
    }
   	
   	/**
   	 * getGrid
   	 * 
   	 *The grid of all the companies, it doesn't matter if it's published or not 
   	 * @return string
   	 */
   	public function getGrid()
   	{
   		ob_start();
   		?>
   		<div id="main-grid" class='row'>
   		<?php
   		foreach ($this->data['companies'] as $a)
   		{
   			$logo = "";
   			if ($a['logo'])
			{
				$logo = "/img-up/companies_pictures/logo/".$a['logo'];
			}
			else {
				$logo = "/images/default_item_front.jpg";
			}
		?>
		<div class='col-lg-4 col-md-6 company-item'>
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive" src="<?php echo $logo; ?>" alt="User profile picture">
					<h3 class="profile-username text-center"><?php echo $a['name']; ?></h3>
					<p class="text-muted text-center"><?php echo $a['category']; ?></p>
					<a href="/admin/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" class="btn btn-primary btn-block"><b>Edit</b></a>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<?php 
		}
		?>
		</div>
   		<?php		
   		$items = ob_get_contents();
   		ob_end_clean();
   		return $items;
   	}
   	
   	/**
   	 * the big icons that appear on the top of every section
   	 * 
   	 * @return string
   	 */
   	public function getDashboardIcons() 
   	{
   		ob_start();
   		?>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text"><?php echo _("Clients"); ?></span>
						<span class="info-box-number"><?php echo $this->data['totalMembers']; ?></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text"><?php echo _("Tasks"); ?></span>
						<span class="info-box-number"><?php echo $this->data['taskInfo']['today']; ?></span>
						<span class="progress-description"><?php echo $this->data['taskInfo']['pending']; ?> <?php echo _("pending"); ?></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text"><?php echo _("Messages");?></span>
						<span class="info-box-number">4</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text"><?php echo _("Payments"); ?></span>
						<span class="info-box-number">2</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
		</div>
          <!-- =========================================================== -->
   		<?php
   		$dashboardIcons = ob_get_contents();
   		ob_end_clean();
   		return $dashboardIcons;
   	}
   	
   	/**
   	 * Last n members
   	 * 
   	 * Is like a preview, it is printed onthe dashboard
   	 * 
   	 * @return string
   	 */
   	
   	public function getRecentMembers()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php echo _("Recent Clients"); ?></h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
	                      <th><?php echo _("Client ID"); ?></th>
							<th><?php echo _("Name"); ?></th>
							<th><?php echo _("Phone"); ?></th>
							<th><?php echo _("E-Mail"); ?></th>
							<th><?php echo _("Date"); ?></th>
	                    </tr>
	                    <?php 
	                    if ($this->data['lastMembers'])
						foreach ($this->data['lastMembers'] as $member)
						{
							?>
						<tr>
							<td>
								<a href="/client/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/">
									<?php echo $member['member_id']; ?>
								</a>
							</td>
							<td>
								<a href="/client/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/" class="member-link">
									<?php echo $member['name'].' '.$member['last_name']; ?>
								</a>
							</td>
							<td><?php echo $member['phone_one']; ?></td>
							<td><?php echo $member['email_one']; ?></td>
							<td><?php echo Tools::formatMYSQLToFront($member['date']); ?></td>
						</tr>
							<?php
						}
						?>
	                  </table>
                	</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
   		<?php
   		$membersRecent = ob_get_contents();
   		ob_end_clean();
   		return $membersRecent;
   	}
	
   	/**
   	 * The whole list of members
   	 * 
   	 * @return string
   	 */
   	public function getAllMembers()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Recent Owners</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
	                      <th>Member ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<?php 
							if ($_SESSION['loginType'] == 1)
							{
							?>
								<th>Added by</th>
							<?php 
							} 
							else 
							{
							?>
								<th>Address</th>
							<?php 
							}
							?>
							<th>Date</th>
	                    </tr>
	                    <?php 
						foreach ($this->data['members'] as $member)
						{
							?>
						<tr>
							<td>
								<a href="/owner/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/">
									<?php echo $member['member_id']; ?>
								</a>
							</td>
							<td>
								<a href="/owner/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/" class="member-link">
									<?php echo $member['name'].' '.$member['last_name']; ?>
								</a>
							</td>
							<td><?php echo $member['phone_one']; ?></td>
							<td><?php echo $member['email_one']; ?></td>
							<?php 
							if ($_SESSION['loginType'] == 1)
							{
								?>
								<td><?php echo $member['user_name']; ?></td>
								<?php 
							} 
							else 
							{
								?>
								<td><?php echo $member['address']; ?></td>
								 <?php 
							}
							?>
							<td><?php echo Tools::formatMYSQLToFront($member['date']); ?></td>
						</tr>
							<?php
						}
						?>
	                  </table>
                	</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
   		
   	   	<?php
   	   	$membersRecent = ob_get_contents();
   	   	ob_end_clean();
   	   	return $membersRecent;
   	}

   	/**
   	 * The box of the history items
   	 * @return string
   	 */
	public function getHistoryPanel()
   	{
   		ob_start();
   		?>
   		<div class="col-sm-12 history-member-panel">
			<div class="text-right">
				<a href="javascript:void(0);" class="btn btn-info btn-sm display-add-history">Add history</a>
			</div>
			
			<div class="history-member-box">
				<textarea rows="2" cols="" class="form-control" placeholder="history" id="history-entry"></textarea>
				<a href="javascript:void(0);" class="btn btn-info btn-xs" id="add-history">Add</a>
			</div>
			
			<div class="history-content">
				<ul class="history-list">
					<?php
					if ($this->data['memberHistory'])
					{
						foreach ($this->data['memberHistory'] as $history)
						{
						?>
					<li>
                    	<div class="header"><?php echo $history['name']; ?> | <?php echo Tools::formatMYSQLToFront($history['date']).'  '.Tools::formatHourMYSQLToFront($history['time']); ?></div>
                        	<div>
							<i class="glyphicon glyphicon-option-vertical"></i>
							<div class="history-title">
								<span class="task-title-sp">
									<?php echo $history['history']; ?>
								</span>
							</div>
						</div>
					</li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
   		<?php
   		$historyPanel = ob_get_contents();
   		ob_end_clean();
   		return $historyPanel;
   	}
   	
   	/**
   	 * the task tab, displayed under the member profile
   	 * @return string
   	 */
   	public function getTaskPanel()
   	{
   		ob_start();
   		?>
   		<div class="col-sm-12 task-member-panel">
			<div class="text-right">
				<a href="javascript:void(0);" class="btn btn-info btn-sm display-add-task">Add task</a>
			</div>
			
			<div class="task-member-box">
				<div class="create-task-box" id="create-task-box">
					<div class="top">
						<?php 
						if ($this->data['userInfo']['type'] == 1)
						{
						?>
						<div class="to">
							<label>To</label>
							<select id="task_to">
							<?php 
							if ($this->data['usersActive'])
							{
								foreach ($this->data['usersActive'] as $user) 
								{
									?>
								<option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
									<?php
								}
							}
							?>
							</select>
						</div>
						<?php 
						}
						else
						{
							?>
						<input type="hidden" id="task_to" value="<?php echo $this->data['userInfo']['user_id']; ?>">
							<?php
						}
						?>
						
						<div class="date">
							<label>Date</label>
							<input type="text" id="task-date" />
						</div>
						
						<div class="hour">
							<label>Time</label>
							<select id="task_hour">
								<option value="8:00">8:00</option>
								<option value="8:30">8:30</option>
								<option value="9:00">9:00</option>
								<option value="9:30">9:30</option>
								<option value="10:00">10:00</option>
								<option value="10:30">10:30</option>
								<option value="11:00">11:00</option>
								<option value="11:30">11:30</option>
								<option value="12:00">12:00</option>
								<option value="12:30">12:30</option>
								<option value="13:00">13:00</option>
								<option value="13:30">13:30</option>
								<option value="14:00">14:00</option>
								<option value="14:30">14:30</option>
								<option value="15:00">15:00</option>
								<option value="15:30">15:30</option>
								<option value="16:00">16:00</option>
								<option value="15:30">16:30</option>
								<option value="17:00">17:00</option>
								<option value="17:30">17:30</option>
								<option value="18:00">18:00</option>
								<option value="18:30">18:30</option>
								<option value="19:00">19:00</option>
								<option value="19:30">19:30</option>
								<option value="20:00">20:00</option>
								<option value="20:30">20:30</option>
							</select>
						</div>
						<div class="clear"></div>
					</div><!--  /top -->
					<div class="middle">
						<textarea rows="" cols="" id="task_content" class="form-control" placeholder="new task"></textarea>
						<a href="javascript:void(0);" class="btn btn-info btn-xs" id="add-task">Add</a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
			<div class="row task-content">
				<ul class="task-list">
					<?php
					echo $this->listTasks($this->data['memberTasks']);
					?>
				</ul>
			</div>
		</div>
   		<?php
   		$taskPanel = ob_get_contents();
   		ob_end_clean();
   		return $taskPanel;
   	}

	/**
	 * extra files for the task section
	 * 
	 * @return string
	 */

	public function getTasksHead()
    {
    	ob_start();
    	?>
       	<script src=""></script>
        <script>
    	</script>
        <?php
        $signIn = ob_get_contents();
        ob_end_clean();
        return $signIn;
    }
    
    public function getTasksScripts()
    {
    	ob_start();
    	?>
       	<script src="/js/tasks.js"></script>
        <script>
    	</script>
        <?php
        $signIn = ob_get_contents();
        ob_end_clean();
        return $signIn;
    }

    /**
     * Display the tasks
     * 
     * @param array $tasks all the tasks
     * @return string
     */
    public static function listTasks($tasks)
   	{
   		ob_start();
   		
   		if ($tasks)
   		{
   			foreach ($tasks as $task)
   			{
   				$date = Tools::formatMYSQLToFront($task['date']);
   				$time = Tools::formatHourMYSQLToFront($task['time']);
   				?>
				<li
   				<?php 
   				if( $task['status'] == 1)
   					echo 'class="completed"';
   				
   				if( strtotime($date) == strtotime(@date('d-M-Y', strtotime('now'))))
   					echo 'class="today"';
   							
   				if( strtotime($date) < strtotime('now'))
   					echo 'class="pending"';
   							
   				if( strtotime($date) > strtotime('now'))
   					echo 'class="future"';
   				?>
   				>
   					<div class="header">
   						<div class="info">
   							<strong><?php echo $task['assigned_to']; ?> </strong>
   							<span class="text-primary"><?php echo $date.' '.$time; ?></span>
   							<span class="text-muted"><?php echo $task['assigned_by']; ?></span>
   						</div>
   						<?php 
	                    if ($task['status'] == 0)
	                    {
	                    ?>
	                    	<a href="javascript: void(0);" class="completeTask" tid="<?php echo $task['task_id']; ?>"><i class="glyphicon glyphicon-check icon" ></i></a>
	                    <?php 
	                    }
	                    
   						if ($task['member_id'])
   						{
   						?>
   						<div class="member">
   							<a href="/<?php echo $task['member_id']; ?>/<?php echo Tools::slugify($task['name'].' '.$task['last_name']); ?>/">
   								<?php echo $task['name'].' '.$task['last_name']; ?>
   							</a>
   						</div>
   						<?php
   						}
   						?>
   						<div class="clear"></div>
   					</div>
   					<div class="clear"></div>
   					<div>
   						<i class="glyphicon glyphicon-option-vertical"></i>
   						<div class="history-title">
   							<span class="task-title-sp"><?php echo $task['content']; ?></span>
   						</div>
   					</div>
   					<div class="clear"></div>
   				</li>
   				<?php
   				}
   			}
   		$tasks = ob_get_contents();
   		ob_end_clean();
   		return $tasks;
   	}

   	/**
   	 * The boix and tabs for the tasks
   	 * 
   	 * @return string
   	 */
   	public function getAllTasks()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-sm-12 task-member-panel">
				<div class="main-menu-tasks text-center">
					<ul class="nav nav-pills">
						<li>
							<a href="#" class="text-red" id="get-pending-tasks">
								Pending
								<?php if ($this->data['taskInfo']['pending'] > 0) {?><span class="badge"><?php echo $this->data['taskInfo']['pending']; ?></span><?php } ?>
							</a>
						</li>
						<li>
							<a href="#" class="text-aqua" id="get-today-tasks">
								Today 
								<?php if ($this->data['taskInfo']['today'] > 0) {?><span class="badge"><?php echo $this->data['taskInfo']['today']; ?></span><?php } ?>
							</a>
						</li>
						<li>
							<a href="#" class="text-yellow" id="get-future-tasks">
								Future 
								<?php if ($this->data['taskInfo']['future'] > 0) {?><span class="badge"><?php echo $this->data['taskInfo']['future']; ?></span><?php } ?>
							</a>
						</li>
						<li>
							<a href="#" class="text-green" id="get-completed-tasks">
								Completed
							</a>
						</li>
					</ul>
				</div>
				<div class="row task-content">
					<ul class="task-list">
					<?php 
					echo $this->listTasks($this->data['memberTasks']);
					?>
					</ul>
				</div>
			</div>
		</div>
   		<?php
   		$tasks = ob_get_contents();
   		ob_end_clean();
   		return $tasks; 
   	}
   	
    public function getSettingsHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSettingsScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/settings.js"></script>
		<script src="/js/room-types.js"></script>
		<script src="/js/condos.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSettingsContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Condos</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Condo</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="condoName" placeholder="Condo name ...">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="condoDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addCondo">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="condoBox">
							<?php 
							if ($this->data['condos'])
							{
								foreach ($this->data['condos'] as $condo)
								{
									?>
							<li id="condoId<?php echo $condo['condo_id']; ?>"><a href="#"><?php echo $condo['condo']; ?><span class="pull-right badge bg-red"><i class="fa fa-close deleteCondo" data-id="<?php echo $condo['condo_id']; ?>"></i></span></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Inventory categories</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="categoryName" placeholder="Category name ...">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="categoryDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addCategory">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="categoryBox">
							<?php 
							if ($this->data['categories'])
							{
								foreach ($this->data['categories'] as $category)
								{
									?>
							<li><a href="/edit-inventory-category/<?php echo $category['category_id']; ?>/"><?php echo $category['category']; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        
        <div class="row">
        	<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Room Types</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Room Type</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="roomTypeName" placeholder="Room type">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="roomTypeDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addRoomType">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="roomTypesBox">
							<!-- This has the close icon, or delete icon -->
							<!-- <li><a href="#"><?php echo $type['room_type']; ?><span class="pull-right badge bg-red"><i class="fa fa-close"></i></span></a></li> -->
							<?php 
							if ($this->data['types'])
							{
								foreach ($this->data['types'] as $type)
								{
									?>
							<li id="typeId<?php echo $type['room_type_id']; ?>"><a href="#"><?php echo $type['room_type']; ?><span class="pull-right badge bg-red"><i class="fa fa-close deleteType" data-id="<?php echo $type['room_type_id']; ?>"></i></span></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
			
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getCategoryHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getCategoryScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/settings.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getCategoryContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Category</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<input type="hidden" id="categoryId" value="<?php echo $this->data['category']['category_id']; ?>">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="categoryName" placeholder="Category name ..." value="<?php echo $this->data['category']['category']; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="categoryDescription" placeholder="Description ..."><?php echo $this->data['category']['description']; ?></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-danger btn-xs pull-right" id="deleteCategory">Delete category</button>
								<button type="submit" class="btn btn-info btn-xs pull-right" id="updateCategory">Update</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
			
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Inventory</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Inventory</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inventoryName" placeholder="Inventory name ..." value="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="inventoryDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addInventory">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="inventoryBox">
							<?php 
							if ($this->data['inventoryArray'])
							{
								foreach ($this->data['inventoryArray'] as $inventory)
								{
									?>
							<li><a href="#" id="inventoryId<?php echo $inventory['inventory_id']; ?>"><?php echo $inventory['inventory']; ?><span class="pull-right badge bg-red"><i class="fa fa-close deleteInventory" data-id="<?php echo $inventory['inventory_id']; ?>"></i></span></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getAddOwnerHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getAddOwnerScripts()
    {
    	ob_start();
    	?>
		<!-- InputMask -->
	    <script src="/plugins/input-mask/jquery.inputmask.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	    <!-- SlimScroll 1.3.0 -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	
    	<script type="text/javascript">
    	$(function () {
            //Money Euro
            $("[data-mask]").inputmask();
    	});
		</script>
		<script src="/js/members.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getAddOwnerContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title"><?php echo _("Client info"); ?></h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo _("First name"); ?></label>
							<input type="text" class="form-control" id="memberFirst" placeholder="<?php echo _("First name"); ?> ...">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo _("Last name"); ?></label>
							<input type="text" class="form-control" id="memberLast" placeholder="<?php echo _("Last name"); ?> ...">
						</div>
                        
                        <!-- phone mask -->
						<div class="form-group">
							<label><?php echo _("Phone one"); ?></label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneOne" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- phone mask -->
						<div class="form-group">
							<label><?php echo _("Phone two"); ?></label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneTwo" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label><?php echo _("E-Mail one"); ?></label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailOne" class="form-control" data-inputmask='' id="emailOne" data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label><?php echo _("E-Mail two"); ?></label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailTwo" class="form-control" data-inputmask='' id="emailOne" data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo _("Address"); ?></label>
							<textarea class="form-control" id="memberAddress" rows="3" placeholder="<?php echo _("Address"); ?> ..."></textarea>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo _("Notes"); ?></label>
							<textarea class="form-control" id="notes" rows="5" placeholder="<?php echo _("Notes"); ?> ..."></textarea>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="progress progress-sm active">
	                    	<div class="progress-bar progress-bar-success progress-bar-striped" id="progressSaveMember" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	                      		<span class="sr-only">20% Complete</span>
	                    	</div>
	                  	</div>
	                    <button type="submit" class="btn btn-info pull-right" id="memberSave"><?php echo _("Add client"); ?></button>
	                    <a href="" class="btn btn-success pull-right" id="memberComplete"><?php echo _("Complete client profile"); ?></a>
                  	</div>
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
     	return $content;
    }
    
    public function getRoomPanel()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6 text-right " id="showAddRoomBox">
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-left btn-xs" id="showAddRoom">Add apartment</button>
				</div>
			</div>
			<div class="col-md-6 add-room-boxes">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Apartment</label>
					<div class="col-sm-10">
						<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roomList">
							<?php 
							foreach ($this->data['rooms'] as $room)
							{
								?>
							<option value="<?php echo $room['room_id']; ?>"><?php echo $room['room']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div><!-- /.form-group -->
			</div><!-- /.col -->
			
			<div class="col-md-6 text-right add-room-boxes">
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-left btn-sm" id="addMemberRoom">Add room</button>
				</div>
			</div>
		</div>
		
		<h2 class="page-header">Apartments</h2>
		<input type="hidden" val="" id="currentRoom">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-body">
						<div class="box-group" id="accordion">
							<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
							<?php 
							foreach ($this->data['memberRooms'] as $room)
							{
								echo self::getRoomMemberItem($room);
							}
							?>
						</div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
		
		<!------------------------------- Modals! ------------------------------->
		<!-- Modal  -->
		<div class="example-modal" >
			<input type="hidden" value="" id="currentCategory">
			<input type="hidden" value="" id="currentInventory">
			<div class="modal" id="payment-modal">
				<div class="modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add payment</h4>
						</div>
						<div class="modal-body">
							<div class="row segment-user-payment">
								<div class="col-sm-6">
									<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="categoryRoomList">
										<option>Category</option>
									</select>
								</div>
								
								<div class="col-sm-6">
									<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="inventoryRoomList">
										<option>Inventory</option>
									</select>
								</div>
							</div>
							
							<div class="row segment-user-payment">
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="text" class="form-control" placeholder="Amount" id="paymentAmount">
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" placeholder="Amount due date" id="paymentDate">
									</div>
								</div>
							</div>
							<div class="row segment-user-payment">
								<div class="col-sm-12">
									<div class="form-group">
										<textarea class="form-control" rows="3" placeholder="Payment description" id="paymentDescription"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<!-- <button type="button" class="btn btn-info btn-sm" id="addPayment">Save</button>-->
							<a href="#" class="btn btn-info btn-sm" id="addPayment">Save</a>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
		
		<!-- /.example-modal --><!------------------------------- Modals! ------------------------------->
		<!-- Modal  -->
		<div class="example-modal" >
			<div class="modal" id="singlePayment">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Payment</h4>
						</div>
						<div class="modal-body">
							<section class="invoice">
								<!-- title row -->
								<div class="row">
									<div class="col-xs-12">
										<h2 class="page-header">
											<i class="fa fa-globe"></i> <?php echo $this->data['appInfo']['siteName']; ?>
											<small class="pull-right">Date: <span id="dateAdded"></span></small>
										</h2>
									</div><!-- /.col -->
								</div>
								<!-- info row -->
								<div class="row invoice-info">
									<div class="col-sm-4 invoice-col">
										From
										<address>
											<strong><?php echo $this->data['appInfo']['siteName']; ?></strong><br>
											Phone: <?php echo $this->data['appInfo']['phone']; ?><br>
											Email: <?php echo $this->data['appInfo']['email']; ?>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										To
										<address>
											<strong><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></strong><br>
											<?php echo $this->data['memberInfo']['address']; ?><br>
											Phone: <?php echo $this->data['memberInfo']['phone_one']; ?><br>
											Email: <?php echo $this->data['memberInfo']['email_one']; ?>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										<b>Invoice #<span id="paymentNo"></span></b><br>
										<b>Payment Due:</b> <span id="singlePaymentDueDate"></</span>
									</div><!-- /.col -->
								</div><!-- /.row -->
								
								<!-- Table row -->
								<div class="row">
									<div class="col-xs-12 table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Order</th>
													<th>Room</th>
													<th>Category</th>
													<th>Description</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="singlePaymentId"></td>
													<td id="singlePaymentInventory"></td>
													<td id="singlePaymentCategory"></td>
													<td id="singlePaymentDescription"></td>
													<td id="singlePaymentAmount"></td>
												</tr>
											</tbody>
										</table>
									</div><!-- /.col -->
								</div><!-- /.row -->
								
								<div class="row">
									<!-- accepted payments column -->
									<div class="col-xs-6">
										<div id="paymentOptionsPaid">
											<h3>PAID</h3>
										</div>
										
										<div id="paymentOptionsCancelled">
											<h3>CANCELLED</h3>
										</div>
										
										<div id="setPaymentOptionsBox">
											<p class="lead">Set payment as: </p>
											<div >
												<div class="form-group">
													<ul class="payment-options">
														<li>
															<input tabindex="7" type="radio" id="optionPaymentPending" name="minimal-radio">
															<label for="minimal-radio-1"> Pending</label>
														</li>
														<li>
															<input tabindex="8" type="radio" id="optionPaymentPaid" name="minimal-radio">
															<label for="minimal-radio-2"> Paid</label>
														</li>
														<li>
															<input tabindex="9" type="radio" id="optionPaymentCancelled" name="minimal-radio">
															<label for="minimal-radio-3"> Cancelled</label>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div><!-- /.col -->
									            
									<div class="col-xs-6">
										<p class="lead">Documents</p>
										<div class="table-responsive">
											<table class="table">
												<tbody id="paymentDocuments">
												</tbody>
											</table>
										</div>
										<div class="add-document" id="addDocument">
											Browse
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
							</section>
						</div>
						<div class="modal-footer">
							<input type="hidden" id="singlePaymentIdVal">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>	
							<button class="btn btn-danger pull-right" id="deletePayment"><i class="fa fa-remove"></i> Delete</button>						
							<button class="btn btn-success pull-right" id="updatPayment"><i class="fa fa-credit-card"></i> Submit Payment</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getRoomMemberItem($room)
    {
    	ob_start();
    	?>
		<div class="panel box box-success">
			<div class="box-header with-border">
				<h5 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $room['room_id']; ?>" class="roomList room-id" data-id="<?php echo $room['room_id']; ?>">
						<strong><?php echo $room['condo'].' / '.$room['room'].' / '.$room['room_type']; ?></strong>
					</a>
				</h5>
			</div>
			<div id="collapse<?php echo $room['room_id']; ?>" class="panel-collapse collapse">
				<div class="box-body">
					<?php echo $room['description']; ?>
					<br>
					<br>
					<div class="row">
						<div class="col-md-12">
							<!-- Custom Tabs -->
							<div class="nav-tabs-custom">
								<input type="hidden" value="pending" id="currentPaymentSelection" />
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab" id="getPendingTab">Payments</a></li>
									<li><a href="#tab_2" data-toggle="tab" id="getPastDueTab">Past Due</a></li>
									<li><a href="#tab_3" data-toggle="tab" id="getPaidTab">Paid</a></li>
									<li><a href="#tab_4" data-toggle="tab" id="getCancelledTab">Cancelled</a></li>
									<li><a href="#tab_5" data-toggle="tab" id="getDisplayAllPayments">All Payments</a></li>
									<li>
									
										<button type="submit" class="btn btn-danger btn-xs pull-right deleteApartment"  data-id="<?php echo $room['room_id']; ?>">Delete apartment</button>
									</li>
									<!-- <li><a href="#tab_3" data-toggle="tab">Galleries</a></li> -->
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
										
									</div><!-- /.tab-pane -->
									
									<div class="tab-pane" id="tab_2">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
									</div> <!-- /.tab-pane -->
									
									<div class="tab-pane" id="tab_3">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
									</div> <!-- /.tab-pane -->
									
									<div class="tab-pane" id="tab_4">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
									</div> <!-- /.tab-pane -->
									
									
									<div class="tab-pane" id="tab_5">
										<section class="invoice">
											<!-- title row -->
											<div class="row">
												<div class="col-xs-12">
													<h2 class="page-header">
														<i class="fa fa-globe"></i> <?php echo $this->data['appInfo']['siteName']; ?>
													</h2>
												</div><!-- /.col -->
											</div>
											<!-- info row -->
											<div class="row invoice-info">
												<div class="col-sm-4 invoice-col">
													From
													<address>
														<strong><?php echo $this->data['appInfo']['siteName']; ?></strong><br>
														Phone: <?php echo $this->data['appInfo']['phone']; ?><br>
														Email: <?php echo $this->data['appInfo']['email']; ?>
													</address>
												</div><!-- /.col -->
												<div class="col-sm-4 invoice-col">
													To
													<address>
														<strong><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></strong><br>
														<?php echo $this->data['memberInfo']['address']; ?><br>
														Phone: <?php echo $this->data['memberInfo']['phone_one']; ?><br>
														Email: <?php echo $this->data['memberInfo']['email_one']; ?>
													</address>
												</div><!-- /.col -->
											</div><!-- /.row -->
											
											<!-- Table row -->
											<div class="row">
												<div class="col-xs-12 table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Category</th>
																<th>Description</th>
																<th>Payment due</th>
																<th>Pending</th>
																<th>Paid</th>
															</tr>
														</thead>
														<tbody id="allPaymentsContent">
															
														</tbody>
													</table>
												</div><!-- /.col -->
											</div><!-- /.row -->
											<div class="row">
												<!-- accepted payments column -->
												<div class="col-xs-6">
													
													<div id="paymentOptionsBox">
														<h3>Total: $<span id="totalViewAllPayments"></span></h3>
													</div>
												</div><!-- /.col -->
											</div><!-- /.row -->
										</section>
									</div><!-- /.tab-pane -->
									
								</div><!-- /.tab-content -->
							</div><!-- nav-tabs-custom -->
						</div><!-- /.col -->
					</div>
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getSingleMessage($message)
    {
    	ob_start();
    	$class = '';
    	$className = '';
    	$classDate = '';
    	$name = '';
    	$image = '';
//     	var_dump($message);
    	if ($message['from_user'] == $this->data['memberInfo']['member_id'])
    	{
    		$class = 'right';
    		$className = 'pull-right';
    		$classDate = 'pull-left';
    		$name = $message['member_name'];
    		if ($message['avatar'])
    		{
    			$image = "/images/owners-profile/avatar/".$message['avatar'];
    		}
    		else 
    		{
    			$image = "/dist/img/default-user.jpg";
    		}
    	}
    	else 
    	{
    		$className = 'pull-left';
    		$classDate = 'pull-right';
    		$name = $message['user_name'];
    		$image = "/dist/img/user2-160x160.jpg";
    	}
    	?>
    	<!-- Message to the right -->
		<div class="direct-chat-msg <?php echo $class; ?>">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name <?php echo $className; ?>"><?php echo $name; ?></span>
				<span class="direct-chat-timestamp <?php echo $classDate; ?>"><?php echo $message['date']; ?></span>
			</div><!-- /.direct-chat-info -->
			<img class="direct-chat-img" src="<?php echo $image; ?>" alt="message user image"><!-- /.direct-chat-img -->
			<div class="direct-chat-text">
				<?php echo $message['message']; ?>
			</div><!-- /.direct-chat-text -->
		</div><!-- /.direct-chat-msg -->
    	<?php
    	$content = ob_get_contents();
    	ob_end_clean();
    	return $content;
    }
    
    public function getMessagesPanel()
    {
    	ob_start();
    	?>
    	<!-- DIRECT CHAT WARNING -->
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header">
				<h3 class="box-title">Direct Chat</h3>
				<div class="box-tools pull-right">
					<span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body" id="">
				<!-- Conversations are loaded here -->
				<div class="direct-chat-messages" id="boxChat">
					<?php 
					if ($this->data['messages'])
					{
						foreach ($this->data['messages'] as $message)
						{
							echo $this->getSingleMessage($message);
						}
					}
					?>
				</div><!--/.direct-chat-messages-->
			</div><!-- /.box-body -->
			<div class="box-footer">
					<div class="input-group">
						<input type="text" name="message" placeholder="Type Message ..." class="form-control" id="chatMessage">
						<span class="input-group-btn">
							<button type="button" class="btn btn-primary btn-flat" id="addChatMessage">Send</button>
						</span>
					</div>
			</div><!-- /.box-footer-->
		</div><!--/.direct-chat -->
    	<?php
    	$content = ob_get_contents();
    	ob_end_clean();
    	return $content;
    }
    
    public function getMemberHead()
    {
    	ob_start();
    	?>
    	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    	<link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getMemberScripts()
    {
    	ob_start();
    	?>
    	<!-- InputMask -->
	    <script src="/plugins/input-mask/jquery.inputmask.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	    <!-- SlimScroll 1.3.0 -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    	<script src="/plugins/select2/select2.full.min.js"></script>
    	<script src="/plugins/iCheck/icheck.min.js"></script>
    	<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    	
    	<script type="text/javascript">
    	$(function () {
            //Money Euro
            $("[data-mask]").inputmask();
            $("#task-date").datepicker();
            $('#paymentDate').datepicker();
            $(".select2").select2();

          //iCheck for checkbox and radio inputs
            $('input[type="radio"]').iCheck({
                radioClass: 'iradio_minimal-blue',
                increaseArea: '20%' // optional
            });

            
    	});
    	$(function () {
    	    //Add text editor
    	    $("#sendEmailContent").wysihtml5();
    	  });
		</script>
		<link href="/css/uploadfile.css" rel="stylesheet">
		<script src="/js/jquery.uploadfile.min.js"></script>
		<script src="/js/members.js"></script>
		<script src="/js/history.js"></script>
		<script src="/js/tasks.js"></script>
		<script src="/js/rooms.js"></script>
		<script src="/js/payments.js"></script>
		<script src="/js/email.js"></script>
		<script src="/js/messages.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getMemberContent()
    {
    	ob_start();
    	
    	$img = "/images/default/128x128-user.png";

    	if ($this->data['memberInfo']['avatar'])
    	{
    		$img = "/images/owners-profile/avatar/".$this->data['memberInfo']['avatar'];
    	}
    	?>
    	
    	<!-- Modal  -->
		<div class="example-modal" >
			<div class="modal" id="avatarModal">
				<div class="modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Change user avatar</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-4">
										<img alt="" height="100" id="iconImg" src="<?php echo $img; ?>" />
									</div>
									<div class="col-sm-3">
										<h5><b>Avatar</b> 128 * 128px</h5>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-6" id="uploadAvatar">
										Browse
									</div>
								</div>
							</div>
							<br>
							<div class="clearfix"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->
		
		<!-- Modal Send Email  -->
		<div class="example-modal" >
			<div class="modal" id="sendEmail">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Send e-mail to <?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></h4>
						</div>
						<div class="modal-body">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Compose New Message</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="form-group">
										<input class="form-control" placeholder="To:" value="<?php echo $this->data['memberInfo']['email_one']; ?>" id="sendEmailTo">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Subject:" id="sendEmailSubject">
									</div>
									<div class="form-group">
										<textarea id="sendEmailContent" class="form-control" style="height: 300px"></textarea>
									</div>
									<div class="form-group">
										<div class="btn btn-default btn-file">
											<i class="fa fa-paperclip"></i> Attachment
											<input type="file" name="attachment">
										</div>
										<p class="help-block">Max. 32MB</p>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<div class="pull-right">
										<button type="submit" class="btn btn-primary" id="sendEmailOwner"><i class="fa fa-envelope-o"></i> Send</button>
									</div>
								</div>
								<!-- /.box-footer -->
							</div>
							<!-- /. box -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->
		
    	<div class="row">
			<div class="col-md-12">
				<!-- Widget: user widget style 1 -->
				<div class="box box-widget widget-user-2">
				
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-aqua-active">
						<div class="widget-user-image">
							<a href="#" class="avatar-user-change" data-toggle="modal" data-target="#avatarModal" data-keyboard="true">
								<img class="img-circle" id="userAvatarImg" src="<?php echo $img; ?>" alt="User Avatar">
							</a>
						</div><!-- /.widget-user-image -->
						<h3 class="widget-user-username"><strong><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></strong></h3>
						<h5 class="widget-user-desc"><strong><?php echo $this->data['memberInfo']['condo']; ?></strong></h5>
						
						<button type="submit" class="btn btn-danger btn-xs pull-right " id="deleteOwner">Delete owner</button>
						<button type="submit" class="btn btn-primary btn-xs pull-right" id="showEditUser">Update info</button>
						<div class="clearfix"></div>
					</div>
					<div class="box-footer">
						<div class="row">
							<?php if ($this->data['memberInfo']['phone_one']) {?>
							<div class="col-sm-3 border-right">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-phone"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['phone_one']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } if ($this->data['memberInfo']['phone_two']) {?>
							<div class="col-sm-3 border-right">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-phone"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['phone_two']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } if ($this->data['memberInfo']['email_one']) {?>
							<div class="col-sm-3">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-envelope-o"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['email_one']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } if ($this->data['memberInfo']['email_two']) {?>                   
							<div class="col-sm-3">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-envelope-o"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['email_two']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } ?>
						</div><!-- /.row -->
					</div>
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked user-info">
							<?php if ($this->data['memberInfo']['address']) {?>
							<li><span><i class="fa fa-fw fa-map-o"></i> <?php echo $this->data['memberInfo']['address']; ?></span></li>
							<?php } ?>
							<?php if ($this->data['memberInfo']['condo']) {?>
							<li><span><i class="fa fa-fw fa-pie-chart"></i>Percentage <?php echo $this->data['memberInfo']['condo']; ?></span></li>
							<?php } ?>
							<li><span><i class="fa fa-fw fa-sticky-note"></i><strong> <?php echo $this->data['memberInfo']['notes']; ?></strong></span></li>
							<li><span> <button data-target="#sendEmail" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal">Send E-Mail</button></span></li>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div>
    	</div>
    	
		<div class="row edit-user-info">
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">First name</label>
							<input type="hidden" id="memberId" value="<?php echo $this->data['memberInfo']['member_id']; ?>">
							<input type="text" class="form-control" id="memberFirst" placeholder="First Name" value="<?php echo $this->data['memberInfo']['name']; ?>" >
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Last name</label>
							<input type="text" class="form-control" id="memberLast" placeholder="Last Name" value="<?php echo $this->data['memberInfo']['last_name']; ?>" >
						</div>
                        
                        <!-- phone mask -->
						<div class="form-group">
							<label>Phone one:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneOne" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $this->data['memberInfo']['phone_one']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- phone mask -->
						<div class="form-group">
							<label>Phone two:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneTwo" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $this->data['memberInfo']['phone_two']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label>Email one:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailOne" class="form-control" data-inputmask='' id="emailOne" data-mask value="<?php echo $this->data['memberInfo']['email_one']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label>Email two:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailTwo" class="form-control" data-inputmask='' id="emailOne" data-mask value="<?php echo $this->data['memberInfo']['email_two']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Individual percentage </label>
							<input type="text" class="form-control" id="memberCondo" placeholder="Condo" value="<?php echo $this->data['memberInfo']['condo']; ?>">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Address</label>
							<textarea class="form-control" id="memberAddress" rows="3" placeholder="Address ..."><?php echo $this->data['memberInfo']['address']; ?></textarea>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Notes</label>
							<textarea class="form-control" id="notes" rows="5" placeholder="Notes ..."><?php echo $this->data['memberInfo']['notes']; ?></textarea>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="row">
							<div class="col-sm-offset-6 col-sm-2"></div>
							<div class="col-sm-2"><button type="submit" class="btn btn-info pull-right btn-sm" id="updateMember">Update info</button></div>
							<div class="col-sm-2"><button type="submit" class="btn btn-danger pull-right btn-sm" id="cancelEditUser">Cancel</button></div>
						</div>
                  	</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs (Pulled to the right) -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
						<!-- <li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Dropdown <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
							</ul>
						</li> -->
						<li><a href="#tab_1-1" data-toggle="tab">Tasks</a></li>
						<li><a href="#tab_2-2" data-toggle="tab">History</a></li>
						<li><a href="#tab_3-3" data-toggle="tab" id="tabMessageSender" onclick="scrollToBottom();">Messages</a></li>
						<li class="active"><a href="#tab_3-2" data-toggle="tab">Apartments</a></li>
						<li class="pull-left header"><i class="fa fa-th"></i>Admin Owner</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_3-2">
							<?php echo $this->getRoomPanel(); ?>
						</div><!-- /.tab-pane -->
						
						<div class="tab-pane" id="tab_3-3">
							<?php echo $this->getMessagesPanel(); ?>
						</div><!-- /.tab-pane -->
						
						<div class="tab-pane" id="tab_2-2">
							<div class="row">
								<?php echo $this->getHistoryPanel(); ?>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab_1-1">
							<div class="row">
								<?php echo $this->getTaskPanel(); ?>
							</div>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getRoomsHead()
    {
    	ob_start();
    	?>
    	<!-- Select2 -->
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getRoomsScripts()
    {
    	ob_start();
    	?>
		<!-- Select2 -->
    	<script src="/plugins/select2/select2.full.min.js"></script>
		<script type="text/javascript">
		$(function () {
	        //Initialize Select2 Elements
	        $(".select2").select2();
		});
		</script>
    	<script src="/js/rooms.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getRoomsContent()
    {
    	ob_start();
    	?>
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Add Room</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Room name</label>
							<input type="text" class="form-control" id="roomName" placeholder="Room name" value="" >
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Room type</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roomType">
								<?php 
								foreach ($this->data['types'] as $type)
								{
									?>
								<option value="<?php echo $type['room_type_id']; ?>"><?php echo $type['room_type']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Condo</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="condoId">
								<?php 
								foreach ($this->data['condos'] as $type)
								{
									?>
								<option value="<?php echo $type['condo_id']; ?>"><?php echo $type['condo']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Description</label>
							<textarea class="form-control" rows="3" placeholder="Room description ..." id="roomDescription"></textarea>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div>
			</div><!-- /.box-body -->
			
			<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right" id="addRoom">Add room</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-widget widget-user-2">
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="roomsBox">
							<?php 
							if ($this->data['rooms'])
							{
								foreach ($this->data['rooms'] as $room)
								{
									?>
							<li>
								<a href="/edit-room/<?php echo $room['room_id']; ?>/">
									<strong>[<?php echo $room['condo']; ?>]</strong>
									<?php echo $room['room'].' / '.$room['room_type']; ?>
								</a>
							</li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getRoomHead()
    {
    	ob_start();
    	?>
    	<!-- Select2 -->
    	<link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getRoomScripts()
    {
    	ob_start();
    	?>
		<!-- Select2 -->
    	<script src="/plugins/select2/select2.full.min.js"></script>
		<script type="text/javascript">
		$(function () {
	        //Initialize Select2 Elements
	        $(".select2").select2();
		});
		</script>
    	<script src="/js/rooms.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getRoomContent()
    {
    	ob_start();
    	?>
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Update Room</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-4">
						<input type="hidden" id="roomId" value="<?php echo $this->data['room']['room_id']; ?>" >
						<div class="form-group">
							<label for="exampleInputEmail1">Room name</label>
							<input type="text" class="form-control" id="roomName" placeholder="Room name" value="<?php echo $this->data['room']['room']; ?>" >
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Room type</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roomType">
								<?php 
								foreach ($this->data['types'] as $type)
								{
									?>
								<option value="<?php echo $type['room_type_id']; ?>"><?php echo $type['room_type']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Condo</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="condoId">
								<?php 
								foreach ($this->data['condos'] as $type)
								{
									?>
								<option value="<?php echo $type['condo_id']; ?>"><?php echo $type['condo']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Description</label>
							<textarea class="form-control" rows="3" placeholder="Room description ..." id="roomDescription"><?php echo $this->data['room']['description']; ?></textarea>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div>
			</div><!-- /.box-body -->
			
			<div class="box-footer">
				<button type="submit" class="btn btn-danger btn-sm pull-right" id="deleteRoom">Delete room</button>
				<button type="submit" class="btn btn-info btn-sm pull-right" id="updateRoom">Update room</button>
			</div>
		</div>
		
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Add inventory to the room</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Categories</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="categoriesList">
								<?php 
								foreach ($this->data['categories'] as $category)
								{
									?>
								<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Inventory</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="inventoryList">
							<?php 
							if ($this->data['inventory'])
							{
								foreach ($this->data['inventory'] as $inventory)
								{
									?>
								<option value="<?php echo $inventory['inventory_id']; ?>"><?php echo $inventory['inventory']; ?></option>
									<?php
								}
							}
							else 
							{
								?>
								<option value="0">Inventory empty</option>
								<?php 
							}
							?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
			
			<div class="box-footer">
				<button type="submit" class="btn btn-info btn-sm pull-right" id="addRoomInventory">Add inventory</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success box-widget widget-user-2">
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="inventoryBox">
							<?php 
							if ($this->data['roomInventory'])
							{
								foreach ($this->data['roomInventory'] as $inventory)
								{
									?>
							<li><a href="#"><?php echo $inventory['category'].' / '.$inventory['inventory']; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    /**
   	 * The whole list of members
   	 * 
   	 * @return string
   	 */
   	public function getRoomsByCondo()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Recent Owners</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
	                      <th>Member ID</th>
							<th>Name</th>
							<th>Room</th>
							<th>Condo</th>
							<th>Total</th>
							<th>Paid</th>
							<th>Pending</th>
	                    </tr>
	                    <?php 
						foreach ($this->data['members'] as $member)
						{
							?>
						<tr>
							<td>
								<a href="/owner/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/">
									<?php echo $member['member_id']; ?>
								</a>
							</td>
							<td>
								<a href="/owner/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/" class="member-link">
									<?php echo $member['name'].' '.$member['last_name']; ?>
								</a>
							</td>
							<td><?php echo $member['room']; ?></td>
							<td><?php echo $member['condo']; ?></td>
							<td>$ <?php echo $member['total']; ?></td>
							<td>$ <?php echo $member['paid']; ?></td>
							<td>$ <?php echo $member['pending']; ?></td>
						</tr>
							<?php
						}
						?>
	                  </table>
                	</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
   		
   	   	<?php
   	   	$membersRecent = ob_get_contents();
   	   	ob_end_clean();
   	   	return $membersRecent;
   	}
   	
   	public function getEditCompanyHead()
    {
    	ob_start();
    	?>
    	<!-- bootstrap wysihtml5 - text editor -->
  		<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  		<link href="/css/back/uploadfile.css" rel="stylesheet">
  		<link href="/css/back/jquery.drag-n-crop.css" rel="stylesheet" type="text/css">
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getEditCompanyScripts()
    {
    	ob_start();
    	?>
    	<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    	<script src="/js/jquery-ui.min.js"></script>
    	<script src="/js/back/jquery.uploadfile.min.js"></script>
    	<script src="/js/back/imagesloaded.js"></script>
		<script src="/js/back/scale.fix.js"></script>
		<script src="/js/back/jquery.drag-n-crop.js"></script>
		
    	<script type="text/javascript">
    	$(function () {
    	    //bootstrap WYSIHTML5 - text editor
    	    $(".textarea").wysihtml5();
		});

    	<?php 
    	$i 		= 0;
    	$varSub = '';
    			
		foreach ($this->data['belongSubcategories'] as $s)
		{
			$varSub .= "subcategories[".$i."] = ".$s['subcategory'].'; ';
			$i++;
		}
    	    	
		$varLoc = '';
		$i 		= 0;
		foreach ($this->data['companiesLocations'] as $c)
		{
			$varLoc .= "locations[".$i."] = ".$c['ubication'].'; ';
			$i++;
		}
		?>

		var subcategories = new Array(<?php echo count($this->data['belongSubcategories'])?>);
		var locations = new Array(<?php echo count($this->data['companiesLocations'])?>);
    			
    	<?php echo $varSub; ?>
		<?php echo $varLoc; ?>

    	$(document).ready(function()
		{
			checkSubategories(subcategories);
			checkLocations(locations);

			$('#categories a').click(function(){
				changeCategory(this);
			});

			$('#subcategories a').click(function(){
				updateSubcategoriesByCompany(this);
			});

    		$('#locations a').click(function(){
				updateCompanyLocation(this);
			});
		});
  	  
		</script>
		<script src="/js/back/company.js"></script>
		
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getEditCompanyContent()
    {
    	ob_start();
    	?>
    	<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
		<div class="row">
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
						<li><a href="#generalInfo" data-toggle="tab">General</a></li>
						<li><a href="#seoInfo" data-toggle="tab">SEO</a></li>
						<li><a href="#mediaInfo" data-toggle="tab">Media</a></li>
						<li><a href="#contactInfo" data-toggle="tab">Contact</a></li>
						<li><a href="#socialInfo" data-toggle="tab">Social</a></li>
						<li><a href="#eventsInfo" data-toggle="tab">Events</a></li>
						<li><a href="#settingsInfo" data-toggle="tab">Settings</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="profile">
							<div class="row">
								<div class="col-md-12">
									<!-- Widget: user widget style 1 -->
									<div class="box box-widget widget-user-2">
										<!-- Add the bg color to the header using any of the bg-* classes -->
										<div class="widget-user-header bg-aqua-active">
											<div class="widget-user-image">
												<?php 
							   					if ($this->data['company']['logo']['logo'])
							   					{
							   						?>
							   						<img id="companyLogo" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']['logo']; ?>"  />
							   						<?php 
							   					}
							   					else
							   					{
							   						?>
							   						<img id="companyLogo" src="/images/default_item_front.jpg"  width="300" height="150" />
							   						<?php
							   					}
							   					?>
											
											</div>
											<!-- /.widget-user-image -->
											<h3 class="widget-user-username"><?php echo $this->data['company']['general']['name']; ?></h3>
											<h5 class="widget-user-desc"><?php echo $this->data['company']['general']['category_name']; ?></h5>
											<h6 class="widget-user-desc"><?php echo stripslashes($this->data['company']['seo']['description']); ?></h6>
										</div>
										<div class="box-footer no-padding">
											<ul class="nav nav-stacked">
												<?php 
												foreach ($this->data['company']['emails'] as $e)
												{
												?>
												<li><a href="#"><?php echo $e['e_mail']; ?></a></li>
												<?php
												}
												?>
												<?php 
												foreach ($this->data['company']['phones'] as $p)
												{
												?>
												<li><a href="#"><?php echo $p['telephone']; ?></a></li>
												<?php
												}
												?>
												<li><a href="#">Events <span class="pull-right badge bg-blue">31</span></a></li>
												<li></li>
											</ul>
										</div>
									</div>
									<!-- /.widget-user -->
								</div>
								<!-- /.col -->        
							</div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="generalInfo">
							<div class="row">
								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title">About Me</h3>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<strong><i class="fa fa-book margin-r-5"></i> Categories</strong>
										<div class="categoriesSelection">
											<div class="categoriesBox" id="categories">
						   						<ul>
						   							<?php 
						   							foreach ($this->data['categories'] as $category) 
													{
						   								?>
						   								<li><a href="javascript: void(0);" 
						   								<?php 
						   								if ($this->data['company']['general']['category'] == $category['category_id']) {
						   									?>
						   									class="active"
						   									<?php 
						   								}
						   								?>
						   								category_id="<?php echo $category['category_id']; ?>"
						   								><?php echo $category['name']; ?></a></li>
						   								<?php
						   							}
						   							?>
								   				</ul>
						   					</div>
										</div>
										<div class="clear"></div>
										<hr>
										
										<strong><i class="fa fa-book margin-r-5"></i> Subcategories</strong>
										<div class="categoriesBox categoriesSelection" id="subcategories">
					   						<ul>
							   					<?php 
					   							foreach ($this->data['subcategories'] as $subcategory) {
					   								?>
					   								<li><a href="javascript: void(0);" id="sub_<?php echo $subcategory['subcategory_id']; ?>" subcategory="<?php echo $subcategory['subcategory_id']; ?>" ><?php echo $subcategory['name']; ?></a></li>
					   								<?php
					   							}
					   							?>
							   				</ul>
					   					</div>
										<div class="clear"></div>
										<hr>
										
										<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
										<div class="categoriesBox categoriesSelection" id="locations">
					   						<ul>
							   					<?php 
					   							foreach ($this->data['locations'] as $location) {
					   								?>
					   								<li><a href="javascript: void(0);" id="lo_<?php echo $location['location_id']; ?>" location="<?php echo $location['location_id']; ?>"><?php echo $location['name']; ?></a></li>
					   								<?php
					   							}
					   							?>
							   				</ul>
					   					</div>
					   					<div class="clear"></div>
										<hr>
										<form class="form-horizontal">
						                	<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Name</label>
												<div class="col-sm-11">
													<input type="" class="form-control" id="companyName" placeholder="Name" value="<?php echo $this->data['company']['general']['name']; ?>">
												</div>
						                  	</div>
						                  	
						                  	<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Lat & Long</label>
												<div class="col-sm-11">
													<input type="" class="form-control" id="companyLocation" placeholder="Lat & Long" value="<?php echo $this->data['company']['general']['latitude'].','.$this->data['company']['general']['longitude']; ?>">
												</div>
						                  	</div>
						                  	
						                  	<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Description</label>
												<div class="col-sm-11">
													<div class="box-body pad">
														<form>
															<textarea class="textarea" id="company-description" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $this->data['company']['general']['description']; ?></textarea>
														</form>
													</div>
												</div>
											</div>
						                  	
											<div class="form-group">
												<div class="col-sm-offset-1 col-sm-10">
													<button type="submit" class="btn btn-success save-company-info">Save</button>
												</div>
											</div>
						                </form>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="seoInfo">
							<form class="form-horizontal">
								<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Title</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companySeoTitle" placeholder="Title" value="<?php echo $this->data['company']['seo']['title']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Keywords</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companySeoKeywords" placeholder="Keywords" value="<?php echo $this->data['company']['seo']['keywords']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Description</label>
									<div class="col-sm-11">
										<textarea class="form-control" id="companySeoDescription" placeholder="Description"><?php echo $this->data['company']['seo']['description']; ?></textarea>
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button type="submit" class="btn btn-success save-company-seo">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="mediaInfo">
							<div class="row">
								<input type="hidden" id="logoId" value="<?php echo $this->data['company']['logo']['logo_id']; ?>" />
								<input type="hidden" id="companyNameClean" value="<?php echo Tools::slugify($this->data['company']['general']['name']); ?>" />
								
								<div class="col-md-12">
									<div class="mediaSections" >
										<h2>Logo</h2>
										<p class="text-muted">(300px / 150px | JPG)</p>
										
										<div class="">
											<div class="logo-uploader">
												Upload
											</div>
											<div class="logo-box">
												<div style="width: 300px; height:150px" class="crop-container-logo"> <img src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']['logo']; ?>" id="cropLogo" /></div>
											</div>
											<br>
											<div class="form-group">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-success" id="save-crop-logo">Save</button>
												</div>
											</div>
											
											<div class="clr"></div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="mediaSections" >
										<h2>Sliders</h2>
										<p class="text-muted">(1170px / 526px)</p>
										
										<div class="slider-box">
											<div class="company-slider-uploader">
												Upload
											</div>
											<div class="company-slider-upload">
												<div class="crop-box">
													<div style="width: 600px; height:270px" class="crop-container"> <img src="" id="crop-company-slider" /></div>
												</div>
												<br>
												<div class="form-group">
													<div class="col-sm-12">
														<button type="submit" class="btn btn-success" id="save-crop-company-slider">Save</button>
													</div>
												</div>
												
												<div class="clr"></div>
											</div>
											
											<div id="slider-items" class="">
												<?php 
												foreach($this->data['company']['sliders'] as $slider) 
												{
												?>
												<div class="slider-item col-md-4" id="sid-<?php echo $slider['sliders_id']; ?>">
													<header>
														<a href="#" class="button red delete-slider" sid="<?php echo $slider['sliders_id']; ?>">delete</a>
													</header>
													<section>
														<div class="img-container">
										    				<img src="/img-up/companies_pictures/sliders/<?php echo $slider['slider']; ?>" class="img-responsive" />
										    			</div>
													</section>
													<div class="clr"></div>
												</div>
												<?php 
												}
												?>
											</div>
											
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
								
									<div class="mediaSections" >
										<h2>Gallery</h2>
										
										<div class="company-gallery-uploader">
											Upload
										</div>
										
										<div class="company-gallery-grid">
											<?php
											if ($this->data['company']['gallery'])
											{
												foreach($this->data['company']['gallery'] as $g)
												{
												?>
												<div class="image-box" id="cgid-<?php echo $g['picture_id']; ?>">
													<div class="image">		
														<img src="/img-up/companies_pictures/galery/<?php echo $g['picture']; ?>" />
													</div>
													<a href="javascript:void(0);" cgid="<?php echo $g['picture_id']; ?>" class="deleteGallery" >delete</a>
												</div>
												<?php
												}
											}
											?>
											<div class="clr"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="contactInfo">
							<form class="form-horizontal">
								<div id="companyEmails">
									<?php
									if ($this->data['company']['emails'])
									{
										$i = 0;
										foreach ($this->data['company']['emails'] as $e)
										{
										?>
										<div class="form-group">
											<label for="inputName" class="col-sm-1 control-label">Email 
												<?php 
												if ($i == 0)
												{
													?>
												<span id="addEmailField">[+]</span>
													<?php 
												}
												?>
											</label>
											<div class="col-sm-11">
												<input type="text" value="<?php echo $e['e_mail']; ?>" placeholder="email" class="companyEmail form-control" eid="<?php echo $e['e_mail_id']; ?>" />
											</div>
										</div>
										<?php
										$i++;
										}
									}
									else
									{
										?>
										<div class="form-group">
											<label class="col-sm-1 control-label">Email 
												<span id="addEmailField">[+]</span>
											</label>
											<div class="col-sm-11">
												<input type="text" value="" class="companyEmail form-control" eid="0" />
											</div>
										</div>
										<?php 
									}
									?>
								</div>
							
			                  	<div id="companyPhones">
			                  		<?php
									if ($this->data['company']['phones'])
									{
										$i = 0;  						
										foreach ($this->data['company']['phones'] as $p)
										{
										?>
										<div class="form-group">
											<label class="col-sm-1 control-label">Phone
												<?php 
													if ($i == 0)
													{
														?>
													<span id="addPhoneField">[+]</span>
														<?php 
													}
													?>
											</label>
											<div class="col-sm-11">
												<input type="text" value="<?php echo $p['telephone']; ?>" class="companyPhone form-control" pid="<?php echo $p['telephone_id']; ?>" />
											</div>
										</div>
										<?php
										$i++;
										}
									}
									else 
									{
										?>
										<div class="form-group">
											<label class="col-sm-1 control-label">Phone <span id="addPhoneField">[+]</span> </label>
											<div class="col-sm-11">
												<input type="text" value="" class="companyPhone form-control" pid="0" />
											</div>
										</div>
										<?php 
									}
									?>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Website</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyWebsite" placeholder="website" value="<?php echo $this->data['company']['general']['website']; ?>">
									</div>
			                  	</div>
			                  	
			                  	
			                  	<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button type="submit" class="btn btn-success save-company-contact">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="socialInfo">
							<form class="form-horizontal">
								<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Twitter</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyTwitter" placeholder="Twitter" value="<?php echo $this->data['company']['social']['tuit_url']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Facebook</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyFacebook" placeholder="Facebook" value="<?php echo $this->data['company']['seo']['facebook']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Tripadvisor</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyTripadvisor" placeholder="Tripadvisor" value="<?php echo $this->data['company']['seo']['tripadvisor']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Youtube</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyYoutube" placeholder="Youtube" value="<?php echo $this->data['company']['seo']['youtube']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Pinterest</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyPinterest" placeholder="Pinterest" value="<?php echo $this->data['company']['seo']['pinterest']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Instagram</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyInstagram" placeholder="Instagram" value="<?php echo $this->data['company']['seo']['instagram']; ?>">
									</div>
			                  	</div>
			                  	
			                  	
			                  	<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button type="submit" class="btn btn-success save-company-social">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="eventsInfo">
							<form class="form-horizontal">
								events
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="settingsInfo">
							<form class="form-horizontal">
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" id="promote-company" class="btn btn-block btn-info <?php if ($this->data['company']['general']['main_promoted'] == 1){ echo 'bg-purple';} ?>">Main Promoted</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" class="btn btn-block btn-info">Phones Hidden</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" class="btn btn-block btn-info">E-Mails Hidden</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" class="btn btn-block btn-info">Website Hidden</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" id="publish-company" class="btn btn-block btn-info <?php if ($this->data['company']['general']['published'] == 1){ echo 'bg-purple';} ?>">Published</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" id="close-company" class="btn btn-block btn-info <?php if ($this->data['company']['general']['closed'] == 0){ echo 'bg-purple';} ?>">Open</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-2">
										<button type="button" class="btn btn-block btn-danger">Delete</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }   
    
    public function getSectionHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSectionScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSectionContent()
    {
    	ob_start();
    	?>

        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
   	
   	/**
   	 * The very awesome footer!
   	 * 
   	 * <s>useless</s>
   	 * 
   	 * @return string
   	 */
    public function getFooter()
    {
    	ob_start();
    	?>
		<!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Smart Help Desk
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2016 <a href="#"><?php echo $this->data['appInfo']['siteName']; ?></a>.</strong> <?php echo _("All rights reserved"); ?>
        </footer>
    	<?php
    	$footer = ob_get_contents();
    	ob_end_clean();
    	return $footer;
	}
}