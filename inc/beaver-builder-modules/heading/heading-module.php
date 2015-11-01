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
						'description'   => 'px',
						'default'       => '24',
						'placeholder'   => '24',
						'maxlength'     => '4',
						'size'          => '5'
                    ),
                    'weight'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Font weight', 'fl-builder' ),
						'default'       => '400',
						'options'    => array(
							'100' => 'Light',
							'400' => 'Normal',
							'600' => 'Bold',
						),
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
							'center' => __( 'Center', 'fl-builder' ),
							'right' => __( 'Right', 'fl-builder' ),
						),
					),
				)
			),
			'subheadline_display' => array(
				'title' => __( 'Subheadline', 'fl-builder' ),
				'fields' => array(
					'add_subheadline' => array(
						'type' => 'select',
						'label'   => 'Add subheadline?',
						'default' => '',
						'options' => array(
							'' => 'No',
							'yes' => 'Yes',
						),
						'toggle' => array(
							'' => array(),
							'yes' => array(
								'fields' => array(
									'vertical_spacing',
									'sub_text',
									'sub_size',
									'sub_weight',
									'sub_color',
								)
							)
						)
					),
                    'vertical_spacing'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Vertical spacing with heading', 'fl-builder' ),
						'description'   => 'px',
						'default'       => '4',
						'placeholder'   => '4',
						'maxlength'     => '4',
						'size'          => '5'
                    ),
                    'sub_text'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Subheadline text', 'fl-builder' ),
                    ),
					'sub_size'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Subheadline font size', 'fl-builder' ),
						'description'   => 'px',
						'default'       => '18',
						'placeholder'   => '18',
						'maxlength'     => '4',
						'size'          => '5'
                    ),
                    'sub_weight'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Subheadline font weight', 'fl-builder' ),
						'default'       => '400',
						'options'    => array(
							'100' => 'Light',
							'400' => 'Normal',
							'600' => 'Bold',
						),
					),
                    'sub_color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Subheadline text color', 'fl-builder' ),
						'default'       => '333',
						'show_reset'    => true,
					),
				)
			)
		)
	)
));