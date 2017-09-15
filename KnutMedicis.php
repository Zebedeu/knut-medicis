<?php


/**
 * @package knot7
 * @version 1.0.0
 */
/*
Plugin Name: Kenut Medicis
Plugin URI: http://wordpress.org/plugins/KenutMedicis/
Description:
Author: Marcio Zebedeu
Version: 1.0.0
Author URI: http://KenutMedicis.tt/
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


final class KnutMedicis
{
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof KnutMedicis)) {

            self::$instance = new self();
            self::$instance->includes();
        }
        return self::$instance;

    }

    /**
     * Include required files
     *
     * @access private
     * @since 1.0.0
     * @return void
     */
    private function includes()
    {
        if (!defined('EDD_PLUGIN_DIR')) {
            define('EDD_PLUGIN_DIR', plugin_dir_path(__FILE__));
        }

       // Plugin Folder Path
        require_once EDD_PLUGIN_DIR . 'includes/admin/Welcome.php';
        require_once EDD_PLUGIN_DIR . 'includes/admin/class-km-DB.php';
        require_once EDD_PLUGIN_DIR . 'templates/html-admin-settings.php';

        Welcome::GetInstance();

//        class DB
        $this->db                           =  new KM_DB();

        register_activation_hook( __FILE__, $this->db->init() );
    }
}

function add() {

    KnutMedicis::getInstance();
}
add();
