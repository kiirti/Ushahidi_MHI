<?php 
/**
 * Alerts view page.
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

<div class="sub-simple-content">
	<h1><?php echo Kohana::lang('ui_main.alerts_get'); ?></h1>
	<?php
	if ($form_error) {
	?>
	<!-- red-box -->
	<div class="red-box">
		<h3>Error!</h3>
		<ul>
			<?php
			foreach ($errors as $error_item => $error_description)
			{
			// print "<li>" . $error_description . "</li>";
			print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
			}
			?>
		</ul>
	</div>
	<?php
	}
	?>
	<?php print form::open() ?>
	<div class="step-1">
		<h2><?php echo Kohana::lang('ui_main.alerts_step1_select_city'); ?></h2>
		<div class="map">
			<p><?php echo Kohana::lang('ui_main.alerts_place_spot'); ?></p>
			<div class="map-holder" id="divMap"></div></div>
		<div class="report-find-location">
			<div style="float:left;">
				<?php print form::input('location_find', '', ' title="City, State and/or Country" class="findtext"'); ?><input style="margin:9px 0 0 5px;"type="button" name="button" id="button" value="Find Location" class="btn_find" style="width:105px;"/>
				<div id="find_loading" class="report-find-loading"><!-- --></div>
			</div>
			<div style="clear:both;" id="find_text">* If you can't find your location, please click on the map to pinpoint the correct location.</div>
			<div class="alert_slider">
				<select name="alert_radius" id="alert_radius">
					<option value="1">1 KM</option>
					<option value="5">5 KM</option>
					<option value="10">10 KM</option>
					<option value="20" selected="selected">20 KM</option>
					<option value="50">50 KM</option>
					<option value="100">100 KM</option>
				</select>
			</div>
		</div>
	</div>
	<input type="hidden" id="alert_lat" name="alert_lat" value="<?php echo $form['alert_lat']; ?>">
	<input type="hidden" id="alert_lon" name="alert_lon" value="<?php echo $form['alert_lon']; ?>">
	<div class="step-2-holder">
		<div class="step-2">
			<h2><?php echo Kohana::lang('ui_main.alerts_step2_send_alerts'); ?></h2>
			<div class="holder">
				<div class="box">
					<label>
						<?php
							if ($form['alert_email_yes'] == 1) {
								$checked = true;
							}
							else
							{
								$checked = false;
							}
							print form::checkbox('alert_email_yes', '1', $checked);
						?>
						<span><strong><?php echo Kohana::lang('ui_main.alerts_email'); ?></strong><br /><?php echo Kohana::lang('ui_main.alerts_enter_email'); ?></span>
					</label>
					<span><?php print form::input('alert_email', $form['alert_email'], ' class="text" style="width:80%;"'); ?></span>
				</div>
			</div>
		</div>
		<input id="btn-send-alerts" class="btn_submit" type="submit" value="<?php echo Kohana::lang('ui_main.alerts_btn_send'); ?>" />
		<BR /><BR />
		<a href="<?php echo url::base()."alerts/confirm";?>"><?php echo Kohana::lang('ui_main.alert_confirm_previous'); ?></a>
	</div>
	<?php print form::close(); ?>
								<?php
		if ($allow_feed == 1 )
		{
	?>
	<div class="step-2-holder">
		<div class="feed">
			<h2><?php echo Kohana::lang('ui_main.alerts_rss'); ?></h2>
			<div class="holder">
				<!--<div class="box" style="text-align:left;">-->
					<a href="<?php echo url::site(); ?>feed/"><img src="<?php echo url::base(); ?>media/img/icon-feed.png" style="vertical-align: middle;" border="0"></a>&nbsp;<strong><a href="<?php echo url::site(); ?>feed/"><?php echo url::site(); ?>feed/</a></strong>
				<!--</div>-->
			</div>
		</div>
	</div>
	<?php
		}
	?>
</div><!-- end alerts block -->
<div class="clear"></div>
</div>
