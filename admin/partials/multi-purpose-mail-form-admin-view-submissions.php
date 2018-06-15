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

<h2>Submitted Form Data</h2>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

$this_page = admin_url('admin.php?page=mpmf-received');


/**
*
* Perform required actions first
*/
if ( isset ( $_GET['action'] ) && isset ( $_GET['message_id'] ) ){
	global $wpdb;
	$messages_table = $wpdb->prefix.'mpmf_messages';
	$message_id = $_GET['message_id'];
	
	$action = $_GET['action'];
	
	if ( $action == "read" ){
		$approved = $wpdb->update($messages_table , array('message_status'=>1), array('message_id'=>$message_id), array('%d'), array('%d') );
		if ( $approved ){
			echo '<div class="updated"><p>Message marked as read</p></div>';
		}else{
			echo '<div class="update-nag wrap"><p>Failed to mark the message as read.</p></div>';
		}
	}
	elseif( $action == "unread" ){
		$declined = $wpdb->update($messages_table, array('message_status'=>0), array('message_id'=>$message_id), array('%d'), array('%d') );
		if ( $declined ){
			echo '<div class="updated"><p>The message has been marked as unread</p></div>';
		}else{
			echo '<div class="update-nag wrap"><p>Failed to unread the message.</p></div>';
		}
	}
	
	elseif( $action == "delete" ){
		$deleted = $wpdb->delete($messages_table, array('message_status'=>9), array('message_id'=>$message_id), array('%d'), array('%d') );
		if ( $deleted ){
			echo '<div class="updated"><p>The message has been trashed</p></div>';
		}else{
			echo '<div class="update-nag wrap"><p>Failed to trash the message.</p></div>';
		}
	}
}

/*
* get the messages
*/

function mpmf_get_messages($status="all"){
	global $wpdb;
	
	$messages_list 	= array();
	
	$messages_table = $wpdb->prefix.'mpmf_messages';
	$forms_table 	= $wpdb->prefix.'mpmf_forms';
	
	if ( $status == "all" )
		$messages_sql 	= "SELECT * FROM $messages_table";
	else
		$messages_sql 	= "SELECT * FROM $messages_table WHERE message_status='".$status."'";
		
	
	$messages 		= $wpdb->get_results( $messages_sql );

	foreach ( $messages as $message){
		
		$form_name = $wpdb->get_var("SELECT mpmf_form_name FROM $forms_table WHERE mpmf_form_id='".$message->mpmf_form_id."'");
		
		$add_message['message_id']	 	= $message->message_id;
		$add_message['date_sent']	 	= $message->date_sent;
		$add_message['mpmf_form_name']	= $form_name;				
		$add_message['message_data']	= $message->message_data;
		$add_message['message_status']	= $message->message_status;		
		
		$messages_list[] = $add_message;
	}
	
	return  $messages_list;
}
?>
<?php
	global $wpdb;
	
	if ( isset ( $_GET['message_status'] ) ){
		$status = $_GET['message_status'];	
	}else{ $status = "all"; }
	
	$messages 			= mpmf_get_messages( $status );
	
	$messages_table	= $wpdb->prefix.'mpmf_messages';
	$all 			= $wpdb->get_var("SELECT count('message_id') AS count_messages FROM $messages_table");
	$approved 		= $wpdb->get_var("SELECT count('message_id') AS count_messages FROM $messages_table WHERE message_status='1'");
	$pending 		= $wpdb->get_var("SELECT count('message_id') AS count_messages FROM $messages_table WHERE message_status='0'");
	$declined 		= $wpdb->get_var("SELECT count('message_id') AS count_messages FROM $messages_table WHERE message_status='9'");
?>
    <ul class='subsubsub'>
        <li class='all'>
            <a href='<?php echo $this_page; ?>&message_status=all' <?php if ($status=="all" ) echo 'class="current"'; ?>>
            All <span class="count"><?php echo $all; ?></span></a> |
        </li>
        <li class='super'>
            <a href='<?php echo $this_page; ?>&message_status=1' <?php if ($status=="1" ) echo 'class="current"'; ?>>Read 
            <span class="count"><?php echo $approved; ?></span></a> |
        </li>
        <li class='super'>
            <a href='<?php echo $this_page; ?>&message_status=0' <?php if ($status=="0" ) echo 'class="current"'; ?>>Not read
            <span class="count"><?php echo $pending; ?></span></a> |
        </li>
        <li class='super'>
            <a href='<?php echo $this_page; ?>&message_status=9' <?php if ($status=="9" ) echo 'class="current"'; ?>>Deleted 
            <span class="count"><?php echo $declined; ?></span></a>
        </li>
    </ul>
	<!--<form method="get" class="search-form" action="">
		<p class="search-box">
            <label class="screen-reader-text" for="all-user-search-input">Search Users:</label>
            <input type="search" id="all-user-search-input" name="s" value="" />
            <input type="submit" id="search-submit" class="button" value="Search Leads"  />
   		</p>
	</form>-->
    <br />
