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

$admin = new Multi_Purpose_Mail_Form_Admin('multi-purpose-mail-form','1.0.0');


function mpmf_add_field_option($field_id){
	if ( isset ( $_POST['add-option'] ) ){
		global $wpdb;
		//if ( $_POST['ftype'] == 'select' || $_POST['ftype'] == 'radio' || $_POST['ftype'] == 'checkbox' ):
		$options_table = $wpdb->prefix.'mpmf_field_options';
		//print_r ( $_POST );
		
		
		if ( ($field_id == 0 || !isset( $field_id) ) && isset( $_POST['addfieldoptions'] ) ) {
			$field_id = esc_attr ( $_POST['addfieldoptions'] );
		}
		/*$option_label 	= stripslashes ( $_POST['option_label'] );
		$option_value 	= stripslashes ( $_POST['option_value'] );*/
		
		
		if ( !isset ( $field_id ) || $field_id == 0) {
			# option not attached to any field
			$field_id = 0; 
		}
		
		for( $i=0; $i < count( $_POST['label'] ); $i ++ ){
			$insert = $wpdb->insert(
				$options_table,
				array("mpmf_field_id"=> $field_id,"mpmf_option_label"=> esc_attr($_POST['label'][$i]), "mpmf_option_value"=>esc_attr($_POST['value'][$i])),
				array('%d', '%s', '%s')
			);
			$insert = $wpdb->insert_id;
			if ( is_int( $insert) ) $inserted = true;
			else $inserted = false;
		}
		
		if ( $inserted == true){
			echo '<div class="updated"><p>Option(s) added successfully.</p></div>';
		}
		else{
			echo '<div class="update"><p>Please double check the options for this field.<p></div>';
		}
		
		//print_r( $_POST['options'] );
	}	
}
?>


<?php 
	if ( isset( $_POST['updateform'] ) || isset( $_POST['addform'] ) || !isset($_POST['editform']) || isset($_POST['deleteform'] ) ) :
	
