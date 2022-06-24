<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(is_admin()) {
    global $wpdb;
    global $variable;

    $wp_theme_info          = wp_get_theme();
    $wp_theme_name          = $wp_theme_info->get( 'Name' );
    $wp_theme_version       = $wp_theme_info->get( 'Version' );
    $wp_memory              = WP_MEMORY_LIMIT;
    //$wp_memory_in_use       = size_format(@memory_get_usage(TRUE), 2);
    $upload_max_filesize    = (int)(ini_get('upload_max_filesize'));
    $post_max_size          = (int)(ini_get('post_max_size'));
    $php_memory             = round(memory_get_usage() / 1024 / 1024, 2);
    $ram_available          = ini_get('memory_limit');
    $mysql_version          = $wpdb->db_version();
    $user_count             = count_users();
    $date_format            = get_option('date_format');
    $time_format            = get_option('time_format');
    $start_of_week          = get_option('start_of_week');

    if($start_of_week == 1) {
        $start_of_week = sprintf('Monday', 'wp-system' );
    } else if($start_of_week == 2) {
        $start_of_week = sprintf('Tuesday', 'wp-system' );
    } else if($start_of_week == 3) {
        $start_of_week = sprintf('Wednesday', 'wp-system' );
    } else if($start_of_week == 4) {
        $start_of_week = sprintf('Thursday', 'wp-system' );
    } else if($start_of_week == 5) {
        $start_of_week = sprintf('Friday', 'wp-system' );
    } else if($start_of_week == 6) {
        $start_of_week = sprintf('Saturday', 'wp-system' );
    } else if($start_of_week == 0) {
        $start_of_week = sprintf('Sunday', 'wp-system' );
    }

    $posts_per_page         = get_option('posts_per_page');
    $posts_per_rss          = get_option('posts_per_rss');
    $users_can_register     = get_option('users_can_register');

    if($users_can_register == 0) {
        $users_can_register = sprintf('No', 'wp-system' );
    } else {
        $users_can_register = sprintf('Yes', 'wp-system' );
    }

    $thumbnail_width        = get_option( 'thumbnail_size_w' );
    $thumbnail_height       = get_option( 'thumbnail_size_h' );

    $medium_width           = get_option( 'medium_size_w' );
    $medium_height          = get_option( 'medium_size_h' );

    $large_width            = get_option( 'large_size_w' );
    $large_height           = get_option( 'large_size_h' );


    $license_key            = get_option('license_server_last_key_queried');
    $mailserver_port        = get_option('mailserver_port');
    $permalink_structure    = get_option('permalink_structure');
    $stylesheet             = get_option('stylesheet');
    $admin_email            = get_option('admin_email');
    $current_wp_version     = get_bloginfo( 'version' );
    
    $count_pages            = wp_count_posts('page');
    $count_the_pages        = $count_pages->publish;
    $count_posts            = wp_count_posts('post');
    $count_the_posts        = $count_posts->publish;
    $count_invoices         = wp_count_posts('wp_invoices');
    $count_the_invoices     = $count_invoices->publish;
    $count_clients          = wp_count_posts('wp_clients');
    $count_the_clients      = $count_clients->publish;
    $count_income           = wp_count_posts('wp_income');
    $count_the_income       = $count_income->publish;
    $count_expenses         = wp_count_posts('wp_expenses');
    $count_the_expenses     = $count_expenses->publish;
    $count_revisions        = wp_count_posts('revision');
    $count_the_revisions    = $count_revisions->inherit;


    global $required_php_version;
    global $required_mysql_version;

    $wp_requirements_URL    = 'https://wordpress.org/about/requirements/';
    $php_url                = 'https://secure.php.net/supported-versions.php';
    $plugin_url             = 'https://wordpress.org/plugins/wp-system/';
    $ssl_url                = 'https://www.cloudflare.com/learning/ssl/why-use-https/';
    $rapps_url              = 'https://rocketapps.com.au/?source=wpsystem';
    $site_url               = get_option( 'siteurl');
    $good                   = '';


    $email_high_warning     = '<span style="color:#ff0000; font-weight:bold; font-size: 20px; line-height: 20px;">&times; </span>';
    $email_medium_warning   = '<span style="color:#ff9800; font-weight:bold; font-size: 20px; line-height: 20px;">&times; </span>';

    $help_db_prefix             = sprintf('The database prefix is specified in the wp-config.php file ($table_prefix) of the website root.', 'wp-system' );
    $help_wp_memory_limit       = sprintf('This value dictates the maximum memory WordPress is allowed to use. Higher values yield better performance, but the value can not be higher than the server PHP memory limit.', 'wp-system' );
    $help_dnt                   = sprintf('Do Not Track (DNT) is a browser setting that makes a request for the web application to disable user tracking.', 'wp-system');
    $help_display_errors        = sprintf('When enabled, any PHP errors that occur will be printed to the screen. Useful for development and debugging.', 'wp-system' );
    $help_allow_url_fopen       = sprintf('When enabled, PHP files can be included from external sources but at the risk of code injection vulnerabilities.', 'wp-system' );
    $help_soap                  = sprintf('SOAP (Simple Object Access Protocol) is an application communication protocol that allows web applications to communicate regardless of OS, programming language or technology.', 'wp-system' );
    $help_gd                    = sprintf('GD is a server side graphic library for dynamically manipulating images.', 'wp-system' );
    $help_imagemagick           = sprintf('ImageMagick is a server side graphic library for the dynamic manipulation of over 200 different image formats.', 'wp-system' );
    $help_cache_control         = sprintf('A header used to specify browser caching policies for both client requests and server responses.', 'wp-system' );
    $help_http_connection       = sprintf('A header that can be used to keep a connection open after each request has been completed.', 'wp-system' );
    $help_php_version           = sprintf(__('WordPress will operate with at least PHP %1$s, although PHP 7.3 or greater is recommended.', 'wp-system' ), $required_php_version);
    $help_mysql_version         = sprintf(__('WordPress will operate with at least MySQL %1$s, although MySQL 5.6 or greater is recommended.', 'wp-system' ), $required_mysql_version);
    $help_php_memory            = sprintf('How much PHP memory is in use compared to how much has been allocated.', 'wp-system' );
    $help_upload_max_filesize   = sprintf('The maximum size of an uploaded file. This value should be lower than the post max size.', 'wp-system' );
    $help_post_max_size         = sprintf('The maximum size of post data allowed. This value should be higher than the upload max filesize.', 'wp-system' );
    $help_http_upgrade_requests = sprintf('The upgrade-insecure-requests header lets the server know your preference for an encrypted and authenticated response, and that it can successfully handle the directive.', 'wp-system' );
    $help_http_user_agent       = sprintf('A user agent is the application you use to access a web page, such as a web browser, mobile device or other.', 'wp-system' );
    $help_remote_post           = sprintf('This is the port number used by the current browser.', 'wp-system' );
    $help_ip_address            = sprintf('Your current IP address.', 'wp-system' );
    $help_http_accept           = sprintf('All the content types that your current browser can accept.', 'wp-system' );
    $help_accept_language       = sprintf('The natural languages that are preferred, with the default value usually being the same as the owner of the device.', 'wp-system' );
    $help_server_ip             = sprintf('The IP addresss of the server your website is hosted on.', 'wp-system' );
    $help_server_protocol       = sprintf('Fetches the name and revision of the information protocol via which the page has been requested.', 'wp-system' );
    $help_server_software       = sprintf('The software that your webiste hosting account is running on.', 'wp-system' );
    $help_gateway_interface     = sprintf('The version of the Common Gateway Interface (CGI) being used by the server.', 'wp-system' );
    $help_curl_info             = sprintf('A server side library used for transferring data using various protocols.', 'wp-system' );
    $help_ssl                   = sprintf(__('Secure Sockets Layer (<a href="%1$s" target="_blank" rel="noopener">SSL</a>) is an encryption protocol that provides secure communication over a network, therby preventing attackers from intercepting your website data.', 'wp-system' ), $ssl_url);

    /* Image formats count */
    function img_count(){
        $query_img_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>array(
                    'jpg|jpeg|jpe'  => 'image/jpeg',
                    'gif'           => 'image/gif',
                    'png'           => 'image/png',
                    'bmp'           => 'image/bmp',
                    'tif|tiff'      => 'image/tiff',
                    'ico'           => 'image/x-icon'
                    ),
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            );
        $query_img = new WP_Query( $query_img_args );
        return $query_img->post_count;
    }

    /* Text formats count */
    function text_count(){
        $query_text_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>array(
                'txt|asc|c|cc|h'    => 'text/plain',
                'csv'               => 'text/csv',
                'tsv'               => 'text/tab-separated-values',
                'ics'               => 'text/calendar',
                'rtx'               => 'text/richtext',
                'css'               => 'text/css',
                'htm|html'          => 'text/html',
                    ),
            'post_status'       => 'inherit',
            'posts_per_page'    => -1,
            );
        $query_text = new WP_Query( $query_text_args );
        return $query_text->post_count;
    }

    /* Audio formats count */
    function audio_count(){
        $query_audio_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>array(
                'mp3|m4a|m4b'   => 'audio/mpeg',
                'ra|ram'        => 'audio/x-realaudio',
                'wav'           => 'audio/wav',
                'ogg|oga'       => 'audio/ogg',
                'mid|midi'      => 'audio/midi',
                'wma'           => 'audio/x-ms-wma',
                'wax'           => 'audio/x-ms-wax',
                'mka'           => 'audio/x-matroska'
            ),
            'post_status'       => 'inherit',
            'posts_per_page'    => -1,
            );
        $query_audio = new WP_Query( $query_audio_args );
        return $query_audio->post_count;
    }

    /* MS Office formats count */
    function office_count(){
        $query_office_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>array(
                // MS Office formats
                'doc'                          => 'application/msword',
                'pot|pps|ppt'                  => 'application/vnd.ms-powerpoint',
                'wri'                          => 'application/vnd.ms-write',
                'xla|xls|xlt|xlw'              => 'application/vnd.ms-excel',
                'mdb'                          => 'application/vnd.ms-access',
                'mpp'                          => 'application/vnd.ms-project',
                'docx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'docm'                         => 'application/vnd.ms-word.document.macroEnabled.12',
                'dotx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
                'dotm'                         => 'application/vnd.ms-word.template.macroEnabled.12',
                'xlsx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'xlsm'                         => 'application/vnd.ms-excel.sheet.macroEnabled.12',
                'xlsb'                         => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
                'xltx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
                'xltm'                         => 'application/vnd.ms-excel.template.macroEnabled.12',
                'xlam'                         => 'application/vnd.ms-excel.addin.macroEnabled.12',
                'pptx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'pptm'                         => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
                'ppsx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
                'ppsm'                         => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
                'potx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.template',
                'potm'                         => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
                'ppam'                         => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
                'sldx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
                'sldm'                         => 'application/vnd.ms-powerpoint.slide.macroEnabled.12',
                'onetoc|onetoc2|onetmp|onepkg' => 'application/onenote',
                // OpenOffice formats
                'odt'                          => 'application/vnd.oasis.opendocument.text',
                'odp'                          => 'application/vnd.oasis.opendocument.presentation',
                'ods'                          => 'application/vnd.oasis.opendocument.spreadsheet',
                'odg'                          => 'application/vnd.oasis.opendocument.graphics',
                'odc'                          => 'application/vnd.oasis.opendocument.chart',
                'odb'                          => 'application/vnd.oasis.opendocument.database',
                'odf'                          => 'application/vnd.oasis.opendocument.formula',
                // WordPerfect formats
                'wp|wpd'                       => 'application/wordperfect',
                // iWork formats
                'key'                          => 'application/vnd.apple.keynote',
                'numbers'                      => 'application/vnd.apple.numbers',
                'pages'                        => 'application/vnd.apple.pages'
            ),
            'post_status'       => 'inherit',
            'posts_per_page'    => -1,
            );
        $query_office = new WP_Query( $query_office_args );
        return $query_office->post_count;
    }

    /* Audio formats count */
    function misc_count(){
        $query_misc_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>array(
                // Misc application formats
                'rtf'       => 'application/rtf',
                'js'        => 'application/javascript',
                'pdf'       => 'application/pdf',
                'swf'       => 'application/x-shockwave-flash',
                'class'     => 'application/java',
                'tar'       => 'application/x-tar',
                'zip'       => 'application/zip',
                'gz|gzip'   => 'application/x-gzip',
                'rar'       => 'application/rar',
                '7z'        => 'application/x-7z-compressed',
                'exe'       => 'application/x-msdownload',
            ),
            'post_status'       => 'inherit',
            'posts_per_page'    => -1,
            );
        $query_misc = new WP_Query( $query_misc_args );
        return $query_misc->post_count;
    }

    $total_file_count = img_count() + text_count() + audio_count() + office_count() + misc_count();

    /* All image sizes */
    function get_all_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();
    
        $image_sizes_count = '';
        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

            if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
                $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
                $sizes[ $_size ] = array( 
                    'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                );
            }
            $image_sizes_count++;
        }
        //print_r($sizes);
        $all_sizes = '';
        foreach($sizes as $key => $value) {
            if($key == ('thumbnail') || $key == ('medium') || $key == ('medium_large') || $key == ('large') || $key == ('full') || $key == ('post-thumbnail')) {
                $builtin = ' - ' . __( 'built-in', 'wp-system' );
            } else {
                $builtin = '';
            }
            $all_sizes .= $key . ' ('  . $value['width'] . ' x ' . $value['width'] . $builtin . ')<br />';
        }

        $images_size_details = array(
            'all_sizes_list'   => $all_sizes,
            'all_sizes_count'  => $image_sizes_count - 1 // TODO: Possible bug. Always seems to return one number higher, so added a -1 here.
        );

        return $images_size_details;

        /* 
            Usage: 
                $all_images_size_details['all_sizes_list'];
                $all_images_size_details['all_sizes_count'];
        */
    }
    $all_images_size_details = get_all_image_sizes();

    /* Active plugins list */
    function active_plugins() {
        $the_plugs = get_option('active_plugins');
        foreach($the_plugs as $key => $value) {
            $string = explode('/',$value);
            echo '<a href="https://wordpress.org/plugins/' . $string[0] . '" target="_blank" rel="noopener">' . $string[0] . "\r\n" . '</a>';
        }
    }

    /* Active plugins count */
    function active_plugins_count() {
        $the_plugs = get_option('active_plugins');
        foreach($the_plugs as $key => $value) {
            $plugin_count = count($the_plugs);
        }
        return $plugin_count;
    }

    /* Active plugins list */
    function active_plugins_list() {
        $the_plugs = get_option('active_plugins'); 
        $plugins = '';
        foreach($the_plugs as $key => $value) { 
            $string = explode('/',$value); 
            $plugins .= '<a href="https://wordpress.org/plugins/' . $string[0] . '" target="_blank" rel="noopener">' . $string[0] . '<br />';
        }
        return $plugins;
    }

    /* Database size */
    function fileSizeInfo($filesize) {
        $bytes = array('KB', 'KB', 'MB', 'GB', 'TB');
    
        if ($filesize < 1024) 
            $filesize = 1;
    
        for ($i = 0; $filesize > 1024; $i++) 
            $filesize /= 1024;
    
        $dbSizeInfo['size'] = round($filesize, 3);
        $dbSizeInfo['type'] = $bytes[$i];
    
        return $dbSizeInfo;
    }
    
    function databaseSize() {
        global $wpdb;
        $dbsize = 0;
    
        $rows = $wpdb->get_results("SHOW table STATUS");
    
        foreach($rows as $row) 
            $dbsize += $row->Data_length + $row->Index_length;
    
        return fileSizeInfo($dbsize); 
    }
    
    $dbSize = databaseSize();
    
    /* Upload max filesize */
    if($upload_max_filesize < 4 ) {
        $upload_max_filesize_medium_warning = 'medium_warning';
        $upload_max_filesize_notice         = '&#10140; ' . sprintf( __(  'If this value is too small, you may have trouble uploading files and submitting forms.', 'wp-system' ));
        $upload_max_filesize_mail           = $email_medium_warning;
        $upload_max_filesize_num            = 1;
    } else {
        $upload_max_filesize_medium_warning = '';
        $upload_max_filesize_notice         = '';
        $upload_max_filesize_mail           = '';
    }

    if($post_max_size <= $upload_max_filesize) {
        $guide_url                    = 'https://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/';
        $post_max_size_medium_warning = 'medium_warning';
        $post_max_size_notice         = '&#10140; ' . sprintf(__('Either increase post_max_size to above %1$sM or reduce upload_max_filesize to below %2$sM with the help of <a href="%3$s" target="_blank" rel="noopener">this guide</a>.', 'wp-system' ), $upload_max_filesize, $post_max_size, $guide_url);
        $post_max_size_mail           = $email_medium_warning;
        $post_max_size_num            = 1;
    } else {
        $post_max_size_medium_warning = '';
        $post_max_size_notice         = '';
        $post_max_size_mail           = '';
    }

    /* Multi-site status */
    if ( is_multisite() ) {
        $multi_site         = __( 'Yes', 'wp-system' );
    } else {
        $multi_site         = __( 'No', 'wp-system' );
    }

    /* SSL check */
    if ( is_ssl() ) {
        $is_ssl                 = __( 'Enabled', 'wp-system' ) . '&nbsp;' .  $good;
        $is_ssl_mail            = '';
    } else {
        $is_ssl                 = __( 'No', 'wp-system' );
        $is_ssl_medium_warning  = 'medium_warning';
        $is_ssl_notice          = '&#10140; ' . sprintf( __(  'Enabling SSL is always recommended.', 'wp-system' ));
        $is_ssl_mail            = $email_medium_warning;
        $is_ssl_num             = 1;
    }

    /* MySQL version */
    if($mysql_version < '5.6') {
        $mysql_version_notice       = '&#10140; ' . sprintf(__(  'You are running an outdated version of MySQL. WordPress <a href="%1$s" target="_blank" rel="noopener">recommends</a> at least MySQL 5.6 or MariaDB 10.', 'wp-system' ), $wp_requirements_URL);
        $mysql_high_warning         = 'high_warning';
        $mysql_high_warning_mail    = $email_high_warning;
        $mysql_version_num          = 1;
    } else {
        $mysql_version_notice       = $good;
        $mysql_high_warning         = '';
        $mysql_high_warning_mail    = '';
    }

    /* PHP version */
    preg_match("#^\d+(\.\d+)*#", PHP_VERSION, $match);
    $php_version = $match[0];
    if($php_version < '7.1') {
        $php_version_notice     = '&#10140; ' . sprintf(__(  'Your version of PHP has or will soon reach <a href="%1$s" target="_blank" rel="noopener">end of life</a> status. WordPress <a href="%2$s" target="_blank" rel="noopener">recommends</a> PHP 7.3 or greater.', 'wp-system' ), $php_url, $wp_requirements_URL);
        $php_high_warning = 'high_warning';
        $php_high_warning_mail  = $email_high_warning;
        $php_version_num        = 1;
    } else {
        $php_version_notice     = $good;
        $php_high_warning       = '';
        $php_high_warning_mail  = '';
    }

    /* WP memory limit */
    if($wp_memory == '40M') {
        $wp_memory_notice       = '&#10140; ' . sprintf( __( 'Performnace may become an issue. Increase the WordPress memory limit if possible.', 'wp-system' ));
        $wp_memory_warning      = 'medium_warning';
        $wp_memory_warning_mail = $email_medium_warning;
        $wp_memory_num          = 1;
    } else {
        $wp_memory_warning_mail = '';
    }

    /* Get latest theme version number from remote JSON file */
    $wp_URL         = 'https://api.wordpress.org/core/version-check/1.7/';
    $wp_response    = wp_remote_get($wp_URL);
    $wp_json        = $wp_response['body'];
    $wp_obj         = json_decode($wp_json);
    $wp_upgrade     = $wp_obj->offers[0];
    $the_wp_version = $wp_upgrade->version;

    if($current_wp_version < $the_wp_version) {
        $the_wp_version         = $the_wp_version;
        $the_wp_version_URL     = get_admin_url() . 'update-core.php';
        $the_wp_version_notice  = '&#10140; ' . sprintf( __(  '<a href="%1$s">Update</a> to the latest WordPress.', 'wp-system' ), $the_wp_version_URL );
        $the_wp_version_warning = 'high_warning';
        $the_wp_version_mail    = $email_high_warning;
        $current_wp_version_num = 1;
    } else {
        $the_wp_version         = $the_wp_version;
        $the_wp_version_URL     = '';
        $the_wp_version_notice  = $good;
        $the_wp_version_mail    = '';
    }

    /* Database Prefix */
    $db_prefix = $wpdb->base_prefix;
    if($db_prefix == 'wp_') {
        $db_prefix_warning  = 'high_warning';
        $db_prefix_notice   = '&#10140; ' . __('The default insecure database prefix is in use. Change the prefix with the aid of a suitable plugin.', 'wp-system' );
        $db_prefix_mail     = $email_high_warning;
        $db_prefix_num      = 1;
    } else {
        $db_prefix_notice  = '';
        $db_prefix_warning    = '';
        $db_prefix_mail     = '';
    }

    /* List all roles */
    function list_roles() {
        global $wp_roles;
        $the_roles = $wp_roles->get_names();
        $roles = '';
        $role_count = '';
        foreach($the_roles as $role) {
            $roles .= $role . '<br />';
            $role_count++;
        }

        $role_details = array(
            'role_list'   => $roles,
            'role_count'  => $role_count
        );

        return $role_details;
        /* 
            Usage: 
                $all_role_details['role_list'];
                $all_role_details['role_count'];
        */
    }
    $all_role_details = list_roles();


    /* List all registered post types */
    function post_types() {
        $the_post_types = '';
        $post_types_count = '';
        foreach ( get_post_types( '', 'names' ) as $post_type ) {
            if($post_type == ('post') || $post_type == ('page') || $post_type == ('attachment') || $post_type == ('revision') || $post_type == ('nav_menu_item') || $post_type == ('custom_css') || $post_type == ('customize_changeset') || $post_type == ('user_request')) {
                $builtin = ' (' . __( 'built-in', 'wp-system' ) . ')';
            } else {
                $builtin = '';
            }
            $the_post_types .= $post_type . $builtin . '<br />';
            $post_types_count++;
        }

        $post_type_details = array(
            'types'   => $the_post_types,
            'count'   => $post_types_count
        );

        return $post_type_details;

        /* 
            Usage: 
                $all_post_type_details['types'];
                $all_post_type_details['count'];
        */
    }
    $all_post_type_details = post_types();


    /* Curl version */
    function curl_info() {
        if  (in_array  ('curl', get_loaded_extensions())) {
            $values = curl_version();
            return $values['version'];
        } else {
            return __( 'Not enabled', 'wp-system' );
        }
    }

    /* Soap */
    function soap() {
        if (extension_loaded('soap')) {
            return __( 'Enabled', 'wp-system' );
        } else {
            return __( 'Disabled', 'wp-system' );
        }
    }

    /* GD */
    function gd() {
        if  (in_array  ('gd', get_loaded_extensions())) {
            $gd = __( 'Enabled', 'wp-system' );
        } else {
            $gd = __( 'Disabled', 'wp-system' );
        }
        return $gd;
    }

    /* ImageMagick */
    function imagemagick() {
        if (extension_loaded('imagemagick')) {
            return __( 'Enabled', 'wp-system' );
        } else {
            return __( 'Disabled', 'wp-system' );
        }
    }

    /* Display Errors */
    if ( ini_set( 'display_errors', '1' ) === false ) {
        $display_errors = __( 'Enabled', 'wp-system' ); 
    } else { 
        $display_errors = __( 'Disabled', 'wp-system' );
    }

    /* Alow URL Fopen */
    $allow_url_fopen = ini_get('allow_url_fopen');
    if($allow_url_fopen == 1 ) {
        $allow_url_fopen_warning  = 'medium_warning';
        $allow_url_fopen_notice   = '&#10140; ' . sprintf('Unless absolutely required, change the allow_url_fopen directive to 0 for better security.', 'wp-system' );
        $allow_url_fopen_status   = 'Enabled';
        $allow_url_fopen_mail     = $email_medium_warning;
        $allow_url_fopen_num      = 1;
    } else {
        $allow_url_fopen_warning  = '';
        $allow_url_fopen_notice   = '';
        $allow_url_fopen_status   = 'Disabled';
        $allow_url_fopen_mail     = '';
    }

    /* Do not track */
    $dnt = $_SERVER['HTTP_DNT'];
    if($dnt == 1) {
        $dnt = __( 'Enabled', 'wp-system' );
    } else {
        $dnt = __( 'Disabled', 'wp-system' );
    }

    /* Search engine visibility */
    if( 0 == get_option( 'blog_public' ) ){
        $se_visibility =  'Discouraged';
    } else {
        $se_visibility =  'Encouraged';
    }

    $issue_count = $upload_max_filesize_num + $post_max_size_num + $is_ssl_num + $mysql_version_num + $php_version_num + $wp_memory_num + $current_wp_version_num + $db_prefix_num + $allow_url_fopen_num;

    if($issue_count > 0) {
        echo '<div class="wps-status wps-status-bad">';
        _e('Issues found', 'wp-system');
        echo ': ' . $issue_count;
    } else {
        echo '<div class="wps-status wps-status-good">';
        echo '&#10004; ';
        _e('All Good', 'wp-system');
    }
    echo '</div>';
