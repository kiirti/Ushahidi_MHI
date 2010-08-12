<?php 
/**
 * Incidents view page.
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
			<div class="bg">
				<h2><?php echo $title; ?> <span>(<?php echo $total_items; ?>)</span></h2>
                
				<!-- tabs -->
				<div class="tabs">
					<!-- tabset -->
					<ul class="tabset">
						<li><a href="?status=0" <?php if ($status != 'a') echo "class=\"active\""; ?>>Show All</a></li>
						<li><a href="?status=a" <?php if ($status == 'a') echo "class=\"active\""; ?>>Awaiting Approval</a></li>
					</ul>
					<!-- tab -->
					<div class="tab">
						<ul>
						<!--	
                            <li><a href="#" onclick="reportAction('a','APPROVE', '');">APPROVE</a></li>
							<li><a href="#" onclick="reportAction('u','UNAPPROVE', '');">UNAPPROVED</a></li>
							<li><a href="#" onclick="reportAction('d','DELETE', '');">DELETE</a></li>
                         -->
						</ul>
					</div>
				</div>
				<?php
				if ($form_error) {
				?>
					<!-- red-box -->
					<div class="red-box">
						<h3>Error!</h3>
						<ul>Please verify that you have checked an item</ul>
					</div>
				<?php
				}

				if ($message) {
				?>
					<!-- green-box -->
					<div class="green-box" id="submitStatus">
						<h3><?= $message ?></h3>
					</div>
				<?php
				}
				?>
				<!-- report-table -->
				<?php print form::open(NULL, array('id' => 'reportMain', 'name' => 'reportMain')); ?>
					<input type="hidden" name="action" id="action" value="">
					<input type="hidden" name="incident_id[]" id="incident_single" value="">
					<div class="table-holder">
						<table class="table">
							<thead>
								<tr>
									<th class="col-1"><input id="checkallincidents" type="checkbox" class="check-box" onclick="CheckAll( this.id, 'incident_id[]' )" /></th>
									<th class="col-2">Instance Details</th>
									<th class="col-3">User</th>
									<th class="col-4">Actions</th>
								</tr>
							</thead>
							<tfoot>
								<tr class="foot">
									<td colspan="4">
									</td>
								</tr>
							</tfoot>
							<tbody>
								<?php
								if ($total_items == 0)
								{
								?>
									<tr>
										<td colspan="4" class="col">
											<h3>No Instances To Display!</h3>
										</td>
									</tr>
								<?php	
								}
								foreach ($sites as $instance)
								{
									$instance_description = text::limit_chars($instance->description, 150, "...", true);
									$instance_keywords = $instance->keywords;
                                    $instance_tagline = $instance->tagline;
                                    $instance_email = $instance->email;
                                    $instance_id = $instance->id;
                                    $instance_user = $instance->username;
                                    $instance_sitename = $instance->sitename;
                                    $instance_url = "http://" . $instance->subdomain 
                                        . Kohana::config('settings.hosting_domain');
									
									// Instance Status
									$instance_approved = $instance->is_approved;
									
									?>
									<tr>
										<td class="col-1"><input name="instance_id[]" id="incident" value="<?php echo $instance_id; ?>" type="checkbox" class="check-box"/></td>
										<td class="col-2">
											<div class="post">
												<h4><a href="<?php echo $instance_url; ?>" class="more" target="new"><?php echo $instance_sitename; ?></a></h4>
												<p><?php echo $instance_description; ?></p>
<p>Instance SMS ID: <?php echo $instance->InstanceSMS_ID; ?></p>
											</div>
											<ul class="info">
												<li class="none-separator">Keywords: <strong><?php echo $instance_keywords; ?></strong></li>
												<li>Tagline: <strong><?php echo $instance_tagline; ?></strong></li>
											</ul>
										</td>
										<td class="col-3"><a href="mailto:<?= $instance_email ?>"><?php echo $instance_user; ?></a></td>
										<td class="col-4">
											<ul>
                                                <li class="none-separator">
                                                  <?php if ($instance_approved) { ?> 
                                                      <a href="<?= url::base() ?>admin/instances/unapprove/<?php echo $instance_id; ?>" class="del">Unapprove</a> 
                                                    <?php } else { ?>
                                                      <a href="<?= url::base() ?>admin/instances/approve/<?php echo $instance_id; ?>" class="del">Approve</a>
                                                    <?php } ?>
                                                </li>
												<li><a href="<?= url::base() ?>admin/instances/delete/<?php echo $instance_id; ?>" class="del">Delete</a></li>
											</ul>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				<?php print form::close(); ?>
			</div>