?>
<h1>Multi Purpose Mail Form</h1>
<div id="normal-sortables" class="meta-box-sortables">	
   <div id="metabox_basic_settings" class="postbox">   		
        <h3 class="hndle" style="padding:5px;">
             <span>Form List / Items List</span>
        </h3>
        <?php
			global $wpdb;
			$table = $wpdb->prefix . 'mpmf_forms';
			
			if ( isset ( $_POST['addform'] ) ){
				//add form	
				
				$inserted = $wpdb->insert(
					$table,
					array('mpmf_form_name'=>$_POST['mpmf_form_name']),
					array('%s')
				);
				
				if ( $inserted ) 
					echo '<div class="updated"><p>Form created successfully</p></div>';
				else
					echo '<div class="update"><p>Failed to create the form</p></div>';
			}
			
			if ( isset ( $_POST['updateform'] ) ) {
				//updateform	
				$updated = $wpdb->update(
					$table,
					array('mpmf_form_name'=>$_POST['mpmf_form_name']),					
					array('mpmf_form_id'=>$_POST['updateform']),
					array('%s'),
					array('%d')
				);
				
				if ( $updated )
					echo '<div class="updated"><p>Form updated successfully</p></div>';
				else
					echo '<div class="update"><p>Failed to update the form</p></div>';
			}
			
			if ( isset ( $_POST['deleteform'] ) ){
				$deleted = $wpdb->delete(
					$table, array('mpmf_form_id'=>$_POST['deleteform'])
				);
				
				if ( $deleted )
					echo '<div class="updated"><p>Form deleted successfully</p></div>';
				else
					echo '<div class="update"><p>Failed to delete the form</p></div>';
			}
	
		?>
        <div class="inside">
        	<?php
				  global $wpdb;
				  $forms_table = $wpdb->prefix.'mpmf_forms';
				  $forms = $wpdb->get_results( "SELECT * FROM $forms_table ORDER BY mpmf_form_id");
				  
				  if ( $forms ):
			?>
             <table cellspacing="10" cellpadding="5" class="table table-striped">
                  <tr>
                       <th align="left">
                            ID
                       </th>
                       <th align="left">
                            Form Name
                       </th>
                       <th align="left">
                            &nbsp; &nbsp; Options
                       </th>
                       <th align="left">
                            Shortcode
                       </th>
                  </tr>
                  <?php				  
				  foreach ( $forms as $form ):
				  ?>
                  <tr>
                  
                       <td nowrap>
                            <?php echo $form->mpmf_form_id; ?>
                       </td>
                       <td nowrap>
                       		<form name="updateform" action="" method="post">
                            	<input type="hidden" name="updateform" value="<?php echo $form->mpmf_form_id; ?>" />
                                <div class="input-group">
                                    <input type="text" name="mpmf_form_name" id="mpmf_form_name" value="<?php echo $form->mpmf_form_name; ?>" class="form-control input input-large">
                                    <span class="input-addon">
                                        <input type="submit" name="update" value="Update" class="button button-primary" />
                                    </span>
                                </div>
                            </form>
                       </td>
                       <td nowrap>
                           <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <form name="edit-form" action="" method="post" class="formactions form-inline inline">
                                        <input type="hidden" name="editform" value="<?php echo $form->mpmf_form_id; ?>" />                            
                                        <!--<input type="submit"  name="edit-form" value="Edit Fields" class="button button-primary" />--> 
                                        <button type="submit" name="edit-form" class="button button-primary" ><i class="fa fa-pencil"></i> Edit Fields</button>
                                       
                                    </form>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <!--&nbsp;
                                    <input type="button" name="calmanage_1" value="Messages" class="button button-primary"> 
                                    &nbsp;
                                    <input type="button" name="calclone_1" value="Clone" class="button" /> 
                                    &nbsp;-->
                                    <form name="deleteform" action="" method="post" class="formactions  form-inline inline"> 
                                        <input type="hidden" name="deleteform" value="<?php echo $form->mpmf_form_id; ?>" />
                                        <input type="submit" name="delete-form" value="Delete" class="button" />
                                    </form>
                                    
                                </div>
                           </div>
                       </td>
                       <td nowrap>
                            <!-- form shortcode goes here -->
                            [mpmfcustom id="<?php echo $form->mpmf_form_id; ?>"]
                       </td>
                  </tr>
                  <?php endforeach; ?>
             </table>
             <?php else: ?>
             <h4>You currently don't have any forms. Use the form below to start creating new forms.</h4>
             <?php  endif; ?>
        </div>
   </div>
   <div id="metabox_basic_settings"
        class="postbox">
        <h3 class="hndle" style="padding:5px;">
             <span>New Form</span>
        </h3>
        <div class="inside">
            <form name="additem" id="additem" action="" method="post" class="form">
                <label>Form Name:</label>
                <div class="input-group">
                    <input type="text" name="mpmf_form_name" id="mpmf_form_name"  value="" placeholder="Name your new form." class="form-control input input-large" aria-labelledby="#addon1" />
                    <span class="input-addon" id="addon1">
                        <input type="submit" name="addform" value="Create" class="button-primary">
                    </span>
                </div>
            </form>
        </div>
   </div>
</div>
<?php

elseif (isset( $_POST['editform'] ) || isset( $_POST['formid'] ) ):

$formid = $_POST['editform'];


		
?>