<form id="form-user-list" action="<?php echo $this_page; ?>&message_status=all" method="post">		
    	<br /><br />
		<div class="alignleft actions bulkactions">
			<label for='bulk-action-selector-top' class='screen-reader-text'>Select bulk action</label>
            <select name='action' id='bulk-action-selector-top'>
            	<option value='-1' selected='selected'>Bulk Actions</option>
                <option value='delete'>Delete</option>
                <option value='spam'>Mark as Spam</option>
                <option value='notspam'>Not Spam</option>
            </select>
            <input type="submit" id="doaction" class="button action" value="Apply"  />
		</div>
        
<div class="wrap">	
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
                    	<h3 class="hndle">Help / How To</h3>
    					<div class="inside" style="min-height:50%;">
                            <table class="wp-list-table widefat striped users-network">
                                <thead>
                                    <tr>
                                        <th scope='col' id='cb' class='manage-column column-cb check-column'>&nbsp;</th>
                                        <th scope='col' id='username' class='manage-column column-username sortable desc'>
                                            <a href="#"><span>Form Name</span></a>
                                        </th>
                                        <th scope='col' id='name' class='manage-column column-name sortable desc'>
                                            <a href="#"><span>Date Received</span></a>
                                        </th>
                                        <th scope='col' id='username' class='manage-column column-username sortable desc' width="60%">
                                           Message Actions
                                        </th>
                                    </tr>
                                </thead>
                            
                                <tbody id="the-list">
                                    <?php
                                    if ( count ($messages) > 0 ){
                                    
                                    $admin = new Multi_Purpose_Mail_Form_Admin('multi-purpose-mail-form','1.0.0');
                                     for ($c = 0; $c <count ($messages);  $c++ ):
                                    ?>
                                    <tr class="">
                                        <th scope="row" class="check-column">&nbsp;</th>
                                        <td class='username column-username'>
                                            <?php echo $messages[$c]['mpmf_form_name']; ?>
                                        </td>
                                        
                                        <td class='name column-name'>
                                            <?php echo $messages[$c]['date_sent']; ?>
                                            <br/>
                                            
                                        </td>
                                        <td class='email column-email' align="left">
                                            <a href="#" class="" data-toggle="modal" data-target="#message<?php echo $messages[$c]['message_id']; ?>">
                                                <i class="glyphicon glyphicon-envelope"></i> View Message
                                            </a>  
                                        
                                            <!--|<strong>
                                                <?php 
                                                 $status = $messages[$c]['message_status'];
                                                 if ( $status == 0) echo "New / Unread";
                                                 elseif ( $status == 1 ) echo "Read";
                                                 elseif ( $status == 9 ) echo "Trashed";
                                                 
                                                 ?>
                                            </strong>
                                            <br/>
                                            <div class="row-actions">
                                                <span class='edit'>
                                                    <a href="<?php echo $this_page; ?>&action=read&message_id=<?php echo $messages[$c]['message_id']; ?>">Read</a> | 
                                                </span>
                                                <span class='edit'>
                                                    <a href="<?php echo $this_page; ?>&action=unread&message_id=<?php echo $messages[$c]['message_id']; ?>">Unread</a> |
                                                </span>
                                                <span class='edit'>
                                                    <a href="<?php echo $this_page; ?>&action=delete&message_id=<?php echo $messages[$c]['message_id']; ?>">Delete</a> 
                                                </span>
                                            </div>-->
                                            
                                            <!-- message modal -->
                                            <?php echo $admin->message_modal($messages[$c]['message_id'], $messages[$c]['message_data'] , $this_page); ?>	
                                        </td>
                                    </tr>
                                    <?php endfor;
                                    }else{?>
                                        <tr><td colspan="7">No messages found</td></tr>
                                    <?php }	?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                       <th scope='col' id='cb' class='manage-column column-cb check-column'>&nbsp;</th>
                                        <th scope='col' id='username' class='manage-column column-username sortable desc'>
                                            <a href="#"><span>Form Name</span></a>
                                        </th>
                                        <th scope='col' id='name' class='manage-column column-name sortable desc'>
                                            <a href="#"><span>Date Received</span></a>
                                        </th>
                                        <th scope='col' id='username' class='manage-column column-username sortable desc' width="60%">
                                            Message Actions
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
						</div>
					</div>
				</div>
			</div>                
		</div>                
 	</div>               
</div>
</form>