<?php if( !defined('ABSPATH') ) { die('No direct access'); }

if( !class_exists( 'Theme_Base' ) ) : 
    class Theme_Base {
        const VERSION = '1.0.0';
        const DOMAIN = 'jk-architektura';

        public function __construct() {
            $this->define_constants();

            if( defined( 'USE_ACF_PRO') && USE_ACF_PRO ) {
                $this->setup_acf();
            }

            if( $this->has_acf() ) {
                $this->add_acf_theme_options();
            }           
            
            add_filter( 'the_generator', array( &$this, 'rm_generator_filter' ) );  
            add_filter( 'login_errors', array( &$this, 'custom_login_error_message' ), 2, 1 );    
            add_action( 'after_setup_theme', array( &$this, 'setup' ) );
            add_action( 'init', array( &$this, 'register_custom_menu' ) );  
            add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts_styles' ), 20 );
            add_filter( 'script_loader_tag', array( &$this, 'add_script_attribute' ), 10, 2);
            add_filter('wp_resource_hints', array( &$this, 'resource_hints' ), 10, 2 );
            add_action( 'init', array( &$this, 'disable_wp_emojicons' ), 10 );
            add_filter( 'emoji_svg_url', '__return_false' );
            add_action('admin_head', array( &$this, 'acf_custom_styling' ), 10, 1 );
        }

        private function define_constants() {

            if( !defined( 'THEME_URI' ) ) {
                define ( 'THEME_URI', get_template_directory_uri() );
            }
            
            if( !defined( 'THEME_DIR' ) ) {
                define ( 'THEME_DIR', get_template_directory() );
            }

            if( !defined( 'CHILD_THEME_URI' ) ) {
                define ( 'CHILD_THEME_URI' , get_stylesheet_directory_uri() );
            }
            
            if( !defined( 'CHILD_THEME_DIR' ) ) {
                define ( 'CHILD_THEME_DIR', get_stylesheet_directory() );
            }
            
            if( !defined( 'USE_ACF_PRO' ) ) {
                define ( 'USE_ACF_PRO', true );
            }
        }      

        public function setup() {
            load_theme_textdomain( self::DOMAIN , THEME_DIR . "/lang" );  
            add_theme_support( 'custom-logo', array(
                    'flex-width'  => true,
            ) );   
            add_editor_style();
        }      

        private function setup_acf() {
            add_filter('acf/settings/show_admin', array( &$this, 'show_acf_admin' ), 10 );
            add_action('acf/init', array( &$this, 'set_acf_google_map_key' ) );
        }         


        public function show_acf_admin() {
            return true;
        }      

        function set_acf_google_map_key() {
            $google_map_key = get_field('google-map-api', 'options');
            acf_update_setting('google_api_key', $google_map_key);
        }      

        public function add_acf_theme_options() {
            if( function_exists('acf_add_options_page') ) {
                acf_add_options_page(array(
                        'page_title' 	=> __( 'Opcje motywu', self::DOMAIN ),
                        'menu_title'	=> __( 'Opcje motywu', self::DOMAIN ),
                        'menu_slug' 	=> 'theme-general-settings',
                        'capability'	=> 'edit_posts',
                        'redirect'	    => false,
                        'icon_url'      => 'dashicons-art',
                        'position'      => 62.5
                ));
            }
        }           

        public static function has_acf() {
            return class_exists( 'acf' );
        }   

        public function enqueue_scripts_styles() {
            if( !is_admin() ) {

                /* Style/Fonts */
                wp_enqueue_style( 'style', THEME_URI . '/style.css', '', self::VERSION );
                wp_enqueue_style( 'gfonts', 'https://fonts.googleapis.com/css?family=Orbitron:400,500,700,900|Roboto:400,700&amp;subset=latin-ext' );

                /* Scripts */
                wp_enqueue_script( 'jquery' );
                $google_map_key = $this->has_acf() ? get_field('google-map-api', 'options') : false;
                wp_enqueue_script( 'scripts', THEME_URI . '/assets/js/scripts.js', 'jquery', self::VERSION, true);
                wp_localize_script( 'scripts', 'theme_vars', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'google_map_api_key' => $google_map_key ) );  
            }
        }     

        public function add_script_attribute($tag, $handle) {
            $scripts = apply_filters( 'theme_script_attributes', array(
            ) );

            if(array_key_exists($handle, $scripts)) {
                return str_replace( ' src', ' '. $scripts[$handle]. '="'. $scripts[$handle] .'" src', $tag);
            }

            return $tag;
        }      

        public function register_custom_menu() {
            register_nav_menu( 'main-menu', __( 'Main Menu', self::DOMAIN ) );
        }     

        public function add_editor_style() {
            add_editor_style();
        }      

        public function rm_generator_filter() { 
            return ''; 
        }          

        public function custom_login_error_message($error) {
            return __( 'The login or password you entered is incorrect', self::DOMAIN );
        }     

        public function resource_hints( $hints, $relation_type ) {
            if ( 'dns-prefetch' === $relation_type ) {
                $hints[] = 'https://fonts.googleapis.com';
                $hints[] = 'https://maps.googleapis.com';
            }

            return $hints;
        }        

        public function disable_wp_emojicons() {
            remove_action( 'admin_print_styles', 'print_emoji_styles' );
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        }  
        
        public function acf_custom_styling() {
            ?>
            <style type="text/css">
                .acf-flexible-content .layout {
                    border: 2px solid #0073AA;
                    box-shadow: 0px 3px 10px -5px #000;
                }
                
                .acf-flexible-content .layout .acf-fc-layout-handle {
                    background: #0073AA;
                    color: #fff;
                    font-weight: bold;
                }
                
                .acf-table > thead > tr > th {
                    color: #0073AA;
                    font-weight: bold;
                    background: #F9F9F9;
                }
                .acf-button.blue {
                    background-color: #0085BA;
                    border-color: #006799;
                    text-shadow: 0px 1px 0px #006799;
                }
            </style>
            <?php
        }     
    }
endif;

return new Theme_Base();