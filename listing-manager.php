<?php
/**
 * Plugin Name: Listing Manager
 */

class ListingManager{

	public static $textdomain = 'listing-manager';

	public static $instance = null;

	private function __construct(){

		require_once( plugin_dir_path( __FILE__ ).'/includes/defaults.class.php' );
		require_once( plugin_dir_path( __FILE__ ).'/includes/cpt.class.php' );		
		require_once( plugin_dir_path( __FILE__ ).'/includes/shortcodes.class.php' );

		add_action( 'admin_menu', array( $this, 'admin_menu_items' ) );

	}

	public function admin_menu_items(){

		add_submenu_page( 'edit.php?post_type=listing-manager', __( 'Settings', self::$textdomain ), __( 'Settings', self::$textdomain ), apply_filters( 'listing_manager_settings_page_cap_filter', 'manage_options' ), 'listing-manager-settings', array( $this, 'listing_manager_settings_page_callback' ) );

		add_submenu_page( 'edit.php?post_type=listing-manager', __( 'Extensions', self::$textdomain ), __( 'Extensions', self::$textdomain ), apply_filters( 'listing_manager_extensions_page_cap_filter', 'manage_options' ), 'listing-manager-extensions', array( $this, 'listing_manager_extensions_page_callback' ) );

	}

	public function listing_manager_settings_page_callback(){

	}

	public function listing_manager_extensions_page_callback(){

	}

	public static function render_form_fields( $array ){

        if( is_array( $array ) ){

            $content = "";

            foreach( $array as $key => $val ){
                if( $val['type'] == 'text' || $val['type'] == 'email' || $val['type'] == 'number'){
                    
                    $content .= "<div class='form-field'><label for='".$val['name']."'>".$val['label']."</label>";
                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' placeholder='".$val['placeholder']."' /></div>";
                
                } else if ( $val['type'] == 'hidden' ){
                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' placeholder='".$val['placeholder']."' />";
                } else if ( $val['type'] == 'textarea' ){
                
                    $content .= "<div class='form-field'><label for='".$val['name']."'>".$val['label']."</label>";
                    $content .= "<textarea name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' placeholder='".$val['placeholder']."'>".$val['value']."</textarea></div>";
                
                } else if ( $val['type'] == 'radio' ){
                
                    $content .= "<div class='form-field'>";
                    $content .= "<input type='".$val['radio']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' /><label for='".$val['name']."'>".$val['label']."</label></div>";
                
                } else if ( $val['type'] == 'select' ){
                
                    $content .= "<div class='form-field'>";
                    $content .= "<select name='' id='' >";
                    if( is_array( $val['options'] ) ){
                        foreach( $val['options']  as $key => $val ){
                            $content .= "<option value='$key'>".$val."</option>";
                        }
                    }
                    $content .= "</select>";
                
                } else if ( $val['type'] == 'submit' ) {

                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' />";

                } else {

                    $content .= "<div class='form-field'><label for='".$val['name']."'>".$val['label']."</label>";
                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' placeholder='".$val['placeholder']."' /></div>";

                }
            }

            return $content;

        } else {
            return false;
        }

    }

    public static function render_dashboard_contents(){

    	$dashboard_html = file_get_contents( apply_filters( 'listing_manager_dashboard_contents_path_filter', plugin_dir_path( __FILE__ ).'/templates/dashboard.html' ) );

    	$allowed_tags = array( 
    		'{{soomething_here}}' => 'This should be here instead' 
		);

    	$allowed_tags = apply_filters( 'listing_manager_dashboard_allowed_tags_filters', $allowed_tags );

    	if( is_array( $allowed_tags ) ){
    		foreach( $allowed_tags as $key => $val ){
    			$dashboard_html = str_replace( $key, $val, $dashboard_html );
    		}
    	}
    	
    	return $dashboard_html;

    }

    public function render_listing_contents(){

    	$listings_html = file_get_contents( apply_filters( 'listing_manager_listings_contents_path_filter', plugin_dir_path( __FILE__ ).'/templates/listings.html' ) );

    	$allowed_tags = array( 
    		'{{soomething_here}}' => 'This should be here instead' 
		);

    	$allowed_tags = apply_filters( 'listing_manager_listings_allowed_tags_filters', $allowed_tags );

    	if( is_array( $allowed_tags ) ){
    		foreach( $allowed_tags as $key => $val ){
    			$listings_html = str_replace( $key, $val, $listings_html );
    		}
    	}
    	
    	return $listings_html;

    }

	public static function get_instance() {
     
        if ( null == self::$instance ) {
     
            self::$instance = new self;
     
        }
     
        return self::$instance;
    }

}

ListingManager::get_instance();