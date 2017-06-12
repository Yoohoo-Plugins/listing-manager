<?php

class ListingManagerCPT{

	public static $instance = null;

	private function __construct(){

		add_action( 'init', array( $this, 'register_cpt' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );

	}

	public function register_cpt(){

		$labels = array(
			'name'               => __( 'Listings', ListingManager::$textdomain ),
			'singular_name'      => __( 'Listing', ListingManager::$textdomain ),
			'menu_name'          => __( 'Listings', ListingManager::$textdomain ),
			'name_admin_bar'     => __( 'Listing', ListingManager::$textdomain ),
			'add_new'            => __( 'Add New', ListingManager::$textdomain ),
			'add_new_item'       => __( 'Add New Listing', ListingManager::$textdomain ),
			'new_item'           => __( 'New Listing', ListingManager::$textdomain ),
			'edit_item'          => __( 'Edit Listing', ListingManager::$textdomain ),
			'view_item'          => __( 'View Listing', ListingManager::$textdomain ),
			'all_items'          => __( 'All Listings', ListingManager::$textdomain ),
			'search_items'       => __( 'Search Listings', ListingManager::$textdomain ),
			'parent_item_colon'  => __( 'Parent Listings:', ListingManager::$textdomain ),
			'not_found'          => __( 'No listings found.', ListingManager::$textdomain ),
			'not_found_in_trash' => __( 'No listings found in Trash.', ListingManager::$textdomain )
		);

		$labels = apply_filters( 'listing_manager_cpt_labels_filter', $labels );

		$args = array(
			'labels'             => $labels,
            'description'        => __( 'Description.', ListingManager::$textdomain ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => apply_filters( 'listing_manager_cpt_slug', 'listings' ) ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' )
		);

		$args = apply_filters( 'listing_manager_cpt_args_filter', $args );

		register_post_type( 'listing-manager', $args );

	}

	public function register_taxonomies(){

		$labels = array(
			'name'              => __( 'Categories', ListingManager::$textdomain ),
			'singular_name'     => __( 'Category', ListingManager::$textdomain ),
			'search_items'      => __( 'Search Categories', ListingManager::$textdomain ),
			'all_items'         => __( 'All Categories', ListingManager::$textdomain ),
			'parent_item'       => __( 'Parent Category', ListingManager::$textdomain ),
			'parent_item_colon' => __( 'Parent Category:', ListingManager::$textdomain ),
			'edit_item'         => __( 'Edit Category', ListingManager::$textdomain ),
			'update_item'       => __( 'Update Category', ListingManager::$textdomain ),
			'add_new_item'      => __( 'Add New Category', ListingManager::$textdomain ),
			'new_item_name'     => __( 'New Category Name', ListingManager::$textdomain ),
			'menu_name'         => __( 'Category', ListingManager::$textdomain ),
		);

		$labels = apply_filters( 'listing_manager_categories_labels_filter', $labels );

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'listing-categories' ),
		);

		$args = apply_filters( 'listing_manager_categories_args_filter', $args );

		register_taxonomy( 'listing-manager-categories', array( 'listing-manager' ), $args );

		$labels = array(
			'name'                       => __( 'Tags', ListingManager::$textdomain ),
			'singular_name'              => __( 'Tag', ListingManager::$textdomain ),
			'search_items'               => __( 'Search Tags', ListingManager::$textdomain ),
			'popular_items'              => __( 'Popular Tags', ListingManager::$textdomain ),
			'all_items'                  => __( 'All Tags', ListingManager::$textdomain ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Tag', ListingManager::$textdomain ),
			'update_item'                => __( 'Update Tag', ListingManager::$textdomain ),
			'add_new_item'               => __( 'Add New Tag', ListingManager::$textdomain ),
			'new_item_name'              => __( 'New Tag Name', ListingManager::$textdomain ),
			'separate_items_with_commas' => __( 'Separate tags with commas', ListingManager::$textdomain ),
			'add_or_remove_items'        => __( 'Add or remove tags', ListingManager::$textdomain ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', ListingManager::$textdomain ),
			'not_found'                  => __( 'No tags found.', ListingManager::$textdomain ),
			'menu_name'                  => __( 'Tags', ListingManager::$textdomain ),
		);

		$labels = apply_filters( 'listing_manager_tags_labels_filter', $labels );

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'listing-tags' ),
		);

		$args = apply_filters( 'listing_manager_tags_args_filter', $args );

		register_taxonomy( 'listing-manager-tags', 'listing-manager', $args );

	}

	public static function get_instance() {
     
        if ( null == self::$instance ) {
     
            self::$instance = new self;
     
        }
     
        return self::$instance;
    }

}

ListingManagerCPT::get_instance();