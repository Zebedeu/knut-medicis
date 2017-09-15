<?php

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 04/09/17
 * Time: 21:13
 */
class KM_DB
{

    public function __construct() {

        global $wpdb;

        $this->table_name  = $wpdb->prefix . 'km_customers';
        $this->primary_key = 'id';
        $this->version     = '1.0';


    }
    public function create_table() {

        global $wpdb;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $sql = "CREATE TABLE " . $this->table_name . " (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		user_id bigint(20) NOT NULL,
		email varchar(50) NOT NULL,
		name mediumtext NOT NULL,
		purchase_value mediumtext NOT NULL,
		purchase_count bigint(20) NOT NULL,
		payment_ids longtext NOT NULL,
		notes longtext NOT NULL,
		date_created datetime NOT NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY email (email),
		KEY user (user_id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;";

        dbDelta( $sql );

//        update_option( $this->table_name . '_db_version', $this->version );
    }
    public function _insert()
    {
        global $wpdb;
        $wpdb->insert(
            $this->table_name,
            array (
                'time' => '20:35:20',
                'name' => "marcio zebedeu",
                'text' => "Hello mundo",
                'url' => "http://www.zebedeu.com"
            ),
            array (
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );

    }

    public function select()
    {
        global $wpdb;


        $obj = $wpdb->get_row("SELECT * FROM $this->table_name ");

        foreach ($obj as $item) {
            echo $item;
        }

    }

    public function update()
    {

    }

    public function delete()
    {

    }
public function  on_delete_blog ( $tables ) {
global  $wpdb ;
        $tabelas [] =  $this->table_name;
        return  $tabelas ;
}



public function init() {
        add_action('init', array($this, 'create_table'));
        add_filter ( ' wpmu_drop_tables ' , array($this,' on_delete_blog ' ) );

}


}

