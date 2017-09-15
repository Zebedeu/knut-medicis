<?php
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 03/09/17
 * Time: 16:01
 */
class Table
{


    public function createTable()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "kfarmar";
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
        id mediumint (9) NOT NULL  AUTO_INCREMENT,
        time datetime DEFAULT  '000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        url varchar (55) DEFAULT  '' NOT NULL,
        UNIQUE KEY id (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        return dbDelta($sql);
    }

    public function _insert()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "kfarmar";
        $wpdb->insert(
                $table_name,
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
        $table_name = $wpdb->prefix . "kfarmar";

        $obj = $wpdb->get_row("SELECT * FROM $table_name ");

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
}