<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/Framework/Tools.php';

class Layout_View
{
	private $data;
	
	public function __construct($data)
	{
		$this->data = $data;
	}    
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param head 		(string) Is the head of the HTML structure
	 * @param header 	(string) Is the menu and logo section
	 * @param bodyType	(string) Is for CSS purposes
	 * @param body		(string) Content of the website
	 * 
	 */
	
	public function printHTMLPage($section)
    {
    ?>
	<!DOCTYPE html>
	<html class='no-js' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<meta charset="utf-8" />
			<meta name="format-detection" content="telephone=no"/>
    		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<?php 
			switch ($section) {
				case 'mainSection':
					echo self::getHead();
				break;
				
				case 'byCategory':
					echo self::getCoverHead();
				break;
				
				case 'byCompany':
					echo self::getCompanyHead();
				break;
			
				case 'map':
					echo self::getMapHead();
				break;
				
				case 'videos':
					echo self::getVideosHead();
				break;
				
				case 'contact':
					echo self::getContactHead();
				break;
				
				case 'search':
					echo self::getSearchHead();
				break;
			
				case 'allEvents':
					echo self::getAllEventsHead();
				break;
				
				default:
				break;
			}
			?>
		</head>
		<body>
			<!-- The Main Wrapper -->
			<div class="page">
			<?php 
			echo self :: getHeader();
			  
			switch ($section) {
				case 'mainSection':
					echo self :: getIndexContent();
				break;
				
				case 'byCategory':
					echo self :: getCoverContent();
				break;
				
				case 'byCompany':
					echo self :: getCompanyContent();
				break;
				
				case 'map':
					echo self :: getMapContent();
				break;
				
				case 'videos':
					echo self :: getVideosContent();
				break;
				
				case 'contact':
					echo self :: getContactContent();
				break;
				
				case 'search':
					echo self :: getSearchContent();
				break;
				
				case 'allEvents':
					echo self :: getAllEventsContent();
				break;
				
				default:
				break;
			}

			echo self::getFooter(); 
			?>
			</div>
			<?php
			echo self::getCommonScripts();
			echo self::getGoogleAnalytics()
			?>
		</body>
		<!-- Google Tag Manager --><noscript><iframe src="http://www.googletagmanager.com/ns.html?id=AIzaSyA_dZD_E9TbBfZeu3x-6vTpxOKOsHJ9pDI" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push( {'gtm.start': new Date().getTime(),event:'gtm.js'} );var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-N7VWVN');</script> <!-- End Google Tag Manager -->
	</html>
    <?php
    }
    
