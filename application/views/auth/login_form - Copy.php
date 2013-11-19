<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'autocomplete' => 'off',
	'class' => 'form-control',
	'placeholder' => 'Email address'
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'autocomplete' => 'off',
	'class' => 'form-control',
	'type' => 'password',
	'placeholder' => 'Password'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin-top:10px;margin-bottom:1px;padding:0',
	'autocomplete' => 'off'
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'autocomplete' => 'off'
);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Luminox - Sign in</title>

    <!-- Bootstrap core CSS -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/signin.css');?>">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="form-signin">
      	<?php echo form_open($this->uri->uri_string()); ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php echo form_input($login); ?>
        <span class="help-block"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>  
        <?php echo form_input($password); ?>
        <span class="help-block"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?><?php echo form_checkbox($remember); ?></span>  
			<?php echo form_label('Remember me', $remember['id']); ?>
			<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
			<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>

        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <input type="button" value="Register" class="btn btn-lg btn-primary btn-block btn-danger" onclick="window.location.href='<?php echo base_url('index.php/auth/register');?>'"></input>
      </div> <!-- /tutup div class form -->
      <?php echo form_close(); ?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>