?>
<div class="wps-tools">
    <ul>
        <li class="all active"><?php _e( 'All', 'wp-system' ); ?></li>
        <li class="issues"><?php _e( 'Issues', 'wp-system' ); ?></li>
        <li class="wp-env"><?php _e( 'WordPress Environment', 'wp-system' ); ?></li>
        <li class="s-env"><?php _e( 'Server Environment', 'wp-system' ); ?></li>
        <li class="feeds"><?php _e( 'Feed URLs', 'wp-system' ); ?></li>
        <li class="counts"><?php _e( 'Counts', 'wp-system' ); ?></li>
        <li class="media"><?php _e( 'Media', 'wp-system' ); ?></li>
        <li class="you"><?php _e( 'You', 'wp-system' ); ?></li>
    </ul>
</div>

<table class="ir-info widefat" id="wp-env" cellspacing="0">
    <thead>
        <tr>
            <th colspan="3">
                <h2><?php _e( 'WordPress Environment', 'wp-system' ); ?></h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="33%"><?php _e( 'Domain name', 'wp-system' ); ?>:</td>
            <td width="3%"></td>
            <td><?php echo $_SERVER['HTTP_HOST']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Current theme name', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $wp_theme_name; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Current theme version', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $wp_theme_version; ?></td>
        </tr>
        <tr class="<?php echo $the_wp_version_warning; ?>">
            <td><?php _e( 'WordPress version', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $current_wp_version; ?> <?php echo $the_wp_version_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Stylesheet URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'stylesheet_url' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Stylesheet directory', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'stylesheet_directory' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Pingback URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'pingback_url' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'WordPress address (URL)', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'wpurl' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Site address (URL)', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'url' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Site title', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'name' ); ?> <a href="<?php echo get_admin_url(); ?>options-general.php" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Tagline', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'description' ); ?> <a href="<?php echo get_admin_url(); ?>options-general.php" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Language', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'language' ); ?> <a href="<?php echo get_admin_url(); ?>options-general.php#WPLANG" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Timezone', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_option('timezone_string'); ?> <a href="<?php echo get_admin_url(); ?>options-general.php#timezone_string" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Week start day', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $start_of_week; ?> <a href="<?php echo get_admin_url(); ?>options-general.php#start_of_week" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Date format', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $date_format; ?> (<?php echo date ($date_format); ?>) <a href="<?php echo get_admin_url(); ?>options-general.php" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Time format', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $time_format; ?> (<?php echo date ($time_format); ?>) <a href="<?php echo get_admin_url(); ?>options-general.php" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Posts per page', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $posts_per_page; ?> <a href="<?php echo get_admin_url(); ?>options-reading.php#posts_per_page" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Anyone can register', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $users_can_register; ?> <a href="<?php echo get_admin_url(); ?>options-general.php#users_can_register" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Mail server port', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $mailserver_port; ?> <a href="<?php echo get_admin_url(); ?>options-writing.php#mailserver_port" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Permalink structure', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $permalink_structure; ?> <a href="<?php echo get_admin_url(); ?>options-permalink.php" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Stylesheet', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $stylesheet; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'HTML type', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'html_type' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Admin email', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $admin_email; ?> <a href="<?php echo get_admin_url(); ?>options-general.php#new_admin_email" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Multisite', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $multi_site; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Active plugins', 'wp-system' ); ?> (<?php echo active_plugins_count(); ?>):</td>
            <td></td>
            <td><pre><?php active_plugins(); ?><br /><a class="wps-edit" href="<?php echo get_admin_url(); ?>plugins.php"><?php _e( 'Manage Plugins', 'wp-system' ); ?></a></pre></td>
        </tr>
        <tr class="<?php echo $db_prefix_warning; ?>">
            <td><?php _e( 'Database table prefix', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_db_prefix; ?></span></em></td>
            <td><?php echo $db_prefix; ?> <?php echo $db_prefix_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Database size', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $dbSize['size'] .  $dbSize['type']; ?></td>
        </tr>
        <tr class="<?php echo $wp_memory_warning; ?>">
            <td><?php _e( 'WordPress memory limit', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_wp_memory_limit; ?></span></em></td>
            <td><?php echo $wp_memory; ?> <?php echo $wp_memory_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Registered roles', 'wp-system' ); ?> (<?php echo $all_role_details['role_count']; ?>):</td>
            <td></td>
            <td><?php echo $all_role_details['role_list'];?></td>
        </tr>
        <tr>
            <td><?php _e( 'Registered post types', 'wp-system' ); ?> (<?php echo $all_post_type_details['count']; ?>):</td>
            <td></td>
            <td><?php echo $all_post_type_details['types']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Search engine visibility', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $se_visibility; ?> <a href="<?php echo get_admin_url(); ?>options-reading.php#blog_public" class="wps-edit"><?php _e( 'Edit', 'wp-system' ); ?></a></td>
        </tr>
    </tbody>
</table>

<table class="ir-info widefat" id="s-env" cellspacing="0">
    <thead>
        <tr>
            <th colspan="3">
                <h2><?php _e( 'Server Environment', 'wp-system' ); ?></h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="33%"><?php _e( 'Server IP address', 'wp-system' ); ?>:</td>
            <td width="3%"><em class="help"><span><?php echo $help_server_ip; ?></span></em></td>
            <td><?php echo $_SERVER['SERVER_ADDR']; ?></td>
        </tr>
        <tr class="<?php echo $php_high_warning; ?>">
            <td><?php _e( 'PHP version', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_php_version; ?></span></em></td>
            <td><?php echo $php_version; ?> <?php echo $php_version_notice; ?></td>
        </tr>
        <tr class="<?php echo $mysql_high_warning; ?>">
            <td><?php _e( 'MySQL version', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_mysql_version; ?></span></em></td>
            <td><?php echo $mysql_version; ?> <?php echo $mysql_version_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Server software', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_server_software; ?></span></em></td>
            <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Server admin', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $_SERVER['SERVER_ADMIN']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'PHP memory', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_php_memory; ?></span></em></td>
            <td><?php echo round($php_memory, 1); ?>M in use, <?php echo $ram_available; ?> allocated</td>
        </tr>
        <tr class="<?php echo $upload_max_filesize_medium_warning; ?>">
            <td><?php _e( 'Upload max filesize', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_upload_max_filesize; ?></span></em></td>
            <td><?php echo $upload_max_filesize; ?>M <?php echo $upload_max_filesize_notice; ?></td>
        </tr>
        <tr class="<?php echo $post_max_size_medium_warning; ?>">
            <td><?php _e( 'Post max size', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_post_max_size; ?></span></em></td>
            <td><?php echo $post_max_size; ?>M <?php echo $post_max_size_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Common Gateway Interface', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_gateway_interface; ?></span></em></td>
            <td><?php echo $_SERVER['GATEWAY_INTERFACE'] ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Document root', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $_SERVER['DOCUMENT_ROOT'] ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Character set', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo get_bloginfo( 'charset' ); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Server port', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $_SERVER['SERVER_PORT']; ?></td>
        </tr>
        <tr class="<?php echo $is_ssl_medium_warning; ?>">
            <td><?php _e( 'SSL', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_ssl; ?></span></em></td>
            <td><?php echo $is_ssl; ?> <?php echo $is_ssl_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Display errors', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_display_errors; ?></span></em></td>
            <td>
                <?php echo $display_errors; ?>
            </td>
        </tr>
        <tr class="<?php echo $allow_url_fopen_warning; ?>">
            <td><?php _e( 'PHP from external sources', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_allow_url_fopen; ?></span></em></td>
            <td><?php echo $allow_url_fopen_status; ?> <?php echo $allow_url_fopen_notice; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'cURL version', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_curl_info; ?></span></em></td>
            <td><?php echo curl_info(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'SOAP', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_soap; ?></span></em></td>
            <td><?php echo soap(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'GD', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_gd; ?></span></em></td>
            <td><?php echo gd(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'ImageMagick', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_imagemagick; ?></span></em></td>
            <td><?php echo imagemagick(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Keep alive', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_http_connection; ?></span></em></td>
            <td><?php echo $_SERVER['HTTP_CONNECTION']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Cache control', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_cache_control; ?></span></em></td>
            <td><?php echo $_SERVER['HTTP_CACHE_CONTROL']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Server protocol', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_server_protocol; ?></span></em></td>
            <td><?php echo $_SERVER['SERVER_PROTOCOL']; ?></td>
        </tr>
    </tbody>
</table>

<?php // echo phpinfo(INFO_MODULES); ?>

<table class="ir-info widefat" id="feeds" cellspacing="0">
    <thead>
        <tr>
            <th colspan="3">
                <h2><?php _e( 'Feed URLs', 'wp-system' ); ?></h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="33%"><?php _e( 'Atom URL', 'wp-system' ); ?>:</td>
            <td width="3%"></td>
            <td><a href="<?php echo get_bloginfo( 'atom_url' ); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo( 'atom_url' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'RDF/RSS 1.0 feed URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><a href="<?php echo get_bloginfo( 'rdf_url' ); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo( 'rdf_url' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'RSS 0.92 feed URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><a href="<?php echo get_bloginfo( 'rss_url' ); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo( 'rss_url' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'RSS 2.0 feed URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><a href="<?php echo get_bloginfo( 'rss2_url' ); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo( 'rss2_url' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Comments Atom feed URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><a href="<?php echo get_bloginfo( 'comments_atom_url' ); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo( 'comments_atom_url' ); ?></a></td>
        </tr>
        <tr>
            <td><?php _e( 'Comments RSS 2.0 feed URL', 'wp-system' ); ?>:</td>
            <td></td>
            <td><a href="<?php echo get_bloginfo( 'comments_rss2_url' ); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo( 'comments_rss2_url' ); ?></a></td>
        </tr>
    </tbody>
</table>

<table class="ir-info widefat" id="counts" cellspacing="0">
    <thead>
        <tr>
            <th colspan="3">
                <h2><?php _e( 'Counts', 'wp-system' ); ?></h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="33%"><?php _e( 'Pages', 'wp-system' ); ?>:</td>
            <td width="3%"></td>
            <td><?php echo $count_the_pages; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Posts', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $count_the_posts; ?></td>
        </tr>
        <?php 
        if($count_the_pages == 0) {
            $count_the_pages = 1;
        } else {
            $count_the_pages = $count_the_pages;
        }
        $ratio = round($count_the_revisions / $count_the_pages, 0); ?>
        <tr class="<?php if($ratio >= 5 && $ratio < 20) { echo 'medium_warning'; } else if($ratio >= 20) { echo 'high_warning'; } ?>">
            <td><?php _e( 'Revisions', 'wp-system' ); ?>:</td>
            <td></td>
            <td>
                <?php echo $count_the_revisions;
                if($count_the_revisions > 0 && $ratio > 5) { ?>
                    <?php 
                        $arrow = ' &#10140; ';
                        $revision_ratio_message = sprintf( __( 'A little high. On average, for every 1 page there are approximately %1$s revisions.', 'wp-system'), $ratio );
                        echo $arrow;
                        echo $revision_ratio_message;
                        $revision_warning_mail = $email_high_warning;
                    ?>
                    <form method="post" action="" id="delete-revisions-form">
                        <button class="wps-edit"><?php _e( 'Delete Revisions?', 'wp-system' ); ?></button>
                        <input type="hidden" name="delete-revisions" />
                        <input type="hidden" name="revisions-deleted" value="<?php echo $count_the_revisions; ?>" />
                        <img src="<?php echo home_url(); ?>/wp-admin/images/spinner.gif" class="wps-spin" />

                        <script>
                            jQuery('#delete-revisions-form').submit(function() {
                                if (confirm('<?php _e( 'Permanently delete all revsions? This might take a while. Back up your database first in case you change your mind.', 'wp-system' ); ?>')) {
                                    jQuery('.wps-spin, .cancel-report-send').toggle();
                                    return true; 
                                } else {
                                    return false; 
                                }
                            });
                        </script>

                    </form>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><?php _e( 'Users', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $user_count['total_users']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Syndication feed posts', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $posts_per_rss; ?></td>
        </tr>
    </tbody>
</table>

<table class="ir-info widefat" id="media" cellspacing="0">
    <thead>
        <tr>
            <th colspan="3">
                <h2><?php _e( 'Media', 'wp-system' ); ?></h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="33%"><?php _e( 'Text files', 'wp-system' ); ?>:</td>
            <td width="3%"></td>
            <td><?php echo text_count(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Audio files', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo audio_count(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Office files', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo office_count(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Misc files', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo misc_count(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Images', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo img_count(); ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Total media files', 'wp-system' ); ?>:</td>
            <td></td>
            <td><?php echo $total_file_count; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Registered image sizes', 'wp-system' ); ?> (<?php echo $all_images_size_details['all_sizes_count']; ?>):</td>
            <td></td>
            <td><?php echo $all_images_size_details['all_sizes_list']; ?></td>
        </tr>
    </tbody>
</table>

<table class="ir-info widefat" id="you" cellspacing="0">
    <thead>
        <tr>
            <th colspan="3">
                <h2><?php _e( 'You', 'wp-system' ); ?></h2>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="33%"><?php _e( 'Your IP address', 'wp-system' ); ?>:</td>
            <td width="3%"><em class="help"><span><?php echo $help_ip_address; ?></span></em></td>
            <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Remote port', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_remote_post; ?></span></em></td>
            <td><?php echo $_SERVER['REMOTE_PORT']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Do not track', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_dnt; ?></span></em></td>
            <td><?php echo $dnt; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'User agent', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_http_user_agent; ?></span></em></td>
            <td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Accepted content types', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_http_accept; ?></span></em></td>
            <td><?php echo $_SERVER['HTTP_ACCEPT']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Encrypted/authenticated response preference', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_http_upgrade_requests; ?></span></em></td>
            <td><?php echo $_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS']; ?></td>
        </tr>
        <tr>
            <td><?php _e( 'Accept language', 'wp-system' ); ?>:</td>
            <td><em class="help"><span><?php echo $help_accept_language; ?></span></em></td>
            <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></td>
        </tr>
    </tbody>
</table>

<script>
jQuery('.wps-tools li').click(function() {
    var theClass = jQuery(this).attr('class');
    jQuery('table').fadeOut(0);
    /* Start fix for the issues click */
    jQuery('tr').fadeIn(0);
    jQuery('table').css('margin', '20px 0 0 0');
    jQuery('.wps-tools').css('margin', '0');
    /* End fix for the issues click */
    jQuery('#'+theClass).fadeIn(0);
    jQuery('.wps-tools li').removeClass('active').css('pointer-events', 'all');
    jQuery(this).addClass('active').css('pointer-events', 'none');
});
jQuery('.wps-tools .all').click(function() {
    var theClass = jQuery(this).attr('class');
    jQuery('table').fadeIn(0);
});
jQuery('.issues').click(function() {
    jQuery('tr').fadeOut(0);
    jQuery('.high_warning, .medium_warning').closest('table').fadeIn(0);
    jQuery('.high_warning, .medium_warning').fadeIn(0);
    jQuery('table').css('margin', '0');
    jQuery('.wps-tools').css('margin', '0 0 20px 0');
});
</script>
<?php }