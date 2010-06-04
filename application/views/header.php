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
	//echo html::stylesheet(url::base().'themes/'.$site_style."/style.css");
	//?>

	<!--[if IE 6]>
	<script type="text/javascript" src="media/js/ie6pngfix.js"></script>
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
  <div id="page-container">
    <div id="left-logo-bar">
	<img src="/media/img/logo_01.gif">
    </div>
    <div id="right-page-container">
	<div id="right-header">
	    <table cellpadding=0 cellspacing= 0 border= 0>
	    <tr><td width= 580 valign= top>
	    <img src="/media/img/logo_02.gif" >
	    </td><td valign= center align= right>
            <span class="copy">
		<u>TO REPORT AN ISSUE</u><br>
		call: <b>+91-512-302-6888</b><br>
		text: <b>kiirti {message}</b> to <b>56677</b><br>
		email: <a href="mailto:contact@kiirti.org">contact@kiirti.org</a>
            </span>
	    </td></tr></table>
        </div>
	<div id="main-nav">
	 <ul>
	   <li id="home">
	       <a href="/main">
               <img name="main" border=0
                <?php 
		   if ($this_page == "home") {
		     echo 'src="/media/img/btn_kiirtihome_down.png">'; 
		   }
                   else {
                     echo 'src="/media/img/btn_kiirtihome_default.png" onmouseover = "document.main.src = \'/media/img/btn_kiirtihome_hover.png\';" onmouseout = "document.main.src = \'/media/img/btn_kiirtihome_default.png\';">';
                   }
                ?>
               </a>
	   </li>
	   <li id="whatis">
              <a href="/static/view/whatiskiirti">
              <img name="whatiskiirti" border=0
	      <?php 
		 if ($this_page == "whatiskiirti") {
		   echo 'src="/media/img/btn_whatiskiirti_down.png">'; 
		 }
		 else {
		   echo 'src="/media/img/btn_whatiskiirti_default.png" onmouseover = "document.whatiskiirti.src = \'/media/img/btn_whatiskiirti_hover.png\';" onmouseout = "document.whatiskiirti.src = \'/media/img/btn_whatiskiirti_default.png\';">';
		 }
	      ?>
              </a>
           </li>
	   <li id="supportedcauses">
              <a href="/static/view/supportedcauses">
              <img name="supportedcauses" border=0
	      <?php 
		 if ($this_page == "supportedcauses") {
		   echo 'src="/media/img/btn_supportedcauses_down.png">'; 
		 }
		 else {
		   echo 'src="/media/img/btn_supportedcauses_default.png" onmouseover = "document.supportedcauses.src = \'/media/img/btn_supportedcauses_hover.png\';" onmouseout = "document.supportedcauses.src = \'/media/img/btn_supportedcauses_default.png\';">';
		 }
	      ?>
              </a>
           </li>
           <li id="getinvolved">
              <a href="/static/view/getinvolved">
              <img name="getinvolved" border=0
	      <?php 
		 if ($this_page == "getinvolved") {
		   echo 'src="/media/img/btn_getinvolved_down.png">'; 
		 }
		 else {
		   echo 'src="/media/img/btn_getinvolved_default.png" onmouseover = "document.getinvolved.src = \'/media/img/btn_getinvolved_hover.png\';" onmouseout = "document.getinvolved.src = \'/media/img/btn_getinvolved_default.png\';">';
		 }
	      ?>
              </a>
           </li>
	   <li id="faq">
              <a href="/static/view/faq">
              <img name="faq" border=0
	      <?php 
		 if ($this_page == "faq") {
		   echo 'src="/media/img/btn_faq_down.png">'; 
		 }
		 else {
		   echo 'src="/media/img/btn_faq_default.png" onmouseover = "document.faq.src = \'/media/img/btn_faq_hover.png\';" onmouseout = "document.faq.src = \'/media/img/btn_faq_default.png\';">';
		 }
	      ?>
              </a>
           </li>
	   <li id="aboutkiirti">
              <a href="/static/view/aboutkiirti">
              <img name="aboutkiirti" border=0
	      <?php 
		 if ($this_page == "aboutkiirti" || $this_page == "aboutkiirti-core" || $this_page == "aboutkiirti-contact") {
		   echo 'src="/media/img/btn_aboutkiirti_down.png">'; 
		 }
		 else {
		   echo 'src="/media/img/btn_aboutkiirti_default.png" onmouseover = "document.aboutkiirti.src = \'/media/img/btn_aboutkiirti_hover.png\';" onmouseout = "document.aboutkiirti.src = \'/media/img/btn_aboutkiirti_default.png\';">';
		 }
	      ?>
              </a>
           </li>
	 </ul>
	</div>

	
