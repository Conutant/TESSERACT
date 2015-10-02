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
			'name'          => __( 'Google Map', 'fl-builder' ),
			'description'   => __( 'Google Map', 'fl-builder' ),
			'category'      => __( 'Advanced Modules', 'fl-builder' ),
			'dir'           => TESSERACT_BB_MODULE_DIR . 'google-map/',
			'url'           => TESSERACT_BB_MODULE_URL . 'google-map/',
			'enabled'       => true,
		));
	}
}

FLBuilder::register_module( 'TesseractGoogleMapModule', array(
    'tesseract-link-button'      => array(
        'title'         => __( 'General', 'fl-builder' ),
		'sections' => array(
			'display' => array(
				'title' => __( 'Display', 'fl-builder' ),
				'fields' => array(
					'map_type' => array(
						'type'      => 'select',
						'label'     => __( 'Map Type', 'fl-builder' ),
						'default'   => __( 'interactive', 'fl-builder' ),
						'options'   => array(
							'interactive' => __( 'Interactive', 'fl-builder' ),
							'static'      => __( 'Static', 'fl-builder' ),
						),
						'toggle'        => array(
							'interactive'  => array(
								'fields'   => array(
									'fullwidth',
									'width',
									'height',
									'float',
									'query',
								),
							),
							'static'      => array(
								'fields'   => array(
									'width',
									'float',
									'zoom',
									'query',
								)
							)
						)
					),
                    'fullwidth'     => array(
						'type'      => 'select',
						'label'     => __( 'Full width map?', 'fl-builder' ),
						'default'   => __( 'yes', 'fl-builder' ),
						'options'   => array(
							'yes'      => __( 'Yes', 'fl-builder' ),
							'no'      => __( 'No', 'fl-builder' ),
						),
						'toggle'        => array(
							'no'      => array(
								'fields'   => array(
									'map_type',
									'width',
									'float',
									'query',
								),
							),
							'yes'      => array(
								'fields'   => array(
									'map_type',
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
                    ),
                    'height'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Height', 'fl-builder' ),
						'description'   => __( 'Height in pixels', 'fl-builder' ),
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
						'default'   => __( '14', 'fl-builder' ),
						'options'   => range( 0, 20 ),
					),
                    'query'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Search location', 'fl-builder' ),
						'description'   => __( 'Enter an address. eg. 123 Main st, Los Angeles, CA', 'fl-builder' ),
                    ),
				)
			)
		)
	)
));