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

				<!-- main body -->
				<div id="main" class="clearingfix">

                    <p />
					<div id="mainmiddle" class="floatbox withright">
				
						<!-- right column -->
						<div id="right" class="clearingfix">
					
							<!-- category filters -->
							<div class="cat-filters clearingfix">
								<strong><?php echo Kohana::lang('ui_main.category_filter');?></strong>
							</div>
						
							<ul class="category-filters">
								<li><a class="active" id="cat_0" href="#"><div class="swatch" style="background-color:#<?php echo $default_map_all;?>"></div><div class="category-title">All Sites</div></a></li>
								<?php
									foreach ($categories as $category => $category_info)
									{
										$category_title = $category_info[0];
										$category_color = $category_info[1];
										echo '<li><a href="#" id="cat_'. $category .'"><div class="swatch" style="background-color:#'.$category_color.'"></div><div class="category-title">'.$category_title.'</div></a></li>';
										//  Children -- not used by MHI currently.
                                        /**
										echo '<div class="hide" id="child_'. $category .'">';
										foreach ($category_info[2] as $child => $child_info)
										{
											$child_title = $child_info[0];
											$child_color = $child_info[1];
											echo '<li style="padding-left:20px;"><a href="#" id="cat_'. $child .'"><div class="swatch" style="background-color:#'.$child_color.'"></div><div class="category-title">'.$child_title.'</div></a></li>';
										}
										echo '</div>';
                                        */
									}
								?>
							</ul>
							<!-- / category filters -->
							
							<br />
						
						</div>
						<!-- / right column -->
					
						<!-- content column -->
						<div id="content" class="clearingfix">
							<div class="floatbox">
							
								<!-- map -->
								<?php
									// My apologies for the inline CSS. Seems a little wonky when styles added to stylesheet, not sure why.
								?>
								<div class="<?php echo $map_container; ?>" id="<?php echo $map_container; ?>" <?php if($map_container === 'map3d') { echo 'style="width:573px; height:573px;"'; } ?>></div> 
								<?php if($map_container === 'map') { ?>
								<div class="slider-holder">
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
								<!-- / map -->
								<div id="graph" class="graph-holder"></div>
							</div>
						</div>
						<!-- / content column -->
				
					</div>
				</div>
				<!-- / main body -->
			
			
				</div>
				<!-- content -->
		
			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->
