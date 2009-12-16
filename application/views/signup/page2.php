

<div id="content">
  <div class="content-bg">
    <h3>Welcome to Ushahidi MHI | Signup Page 2/3 | Site Setup</h3>
    <?
    // Show form
	echo form::open('signup/page2', array('method'=>'post'));

	print "<p />";
    print form::label('sitename', 'Site Name: ');
	print form::input('sitename', $form['sitename']); 
    echo (empty ($errors['sitename'])) ? '' : $errors['sitename'];

	print "<p />";
    print form::label('subdomain', 'Subdomain: ');
	print form::input("subdomain", $form['subdomain']);
	echo (empty ($errors['subdomain'])) ? '' : $errors['subdomain'];

	print "<p />";
	print form::label('tagline', 'Tagline: ');
	print form::input("tagline", $form['tagline']);
	echo (empty ($errors['tagline'])) ? '' : $errors['tagline'];

	print "<p />";
	print form::label('description', 'Description: ');
	print form::textarea('description', $form['description']);
	echo (empty ($errors['description'])) ? '' : $errors['description'];

	print "<p />";
	print form::label('keywords', 'Keywords: ');
	print form::input("keywords", $form['keywords']);
	echo (empty ($errors['keywords'])) ? '' : $errors['keywords'];

	print "<p />";
    /* Not supported now. 
	print form::label('public', 'This is public: ');
	print form::radio('public', 'public').'<br />';
	print form::label('public', 'This is private: ');
	print form::radio('public', 'private', TRUE).'<br />';
	echo (empty ($errors['public'])) ? '' : $errors['public'];
    */

    // Close form
    echo "<p />";
    echo form::submit(array('value' => 'Submit'));
    echo form::close();
	?>

	<p />

  </div>
</div>
