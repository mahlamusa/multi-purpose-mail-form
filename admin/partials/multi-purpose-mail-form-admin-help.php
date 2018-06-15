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
<div class="wrap">	
	<h2>Multi Purpose Mail Form - Help Center</h2>
    <p>Read <a href="https://lindeni.co.za/create-wordpress-forms/">this tutorial</a> to get started quickly. </p>
    <p class="lead text-info">For this update, you need to deactivate and then reactivate the plugin inorder for it to work properly.</p>
    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <div id="side-info-column" class="inner-sidebar">
            <div id="side-sortables" class="meta-box-sortables ui-sortable">
                <div class="postbox">
                    <div class="handlediv" title="Click to toggle"><br /></div>
                    <h3 class="hndle">Subscribe to updates</h3>
                    <div class="inside welcome-panel-column welcome-panel-last">
                        <h4>Please show your support. Subsrcibe to our mailing list</h4>
						<?php
                            if(isset($_POST['adminsubscribe']) && $_POST['adminsubscribe'] == "y"){
								$admin = new Multi_Purpose_Mail_Form_Admin('multi-purpose-mail-form', '1.0.0');
                               	$admin-> mpmf_subscribe_to_dev();
                            }
                        ?>
                        <div id="subscribe">            
                            <form action="" method="post">
                                <input type="hidden" name="adminsubscribe" value="y" />
                                <label for="asubscribe_email">Enter your email address to subscribe</label>
                                <input type="email" placeholder="e.g. <?php echo get_option('mpmf_email_to_us'); ?>" name="asubscribe_email" /><br /><br />
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
                    	<h2 class="hndle">Contact Details</h2>
    					<div class="inside" style="min-height:50%;">
                         	<div class="mpmfContainer">
                                <div class="mpmfContentBlock">
                                    <h4>Before anything else. Enter and save your contact details in the "My Contact Details" section of the <a href="<?php echo admin_url('admin.php?page=mpmf-settings');?>">Settings page</a>.</h4>
                                    <ul>
                                        <li><strong>Enter your email address</strong> - it will be used by the plugin's built in mailer to send the information and message posted by your users via your website.</li>
                                        <li><strong>Enter your phone number</strong> - it will be displayed on your website above the form created by the MPMF 
                            wordpress plugin to give your site's visitors an option to call you directly if they need to.</li>
                                        <ll>Click <strong>'Update Options'</strong> and your email address and phone number will always be displayed in 
                            their respective text boxes even if you navigate away and come back to the plugin's admin page.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
        
        <div id="post-body">
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                	<div class="postbox inside">
						<div class="handlediv" title="Click to toggle"><br /></div>
                    	<h3 class="hndle">Default Forms</h3>
    					<div class="inside" style="min-height:50%;">
                         	<div class="mpmfContainer">
                                <div class="mpmfContentBlock">
                                    <!-- Default form -->
                                    <h4>To use the Default Contact and Subscription form</h4>
                                    
                                    <h5>Default Contact Form</h5>
                            		<p>There is nothing hard to do, just copy and paste or type <code>[mpmf]</code> anywhere you want the form displayed and the form will be displayed there.</b> Your site's visitors/users will see the form with the contact details you provided in step one, instead of seeing [mpmf].
                            Note: <code>[mpmf]</code> must be copied as is</p>
                            
                            		<p>You can choose which fields of the default form to show by customizing it in the "Default Form" section of the <a href="<?php echo admin_url('admin.php?page=mpmf-settings');?>">Settings page</a>. You can also translate the form by changing the label titles in the <a href="<?php echo admin_url('admin.php?page=mpmf-settings');?>">Settings page</a>
                            
                                    <h5>Default Subscription Form</h5>
                                    <p>Copy and paste or type <code>[subscribe]</code> in any post or page where you want the subscription form displayed. Your visitors will see the subscription form, not the <code>[subscribe]</code> shortcode. All subscriptions will be sent to you by email - to the email address your specified above.</p>
                                    <p>The final contact form looks <a href="http://3pxwebstudios.co.nf/contact-us" title="Wordpress plugins author" target="_blank">like this</a> and the final subscription form looks like the one on this page.</p>
                                </div>
                            </div>
                        </div>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
        
        <div id="post-body">
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                	<div class="postbox inside">
						<div class="handlediv" title="Click to toggle"><br /></div>
                    	<h3 class="hndle">Custom Forms</h3>
    					<div class="inside" style="min-height:50%;">
                         	<div class="mpmfContainer">
                                <div class="mpmfContentBlock">     
                                    <h4>To use the Custom Contact form</h4>
                                    <p>First you have to create the custom form on the <a href="<?php echo admin_url('admin.php?page=mpmf-forms');?>">Main page</a> of the plugin. To create a form, just enter its name in the text box label "Form Name" under "New Form" on the  <a href="<?php echo admin_url('admin.php?page=mpmf-forms');?>">Main page</a>, then click "Create". On the same page, you will see a list of existing custom forms, just copy the code under the "Shortcode" column and pase it in the page where you want the form to be displayed. The shortcode will look like <code>[mpmfcustom id="1"] </code>, just copy it as it is and paste it in the page. Now you can start adding fields by clicking on "Edit Fields" next to the form you want to edit.</p>
                                    <p>
                                    For custom forms, first look for the form name and form id of the form you want to use from the 
                            <code>[mpmfcustom id="ID"]-Custom Message-[/mpmfcustom]</code> where "ID" is a number - the id of the form you want to use and -Custom Message- is any message or writing you want to appear above the form on your page or post.
                                    </p>
                                    <p>
                                    For a <b>new installtion</b> of this plugin, the first form created will have ID=1, so to use your first form created right after installing this plugin, use: <code>[mpmfcustom id="1"]Please fill in the form below to contact us for any queries.[/mpmfcustom]</code>
                                    </p>
                                    <p>Please remember, the <code>-Custom Message-</code> can be anything you want to appear above the custom form, and if you want to leave it blank thats fine too nothing will be shown above the form. e.g. You can use <code>[mpmfcustom id="1"][/mpmfcustom]</code></p>
                                    
                                </div>
                            </div>
                        </div>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>