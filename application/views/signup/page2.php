<div id="middle-content-container">
<div class="page-banner">
   <div style="padding-left:20px;">
	<br><span class="requesttitle">Request New Supported Causes</span<br>
	<span class="requestsubtitle">Signup Page 2 of 3 : Site Setup</span><br><br>
   </div>
</div>
<div class="simple-content">
   <?php echo form::open('signup/page2', array('method'=>'post'));?>
   <br><label class="formcopy" for="sitename">CAUSE NAME :</label><br>
   <input name="sitename" id="sitename" type="text" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['sitename'])) ? '' : '<span class="errormessage">* '.$errors['sitename'].'</span><br>';?>

   <label class="formcopy" for="subdomain">SUBDOMAIN :</label><br>
   <input name="subdomain" id="subdomain" type="text" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['subdomain'])) ? '' : '<span class="errormessage">* '.$errors['subdomain'].'</span><br>';?>

   <label class="formcopy" for="tagline">TAGLINE :</label><br>
   <input name="tagline" id="tagline" type="text" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['tagline'])) ? '' : '<span class="errormessage">* '.$errors['tagline'].'</span><br>';?>

   <label class="formcopy" for="keywords">KEYWORDS :</label><br>
   <input name="keywords" id="keywords" type="text" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['keywords'])) ? '' : '<span class="errormessage">* '.$errors['keywords'].'</span><br>';?>

   <label class="formcopy" for="description">DESCRIPTION :</label><br>
   <textarea name="description" id="description" style="width:380px;height:100px;border:solid 1px #b4d3e9;"></textarea><br>
   <?php echo (empty ($errors['description'])) ? '' : '<span class="errormessage">* '.$errors['description'].'</span><br>';?><br>
   
   <?php echo form::submit(array('value' => 'Submit'));?><br>
   <?php echo form::close();?>
</div>
</div>
