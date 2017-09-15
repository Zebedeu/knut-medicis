<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


 class Welcome{

    private $my_plugin_screen_name;
    private static $instance;
    /*......*/

    static function GetInstance()
    {

        if (!isset(self::$instance) && ! ( self::$instance instanceof Welcome ) )
        {
           $kunut =  self::$instance = new self();
           $kunut->InitPlugin();
        }
        return self::$instance;
    }



    public function PluginMenu()
    {
        $this->my_plugin_screen_name = add_menu_page(
            'Kenut Medicis ',
            'Kenut Medicis ',
            'manage_options',
            __FILE__,
            array($this, 'RenderPage_callback'),
            plugins_url('../../assets/images/icon/icon.ico', __FILE__),
            50
        );
        add_submenu_page(__FILE__, 'Custom', 'Custom', 'manage_options', __FILE__.'/custom', array($this, 'KnutMedicis_render_custom_page_callback') ) ;
        add_submenu_page(__FILE__, 'setting', 'setting', 'manage_options', __FILE__.'/setting', array($this, 'KnutMedicis_setting_callback') );
        add_submenu_page(__FILE__, 'About', 'About', 'manage_options', __FILE__.'/about', array($this, 'KnutMedicis_render_about_page_callback') );

    }

    public function RenderPage_callback(){
        require_once EDD_PLUGIN_DIR . 'templates/html-admin-settings-home.php';
   

    }

    function KnutMedicis_render_custom_page_callback(){
        ?>
        <div class='wrap'>
            <h2>Knut Medicis custom</h2>
        </div>
        <?php
    }
      function KnutMedicis_setting_callback(){
        require_once EDD_PLUGIN_DIR . 'templates/html-admin-settings.php';

    }
    function KnutMedicis_render_about_page_callback(){
        ?>
        <div class='wrap'>
            <h2>Knut Medicis About</h2>
             <em>If you like this plugin, please <a href="http://wordpress.org/extend/plugins/Knut-Medicis">vote</a> .
    Author : <a href="https://github.com/zebedeu">Máecio Zebedeu</a>
    You can <a href="https://github.com/knut7/knut-medicis">for bugs,</a>  thanks.</em>

    </div>
        </div>
        <?php
    }

    public function post_type()
    {
        $labels = array(
            'name'                  => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Post Types', 'text_domain' ),
            'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'attributes'            => __( 'Item Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'All Items', 'text_domain' ),
            'add_new_item'          => __( 'Add New Item', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Item', 'text_domain' ),
            'edit_item'             => __( 'Edit Item', 'text_domain' ),
            'update_item'           => __( 'Update Item', 'text_domain' ),
            'view_item'             => __( 'View Item', 'text_domain' ),
            'view_items'            => __( 'View Items', 'text_domain' ),
            'search_items'          => __( 'Search Item', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Post Type', 'text_domain' ),
            'description'           => __( 'Post Type Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',


        'supports' =>  array (
                'title',
                'editor',
                'author',
                'custom-fields',
        'thumbnail'
    )
    );
        register_post_type( 'post_type', $args );

    }
    function wpa3396_page_template( $page_template )
{
    if ( is_page( 'my-custom-page-slug' ) ) {
        $page_template = dirname( __FILE__ ) . '/custom-page-template.php';
    }
    return $page_template;
}

    private function InitPlugin()
    {
        add_action('admin_menu', array($this, 'PluginMenu'));
        add_action('init', array($this, 'post_type'));
        add_filter('post_type', array($this, 'mudar'));
            add_filter( 'page_template', array($this, 'wpa3396_page_template') );



    }

}

