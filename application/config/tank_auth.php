<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Website details
|
| These details are used in emails sent by authentication library.
|--------------------------------------------------------------------------
*/
$config['website_name'] = 'LUMINOX';
$config['webmaster_email'] = 'januarfonti01@gmail.com';

/*
|--------------------------------------------------------------------------
| Blacklisted usernames
|
| 'username_blacklist' = Usernames which will be blocked upon registration
| 'username_blacklist_prepend' = Each item will be appended to each element of 'username_blacklist' (increasing the # of blacklisted usernames)
| 'username_exceptions' = Allow these names even if they're in the total list of blacklisted usernames
|
|--------------------------------------------------------------------------
*/
// Blacklisted usernames
$config['username_blacklist'] = array('admin', 'administrator', 'mod', 'moderator', 'root');
$config['username_blacklist_prepend'] = array('the', 'sys', 'system', 'site', 'super');
$config['username_exceptions'] = array();

/*
|--------------------------------------------------------------------------
| Custom registration fields
|
| Add custom fields to your registration page. See full instructions on how to
| properly use this at https://github.com/enchance/Tank-Auth#custom-registration-fields
|
|--------------------------------------------------------------------------
*/
/*
// Sample fields. Add as many as you like and customize as needed. View README.md for more info and how to use.
$config['registration_fields'][] = array('name', 'Full name', 'trim|required', 'text');
$config['registration_fields'][] = array('website', 'Website', 'trim|required', 'text', array('class'=>'something'));

$config['registration_fields'][] = array('gender', 'Gender', 'trim|required|alpha|max_length[1]', 'radio', array('m'=>'Male', 'f'=>'Female'), '<p>', '</p>');
$config['registration_fields'][] = array('checkit', 'Do you want money?', 'trim|numeric', 'checkbox', 'I want money');

$config['registration_fields'][] = array('country', 'Country', 'trim|required|callback__not_zero', 'dropdown', array('0'=>'- choose -', 'US'=>'USA', 'PH'=>'Philippines'));
$config['registration_fields'][] = array('category', 'Categories', 'trim|required|callback__not_zero', 'dropdown', '[table.field1, table.field2]');
*/

$random_nomember = random_string('numeric', 9);


$attr_regist = array(
    
    'online'=>'Online',
    'cp'=>'CP',
    'pp'=>'PP'

);

$attr_classregist = array(
    'class'=>'form-control'
    

);

$attr_nomember = array(
    'class'=>'form-control',
    'value' => $random_nomember,
    'readonly'=> 'true'
);

$attr_nama = array(
    'class'=>'form-control',
     'placeholder' => 'Nama Lengkap'
);

$attr_alamat = array(
    'class'=>'form-control',
    'placeholder' => 'Alamat'
);

$attr_kota = array(
    'class'=>'form-control',
     'placeholder' => 'Kota'
);

$attr_provinsi = array(

        'class' => 'form-control'
        );

$attr_kodepos = array(
    'class'=>'form-control',
     'placeholder' => 'Kodepos'
);

$attr_ttl = array(
        'class'=>'form-control',
        'placeholder' => 'Format yyyy-mm-dd. Contoh 1992-25-01'
        );

$attr_nohp = array(
        'class'=>'form-control',
        'placeholder' => 'Nomer HP'
        );

$attr_norumah = array(
        'class'=>'form-control',
        'placeholder' => 'Nomer Telpon Rumah'
        );

/*
$config['registration_fields'][] = array('no_member', 'No Member', 'trim|required', 'text',$attr_nomember);
$config['registration_fields'][] = array('regist', 'Registrasi', 'trim|required|callback__not_zero', 'dropdown', $attr_regist, $attr_classregist);
//$config['registration_fields'][] = array('country', 'Country', 'trim|required|callback__not_zero', 'dropdown', $selection,$lokasi);
//$config['registration_fields'][] = array('no_reg', 'No Registrasi', 'trim', 'text',$atribut_noreg);
$config['registration_fields'][] = array('nama', 'Nama Lengkap', 'trim|required', 'text',$attr_nama);
$config['registration_fields'][] = array('alamat', 'Alamat', 'trim|required', 'text',$attr_alamat);
$config['registration_fields'][] = array('kota', 'Kota', 'trim|required', 'text',$attr_kota);
$config['registration_fields'][] = array('provinsi', 'Provinsi', 'trim|required|callback__not_zero', 'dropdown', '[master_state.state_id, master_state.state_name]',$attr_provinsi);
$config['registration_fields'][] = array('kodepos', 'Kodepos', 'trim|required', 'text',$attr_kodepos);
$config['registration_fields'][] = array('ttl', 'Tanggal Lahir', 'trim|required', 'text',$attr_ttl);
$config['registration_fields'][] = array('no_hp', 'Nomer HP', 'trim|required', 'text',$attr_nohp);
$config['registration_fields'][] = array('no_rumah', 'Nomer Rumah', 'trim', 'text',$attr_norumah);
*/


