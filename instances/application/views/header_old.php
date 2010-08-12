<?php 
/**
 * Header view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php 
		echo html::stylesheet('media/css/style','',true);
		echo html::stylesheet('media/css/google','',true);
		echo html::stylesheet('media/css/jquery-ui-themeroller', '', true);
		echo "<!--[if lte IE 7]>".html::stylesheet('media/css/iehacks','',true)."<![endif]-->";
		echo "<!--[if IE 7]>".html::stylesheet('media/css/ie7hacks','',true)."<![endif]-->";
		echo "<!--[if IE 6]>".html::stylesheet('media/css/ie6hacks','',true)."<![endif]-->";

	// Load OpenLayers before jQuery!
	if ($map_enabled == 'streetmap') {
		echo html::script('media/js/OpenLayers', true);
		echo "<script type=\"text/javascript\">OpenLayers.ImgPath = '".url::base().'media/img/openlayers/'."';</script>";
		//echo 'STREET!';
	}
	
	// Load jQuery
	echo html::script('media/js/jquery', true);
	echo html::script('media/js/jquery.ui.min', true);
	
	// Other stuff to load only we have the map enabled
	if ($map_enabled) {
		echo $api_url . "\n";
		if ($main_page || $this_page == 'alerts') {
			echo html::script('media/js/selectToUISlider.jQuery', true);
		}
		if ($main_page) {
			echo html::script('media/js/jquery.flot', true);
			echo html::script('media/js/timeline', true);
			echo "<!--[if IE]>".
				html::script('media/js/excanvas.pack', true)
				."<![endif]-->";
		}
	}
	
	if ($validator_enabled) {
		echo html::script('media/js/jquery.validate.min');
	}
	
	if ($photoslider_enabled) {
		echo html::script('media/js/photoslider');
		echo html::stylesheet('media/css/photoslider');
	}
	
	if( $videoslider_enabled ) {
		echo html::script('media/js/coda-slider.pack');
		echo html::stylesheet('media/css/videoslider');
	}
	
	// Load ProtoChart
	if ($protochart_enabled)
	{
		echo "<script type=\"text/javascript\">jQuery.noConflict()</script>";
		echo html::script('media/js/protochart/prototype', true);
		echo '<!--[if IE]>';
		echo html::script('media/js/protochart/excanvas-compressed', true);
		echo '<![endif]-->';
		echo html::script('media/js/protochart/ProtoChart', true);
	}
	
	if ($allow_feed == 1) {
		echo "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"http://" . $_SERVER['SERVER_NAME'] . "/feed/\" title=\"RSS2\" />";
	}
	
	//Custom stylesheet
	echo html::stylesheet(url::base().'themes/'.$site_style."/style.css");
	?>

	<!--[if IE 6]>
	<script type="text/javascript" src="js/ie6pngfix.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img, ul, ol, li, div, p, a');</script>
	<![endif]-->
	<script type="text/javascript">
		var addthis_config = {
		   ui_click: true
		}	
		<?php echo $js . "\n"; ?>
	</script>
</head>

<body>

<?php 
	$baseurl = url::base();
	$dot = strpos($baseurl,'.');
	$slash = strpos($baseurl, '/', 7);
	$mainurl = "http://".substr($baseurl,$dot+1, $slash-$dot-1);
?>
<div id="page-container">
  <div id="left-logo-bar">
      <img src="/media/img/logo_01.gif">
  </div>
  <div id="right-page-container">
      <div id="right-header">
	      <img src="/media/img/logo_02.gif" >
      </div>
      <div id="main-nav">
       <ul>
	 <li id="home">
	     <a href="<?php echo $mainurl.'/main';?>">
	     <img name="main" border=0
		   src="/media/img/btn_kiirtihome_default.png" onmouseover = "document.main.src = '/media/img/btn_kiirtihome_hover.png';" onmouseout = "document.main.src = '/media/img/btn_kiirtihome_default.png';">
	     </a>
	 </li>
	 <li id="whatis">
	    <a href="<?php echo $mainurl.'/static/view/whatiskiirti';?>">
	    <img name="whatiskiirti" border=0
		 src="/media/img/btn_whatiskiirti_default.png" onmouseover = "document.whatiskiirti.src = '/media/img/btn_whatiskiirti_hover.png';" onmouseout = "document.whatiskiirti.src = '/media/img/btn_whatiskiirti_default.png';">
	    </a>
	 </li>
	 <li id="supportedcauses">
	    <a href="<?php echo $mainurl.'/static/view/supportedcauses';?>">
	    <img name="supportedcauses" border=0
		 src="/media/img/btn_supportedcauses_default.png" onmouseover = "document.supportedcauses.src = '/media/img/btn_supportedcauses_hover.png';" onmouseout = "document.supportedcauses.src = '/media/img/btn_supportedcauses_default.png';">
	    </a>
	 </li>
	 <li id="getinvolved">
	    <a href="<?php echo $mainurl.'/static/view/getinvolved';?>">
	    <img name="getinvolved" border=0
		 src="/media/img/btn_getinvolved_default.png" onmouseover = "document.getinvolved.src = '/media/img/btn_getinvolved_hover.png';" onmouseout = "document.getinvolved.src = '/media/img/btn_getinvolved_default.png';">
	    </a>
	 </li>
	 <li id="faq">
	    <a href="<?php echo $mainurl.'/static/view/faq';?>">
	    <img name="faq" border=0
		 src="/media/img/btn_faq_default.png" onmouseover = "document.faq.src = '/media/img/btn_faq_hover.png';" onmouseout = "document.faq.src = '/media/img/btn_faq_default.png';">
	    </a>
	 </li>
	 <li id="aboutkiirti">
	    <a href="<?php echo $mainurl.'/static/view/aboutkiirti';?>">
	    <img name="aboutkiirti" border=0
		 src="/media/img/btn_aboutkiirti_default.png" onmouseover = "document.aboutkiirti.src = '/media/img/btn_aboutkiirti_hover.png';" onmouseout = "document.aboutkiirti.src = '/media/img/btn_aboutkiirti_default.png';">
	    </a>
	 </li>
       </ul>
     </div>
<div id="middle-content-container">
     <div id="sub-site-header">
	<div style="padding-top:10px; padding-left:15px;"
     		<span class="title-subsite-header"><?php echo $site_name;?></span><br>
     		<span class="subtitle-subsite-header"><?php echo $site_tagline;?></span>	</div>

	   <div id="subnav">
		<ul>
		<li id="sub-home">
		<a href="<?php echo url::base()."main"?>">Home</a>
		</li>
		<li id="sub-reports">
		<a href="<?php echo url::base()."reports"?>">Reports</a>
		</li>
		<li id="sub-getalerts">
		<a href="<?php echo url::base()."alerts"?>">Get Alerts</a>
		</li>
		<li id="sub-contactus">
		<a href="<?php echo url::base()."contact"?>">Contact Us</a>
		</li>
		<li id="sub-howtohelp">
		<a href="<?php echo url::base()."howtohelp"?>">How To Help</a>
		</li>
		<li id="sub-aboutus">
		<a href="<?php echo url::base()."aboutus"?>">About Us</a>
		</li>
		<li id="sub-submitareport">
		<a href="<?php echo url::base()."submitareport"?>">Submit A Report</a>
		</li>
		</ul>
	  </div>
		
     </div>
	<!-- wrapper -->
	<div class="rapidxwpr floatholder">

		<!-- header -->
		<div id="header">
			<!-- searchbox -->
			<div id="searchbox">
				<a class="share addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4aee423643f8276e">Share</a>

				<!-- languages -->
				<div class="language-box">
					<form>
						<?php print form::dropdown('l', $locales_array, $l, ' onChange="this.form.submit()" '); ?>
					</form>
				</div>
				<!-- / languages -->
			
				<!-- searchform -->
				<div class="search-form">
					<form method="get" id="search" action="<?php echo url::base() . 'search/'; ?>">
						<ul>
							<li><input type="text" name="k" value="" class="text" /></li>
							<li><input type="submit" name="b" class="searchbtn" value="search" /></li>
						</ul>
					</form>
				</div>
				<!-- / searchform -->
		
			</div>
			<!-- / searchbox -->
		
			<!-- logo -->
			<div id="logo">
				<h1><?php echo $site_name; ?></h1>
				<span><?php echo $site_tagline; ?></span>
			</div>
			<!-- / logo -->
		
			<!-- submit incident -->
			<div class="submit-incident clearingfix">
				<a href="<?php echo url::base() . "reports/submit" ?>"><?php echo Kohana::lang('ui_main.submit'); ?></a>
			</div>
			<!-- / submit incident -->
		</div>
		<!-- / header -->

		<!-- main body -->
		<div id="middle">
			<div class="background layoutleft">
		
				<!-- mainmenu -->
				<div id="mainmenu" class="clearingfix">
					<ul>
						<li><a href="<?php echo url::base() . "main" ?>" <?php if ($this_page == 'home') echo 'class="active"'; ?>><?php echo Kohana::lang('ui_main.home'); ?></a></li>
						<li><a href="<?php echo url::base() . "reports" ?>" <?php if ($this_page == 'reports') echo 'class="active"'; ?>><?php echo Kohana::lang('ui_main.reports'); ?></a></li>
						<li><a href="<?php echo url::base() . "reports/submit" ?>" <?php if ($this_page == 'reports_submit') echo 'class="active"'; ?>><?php echo Kohana::lang('ui_main.submit'); ?></a></li>
						<li><a href="<?php echo url::base() . "alerts" ?>" <?php if ($this_page == 'alerts') echo 'class="active"'; ?>><?php echo Kohana::lang('ui_main.alerts'); ?></a></li>
						<?php
						// Contact Page
						if ($site_contact_page)
						{
							?>
							<li><a href="<?php echo url::base() . "contact" ?>" <?php if ($this_page == 'contact') echo 'class="active"'; ?>><?php echo Kohana::lang('ui_main.contact'); ?></a></li>
							<?php
						}
						
						// Help Page
						if ($site_help_page)
						{
							?>
							<li><a href="<?php echo url::base() . "help" ?>" <?php if ($this_page == 'help') echo 'class="active"'; ?>><?php echo Kohana::lang('ui_main.help'); ?></a></li>
							<?php
						}
						
						// Custom Pages
						foreach ($pages as $page)
						{
							$this_active = ($this_page == 'page_'.$page->id) ? 'class="active"' : '';
							echo "<li><a href=\"".url::base()."page/index/".$page->id."\" ".$this_active.">".$page->page_tab."</a></li>";
						}
						?>
					</ul>

				</div>
				<!-- / mainmenu -->
</div>
