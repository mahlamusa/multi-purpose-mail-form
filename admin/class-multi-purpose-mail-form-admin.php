<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://lindeni.co.za
 * @since      1.0.0
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/admin
 * @author     mahlamusa <mahlamusa@gmail.com>
 */
class Multi_Purpose_Mail_Form_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	public function mpmf_add_admin_menus(){
		add_menu_page(
            __( 'MPMF', $this->plugin_name ),
            __( 'MPMF', $this->plugin_name ),
            'manage_options',
            'mpmf-forms',
            array( $this, 'mpmf_render_main_admin_page' ),
            'dashicons-email',
            '17.91290858'
        );
		
		add_submenu_page(
            'mpmf-forms',
            __( 'Received', $this->plugin_name ),
            __( 'Received', $this->plugin_name ),
            'manage_options',
            'mpmf-received',
            array( $this, 'mpmf_view_submissions_page' )
        );
		
        add_submenu_page(
            'mpmf-forms',
            __( 'Settings', $this->plugin_name ),
            __( 'Settings', $this->plugin_name ),
            'manage_options',
            'mpmf-settings',
            array( $this, 'mpmf_settings_page' )
        );
		
		add_submenu_page(
            'mpmf-forms',
            __( 'Help', $this->plugin_name ),
            __( 'Help', $this->plugin_name ),
            'manage_options',
            'mpmf-help',
            array( $this, 'mpmf_help_page' )
        );
	}
	
	
	public function mpmf_render_main_admin_page(){
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/multi-purpose-mail-form-admin-display.php';	
	}
	
	
	public function mpmf_view_submissions_page(){
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/multi-purpose-mail-form-admin-view-submissions.php';	
	}
	
	public function mpmf_settings_page(){
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/multi-purpose-mail-form-admin-settings.php';	
	}
	
	public function mpmf_help_page(){
		require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/multi-purpose-mail-form-admin-help.php';	
	}
	
	/*
	* subscribe to plugin development
	* subscription sent from current admin, forward to developer's email address
	* Developer's email address hard coded below
	*/
	
	function mpmf_subscribe_to_dev(){
		$s_email = stripslashes($_POST['asubscribe_email']);
		if($s_email != ""){
			$s_email = $s_email;
		}else{
			# && $send_to_us != "Your receiving email address" && $send_to_us != ""
			$s_email = get_option('mpmf_email_to_us');
		}
		
		if ( $s_email == "" ){
			$err_msg = "You did not give us an email address.";	
		}
		$headers = "";
		$headers .= "From: ". $s_email . "\r\n";
		$headers .= "Reply-To: ". $s_email . "\r\n";
		$headers .= "Return-Path: ". $s_email . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		$message = "Subscribe me for MPMF updates my email address is " . $s_email .""; 
		if ( $s_email == "") {
			echo "<div class='wrap update-nag'>Subscription message not sent, $err_msg. Please enter email address and retry.</div>";
		}
		else{
			if(wp_mail('3pxwebstudios@gmail.com','MPMF Updates subscription',$message,$headers)){
				echo "<div class='wrap updated'><p>Your subscription has been submitted. You have subscribed with email address : <em>$s_email</em></p></div>";
			}else{
				echo '<div class="update-nag"><p>Your subscription was not processed.</p></div>';
			}
		}
	}
	/**
	 * Register the stylesheets for the admin area.
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
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/multi-purpose-mail-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( 'npm', plugin_dir_url( __FILE__ ) . 'js/npm.js', array( 'jquery' ), $this->version, false );
		
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/multi-purpose-mail-form-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-calculator', plugin_dir_url( __FILE__ ) . 'js/multi-purpose-mail-form-calculator.js', array( 'jquery' ), $this->version, false );

	}
	
	
	
	public function add_form_field_form($formid, $field_id, $field_type="",$atts = array()){
		global $wpdb;
		$fields_table = $wpdb->prefix . 'mpmf_form_fields';
		$count = $wpdb->get_var("SELECT COUNT(field_id) AS count FROM $fields_table");
		$count += 1;
		
		if ( empty( $atts ) ){
			$atts=array(
				'field_type'=>'text',
				'fcssid'=>'textfield'.$count,
				'fcssclass'=>'textfield'.$count
			);
		}
		
		if ( isset($field_id) && $field_id != "0" ){		
			$field = $wpdb->get_row("SELECT * FROM $fields_table WHERE field_id='" . $field_id."'");
			
			if ( $field ){
				$flabel 	= $field->field_label;
				$fdefault 	= $field->field_default;
				$fsortorder = $field->field_sort_order;
				$fname 		= $field->field_name;
				$fcssid 	= $field->field_css_id;
				$editmode 	= $field->field_editmode;
				$ftype 		= $field->field_type;
				$fvalue 	= $field->field_value;
			}
			
			if ( $ftype == "file" ){
				$file_atts = $field->field_value;
				$file_size = $file_atts['size'];
				$file_types = $file_atts['file_types'];
			}
			
		}
		else{
			$flabel 	= "";
			$fdefault 	= "";
			$fsortorder = "";
			$fname 		= "";
			$fcssid 	= "";
			$editmode 	= "";
			$ftype 		= $field_type;
			$fvalue 	= "";
			$file_size = "";
			$file_types = "";
		}
		
		$form ='<form name="add-field" action="" method="post" class="fieldform">
			<input type="hidden" name="editform" value="'.$formid.'" />
			
			<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3">
					<label for="flabel">Field Label</label>
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9 ">
					<input name="flabel" value="'.$flabel.'" class="form-control input form-control-sm" />
					<small>Like this label</small>
				</div>
			</div>
			<br class="clear clearfix clearfx" />
			
			
			<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3 ">
					<label for="fdefault">Field Default</label>
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9 ">
					<input name="fdefault" value="'.$fdefault.'" class="form-control input form-control-sm col-md-6"  />
					<small>Prompt or input example</small>
				</div>
			</div>
			<br class="clear clearfix clearfx" />';
			
			if ( isset ( $atts['field_type'] ) && $atts['field_type'] != "" ){
				if ( $atts['field_type'] == "select" || $atts['field_type'] == "radio" || $atts['field_type'] == "checkbox" ){
					$optatts = array('field_type'=>$atts['field_type']); //pass post type to options form to display id/class for each type
					$form .= $this->add_options_form( $field_id , $optatts);
				}					
			}
			
			if ( isset($field_id) && $field_id != "0" ): 
                $form .='<input type="hidden" name="field_id" value="'.$field_id.'" />
                <input type="hidden" name="ftype" value="'.$ftype.'" />';
			else:
				$form .='<input type="hidden" name="ftype" value="'.$field_type.'" />';
			endif;
			
			$fieldname = ( $fname == "")?"fieldname".$count:$fname;
			$form .='<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3">
					<label for="fname">Field Name</label>
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9">
					<input type="text" name="fname" value="'. $fieldname.'" class="form-control input form-control-sm"  />
				</div>
			</div>
			<br class="clear clearfix clearfx" />';
			
			$fcssid = ($atts['fcssid']=="") ? "fieldname".$count : $atts['fcssid'];
			$form .='<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3">
					<label for="fname">Field ID </label>
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9">
					<input type="text" name="fcssid" value="'. $fcssid.'" class="form-control input form-control-sm"  />
					<small>CSS ID for styling</small>
				</div>
			</div>
			<br class="clear clearfix clearfx" />
			
			<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3">
					<label for="editmode">Is this field editable?</label>
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9 text-left">
					<p><input type="radio" name="editmode" value="readonly" '.checked($editmode).'> Read Only</p>
					<p><input type="radio" name="editmode" value="editable" '.checked($editmode).'> Editable</p>
				</div>
			</div>
			<br class="clear clearfix clearfx" />';
			
			if ( $ftype == "file" ){
				$form .='<div class="row">
					<div class="col-xs-12 col-md-3 col-lg-3 ">
						<label for="fsortorder">Limit File Size</label>	
					</div>
					<div class="col-xs-12 col-md-9 col-lg-9">		
						<input type="number" name="file_size" min="0" value="'.$file_size.'" class="form-control input form-control-sm"/>
						<small>Limit the maximum file size a user can upload/send</small>
					</div>
				</div>
				<br class="clear clearfix clearfx" />';
				
				$form .='<div class="row">
					<div class="col-xs-12 col-md-3 col-lg-3 ">
						<label for="fsortorder">Allowed File Types</label>	
					</div>
					<div class="col-xs-12 col-md-9 col-lg-9">		
						<input type="number" name="file_types" min="0" value="'.$file_types.'" class="form-control input form-control-sm"/>
						<small>Specify the type of files that can be uploaded. Separate them with the pipe symbol "|"</small>
					</div>
				</div>
				<br class="clear clearfix clearfx" />';
				
			}
			$form .='<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3 ">
					<label for="fsortorder">Sort Order</label>	
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9">		
					<input type="number" name="fsortorder" min="0" value="'.$fsortorder.'" class="form-control input form-control-sm"/>
					<small>(Determines display order)</small>
				</div>
			</div>
			<br class="clear clearfix clearfx" />
			
			<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3">
					<label for="fvalue">Predefined Value</label>
				</div>
				<div class="col-xs-12 col-md-9 col-lg-9">
					<input name="fvalue" value="'.$fvalue.'" class="form-control input  form-control-sm"  />
				</div>
			</div>
			<br class="clear clearfix clearfx" />';
			
			if ( isset($field_id) && $field_id != "0" ):
                $form .='<input type="hidden" name="updatefield" value="updatefield" />
                <input type="submit" value="Update Form Field" class="button-primary"/>';
			else:
                $form .='<input type="hidden" name="add-field" value="add-field" />
                <input type="submit" value="Add Form Field" class="button-primary button-large"/>';
			endif;
		$form .='</form>';
		
		return $form;
	}
	
	function add_options_form($field_id, $atts = array()){
		$field_type = $atts['field_type'];
		
		$form ='<div class="row">
			<input name="addfieldoptions" value="'.$field_id.'" type="hidden" />
			<input name="add-option" value="'.$field_id.'" type="hidden" />
			<input type="hidden" name="field_type" value="'.$field_type.'" />
			<div class="col-md-12 col-sm-12 col-xs-12">
				<fieldset>
					<legend>Field Options <a href="#" id="addoption" data-id="'.$field_type.'" class="addoption btn btn-info"><i class="glyphicon glyphicon-plus"></i> Add Option</a></legend>
					<table class="table table-striped">
						<tbody class="fieldoptions'.$field_type.'">
							<tr class="optionsgrp">
								<td><input type="text" name="label[]" placeholder="Option Label" class="form-control input" /></td>
								<td><input type="text" name="value[]" placeholder="Option Value" class="form-control input" /></td>
								<td><input type="number" name="order[]" placeholder="Sort Order" class="form-control input" type="number" /></td>
								<td><a href="#" class="removeoption btn btn-danger"><i class="glyphicon glyphicon-minus"></i></a></td>
							</tr>
						</tbody>
					</table>
				</fieldset>
			</div>
		</div>
		<br class="clear clearfix clearfx" />';
        
		return $form;
	}
	
	public function add_option_form($form_id, $field_id, $ftype){
		$form ='<form name="add-option" action="" method="post" class="fieldform">
			<!-- condition control -->
			<input type="hidden" name="field_id" value="'.$field_id.'" />
			<input type="hidden" name="ftype" value="'.$ftype.'" />
			<input type="hidden" name="editform" value="'.$form_id.'" />
			
			<!-- end control -->
			<div class="form-group">
				<label for="option_label">Option Label</label><br />
				<input name="label" value="" class="form-control input" />
			</div>
			
			<div class="form-group">
				<label for="option_value">Option Value</label>
				<input type="text" name="value" value="" class="form-control input" /><br />
			</div>
			
			<div class="form-group">
				<label for="option_sort_order">Sort Order</label>
				<input type="text" name="sorder" value="" class="form-control input" /><br />
			</div>
			
			<input type="hidden" name="add-option" value="add-option" />
			<input type="submit" value="Add Option Field" class="button-primary" />
		</form>';
		
		return $form;
	}
	
	
	public function field_modal($field, $modal_css_id="fieldmodal", $content, $modal_title="Add form field"){
		$form ='<div id="'.$modal_css_id.'" class="modal fade" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal Content -->
                <div class="modal-content">
                	<div class="modal-header">
                    	<button class="close" type="button" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">'.$modal_title.'</h4>
                    </div>
                    <div class="modal-body">
                    	'.$content.'
                    </div>
               </div>     
            </div>
        </div>';
		
		return $form;
	}
	
	
	public function message_modal($message_id, $message, $this_page=""){
		$form ='<div id="message'.$message_id.'" class="modal fade" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal Content -->
                <div class="modal-content">
                	<div class="modal-header">
                    	<button class="close" type="button" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">View Message</h4>
                    </div>
                    <div class="modal-body">
                    	'.$message.'
                    </div>
					<div class="modal-footer">
						<a href="'.$this_page.'&action=read&message_id='.$message_id.'">Read</a> | 
						<a href="'.$this_page.'&action=unread&message_id='.$message_id.'">Unread</a> |
						<a href="'.$this_page.'&action=delete&message_id='.$message_id.'" class="text-danger">Delete</a> |
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				   </div>
               </div>			     
            </div>
        </div>';
		
		return $form;
	}
	
	
	/**
	* Print form given its id
	*
	**/
	public function mpmf_print_form($atts=null, $content=null){
		global $wpdb;
		
		$form = "";
		
		extract( shortcode_atts( array('id'=>'' ),$atts) );
		if($content){
			$form .= $content . '<br />';
		}
		
		$id = $atts['id'];
		
		if ( !isset($id) || $id == "" ){
			$id = $_POST['editform'];	
		}
		
		$t = "\t";
		$t2 = "\t\t";
		$t3 = $t. $t2;
		$t4 = $t2 .$t2;
		$t5 = $t4 . $t;
		$n = "\n";
		
		
		$form .= '' . $n;/* must reveal form on the display mode: <form action="" method="POST" enctype="application/x-www-form-urlencoded" name="customForm" onsubmit="return validate_custom_form();">*/
		
		if( $id ){	
			$fields_table = $wpdb->prefix . 'mpmf_form_fields';
			$options_table = $wpdb->prefix.'mpmf_field_options';
			
			
			$fields = $wpdb->get_results("SELECT * FROM $fields_table WHERE mpmf_form_id='".$id."' ORDER BY field_sort_order");
			
			if ( !$fields ) { return $form .= 'No fields found for this form. Please add fields to preview them here.'; }
			$form .= $t4 .'<table id="formpreview" width="100%" border="0" class="form-table table-striped">' . $n;
			//print_r($fields);
			# important, creates field and labels for email to be sent, also makes validation easier for long forms
			$count = 1; # very important
			# 'f $count ' creates a new name for the field input for data validation
			foreach($fields as $field){			
				$form .= $t4 . '<tr>' . $n;
				if ( $field->field_type == "hidden" ){
					$form .= $t5 . '<th style="width: 20%;" align="left" valign="top"></th>' .$n;
				}else{
					$form .= $t5 . '<th style="width: 20%;" align="left" valign="top">' . $field->field_label . '</th>' .$n;
				}
				
				$form .= $t5 . '<td>';
				
				if( $field->field_type == "textarea" ){
					# if textarea, create textarea preview
					$form .= '<textarea name="f'.$count.'" placeholder="' .$field->field_default. '" class="form-control input"></textarea>';
				}
				elseif($field->field_type == "select"){
					# if list/select
					# must have select list options loaded
					# if list/select
					# 'f $count ' creates a new name for the field input for data validation
					$field_options = $wpdb->get_results("SELECT * FROM $options_table WHERE mpmf_field_id='" . $field->field_id ."'");
					
					if ( $field_options ){
						$form .= '<select name="f' . $count . '" class="form-control input">';			
						foreach( $field_options as $option ) {
							$form .= '<option value="' . $option->mpmf_option_value .'">' . $option->mpmf_option_label. '</option>';
						}
						$form .= '</select>';
					}else{
						$form .= '<input type="text" name="f'. $count .'" placeholder="type your answer" />
						<p class="text-muted"><small>No options set.</small></p>';
					}
				}
				elseif($field->field_type == "radio"){
					# radio must have options
					# do a while loop to check for the radio name and options
					# 'f $count ' creates a new name for the field input for data validation
					$field_options = $wpdb->get_results("SELECT * FROM $options_table_name WHERE field_id='" . $field->field_id ."'");
					
					if ( $field_options ){
						foreach( $field_options as $option ) {
							$form .= '<span class="fieldoption">
								<input name="f'.$count .'" type="radio" value="' . $option->mpmf_option_value . '" />'. $option->mpmf_option_label .'</span>';
						}
					}else{
						$form .= '<input type="text" name="f'.$count . 
						'" placeholder="type your answer"  value="'. $option->option_value . '" class="form-control input" />
						<p class="text-muted"><small>No options set:</small></p>';
					}
				}
				elseif($field->field_type == "checkbox"){
					$field_options = $wpdb->get_results("SELECT * FROM $options_table_name WHERE field_id='" . $field->field_id ."'");
					
					if ( $field_options ){
						foreach( $field_options as $option ) {
							$form .= '<span class="fieldoption"><input type="checkbox" name="f'.$count.'" value="'. $option->option_value . '" />' . $option->option_label . '</span>';
						}
					}else{
						$form .= '<input type="text" name="f'.$count . 
						'" placeholder="type your answer" class="form-control input"/>
						<p class="text-muted"><small>No options set:</small></p>';
					}
				}
				elseif($field->field_type == "basecost"){
					# text, number, email, tel' .$field['field_name'].  '
					$form .= '<input name="basecost" placeholder="' .$field->field_default. '" type="'.$field->field_type. '" value="'.$field->field_value. '"  class="form-control input" />';
				}
				elseif($field->field_type == "calculated"){
					# text, number, email, tel' .$field['field_name'].  '
					$form .= '<input name="calculated_1" placeholder="' .$field->field_default. '" type="'.$field->field_type. '" value="'.$field->field_value. '"  class="form-control input"/>';
				}
				elseif($field->field_type == "countries"){
					# text, number, email, tel' .$field['field_name'].  '
					$countries = new Multi_Purpose_Mail_Form_Countries();
					$form .= $countries->print_countries( "country", "country", "" );
				}
				elseif($field->field_type == "submit"){
					# text, number, email, tel' .$field['field_name'].  '
					$settings = get_option('mpmf_default_form_options');
					if ($field->field_value == '0') $value = $settings['send_button_text'];
					else $value = $field->field_value;
					$form .= '<input name="submit" type="submit" value="'.$value. '"  class="btn btn-primary"/>';
				}
				elseif($field->field_type == "recaptcha"){
					# text, number, email, tel' .$field['field_name'].  '
					$settings = get_option('mpmf_default_form_options');
					if ($field->field_default == 0) $value = $settings['send_button_text'];
					else $value = $field->field_default;
					
					$public =  new Multi_Purpose_Mail_Form_Public('multi-purpose-mail-form','1.0.0');
					$form .= '<p>ReCAPTCHA: The recaptcha form will be displayed here.';
					$form .= $public->show_recaptcha();
				}
				elseif( $field->field_type == "hidden" ){
					$form .= '<p class="text-muted">This field is hidden and not visible in the form. This message will not be visible on the public form.</p>';
					$form .= '<input name="f'.$count.'" placeholder="' .$field->field_default. '" type="'.$field->field_type. '"  class="form-control input" />';
				}
				else{
					# text, number, email, tel' .$field['field_name'].  '
					$form .= '<input name="f'.$count.'" placeholder="' .$field->field_default. '" type="'.$field->field_type. '"  class="form-control input" />';
				}
				# hide and submit the field label
				$form .= '<input type="hidden" name="field_label'.$count.'" value="' . $field->field_label . '">';
				$form .= '</td>' . $n;
				$form .= $t5 .'<td>' . $n;
				
				//edit field
				$content = $t4. $this->add_or_edit_field($_POST['editform'], 'edit-field');
				
				$form .= $t5 . $t . '<form action="" method="post" class="formactions">'. $n;
				$form .= $t5 . $t2 .'<input type="hidden" name="field_id" value="' . $field->field_id . '" />'. $n;
				$form .= $t5 . $t2 .'<input type="hidden" name="editfield" value="' . $field->field_id . '" />'. $n;
				$form .= $t5 . $t2 .'<input type="hidden" name="editform" value="' .$_POST['editform']. '" />'. $n;
				$form .= $t5 . $t2 .'<input type="submit" value="Edit" class="button button-primary" />'. $n;
				
				$form .= $t5 . $t.'</form>'. $n;/**/
				/*$form .= $t5 . $t2 .'<button type="button" class="btn btn-primary input" data-toggle="modal" data-target="#field'.$field->field_id.'"><i class="fa fa-pencil"></i> Edit</button>' .$n;
				
				$form .= $t5 . $t2 .$this->add_or_edit_field_modal($field->field_id, "#field".$field->field_id, $content, $modal_title="Add/Edit form field"). $n;
				*///end edit field
							
				//add options	
				if ( $field->field_type == "select" || $field->field_type == "check" || $field->field_type == "radio" || $field->field_type == "checkbox"){				
					/*$form .= $t5 . $t . '<form action="" method="post" class="formactions">'. $n;
					$form .= $t5 . $t2 .'<!-- condition control -->'. $n;
					$form .= $t5 . $t2 .'<input type="hidden" name="field_id" value="' . $field->field_id . '" />'. $n;
					$form .= $t5 . $t2 .'<input type="hidden" name="ftype" value="' . $field->field_type .'" />'. $n;
					$form .= $t5 . $t2 .'<input type="hidden" name="editform" value="' .$_POST['editform']. '" />'. $n;
					$form .= $t5 . $t2 .'<input type="submit" value="+Options" class="button button-primary" />'. $n;
					$form .= $t5 . $t2 .'<!-- end control -->'. $n;
					$form .= $t5 . $t.'</form>'. $n;*/
					
					$form .= $t5 . $t.'<button type="button" class="btn btn-default input text-left" data-toggle="modal" data-target="#editfield'.$field->field_id.'">
                    <i class="glyphicon glyphicon-plus"></i> Options</button>';	
					
					//$content = $this->add_option_form(0, $field->field_id, $field->field_type);
					$optatts = array('field_type'=>$field->field_type); //pass post type to options form to display id/class for each type
					$options_form = $this->add_options_form( $field->field_id , $optatts);
					//$content .= $options_form;
					$content = '<form method="post" action="">';
					$content .= '<input type="hidden" name="add-option" value="'.$field->field_id.'" />';
					$content .= '<input type="hidden" name="field_type" value="'.$field->field_type.'" />';
					$content .= '<input type="hidden" name="addfieldoptions" value="'.$field->field_id.'" />'.$n;
					$content .= '<input type="hidden" name="ftype" value="' . $field->field_type .'" />'. $n;
					$content .= '<input type="hidden" name="editform" value="' .$_POST['editform']. '" />'. $n;
					$content .= '<input type="hidden" name="field_id" value="'.$field->field_id.'">'.$n;
					$content .= $options_form;
					$content .= '<input type="submit" name="add-option" value="Add Field Options" class="button button-primary btn btn-primary">'.$n;
					$content .= '</form>';
					
					$form .= $this->field_modal($field->field_id, "editfield".$field->field_id, $content, "Add Options To Field");
					
				}
				//end add options
				
				//add formula
				if ( $field->field_type == "calculated"){				
					$form .= $t5 . $t . '<form action="" method="post" class="formactions">'. $n;
					$form .= $t5 . $t2 .'<!-- condition control -->'. $n;
					$form .= $t5 . $t2 .'<input type="hidden" name="field_id" value="' . $field->field_id . '" />'. $n;
					$form .= $t5 . $t2 .'<input type="hidden" name="ftype" value="' . $field->field_type .'" />'. $n;
					$form .= $t5 . $t2 .'<input type="hidden" name="editform" value="' .$_POST['editform']. '" />'. $n;
					$form .= $t5 . $t2 .'<input type="submit" value="Edit Formula" class="button button-primary" />'. $n;
					$form .= $t5 . $t2 .'<!-- end control -->'. $n;
					$form .= $t5 . $t.'</form>'. $n;				
				}
				
				//add formula
				
				//delete form
				$form .= $t5 . $t . '<form action="" method="post" class="formactions">'. $n;
				$form .= $t5 . $t2 .'<input type="hidden" name="deletefield" value="' . $field->field_id . '" />'. $n;
				$form .= $t5 . $t2 .'<input type="hidden" name="editform" value="' .$_POST['editform']. '" />'. $n;
				$form .= $t5 . $t2 .'<input type="submit" value="Delete" class="button button-default" />'. $n;
				$form .= $t5 . $t2 .'<!-- end control -->'. $n;
				$form .= $t5 . $t.'</form>'. $n;
				//end delete
				
				$form .= $t5 .'</td>' . $n;
				$form .= $t4 .  '</tr>' . $n;
				
				$count += 1;
			}
			$form .= $t4 . '<tr>' . $n;
			$form .= $t5 . '<td>&nbsp;</td>' . $n;
			$form .= $t5 . '<td>
						<input type="hidden" name="count" value="' . $count . '" >
						<input type="hidden" name="custom_form_action" value="send_data">' . $n;
						
						if ( !$this->formHasSubmit($id) ):
						$form .= $t5 . '<input name="send" type="submit" value="Submit" class="button button-primary btn btn-primary" />'. $n;
						endif;
						
			$form .= $t5 . '</td>' . $n;
			$form .= $t4 . '</tr>' . $n;		
			$form .= $t4 . "</table>" . $n;
			//$form .= "</form>";
			
			return $form;
			
		}else{
			$form .= "It seems as if there is nothing to display.";
		}
		return $form;
	}
	
	/**
	* Check if a form has a submit button added by the user
	*/
	public function formHasSubmit($form_id){
		global $wpdb;
		$fields_table = $wpdb->prefix . 'mpmf_form_fields';
		$submit = $wpdb->get_var("SELECT field_type FROM $fields_table WHERE field_type='submit' AND mpmf_form_id='{$form_id}' LIMIT 1");
		
		if ( $submit=='submit') return true;
		else return false;
	}
	
	/**
	* Print a form to eddit a form field
	*/
	public function add_or_edit_field($form_id="", $action='add-field', $field_id="-1"){
		$formid = (isset($form_id))? $form_id: $_POST['editform'];
		$action = (isset($action))? $action: $_POST['addfield'];
							
		global $wpdb;
		$fields_table = $wpdb->prefix . 'mpmf_form_fields';
		
		if ( $action=='editfield' ){		
			$field = $wpdb->get_row("SELECT * FROM $fields_table WHERE field_id='" . $field_id ."'");
			
			if ( $field ){
				$flabel = $field->field_label;
				$fdefault = $field->field_default;
				$fsortorder = $field->field_sort_order;
				$fname = $field->field_name;
				$fcssid = $field->field_css_id;
				$editmode = $field->field_editmode;
				$ftype = $field->field_type;
				$fvalue = $field->field_value;
			}else{
				$flabel = "";
				$fdefault = "";
				$fsortorder = "";
				$fname = "";
				$editmode = "";
				$fcssid = "";
				$ftype = "";
				$fvalue = "";
			}
		}else{
			$flabel = "";
			$fdefault = "";
			$fsortorder = "";
			$fname = "";
			$fcssid = "";
			$editmode = "";
			$ftype = "";
			$fvalue = "";
		}
		
		if ($ftype == "basecost"){
			$fname="basecost";
			$fcssid="bascost";
		}
		
		$count = $wpdb->get_var("SELECT COUNT(field_id) AS count_fields FROM $fields_table");
		$count = $count+1;
		
		$form = '<form name="add-field" action="" method="post" class="fieldform">
			<input type="hidden" name="editform" value="'.$formid.'" />
			<div class="row">
				<div class="col-md-6 col-sm-12 col-lg-6">
					<div class="form-group">
						<label for="flabel">Field Label</label><br />
						<input name="flabel" value="'.$flabel.'" class="form-control input" />
						<p class="text-muted"><small>Label your field. Like this label</small></p>
					</div>
					
					<div class="form-group">
						<label for="fdefault">Field Default</label><br />
						<input name="fdefault" value="'.$fdefault.'" class="form-control input" />
						<p class="text-muted"><small>Prompt or input example</small></p>
					</div>';
					
					if ( $action == 'editfield' ):
						$form .= '<input type="hidden" name="field_id" value="'.$field_id.'" />
									<input type="hidden" name="ftype" value="'.$ftype.'" />';
					else: 
						$form .= '<input type="hidden" name="ftype" value="'.$ftype.'" />';
					endif;
					
					$form .= '
					<div class="form-group">
						<label for="fname">Field Name</label>
						<input type="text" name="fname" value="'.(( $fname == "")? "fieldname".$count:$fname).'" class="form-control input" />
					</div>
					
					<div class="form-group">
						<label for="fname">Field ID</label>
						<input type="text" name="fcssid" value="'.(($fcssid=="")?"fieldname".$count:$fcssid).'"  class="form-control input"/>
						<p class="text-muted"><small>CSS ID for styling</small></p>
					</div>
				</div>
				
				<div class="col-md-6 col-sm-12 col-lg-6">
					<div class="form-group">
						<label for="fsortorder">Sort Order</label><br />
						<input type="number" name="fsortorder" value="'.$fsortorder.'" class="form-control input" />
						<p class="muted"><small>Determines display order.</small></p>
					</div>
					
					<div class="form-group">
						<label for="fvalue">Predefined Value</label><br />
						<input name="fvalue" value="'.$fvalue.'"  class="form-control input" />
					</div>
					
					<div class="form-group">
						<label for="editmode">Is this field editable/read only?</label>	
						<br />			
						<input type="radio" name="editmode" value="readonly" '.($editmode=="readonly"? "checked": "").'/>Read Only<br />					
						<input type="radio" name="editmode" value="editable" '.($editmode=="editable"? "checked": "").' />Editable
					</div>
				</div>';
			
			if ( $action == 'editfield' ): 
				$form .= '<input type="hidden" name="updatefield" value="updatefield" />
				<input type="submit" value="Update Form Field" class="button-primary btn btn-primary"/>';
			else: 
				$form .= '<input type="hidden" name="add-field" value="add-field" />
				<input type="submit" value="Add Form Field" class="button-primary btn btn-primary"/>';
			endif;
		$form .= '</form>'; 
		
		return $form;    
	}
	
	
	/**
	* Display a modal box
	* Include the form to edit the field in the dialog
	*/
	public function add_or_edit_field_modal($field, $modal_css_id="fieldmodal", $content, $modal_title="Add/Edit form field"){
		$form ='<div id="'.$modal_css_id.'" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal Content -->
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" type="button" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">'.$modal_title.'</h4>
					</div>
					<div class="modal-body">
						'.$content.'
					</div>
			   </div>     
			</div>
		</div>';
		
		return $form;
	}
}