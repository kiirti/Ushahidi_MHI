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
<div class="sub-simple-content">
<div id="left-content">
     <br><span class="header">Recent Reports</span><br><br>
     <div class="floatbox">
     <div class="<?php echo $map_container; ?>" id="<?php echo $map_container; ?>" <?php if($map_container === 'map3d') { echo 'style="width:573px; height:573px;"'; } ?>></div> 
    </div>
</div>
<div id="subhome-right-content">
     <span class="header">Categories</span><br><br>
     <div id="legend">
     <span class="list"><br>
     <ul class="category-filters">
	     <li><a class="active" id="cat_0" href="#"><div class="swatch" style="background-color:#<?php echo $default_map_all;?>"></div><div class="category-title">All Categories</div></a></li>
	     <?php
		     foreach ($categories as $category => $category_info)
		     {
			     $category_title = $category_info[0];
			     $category_color = $category_info[1];
			     echo '<li><a href="#" id="cat_'. $category .'"><div class="swatch" style="background-color:#'.$category_color.'"></div><div class="category-title">'.$category_title.'</div></a></li>';
			     // Get Children
			     echo '<div class="hide" id="child_'. $category .'">';
			     foreach ($category_info[2] as $child => $child_info)
			     {
				     $child_title = $child_info[0];
				     $child_color = $child_info[1];
				     echo '<li style="padding-left:20px;"><a href="#" id="cat_'. $child .'"><div class="swatch" style="background-color:#'.$child_color.'"></div><div class="category-title">'.$child_title.'</div></a></li>';
			     }
			     echo '</div>';
		     }
	     ?>
     </ul>
     </span>
     </div> 
</div>
<!--<div class="sub-simple-content">-->
<div class="slider-holder">
     <?php if($map_container === 'map') { ?>
	     <form action="">
		     <fieldset>
			     <div class="play"><a href="#" id="playTimeline">PLAY</a></div>
			     <label for="startDate">From:</label>
			     <select name="startDate" id="startDate"><?php echo $startDate; ?></select>
			     <label for="endDate">To:</label>
			     <select name="endDate" id="endDate"><?php echo $endDate; ?></select>
		     </fieldset>
	     </form>
     <?php } ?>
     </div>
     <div id="graph" class="graph-holder"></div><br>
<img src="/media/img/divider.gif" style="margin-left: -10px;">
<div class="content-block-left">
	<span class="subtitle-subsite"><?php echo Kohana::lang('ui_main.incidents_listed'); ?></span><br><br>
	<table class="table-list">
		<thead>
			<tr>
				<th scope="col" class="table-title"><?php echo Kohana::lang('ui_main.title'); ?></th>
				<th scope="col" class="location"><?php echo Kohana::lang('ui_main.location'); ?></th>
				<th scope="col" class="date"><?php echo Kohana::lang('ui_main.date'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($total_items == 0)
			{
			?>
			<tr><td colspan="3">No Reports In The System</td></tr>

			<?php
			}
			foreach ($incidents as $incident)
			{
				$incident_id = $incident->id;
				$incident_title = text::limit_chars($incident->incident_title, 40, '...', True);
				$incident_date = $incident->incident_date;
				$incident_date = date('M j Y', strtotime($incident->incident_date));
				$incident_location = $incident->location->location_name;
			?>
			<tr>
				<td><a href="<?php echo url::base() . 'reports/view/' . $incident_id; ?>"> <?php echo $incident_title ?></a></td>
				<td><?php echo $incident_location ?></td>
				<td><?php echo $incident_date; ?></td>
			</tr>
			<?php
			}
			?>

		</tbody>
	</table>
	<a class="more" href="<?php echo url::base() . 'reports/' ?>">View More...</a>
</div>
<!-- / left content block -->
				
<!-- right content block -->
<div class="content-block-right">
	<span class="subtitle-subsite"><?php echo Kohana::lang('ui_main.official_news'); ?></span><br><br>
	<table class="table-list">
		<thead>
			<tr>
				<th scope="col"><?php echo Kohana::lang('ui_main.title'); ?></th>
				<th scope="col"><?php echo Kohana::lang('ui_main.source'); ?></th>
				<th scope="col"><?php echo Kohana::lang('ui_main.date'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($feeds as $feed)
			{
				$feed_id = $feed->id;
				$feed_title = text::limit_chars($feed->item_title, 40, '...', True);
				$feed_link = $feed->item_link;
				$feed_date = date('M j Y', strtotime($feed->item_date));
				$feed_source = text::limit_chars($feed->feed->feed_name, 15, "...");
			?>
			<tr>
				<td><a href="<?php echo $feed_link; ?>" target="_blank"><?php echo $feed_title ?></a></td>
				<td><?php echo $feed_source; ?></td>
				<td><?php echo $feed_date; ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<a class="more" href="<?php echo url::base() . 'feeds' ?>">View More...</a>
</div>
<!-- / right content block -->
<div class="clear"></div> 
				
		</div>
</div>
