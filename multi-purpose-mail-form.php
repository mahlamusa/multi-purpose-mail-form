<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://lindeni.co.za
 * @since             1.0.0
 * @package           Multi_Purpose_Mail_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Multi Purpose Mail Form
 * Plugin URI:        http://wordpress.org/plugins/multi-purpose-mail-form/
 * Description:       Create unlimited custom forms with unlimited fields. With Google ReCAPTCHA Integration.
 * Version:           1.0.2
 * Author:            mahlamusa
 * Author URI:        http://lindeni.co.za
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       multi-purpose-mail-form
 * Domain Path:       /languages
 */
 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-multi-purpose-mail-form-activator.php
 */
function activate_multi_purpose_mail_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-multi-purpose-mail-form-activator.php';
	Multi_Purpose_Mail_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-multi-purpose-mail-form-deactivator.php
 */
function deactivate_multi_purpose_mail_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-multi-purpose-mail-form-deactivator.php';
	Multi_Purpose_Mail_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_multi_purpose_mail_form' );
register_deactivation_hook( __FILE__, 'deactivate_multi_purpose_mail_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-multi-purpose-mail-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_multi_purpose_mail_form() {

	$plugin = new Multi_Purpose_Mail_Form();
	$plugin->run();

}
run_multi_purpose_mail_form();