/*
|--------------------------------------------------------------------------
| Landing pages
|
| List of landing pages for redirection. I had this separated so you can eventually redirect it
| to your own controller with flashdata to restrict its viewing.
|--------------------------------------------------------------------------
*/
$config['login-success'] = 'welcome';
$config['logout-success'] = FALSE; // Set FALSE for landing page in /views/landing/, '' for home, or 'controller' for your custom controller

/*
|--------------------------------------------------------------------------
| Security settings
|
| The library uses PasswordHash library for operating with hashed passwords.
| 'phpass_hash_portable' = Can passwords be dumped and exported to another server. If set to FALSE then you won't be able to use this database on another server.
| 'phpass_hash_strength' = Password hash strength.
|--------------------------------------------------------------------------
*/
$config['phpass_hash_portable'] = FALSE;
$config['phpass_hash_strength'] = 8;

/*
|--------------------------------------------------------------------------
| Registration settings
|
| 'allow_registration' = Registration is enabled or not
| 'captcha_registration' = Registration uses CAPTCHA
| 'email_activation' = Requires user to activate their account using email after registration.
| 'email_activation_expire' = Time before users who don't activate their account getting deleted from database. Default is 48 hours (60*60*24*2).
| 'email_account_details' = Email with account details is sent after registration (only when 'email_activation' is FALSE).
| 'use_username' = Username is required or not.
|
| 'username_min_length' = Min length of user's username.
| 'username_max_length' = Max length of user's username.
| 'password_min_length' = Min length of user's password.
| 'password_max_length' = Max length of user's password.
|--------------------------------------------------------------------------
*/
$config['allow_registration'] = TRUE;
$config['captcha_registration'] = FALSE;
$config['email_activation'] = FALSE;
$config['email_activation_expire'] = 60*60*24*2;
$config['email_account_details'] = FALSE;
$config['use_username'] = TRUE;

// To manually approve accounts, set this to FALSE
$config['acct_approval'] = TRUE;

$config['username_min_length'] = 4;
$config['username_max_length'] = 20;
$config['password_min_length'] = 4;
$config['password_max_length'] = 20;

/*
|--------------------------------------------------------------------------
| Login settings
|
| 'login_by_username' = Username can be used to login.
| 'login_by_email' = Email can be used to login.
| You have to set at least one of 2 settings above to TRUE.
| 'login_by_username' makes sense only when 'use_username' is TRUE.
|
| 'login_record_ip' = Save in database user IP address on user login.
| 'login_record_time' = Save in database current time on user login.
|
| 'login_count_attempts' = Count failed login attempts.
| 'login_max_attempts' = Number of failed login attempts before CAPTCHA will be shown.
| 'login_attempt_expire' = Time to live for every attempt to login. Default is 24 hours (60*60*24).
|--------------------------------------------------------------------------
*/
$config['login_by_username'] = FALSE;
$config['login_by_email'] = TRUE;
$config['login_record_ip'] = TRUE;
$config['login_record_time'] = TRUE;
$config['login_count_attempts'] = TRUE;
$config['login_max_attempts'] = 5;
$config['login_attempt_expire'] = 60*60*24;

/*
|--------------------------------------------------------------------------
| Auto login settings
|
| 'autologin_cookie_name' = Auto login cookie name.
| 'autologin_cookie_life' = Auto login cookie life before expired. Default is 2 months (60*60*24*31*2).
|--------------------------------------------------------------------------
*/
$config['autologin_cookie_name'] = 'autologin';
$config['autologin_cookie_life'] = 60*60*24*31*2;

/*
|--------------------------------------------------------------------------
| Forgot password settings
|
| 'forgot_password_expire' = Time before forgot password key become invalid. Default is 15 minutes (60*15).
|--------------------------------------------------------------------------
*/
$config['forgot_password_expire'] = 60*15;

/*
|--------------------------------------------------------------------------
| Cool Captcha settings
|
| When upgraidng Cool Captcha, simple replace the contents of the captcha folder
| with the new version. No editing required.
|--------------------------------------------------------------------------
*/
$config['cool_captcha_folder'] = 'captcha';

/*
|--------------------------------------------------------------------------
| reCAPTCHA
|
| 'use_recaptcha' = Use reCAPTCHA instead of common captcha
| You can get reCAPTCHA keys by registering at http://recaptcha.net
|--------------------------------------------------------------------------
*/
$config['use_recaptcha'] = FALSE;
$config['recaptcha_public_key'] = '';
$config['recaptcha_private_key'] = '';

/*
|--------------------------------------------------------------------------
| Database settings
|
| 'db_table_prefix' = Table prefix that will be prepended to every table name used by the library
| (except 'ci_sessions' table).
|--------------------------------------------------------------------------
*/
$config['db_table_prefix'] = '';


/* End of file tank_auth.php */
/* Location: ./application/config/tank_auth.php */