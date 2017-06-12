<?php

class ListingManagerDefaults{

	public static function default_submission_form_fields(){

		$fields = array(
			'listing_title' => array(
                'label'         =>  __( 'Title', ListingManager::$textdomain ),
                'type'          =>  'text', 
                'name'          =>  'listing_title',
                'id'            =>  '',
                'class'         =>  'listing_title',
                'placeholder'   =>  '', 
                'value'         =>  ''
            ),
            'listing_description' => array(
                'label'         =>  __( 'Description', ListingManager::$textdomain ),
                'type'          =>  'textarea', 
                'name'          =>  'listing_description',
                'id'            =>  '',
                'class'         =>  'listing_description',
                'placeholder'   =>  '', 
                'value'         =>  ''
            ),
            'listing_price' => array(
                'label'         =>  __( 'Price', ListingManager::$textdomain ),
                'type'          =>  'text', 
                'name'          =>  'listing_price',
                'id'            =>  '',
                'class'         =>  'listing_price',
                'placeholder'   =>  '', 
                'value'         =>  ''
            ),
            'listing_featured_image' => array(
                'label'         =>  __( 'Image', ListingManager::$textdomain ),
                'type'          =>  'file', 
                'name'          =>  'listing_featured_image',
                'id'            =>  '',
                'class'         =>  'listing_featured_image',
                'placeholder'   =>  '', 
                'value'         =>  ''
            ),
		);

		$fields = apply_filters( 'listing_manager_default_submission_fields_filter', $fields );

		return $fields;

	}

}