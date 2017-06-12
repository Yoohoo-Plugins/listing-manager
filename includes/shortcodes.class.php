<?php

class ListingManagerShortcodes{

	public static $instance = null;

	private function __construct(){

		add_shortcode( 'listing_manager_form', array( $this, 'submission_form' ) );
		add_shortcode( 'listing_manager_dashboard', array( $this, 'dashboard' ) );
		add_shortcode( 'listing_manager_listings', array( $this, 'listings' ) );

	}

	public function submission_form(){

		$form_fields = ListingManagerDefaults::default_submission_form_fields();

		ob_start();
			do_action( 'listing_manager_shortcode_before_submission_form_contents' );
			$above_content = ob_get_contents();
		ob_end_clean();

		$form_content = ListingManager::render_form_fields( $form_fields );

		ob_start();
			do_action( 'listing_manager_shortcode_after_submission_form_contents' );
			$below_content = ob_get_contents();
		ob_end_clean();

		return $above_content.$form_content.$below_content;

	}

	public function dashboard(){

		ob_start();
			do_action( 'listing_manager_shortcode_before_dashboard_contents' );
			$above_content = ob_get_contents();
		ob_end_clean();

		$dashboard_content = ListingManager::render_dashboard_contents();

		ob_start();
			do_action( 'listing_manager_shortcode_after_dashboard_contents' );
			$below_content = ob_get_contents();
		ob_end_clean();

		return $above_content.$dashboard_content.$below_content;

	}

	public function listings(){

		ob_start();
			do_action( 'listing_manager_shortcode_before_listing_contents' );
			$before_content = ob_get_contents();
		ob_end_clean();

		$listings_content = ListingManager::render_listing_contents();

		ob_start();
			do_action( 'listing_manager_shortcode_after_listing_contents' );
			$after_content = ob_get_contents();
		ob_end_clean();

		return $before_content.$listings_content.$after_content;

	}

	public static function get_instance() {
     
        if ( null == self::$instance ) {
     
            self::$instance = new self;
     
        }
     
        return self::$instance;
    }

}

ListingManagerShortcodes::get_instance();