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
    <link rel="shortcut icon" href="<?php echo base_url('asset/favicon.png');?>">

    <title>Luminox - Sign in</title>

    <!-- Bootstrap core CSS -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/signin.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/vegas/jquery.vegas.css');?>" />
	<link href='http://fonts.googleapis.com/css?family=Cantora+One' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../asset/js/html5shiv.js"></script>
      <script src="../../asset/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="row">
          <div class="col-xs-6">
            <div class="kotak">
				
					Join Luminox Member
				
			 
				<p><span>Newest <a href="#">Product</a></span></p>
				<p><span>Promo <a href="#">Product</a></span></p>
				<p><span>Sale <a href="#">Information</a></span></p>
				
				
			
			  

            </div>          
          </div>

          <div class="col-xs-6">

            <div class="form-signin well">
        <?php echo form_open($this->uri->uri_string()); ?>
        
           <?php echo form_input($login); ?><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
           <?php echo form_input($password); ?><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?><?php echo form_checkbox($remember); ?>
           <?php echo form_label('Remember me', $remember['id']); ?>
           <?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
           <input type="button" value="Register" class="btn btn-lg btn-primary btn-block btn-danger" onclick="window.location.href='<?php echo base_url('/auth/register');?>'"></input>
        </div> <!-- /tutup div class form -->
        <?php echo form_close(); ?>

          </div>
      </div>
        
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
	<script type="text/javascript" src="<?php echo base_url('asset/jquery.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/vegas/jquery.vegas.js');?>"></script>
	<script>
		$(function() {
		  $.vegas({
			src:'<? echo base_url('asset/vegas/images/background.jpg');?> ?>'
		  })('overlay', {
			src:'<? echo base_url('asset/vegas/overlays/13.png');?> ?>'
		  });
		});
	</script>
	
	<script>
  $(function() {
  $.vegas('slideshow', {
  delay:5000,
  backgrounds:[
    { src:'<? echo base_url('asset/vegas/images/background.jpg');?>', fade:2000 },
	{ src:'<? echo base_url('asset/vegas/images/background-2.jpg');?>', fade:2000 },
    { src:'<? echo base_url('asset/vegas/images/background-1.jpg');?>', fade:2000 }
    
    
  ]
})
  $.vegas('overlay', {
  
  src:'<? echo base_url('asset/vegas/overlays/13.png');?>'
  });

});
  </script>
  
	
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>