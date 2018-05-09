<?php if( !defined('ABSPATH') ) { die('No direct access'); }

if( !class_exists( 'PostGallery' ) ) :

    class PostGallery {
        const ICON = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjQgMjQ7IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAyNCAyNCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PGcgaWQ9ImluZm8iLz48ZyBpZD0iaWNvbnMiPjxwYXRoIGQ9Ik0yNCw2YzAtMi4yLTEuOC00LTQtNEg0QzEuOCwyLDAsMy44LDAsNnYxMmMwLDIuMiwxLjgsNCw0LDRoMTZjMi4yLDAsNC0xLjgsNC00VjZ6IE02LDZjMS4xLDAsMiwwLjksMiwyICAgYzAsMS4xLTAuOSwyLTIsMlM0LDkuMSw0LDhDNCw2LjksNC45LDYsNiw2eiBNMjIsMThjMCwxLjEtMC45LDItMiwySDQuNGMtMC45LDAtMS4zLTEuMS0wLjctMS43bDMuNi0zLjZjMC40LTAuNCwxLTAuNCwxLjQsMCAgIGwwLjYsMC42YzAuNCwwLjQsMSwwLjQsMS40LDBsNi42LTYuNmMwLjQtMC40LDEtMC40LDEuNCwwbDMsM2MwLjIsMC4yLDAuMywwLjQsMC4zLDAuN1YxOHoiIGlkPSJwaWMiLz48L2c+PC9zdmc+'; 

        public function  __construct() {
            add_action('init', array( &$this, 'register_post_type'), 10, 1 );
            add_action('init', array( &$this, 'register_categories'), 20, 1 );
        }

        public function register_post_type() {
            $labels = array(
                'name'               => _x( 'Realizacje', 'post type general name', 'jk-architektura' ),
                'singular_name'      => _x( 'Realizaja', 'post type singular name', 'jk-architektura' ),
                'menu_name'          => _x( 'Realizacje', 'admin menu', 'jk-architektura' ),
                'name_admin_bar'     => _x( 'Realizacje', 'add new on admin bar', 'jk-architektura' ),
                'add_new'            => _x( 'Dodaj nową realizację', 'offer', 'jk-architektura' ),
                'add_new_item'       => __( 'Dodaj nową realizację', 'jk-architektura' ),
                'new_item'           => __( 'Nowa realizacja', 'jk-architektura' ),
                'edit_item'          => __( 'Edytuj realizację', 'jk-architektura' ),
                'view_item'          => __( 'Pokaż realizacje', 'jk-architektura' ),
                'all_items'          => __( 'Wszystkie realizacje', 'jk-architektura' ),
                'search_items'       => __( 'Szukaj realizacji', 'jk-architektura' ),
                'parent_item_colon'  => __( 'Nadrzędna realizacja:', 'jk-architektura' ),
                'not_found'          => __( 'Nie znaleziono realizacji.', 'jk-architektura' ),
                'not_found_in_trash' => __( 'Nie znaleziono realizacji w koszu.', 'jk-architektura' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => '',
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'realizacje' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title', 'editor', 'thumbnail' ),
                'menu_icon'          => self::ICON,
                'show_in_rest'       => true
            );

            register_post_type( 'realizations', $args );

        }

        public function register_categories() {
            $labels = array(
                'name'              => _x( 'Kategoria', 'taxonomy general name', 'jk-architektura' ),
                'singular_name'     => _x( 'Kategoria', 'taxonomy singular name', 'jk-architektura' ),
                'search_items'      => __( 'Szukaj ketegorii', 'jk-architektura' ),
                'all_items'         => __( 'Wszystkie kategorie', 'jk-architektura' ),
                'parent_item'       => __( 'Nadrzędna kategoria', 'jk-architektura' ),
                'parent_item_colon' => __( 'Nadrzędna kategoria:', 'jk-architektura' ),
                'edit_item'         => __( 'Edytuj kategorię', 'jk-architektura' ),
                'update_item'       => __( 'Aktualizuj kategorię', 'jk-architektura' ),
                'add_new_item'      => __( 'Dodaj nową kategorię', 'jk-architektura' ),
                'new_item_name'     => __( 'Nowa nazwa kategorii', 'jk-architektura' ),
                'menu_name'         => __( 'Kategoria', 'jk-architektura' ),
            );

            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'kategoria' ),
            );

            register_taxonomy( 'realizations_cat', array( 'realizations' ), $args );
        }
    }
endif;

return new PostGallery();