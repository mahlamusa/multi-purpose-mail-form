<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://lindeni.co.za
 * @since      1.0.0
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
	if(isset($_POST['adminsubscribe']) && $_POST['adminsubscribe'] == "y"){
		$admin = new Multi_Purpose_Mail_Form_Admin('multi-purpose-mail-form', '1.0.0');
		$admin-> mpmf_subscribe_to_dev();
	}
?>
<?php
	if(isset($_POST['mpmf_update_options']) && $_POST['mpmf_update_options'] == "y"){
		#update contact details
		#start by getting post values
		$email = stripslashes($_POST['mpmf_email_to_us']);
		$phone = stripslashes($_POST['mpmf_phone_us']);
		
		//$showhidephone = stripslashes($_POST['showphone']);
		//$showhideemail = stripslashes($_POST['show_email_address']);
		#then update options
		update_option('mpmf_email_to_us',$email);
		update_option('mpmf_phone_us',$phone);
		
		//update_option('mpmf_show_hide_phone', $showhidephone);
		//update_option('mpmf_show_hide_email', $showhideemail);
		#assume update was successful.
		echo "<div class='wrap updated'><p>Your contact details have been updated successfully.</p></div>";
	}
?>


<?php
	if ( isset ( $_POST['mpmf_update_defaultform_options'] ) ){
		$default_options = array(
			'show_contact_phone'	=>$_POST['show_contact_phone'],
			'show_contact_email_address'=>$_POST['show_contact_email_address'],
			
			'show_email_subject'	=>$_POST['show_email_subject'],
			'show_title'			=>$_POST['show_title'],
			'show_first_name'		=>$_POST['show_first_name'],
			'show_last_name'		=>$_POST['show_last_name'],										
			'show_telephone'		=>$_POST['show_telephone'],
			'show_email_address'	=>$_POST['show_email_address'],
			'show_query'			=>$_POST['show_query'],										
			'show_how_to_contact'	=>$_POST['show_how_to_contact'],
			
			'email_subject_label'	=>$_POST['email_subject_label'],
			'title_label'			=>$_POST['title_label'],
			'first_name_label'		=>$_POST['first_name_label'],										
			'last_name_label'		=>$_POST['last_name_label'],
			'telephone_label'		=>$_POST['telephone_label'],
			'email_address_label'	=>$_POST['email_address_label'],
			'query_label'			=>$_POST['query_label'],
			'how_to_contact_label'	=>$_POST['how_to_contact_label'],
			
			'send_button_text'		=>$_POST['send_button_text'],
			'reset_button_text'		=>$_POST['reset_button_text'],
			
			//'mpmf_show_captcha' =>$_POST['mpmf_show_captcha'],	
			'mpmf_show_credit_link' =>$_POST['mpmf_show_credit_link']						
		);
		
		if ( update_option( 'mpmf_default_form_options', $default_options ) ){
			echo '<div class="wrap updated"><p>Settings have been saved</p></div>';	
		}
	}
	$default_options = get_option('mpmf_default_form_options');
	
	if ( $default_options== "" ){
		$default_options = array(
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
			'how_to_contact_label'	=>'How can we contact you?'	,
			
			'send_button_text'		=>'Submit',
			'reset_button_text'		=>'Clear',
			
			//'mpmf_show_captcha' 	=> 'show',
			'mpmf_show_credit_link'	=>'dont_show_link'									
		);
	}
?>


