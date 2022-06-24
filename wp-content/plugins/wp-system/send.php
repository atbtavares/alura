<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Change default from and site name
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from($old) {
    $from = get_option('admin_email');
    return $from;
}
function new_mail_from_name($old) {
    $site_name = get_option( 'blogname');
    return $site_name;
}

$row_style_1    = 'valign="top" style="padding: 7px 0; border-bottom: solid 1px #e9e4e3; font-family: \'Courier New\', Courier, monospace; color: #000000; font-size: 14px;"';
$row_style_2    = 'valign="top" style="padding: 7px 0; border-bottom: solid 1px #e9e4e3; font-family: \'Courier New\', Courier, monospace; color: #000000; font-size: 14px;"';
$p_style        = 'style="padding: 7px 0; font-family: \'Courier New\', Courier, monospace; color: #000000; font-size: 14px;"';
$h1_style       = 'style="font-size: 22px; font-family: Arial, Helvetica, sans-serif;"';

$recipient      = $_POST['recipient'];
$subject        = __('WordPress System Report for', 'wp-system') . ' ' . $site_url;
$body           = '<p ' . $p_style . '>' .  __('WordPress System Report for', 'wp-system') . ' <a href="' . $site_url . '">' . $site_url . '</a> generated ' . current_time($date_format) . '.</p>
<p ' . $p_style . '>' .  __('Issues found', 'wp-system') . ': ' . $issue_count . '</p>
<h1 ' . $h1_style . '>' . __( 'WordPress Environment', 'wp-system' ) . '</h1>' . 
'<table style="width:100%;"><tbody>' . 
'<tr><td width="33%" ' . $row_style_1 . '>' . __( 'Domain name', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_HOST'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Current theme name', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $wp_theme_name . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Current theme version', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $wp_theme_version . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'WordPress version', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $the_wp_version_mail . $current_wp_version . ' ' . $the_wp_version_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Stylesheet URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'stylesheet_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Stylesheet directory', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'stylesheet_directory' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Pingback URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'pingback_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'WordPress address (URL)', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'wpurl' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Site address (URL)', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Site title', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'name' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Tagline', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'description' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Language', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'language' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Multisite', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $multi_site . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Active plugins', 'wp-system' ) . ' (' . active_plugins_count() . '):</td><td ' . $row_style_2 . '>' . active_plugins_list() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Timezone', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_option('timezone_string') . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Week start day', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $start_of_week . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Date format', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $date_format . ' (' . date ($date_format) . ')</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Time format', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $time_format . ' (' . date ($time_format) . ')</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Posts per page', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $posts_per_page . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Users can register', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $users_can_register . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Mail server port', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $mailserver_port . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Permalink structure', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $permalink_structure . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Stylesheet', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $stylesheet . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'HTML type', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'html_type' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Admin email', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $admin_email . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Database table prefix', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $db_prefix_mail . $db_prefix . ' ' . $db_prefix_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Database size', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $dbSize['size'] .  $dbSize['type'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'WordPress memory limit', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $wp_memory_warning_mail . $wp_memory . ' ' . $wp_memory_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Registered roles', 'wp-system' ) . ' (' . $all_role_details['role_count'] . '):</td><td ' . $row_style_2 . '>' . $all_role_details['role_list'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Registered post types', 'wp-system' ) . ' (' . $all_post_type_details['count'] . '):</td><td ' . $row_style_2 . '>' . $all_post_type_details['types'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Search engine visibility', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $se_visibility . '</td></tr>' . 
'</tbody></table>
<h1 ' . $h1_style . '>' . __( 'Server Environment', 'wp-system' ) . '</h1>' . 
'<table style="width:100%;"><tbody>' . 
'<tr><td width="33%" ' . $row_style_1 . '>' . __( 'PHP version', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $php_high_warning_mail . $php_version . ' ' . $php_version_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'MySQL version', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $mysql_high_warning_mail . $mysql_version  . ' ' . $mysql_version_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Server software', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['SERVER_SOFTWARE'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Server admin', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['SERVER_ADMIN'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'PHP memory', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . round($php_memory, 1) . 'M / '. $ram_available . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Upload max filesize', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $upload_max_filesize_mail . $upload_max_filesize . 'M ' . '</td></tr>' .
'<tr><td ' . $row_style_1 . '>' . __( 'Post max size', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $post_max_size_mail . $post_max_size . 'M' . ' ' . $post_max_size_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Gateway interface', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['GATEWAY_INTERFACE'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Document root', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['DOCUMENT_ROOT'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Character set', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'charset' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Server port', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['SERVER_PORT'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'SSL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $is_ssl_mail . $is_ssl . ' ' . $is_ssl_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Display errors', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $display_errors . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'PHP from external sources', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $allow_url_fopen_mail . $allow_url_fopen_status . '  ' . $allow_url_fopen_notice . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'cURL version', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . curl_info() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'SOAP', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . soap() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'GD', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . gd() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'ImageMagick', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . imagemagick() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Keep alive', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_CONNECTION'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Cache control', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_CACHE_CONTROL'] . '</td></tr>' .  
'<tr><td ' . $row_style_1 . '>' . __( 'Server protocol', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['SERVER_PROTOCOL'] . '</td></tr>' . 
'</tbody></table>
<h1 ' . $h1_style . '>' . __( 'Feed URLs', 'wp-system' ) . '</h1>' . 
'<table style="width:100%;"><tbody>' . 
'<tr><td width="33%" ' . $row_style_1 . '>' . __( 'Atom URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'atom_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'RDF/RSS 1.0 feed URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'rdf_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'RSS 0.92 feed URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'rss_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'RSS 2.0 feed URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'rss2_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Comments Atom feed URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'comments_atom_url' ) . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Comments RSS 2.0 feed URL', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . get_bloginfo( 'comments_rss2_url' ) . '</td></tr>' . 
'</tbody></table>' . 
'<h1 ' . $h1_style . '>' . __( 'Counts', 'wp-system' ) . '</h1>' . 
'<table style="width:100%;"><tbody>' . 
'<tr><td width="33%" ' . $row_style_1 . '>' . __( 'Pages', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $count_the_pages . '</td></tr>' .
'<tr><td ' . $row_style_1 . '>' . __( 'Posts', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $count_the_posts . '</td></tr>' .
'<tr><td ' . $row_style_1 . '>' . __( 'Revisions', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $revision_warning_mail . $count_the_revisions . $arrow . $revision_ratio_message . '</td></tr>' .
'<tr><td ' . $row_style_1 . '>' . __( 'Users', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $user_count['total_users'] . '</td></tr>' .
'<tr><td ' . $row_style_1 . '>' . __( 'Syndication feed posts', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $posts_per_rss . '</td></tr>' .
'</tbody></table>' . 
'<h1 ' . $h1_style . '>' . __( 'Media', 'wp-system' ) . '</h1>' . 
'<table style="width:100%;"><tbody>' . 
'<tr><td width="33%" ' . $row_style_1 . '>' . __( 'Text files', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . text_count() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Audio files', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . audio_count() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Office files', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . office_count() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Misc files', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . misc_count() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Images', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . img_count() . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Total media files', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $total_file_count . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Registered image sizes', 'wp-system' ) . ' (' . $all_images_size_details['all_sizes_count'] . '):</td><td ' . $row_style_2 . '>' . $all_images_size_details['all_sizes_list'] . '</td></tr>' .  
'</tbody></table>' . 
'<h1 ' . $h1_style . '>' . __( 'You', 'wp-system' ) . '</h1>' . 
'<table style="width:100%;"><tbody>' . 
'<tr><td width="33%" ' . $row_style_1 . '>' . __( 'Your IP address', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['REMOTE_ADDR'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Remote port', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['REMOTE_PORT'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Do not track', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $dnt. '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'User agent', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_USER_AGENT'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Accepted content types', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_ACCEPT'] . '</td></tr>' .
'<tr><td ' . $row_style_1 . '>' . __( 'Encrypted/authenticated response preference', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS'] . '</td></tr>' . 
'<tr><td ' . $row_style_1 . '>' . __( 'Accept language', 'wp-system' ) . ':</td><td ' . $row_style_2 . '>' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '</td></tr>' . 
'</tbody></table>
<p ' . $p_style . '>' .  sprintf(__('This report was generated and sent by <a href="%1$s">WP System</a> for WordPress. Plugin by <a href="%2$s">Rocket Apps</a>.', 'wp-system'), $plugin_url, $rapps_url) . 
'</p>';
//echo $body; exit;
$headers[]  = 'Content-type:text/html;charset=UTF-8';
$headers[]  = __( 'From', 'wp-system' ) . $site_name . ' <' . $from . '>';
$headers[]  = 'Reply-To: ' . $from;
$headers[]  = 'MIME-Version: 1.0';
wp_mail($recipient, $subject, $body, $headers);