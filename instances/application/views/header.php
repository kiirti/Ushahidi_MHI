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
	<title><?php echo $site_name; ?> (powered by Kiirti)</title>
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
	$subdomain = substr($baseurl, 7, $dot-7);
?>
<div id="page-container">
  <div id="left-logo-bar">
      <img src="/media/img/logo_01.gif">
  </div>
  <div id="right-page-container">
      <div id="right-header">
	    <table cellpadding= 5 cellspacing= 0 border= 0>
	    <tr><td valign= top>
	    <a href="<?php echo $mainurl.'/main';?>">
	    <img src="/media/img/logo_02.gif" border=0></a>
	    </td><td valign= center>
	    <img src="<?php echo '/media/img/'.$subdomain.'_logo.gif';?>">
	    </td><td valign= center align= right>
            <span class="copy">
		<u>TO REPORT AN ISSUE</u><br>
		call: <b>0512-302-6888</b><br>
		text: <b>kiirti <?php if (empty($sms_id)) {
		                         echo '{id}';
				       } else {
				         echo $sms_id;
				       }?> {message}</b> to <b>56677</b><br>
		email: <a href="mailto:<?php if (empty($report_email)) { 
                            echo 'contact@kiirti.org';
			  } else {
			    echo $report_email;
			  }?>">
 		   <?php if (empty($report_email)) { 
                            echo 'contact@kiirti.org';
			  } else {
			    echo $report_email;
			  }?>
			</a>
            </span>
	    </td></tr></table>
      </div>
      <div id="main-nav">
	<div style="padding-top:18px; padding-left:20px;"
     		<span class="title-subsite"><?php echo $site_name;?></span><br>
	</div>
      <!--<ul>
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
       </ul>-->
     </div>
<div class="middle-content-container">
     <div id="sub-site-header">
	<div style="padding-top:8px; padding-left:10px;"
     		<span class="subtitle-subsite"><?php echo $site_tagline;?></span>	
	</div>
	   <div id="subnav">
		<ul>
		<li id="sub-home">
		<?php $class="blue"; if ($this_page == "home") $class="selected";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."main"?>"><span>HOME</span></a>
		</li>
		<li id="sub-reports">
		<?php $class="blue"; if ($this_page == "reports") $class="selected";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."reports"?>"><span>REPORTS</span></a>
		</li>
		<li id="sub-getalerts">
		<?php $class="blue"; if ($this_page == "alerts") $class="selected";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."alerts"?>"><span>GET ALERTS</span></a>
		</li>
		<li id="sub-contactus">
		<?php $class="blue"; if ($this_page == "contact") $class="selected";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."contact"?>"><span>CONTACT US</span></a>
		</li>
		<li id="sub-partners">
		<?php $class="blue"; if ($this_page == "help") $class="selected";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."help"?>"><span>PARTNERS</span></a>
		</li>
		<li id="sub-aboutus">
		<?php $class="blue"; if ($this_page == "page_1") $class="selected";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."page/index/1"?>"><span>ABOUT US</span></a>
		</li>
		<li id="sub-submitareport">
		<?php $class="green"; if ($this_page == "reports_submit") $class="selectedgreen";?>
		<a class="<?php echo $class;?>" href="<?php echo url::base()."reports/submit";?>"><span>SUBMIT A REPORT</span></a>
		</li>
		</ul>
	  </div>
		
     </div>