<?php
							
	if ( isset ( $_POST['mpmf_update_email_options'] ) ){
		/*$options = array(
			'email_auto_responder'		=>$_POST['email_auto_responder'],
			'send_email_copy_to_sender'	=>$_POST['send_email_copy_to_sender'],
			'mpmf_default_subject'		=>$_POST['mpmf_default_subject'],
			'mpmf_autoresponder_subject'=>$_POST['mpmf_autoresponder_subject'],
			'message_sent'				=>$_POST['message_sent'],
			'message_not_sent'			=>$_POST['message_not_sent'],
			'data_validation_errors'	=>$_POST['data_validation_errors'],
			'other_error_message'		=>$_POST['other_error_message'],
			'invalid_phone_number'		=>$_POST['invalid_phone_number'],
			'invalid_email_address'		=>$_POST['invalid_email_address']
		);*/
		
		if ( update_option( 'mpmf_email_options', $_POST['email_settings'] ) ){
			echo '<div class="wrap updated"><p>Email options updated successfully.</p></div>';	
		}
	}
	
	$email_options = get_option('mpmf_email_options');
	
	if ( !$email_options ) {
		$email_options = array(
			'mpmf_email_auto_responder'		=>'Hello, thank you for contacting us. This is to confirm that we received your message. An agent will contact you shortly.',
			'mpmf_send_email_copy_to_sender'=>'send',
			'mpmf_default_subject'			=>'Website contact. You received a message via your website',
			'mpmf_autoresponder_subject'	=>'Thank you. Your message was received.',
			'mpmf_message_sent'				=>'Thank you, your message has been sent. We will contact you shortly',
			'mpmf_message_not_sent'			=>'Sorry! Your message was not sent, please try again.',
			'mpmf_auto_responder_sent'		=>'Thank you, your message has been sent. We will contact you shortly',
			'mpmf_auto_responder_not_sent'	=>'Sorry! Your message was not sent, please try again.',
			'mpmf_data_validation_errors'	=>'The data you have provided in not in the required format. Please check and submit again.',
			'mpmf_other_error_message'		=>'Message was not sent. Please use another method to contact us.',
			'mpmf_invalid_phone_number'		=>'Invalid phone number',
			'mpmf_invalid_email_address'	=>'Invalid email address'
		);
	}
?>
<div class="wrap">	
	<h2>Multi Purpose Mail Form - Settings</h2>
    <p></p>
    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <div id="side-info-column" class="inner-sidebar">
            <div id="side-sortables" class="meta-box-sortables ui-sortable">
                <div class="postbox">
                    <div class="handlediv" title="Click to toggle"><br /></div>
                    <h3 class="hndle">Subscribe to updates</h3>
                    <div class="inside welcome-panel-column welcome-panel-last">
                        <h4>Please show your support. Subsrcibe to our mailing list</h4>
						
                        <div id="subscribe">            
                            <form action="" method="post">
                                <input type="hidden" name="adminsubscribe" value="y" />
                                <label for="asubscribe_email">Enter your email address to subscribe</label>
                                <?php
								$mpmf_email_to_us = (get_option('mpmf_email_to_us') != "")?get_option('mpmf_email_to_us'):get_option('admin_email');
								?>
                                <input type="email" placeholder="e.g. <?php echo $mpmf_email_to_us; ?>" name="asubscribe_email"  class="form-control input input-wide"/><br />
                                <input type="submit" value="Subscribe to updates" class="button-primary" />
                            </form>
                        </div>
                    </div>                     
                </div>
            </div>
        </div>
        <div id="post-body">
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">                	
                    <div class="postbox inside">
						<div class="handlediv" title="Click to toggle"><br /></div>
                    	<h3 class="hndle"><strong>Preferences</strong></h3>
    					<div class="inside" style="min-height:50%;">
                        	
                            
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#business">My Contact Details</a></li>
                                <li><a data-toggle="tab" href="#default">Default Form</a></li>
                                <li><a data-toggle="tab" href="#emailsettings">Email Settings</a></li>
                               <li><a data-toggle="tab" href="#recaptcha">reCAPTCHA</a></li>
                                <li><a data-toggle="tab" href="#other">Other Settings</a></li>
                            </ul>
