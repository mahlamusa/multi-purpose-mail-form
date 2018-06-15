<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file contains the buttons used for adding input fielads to a form.
 *
 * @link       http://lindeni.co.za
 * @since      1.0.0
 *
 * @package    Multi_Purpose_Mail_Form
 * @subpackage Multi_Purpose_Mail_Form/admin/partials
 */
?>

<?php $admin = new Multi_Purpose_Mail_Form_Admin('1.0.0','multi-purpose-mail-form'); ?>
<?php $field = ""; //must be replaced with field type ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="glyphicon glyphicon-cog"></i> General Input Fields
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		<div class="panel-body">
      
      	<!-- buttons inside accordion body -->
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default  form-control input form-control-sm text-left" data-toggle="modal" data-target="#textmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Text</button>
					<?php 
                    $atts=array(
						'field_type'=>'text',
						'fcssid'=>'text',
						'fcssclass'=>'text'
					);
					echo $admin->field_modal($field, "textmodal", $admin->add_form_field_form($formid,0,"text", $atts), "Add Text Input"); ?>
            </div>
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#numbermodal">
                    # Number</button>
                    <?php 
					$atts=array(
						'field_type'=>'number',
						'fcssid'=>'number',
						'fcssclass'=>'number'
					);
					echo $admin->field_modal($field, "numbermodal", $admin->add_form_field_form($formid,0,"number", $atts), "Add Number Field"); ?>
            </div>
            
        </div>
        <br class="clear clearfix clearfx" />
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#textareamodal">
                    Textarea</button>
                    <?php 
					$atts=array(
						'field_type'=>'textarea',
						'fcssid'=>'textarea',
						'fcssclass'=>'textarea'
					);
					echo $admin->field_modal($field, "textareamodal", $admin->add_form_field_form($formid,0,"textarea",$atts), "Add Textarea"); ?>
            </div>
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#checkboxmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Checkbox</button>
                    <?php 
					$atts=array(
						'field_type'=>'checkbox',
						'fcssid'=>'checkbox',
						'fcssclass'=>'checkbox'
					);
					echo $admin->field_modal($field, "checkboxmodal", $admin->add_form_field_form($formid,0,"checkbox"), "Add Checkbox Field"); ?>
            </div>                        
        </div>
        <br class="clear clearfix clearfx" />
        
        
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#datemodal">
                    <i class="glyphicon glyphicon-calendar"></i> Date</button>
                    <?php 
					$atts=array(
						'field_type'=>'date',
						'fcssid'=>'date',
						'fcssclass'=>'date'
					);
					echo $admin->field_modal($field, "datemodal", $admin->add_form_field_form($formid,0,"date"), "Add Date Field"); ?>
            </div>
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#checkboxlistmodal">
                    <i class="glyphicon glyphicon-collapse-down"></i> Checklist</button>
                    <?php 
					$atts=array(
						'field_type'=>'checklist',
						'fcssid'=>'checklist',
						'fcssclass'=>'checklist'
					);
					echo $admin->field_modal($field, "checkboxlistmodal", $admin->add_form_field_form($formid,0,"checklist",$atts), "Add Checklist"); ?>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#fieldmodal">
                    <i class="glyphicon glyphicon-align-justify"></i> Paragraph</button>
                    <?php 
					$atts=array(
						'field_type'=>'paragraph',
						'fcssid'=>'paragraph',
						'fcssclass'=>'paragraph'
					);
					echo $admin->field_modal($field, "paragraphmodal", $admin->add_form_field_form($formid,0,"paragraph",$atts), "Add Paragraph"); ?>
            </div>
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#radiomodal">
                    <i class="glyphicon glyphicon-text-width"></i> Radio</button>
                    <?php 
					$atts=array(
						'field_type'=>'radio',
						'fcssid'=>'radio',
						'fcssclass'=>'radio'
					);
					echo $admin->field_modal($field, "radiomodal", $admin->add_form_field_form($formid,0,"radio",$atts), "Add Radio Field"); ?>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#hiddenmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Hidden</button>
                    <?php 
					$atts=array(
						'field_type'=>'hidden',
						'fcssid'=>'hidden',
						'fcssclass'=>'hidden'
					);
					echo $admin->field_modal($field, "hiddenmodal", $admin->add_form_field_form($formid,0,"hidden", $atts), "Add Hidden Field"); ?>
            </div>
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#uploadmodal">
                    <i class="glyphicon glyphicon-upload"></i> Upload</button>
                    <?php 
					$atts=array(
						'field_type'=>'file',
						'fcssid'=>'file',
						'fcssclass'=>'fileen'
					);
					echo $admin->field_modal($field, "uploadmodal", $admin->add_form_field_form($formid,0, "file", $atts), "Add File Input Field"); ?>
            </div> <!----> 
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#selectmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Select/Dropdown</button>
                    <?php 
					$atts=array(
						'field_type'=>'select',
						'fcssid'=>'select',
						'fcssclass'=>'select'
					);
					echo $admin->field_modal($field, "selectmodal", $admin->add_form_field_form($formid,0,"select",$atts), "Add Dropdown Field"); ?>
            </div>                     
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
        		<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="submit" />
                    <input type="hidden" name="predefined" value="submit_button" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                        <i class="glyphicon glyphicon-envelope"></i> Submit Button</button>
                </form>
            </div>                     
        </div>
        <br class="clear clearfix clearfx" />
        <!-- end accordion body -->
        </div>
    </div>
  </div>
  <!-- end general inputs -->
  
  
  <!-- User Fields-->
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="glyphicon glyphicon-user"></i> User Fields
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <!-- User fields -->
        <div class="row">            
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="first_name" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                                    <i class="glyphicon glyphicon-user"></i> First Name</button>
                </form>
            </div>
            
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="last_name" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                        <i class="glyphicon glyphicon-user"></i> Last Name</button>
                </form>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row">   
            
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="phone_number" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                        <i class="glyphicon glyphicon-earphone"></i> Telephone</button>
                </form>
            </div>
            
            <div class="col-lg-6 col-xs-6 col-sm-6">
                <form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="email_address" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                                    <i class="glyphicon glyphicon-envelope"></i> Email</button>
                </form>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row"> 
        	<div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="street_address" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                    <i class="glyphicon glyphicon-map-marker"></i> Address</button>
                </form>
            </div>   
            
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="city" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                        <i class="glyphicon glyphicon-map-marker"></i> City</button>
                </form>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="state" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                    <i class="glyphicon glyphicon-map-marker"></i> State</button>
                </form>
            </div>
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="zip_code" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#zipmodal">
                    <i class="glyphicon glyphicon-map-marker"></i> Zip</button>
                </form>
            </div>               
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="countries" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                    <i class="glyphicon glyphicon-map-marker"></i> Country</button>
                </form>
            </div>
            <!--<div class="col-lg-6 col-xs-6 col-sm-6">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="zip_code" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#zipmodal">
                    <i class="glyphicon glyphicon-map-marker"></i> Zip</button>
                </form>
            </div>    -->           
        </div>
        <br class="clear clearfix clearfx" />
        <!-- end user fields -->
      </div>
    </div>
  </div>
  <!-- End User Fields -->
  
  <!-- Security Fields -->
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <i class="glyphicon glyphicon-lock"></i> Security / Anti Spam
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <!-- Security fields -->        
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
            	<form method="post" action="" class="fieldform">
                    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                    <input type="hidden" name="addfield" value="text" />
                    <input type="hidden" name="predefined" value="recaptcha" />
                    <button type="submit" class="btn btn-default form-control input form-control-sm text-left">
                        <i class="glyphicon glyphicon-lock"></i> Re-Captcha</button>
                </form>
                <!--<button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#fieldmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Re-Captcha</button>-->
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
                
        <!--<div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#fieldmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Star Rating</button>
            </div>
         </div>
         <br class="clear clearfix clearfx" />
         
         <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#fieldmodal">
                    <i class="glyphicon glyphicon-text-width"></i> Anti-Spam</button>
            </div>
        </div>
        <br class="clear clearfix clearfx" />-->
        <!-- end user fields -->
      </div>
    </div>
  </div>
  <!-- End Security Fields -->
  
  <!-- Payment Fields -->
  <?php //include('multi-purpose-mail-form-admin-payment-input-buttons.php'); ?>
  <!-- End Payment -->