<div class="wrap">	
	<h2>Multi Purpose Mail Form</h2>
    <p></p>
    <?php
	
	
	//adding predefined fields
	if ( isset ( $_POST['predefined'] ) ){
		global $wpdb;
		$table = $wpdb->prefix . 'mpmf_form_fields';
		
		$mpmf_form_id	= stripslashes( $_POST['editform'] );
		
		$format = array('%d', '%s', '%s', '%s','%s','%s', '%d');
		
		if ( $_POST['predefined'] == "first_name" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'First Name', 
				'field_default'=>'John',
				'field_name'=>'first_name', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>1
			);		
		}
		elseif ( $_POST['predefined'] == "last_name" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Last Name', 
				'field_default'=>'Doe',
				'field_name'=>'last_name', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>2
			);		
		}
		elseif ( $_POST['predefined'] == "email_address" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Your email address', 
				'field_default'=>'you@example.com',
				'field_name'=>'email_address', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>3
			);		
		}
		elseif ( $_POST['predefined'] == "phone_number" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Phone Number', 
				'field_default'=>'000 000 0000', 
				'field_name'=>'phone_number', 
				'field_css_id'=>'',
				'field_type'=>'tel', 
				'field_value'=>'',
				'field_sort_order'=>4
			);		
		}
		
		elseif ( $_POST['predefined'] == "street_address" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Street Address', 
				'field_default'=>'123 Street Name', 
				'field_name'=>'state', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>5
			);		
		}
		
		elseif ( $_POST['predefined'] == "city" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'City', 
				'field_default'=>'Name of your city', 
				'field_name'=>'city', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>6
			);		
		}
		
		
		elseif ( $_POST['predefined'] == "state" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'State / Province', 
				'field_default'=>'State', 
				'field_name'=>'state', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>7
			);		
		}
		
		elseif ( $_POST['predefined'] == "zip_code" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'ZIP/Postal Code', 
				'field_default'=>'ZIP / Postal Code', 
				'field_name'=>'zip', 
				'field_css_id'=>'',
				'field_type'=>'text', 
				'field_value'=>'',
				'field_sort_order'=>8
			);		
		}
		
		elseif ( $_POST['predefined'] == "countries" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Country', 
				'field_name'=>'country', 
				'field_css_id'=>'',
				'field_default'=>'Select A Country',
				'field_type'=>'countries', 
				'field_value'=>'[mpmfcountries]',
				'field_sort_order'=>9
			);		
		}
		
		elseif ( $_POST['predefined'] == "recaptcha" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Captcha', 
				'field_default'=>'[mpmfcaptcha]', 
				'field_name'=>'captcha', 
				'field_css_id'=>'captcha',
				'field_type'=>'recaptcha', 
				'field_value'=>'[mpmfcaptcha]',
				'field_sort_order'=>1000009
			);		
		}
		elseif ( $_POST['predefined'] == "submit_button" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Submit', 
				'field_name'=>'submit', 
				'field_css_id'=>'',
				'field_default'=>'Submit',
				'field_type'=>'submit', 
				'field_value'=>'Submit',
				'field_field_editmode'=>'editable',
				'field_sort_order'=>1000010
			);		
		}
		
		
		
		/*elseif ( $_POST['predefined'] == "basecost" ){
			$data = array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>'Base Cost', 
				'field_default'=>'0', 
				'field_name'=>'base_cost', 
				'field_css_id'=>'base_cost',
				'field_type'=>'basecost', 
				'field_value'=>'',
				'field_sort_order'=>0
			);		
		}*/
		//
		$inserted = $wpdb->insert( $table, $data, $format);	
		//if inserted
		if ( $inserted ){
			echo '<div class="updated"><p>Form field created successfully</p></div>';
			$field_id = $wpdb->insert_id;
		}
		else
			echo '<div class="update"><p>Failed to create the field</p></div>';	
	}
	if ( isset( $_POST['add-field'] ) ){
		global $wpdb;
		$table = $wpdb->prefix . 'mpmf_form_fields';
		
		$mpmf_form_id	= stripslashes( $_POST['editform'] );
		
		$mpmf_form_id	= stripslashes( $_POST['editform'] );
		$flabel		= stripslashes( $_POST['flabel'] );
		$fdefault	= stripslashes( $_POST['fdefault'] );
		$fname		= stripslashes( $_POST['fname'] );
		$fcssid		= stripslashes( $_POST['fcssid'] ); 
		$ftype		= stripslashes( $_POST['ftype'] ); 
		$editmode	= stripslashes( $_POST['editmode'] );
		
		$fsort		= stripslashes( $_POST['fsortorder'] );
		
		if ( $_POST['ftype'] == "file" ){
			$fvalue	= array('file_size'=>$_POST['file_size'], 'file_types'=>$_POST['file_types']);
		}else{
			$fvalue	= stripslashes( $_POST['fvalue'] );
		}
		
		$inserted = $wpdb->insert(
			$table,
			array(
				'mpmf_form_id'=>$mpmf_form_id, 
				'field_label'=>$flabel, 
				'field_default'=>$fdefault,
				'field_name'=>$fname, 
				'field_css_id'=>$fcssid,
				'field_type'=>$ftype, 
				'field_editmode'=>$editmode,
				'field_value'=>$fvalue,
				'field_sort_order'=>$fsort
			),
			array('%d', '%s', '%s','%s','%s', '%s', '%s', '%s', '%d')
		);	
		
		//if inserted
		if ( $inserted ){
				echo '<div class="updated"><p>Form field created successfully</p></div>';
				$field_id = $wpdb->insert_id;
				
				if ( isset ( $_POST['add-option'] ) ){
					mpmf_add_field_option($field_id);
				}
		}
		else
			echo '<div class="update"><p>Failed to create the field</p></div>';
    }
	
	if ( isset ( $_POST['updatefield'] ) ){
		global $wpdb;
		$fields_table = $wpdb->prefix . 'mpmf_form_fields';
		
		$field_id	= stripslashes( $_POST['field_id'] );
		$flabel  	= stripslashes( $_POST['flabel'] );
		$fdefault	= stripslashes( $_POST['fdefault'] );
		$fname		= stripslashes( $_POST['fname'] );
		$fcssid		= stripslashes( $_POST['fcssid'] );
		$ftype		= stripslashes( $_POST['ftype'] );
		$fsort 		= stripslashes( $_POST['fsortorder'] );
		$fvalue		= stripslashes( $_POST['fvalue'] );
		$editmode	= stripslashes ( $_POST['editmode'] );
		
		$updated 	= $wpdb->update(
			$fields_table,
			array(
				'field_label'=>$flabel, 
				'field_default'=>$fdefault, 
				'field_type'=>$ftype, 
				'field_name'=>$fname, 
				'field_css_id'=>$fcssid, 
				'field_editmode'=>$editmode, 
				'field_value'=>$fvalue, 
				'field_sort_order'=>$fsort
			),
			array('field_id'=>$field_id),
			array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'),
			array('%d')
		);
		
		if( $updated )
			echo '<div class="updated">Field Updated Successfully.</div>';	
		else
			echo '<div class="update"><p>Failed to update field</p></div>';		
	}
	
	
	if ( isset ( $_POST['deletefield'] ) ){
		global $wpdb;
		$fields_table = $wpdb->prefix . 'mpmf_form_fields';
		
		$deleted = $wpdb->delete($fields_table, array('field_id'=>$_POST['deletefield']), array('%d'));
		if ( $deleted )
			echo '<div class="updated"><p>The field have been removed from the form</p></div>';
		else
			echo '<div class="update-nag"><p>Failed to delete field</p></div>';
	}
	
	if ( isset ( $_POST['add-option']) && ! isset( $_POST['add-field'] ) ){
		mpmf_add_field_option( $_POST['add-field'] );
	}
	
	/*if ( isset ( $_POST['add-option'] ) ){
		global $wpdb;
		//if ( $_POST['ftype'] == 'select' || $_POST['ftype'] == 'radio' || $_POST['ftype'] == 'checkbox' ):
		$options_table = $wpdb->prefix.'mpmf_field_options';
		//print_r ( $_POST );
		$field_id 		=  esc_attr( $_POST['add-option'] );
		
		if ( ($field_id == 0 || !isset( $field_id) ) && isset( $_POST['addfieldoptions'] ) ) {
			$field_id = esc_attr ( $_POST['addfieldoptions'] );	
		}
		//$option_label 	= stripslashes ( $_POST['option_label'] );
		$option_value 	= stripslashes ( $_POST['option_value'] );
		
		
		if ( !isset ( $field_id ) || $field_id == 0) {
			# option not attached to any field
			$field_id = 0; 
		}
		
		for( $i=0; $i < count( $_POST['label'] ); $i ++ ){
			$insert = $wpdb->insert(
				$options_table,
				array("mpmf_field_id"=> $field_id,"mpmf_option_label"=> esc_attr($_POST['label'][$i]), "mpmf_option_value"=>esc_attr($_POST['value'][$i])),
				array('%d', '%s', '%s')
			);
			$insert = $wpdb->insert_id;
			if ( is_int( $insert) ) $inserted = true;
			else $inserted = false;
		}
		
		if ( $inserted == true){
			echo '<div class="updated"><p>Option(s) added successfully.</p></div>';
		}
		else{
			echo '<div class="update"><p>Please double check the options for this field.<p></div>';
		}
		
		//print_r( $_POST['options'] );
	}*/
	
	if ( isset ( $_POST['add-formula'] ) ){
		global $wpdb;
		$formula_table = $wpdb->prefix.'mpmf_field_formulae';
		$formula = $wpdb->insert($formula_table, array('field_id'=>$_POST['field_id'], 'formula'=>$_POST['formula']), array('%d', '%s') );
		
		if ( $formula ){
			echo '<div class="updated"><p>Formula added to the field.</p></div>';	
		}
		else{
			echo '<div class="update-nag"><p>Failed to add formula to the field.</p></div>';
		}
	}
	
	if ( isset ( $_POST['update-formula'] ) ){
		global $wpdb;
		$formula_table = $wpdb->prefix.'mpmf_field_formulae';
		$formula = $wpdb->update(
			$formula_table, 
			array('formula'=>$_POST['formula']),
			array('formula_id'=>$_POST['formula_id'],'field_id'=>$_POST['field_id']),
			array('%s'), array('%d')
		);
		
		if ( $formula ){
			echo '<div class="updated"><p>Field Formula Updated</p></div>';	
		}
		else{
			echo '<div class="update-nag"><p>Failed to update formula. Please try again.</p></div>';
		}
	}
	?>
       
    <div id="poststuff" class="metabox-holder has-right-sidebar">
    
        <div id="side-info-column" class="inner-sidebar">
            <div id="side-sortables" class="meta-box-sortables ui-sortable">
                <div class="postbox">
                    <div class="handlediv" title="Click to toggle"><br /></div>
                    <h3 class="hndle">Add fields</h3>
                    <div class="inside welcome-panel-column welcome-panel-last">
                    	<!-- Buttons for form inputs -->
                        <?php include('multi-purpose-mail-form-admin-input-buttons.php'); ?>
                        <!-- /buttons -->
                    </div>                     
                </div>
               <?php				
				/**
				* if ( isset ( $_POST['add-field'] ) || isset( $_POST['field_id'] )):
				
					if ( isset ($_POST['field_id'] ) ) $field_id = $_POST['field_id'];
					
					if ( $_POST['ftype'] == 'select' || $_POST['ftype'] == 'radio' || $_POST['ftype'] == 'checkbox' ):
						?>
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br /></div>
							<h3 class="hndle">Add / Edit Options</h3>
							<div class="inside welcome-panel-column welcome-panel-last">
								<?php
								$formid = $_POST['editform'];
								$addfield = $_POST['add-field'];						
								?>
								<form name="add-option" action="" method="post" class="fieldform">
									<!-- condition control -->
									<input type="hidden" name="field_id" value="<?php echo $field_id; ?>" />
									<input type="hidden" name="ftype" value="<?php echo $_POST['ftype']; ?>" />
									<input type="hidden" name="editform" value="<?php echo $formid; ?>" />
									<!-- end control -->
									
									<label for="option_label">Option Label</label><br />
									<input name="option_label" value="" />
									<label for="option_value">Option Value</label>
									<input type="text" name="option_value" value="" /><br />
									
									<!--<label for="field_value">Field Value</label><br />
									<input name="fvalue" value="" />-->
									
									
									<input type="hidden" name="add-option" value="add-option" />
									<input type="submit" value="Add Option Field" class="button-primary" />
								</form>	        
							</div>                     
						</div>
						<?php
                	endif; 
				endif;
				***/?>           
            </div>

        </div>
                         
        <div id="post-body">
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                	<div class="postbox inside">
						<div class="handlediv" title="Click to toggle"><br /></div>
                        <?php
							global $wpdb;
							$forms_table = $wpdb->prefix.'mpmf_forms';
							$form = $wpdb->get_row("SELECT mpmf_form_id, mpmf_form_name FROM $forms_table WHERE mpmf_form_id='".$_POST['editform']."'");
						?>
                    	<h3 class="hndle lead"><strong>Form preview | <?php echo $form->mpmf_form_id . ':: ' . $form->mpmf_form_name; ?></strong></h3>
    					<div class="inside" style="min-height:50%;">
                            <p>Please note that the form may not look as it should, this is just a preview</p>
                            
                            <?php
								if ( isset( $_POST['editform'] ) && isset( $_POST['editfield'] ) ):
									?>
									<div class="postbox">
										<div class="handlediv" title="Click to toggle"><br /></div>
										<h3 class="hndle">Add / Edit field</h3>
										<div class="inside welcome-panel-column welcome-panel-last">
											<?php echo $admin->add_or_edit_field($_POST['editform'], "editfield", $_POST['editfield']); ?>            
										</div>                     
									</div>
									<?php
								else:
									echo $admin->mpmf_print_form(array('id'=>$_POST['editform']));
								endif;
							?>
                        </div>
                        <br />
                        <br />
                    </div>
					<?php
						if ( isset ($_POST['ftype']) && $_POST['ftype'] == "calculated" && !isset($_POST['add-formula']) && !isset($_POST['update-formula']) ) : ?>
                    <div class="postbox inside">
                    	<div class="handlediv" title="Click to toggle"><br /></div>
                    	<h3 class="hndle">Add / Edit Formula</h3>
                		<div class="inside" style="min-height:50%;">
							<?php
                            $formid = $_POST['editform'];
                            $addfield = $_POST['add-field'];
                            
                            ?>
                            <form name="add-option" action="" method="post" class="fieldform">
                                <!-- condition control -->
                                <input type="hidden" name="field_id" value="<?php echo $field_id; ?>" />
                                <input type="hidden" name="ftype" value="<?php echo $_POST['ftype']; ?>" />
                                <input type="hidden" name="editform" value="<?php echo $formid; ?>" />
                                <!-- end control -->
                                
                                <table class="form-table" style="width:100%">
                                	<tr>
                                    	<td style="width:50%" valign="top">
                                        	<?php
                                            
												if ( isset ($_POST['field_id'] ) )
													$field_id = $_POST['field_id'];
													
													
                                                $fields_table = $wpdb->prefix . 'mpmf_form_fields';
                                                $fields = $wpdb->get_results(
                                                    "SELECT * FROM $fields_table 
                                                    WHERE mpmf_form_id='".$formid."' 
                                                    ORDER BY field_sort_order"
												);
													
												$formula_table = $wpdb->prefix.'mpmf_field_formulae';
												$formula = $wpdb->get_row("SELECT * FROM $formula_table WHERE field_id='" . $field_id ."'");
												
												//print_r( $formula );
												
											?>
                                        	<label for="formula">Write your Formula</label><br />
                                			<textarea name="formula" id="formula" style="width:100%;" rows="6" class="screen"><?php 
											echo stripslashes($formula->formula); ?></textarea>
                                            <input type="hidden" name="formula_id" value="<?php echo $formula->formula_id; ?>" />
                                            <input type="hidden" name="field_id" value="<?php echo $formula->field_id; ?>" />
                                            <br />
                                            <p>Operands: You may use the following fields in your formula</p>
                                            <br />
                                            <p><select name="operand" id="operand" style="width:80%; display:inline;">
											<?php
                                        
                                                foreach( $fields as $field ) {
                                                ?>
                                                <option value="<?php echo $field->field_name; ?>"><?php echo $field->field_name; ?> | 
                                                <?php echo $field->field_css_id; ?> | <?php echo $field->field_label ?></option>
                                            <?php }?>
                                            </select>
                                            <input type="button" name="addoperand" value="+" onclick="addToFormula()" style="width:10%;display:inline"/></p>
                             
                             				<?php if ( !$formula) : ?>
                             				<input type="hidden" name="add-formula" value="update-formula" />
                                			<input type="submit" value="Add Field Formula" class="button-primary" /> 
                                            <?php else: ?>
                                            <input type="hidden" name="update-formula" value="add-formula" />
                                			<input type="submit" value="Update Field Formula" class="button-primary" />
                                            <?php endif; ?> 
                                        </td>
                                        <td style="width:50%">
                                        	<div id="calculator">
                                                <!-- Screen and clear key -->
                                                <div class="top">
                                                    <span class="clear" onclick="clearAll()">C</span>
                                                </div>
                                                <div class="keys">
                                                    <!-- operators and other keys -->
                                                    <span onclick="addThis(7)">7</span>
                                                    <span onclick="addThis(8)">8</span>
                                                    <span onclick="addThis(9)">9</span>
                                                    <span class="operator" onclick="addThis('+')">+</span>
                                                    <span onclick="addThis(4)">4</span>
                                                    <span onclick="addThis(5)">5</span>
                                                    <span onclick="addThis(6)">6</span>
                                                    <span class="operator" onclick="addThis('-')">-</span>
                                                    <span onclick="addThis(1)">1</span>
                                                    <span onclick="addThis(2)">2</span>
                                                    <span onclick="addThis(3)">3</span>
                                                    <span class="operator" onclick="addThis('/')">÷</span>
                                                    <span onclick="addThis(0)">0</span>
                                                    <span onclick="addThis('.')">.</span>
                                                    <span class="eval" onclick="addThis('=')">=</span>
                                                    <span class="operator" onclick="addThis('*')">x</span>
                                              </div>
                                              <div class="keys">  
                                                    
                                                    <span onclick="addThis('(')">(</span>
                                                    <span onclick="addThis(')')">)</span>
                                                    <!-- operators and other keys<span onclick="addThis('ABS')">ABS</span>
                                                    <span onclick="addThis('CEIL')">CEIL</span>
                                                    <span onclick="addThis('FLOOR')">FLOOR</span>
                                                    <span onclick="addThis('SQRT')">SQRT</span>
                                                    <span onclick="addThis('MAX')">MAX</span>
                                                    <span onclick="addThis('MIN')">MIN</span> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>                                
                                
                            </form>	        
                        </div>                    	
                    </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrap --> 
<?php


endif;