<script type="text/javascript" src="<?php echo base_url('asset/jquery.js');?>"></script>

<?php
$this->config->load('tankstrap'); 
$tankstrap = $this->config->item('tankstrap');
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
        'class'=>'form-control',
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
    'class'=>'form-control',
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
    'class'=>'form-control',
    'AUTOCOMPLETE' => 'off',
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
    'class'=>'form-control',
    'AUTOCOMPLETE' => 'off',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);

$tombol = array(
    
    'id' => 'submitButton',
    'disabled' => 'true',

);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="<?php echo $tankstrap["bootstrap_path"];?>" rel="stylesheet">
        <title><?php echo $tankstrap["register_page_title"];?></title>
    </head>
    <body>
	<div class="container" style="margin-top:100px;">
		<div class="row">
			<div class="span6 offset3">
				<div class="well">

                    <? echo $this->session->set_flashdata('aktivasi'); ?>
					
					<h3>Pendaftaran Member</h3>
                    <hr>
                        <?php echo form_open($this->uri->uri_string()); ?>

	                       


	
  <?php if(isset($registration_fields)) : foreach($registration_fields as $val) : ?>
		<?php
			list($name, $label,, $type) = $val;
			$field = array('name'	=> $name, 'id'	=> $name, 'value' => set_value($name));
		?>
  	<?php if($type == 'text') : ?>
			<?php
				$field += array('size'=>30);
				$attr = isset($val[4]) ? $val[4] : FALSE;
				if($attr){
					foreach($attr as $k=>$v){
						$field[$k] = $v;
					}
				}
			?>
      
 <div class="form-group">
        
         <label for="text"><?php echo form_label($label, $field['name']); ?></label>
        <?php echo form_input($field); ?>
        <td style="color: red;"><?php echo form_error($field['name']); ?><?php echo isset($errors[$field['name']]) ? $errors[$field['name']] : ''; ?></td>
</div>


  	<?php elseif($type == 'dropdown') : ?>
      <div class="form-group">
        <label for="text"><?php echo form_label($label, $name); ?></td></label>
        <select class="form-control">

        		<?php if(isset($db_dropdowns) && in_array($name, $db_dropdowns)) : ?>
					<td><?php echo form_dropdown($name, $dropdown_items[$name], $dropdown_items_default[$name]); ?></td>
				<?php else : ?>
					<td><?php echo form_dropdown($name, $dropdown_simple[$name], $dropdown_simple_default[$name]); ?></td>
				<?php endif; ?>
        </select>
        <td style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></td>
      </div>


  	<?php elseif($type == 'checkbox') : ?>
      <tr valign="top">
        <td><?php echo $label; ?></td>
				<!--
        <td><?php echo form_checkbox(array('name'=>$name, 'id'=>$name), 1, set_checkbox($name, 1, isset($name) ? $name : FALSE)) . ' ' . form_label($val[4], $name); ?></td>
				-->
				<td><?php echo form_checkbox(array('name'=>$name, 'id'=>$name), 1, set_checkbox($name, 1, isset($val[5]) ? $val[5] : FALSE)) . ' ' . form_label($val[4], $name); ?></td>
        <td style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></td>
      </tr>
  	<?php elseif($type == 'radio') : ?>
      <tr valign="top">
        <td><?php echo $label; ?></td>
        <td>
					<?php
						$open_tag = isset($val[5]) ? $val[5] : '<span>';
						$close_tag = isset($val[6]) ? $val[6] : '</span>';
						foreach($val[4] as $key=>$radio_label){
							echo $open_tag.'<label>'.form_radio($name, $key, set_radio($name, $key)).' '.$radio_label.'</label>'.$close_tag;
						}
					?>
				</td>
        <td style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></td>
      </tr>
    <?php endif; ?>
  
  <?php endforeach; endif; ?>	


                            <?php if ($use_username): ?>
                               <div class="control-group">
                                    <?php echo form_label('Username', $username['id'], array('class' => 'control-label')); ?>
                                    <div class="controls">
                                        <?php echo form_error('username'); ?>                                
                                        <?php echo form_input($username); ?><br />
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                           <?php endif; ?>



                            <div class="control-group">
                                <?php echo form_label('Contact E-mail', $email['id'], array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <?php echo form_error('email'); ?>                                
                                    <?php echo form_input($email); ?><br />
                                    <p class="help-block"></p>
                                </div>
                            </div>


                            <div class="control-group">
                                <?php echo form_label('Password', $password['id'], array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <?php echo form_error('password'); ?>                                
                                    <?php echo form_password($password); ?>
                                    <p class="help-block"></p>
                                </div>
                            </div>

                             <div class="form-group">
                                <label><?php echo form_label('Confirm Password', $confirm_password['id'], array('class' => 'control-label')); ?></label>
                                <div class="controls">
                                    <?php echo form_error('confirm_password'); ?>                                
                                    <?php echo form_password($confirm_password); ?>
                                    <p class="help-block"></p>
                                </div>
                            </div>

	<?php if ($captcha_registration): ?>
	<div class="control-group">
        <?php echo form_label('Confirmation Code', $captcha['id'], array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $captcha_html; ?>
            <p class="help-block"></p>
        </div>
    </div>	
	<div class="control-group">
        <?php echo form_label('Enter Code', $captcha['id'], array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo form_error('captcha'); ?>                                
            <?php echo form_input($captcha); ?>
            <p class="help-block"></p>
        </div>
    </div>
	<?php endif; ?>
</table>

<div class="control-group">
    <div class="controls">
        <input type="checkbox" value="a" /> Dengan melakukan pendaftaran, anda bersedia mengikuti syarat dan ketentuan yang berlaku.
    </div>
</div>
<hr>

<?php //echo form_submit('register', 'Register', 'class="btn btn-primary"',$tombol); ?>
<input type="submit" id="submitButton" class="btn btn-primary" value="Register" disabled="true" />
<?php echo form_close(); ?>

</div>
</div>
</div>
</div>
 

<script type="text/javascript">
    $(document).ready(function() {
     $('input:checkbox').click(function() {
            var buttonsChecked = $('input:checkbox:checked');
            if (buttonsChecked.length) {
                $('#submitButton').removeAttr('disabled');
                } 
            else {
                $('#submitButton').attr('disabled', 'disabled');
                }
            });
        });
</script>

</body>
</html>