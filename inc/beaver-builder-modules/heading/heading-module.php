<?php

class TesseractHeadingModule extends FLBuilderModule {
	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir, url and enabled in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'          => __( 'Heading', 'fl-builder' ),
			'description'   => __( 'Heading', 'fl-builder' ),
			'category'      => __( 'Basic Modules', 'fl-builder' ),
			'dir'           => TESSERACT_BB_MODULE_DIR . 'heading/',
			'url'           => TESSERACT_BB_MODULE_URL . 'heading/',
			'enabled'       => true,
		));
	}
}

FLBuilder::register_module( 'TesseractHeadingModule', array(
    'tesseract-heading'      => array(
        'title'         => __( 'General', 'fl-builder' ),
		'sections' => array(
			'display' => array(
				'title' => __( 'Display', 'fl-builder' ),
				'fields' => array(
                    'text'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Heading text', 'fl-builder' ),
                    ),
					'size'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Font size', 'fl-builder' ),
						'description'   => __( 'Size in pixels', 'fl-builder' ),
                    ),
                    'color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Text color', 'fl-builder' ),
						'default'       => '333',
						'show_reset'    => true,
					),
                    'alignment'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Alignment', 'fl-builder' ),
						'default'       => 'left',
						'options'    => array(
							'left' => __( 'Left', 'fl-builder' ),
							'right' => __( 'Right', 'fl-builder' ),
							'center' => __( 'Center', 'fl-builder' ),
						),
					),
				)
			)
		)
	)
));