<!-- Tab Content -->                    
<div class="tab-content">
	<!-- My Business Details -->
    <div id="business" class="tab-pane fade in active">
    	<p>&nbsp;</p>
        <p class="lead">Please enter your contact details. You can choose whether to show them on the default form or not. The email address will be used to receive all form data sent via your website.</p>
        <p>&nbsp;</p>       
        <form name="contact-details" method="post" action="">
            <table class="table form-table form-striped">
                <tr>
                    <td width="40%">Enter email address</td>
                    <td><input name="mpmf_email_to_us" type="text" value="<?php echo get_option("mpmf_email_to_us"); ?>"  class="form-control input input-wide">
                </tr>

                <tr>
                    <td width="40%">Enter phone number</td>
                    <td><input name="mpmf_phone_us" type="text" value="<?php echo get_option("mpmf_phone_us"); ?>"  class="form-control input input-wide"></td>
                </tr>
                
                <tr>
                    <td width="40%"><input type="hidden" name="mpmf_update_options" value="y"></td>
                    <td><input type="submit" value="Update Contact Details" class="button-primary"  class="form-control input input-wide"/></td>
                </tr>
            </table>
        </form>
    </div>
    
    <!-- Default Form Settings -->
    <div id="default" class="tab-pane fade">
    	<p>&nbsp;</p>
        <p class="lead">These options will affect the default contact form genarated by the shortcode <code>[mpmf]</code></p>
        <form name="contact-details" method="post" action="">
            <table class="table form-table options-table form-striped">
                <tr>
                    <td width="40%" valign="top" colspan="2">
                        <strong>Do you want your contact details to be visible in the default contact page?</strong></label><br />
                        <small>By default, your email aaddress and phone number will be displayed on the contact page above the form.</small>    
                    </td>
                </tr>
                <tr>                
                    <td>
                        <label><strong>Show / Hide phone number</strong></label>
                    </td>
                    <td>
                        <input type="radio" name="show_contact_phone" value="default" 
                        <?php echo ($default_options['show_contact_phone'] == "default"? " checked": "");?> />Use default. <br />
                        
                        <input type="radio" name="show_contact_phone" value="show_contact_phone" 
                        <?php echo ($default_options['show_contact_phone'] == "show_contact_phone"? " checked": "");?>/>Show phone number <br />
                        
                        <input type="radio" name="show_contact_phone" value="hide_contact_phone" 
                        <?php echo ($default_options['show_contact_phone'] == "hide_contact_phone"? " checked": "");?>/>Hide phone number <br />
                   </td>
              </tr>
              <tr>
                    <td>     
                        <label><strong>Show / Hide email address</strong></label>
                    </td>
                    <td>
                        <input type="radio" name="show_contact_email_address" value="default" 
                        <?php echo ($default_options['show_contact_email_address'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_contact_email_address" value="show_contact_email_address" 
                        <?php echo ($default_options['show_contact_email_address'] == "show_contact_email_address"? " checked": "");?>/>Show email address <br />
                        <input type="radio" name="show_contact_email_address" value="hide_contact_email_aaddress" 
                        <?php echo ($default_options['show_contact_email_address'] == "hide_contact_email_address"? " checked": "");?>/>Hide email address<br />
                    </td>
                </tr>
                <tr>
                    <td>     
                        <label><strong>Show / Hide CAPTCHA</strong></label>
                        <p class="text-muted"><small>This will display the security check to check if the visitor is a person or a robot/computer. Robots will fail the security check making your site sucure.</small></p>
                    </td>
                    <td>
                        <input type="radio" name="mpmf_show_captcha" value="default" 
                        <?php echo ($default_options['mpmf_show_captcha'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="mpmf_show_captcha" value="show" 
                        <?php echo ($default_options['mpmf_show_captcha'] == "show"? " checked": "");?>/>Show CAPTCHA <br />
                        <input type="radio" name="mpmf_show_captcha" value="hide" 
                        <?php echo ($default_options['mpmf_show_captcha'] == "hide"? " checked": "");?>/>Hide CAPTCHA<br />
                        
                    </td>
                </tr>
                <tr>
                    <td width="40%">
                        <label><strong>'Email subject/reason for contact' field</strong></label>
                        <br />
                        <p>Custom Label : 
                        <input type="text" name="email_subject_label" value="<?php echo $default_options['email_subject_label']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                    <td>
                        <input type="radio" name="show_email_subject" value="default" 
                        <?php echo ($default_options['show_email_subject'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_email_subject" value="show_email_subject" 
                        <?php echo ($default_options['show_email_subject'] == "show_email_subject"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_email_subject" value="hide_email_subject" 
                        <?php echo ($default_options['show_email_subject'] == "hide_email_subject"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>'First name' field</strong></label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="first_name_label" value="<?php echo $default_options['first_name_label']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                    <td>
                        <input type="radio" name="show_first_name" value="default" 
                        <?php echo ($default_options['show_first_name'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_first_name" value="show_first_name" 
                        <?php echo ($default_options['show_first_name'] == "show_first_name"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_first_name" value="hide_first_name" 
                        <?php echo ($default_options['show_first_name'] == "hide_first_name"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>'First name' field</strong></label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="last_name_label" value="<?php echo $default_options['last_name_label']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                    <td>
                        <input type="radio" name="show_last_name" value="default" 
                        <?php echo ($default_options['show_last_name'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_last_name" value="show_last_name" 
                        <?php echo ($default_options['show_last_name'] == "show_last_name"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_last_name" value="hide_last_name" 
                        <?php echo ($default_options['show_last_name'] == "hide_last_name"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                
                                                  
                
                <tr>
                    <td width="40%">
                        <label><strong>'Title' select field</strong></label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="title_label" value="<?php echo $default_options['title_label']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                    <td>
                        <input type="radio" name="show_title" value="default" 
                        <?php echo ($default_options['show_title'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_title" value="show_title" 
                        <?php echo ($default_options['show_title'] == "show_title"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_title" value="hide_title" 
                        <?php echo ($default_options['show_title'] == "hide_title"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>'Email address'</strong></label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="email_address_label" value="<?php echo $default_options['email_address_label']; ?>" /></p>
                    </td>
                    <td>
                        <input type="radio" name="show_email_address" value="default" 
                        <?php echo ($default_options['show_email_address'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_email_address" value="show_email_address" 
                        <?php echo ($default_options['show_email_address'] == "show_email_address"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_email_address" value="hide_email_address" 
                        <?php echo ($default_options['show_email_address'] == "hide_email_address"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                <tr>
                    <td width="40%">
                        <label><strong>'Telephone/mobile'</strong> field</label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="telephone_label" value="<?php echo $default_options['telephone_label']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                    <td>
                        <input type="radio" name="show_telephone" value="default" 
                        <?php echo ($default_options['show_telephone'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_telephone" value="show_telephone" 
                        <?php echo ($default_options['show_telephone'] == "show_telephone"? " checked": "");?>/>Show <br />
                        <input type="radio" name="show_telephone" value="hide_telephone" 
                        <?php echo ($default_options['show_telephone'] == "hide_telephone"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>'Your query/Question'</strong> field</label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="query_label" value="<?php echo $default_options['query_label']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                    <td>
                        <input type="radio" name="show_query" value="default" 
                        <?php echo ($default_options['show_query'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_query" value="show_query" 
                        <?php echo ($default_options['show_query'] == "show_query"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_query" value="hide_query" 
                        <?php echo ($default_options['show_query'] == "hide_query"? " checked": "");?>/>Hide<br />
                    </td>                                        
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>'How can we contact you?'</strong> field</label>
                        <br />
                        <p>Custom Label :
                        <input type="text" name="how_to_contact_label" value="<?php echo $default_options['how_to_contact_label']; ?>" /></p>
                    </td>
                    <td>
                        <input type="radio" name="show_how_to_contact" value="default" 
                        <?php echo ($default_options['show_how_to_contact'] == "default"? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="show_how_to_contact" value="show_how_to_contact" 
                        <?php echo ($default_options['show_how_to_contact'] == "show_how_to_contact"? " checked": "");?>/>Show<br />
                        <input type="radio" name="show_how_to_contact" value="hide_how_to_contact" 
                        <?php echo ($default_options['show_how_to_contact'] == "hide_how_to_contact"? " checked": "");?> />Hide<br />
                    </td>                                        
                </tr>
                <tr>
                    <td width="40%">
                        <label><strong>Form 'Send' button text</strong></label>
                    </td>
                    <td>
                        <input type="text" name="send_button_text" value="<?php echo $default_options['send_button_text']; ?>" class="form-control input input-wide" /></p>
                    </td>
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>Form 'Reset' button text</strong></label>
                    </td>
                    <td>
                        <input type="text" name="reset_button_text" value="<?php echo $default_options['reset_button_text']; ?>"  class="form-control input input-wide"/></p>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2"><h3>Other options</h3></td>
                </tr>
                
                <tr>
                    <td width="40%">
                        <label><strong>Show author credit links</strong></label>
                        <br />
                        <small>This will display a small paragraph with links to the author's website.</small>
                    </td>
                    <td>
                        <input type="radio" name="mpmf_show_credit_link" value="default" 
                        <?php echo ($default_options['mpmf_show_credit_link'] == "default" ? " checked": "");?>/>Use default option. <br />
                        <input type="radio" name="mpmf_show_credit_link" value="show_link" 
                        <?php echo ($default_options['mpmf_show_credit_link'] == "show_link" ? " checked": "");?>/>Show<br />
                        <input type="radio" name="mpmf_show_credit_link" value="dont_show_link" 
                        <?php echo ($default_options['mpmf_show_credit_link'] == "dont_show_link" ? " checked": "");?>/>Hide<br />
                    </td>
                </tr>
                
                <tr>
                    <td width="40%"><input type="hidden" name="mpmf_update_defaultform_options" value="y"></td>
                    <td><input type="submit" value="Update Options" class="button-primary" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <!-- Email Settings -->
    <div id="emailsettings" class="tab-pane fade">
        <p>&nbsp;</p>
        <p class="lead">This options are used in various conditions when sending emails from your website.</p>
        <p>&nbsp;</p>
        <form name="contact-details" method="post" action="">
            <table class="form-table options-table table form-striped">
                <tr>
                    <td width="40%">Email auto responder.<br />
                    <small class="text-muted">This will be sent to all users as an automatic response when they submit a form.</small></td>
                    <td><textarea name="email_settings[mpmf_email_auto_responder]" class="form-control input input-wide"><?php echo $email_options['mpmf_email_auto_responder']; ?></textarea></td>
                </tr>
                
                <tr>
                    <td>Auto Responder Subject</td>
                    <td>
                        <input type="text" name="email_settings[mpmf_autoresponder_subject]" class="form-control input input-wide" value="<?php echo $email_options['mpmf_autoresponder_subject']; ?>" />
                    </td>
                </tr>
                
                <tr>
                    <td width="40%">Send copy to sender<br /><small class="text-muted">When a visitor submits a form, choose if you want to send them a copy?</td>
                    <td>
                        <input type="radio" name="email_settings[mpmf_send_email_copy_to_sender]" value="send" 
                        <?php checked($email_options['mpmf_send_email_copy_to_sender'],'send');?>/>Send. <br />
                        
                        <input type="radio" name="email_settings[mpmf_send_email_copy_to_sender]" value="dontsend" 
                        <?php checked($email_options['mpmf_send_email_copy_to_sender'],'dontsend');?>/>Don't Send. <br />
                    </td>
                </tr>
                
                <tr>
                    <td>Default Email Subject</td>
                    <td>
                        <input type="text" name="email_settings[mpmf_default_subject]" class="form-control input input-wide" value="<?php echo $email_options['mpmf_default_subject']; ?>" />
                    </td>
                </tr>
                
                <!--<tr>
                    <td>Auto Responder Email Subject</td>
                    <td>
                        <input type="text" name="email_settings[mpmf_auto_responder_subject]" class="form-control input input-wide" value="<?php echo $email_options['mpmf_default_subject']; ?>" />
                    </td>
                </tr>-->
                
                <tr>
                    <td colspan="2"><h3>Messages used in various situations</h3></td>
                </tr>
                
                <tr>
                    <td>Sender&#039;s message was sent successfully</td>
                    <td>
                        <textarea name="email_settings[mpmf_message_sent]" class="form-control input input-wide"><?php echo $email_options['mpmf_message_sent']; ?></textarea>
                    </td>
                </tr>
                
                
                
                <tr>
                    <td>Sender&#039;s message was not sent</td>
                    <td>
                        <textarea name="email_settings[mpmf_message_not_sent]" class="form-control input input-wide"><?php echo $email_options['mpmf_message_not_sent']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Auto responder sent successfully</td>
                    <td>
                        <textarea name="email_settings[mpmf_auto_responder_sent]" class="form-control input input-wide"><?php echo $email_options['mpmf_auto_responder_sent']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Auto Responder not sent</td>
                    <td>
                        <textarea name="email_settings[mpmf_auto_responder_not_sent]" class="form-control input input-wide"><?php echo $email_options['mpmf_auto_responder_not_sent']; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Data validation errors occurred</td>
                    <td>
                        <textarea name="email_settings[mpmf_data_validation_errors]" class="form-control input input-wide"><?php echo $email_options['mpmf_data_validation_errors']; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Message not sent due to another error</td>
                    <td>
                        <textarea name="email_settings[mpmf_other_error_message]" class="form-control input input-wide"><?php echo $email_options['mpmf_other_error_message']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Invalid phone number used</td>
                    <td>
                        <textarea name="email_settings[mpmf_invalid_phone_number]" class="form-control input input-wide"><?php echo $email_options['mpmf_invalid_phone_number']; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Invalid email address used</td>
                    <td>
                        <textarea name="email_settings[mpmf_invalid_email_address]" class="form-control input input-wide"><?php echo $email_options['mpmf_invalid_email_address']; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td width="40%"><input type="hidden" name="mpmf_update_email_options" value="y"></td>
                    <td><input type="submit" value="Update Email Settings" class="button-primary" /></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div id="other" class="tab-pane fade">
    	<p>&nbsp;</p>
    	<p class="lead">You are awesome :)</p>
        <p class="lead">If you have been using the first versions of the plugin before this one, then you are tripple awesome and I like you for that. I would like to say thank you for your patience as I was developing this new version. I know it has been a very long time (over 2 years) and I really appreciate you waiting so long. I promice that from this version you will be receiving constant updates.</p>
        <p class="lead">Please show some love by rating this plugin on the wordpress repository.</p>
        
        <p class="lead">More cool features coming soon.</p>
        <p class="lead">Thank you. :)</p>
    </div>
    
    <div id="recaptcha" class="tab-pane fade">
    	<p>&nbsp;</p>
		<?php
            if ( isset ( $_POST['save_recaptcha'] ) && isset( $_POST['settings']) ){
                if ( update_option('mpmf_recaptcha_settings',$_POST['settings'] ) ){
                    echo '<div class="updated"><p>Settings updated successfully.</p></div>';
                }
            }
            $mpmf_recaptcha_settings = get_option('mpmf_recaptcha_settings');
			
			if ( $mpmf_recaptcha_settings == "" ){
				$mpmf_recaptcha_settings = array(
					'enablecaptcha' 		=> 1,
					'captcha_default' 		=> 1,
					'captchamode' 			=> 'notabot',
					'recaptcha_site_key' 	=> '',
					'recaptcha_public_key' 	=> '',
					'recaptcha_secret_key'	=> ''
				);
				update_option('mpmf_recaptcha_settings',$mpmf_recaptcha_settings );
			}
            ?>
            <form name="settings" method="post" action="">
                <table class="table table-borderd table-hover wp-list-table widefat fixed striped users">
                    <tbody class="listplans">
                        <tr>
                            <td scope="row"><label>Enable Google CAPTCHA</label><br /><small>Choose whether to enable google captcha or not. When enabled, your/users will be required to complete the captcha challenge to check urls</small></td>
                            <td class="username column-username">
                                <select type="checkbox" name="settings[enablecaptcha]" class="form-control">
                                    <option value="1" <?php echo ($mpmf_recaptcha_settings['enablecaptcha'] == 1)? "selected":""; ?>>Enable</option>
                                    <option value="0" <?php echo ($mpmf_recaptcha_settings['enablecaptcha'] == 0)? "selected":""; ?>>Disable</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><label>Show CAPTCHA on Default Form</label><br />
                            <small>This will display the security check to check if the visitor is a person or a robot/computer. Robots will fail the security check making your site sucure.</small></td>
                            <td class="username column-username">
                                <select type="checkbox" name="settings[captcha_default]" class="form-control">
                                    <option value="1" <?php echo ($mpmf_recaptcha_settings['captcha_default'] == 1)? "selected":""; ?>>Show</option>
                                    <option value="0" <?php echo ($mpmf_recaptcha_settings['captcha_default'] == 0)? "selected":""; ?>>Hide</option>
                                </select>
                            </td>
                        </tr><!---->
                        <tr>
                            <td scope="row"><label>CAPTCHA Mode</label><br /><small>Choose which type of CAPTCHA to display</small></td>
                            <td class="username column-username">
                                <select type="checkbox" name="settings[captchamode]" class="form-control">
                                    <option value="words" <?php echo ($mpmf_recaptcha_settings['captchamode'] == "words")? "selected":""; ?>>Type the words on picture</option>
                                    <option value="notabot" <?php echo ($mpmf_recaptcha_settings['captchamode'] == "notabot")? "selected":""; ?>>Check "I am not a bot"</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">
                                <label>reCAPTCHA Site Key</label><br />
                                <small>Enter the google recaptcha site key. You can get it from <a href="https://www.google.com/recaptcha/admin" target="_blank">here</a>.</small>
                            </td>
                            <td class="username column-username">
                                <input type="text" name="settings[recaptcha_site_key]" class="form-control" value="<?php echo $mpmf_recaptcha_settings['recaptcha_site_key']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">
                                <label>reCAPTCHA Public Key</label><br />
                                <small>Enter the google recaptcha secret key. You can get it from <a href="https://www.google.com/recaptcha/admin" target="_blank">here</a>.</small>
                            </td>
                            <td class="username column-username">
                                <input type="text" name="settings[recaptcha_public_key]" class="form-control" value="<?php echo $mpmf_recaptcha_settings['recaptcha_public_key']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">
                                <label>reCAPTCHA Secret Key</label><br />
                                <small>Enter the google recaptcha secret key. You can get it from <a href="https://www.google.com/recaptcha/admin" target="_blank">here</a>.</small>
                            </td>
                            <td class="username column-username">
                                <input type="text" name="settings[recaptcha_secret_key]" class="form-control" value="<?php echo $mpmf_recaptcha_settings['recaptcha_secret_key']; ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><input type="submit" name="save_recaptcha" value="Save Settings" class="button button-primary pull-right" /></p>
            </form>
            <p></p>
        </div>
    </div>
    <!-- tab content -->
                        <br />
                        <br />
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

