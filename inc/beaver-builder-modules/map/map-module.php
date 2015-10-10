<?php
class TesseractGoogleMapModule extends FLBuilderModule {
	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir, url and enabled in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'          => __( 'Map', 'fl-builder' ),
			'description'   => __( 'Google Map', 'fl-builder' ),
			'category'      => __( 'Advanced Modules', 'fl-builder' ),
			'dir'           => TESSERACT_BB_MODULE_DIR . 'map/',
			'url'           => TESSERACT_BB_MODULE_URL . 'map/',
			'enabled'       => true,
		));

		if ( ! defined( 'GOOGLE_MAPS_API_KEY' ) )
			define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyDdg6IMS4WeWJRORd0wU_gcE-kFOUKt4zE' );

		$this->add_js( 'google-maps-javascript-api', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY, array( 'jquery' ), '3.0', true );
	}
}

FLBuilder::register_module( 'TesseractGoogleMapModule', array(
    'tesseract-map-module'      => array(
        'title'         => __( 'General', 'fl-builder' ),
		'sections' => array(
			'display' => array(
				'title' => __( 'Display', 'fl-builder' ),
				'fields' => array(
                    'fullwidth'     => array(
						'type'      => 'select',
						'label'     => __( 'Full width map?', 'fl-builder' ),
						'default'   => 'yes',
						'options'   => array(
							'yes'      => __( 'Yes', 'fl-builder' ),
							'no'      => __( 'No', 'fl-builder' ),
						),
						'toggle'        => array(
							'no'      => array(
								'fields'   => array(
									'width',
									'height',
									'float',
									'query',
								),
							),
							'yes'      => array(
								'fields'   => array(
									'height',
									'query',
								),
							)
						)
					),
                    'width'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Width', 'fl-builder' ),
						'description'   => __( 'Width in pixels', 'fl-builder' ),
						'default'       => '600',
                    ),
                    'height'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Height', 'fl-builder' ),
						'description'   => __( 'Height in pixels', 'fl-builder' ),
						'default'       => '400',
                    ),
					'float' => array(
						'type'      => 'select',
						'label'     => __( 'Float', 'fl-builder' ),
						'default'   => __( 'none', 'fl-builder' ),
						'options'   => array(
							'none' => 'None',
							'left' => 'Left',
							'right' => 'Right',
						),
					),
					'zoom' => array(
						'type'      => 'select',
						'label'     => __( 'Zoom Level', 'fl-builder' ),
						'default'   => '8',
						'options'   => range( 0, 20 ),
						'preview'      => array(
							'type'         => 'none'
						),
					),
					'lat' => array(
						'type' => 'text',
						'hidden' => true
					),
					'lng' => array(
						'type' => 'text',
						'hidden' => true
					),
                    'query'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Search location', 'fl-builder' ),
						'description'   => __( 'Enter an address. eg. 123 Main st, Los Angeles, CA', 'fl-builder' ),
						'default'       => '',
						'preview'      => array(
							'type'         => 'none'
						),
                    ),
				)
			)
		)
	)
));