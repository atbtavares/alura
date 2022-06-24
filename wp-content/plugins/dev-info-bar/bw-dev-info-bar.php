<?php

  /**
   *
   * Plugin Name:       Dev Info Bar
   * Plugin URI:        http://istvankrucsanyica.com/devinfobar/
   * Description:       A simple WordPress extension which adds itself to the admin bar, providing system information such as PHP, MySQL version and  details of the WordPress being used.
   * Version:           1.0.2
   * Author:            Istvan Krucsanyica
   * Author URI:        http://istvankrucsanyica.com
   * Text Domain:       bw-dev-info-bar
   * Domain Path:       /languages
   * License:           GPLv2 only
   * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
   *
   * Copyright 2017, Istvan Krucsanyica (email : istvan.krucsanyica@gmail.com)
   *
   * This program is free software; you can redistribute it and/or modify
   * it under the terms of the GNU General Public License version 2,
   * as published by the Free Software Foundation.
   *
   * ou may NOT assume that you can use any other version of the GPL.
   *
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * The license for this software can likely be found here:
   * http://www.gnu.org/licenses/gpl-2.0.html
   */

  // If this file is called directly, abort.
  if ( ! defined( 'WPINC' ) ) {
    die;
  }


  /**
   * The code that runs during plugin activation.
   */
  function activate_bw_dev_info_bar() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-bw-dev-info-bar-activator.php';
    Bw_Dev_Info_Bar_Activator::activate();
  }

  /**
   * The code that runs during plugin deactivation.
   *
   * @since    1.0.0
   */
  function deactivate_bw_dev_info_bar() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-bw-dev-info-bar-deactivator.php';
    Bw_Dev_Info_Bar_Deactivator::deactivate();
  }

  register_activation_hook( __FILE__, 'activate_bw_dev_info_bar' );
  register_deactivation_hook( __FILE__, 'deactivate_bw_dev_info_bar' );


  /**
   * The core plugin class
   */
  require plugin_dir_path( __FILE__ ) . 'includes/class-bw-dev-info-bar.php';

  /**
   * Begins execution of the plugin.
   *
   * @since    1.0.0
   */
  function run_bw_dev_info_bar() {

    new Bw_Dev_Info_Bar();

  }

  run_bw_dev_info_bar();

