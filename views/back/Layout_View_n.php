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