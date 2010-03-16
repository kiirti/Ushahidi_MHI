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

<body TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0><center>
				<!-- / mainmenu -->
<!-- header -->
<table cellpadding= 0 cellspacing= 0 border= 0 width= 990>
<tr>
	<td width= 150 valign= top>
	<img src="/media/img/logo_01.gif"><br></td>
	<td width= 840 valign= top>
	<table cellpadding=0 cellspacing= 0 border= 0>
	<tr><td width= 300 valign= top>
	<img src="/media/img/logo_02.gif"><br>
	</td><td width= 540 valign= top align= right>
	
	</td></tr></table>

	<table cellpadding= 0 cellspacing= 0 border= 0 width= 840>
	<tr><td valign=bottom background="/media/img/content_top.png" height= 55>
	<!-- kiirti menu -->
	<img src="/media/img/box.gif" width= 20><a href="/main">
	<img src="/media/img/btn_kiirtihome_default.png" border= 0></a>
        <img src="/media/img/box.gif" width= 5>
        <a href="/static/view/whatiskiirti">
	<img src="/media/img/btn_whatiskiirti_default.png"
      name=limage2
      onmouseover="document.limage2.src = '/media/img/btn_whatiskiirti_hover.png';"
      onmouseout="document.limage2.src = '/media/img/btn_whatiskiirti_default.png';"
border= 0></a>
      <img src="/media/img/box.gif" width= 5>
      <a href='/static/view/supportedcauses'><img
      src="/media/img/btn_supportedcauses_default.png"
      name=limage3
      onmouseover = "document.limage3.src = '/media/img/btn_supportedcauses_hover.png';"
      onmouseout = "document.limage3.src = '/media/img/btn_supportedcauses_default.png';"
border= 0></a>
      <img src="/media/img/box.gif';?>" width= 5>
      <a href='/static/view/getinvolved'>
      <img
      src="/media/img/btn_getinvolved_default.png"
      name=limage4
      onmouseover = "document.limage4.src = '/media/img/btn_getinvolved_hover.png';"
      onmouseout = "document.limage4.src = '/media/img/btn_getinvolved_default.png';"
border= 0></a>
      <img src="media/img/box.gif" width= 5>
      <a href='/static/view/faq'>
      <img
      src="/media/img/btn_faq_default.png"
      name=limage5
      onmouseover = "document.limage5.src = '/media/img/btn_faq_hover.png';"
      onmouseout = "document.limage5.src = '/media/img/btn_faq_default.png';"
border= 0></a>
      <img src="/media/img/box.gif" width= 5>
      <a href='/static/view/aboutkiirti'>
      <img
      src="/media/img/btn_aboutkiirti_default.png"
      name=limage6
      onmouseover = "document.limage6.src = '/media/img/btn_aboutkiirti_hover.png';"
      onmouseout = "document.limage6.src = '/media/img/btn_aboutkiirti_default.png';"
border= 0></a><img src="/media/img/box.gif" width= 5><br></td></tr>
