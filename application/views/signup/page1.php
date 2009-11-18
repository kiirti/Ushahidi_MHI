

<div id="content">
  <div class="content-bg">
    <h3>Welcome to Ushahidi MHI | Signup Page 1/3 | Account Setup</h3>
    <?
    // Show form
	echo form::open('signup/page1', array('method'=>'post'));

	print "<p />";
    print form::label('username', 'Username: ');
	print form::input('username', $form['username']); 
    echo (empty ($errors['username'])) ? '' : $errors['username'];

	print "<p />";
    print form::label('password', 'Password: ');
	print form::password("password", $form['password']);
	echo (empty ($errors['password'])) ? '' : $errors['password'];

	print "<p />";
	print form::label('password_confirm', 'Password (again): ');
	print form::password("password_confirm", $form['password_confirm']);
	echo (empty ($errors['password_confirm'])) ? '' : $errors['password_confirm'];

	print "<p />";
	print form::label('email', 'Email: ');
	print form::input('email', $form['email']);
	echo (empty ($errors['email'])) ? '' : $errors['email'];

	// Don't show Captcha anymore after the user has given enough valid
	// responses. The "enough" count is set in the captcha config.
	if ( ! $captcha->promoted()){
      echo '<p>';
      echo $captcha->render(); // Shows the Captcha challenge (image/riddle/etc)
      echo '</p>';
	  echo form::input('captcha_response');
    } else {
      echo '<p>You have been promoted to human.</p>';
    }
    echo (empty ($errors['captcha_response'])) ? '' : $errors['captcha_response'];
 
    // Close form
    echo "<p />";
    echo form::submit(array('value' => 'Submit'));
    echo form::close();
	?>

	<p />

  </div>
</div>
