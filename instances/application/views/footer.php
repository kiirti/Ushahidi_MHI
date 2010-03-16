<?php 
/**
 * Footer view page.
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
     
<!-- content bottom -->
<div id="end-content">
  <img src="/media/img/content_bottom.png">
</div>

<?php 
	$baseurl = url::base();
	$dot = strpos($baseurl,'.');
	$slash = strpos($baseurl, '/', 7);
	$mainurl = "http://".substr($baseurl,$dot+1, $slash-$dot-1);
?>
<div id="footer">
  <a href="<?php echo $mainurl.'/signup/page1';?>">
  <img src='/media/img/btn_request_default.png' name=limage7
   onmouseover = "document.limage7.src = '/media/img/btn_request_hover.png';"
   onmouseout = "document.limage7.src = '/media/img/btn_request_default.png';"
border= 0 align= left></a>
  <span class="copyright">Copyright © 2009 Kiirti.org  All Rights Reserved &nbsp;&nbsp; | &nbsp;&nbsp; <a href="<?php echo $mainurl.'/static/view/termsofuse';?>">Terms of Use</a></span>
  <span class="copyright" style="float:right;">designed by <a href="http://www.moreplusone.com" target="blank"> MORE+1</a></span>
</div>

</div>
</body>
</html>
