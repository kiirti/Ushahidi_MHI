<div id="middle-content-container">
<div class="page-banner">
   <div style="padding-left:20px;">
	<br><span class="requesttitle">Request New Supported Causes</span<br>
	<span class="requestsubtitle">Signup Page 1 of 3 : Account Setup</span><br><br>
   </div>
</div>
<div class="simple-content">

   <?php echo form::open('signup/page1', array('method'=>'post'));?>
   <br><label class="formcopy" for="username">USERNAME :</label><br>
   <input name="username" id="username" type="text" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['username'])) ? '' : '<span class="errormessage">* '.$errors['username'].'</span><br>';?>

   <label class="formcopy" for="password">PASSWORD :</label><br>
   <input name="password" id="password" type="password" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['password'])) ? '' : '<span class="errormessage">* '.$errors['password'].'</span><br>';?>

   <label class="formcopy" for="password_confirm">RE-TYPE PASSWORD :</label><br>
   <input name="password_confirm" id="password_confirm" type="password" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['password_confirm'])) ? '' : '<span class="errormessage">* '.$errors['password_confirm'].'</span><br>';?>

   <label class="formcopy" for="email">EMAIL :</label><br>
   <input name="email" id="email" type="text" value="" style="width:380px;height:22px;border:solid 1px #b4d3e9;"><br>
   <?php echo (empty ($errors['email'])) ? '' : '<span class="errormessage">* '.$errors['email'].'</span><br>';?>

   <br>
   <?
   // Don't show Captcha anymore after the user has given enough valid
   // responses. The "enough" count is set in the captcha config.
   if ( ! $captcha->promoted())
   {
	echo $captcha->render(); // Shows the Captcha challenge (image/riddle/etc)
   	echo '<br><label class="formcopy" for="captcha_response">SECURITY CODE:</label><br>';
   	echo '<input name="captcha_response" id="captcha_response" type="text" value="" style="width:190px;height:22px;border:solid 1px #b4d3e9;margin-right:5px;"><br>';
   	echo (empty ($errors['captcha_response'])) ? '' : '<span class="errormessage">* '.$errors['captcha_response'].'</span><br>';
	echo '<br>';

   } else {
 	echo '<p>You have been promoted to human.</p>';
   }
   ?>

   <?php echo form::submit(array('value' => 'Submit'));?><br>
   <?php echo form::close();?>
   <!--<button type="submit" style="height: 22px; width: 180px">Submit</button><br>-->
</div>
</div>
