<?php
/*
Plugin Name:    WP System
Plugin URI:     https://wordpress.org/plugins/wp-system/
Description:    Easily spot issues with your WordPress environment and server settings.
Version:        1.0.8
Author:         Michael Ott
Author Email:   hello@michaelott.id.au
Text Domain:    wp-system
Domain Path:    /languages/
*/

/* Look for translation file. */
function load_wp_system_textdomain() {
    load_plugin_textdomain( 'wp-system', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'load_wp_system_textdomain' );

/* Create admin page under the Tools menu. */
add_action('admin_menu', 'create_wp_system_menu');
function create_wp_system_menu() {
    add_management_page( 'WP System', 'WP System', 'manage_options', 'wp-system', 'generate_wp_system_page_content' );
}

/* Add custom CSS to admin */
function wp_system_admin_style() {
	$plugin_data = get_plugin_data( __FILE__ );
    $plugin_version = $plugin_data['Version'];
	$plugin_directory = plugins_url('css/', __FILE__ );
    wp_enqueue_style('wp-system-style-admin', $plugin_directory . 'wp-system.css', '', $plugin_version);
}
add_action('admin_enqueue_scripts', 'wp_system_admin_style');

/* Include jQuery */
function wp_system_admin_load_js(){
	wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'wp_system_admin_load_js');

/* Admin notice on plugin activation */
register_activation_hook( __FILE__, 'wp_syetem_admin_notice_activation_hook' );
 
// Runs only when the plugin is activated
function wp_syetem_admin_notice_activation_hook() {
 
    /* Create transient data */
    set_transient( 'history-admin-notice', true, 1000 );
}

/* Add admin notice */
add_action( 'admin_notices', 'wp_syetem_admin_notice' );
 
// Admin Notice on Activation
function wp_syetem_admin_notice(){
 
    /* Check transient, if available display notice */
    if( get_transient( 'history-admin-notice' ) ){
        ?>
        <div class="updated notice is-dismissible ir-admin-message">
            <?php $plugin_url = admin_url() . 'tools.php?page=wp-system'; ?>
            <p><?php printf( __( '<strong>WP System activated.</strong> Check your system status <a href="%s">here</a>.', 'wp-system' ), $plugin_url); ?></p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'history-admin-notice' );
    }
}


function generate_wp_system_page_content() { ?>
    
    <div class="wrap">
        <h1><?php _e('WP System', 'wp-system'); ?></h1>

        <?php if (isset($_POST['send-report'])) {
            $to = $_POST['recipient'];
        ?>
            <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
                <p><strong><?php printf( __( 'The system report was sent to %1$s', 'wp-system'), $to ); ?></strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
            </div>

        <?php } ?>

        <?php if(isset($_POST['delete-revisions'])) { 
            $revisions_deleted = $_POST['revisions-deleted'];?>
            <div class="updated settings-error notice is-dismissible"> 
                <p><strong><?php printf( __( '%1$s revisions were deleted.', 'wp-system'), $revisions_deleted ); ?></strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'wp-system' ); ?></span></button>
            </div>
        <?php } ?>

        <?php /* Delete revisions */
            if(isset($_POST['delete-revisions'])) { 
                $args = array( 
                    'post_type'         => 'revision', 
                    'posts_per_page'    => -1, 
                    'post_status'       => 'any', 
                    'fields'            => 'ids'
                );
                $revisions = get_posts( $args );
                foreach ($revisions as $revision) {
                    wp_delete_post( $revision, true);
                }
            }
        ?>

        <p><a class="send-report-button button"><?php _e( 'Email This Report', 'wp-system' ); ?></a></p>

        <form class="send-report-form" id="send-report-form" method="post" action="">
            <label for="recipient"></label>
            <input type="email" name="recipient" id="recipient" required />
            <input type="submit" class="button button-primary" name="send-report" value="Send" />
            <span class="cancel-report-send">Cancel</span>
            <img src="<?php echo home_url(); ?>/wp-admin/images/spinner.gif" class="wps-spin" />
        </form>

        <script>
            jQuery('.send-report-button, .cancel-report-send').click(function() {
                jQuery('.send-report-form').toggle();
                jQuery('.send-report-button').toggle();
            });
            jQuery('#send-report-form').submit(function() {
                jQuery('.wps-spin, .cancel-report-send').toggle();
            });
        </script>

        
        <?php 
            require_once('report.php');
            
            if (isset($_POST['send-report'])) {
                require_once('send.php');
            }
        ?>    

    </div>
    <?php require_once('my-tools.php'); ?>
<?php }