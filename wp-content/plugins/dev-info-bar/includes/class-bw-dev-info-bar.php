<?php

  /**
   * The core plugin class.
   *
   * @since      1.0.0
   * @author     Istvan Krucsanyica <istvan.krucsanyica@gmail.com>
   */
  class Bw_Dev_Info_Bar {

    /**
     * Define the core functionality of the plugin.
     *
     * @since    1.0.0
     */
    public function __construct() {

      $this->set_locale();
      $this->show_stylesheet();
      $this->show_menubar();

    }


    /**
     * Define the locale for this plugin for internationalization.
     *
     * @since    1.0.0
     */
    public function set_locale() {

      add_action( 'plugins_loaded', array( $this, 'plugin_locale' ) );

    }

    public function plugin_locale() {

      load_plugin_textdomain( 'bw-dev-info-bar', FALSE, $this->current_plugin_dir().'languages/' );

    }

    /**
     * Add stylesheet to the admin and front-end area
     *
     * @since    1.0.0
     */
    public function show_stylesheet() {

      add_action( 'wp_enqueue_scripts', array( $this, 'load_bw_dev_info_bar_stylesheet' ) );
      add_action( 'admin_enqueue_scripts', array( $this, 'load_bw_dev_info_bar_stylesheet' ) );

    }

    /**
     * Show admin bar menu
     *
     * @since    1.0.0
     */
    public function show_menubar() {

      add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 1000 );

    }

    /**
     * Add stylesheet
     *
     * @since    1.0.0
     */
    public function load_bw_dev_info_bar_stylesheet() {

      wp_register_style( 'bw_dev_info_bar_stylesheet', plugins_url( '/public/css/bw_dev_info_bar.css', dirname(__FILE__) ) );
      wp_enqueue_style( 'bw_dev_info_bar_stylesheet' );

    }


    /**
     * Add items to the admin bar menu
     *
     * @since    1.0.0
     */
    public function admin_bar_menu() {

      global $wp_admin_bar;


      // Add top menu
      $wp_admin_bar->add_menu( array(
        'id'     => 'bw-di-bar',
        'parent' => 'root-default',
        'title'  => __( 'Dev Info Bar', 'bw-dev-info-bar' ),
        'href'   => false
      ) );


      /**
       * Environment info
       */
      $get_environment_info = $this->get_environment_info();

      $wp_admin_bar->add_menu( array(
        'id'     => 'bw-di-bar-environment',
        'parent' => 'bw-di-bar',
        'title'  => __( 'Server Environment', 'bw-dev-info-bar' ),
        'href'   => false
      ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-server_info',
          'parent' => 'bw-di-bar-environment',
          'title'  => sprintf( __( 'Server info', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['server_info'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-php_version',
          'parent' => 'bw-di-bar-environment',
          'title'  => sprintf( __( 'PHP version', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['php_version'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-mysql_version',
          'parent' => 'bw-di-bar-environment',
          'title'  => sprintf( __( 'MySQL version', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['mysql_version'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-php_post_max_size',
          'parent' => 'bw-di-bar-environment',
          'title'  => $get_environment_info['php_post_max_size'],
          'title'  => sprintf( __( 'PHP Post Max Size', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['php_post_max_size'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-php_max_execution_time',
          'parent' => 'bw-di-bar-environment',
          'title'  => $get_environment_info['php_max_execution_time'],
          'title'  => sprintf( __( 'PHP Time Limit', 'bw-dev-info-bar' ).': <strong>%s</strong>'.__( 'sec', 'bw-dev-info-bar' ), $get_environment_info['php_max_execution_time'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-php_max_input_vars',
          'parent' => 'bw-di-bar-environment',
          'title'  => $get_environment_info['php_max_input_vars'],
          'title'  => sprintf( __( 'PHP Max Input Vars', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['php_max_input_vars'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-max_upload_size',
          'parent' => 'bw-di-bar-environment',
          'title'  => $get_environment_info['max_upload_size'],
          'title'  => sprintf( __( 'Max Upload Size', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['max_upload_size'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-default_timezone',
          'parent' => 'bw-di-bar-environment',
          'title'  => $get_environment_info['default_timezone'],
          'title'  => sprintf( __( 'Default Timezone', 'bw-dev-info-bar' ).': <strong>%s</strong>', $get_environment_info['default_timezone'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-gzip_enabled',
          'parent' => 'bw-di-bar-environment',
          'title'  => sprintf( __('GZip', 'bw-dev-info-bar' ).': <strong>%s</strong>', ( $get_environment_info['gzip_enabled'] == '1' ) ? __( 'enable', 'bw-dev-info-bar' ) : __( 'disable', 'bw-dev-info-bar' ) ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-mbstring_enabled',
          'parent' => 'bw-di-bar-environment',
          'title'  => sprintf( __('Multibyte String', 'bw-dev-info-bar' ).': <strong>%s</strong>', ( $get_environment_info['mbstring_enabled'] == '1' ) ? __( 'enable', 'bw-dev-info-bar' ) : __( 'disable', 'bw-dev-info-bar' ) ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-ssl_enabled',
          'parent' => 'bw-di-bar-environment',
          'title'  => sprintf( __('SSL', 'bw-dev-info-bar' ).': <strong>%s</strong>', ( $get_environment_info['ssl_enabled'] == '1' ) ? __( 'enable', 'bw-dev-info-bar' ) : __( 'disable', 'bw-dev-info-bar' ) ),
          'href'   => false
        ) );


      /**
       * WordPress info
       */
      $wordpress_info = $this->get_wordpress_info();

      $wp_admin_bar->add_menu( array(
        'id'     => 'bw-di-bar-wordpress',
        'parent' => 'bw-di-bar',
        'title'  => __( 'WP Environment', 'bw-dev-info-bar' ),
        'href'   => false
      ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-wp_version',
          'parent' => 'bw-di-bar-wordpress',
          'title'  => sprintf( __('WP Version', 'bw-dev-info-bar' ).': <strong>%s</strong>', $wordpress_info['wp_version'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-wp_multisite',
          'parent' => 'bw-di-bar-wordpress',
          'title'  => sprintf( __('WP Multisite', 'bw-dev-info-bar' ).': <strong>%s</strong>', ( $wordpress_info['wp_multisite'] ) ? __( 'enable', 'bw-dev-info-bar' ) : __( 'disable', 'bw-dev-info-bar' ) ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-wp_memory_limit',
          'parent' => 'bw-di-bar-wordpress',
          'title'  => sprintf( __( 'WP Memory Limit', 'bw-dev-info-bar' ).': <strong>%s</strong>', $wordpress_info['wp_memory_limit'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-wp_debug_mode',
          'parent' => 'bw-di-bar-wordpress',
          'title'  => sprintf( __('WP Debug Mode', 'bw-dev-info-bar' ).': <strong>%s</strong>', ( $wordpress_info['wp_debug_mode'] ) ? __( 'enable', 'bw-dev-info-bar' ) : __( 'disable', 'bw-dev-info-bar' ) ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-wp_cron',
          'parent' => 'bw-di-bar-wordpress',
          'title'  => sprintf( __('WP Cron', 'bw-dev-info-bar' ).': <strong>%s</strong>', ( $wordpress_info['wp_cron'] ) ? __( 'enable', 'bw-dev-info-bar' ) : __( 'disable', 'bw-dev-info-bar' ) ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-language',
          'parent' => 'bw-di-bar-wordpress',
          'title'  => sprintf( __( 'WP language', 'bw-dev-info-bar' ).': <strong>%s</strong>', $wordpress_info['language'] ),
          'href'   => false
        ) );


      /**
       * Active theme info
       */

      $theme_info = $this->get_theme_info();

      // Add Theme info top menu item
      $wp_admin_bar->add_menu( array(
        'id'     => 'bw-di-bar-theme-info',
        'parent' => 'bw-di-bar',
        'title'  => __( 'Active theme info', 'bw-dev-info-bar' ),
        'href'   => false
      ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-ti-name',
          'parent' => 'bw-di-bar-theme-info',
          'title'  => sprintf( __( 'Name', 'bw-dev-info-bar' ).': <strong>%s</strong>', $theme_info['name'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-ti-version',
          'parent' => 'bw-di-bar-theme-info',
          'title'  => sprintf( __( 'Version', 'bw-dev-info-bar' ).': <strong>%s</strong>', $theme_info['version'] ),
          'href'   => false
        ) );

        $wp_admin_bar->add_menu( array(
          'id'     => 'bw-di-bar-ti-author',
          'parent' => 'bw-di-bar-theme-info',
          'title'  => sprintf( __( 'Author', 'bw-dev-info-bar' ).': <strong>%s</strong>', $theme_info['author'] ),
          'href'   => false
        ) );

    }

    /**
     * Get Environment info
     *
     * @since    1.0.0
     */
    public function get_environment_info() {

      global $wpdb;

      return array(
        'server_info'               => $_SERVER['SERVER_SOFTWARE'],
        'php_version'               => phpversion(),
        'php_post_max_size'         => $this->convert( $this->let_to_num( ini_get( 'post_max_size' ) ) ),
        'php_max_execution_time'    => ini_get( 'max_execution_time' ),
        'php_max_input_vars'        => ini_get( 'max_input_vars' ),
        'max_upload_size'           => size_format( wp_max_upload_size() ),
        'default_timezone'          => date_default_timezone_get(),
        'gzip_enabled'              => is_callable( 'gzopen' ),
        'mbstring_enabled'          => extension_loaded( 'mbstring' ),
        'ssl_enabled'               => ( isset( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) == 'on' ) ? 1 : 0,
        'mysql_version'             => ( ! empty( $wpdb->is_mysql ) ? $wpdb->db_version() : '' ),
      );

    }


    /**
     * Get WordPress info
     *
     * @since    1.0.0
     */
    public function get_wordpress_info() {

      return array(
        'wp_version'              => get_bloginfo( 'version' ),
        'wp_multisite'            => is_multisite(),
        'wp_memory_limit'         => $this->convert( $this->let_to_num( WP_MEMORY_LIMIT ) ),
        'wp_debug_mode'           => ( defined( 'WP_DEBUG' ) && WP_DEBUG ),
        'wp_cron'                 => ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ),
        'language'                => get_locale(),
      );

    }


    /**
     * Get actual theme info
     *
     * @since    1.0.0
     */
    public function get_theme_info() {

      $active_theme = wp_get_theme();

      return array(
        'name'                    => $active_theme->Name,
        'version'                 => $active_theme->Version,
        'themeuri'                => $active_theme->ThemeURI,
        'description'             => $active_theme->Description,
        'author'                  => $active_theme->Author,
        'authoruri'               => $active_theme->AuthorURI,
        'template'                => $active_theme->Template,
        'status'                  => $active_theme->Status,
        'tags'                    => $active_theme->Tags,
        'textdomain'              => $active_theme->TextDomain,
        'domainpath'              => $active_theme->DomainPath,
      );

    }


    /**
     * Helper functions
     *
     * @since    1.0.0
     */
    public function convert( $size ) {

      $unit=array('B','KB','MB','GB','TB','PB');
      return @round( $size / pow( 1024, ( $i = floor( log( $size, 1024 ) ) ) ),2 ).' '.$unit[$i];

    }

    public function let_to_num( $size ) {

      $l     = substr( $size, -1 );
      $ret   = substr( $size, 0, -1 );

      switch( strtoupper( $l ) ) {
        case 'P':
          $ret *= 1024;
        case 'T':
          $ret *= 1024;
        case 'G':
          $ret *= 1024;
        case 'M':
          $ret *= 1024;
        case 'K':
          $ret *= 1024;
      }

      return $ret;

    }

    private function current_plugin_dir() {
      $basename = plugin_basename( __DIR__ );
      return str_replace( 'includes', '', $basename );
    }

  }
