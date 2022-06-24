<?php
/*
 * Plugin Name: Patrocinadores Alura
 * Description: Selecionar patrocinadores da palestra da Alura
 * Version: 1.0.0
 * Author: Rafael Nercessian
 */

if(!defined('ABSPATH')){
	die;

}
 //error_log("estou dentro do plugin");
require_once plugin_dir_path(__FILE__) . '/includes/al_patrocinadores_palestras_widget.php';
