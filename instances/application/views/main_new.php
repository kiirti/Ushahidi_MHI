<?php
/**
 * Main view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Admin Dashboard Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General
 * Public License (LGPL)
 */
?>


<div id="middle-content-container">

   <div class="page-banner">
	<img src="/media/img/temp_image_home.jpg" width=400 height=300 style="margin-right:20px; float:left;">
	<span class="title"><br><b>Kiirti, in Sanskrit,</b><br> means report or reputation. It is a web platform to enable collection and aggregation of any governance related issues or data from citizens directly, through phone, email or the web. It also provides tools needed to track the issues and seamlessly forward them to the right government authorities for resolution, via email and the web.</span>

	<img src='/media/img/divider.gif'>
   </div>
   <div id="left-content">
	<span class="header">Recent Reports</span><br><br>
	<div class="floatbox">
	<div class="<?php echo $map_container; ?>" id="<?php echo $map_container; ?>" <?php if($map_container === 'map3d') { echo 'style="width:573px; height:573px;"'; } ?>></div> 
	<?php if($map_container === 'map') { ?>
	<div class="slider-holder hide">
		<form action="">
			<fieldset>
				<div class="play"><a href="#" id="playTimeline">PLAY</a></div>
				<label for="startDate">From:</label>
				<select name="startDate" id="startDate"><?php echo $startDate; ?></select>
				<label for="endDate">To:</label>
				<select name="endDate" id="endDate"><?php echo $endDate; ?></select>
			</fieldset>
		</form>
	</div>
	<?php } ?>
	</div>
	<!--<iframe width="580" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?key=ABQIAAAAcl7QUIumcR5T6p9ImT6bKhR2OQT1YP0vDj2NRfW8LH958JXsihQ8stnGFHHFN4kZwhUfXzd7QcO97w&amp;mapclient=jsapi&amp;ie=UTF8&amp;ll=20.632784,78.925781&amp;spn=28.531064,50.976563&amp;z=4&amp;output=embed"></iframe>--><br />
  </div>
  <div id="right-content">
	<span class="header">Supported Causes</span><br><br>
	<div id="legend">
	<span class="list"><br>
	<?php
	    foreach ($shares as $share => $share_info)
	    {
		$sharing_site_name = $share_info[0];
		$sharing_color = $share_info[1];
		$sharing_domain = $share_info[2];
		echo '<a href="http://' . $sharing_domain . Kohana::config('settings.hosting_domain').'" target="new"><div class="swatch" style="background-color:#'.$sharing_color.'"></div><div style="margin-left:10px;">'.$sharing_site_name.'</div></a><br />';
	    }
	?>
	<!--<a href="#"><img src= dot_safety.gif border= 0>Safety Tracker<br></a>
	<a href="#"><img src= dot_karnataka.gif border= 0>Karnataka Flood Relief<br></a>
	<a href="#"><img src= dot_corruption.gif border= 0>Corruption Tracker<br></a>
	<a href="#"><img src= dot_mumbai.gif border= 0>Mumbai Flood Tracker<br></a>
	<a href="#"><img src= dot_delhi.gif border= 0>FixOurCity Delhi<br></a>
	<a href="#"><img src= dot_hyderabad.gif border= 0>FixOurCity Hyderabad<br></a>-->
	</span>
        </div> 
   </div>




</div>

		<!--<table cellpadding= 0 cellspacing= 0 border = 0 width= 780>
		<tr><td height= 25 valign= top>
		<span class="header">Recent Reports</span>
		</td><td valign= top>
		<span class="header">Supported Causes</span>
		</td></tr>
		<tr><td width= 580 height= 350 valign= top>
		<iframe width="580" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?key=ABQIAAAAcl7QUIumcR5T6p9ImT6bKhR2OQT1YP0vDj2NRfW8LH958JXsihQ8stnGFHHFN4kZwhUfXzd7QcO97w&amp;mapclient=jsapi&amp;ie=UTF8&amp;ll=20.632784,78.925781&amp;spn=28.531064,50.976563&amp;z=4&amp;output=embed"></iframe><br />
		</td><td width= 200 bgcolor='#ececec' valign= top><img src='media/img/box.gif'><br>
		<span class="list">
		<?php
		    foreach ($shares as $share => $share_info)
		    {
			$sharing_site_name = $share_info[0];
			$sharing_color = $share_info[1];
			$sharing_domain = $share_info[2];
			echo '<a href="http://' . $sharing_domain . Kohana::config('settings.hosting_domain').'" target="new"><div class="swatch" style="background-color:#'.$sharing_color.'"></div><div>'.$sharing_site_name.'</div></a><br />';
		    }
		?>
		<a href="#"><img src= dot_safety.gif border= 0>Safety Tracker<br></a>
		<a href="#"><img src= dot_karnataka.gif border= 0>Karnataka Flood Relief<br></a>
		<a href="#"><img src= dot_corruption.gif border= 0>Corruption Tracker<br></a>
		<a href="#"><img src= dot_mumbai.gif border= 0>Mumbai Flood Tracker<br></a>
		<a href="#"><img src= dot_delhi.gif border= 0>FixOurCity Delhi<br></a>
		<a href="#"><img src= dot_hyderabad.gif border= 0>FixOurCity Hyderabad<br></a>
		</td></tr></table>-->
