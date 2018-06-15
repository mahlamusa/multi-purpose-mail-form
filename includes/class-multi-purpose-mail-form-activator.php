<?php

/**
 * Fired during plugin activation
 *
 * @link       http://lindeni.co.za
 * @since      1.0.0
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/includes
 * @author     mahlamusa <mahlamusa@gmail.com>
 */
class Multi_Purpose_Mail_Form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	 
	public static function activate() {
		global $wpdb;
    	require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		
		
		
		//get all tables in the current database
		$dbname = DB_NAME; # wordpress database name
		$tables = $wpdb->get_results("SHOW TABLES FROM $dbname", ARRAY_A);
		
		$arr = array();
		
		for( $i = 0; $i < count( $tables ); $i++ ){
			$arr[] = $tables[$i]['Tables_in_'.$dbname];
		}
		
		//table names
		$old_forms_table_name = 'mpmf_form';
		$new_forms_table_name = $wpdb->prefix. 'mpmf_forms';
		$old_fields_table_name = 'mpmf_form_fields';
		$new_fields_table_name = $wpdb->prefix. 'mpmf_form_fields';
		$old_options_table_name = 'mpmf_field_options';
		$new_options_table_name = $wpdb->prefix. 'mpmf_field_options';
		$messages_table_name = $wpdb->prefix.'mpmf_messages';
		
		/**
		* Rename old table if they exist
		* or create new ones
		* old forms table: mpmf_form, new forms table: $wpdb->prefix.'mpmf_form'
		* old fields table: mpmf_form_fields, new forms table: $wpdb->prefix.'mpmf_form_fields' 
		* old field options table: mpmf_field_options, new field options table: $wpdb->prefix.'mpmf_field_options' 
		*/
		if ( in_array($old_forms_table_name, $arr) ) {
			$wpdb->query("RENAME TABLE $old_forms_table_name TO $new_forms_table_name");
			$wpdb->query("RENAME TABLE $old_fields_table_name TO $new_fields_table_name");			
			$wpdb->query("ALTER TABLE `$old_fields_table_name` CHANGE `form_id` `mpmf_form_id` INT( 11 ) NULL DEFAULT NULL");
			$wpdb->query("ALTER TABLE ADD `field_value` TEXT NULL DEFAULT NULL");
			$wpdb->query("ALTER TABLE ADD `field_editmode` VARCHAR(8) NOT NULL DEFAULT 'editable'");
			$wpdb->query("ALTER TABLE ADD `field_css_id` TEXT NULL DEFAULT NULL");
			$wpdb->query("RENAME TABLE $old_options_table_name TO $new_options_table_name");
		}
		
		/**
		* add options: 
		* email address and phone number
		*/
		add_option('mpmf_email_to_us',get_option('admin_email'),'', 'yes');
		add_option('mpmf_phone_us','000 000 0000','', 'yes');
		add_option('mpmf_installed','true','','yes');
		
		/**
		* Default form options
		**/
		$form_options = get_option('mpmf_default_form_options');
		if ( !$form_options ){
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
				'reset_button_text'		=>'Clear'									
			);		
			update_option( 'mpmf_default_form_options', $form_options );
		}
		
		$email_options = get_option('mpmf_email_options');
		if ( !$email_options ){
			$email_options = array(
				'mpmf_email_auto_responder'		=>'Hello, thank you for contacting us. This is to confirm that we received your message. An agent will contact you shortly.',
				'mpmf_auto_responder_subject'	=>get_bloginfo('name') . ' : We received your email.',
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
			update_option('mpmf_email_options', $email_options);
		}
		/**
		* Google captcha settings
		*/
		$mpmf_recaptcha_settings = array(
			'enablecaptcha' 		=> 1,
			'captcha_default' 		=> 1,
			'captchamode' 			=> 'notabot',
			'recaptcha_site_key' 	=> '',
			'recaptcha_public_key' 	=> '',
			'recaptcha_secret_key'	=> ''
		);
		update_option('mpmf_recaptcha_settings',$mpmf_recaptcha_settings );
		
		
		
		
		/**
		* create new database tables
		* Create the tables for the newest version of this plugin
		*/
		$create_table = "CREATE TABLE $new_forms_table_name (
				`mpmf_form_id` INT(11) NOT NULL AUTO_INCREMENT ,
				`mpmf_form_name` TEXT NOT NULL ,
				`mpmf_form_type` TEXT NOT NULL ,
				PRIMARY KEY(`mpmf_form_id`))";
		dbDelta( $create_table );
		
		
		/**
		* form fields table
		*/
		$fields_sql = "CREATE TABLE $new_fields_table_name (
							`field_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
							`mpmf_form_id` INT(11), 
							`field_label` TEXT NULL DEFAULT NULL, 
							`field_name` TEXT NULL DEFAULT NULL,
							`field_css_id` TEXT NULL DEFAULT NULL,
							`field_default` TEXT NULL DEFAULT NULL, 
							`field_type` TEXT NULL DEFAULT NULL, 
							`field_value` TEXT NULL DEFAULT NULL,
							`field_editmode` VARCHAR(8) NOT NULL DEFAULT 'editable',
							`field_sort_order` INT(11) DEFAULT 0)";
		
		dbDelta( $fields_sql );
		
    
		/**
		* field options table
		*/
		$options_sql = "CREATE TABLE $new_options_table_name (
						`mpmf_option_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
						`mpmf_field_id` INT(11) NOT NULL, 
						`mpmf_option_label` VARCHAR(50) NOT NULL, 
						`mpmf_option_value` VARCHAR(50) NOT NULL)";
		
		dbDelta( $options_sql );
		
    	
		/**
		* Received messages
		*/
		$messages_sql 	= "CREATE TABLE $messages_table_name(
							message_id INT(11) NOT NULL AUTO_INCREMENT,
							date_sent TEXT DEFAULT NULL,
							mpmf_form_id  INT(11) NOT NULL,							
							message_data TEXT DEFAULT NULL,
							message_status INT(1) NOT NULL DEFAULT 0,
							PRIMARY KEY(message_id)
						)";
		dbDelta( $messages_sql );
	}
}