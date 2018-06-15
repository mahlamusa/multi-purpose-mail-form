<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://lindeni.co.za
 * @since      1.0.0
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/public
 * @author     mahlamusa <mahlamusa@gmail.com>
 */
class Multi_Purpose_Mail_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		//add shortcodes
		add_shortcode('mpmfcustom', array($this, 'mpmf_display_form') );
		add_shortcode('mpmf',array($this, 'mpmf_default_form'));
		
		add_shortcode('supportlink',array($this,'link_to_developer') );
		add_shortcode('mpmfcaptcha', array($this,'show_recaptcha') );
		add_shortcode('mpmfcountries', array($this,'countries_shortcode') );
		add_shortcode('mpmfstates', array($this,'countries_states') );
		
		$this->mpmf_make_uploads_dir();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Multi_Purpose_Mail_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Multi_Purpose_Mail_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/multi-purpose-mail-form-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Multi_Purpose_Mail_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Multi_Purpose_Mail_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/multi-purpose-mail-form-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function countries_shortcode($atts = array()){
		$countries = new Multi_Purpose_Mail_Form_Countries();
		
		$atts = shortcode_atts(
			array(
				'id	'		=> "country",
				'name'		=> "country",
				'selected'	=> ""
			), $atts, 'mpmfcountries'
		);
		
		return $countries->print_countries( $atts['id'], $atts['name'], $atts['selected'] );
	}
	
	public function states_shortcode($atts = array()){
		$states = new Multi_Purpose_Mail_Form_Countries();
		
		$atts = shortcode_atts(
			array(
				'country'	=> 'ZA',
				'id'		=> "state",
				'name'		=> "state",
				'selected'	=> ""
			), $atts, 'mpmfstates'
		);
		
		return $states->print_states( $atts['country'], $atts['id'], $atts['name'], $atts['selected'] );
	}
	
	/*
	* Read POST values for Custom Form
	* Check if values are set
	* Create proper message
	* The xustom form is limited to 20 fields, which we think is reasonable for a form
	*/
	public function mpmf_process_custom_form(){	
		if( isset( $_POST['custom_form_action'] ) && $_POST['custom_form_action']=="send_data"){
			global $wpdb;
			$message 			= "";
			$count 				= $_POST['count'];
			$countcalculated 	= $_POST['countcalculated'];
			$form_name			= $_POST['form_name'];
			
			$count_files 		= $_POST['count_files'];
			
			$mpmf_form_id 		= $_POST['mpmf_form_id'];
			
			if ( isset ( $_POST['email_index'] ) ) {
				$email_index 	= $_POST['email_index'];
			}
			else $email_index 	= "";
			
			/**
			* Message status messages
			*/
			$email_options = get_option('mpmf_email_options');
			if ( !$email_options ){
				$email_options = array(
					'mpmf_default_subject'			=>'New contact via your website',
					'mpmf_email_auto_responder'		=>'Hello, thank you for contacting us. This is to confirm that we received your message. An agent will contact you shortly.',
					'mpmf_auto_responder_subject'	=>get_siteinfo('name') . ' : We received your email.',
					'mpmf_auto_responder_sent'		=>'We have sent an email to the email address you provided.',
					'mpmf_auto_responder_not_sent'	=>'We could not send an email to the email address provided. This email was to acknowledge that we received your email.',
					'mpmf_send_email_copy_to_sender'=>'send',
					'mpmf_message_sent'				=>'Thank you, your message has been sent. We will contact you shortly',
					'mpmf_message_not_sent'			=>'Sorry! Your message was not sent, please try again.',
					'mpmf_form_not_complete_message'=>'The form is not complete, please fill in all required fields.',
					'mpmf_data_validation_errors'	=>'The data you have provided in not in the required format. Please check and submit again.',
					'mpmf_other_error_message'		=>'Message was not sent. Please use another method to contact us.',
					'mpmf_invalid_phone_number'		=>'Invalid phone number',
					'mpmf_invalid_email_address'	=>'Invalid email address'
				);
			}
			
			$mpmf_thank_you_message = $email_options['mpmf_message_sent'];
			$mpmf_error_message 	= $email_options['mpmf_message_not_sent'];
			$mpmf_auto_respond_text = $email_options['mpmf_email_auto_responder'];
			
			$default_email 			= get_option('mpmf_email_to_us');
			$webmaster_email 		= $default_email;
			
			$out = "";
			# validation variables
			$valid = true;
			$err_msg = "";
			
			$message .= '<table width="60%" align="center" border="0" cellspacing="0" >';
			//check if it is not one of the predefined fields
			if ( isset ( $_POST["first_name"] ) ){
				$first_name = $_POST["first_name"];
				$message .= '<tr><td>First Name</td><td>' . $first_name . '</td></tr>';
				if ($first_name == "") $err_msg .="<p>Please enter your name.</p>";
			}
			
			if ( isset( $_POST["last_name"] ) ) {
				$last_name = $_POST["last_name"];
				$message .= '<tr><td>Last Name</td><td>' . $last_name . '</td></tr>';
				
			}
			 
			if ( isset ( $_POST["email_address"] ) ){
				$email_address = $_POST["email_address"];
				$message .= '<tr><td>Email Address</td><td>' . $email_address . '</td></tr>';
				if ( $email_address == "") $err_msg = "<p>Please enter youremail address.</p>";
			}
			
			if ( isset ( $_POST["phone_number"] ) ){
				$phone_number = $_POST["phone_number"];
				$message .= '<tr><td>Phone Number</td><td>' . $phone_number . '</td></tr>';
			}
			
			if ( isset ( $_POST["street_address"] ) ){
				$street_address = $_POST["street_address"];
				$message .= '<tr><td>Street Address</td><td>' . $street_address . '</td></tr>';
			}
			
			if ( isset ( $_POST["city"] ) ){
				$city = $_POST["city"];
				$message .= '<tr><td>City</td><td>' . $city . '</td></tr>';
			}
			
			if ( isset ( $_POST["state"] ) ){
				$countries = new Multi_Purpose_Mail_Form_Countries();
				$state = $_POST["state"];
				$message .= '<tr><td>State</td><td>' . $state . '</td></tr>';
			}
			
			if ( isset ( $_POST["country"] ) ){
				$country = $_POST["country"];
				$countries = new Multi_Purpose_Mail_Form_Countries();
				$message .= '<tr><td>State</td><td>' . $countries->name_country( $country ) . '</td></tr>';
			}
			
			if ( isset ( $_POST["zip"] ) ){
				$zip_code = $_POST["zip"];
				$message .= '<tr><td>Zip / Postal Code</td><td>' . $zip_code . '</td></tr>';
			}
			//
			for ( $c = 1; $c < $count; $c ++ ){
				# if f1 - f$count
				if( isset ( $_POST['f'.$c] ) && $_POST['f'.$c] != "" ){
					if ( $c == $email_index ) $applicant_email = stripslashes($_POST['f'.$c]);
					$message .= '<tr><td>' . stripslashes( $_POST['field_label'.$c] ) . '</td><td>' . stripslashes( $_POST['f'.$c] ) . '</td></tr>'; 
					
				}/*else{
					$err_msg .= "Please type something for '" . stripslashes( $_POST['field_label'.$c] ) . "'<br />";
					$valid = false;
				}*/
			}
			
			
			/**
			* Upload files
			*
			*/
			
			if ( !defined ('MPMF_UPLOADS_DIR') )
				$this->mpmf_make_uploads_dir();
				
			for ( $i = 1; $i <= $count_files; $i ++ ){
				$file_name 		= $_FILES["file".$i]["name"]; // The file name
				$file_tmp_loc 	= $_FILES["file".$i]["tmp_name"]; // File in the PHP tmp folder
				$file_type 		= $_FILES["file".$i]["type"]; // The type of file it is
				$file_size 		= $_FILES["file".$i]["size"]; // File size in bytes
				$file_error_msg = $_FILES["file".$i]["error"]; // 0 for false... and 1 for true
				
				if ($file_tmp_loc) { // if file not chosen
					if(move_uploaded_file($file_tmp_loc, MPMF_UPLOADS_DIR .'/' .$file_name)){
						$file_url = WP_CONTENT_URL . '/uploads/mpmf_uploads/' .$file_name;
						$message .= '<tr>
							<td></td>
							<td>
								<a href="'.$file_url.'" target="_blank"><i class="fa fa-download"></i> ' . $file_name . '</a><br />
								<small class="text-muted">Name: ' . $file_name . ', Type: ' . $file_type . ', Size: ' . ( $file_size / 1000) .' Kb</small>' .'
							</td>
						</tr>';
					} else {
						$message .= '<tr><td></td>
							<td>There was a problem with the file => Name: ' . $file_name . ', Type: ' . $file_type . 'Size: ' .$file_size
							.'<td></tr>';
					}
				}
			}
			
			
			$message .= '</table>';
			
			$date = date("Y-m-d") . '-' . date('H-i-s');
			$email_address = (isset($_POST["email_address"])?$_POST["email_address"]: $webmaster_email);
				
			if( $err_msg == "" && $valid ){
				$headers = "";
				$headers .= "From: Your Website <" . $webmaster_email . ">\r\n";
				$headers .= "Return-Path: <".$email_address.">\r\n";
				$headers .= "Reply-To:  <".$email_address.">\r\n";
				$headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				//insert into database
				$wpdb->insert(
					$wpdb->prefix.'mpmf_messages',
					array('date_sent'=>$date, 'mpmf_form_id'=>$mpmf_form_id, 'message_data'=>$message,'message_status'=>0),
					array('%s', '%d', '%s','%d')
				);
				
				/*if ( $webmaster_email == "" && isset ( $applicant_email ) ){
					$email_address = $applicant_email;	
				}*/
				
				$subject = ( isset($email_options['mpmf_default_subject']) && $email_options['mpmf_default_subject'] != "")? $email_options['mpmf_default_subject']: 'New contact via your website';
				
				if(wp_mail($webmaster_email,$subject,$message,$headers)){
					$out .= '<div class="alert alert-success" style="padding: 15px;">' . $email_options['mpmf_message_sent'] ;
					
					if ( $email_options['mpmf_send_email_copy_to_sender'] == 'send' ) {
						
						$message = '<p>'.$email_options['mpmf_email_auto_responder'] .'</p>'. $message;
						
						$responder_subject = ( isset($email_options['mpmf_auto_responder_subject']) ? $email_options['mpmf_auto_responder_subject']: "Thank you for your message. We will get in touch");
						
						if ( wp_mail( $email_address, $responder_subject, $message, $headers ) )
							$out .= '<p>' . $email_options['mpmf_auto_responder_sent'] . '</p>';	
						else
							$out .= '<p>' . $email_options['mpmf_auto_responder_not_sent'] . '</p>';
					}
					/*else{
						if ( wp_mail( $email_address, $email_options['auto_responder_subject'], $email_options['email_auto_responder'], $headers ) )
							$out .= '<p>' . $email_options['auto_responder_sent'] . '"</p>';	
						else
							$out .= '<p>' . $email_options['auto_responder_not_sent'] . '</p>';
					}*/
					$out .= '</div>';
				}else{
					$out .= '<div class="alert alert-danger"><p>' . $email_options['mpmf_message_not_sent']. '</p></p>';	
				}
				return $out;
			}
			else{
				$out .= '<div class="alert alert-warning"><p>' . $email_options['mpmf_data_validation_errors'] .'</p>';
				$out .= '<p>' . $email_options['mpmf_form_not_complete_message'] . '<p>';
				$out .= '<p><input type="button btn btn-primary" onclick="history.go(-1);" value="Try again"></p></div>';	
				return $out;
			}
			return $out;
		}
		return '<p>No data received.</p>';
	}
	
	/**
	* Return a form given an the mpmf_form_id
	* return the shortcode
	*/
	public function mpmf_display_form($atts=null, $content=null){
		global $wpdb;
		
		$form = "";
		
		extract( shortcode_atts( array('id'=>'' ),$atts) );
		if($content){
			$form .= $content . '<br /><br />';
		}
		
		// if some data have been $_POSTed, process the data and return some results
		if ( isset ( $_POST["custom_form_action"] ) ) {
			return $form .= $this->mpmf_process_custom_form();
		}	
		
		//else display the form
		$t = "\t";
		$t2 = "\t\t";
		$t3 = $t. $t2;
		$t4 = $t2 .$t2;
		$t5 = $t4 . $t;
		$n = "\n";
		
		
		$form .= '' . $n;/* must reveal form on the display mode: <form action="" method="POST" enctype="application/x-www-form-urlencoded" name="customForm" onsubmit="return validate_custom_form();">*/
		
		if( $id ){	
			$fields_table 		= $wpdb->base_prefix . 'mpmf_form_fields';
			$forms_table 		= $wpdb->base_prefix . 'mpmf_forms';
			$options_table_name = $wpdb->base_prefix.'mpmf_field_options';
			
			$form_name 			= $wpdb->get_var("SELECT mpmf_form_name FROM $forms_table WHERE mpmf_form_id='".$id."'");
			$fields 			= $wpdb->get_results("SELECT * FROM $fields_table WHERE mpmf_form_id='".$id."' ORDER BY field_sort_order");
			
			if ( !$fields ) { return $form .= 'This form does not have any fields to display.'; }
			/*enctype="application/x-www-form-urlencoded"*/
			$form .=  '<form action="" method="POST" enctype="multipart/form-data" name="contactForm" onsubmit="return validate_form();">';
			$form .= $t4 .'<table class="form-table table" width="100%" border="0" id="formpreview">' . $n;
			
			# important, creates field and labels for email to be sent, also makes validation easier for long forms
			$count = 1; # very important
			$countcalculated = 1;
			# 'f $count ' creates a new name for the field input for data validation
			
			$count_files = 0;
			
			//print_r($fields);
			foreach($fields as $field){	
				if ( $field->field_editmode == 'readonly') $readonly = "readonly";
				else $readonly = "";
				
				$form .= $t4 . '<tr>' . $n;
				$form .= $t5 . '<td style="width: 35%;" align="left" valign="top">' .$n;
				$form .= $t5 . '<input type="hidden" name="form_name" value="'.$form_name.'" />';
				
			
				
				//check if it is one of the predefined fields
				if ( $field->field_name == "first_name"){
					$form .= $t5 . '<label for="first_name">First Name</label></td>' .$n;
					$form .= $t5 . '<td>';
					$form .= '<input type="'.$field->field_type. '" name="'.$field->field_name. '" class="form-control input" placeholder="' .$field->field_default. '" '.$readonly.'/>';
				}
				elseif ($field->field_name == "last_name") {
					$form .= $t5 . '<label for="last_name">Last Name</label></td>' .$n;
					$form .= $t5 . '<td>';
					$form .= '<input type="'.$field->field_type. '" name="'.$field->field_name. '" class="form-control input" placeholder="' .$field->field_default. '" '.$readonly.'/>';
				}				 
				elseif ( $field->field_name == "email_address" ){
					$form .= $t5 . '<label for="email_address">Email Address</label></td>' .$n;
					$form .= $t5 . '<td>';
					$form .= '<input type="'.$field->field_type. '" name="'.$field->field_name. '" class="form-control input" placeholder="' .$field->field_default. '"  '.$readonly.'/>';
				}
				elseif ( $field->field_name == "phone_number" ){
					$form .= $t5 . '<label for="phone_number">Phone Number</label></td>' .$n;
					$form .= $t5 . '<td>';
					$form .= '<input type="'.$field->field_type. '" name="'.$field->field_name. '" class="form-control input" placeholder="' .$field->field_default. '" '.$readonly.'/>';
				}
				else{
					//calculated fields and basecost field must be hiidden from the front end
					if ($field->field_type=="calculated" ){
						//$form .= $t5 . '<label for="calculated_'.$countcalculated.'">' . $field->field_label . '</label></td>' .$n;
						$form .= $t5 . '<td>';
						$formula_table = $wpdb->base_prefix.'mpmf_field_formulae';
						$formula = $wpdb->get_var("SELECT formula FROM $formula_table WHERE field_id='" . $field->field_id ."'");
						
						$form .= '<input type="hidden" class="calculated" name="calculated_'.$countcalculated.'" value="'.$field->field_value.'" '.$readonly.'/>';
						$form .= '<input type="hidden" class="formula" name="formula_'.$countcalculated.'" value="' .stripslashes($formula).'" />';
						//$form .= '<input type="hidden" class="formula" name="formulas[]" value="' .$formula.'" />';
						//count calculated fields
						$countcalculated += 1;
					}
					elseif ($field->field_type=="basecost" ){
						//$form .= $t5 . '<label for="basecost">' . $field->field_label . '</label>' .$n;
						$form .= $t5 . '<td>';
						$form .= '<input type="hidden" class="basecost" name="basecost" value="'.$field->field_value.'" readonly/>';
						//count calculated fields
						//$countbasecost += 1;
					}
					
					else{
						
						//hide label if is captcha
						if($field->field_type != "recaptcha" && $field->field_type != "submit") {
							$form .= $t5 . '<label for="f'.$count.'">' . $field->field_label . '</label></td>' .$n;
							$form .= $t5 . '<td>';
						}					
						
						//detect email address
						if ( $field->field_type == "email"){
							$form .= '<input type="hidden" name="email_index" id="email_index" value="'.$count.'" />';	
						}
						
						if( $field->field_type == "textarea" ){
							# if textarea, create textarea preview
							$form .= '<textarea name="f'.$count.'" placeholder="' .$field->field_default. '" class="form-control input" '.$readonly.'>'.$field->field_value.'"</textarea>';
						}
						elseif($field->field_type == "select"){
							# if list/select
							# must have select list options loaded
							# if list/select
							# 'f $count ' creates a new name for the field input for data validation
							$field_options = $wpdb->get_results("SELECT * FROM $options_table_name WHERE mpmf_field_id='" . $field->field_id ."'");
							
							if ( $field_options ){
								$form .= '<select name="f' . $count . '" '.$readonly.' class="form-control input">';			
								foreach( $field_options as $option ) {
									$form .= '<option value="' . $option->mpmf_option_value . 
									'" >' . $option->mpmf_option_label. '</option>';
								}
								$form .= '</select>';
							}else{
								$form .= '<input type="text" name="f'. $count .
								'" placeholder="type your answer" value="'.$field->mpmf_field_value.'" class="form-control input" /><br /><small>No options set: </small>';
							}
						}
						elseif($field->field_type == "radio"){
							# radio must have options
							# do a while loop to check for the radio name and options
							# 'f $count ' creates a new name for the field input for data validation
							$field_options = $wpdb->get_results("SELECT * FROM $options_table_name WHERE mpmf_field_id='" . $field->field_id ."'");
							
							if ( $field_options ){
								foreach( $field_options as $option ) {
									$form .= '<span class="fieldoption"><input name="f'.$count . 
									'" type="radio" value="' . $option->mpmf_option_value . '" '.$readonly.'/> ' . $option->mpmf_option_label .'</span><br />';
								}
							}else{
								$form .= '<input type="text" name="f'.$count . 
								'" placeholder="type your answer" /><br /><small>No options set:</small>';
							}
						}
						elseif($field->field_type == "checkbox"){
							$field_options = $wpdb->get_results("SELECT * FROM $options_table_name WHERE mpmf_field_id='" . $field->field_id ."'");
							
							if ( $field_options ){
								foreach( $field_options as $option ) {
									$form .= '<span class="fieldoption"><input type="checkbox" name="f'.$count.'" value="'. $option->option_value . '" />  ' . $option->option_label . '</span><br />';
								}
							}else{
								$form .= '<input type="text" name="f'.$count . 
								'" placeholder="type your answer" class="form-control input" /><br /><small>No options set:</small>';
							}
						}
						
						elseif($field->field_type == "file" ) {
							$count_files += 1;
							$form .= '<input type="file" name="file'.$count_files .'" />';
						}
						
						elseif($field->field_type == "countries" ) {
							$form .= do_shortcode('[mpmfcountries]');
						}
						
						elseif($field->field_type == "recaptcha" ) {
							//do nothing
						}
						else{
							# text, number, email, tel' .$field['field_name'].  '
							$form .= '<input name="'.$field->field_name.'" placeholder="' .$field->field_default. '" type="'.$field->field_type. '" class="form-control input" '.$readonly.' />';
						}
						
						
						# hide and submit the field label 
						$form .= '<input type="hidden" name="field_label'.$count.'" value="' . $field->field_label . '">';
						
						//increment un-known field count
						$count += 1;
					}
				}
				$form .= '</td>' . $n;
				$form .= $t4 .  '</tr>' . $n;
				
				
			}
			$form .= $t4 . '<tr>' . $n;
			$form .= $t5 . '<td>&nbsp;</td>' . $n;
			$form .= $t5 . '<td>
						<input type="hidden" name="countcalculated" id="countcalculated" value="'.$countcalculated.'" />
						<input type="hidden" name="count_files" value="'. $count_files . '" />
						<input type="hidden" name="count" value="' . $count . '" >
						<input type="hidden" name="mpmf_form_id" value="' . $id .'" />
						<input type="hidden" name="custom_form_action" value="send_data">';
						
						//if the form has captcha
						if ( $this->form_has_captcha($id) ):
							$form .= do_shortcode('[mpmfcaptcha]');
						endif;
						
						$admin = new Multi_Purpose_Mail_Form_Admin('multi-purpose-mail-form','1.0.0');						
						//if the form has a custom submit button
						if (!$admin->formHasSubmit($id)) :
							$form .=	'<input name="send" type="submit" value="Submit" class="button button-primary btn btn-primary" />';
						endif;
						
			$form .=	'</td>' . $n;
			$form .= $t4 . '</tr>' . $n;		
			$form .= $t4 . "</table>" . $n;
			$form .= "</form>";
			
			return $form;
			
		}else{
			$form .= "It seems as if there is no form to display.";
		}
		
		if ( !isset ( $_POST["custom_form_action"] ) )
			return $form;
	}
	
	/*
	* The following funtion displays the default form without creating any options
	* Customizing this form will require editing the html table, adding new fields and then updating the actions form
	*
	* this form only uses the contact details supplied by the user on the admin page
	*/
	function mpmf_default_form($atts=null, $content=null){
		global $wpdb;	
		$send_to_us = get_option("mpmf_email_to_us");
		$form = "";
		
		$options = get_option('mpmf_default_form_options');
		if ( !$options ){
			$options = array(
				'show_contact_phone'	=> 'default',
				'show_contact_email_address'=> 'default',
				
				'show_email_subject'	=> 'default',
				'show_title'			=> 'default',
				'show_first_name'		=> 'default',
				'show_last_name'		=> 'default',										
				'show_telephone'		=> 'default',
				'show_email_address'	=> 'default',
				'show_query'			=> 'default',
				'show_how_to_contact'	=> 'default',
														
				'email_subject_label'	=> 'Email Subject',
				'title_label'			=> 'Title',										
				'first_name_label'		=> 'First Name',
				'last_name_label'		=> 'Last Name',
				'email_address_label'	=> 'Email Address',
				'telephone_label'		=> 'Telephone/Mobile',
				'query_label'			=> 'Your query / Question',
				'how_to_contact_label'	=> 'How can we contact you?',
				
				'mpmf_show_credit_link'	=> 'dont_show_link'										
			);
		}
		/**
		* Message status messages
		*/
		$email_options = get_option('mpmf_email_options');
		if ( !$email_options ){
			$email_options = array(
				'mpmf_default_subject'		=> 'New contact via your website',
				'email_auto_responder'		=> 'Hello, thank you for contacting us. This is to confirm that we received your message. An agent will contact you shortly.',
				'auto_responder_subject'	=> siteinfo('blogname') . ' : We received your email.',
				'auto_responder_sent'		=> 'We have sent an email to the email address you provided.',
				'auto_responder_not_sent'	=> 'We could not send an email to the email address provided. This email was to acknowledge that we received your email.',
				'send_email_copy_to_sender'	=> 'send',
				'message_sent'				=> 'Thank you, your message has been sent. We will contact you shortly',
				'message_not_sent'			=> 'Sorry! Your message was not sent, please try again.',
				'form_not_complete_message'	=> 'The form is not complete, please fill in all required fields.',
				'data_validation_errors'	=> 'The data you have provided in not in the required format. Please check and submit again.',
				'other_error_message'		=> 'Message was not sent. Please use another method to contact us.',
				'invalid_phone_number'		=> 'Invalid phone number',
				'invalid_email_address'		=> 'Invalid email address'
			);
		}
		
		if( isset( $_POST['def_form_action'] ) ) {
			if ( $options['show_email_subject'] != 'hide_email_subject')
				$request = stripslashes( $_POST['req_info'] );
				
			if ( $options['show_title']  != 'hide_title')	
				$title	 = stripslashes( $_POST['title'] );
				
			if ( $options['show_first_name'] != 'hide_first_name' )	
				$fname	 = stripslashes( $_POST['fname'] );
			
			if ( $options['show_last_name'] != 'hide_last_name' )
				$lname	 = stripslashes( $_POST['lname'] );
				
			if ( $options['show_email_address'] != 'hide_email_address' )
				$email	 = stripslashes( $_POST['email'] );
				
			if ( $options['show_telephone'] != 'hide_telephone' )
				$phone	 = stripslashes( $_POST['phone'] );
				
			if ( $options['show_query'] != 'hide_query' )
				$message = stripslashes( $_POST['message'] );
				
			if ( $options['show_how_to_contact'] != 'hide_how_to_contact' )
				$contby	 = stripslashes( $_POST['contby'] );
			
			#build the email message
			$subject = $request;
			 
			if( isset( $email ) && isset( $phone ) ){
				if( $contby == 'email' ){
					# contact by email	
					$cont_by = "Please contact me by Email at " .$email;
				}
				elseif($contby == 'phone'){
					# contact by phone	
					$cont_by = "Please contact me by Phone " . $phone;
				}
				else{
					$cont_by = "You may use either Phone or Email to contact me. " . "Phone: " . $phone. " Email: ". $email;
				}
				$headers = "To: " . $send_to_us . "\r\n";
				$headers .= "From: " . $title . " " . $fname ." <" . $email . ">\r\n";
				$headers .= "Reply-To: ". $email . "\r\n".
				$headers .=  "X-Mailer: PHP/" . phpversion();
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			}else{
				$headers = "To:" . $send_to_us . "\r\n";
				$headers .= "From: ". $fname . " ". $lname . "\r\n";
				$headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			}	
			#
			$send_message = "Message from: " . $fname . " ". $lname . ".\n\n" . $message ."\n\n" . $cont_by . "\n\n" . "Kind Regards";
			#send the message		
			
			
			# save message in database
			$date = date("Y-m-d H-i-s");
			$wpdb->insert(
				$wpdb->prefix.'mpmf_messages',
				array('date_sent'=>$date, 0, 'message_data'=>$send_message,'message_status'=>0),
				array('%s', '%d', '%s','%d')
			);
			
			#send email to the responsible person's email address
			if(wp_mail($send_to_us, $subject, $send_message, $headers)){# send to -> get_option('mpmf_send_mails_to')
				#message sent
				$form .= '<div class="success-msg"><p class="text-success">'.$email_options['message_sent'].'</p></div>';
				//wp_redirect("/");
				
			}else{			
				#message not sent
				$form .= '<div class="error-msg"><p class="text-danger">'.$email_options['message_not_sent'].'</p></div>';
				//wp_redirect("/");
			}
		}else{
			/*<div id="success" class="message success-msg">
				<h3>Thank you!</h3>
				<p>Your message has been sent successfully.</p>
			</div>
			<div id="error" class="message error-msg">
				<p>Error : Message could not be sent.</p>
			</div>*/
			
			$options = get_option('mpmf_default_form_options');
			if ( !$options ){
				$options = array(
					'show_contact_phone'	=>'default',
					'show_contact_email_address'=>'default',
					
					'show_email_subject'	=>'default',
					'show_title'			=>'default',
					'show_first_name'		=>'default',
					'show_last_name'		=>'default',										
					'show_telephone'		=>'default',
					'show_email_address'	=>'default',
					'show_query'			=>'default',
					'show_how_to_contact'	=>'default',
															
					'email_subject_label'	=>'Email Subject/Reason For Contact',
					'title_label'			=>'Title',										
					'first_name_label'		=>'First Name',
					'last_name_label'		=>'Last Name',
					'email_address_label'	=>'Email Address',
					'telephone_label'		=>'Telephone/Mobile',
					'query_label'			=>'Your query / Question',
					'how_to_contact_label'	=>'How can we contact you?',
					
					'send_button_text'		=>'Submit',
					'reset_button_text'		=>'Clear',
					
					'mpmf_show_credit_link'	=>'dont_show'								
				);
			}
			
			$form ='
			<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="contactForm" onsubmit="return validate_form();">
				<table id="contact-table" width="100%" border="0" class="table">';
			
			if ( $options['show_email_subject'] != 'hide_email_subject'){	  
				$form .='<tr>
					<td>
						' . $options['email_subject_label'] . '
						(<font color="red">*</font>)</td>
					<td><input name="req_info" type="text" value="" class="form-control input-lg"/></td>
				  </tr>';
			}
			
			if ( $options['show_title']  != 'hide_title'){
				$form .='<tr>
					<td>' . $options['title_label'] . '</td>
					<td>
						<label><input name="title" type="radio" value="mr" /> Mr.</label> |
						<label><input name="title" type="radio" value="mrs" /> Mrs.</label> | 
						<label><input name="title" type="radio" value="ms" /> Ms.</label>
					</td>
				  </tr>';
			}
			
			if ( $options['show_first_name'] != 'hide_first_name' ){
				$form .='<tr>
						<td>' . $options['first_name_label'] . ' (<font color="red">*</font>)</td>
						<td><input name="fname" type="text" value="" class="form-control input-lg"/></td>
					  </tr>';
			}
			
			if ( $options['show_last_name'] != 'hide_last_name' ){
				$form .='<tr>
						<td>' . $options['last_name_label'] . ' (<font color="red">*</font>)</td>
						<td><input name="lname" type="text" value="" class="form-control input-lg"/></td>
					  </tr>';
			}
			
			if ( $options['show_email_address'] != 'hide_email_address'){
				$form .='<tr>
						<td>' . $options['email_address_label'] . '</td>
						<td><input name="email" type="text" value="" class="form-control input-lg"/></td>
					  </tr>';
			}
			
			if ( $options['show_telephone'] != 'hide_telephone' ){
				$form .='<tr>
						<td>' . $options['telephone_label'] . '</td>
						<td><input name="phone" type="text" value="" class="form-control input-lg"/></td>
					  </tr>';
			}
			
			if ( $options['show_query'] != 'hide_query'){
				$form .='<tr>
						<td>' . $options['query_label'] . '(<font color="red">*</font>)</td>
						<td><textarea name="message" cols="40" rows="5" class="form-control input-lg"></textarea></td>
					  </tr>';
			}
			
			if ( $options['show_how_to_contact'] != 'hide_how_to_contact' ){
				$form .='<tr>
					<td>' . $options['how_to_contact_label'] . '(<font color="red">*</font>)</td>
					<td>
			
						<p><input name="contby" type="radio" value="phone" class="radio-inline" /> Phone/Mobile | <input name="contby" type="radio" value="emal" class="radio-inline" /> Email | <input name="contby" type="radio" value="Any" class="radio-inline"  /> Any</p>    	
					</td>
				  </tr>';
			}
				  
			$form .='<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" name="def_form_action" value="send_data">';
						$mpmf_recaptcha_settings = get_option('mpmf_recaptcha_settings');
						if ($mpmf_recaptcha_settings['captcha_default'] == "1" ){
							$form .= do_shortcode('[mpmfcaptcha]');
						}						
			$form .='	<input name="clear" type="reset" value="' . $options['reset_button_text'] . '" class="button btn btn-danger"/>
						<input name="send" type="submit" value="' . $options['send_button_text'] . '" class="button button-primary btn btn-primary"/>
					</td>
				  </tr>
				</table>
			</form>';
		}
		
		if ( $options['mpmf_show_credit_link'] == "show_link"){
			$form .= $this->link_to_developer();	
		}
		return $form;
	}
	
	public function link_to_developer(){
		$link = '<p><small><a href="http://mahlamusa.co.za" rel="bookmark" title="Custom Wordpress Plugins Developer" target="_blank">Custom wordpress plugins</a> by <a href="http://lindeni.co.za">mahlamusa</a></small></p>';
		return $link;
	}
	
	public function mpmf_make_uploads_dir (){
		$mpmf_uploads_dir =  WP_CONTENT_DIR . "/uploads/mpmf_uploads"; //always use wp_content_dir instead of _url
		if ( wp_mkdir_p ( $mpmf_uploads_dir ) ) {
			define( 'MPMF_UPLOADS_DIR', $mpmf_uploads_dir );
			return true;
		}
		else{
			if ( mkdir ( $mpmf_uploads_dir ) ) {
				define( 'MPMF_UPLOADS_DIR', $mpmf_uploads_dir );	
				return true;
			}
		}
		return false;
	}
	
	public function show_recaptcha(){
		/**
		* Load the recaptcha library
		*/
		$mpmf_recaptcha_settings = get_option('mpmf_recaptcha_settings');
		$sitekey = $mpmf_recaptcha_settings['recaptcha_public_key']; // you got this from the signup page
		$publickey = $mpmf_recaptcha_settings['recaptcha_public_key']; // you got this from the signup page
		
		//if captcha enable on custom forms || enabled on default form
		if ( $mpmf_recaptcha_settings['enablecaptcha'] == 1 || $mpmf_recaptcha_settings['captcha_default'] == 1){
			if ( $mpmf_recaptcha_settings['captchamode'] == "notabot" ){ //Google "I am not a bot" checkbox
				$capt = '<div id="recaptcha"></div>
				<script type="text/javascript">
					var widgetId1;
					var onloadCallback = function() {
						widgetId1 = grecaptcha.render("recaptcha", {
						  "sitekey" : "'.$sitekey.'",
						  "theme" : "light"
						});
					};
				</script>';
				$capt .= '<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>';
				return $capt;
			}else{ //else display an image with words, user must type words
				require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/recaptchalib.php';			
				return recaptcha_get_html($publickey);
			}
		}
	}
		
	
	public function form_has_captcha($form_id){
		global $wpdb;
		$fields_table = $wpdb->prefix . 'mpmf_form_fields';
		$recaptcha = $wpdb->get_var("SELECT field_type FROM $fields_table WHERE field_type='recaptcha' AND mpmf_form_id='{$form_id}' LIMIT 1");
		if ( $recaptcha=='recaptcha') return true;
		else return false;
	}
}