</div>






<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="calculated" />
    <!--<input type="submit" name="text" id="text" value="Calculated Field" class="button button-primary" />-->
</form>

<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="basecost" />
    <!--<input type="submit" name="text" id="text" value="Base Cost" class="button button-primary" />-->
</form>
<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="text" />
    <!--<input type="submit" name="text" id="text" value="Text Box" class="button button-primary" />-->
</form>


<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="checkbox" />
    <!--<input type="submit" name="checkbox" id="checkbox" value="Checkbox" class="button button-primary" />-->
</form>
<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="email" />
    <!--<input type="submit" name="email" id="email" value="Email Input" class="button button-primary" />-->
</form>



<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="number" />
    <!--<input type="submit" name="number" id="number" value="Number" class="button button-primary" />--> 
</form>

<br />

<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="radio" />
    <!--<input type="submit" name="radio" id="radio" value="Radio" class="button button-primary" />-->
</form>



<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="select" />
    <!--<input type="submit" name="select" id="select" value="Select / Listbox" class="button button-primary" />--> 
</form>

<br />


<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="telephone" />
    <!--<input type="submit" name="telephone" id="telephone" value="Telephone" class="button button-primary"/>-->
</form>



<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="textarea" />
    <!--<input type="submit" name="textarea" id="textarea" value="Textarea" class="button button-primary" />-->
</form>

<br />


<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="date" />
    <!--<input type="submit" name="date" id="date" value="Date" class="button button-primary" />--> 
</form>



<form method="post" action="" class="fieldform">
    <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
    <input type="hidden" name="addfield" value="file" />
    <!--<input type="submit" name="file" id="file" value="File Upload" class="button button-primary" />--> 
</form><!---->