    /**
     * getMainHeader
     *
     * This function returns the headeer of the index, by now, it can
     * receive params like js and css
     *
     * @param NULL
     * @return string $header an html string
     *
     */
    public function getHead()
    {
        ob_start();
        ?>
		<title><?php echo $this->data['appInfo']['title']; ?></title>
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); 
		
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }
    
    public function getCommonDocuments()
    {
    	ob_start();
    	?>
    	<!-- Stylesheets -->
	    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
	    <link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700%7CRoboto:400,300,500,700' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" href="css/material-icons.css">
	    <link rel="stylesheet" href="css/style.css">
	    <!--[if lt IE 10]>
	    <script src="js/html5shiv.min.js"></script>
	    <![endif]-->
    	<?php 
    	$documents = ob_get_contents();
    	ob_end_clean();
    	return $documents; 
    }
    
    public function getCommonScripts()
    {
    	ob_start();
    	?>
    	<!-- Core Scripts -->
		<script src="/js/core.min.js"></script>
		<!-- Additional Functionality Scripts -->
		<script src="/js/script.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getGoogleAnalytics()
	{
		ob_start();
		?>
		<meta name="google-site-verification"
			content="XWQT2lk9oiUbiaKw7UgqRoPGF5OhvDOm7NWYIjWYbKg" />

		<script type="text/javascript">
  			var _gaq = _gaq || [];
  			_gaq.push(['_setAccount', 'UA-9301117-22']);
  			_gaq.push(['_trackPageview']);
			(function() {
   			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  			})();
		</script>
		<?php 
		$google = ob_get_contents();
		ob_end_clean();
		return $google;
	}
    
    /**
     * getHeader
     * 
     * it's the top and main navigation menu
     * 
     * @return string
     */
    public function getHeader()
	{
		ob_start();
		?>
		<!--========================================================
                              HEADER
	    =========================================================-->
	    <header>
	        <!-- RD Navbar -->
	        <div class="rd-navbar-wrap">
	            <nav class="rd-navbar" data-rd-navbar-lg="rd-navbar-static">
	                <div class="rd-navbar-inner">
	                    <!-- RD Navbar Panel -->
	                    <div class="rd-navbar-panel">
	                        <!-- RD Navbar Toggle -->
	                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar"><span></span></button>
	                        <!-- END RD Navbar Toggle -->
	                        <!-- RD Navbar Brand -->
	                        <div class="rd-navbar-brand">
	                            <a href="index.html" class=" text-white text-ubold" alt="<?php echo $this->data['appInfo']['siteName']; ?>">
	                                <span class="brand-name">Where to Go</span>
	                            </a>
	                        </div>
	                        <!-- END RD Navbar Brand -->
	                    </div>
	                    
	                    
	                    <!-- END RD Navbar Panel -->
	                    <div class="rd-navbar-nav-wrap">
	                    	<?php echo self::getTopMenu(); ?>
	                    </div>
	                </div>
	            </nav>
	        </div>
	        <!-- END RD Navbar -->
	        <section>
	            <!-- Swiper -->
	            <div class="swiper-container swiper-slider" data-height="53.75609756097561%" data-min-height="400px" data-autoplay="false" data-loop="false">
	                <div class="swiper-wrapper text-center">
	                	<?php echo self::getSwipes(); ?>
	                </div>
	                <ul class="inline-list text-center">
	                    <li>
	                        <a class="icon-xs fa-twitter" target="_blank" href="http://twitter.com/<?php echo $this->data['appInfo']['twitter']; ?>"></a>
	                    </li>
	                    <li>
	                        <a class="icon-xs fa-facebook-square" target="_blank" href="http://www.facebook.com/<?php echo $this->data['appInfo']['facebook']; ?>></a>
	                    </li>
	                    <li>
	                        <a class="icon-xs fa-pinterest" target="_blank" href="http://www.pinterest.com/<?php echo $this->data['appInfo']['pinterest']; ?>"></a>
	                    </li>
	                    <li>
	                        <a class="icon-xs fa-youtube" target="_blank" href="http://www.youtube.com/user/<?php echo $this->data['appInfo']['youtube']; ?>"></a>
	                    </li>
	                    <li>
	                        <a class="icon-xs fa-instagram" target="_blank" href="http://instagram.com/<?php echo $this->data['appInfo']['instagram']; ?>"></a>
	                    </li>
	                </ul>
	                <!-- Slider Pagination -->
	                <div class="carousel-counter-container">
	                    <div class="current-counter"></div>
	                    <div class="count">/</div>
	                    <div class="carousel-count"></div>
	                </div>
	                <!-- Slider Navigation -->
	                <div class="swiper-button-prev"></div>
	                <div class="swiper-button-next"></div>
	            </div>
	            <!-- END Swiper -->
	        </section>
	    </header>
		
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/mx_MX/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		  $('.messageBody').attr('color', '#fff');
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<?php
		$header = ob_get_contents();
		ob_end_clean();
		return $header;
	}
	
	/**
	 * getTopMenu
	 *
	 * it returns the menu of the categories
	 *
	 * @return string
	 */
	public function getTopMenu()
	{
		ob_start();
		?>
		<!-- RD Navbar Nav -->
		<ul class="rd-navbar-nav">
			<?php
			foreach ($this->data['categories'] as $category)
			{
			?>
			<li>
				<a href="/<?php echo Tools::slugify($category['category_id']); ?>/<?php echo Tools::slugify($category['name']); ?>/"><?php echo $category['name']; ?></a>
				<?php 
				if ($category[0]['subcategories'])
				{
					?>
				<!-- RD Navbar Dropdown -->
				<ul class="rd-navbar-dropdown">
					<?php
					foreach ($category[0]['subcategories'] as $subcategory)
					{
						?>
					<li>
						<a href="index.html#"><?php echo $subcategory['name']; ?></a>
					</li>
						<?php
					}
					?>
				</ul>
				<!-- END RD Navbar Dropdown -->
					<?php
				}
				?>
			</li>
			<?php
			}
			?>
			<li>
				<a href="index-4.html">Mapa</a>
			</li>
			<li>
				<a href="index-5.html">English</a>
			</li>
		</ul>
			<!-- END RD Navbar Nav -->
		<?php
		$topBar = ob_get_contents();
		ob_end_clean();
		return $topBar;
	}
		
	/**
	 * getFooter
	 * 
	 * returns an string with the footer content, this includes categories, 
	 * location, contact info, and some description
	 * 
	 * @return string
	 */
	public function getFooter()
	{
		ob_start();
		?>
		<!--========================================================
                              FOOTER
	    ==========================================================-->
	    <footer class="page-footer text-center text-md-left">
	        <div class="container">
	            <ul class="row index-list-1">
	                <li class="col-md-3 col-sm-6">
	                    <strong><?php echo $this->data['appInfo']['siteName']; ?></strong>
							<ul>
								<?php echo self :: getCategoriesFooter(); ?>
							</ul>
	                </li>
	                <li class="col-md-3 col-sm-6 offset-8">
	                    <strong>Our Other Locations</strong>
							<ul>
							    <?php echo self :: getLocationsFooter(); ?>
							</ul>
	                </li>
	                <li class="col-md-3 col-sm-6 offset-2">
	                    <address class="contact-info">
	                        <dl>
	                            <dt class="display">E-Mail: </dt>
	                            <dd class="display">
	                                <a href="callto:#"> info@wheretogo.com.mx</a>
	                            </dd>
	                        </dl>
	                    </address>
	                </li>
	                <li class="col-md-3 col-sm-6 offset-2">
	                    <address class="contact-info">
	                        <dl>
	                            <dt class="display">Tel&eacute;fono: </dt>
	                            <dd class="display">
	                                <a href="callto:#"> +1 800 559 6580</a>
	                            </dd>
	                        </dl>
	                    </address>
	                </li>
	            </ul>
	            <div class="copyright">
	                <div>
	                <?php echo $this->data['appInfo']['siteName']; ?> &#169; <span id="copyright-year"></span> •
	                <a href='index-6.html'>Privacy Policy</a>
	                <!-- {%FOOTER_LINK} -->
	                </div>
	            </div>
	        </div>
	    </footer>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();
        return $footer;
    }
    
    /**
     * getCategoriesFooter
     * 
     * return the categories, on li, for the footer
     * 
     * @return string
     */
    public function getCategoriesFooter()
    {
    	ob_start();
    	if($this->data['categories'])
    	{
    		foreach ($this->data['categories'] as $category)
    		{
    			?>
    		<li>
    		    <a href="/<?php echo $category['category_id']; ?>/<?php echo Tools::slugify($category['name']); ?>/">
    		        &raquo; <?php echo $category['name']; ?>
    		    </a>
    		    <div class="clear"></div>
    		</li>
    			<?php
    		}
    	}
    	$categories = ob_get_contents();
    	ob_end_clean();
    	return $categories;
    }
    
    /**
     * getLocationsFooter
     * 
     * returns an string with the locations on li
     * 
     * @return string
     */
    public function getLocationsFooter()
    {
    	ob_start();
    	if($this->data['locations'])
    	{
    		foreach ($this->data['locations'] as $location)
    		{
    			?>
    			<li>
    			    <a href="/location/<?php echo $location['location_id']; ?>/<?php echo Tools::slugify($location['name']); ?>/">
    					&raquo; <?php echo $location['name']; ?>
    				</a>
    				<div class="clr"></div>
    			</li>
    			<?php
    		}
    	}
        $locations_footer = ob_get_contents();
        ob_end_clean();
        return $locations_footer;
    }
    
    /**
     * getIndexContent
     * 
     * returns the html for the index section, and only for the index section
     * 
     * @return string html code
     */
    public function getIndexContent()
    {
    	ob_start();
    	?>
    	<!--========================================================
                              CONTENT
	    =========================================================-->
	    <main class="page-content">
	        <!-- Index list -->
	        <section class="text-center">
	            <ul class="row row-no-gutter index-list">
		            
	                <?php echo self :: getItemsPromoted(); ?>
				</ul>
			</section>
			<!-- END Index list -->
			<!-- What we do -->
	        <section class="well-xl-4 hr text-center text-sm-left">
	            <div class="container">
	                <h3 class="text-line-2 text-default-3">Pr&oacute;ximos eventos</h3>
	                <div class="row offset-6">
	                    <div class="col-md-3 col-sm-6 wow fadeInLeft">
	                        <img width="270" height="268" alt="" src="images/page-1_img05.jpg">
	                        <h4><a href="index.html#">Give new ideas</a></h4>
	                        <p class="offset-7 inset-2">
	                            Our main goal is not just to be your adviser, but to give fresh and valuable ideas to make your business grow and develop
	                        </p>
	                    </div>
	                    <div class="col-md-3 col-sm-6 offset-8">
	                        <img width="270" height="268" alt="" src="images/page-1_img06.jpg">
	                        <h4><a href="index.html#">Cooperate with people</a></h4>
	                        <p class="offset-7 inset-2">
	                            Business consulting means working with people. It can turn out advantageous for business if a consultant is using a correct approach to client.
	                        </p>
	                    </div>
	                    <div class="col-md-3 col-sm-6 offset-2">
	                        <img width="270" height="268" alt="" src="images/page-1_img07.jpg">
	                        <h4><a href="index.html#">Professional team</a></h4>
	                        <p class="offset-7 inset-2">
	                            Our team consists only of true specialists whose education and skills were repeatedly tested, so we know how to find a proper specialist.
	                        </p>
	                    </div>
	                    <div class="col-md-3 col-sm-6 offset-2 wow fadeInRight">
	                        <img width="270" height="268" alt="" src="images/page-1_img08.jpg">
	                        <h4><a href="index.html#">Share our knowledge</a></h4>
	                        <p class="offset-7 inset-2">
	                            Each of our experts and specialists has a huge store of business knowledge, that's why we know how to create a competitive company from scratch.
	                        </p>
	                    </div>
	                </div>
	            </div>
	        </section>
	        <!-- END What we do -->
	        <!-- About us -->
	        <section class="well-xl">
	            <div class="container text-center">
	                <h2 class="text-line"><?php echo $this->data['appInfo']['siteName']; ?></h2>
	                <p class="$default-7 font-size-1 offset-1">
	                    <?php echo $this->data['appInfo']['description']; ?>
	                </p>
	            </div>
	        </section>
	        <!-- END About us -->
	        <!-- Clients choose us! -->
	        <section class="well-xl-3 hr text-center text-sm-left">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-4 wow fadeInLeft">
	                        <h3 class="text-line-2 text-default-3">Facebook</h3>
	                        <?php echo self :: getFacebookIndex(); ?>
	                    </div>
	                    <div class="col-md-4 wow fadeInLeft">
	                        <h3 class="text-line-2 text-default-3">Twitter</h3>
	                        <?php echo self :: getTwitterIndex(); ?>
	                    </div>
	                    <div class="col-md-4 wow fadeInLeft">
	                        <h3 class="text-line-2 text-default-3">Videos</h3>
	                        <?php echo  self :: getVideosIndex(); ?>
	                        <a class="btn btn-xs btn-primary-1" href="index.html#">Ver todos<span class="material-icons-chevron_right"></span></a>
	                    </div>
	                </div>
	            </div>
	        </section>
	        <!-- END Clients choose us! -->
	        <!-- Contact us -->
	        <section class="well-xl-6">
	            <div class="container">
	                <h3 class="text-line-2 text-default-3 text-center text-sm-left">Cont&aacute;ctanos</h3>
	                <!-- RD Mailform -->
	                <form class='rd-mailform' method="post" action="http://livedemo00.template-help.com/wt_58825/bat/rd-mailform.php">
	                    <!-- RD Mailform Type -->
	                    <input type="hidden" name="form-type" value="contact"/>
	                    <!-- END RD Mailform Type -->
	                    <fieldset>
	                        <div class="row">
	                            <div class="col-md-6">
	                                <label data-add-placeholder>
	                                    <input type="text"
	                                           name="name"
	                                           placeholder="Nombre"
	                                           data-constraints="@NotEmpty @LettersOnly"/>
	                                </label>
	                            </div>
	                            <div class="col-md-6">
	                                <label data-add-placeholder>
	                                    <input type="text"
	                                           name="email"
	                                           placeholder="Email"
	                                           data-constraints="@NotEmpty @Email"/>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-9">
	                                <label data-add-placeholder>
	                            <textarea name="message" placeholder="Mensaje"
	                                      data-constraints="@NotEmpty"></textarea>
	                                </label>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="mfControls">
	                                    <button class="btn btn-md btn-primary-3" type="submit">Enviar</button>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="mfInfo"></div>
	                    </fieldset>
	                </form>
	                <!-- END RD Mailform -->
	            </div>
	        </section>
	        <!-- END Contact us -->
	        <!-- RD Google Map -->
	        <section>
	            <div class="rd-google-map">
	                <div id="google-map" class="rd-google-map__model" data-zoom="16" data-x="-87.069887"
	                     data-y="20.631863"></div>
	                <ul class="rd-google-map__locations">
	                	<?php 
	                	foreach ($this->data['companies_map'] as $company)
	                	{
	                		?>
	                	<li data-x="<?php echo $company['longitude']; ?>" data-y="<?php echo $company['latitude']; ?>">
	                		<div class="map-info-item">
	                			<div class="map-info-image">
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
								    	<img alt="<?php echo $name; ?>" src="/img-up/companies_pictures/logo/<?php echo $company['logo']; ?>">
								    </a>
	                			</div>
	                			<div class="map-info">
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
	                					<h4><?php echo $company['name']; ?></h4>
	                				</a>
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
	                					<?php echo trim(preg_replace('/\s+/', ' ',str_replace(array("'"), "",$company['seo_description']))); ?>
	                				</a>
	                			</div>
	                		</div>
	                    </li>
	                		<?php
	                	}
	                	?>
	                </ul>
	            </div>
	        </section>
	        <!-- END RD Google Map -->
		</main>
    	
		<?php
		$wideBody = ob_get_contents();
        ob_end_clean();
		return $wideBody;
    }
    
	/**
	 * getSwipes
	 * 
	 * returns the sliders for the mainSection
	 * 
	 * @return string
	 */    	
	public function getSwipes()
	{
		ob_start();
		if ($this->data['mainSliders'])
		{
			foreach($this->data['mainSliders'] as $a)
			{
				$link = 'javascript:void(0)';
				if ($a['link'])
				$link = $a['link'];
				?>
				<div class="swiper-slide" data-slide-bg="/img-up/main-gallery/front/<?php echo $a['name']; ?>" alt="<?php echo $a['title']; ?>">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <p>
                                <?php echo $a['promos']; ?>
                            </p>
                            <a class="btn btn-md btn-primary" href="<?php echo $a['link']; ?>">Leer m&aacute;s</a>
                        </div>
                    </div>
                </div>
				<?php 
			}
		}
		$slides = ob_get_contents();
		ob_end_clean();
		return $slides;
	}
    
	/**
	 * getVideosIndex
	 * 
	 * return the list of videos for the main section
	 * 
	 * @return string
	 */
	public function getVideosIndex()
	{
		ob_start();
		foreach ($this->data['lastTwoVideos'] as $video)
		{
			echo self::getIndexItemVideo($video);
		}
		$videolist = ob_get_contents();
		ob_end_clean();
		return $videolist;
	}
    
	/**
	 * getIndexItemVideo
	 * 
	 * return only one item for the main section videos, it's different from the 
	 * other videos
	 * 
	 * @return string
	 */
	public function getIndexItemVideo($video)
	{
		ob_start();
		$image = str_replace('2.jpg', 'mqdefault.jpg', $video['image']);
		?>
		<div class="item">
			<div class="thumb"> 
				<a  rel="vimeo" href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" class="swipebox-video">
					<img src="<?php echo $image; ?>" 
							alt="<?php $video['title']; ?>"
							/>
				</a>
			</div>
			<span><?php echo $video['duration']; ?></span>
			<div class="clr"></div>
			<a href="http://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>"
					target="_blank" 
					class="title swipebox-video">
				<?php echo $video['title']; ?>
			</a>
			<div class="clr"></div>
		</div>
		<?php	    
		$items = ob_get_contents();
		ob_end_clean();
		return $items;
	}
	
	/**
	 * getFacebookIndex
	 * 
	 * return the facebook bar for the index
	 * 
	 * @return string
	 */
	public function getFacebookIndex()
	{
		ob_start();
		?>
		<div class="fb-like-box" data-href="http://www.facebook.com/<?php echo $this->data['appInfo']['facebook']; ?>"
			data-width="300" data-height="470" data-show-faces="true"
			data-colorscheme="dark" style="color: #111; " 
			data-stream="true" data-show-border="false" data-header="false">
		</div>
		<?php 
		$facebookIndex = ob_get_contents();
		ob_end_clean();
		return $facebookIndex;
	}
    
	/**
	 * getTwitterIndex
	 * 
	 * returns the html for the twitter on the index
	 * 
	 * @return string
	 */
	public function getTwitterIndex()
	{
		ob_start();
		?>
	    <div class="clr"></div>
	    <div id="twitter">
		    <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/<?php $this->data['appInfo']['facebook']; ?>" data-widget-id="373534020283273216">
		    	Tweets by @<?php echo $this->data['appInfo']['facebook']; ?>
		    </a>
			<script>
				!function(d,s,id){
					var js,
					fjs=d.getElementsByTagName(s)[0],
					p=/^http:/.test(d.location)?'http':'https';
					if(!d.getElementById(id))
					{
						js=d.createElement(s);
						js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
						fjs.parentNode.insertBefore(js,fjs);
					}
				}(document,"script","twitter-wjs");
			</script>
	    </div><!-- /Twitter -->
        <?php
        $twitter_box = ob_get_contents();
        ob_end_clean();
        return $twitter_box;
    }
	
	/**
	 * getItemsPromoted
	 * 
	 * return the four manPromoted companies for show at the main section
	 * 
	 * @return string
	 */
    public function getItemsPromoted()
    {
    	ob_start();
    	foreach ($this->data['mainPromoted'] as $company)
    	{
    	?>
    		<li class="col-md-3 col-sm-3">
    			<h3><?php echo $company['category_name']; ?></h3>
				<a href="/company/<?php echo $company['category_id']; ?>/<?php echo Tools::slugify($company['category_name']); ?>/<?php echo $company['company_id']; ?>/<?php echo Tools::slugify($company['name']); ?>/"
    			        class="image-item">
    	        	<div class="img-box">
            		<?php
            			if (!$company['logo'])
            			{
            			?>
            			<img src="images/default_item_front.jpg" 
            			    alt="<?php echo $company['name']; ?>"
    			        />
            			<?php
            			}
            			else
            			{
            			?>
            			<img src="img-up/companies_pictures/logo/<?php echo $company['logo']; ?>" 
            			    alt="<?php echo $company['name']; ?>"
    			        />
            			<?php
            			}
            		?>
    				</div>        	
    			</a>
				<h4><?php echo $company['name']; ?></h4>
				<p>
					<?php echo $company['description']; ?>
				</p>
				<a class="btn btn-xs btn-primary-1" href="/company/<?php echo $company['category_id']; ?>/<?php echo Tools::slugify($company['category_name']); ?>/<?php echo $company['company_id']; ?>/<?php echo Tools::slugify($company['name']); ?>/">Leer m&aacute;s <span class="material-icons-chevron_right"></span></a>
			</li>
    	<?php
    	}
    	$items = ob_get_contents();
    	ob_end_clean();
    	return $items;
    }
    
    /**
     * getCoverHead
     * 
     * returns the header content for the view of categories and subcategories
     * 
     * @param string $css
     * @param string $js
     * @return string
     */
    public function getCoverHead()
    {
    	ob_start();
    	?>
		<title><?php echo $this->data['categoryInfo']['title']; ?> <?php echo $this->data['subcategoryInfo']['name']; ?> | <?php echo $this->data['appInfo']['title']; ?> </title>
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>, <?php echo $this->data['categoryInfo']['name'].' '.$this->data['subcategoryInfo']['name']; ?>" />
		<?php
		if ($this->data['categoryInfo']['description'])
		{
			if ($subcategory['description'])
			{
			?>
		<meta name="description" content="<?php echo $subcategory['description']; ?>">
			<?php
			}
			else
			{
			?>
		<meta name="description" content="<?php echo $this->data['categoryInfo']['description']; ?>">
			<?php
			}
		}
		else
		{
		?>
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<?php
		}
		?>	
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
		<?php
		$head = ob_get_contents();
		ob_end_clean();
		return $head;
	}   
	
	/**
	 * getCoverContent
	 * 
	 * it's basically the grid for the cover section
	 * 
	 * @return string
	 */
	public function getCoverContent()
	{
		ob_start();
		?>
		<?php echo self :: getBackground(); ?>	
		<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
				<?php echo self :: getMenuLeft(); ?>
				<?php echo self :: getGridCompanies(); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php
		$coverBody = ob_get_contents();
		ob_end_clean();
		return $coverBody;
	}
	
	/**
	 * getGridCompanies
	 * 
	 * companies grid, depending of category, subcategory or location
	 * 
	 * @return string
	 */
	
	public function getGridCompanies()
	{
		ob_start();
		?>
		<div id="main_contents">
			<?php
			if ($this->data['categoryInfo'])
			{
			?>
			<h1>
				<a href="/<?php echo $this->data['categoryInfo']['category_id'].'/'.Tools::slugify($this->data['categoryInfo']['name']); ?>/">
					<?php echo $this->data['categoryInfo']['name']; ?> in <?php echo $this->data['appInfo']['location']; ?>
				
				<?php 
				if ($this->data['subcategoryInfo'])
				{
					?>
					 / <?php echo $this->data['subcategoryInfo']['name']; ?>
					<?php
				}
				?>
				</a>
			</h1>
			<div class="clr"></div>
			<h3><?php echo $this->data['appInfo']['siteName']; ?></h3>
			<?php	
			}

			if ($this->data['locationInfo']['name'])
			{
			?>
			<h1 style="text-align: left;">
				<a href="/location/<?php echo $this->data['locationInfo']['location_id'].'/'.Tools::slugify($this->data['locationInfo']['name']); ?>/">
					<?php echo $this->data['locationInfo']['name']; ?>
				</a>
			</h1>
				
			<div class="clr"></div>
			<h3><?php echo $this->data['appInfo']['siteName']; ?></h3>
			<?php	
			}
			?>
			<div id="companies-grid" class='inside cf '>
				<ul class='protips-grid cf'>
				<?php
				foreach ($this->data['companies'] as $c)
				{
					?>
					<li class=''>
						<?php 
						if ($c['closed'] == 1) 
						{
							?>
						<div class="closed">closed</div>
							<?php 
						}
 
						$link = '';
						if ($this->data['subcategoryInfo']) 
						{
							$link = "/company/".$c['category_id']."/".Tools::slugify($c['category'])."/".$this->data['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['subcategoryInfo']['name'])."/".$c['company_id']."/".Tools::slugify($c['name'])."/";
						} else if ($this->data['section'] == 'allEvents' && $this->data['events']) {
							$link = "/events/".$c['company_id']."/".Tools::slugify($c['company_name'])."/".Tools::slugify($c['date'])."/".$c['event_id']."/".Tools::slugify($c['name'])."/"; 
						} else {
							$link = "/company/".$c['category_id']."/".Tools::slugify($c['category'])."/".$c['company_id']."/".Tools::slugify($c['name'])."/";
						}
						?>
						<article class='protip'>
							<header>
								<?php if ($c['date']) { ?><div class="date"><?php echo Tools::formatMYSQLToFront($c['date']); ?></div><?php } ?>
								<div class="img-cover">
									<a href="<?php echo $link; ?>" class="title">	
									<?php 
									if ($c['logo'])
									{
									?>
									    <img src="/img-up/companies_pictures/logo/<?php echo $c['logo']; ?>" 
									        alt="<?php echo $c['name']; ?>" class="protip_li_img"/>
									<?php
									}
									else
									{
									?>
										<img src="/images/default_item_front.jpg" 
										    alt="<?php echo $c['name']; ?>"  class="protip_li_img"/>
									<?php
									}
									?>
									</a>
							    </div>
							</header>
							<a href="<?php echo $link; ?>" class="title"><?php echo $c['name']; ?></a>
							<footer class='cf'>
								<?php echo $c['description']; ?>
							</footer>
						</article>
					</li>
					<?php
				}
				?>
				</ul>
			</div>
		</div><!-- main sections -->
		<div class="clr"></div>
		<?php
		$gridCompanies = ob_get_contents();
		ob_end_clean();
		return $gridCompanies;
	}
	
	/**
	 * getMenuLeft
	 * 
	 * this is the menu that shows the subcategories
	 * 
	 * @return string
	 */
	public function getMenuLeft()
	{
		ob_start();
		?>
		<div id="menu-left">
			<?php
			if ($this->data['subcategories'])
			{
			?>	
			<div id="subcategories_list">
				<ul>
					<?php					
					foreach ($this->data['subcategories'] as $s)
					{ 
					?>
					<li>
						<a href="/<?php echo $this->data['categoryInfo']['category_id'].'/'.Tools::slugify($this->data['categoryInfo']['name']).'/'.$s['subcategory_id'].'/'.Tools::slugify($s['name']); ?>/">
							<?php echo $s['name']; ?>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}
			 
			if ($this->data['locationInfo'])
			{
			?>	
			<div id="subcategories_list">
				<ul>
					<?php					
					foreach ($this->data['categories'] as $c)
					{ 
					?>
					<li>
						<a href="/<?php echo $c['category_id'].'/'.Tools::slugify($c['name']); ?>/">
							<?php echo $c['name']; ?>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}
		
			if ($this->data['section'] == 'other')
			{
			?>
			<div id="subcategories_list" class="other-option-menu">
				<ul>
					<?php					
					foreach ($this->data['categories'] as $c)
					{ 
					?>
					<li>
						<a href="/<?php echo $c['category_id'].'/'.Tools::slugify($c['name']); ?>/">
							<?php echo $c['name']; ?>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}

			if ($this->data['section'] == 'allEvents' && $this->data['events'])
			{
				?>
			<div id="subcategories_list" class="other-option-menu">
				<ul>
				<?php 
				foreach ($this->data['events'] as $years)
				{
					?>
					<li class="year">
					<?php echo $years['year']; ?>
						<ul class="month">
						<?php 
						foreach ($years['months'] as $months)
						{
							?>
							<li>
							<?php echo $months['month']; ?>
								<ul class="day">
								<?php 
								foreach ($months['events'] as $events)
								{
									?>
									<li>
										&raquo; 
										<a href="/events/<?php echo $events['belong_company']; ?>/<?php echo Tools::slugify($events['company_name']); ?>/<?php echo Tools::slugify($events['date']); ?>/<?php echo $events['company_id']; ?>/<?php echo Tools::slugify($events['name']); ?>/">
											<?php echo $events['name']; ?>
										</a>
									</li>
									<?php
								}
								?>
								</ul>
							</li>
							<?php
						}
						?>
						</ul>
					</li>
					<?php
				}
				?>
				</ul>
			</div>
				<?php
			}
			?>
		</div>
		<?php
		$menuLeft = ob_get_contents();
		ob_end_clean();
		return $menuLeft;
	}
	
	/**
	 * getCompanyHead
	 * 
	 * Returns the header for th company section, the script on it it's for the maps
	 * which i cannot embeb in a diferent js document, by now, btw.
	 * 
	 * @return string
	 */
	public function getCompanyHead()
	{
		ob_start();
		?>
		<title><?php echo $this->data['company']['seo']['title']; ?> | <?php echo $this->data['appInfo']['title']; ?></title>
		<meta name="keywords" content="<?php echo $this->data['company']['seo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['company']['seo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		
		<?php echo self::getCommonDocuments(); ?>
		
		<script type="text/javascript" src="/js/front/swipe.js"></script>
		<script type="text/javascript" src="/js/front/jquery.swipebox.js"></script>
		<script type="text/javascript" src="/js/front/init-swipe-companies.js"></script>
		<script type="text/javascript" src="/js/front/init-swipe-box-companies.js"></script>
		
		<?php echo self::getGoogleAnalytics(); ?>
		<?php
		if (is_numeric($this->data['company']['general']['latitude']) && is_numeric($this->data['company']['general']['longitude']))
		{
			if ($this->data['company']['general']['latitude'] !=  0 && $this->data['company']['general']['longitude'] != 0)
			{
			?>
			<script type="text/javascript"
					src="https://maps.google.com/maps/api/js?sensor=true">
			</script>
			<script type="text/javascript">

			
			function initialize() {
				var latlng = new google.maps.LatLng(<?php echo $this->data['company']['general']['latitude']; ?>, <?php echo $this->data['company']['general']['longitude']; ?>);
						
				var myOptions = {
				  zoom: 18,
				  center: latlng,
				  mapTypeId: google.maps.MapTypeId.HYBRID
				};
						
				var map = new google.maps.Map(document.getElementById("map_canvas"),
					myOptions);
					
				var contentString = <?php echo self::getMapCompanyGlobe(); ?>
					
				var infowindow = new google.maps.InfoWindow({
					content: contentString,
					maxWidth: 250
				});
		
				var marker = new google.maps.Marker({
					position: latlng,
					title:"<?php echo $this->data['company']['seo']['title']; ?>"
				});
					  
				marker.setMap(map);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});			  
			}
				
			$(window).load(function() {
				initialize();
			});
			
			</script>
			<?php
			}
		}

        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }
	
    /**
     * getMapCompanyGlobe
     * 
     * returns the item of the globe for the map, by a given lat and long, it 
     * also shows the logo, title and description, as links
     * 
     * @return string
     */
    public function getMapCompanyGlobe()
    {
    	ob_start();
    	?>
	    '<div class="map-company-globe">' +
		    '<div class="map-company-globe-box">' +
			    '<div class="header">' +
				    '<a href="/company/<?php echo $this->data['company']['general']['category'].'/'.Tools::slugify($this->data['company']['general']['category_name']).'/'.$this->data['company']['general']['company_id'].'/'.Tools::slugify($this->data['company']['general']['name']).'/'; ?>">' +
				    '	<?php echo $this->data['company']['general']['name']; ?>' +
				    '</a>' +
			    '</div>' +
			    '<div class="content">' +
				    '<div class="left">' +
					    '<a href="/company/<?php echo $this->data['company']['general']['category'].'/'.Tools::slugify($this->data['company']['general']['category_name']).'/'.$this->data['company']['general']['company_id'].'/'.Tools::slugify($this->data['company']['general']['name']).'/'; ?>">' +
					    	'<img alt="<?php echo $this->data['company']['general']['name']; ?>" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']; ?>">'+
					    	'<?php echo trim(preg_replace('/\s+/', ' ',str_replace(array("'"), "",$this->data['company']['seo']['description']))); ?>' +
					    '</a>'+
				    '</div>' +
				    '<div class="clr"></div>'+
			    '</div>' +
			    '<div class="clr"></div>'+
		    '</div>'+
	    '</div>';
	    <?php 
	    $globe = ob_get_contents();
	    ob_end_clean();
	    return $globe;
    }
    
    /**
     * getCompanyContent
     * 
     * this section returs the content for the map section, it is a listing pins 
     * of all the companies that has their location 
     * 
     * @return string
     */
	public function getCompanyContent()
	{
		ob_start();
		?>
		<?php echo self :: getBackground(); ?>	
		<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
				<div id="x-active-preview-pane">
					<div class="inside cf x-protip-pane">
						<div class="cf fullpage protip-single tip-container x-protip-content" id="x-protip" >
							<?php echo self :: getCompanyArticle(); ?>
							<?php echo self :: getSideBar(); ?>
							<div class="clr"></div>
							<!-- comments here -->
						</div><!-- /x-protip -->
					</div><!-- /inside cf x-protip-pane -->
				</div><!-- /x-active-preview-pane -->
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	/**
	 * getCompanyArticle
	 * 
	 * returns the left section of the company, is where the slider, content and
	 * gallery are located
	 * 
	 * @return string
	 */
	public function getCompanyArticle()
	{
		ob_start();
		?>
		<article class="tip-panel" id="mnwcog">
			<header class="tip-header">
				<h1 class="tip-title" id="companyName"><?php echo $this->data['company']['general']['name']; ?></h1>
				<p class="views">
					<span>
						<?php echo $this->data['company']['general']['category_name']; ?>
						<?php 
						if ($this->data['company']['subcategoryInfo'])
						{
							echo " / ".$this->data['company']['subcategoryInfo']['name'];
						}
						
						if ($this->data['event']['detail'])
						{
							echo Tools::formatMYSQLToFront($this->data['event']['detail']['date']);
							if ($this->data['event']['detail']['date'].' hrs')
								echo ' / '.Tools::formatHourMYSQLToFront($this->data['event']['detail']['time']);
						}
						?> 
					</span>
				</p>
				<?php 
				if ($this->data['belongCompany'])
				{
					$link = "/company/".$this->data['belongCompany']['category']."/".Tools::slugify($this->data['belongCompany']['categoryName'])."/".$this->data['belongCompany']['belongCompanyId']."/".Tools::slugify($this->data['belongCompany']['belongCompanyName'])."/";
					?>
				<div>
					<div class="belong-company">
						<img alt="Ukraine" src="/img-up/companies_pictures/logo/<?php echo $this->data['belongCompany']['logo']; ?>">
						<div class="belong-company-layer">
							<a href="<?php echo $link; ?>">
								<img alt="" class="belong-company-logo" src="/img-up/companies_pictures/logo/<?php echo $this->data['belongCompany']['logo']; ?>">
							</a>
							<div class="bc-right">
								<h1 itemprop="name"><a href="<?php echo $link; ?>"><?php echo $this->data['belongCompany']['info']['title']; ?></a></h1>
								<p class="location">
									<?php echo $this->data['belongCompany']['info']['description']; ?>
								</p>
							</div>
							<div class="user-pro-tip cf">
								<a class="pro-tip-number">
									<span><?php echo $this->data['belongCompany']['totalEvents']; ?></span>
									Events
								</a>
							</div>
						</div>
					</div>
				</div>
					<?php
				}	
				?>			
			</header>
					
			<div class="tip-content">
				<div id="slider-box" class='swipe-companies'>
					<div id="inner-slider" class='swipe-wrap-companies'>
					<?php			
					if ($this->data['company']['sliders'])
					{
						foreach($this->data['company']['sliders'] as $s)
						{
						?>
						<div>
							<img src="/img-up/companies_pictures/sliders/<?php echo $s['slider']; ?>"
								alt="<?php echo $this->data['company']['general']['name']; ?>" 
								title="<?php echo $this->data['company']['general']['name']; ?>" />
						</div>
						<?php
						}
					}
					?>				
					</div>
				</div>
				<div class="clr"></div>
				<!--<h3>Description</h3>-->
				<div id="description_prev">
					<?php echo stripslashes($this->data['company']['general']['description']); ?>
				</div>
									
				<div id="company-gallerys">
					<div id="extra-content-box">
						<div id="extra-content">
							<div id="company-gallery">
							<?php
							foreach($this->data['company']['gallery'] as $g)
							{
							?>
								<div class="image">		
									<a href="/img-up/companies_pictures/original/<?php echo $g['picture']; ?>"
											class="swipebox" rel="<?php echo $general['name']; ?>">
										<img src="/img-up/companies_pictures/galery/<?php echo $g['picture']; ?>" 
												alt="<?php echo $this->data['company']['general']['name']; ?>">
									</a>
								</div>
							<?php
							}
							?>
							<div class="clr"></div>
							</div>
						</div>
					</div>
											
					<div class="clr"></div>
				</div>
				<div class="clr"></div>
				<!--<h3>Videos</h3>-->
				<?php
				if (is_numeric($this->data['company']['general']['latitude']) && is_numeric($this->data['company']['general']['longitude']))
				{
					if ($this->data['company']['general']['latitude'] !=  0 && $this->data['company']['general']['longitude'] != 0)
					{
				?>					
				<div id="map_canvas"></div>
				<?php 
					}
				}
				?>					
				<div class="clr"></div>
								
			</div> <!-- /tip-content -->
		</article> <!--/article tip-panel -->
		<?php
		$article = ob_get_contents();
		ob_end_clean();
		return $article;
	}
	
	/**
	 * getSideBar
	 * 
	 * is the right section of the company content, where is the logo, networks, contact
	 * and others... 
	 * 
	 * @return string
	 */
	public function getSideBar()
	{
		ob_start();
		?>
		<aside class="tip-sidebar">
			<div class="user-box">
				<div class="team-box" >
					<div class="image-top">
						<img alt="<?php echo $this->data['company']['general']['name']; ?>" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']; ?>" />
					</div>
				</div>
				<p class="bio">
					<?php echo $this->data['company']['seo']['title']; ?>
				</p>
				<p class="bio">
					<?php echo stripslashes($this->data['company']['seo']['description']); ?>
				</p>
			</div><!-- /user-box -->
			<div class="side-btm">
				<?php 
				if ($this->data['events'])
				{
					?>
				<div class="events-list">
					<h3>Events</h3>
					<ul>
					<?php 
					foreach ($this->data['events'] as $years)
					{
						?>
						<li class="year">
						<?php echo $years['year']; ?>
							<ul class="month">
							<?php 
							foreach ($years['months'] as $months)
							{
								?>
								<li>
								<?php echo $months['month']; ?>
									<ul class="day">
									<?php 
									foreach ($months['events'] as $events)
									{
										?>
										<li>&raquo; 
											<a href="/events/<?php echo $events['company_id']; ?>/<?php echo Tools::slugify($events['name']); ?>/<?php echo Tools::slugify($events['date']); ?>/<?php echo $events['event_id']; ?>/<?php echo Tools::slugify($events['name']); ?>/">
												<?php echo $events['name']; ?>
											</a>
										</li>
										<?php
									}
									?>
									</ul>
								</li>
								<?php
							}
							?>
							</ul>
						</li>
						<?php
					}
					?>
					</ul>
				</div>
					<?php
				}
				?>
				
				<h3>Networks</h3>
				<ul class="side-bar-list side-bar-networks">
					<div class="clr"></div>
					
					<nav class="social-networks-box">
						<ul>
							<?php 
							if ($this->data['company']['social']['facebook'])
							{
								?>
							<li>
								<a href="http://www.facebook.com/<?php echo $this->data['company']['social']['facebook']; ?>/" target="_blank">
									<img src="/images/facebook.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Facebook">
								</a>
							</li>
								<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['social']['tuit_url'])
							{
								?>
							<li>
								<a href="http://www.twitter.com/<?php echo $this->data['company']['social']['tuit_url']; ?>/" target="_blank">
									<img src="/images/twitter.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Twitter">
								</a>
							</li>
								<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['social']['youtube'])
							{
								?>
							<li>
								<a href="http://www.youtube.com/user/<?php echo $this->data['company']['social']['facebook']; ?>/" target="_blank">
									<img src="/images/youtube.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Youtube">
								</a>
							</li>
								<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['social']['pinterest'])
							{
								?>
							<li>
								<a href="http://www.pinterest.com/<?php echo $this->data['company']['social']['pinterest']; ?>/" target="_blank">
									<img src="/images/pinterest.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Pinterest">
								</a>
							</li>
								<?php 
							}
							?>

							<?php 
							if ($this->data['company']['social']['instagram'])
							{
								?>
							<li>
								<a href="http://instagram.com/<?php echo $this->data['company']['social']['instagram']; ?>/" target="_blank">
									<img src="/images/instagram.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Instagram">
								</a>
							</li>
								<?php 
							}
							?>
							
							<div class="clr"></div>
						</ul>
					</nav>
				
					<div class="clr"></div>
					<?php
					if ($this->data['company']['social']['facebook'])
					{
					?>
					<div class="fb-like-box" id="facebook-companies" data-href="http://www.facebook.com/<?php echo $this->data['company']['social']['facebook']; ?>"
							data-width="244" data-height="350" data-show-faces="true"
							data-colorscheme="dark" style="background-color: #373737;" 
							data-stream="true" data-show-border="false" data-header="false">
					</div>
					<?php	
					}
					?>
				</ul>
				<div class="team-box">
					<div class="image-top">
						<img alt="<?php echo $this->data['company']['seo']['title']; ?>" src="/img-up/companies_pictures/sliders/<?php echo $this->data['company']['lastSlider']; ?>">
					</div>
					<div class="content">
						<h4>Contact Info</h4>
						<?php 
						foreach ($this->data['company']['emails'] as $e)
						{
						?>
						<p><?php echo $e['e_mail']; ?></p>
						<?php
						}
							    						
						foreach ($this->data['company']['phones'] as $p)
						{
						?>
						<a href="tel:<?php echo $p['telephone']; ?>" ><?php echo $p['telephone']; ?></a>
						<div class="clr"></div>
						<?php
						}
						?>
						
						<a href="<?php echo $this->data['company']['general']['website']; ?>" target="_blank" >
							<?php echo $this->data['company']['general']['website']; ?>
						</a>
						<div class="clr"></div>
					</div>
				</div>
				
				<?php 
				if ($this->data['company']['subcategoryInfo'])
				{
					$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$this->data['company']['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['company']['subcategoryInfo']['name'])."/";
					?>
				<ul class="companies-list">
					<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="<?php echo $link; ?>">
						<?php echo $this->data['company']['subcategoryInfo']['name']; ?>
					</a>
					<?php
					foreach ($this->data['companies'] as $c)
					{
						$link = "/company/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$this->data['company']['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['company']['subcategoryInfo']['name'])."/".$c['company_id']."/".Tools::slugify($c['name'])."/";
					?>
					<li><a href="<?php echo $link; ?>">&raquo; <?php echo $c['name']; ?></a></li>
					<?php 
					}
					?>
				</ul>
					<?php
				}
				?>
				
				<?php 
				if ($this->data['subcategories'])
				{
					$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/";
					?>
				<ul class="companies-list">
					<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="<?php echo $link; ?>">
						<?php echo $this->data['company']['general']['category_name']; ?>
					</a>
					<?php
					foreach ($this->data['subcategories'] as $s)
					{
						$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$s['subcategory_id']."/".Tools::slugify($s['name'])."/";
					?>
					<li><a href="<?php echo $link;?>">&raquo; <?php echo $s['name']; ?></a></li>
					<?php 
					}
					?>
				</ul>
					<?php
				}
				?>
				
				<?php 
				if ($this->data['categories'])
				{
					?>
				<ul class="companies-list">
					<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="/">
						Find more
					</a>
					<?php
					foreach ($this->data['categories'] as $c)
					{
						$link = "/".$c['category_id']."/".Tools::slugify($c['name'])."/";
					?>
					<li><a href="<?php echo $link;?>">&raquo; <?php echo $c['name']; ?></a></li>
					<?php 
					}
					?>
				</ul>
					<?php
				}
				?>
			</div> <!-- /side-btm -->
		</aside><!-- right side -->
		<?php
		$sideBar = ob_get_contents();
		ob_end_clean();
		return $sideBar;
	}
	
    /**
     * getMapHead
     * 
     * is the head section for the maps, it also generates an script for the map 
     * array, and calls the globe.
     * 
     * @return string
     */        
	public function getMapHead()
	{
		ob_start();
		?>
		
		<title><?php echo $this->data['appInfo']['title']; ?> | Map of the companies</title>
		
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
			
		<script type="text/javascript"
			src="https://maps.google.com/maps/api/js?sensor=true">
		</script>
				
		<script type="text/javascript">
		function initialize() {
					
			var locations = [
			<?php
			$i = 0;
			
			foreach ($this->data['companies'] as $c)
			{
				$i++;
				?>
				[<?php echo self::getMapGeneralGlobe($c['category'], $c['category_name'], $c['company_id'], $c['name'], $c['logo'], $c['seo_description']); ?>, <?php echo $c['latitude']; ?>, <?php echo $c['longitude']; ?>, <?php echo $i; ?>],
				<?php
			}
			?>
			];
		
			var map = new google.maps.Map(document.getElementById('general_map'), {
			  zoom: 10,
			  center: new google.maps.LatLng(20.6348323822,-87.0751495361),
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
		
			var infowindow = new google.maps.InfoWindow();
	
			var marker, i;
		
			for (i = 0; i < locations.length; i++) {  
			  	marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map
			  });
		
				  google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.open(map, marker);
					}
				  })(marker, i));
			}
		}
			
		$(document).ready(function() {
			initialize();
		});
		</script>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }	
	
    /**
     * getMapCompanyGlobe
     *
     * retunrs the globe item where it's displayed the logo, the description and
     * the title of the companies, also it's a link for it's company view
     *
     * @return string
     */
    public function getMapGeneralGlobe($categoryId, $categoryName, $companyId, $name, $logo, $description)
    {
    	ob_start();
    	?>
	    '<div class="map-company-globe">' +
		    '<div class="map-company-globe-box">' +
			    '<div class="header">' +
				    '<a href="/company/<?php echo $categoryId.'/'.Tools::slugify($categoryName).'/'.$companyId.'/'.Tools::slugify($name).'/'; ?>">' +
				    	'<?php echo $name; ?>' +
				    '</a>' +
			    '</div>' +
			    '<div class="content">' +
				    '<div class="left">' +
					    '<a href="/company/<?php echo $categoryId.'/'.Tools::slugify($categoryName).'/'.$companyId.'/'.Tools::slugify($name).'/'; ?>">' +
					    	'<img alt="<?php echo $name; ?>" src="/img-up/companies_pictures/logo/<?php echo $logo; ?>">'+
					    '<?php echo trim(preg_replace('/\s+/', ' ',str_replace(array("'"), "",$description))); ?>'+
					    '</a>'+
				    '</div>' +
				    '<div class="clr"></div>'+
			    '</div>' +
			    '<div class="clr"></div>'+
		    '</div>'+
	    '</div>'
	    <?php 
	    $globe = ob_get_contents();
	    ob_end_clean();
	    return $globe;
    }

    /**
     * getMapContent
     * 
     * it returns the HTML string for the map section
     * 
     * @return string
     */
    public function getMapContent()
    {
    	ob_start();
    	?>
    	<?php echo self :: getBackground(); ?>
    	<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
		    	<div id="wrapper">
		    		<div id="content">
		    			<div id="box_map">
		    				<div id="general_map"></div>
		    			</div>
		    		</div>
		    		<div class="clr"></div>
		    	</div>
    		</div>
			<div class="clr"></div>
		</div>	
    	<?php
    	$coverBody = ob_get_contents();
    	ob_end_clean();
    	return $coverBody;
    }
    
    /**
     * getVideosHead
     *
     * is the head section for the videos
     *
     * @return string
     */
    public function getVideosHead()
    {
    	ob_start();
    	?>
    	<title><?php echo $this->data['appInfo']['title']; ?> | Videos</title>
    	
    	<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
    	<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
    	<meta property="og:type" content="website" /> 
    	<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
    	<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
    	<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
    	<?php echo self::getCommonDocuments(); ?>
    	<?php echo self::getGoogleAnalytics(); ?>
    	<script type="text/javascript" src="/js/front/jquery.swipebox.js"></script>
		<script type="text/javascript" src="/js/front/init-swipe-box-videos.js"></script>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }	
	
    /**
     * getVideosContent
     *
     * it's basically the grid for the videos section
     *
     * @return string
     */
    public function getVideosContent()
    {
    	ob_start();
    	?>
    	<?php echo self :: getBackground(); ?>	
    	<div id="main-grid" class='inside cf'>
    		<div class="main-wrapper-bg" style="">
    			<?php echo self :: getMenuLeft(); ?>
    			<?php echo self :: getVideos(); ?>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<?php
    	$coverBody = ob_get_contents();
    	ob_end_clean();
    	return $coverBody;
   	}
    
   	/**
   	 * getVideos
   	 * 
   	 * return an array with all the videos published, ASC order
   	 * 
   	 * @return string
   	 */
	public function getVideos()
	{
		ob_start();
		?>
		<div id="main_contents">
			<h1>
				<a href="/videos/">
					Videos
				</a>
			</h1>
			<div class="clr"></div>
			<h3><?php echo $this->data['appInfo']['siteName']; ?></h3>
			
			<div class="clr"></div>
			
			<ul class="videos swipebox-video">
				<?php 
				foreach ($this->data['videos'] as $video)
				{
				$image = str_replace('2.jpg', 'mqdefault.jpg', $video['image']);
				?>
				<li>
					<article class='protip'>
						<header>
							<div class="img-cover">	
								<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" rel="youtube" class="title">
									<img src="<?php echo $image; ?>"
											alt="<?php $video['title']; ?>"  class="protip_li_img"/>
								</a>
							</div>
						</header>
						<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" rel="youtube" class="title " style="font-size: 1.2em; font-weight: bold;">
							<?php echo $video['title']; ?>
						</a>
						<footer class='cf'>
							<?php echo $video['content']; ?>
						</footer>
					</article>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
		<?php	    
		$videos = ob_get_contents();
		ob_end_clean();
		return $videos;
	}

	/**
	 * getVideosHead
	 *
	 * is the head section for the videos
	 *
	 * @return string
	 */
	public function getContactHead()
	{
		ob_start();
		?>
    	<title><?php echo $this->data['appInfo']['title']; ?> | Contact</title>
    	
    	<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
    	<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
    	<meta property="og:type" content="website" /> 
    	<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
    	<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
    	<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
    	<?php echo self::getCommonDocuments(); ?>
    	<?php echo self::getGoogleAnalytics(); ?>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }
    
    /**
     * getContactContent
     *
     * it's basically the grid for the contact section
     *
     * @return string
     */
    public function getContactContent()
    {
    	ob_start();
    	?>
       	<?php echo self :: getBackground(); ?>	
       	<div id="main-grid" class='inside cf'>
       		<div class="main-wrapper-bg" style="">
       			<?php echo self :: getMenuLeft(); ?>
       			<?php echo self :: getContactForm(); ?>
       		</div>
       		<div class="clear"></div>
       	</div>
       	<?php
       	$coverBody = ob_get_contents();
       	ob_end_clean();
       	return $coverBody;
    }
	
    /**
     * getContactForm
     * 
     * the contact form
     * 
     * @return string
     */
    public function getContactForm()
    {
    	ob_start();
    	?>
        <div id="main_contents">
			<h1>
				<a href="/videos/">
					Contact Us
				</a>
			</h1>
			<div class="clr"></div>
			<h3><?php echo $this->data['appInfo']['siteName']; ?></h3>
			
			<div class="clr"></div>
    		<div id="contact_box">
    			<form id="contact-form">
					<div class="success-message">Contact form submitted! <strong>We will be in touch soon.</strong></div>
					<div class="wrapper">
						<label class="name">
							<input id="name" type="text" placeholder="Name*:" data-constraints="@Required @JustLetters" />
							<span class="empty-message">*This field is required.</span>
							<span class="error-message">*This is not a valid name.</span>
						</label>
						<label class="email">
							<input id="email" type="text" placeholder="Email*:" data-constraints="@Required @Email" />
							<span class="empty-message">*This field is required.</span>
							<span class="error-message">*This is not a valid email.</span>
						</label>
						<label class="phone">
							<input id="phone" type="text" placeholder="Phone:" data-constraints="@Required @JustNumbers"/>
							<span class="empty-message">*This field is required.</span>
							<span class="error-message">*This is not a valid phone.</span>
						</label>
					</div>
					<label class="message">
						<textarea id="message" placeholder="Message:" data-constraints='@Required @Length(min=20,max=999999)'></textarea>
						<span class="empty-message">*This field is required.</span>
						<span class="error-message">*The message is too short.</span>
					</label>
					<div  class="form_btns">
						<a href="/#" data-type="reset" class="more_btn">clear</a>
						<a href="/#" data-type="submit" class="more_btn">submit</a>
					</div>  
					<div class="clr"></div
				</form>
    		</div>
    	</div><!-- main sections -->
    	<div class="clr"></div>
        <?php
       	$contactForm = ob_get_contents();
       	ob_end_clean();
    	return $contactForm;
    }
    
	/**
	 * getSearchHead
	 *
	 * is the head section for the videos
	 *
	 * @return string
	 */
	public function getSearchHead()
	{
		ob_start();
		?>
    	<title><?php echo $this->data['appInfo']['title']; ?> | Search</title>
    	
    	<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
    	<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
    	<meta property="og:type" content="website" /> 
    	<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
    	<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
    	<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
    	<?php echo self::getCommonDocuments(); ?>
    	<?php echo self::getGoogleAnalytics(); ?>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }

    /**
     * getCompanyContent
     *
     * this section returs the content for the map section, it is a listing pins
     * of all the companies that has their location
     *
     * @return string
     */
    public function getSearchContent()
    {
    	ob_start();
    	?>
    	<?php echo self :: getBackground(); ?>	
		<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
				<?php echo self :: getMenuLeft(); ?>
				<?php echo self :: getSearchResults(); ?>
			</div>
			<div class="clear"></div>
		</div>
    	<?php
    	$content = ob_get_contents();
    	ob_end_clean();
    	return $content;
    }
    
    /**
     * returns the box content for the results found
     * @return string
     */
	public function getSearchResults()
	{
		ob_start();
        ?>
        <div id="main_contents">
			<h1 style="text-align: left; line-height: 28px;">
				<span>Results for "<?php echo $this->data['searchData']['term']; ?>"</span>
			</h1>
			
			<div class="clr"></div>
			<h3 style="text-align: left;"><?php echo $this->data['appInfo']['siteName']; ?></h3>
		<?php
		if($this->data['companies'])
		{
		?>
			<div id="companies-grid" class='inside cf '>
				<ul class='protips-grid cf'>
				<?php
				foreach($this->data['companies'] as $item)
				{
					echo self::getResItem($item, $this->data['searchData']['term']);
				}
				?>			
				</ul>
			</div>
			
			<div class="clear"></div>
			
			<!-- <div id="pagination">
			<?php
			$nItems = 10;
			$from 	= $this->data['dataSearch']['from'];
			?>
                <ul class="pgn01 grey">
					<?php
					for ($i = 0; $i<=floor($total/$nItems); $i++)
					{
						if (($from/$nItems) == $i)
						{
						?>
						<li class="current">
							<span>
								<?php echo $i+1; ?>
							</span>
						</li>					
						<?php
						}
						else
						{
						?>
						<li>
							<a href="/search/in-all/site/<?php echo Tools::slugify($term).'/'.($nItems*$i); ?>">
								<?php echo $i+1; ?>
							</a>
						</li>
						<?php
						}
					}
					?>
                </ul>
			</div> -->
			<!-- /pagination -->
		<?php
		}
		else
		{
		?>
			<div class="clr"></div>
			<h3 style="text-align: center; color: darkred; margin-top: 50px;"> No results for this term.</h3>
		<?php	
		}
		?>	
        </div><!-- main sections -->
		<div class="clr"></div>
        <?php
        $videolist = ob_get_contents();
        ob_end_clean();
        return $videolist;
	}
	
	/**
	 * items for the search result
	 * @param unknown $r
	 * @param unknown $term
	 * @return string
	 */
	public function getResItem($r, $term)
	{
		ob_start();
		$description 	= strip_tags($r['description']);
		$title 			= $r['name'];
		
		$size 			= strlen($description);
		$pos 			= stripos($description, $term);
		$show 			= '';
		$sizeTerm 		= strlen($term);
		
		if ($pos > -1)
		{
			$preEnd 		= $pos + $sizeTerm;
			$beforeTerm 	= substr($description, 0, $pos - 1);
			$indexSpaces 	= explode(' ', $beforeTerm);;
			$lastWord 		= end($indexSpaces);
			$longLastWord 	= strlen($lastWord);
			$start 			= $pos - $longLastWord;
			$lastLong 		= 150 - $sizeTerm - $longLastWord;
			$end 			= $preEnd + $lastLong;
			$show 			= substr($description, $start - 1, $lastLong);
			$realTerm 		= substr($description, $pos, $sizeTerm);
			$show 			= str_replace($realTerm, '<strong>'.$realTerm.'</strong>', $show);
		}
		else
		{
			$show 			= substr($description, 0, 150);
		}

		$posTitle = stripos($title, $term);
		
		if ($posTitle > -1)
		{
			$realTermTitle 	= substr($title, $posTitle, $sizeTerm);
			$title 			= str_replace($realTermTitle, '<strong>'.$realTermTitle.'</strong>', $title);	
		}
		$link = "/company/".$r['category']."/".Tools::slugify($r['category_name'])."/".$r['company_id']."/".Tools::slugify($r['name'])."/";
		?>
		<li>
			<article class='protip'>
				<header>
					<div class="img-cover">	
					<?php 
					if ($r['logo'])
					{
					?>
						<a href="<?php echo $link; ?>" class="title hyphenate track x-mode-popup" data-action="view protip" data-from="mini protip">
							<img src="/img-up/companies_pictures/logo/<?php echo $r['logo']; ?>" 
								alt="<?php echo $r['name']; ?>" class="protip_li_img"/>
						</a>
					<?php
					}
					else
					{
					?>
						<a href="<?php echo $link; ?>" class="title hyphenate track x-mode-popup" data-action="view protip" data-from="mini protip">
							<img src="/images/default_item_front.jpg" 
								alt="<?php echo $r['name']; ?>"  class="protip_li_img"/>
						</a>
					<?php
					}
					?>
					</div>
				</header>
				<a href="<?php echo $link; ?>"  class="title hyphenate track x-mode-popup" data-action="view protip" data-from="mini protip" >
					<?php echo $title; ?>
				</a>
				<footer class='cf search-tile'>
						<?php echo $show.' ...'; ?>
				</footer>
			</article>
		</li>
		
		<?php
		$item = ob_get_contents();
		ob_end_clean();
		return $item;
	}
	
	/**
	 * getEventsHead
	 *
	 * is the head section for the videos
	 *
	 * @return string
	 */
	public function getAllEventsHead()
	{
		ob_start();
		?>
		<title><?php echo $this->data['appInfo']['title']; ?> | Events</title>
			    	
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
		    		
		<?php
		$head = ob_get_contents();
		ob_end_clean();
		return $head;
	}
	
	/**
	* getCompanyContent
	*
	* this section returs the content for the map section, it is a listing pins
	* of all the companies that has their location
	*
	* @return string
	*/
	public function getAllEventsContent()
	{
		ob_start();
		?>
		<?php echo self :: getBackground(); ?>	
		<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
				<?php echo self :: getMenuLeft(); ?>
				<?php echo self :: getGridCompanies(); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}	
	
}
