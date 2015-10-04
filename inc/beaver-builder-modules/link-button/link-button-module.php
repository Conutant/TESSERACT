<?php
class TesseractLinkButtonModule extends FLBuilderModule {
	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir, url and enabled in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'          => __( 'Link Button', 'fl-builder' ),
			'description'   => __( 'Link Button', 'fl-builder' ),
			'category'      => __( 'Basic Modules', 'fl-builder' ),
			'dir'           => TESSERACT_BB_MODULE_DIR . 'link-button/',
			'url'           => TESSERACT_BB_MODULE_URL . 'link-button/',
			'enabled'       => true,
		));
	}
}

FLBuilder::register_module( 'TesseractLinkButtonModule', array(
    'tesseract-link-button'      => array(
        'title'         => __( 'General', 'fl-builder' ),
		'sections' => array(
			'display' => array(
				'title' => __( 'Display', 'fl-builder' ),
				'fields' => array(
                    'text'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Button text', 'fl-builder' ),
                    ),
                    'href'     => array(
                        'type'          => 'link',
                        'label'         => __( 'Button Link', 'fl-builder' ),
                    ),
                    'target'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Open link in', 'fl-builder' ),
						'default'       => '_blank',
						'options'       => array(
							'_blank'      => __( 'A new window', 'fl-builder' ),
							'_top'        => __( 'The current window', 'fl-builder' ),
						),
                    ),
                    'text_color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Text color', 'fl-builder' ),
						'default'       => '333',
						'show_reset'    => true,
					),
                    'text_color_hover'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Text color on hover', 'fl-builder' ),
						'default'       => '333',
						'show_reset'    => true,
					),
                    'button_color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Button color', 'fl-builder' ),
						'default'       => 'fff',
						'show_reset'    => true,
					),
                    'button_color_hover'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Button color on hover', 'fl-builder' ),
						'default'       => 'fff',
						'show_reset'    => true,
					),
                    'border'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Border', 'fl-builder' ),
						'default'       => 'none',
						'options'       => array(
							'none' => __( 'None', 'fl-builder' ),
							'dotted' => __( 'Dotted', 'fl-builder' ),
							'dashed' => __( 'Dashed', 'fl-builder' ),
							'solid' => __( 'Solid', 'fl-builder' ),
							'double' => __( 'Double', 'fl-builder' ),
						),
						'toggle'       => array(
							'dotted' => array(
								'fields' => array(
									'border_width',
									'border_color',
									'border_radius'
								)
							),
							'dashed' => array(
								'fields' => array(
									'border_width',
									'border_color',
									'border_radius'
								)
							),
							'solid' => array(
								'fields' => array(
									'border_width',
									'border_color',
									'border_radius'
								)
							),
							'double' => array(
								'fields' => array(
									'border_width',
									'border_color',
									'border_radius'
								)
							),
						),
                    ),
                    'border_width'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Border width', 'fl-builder' ),
						'default'          => '1',
					),
                    'border_color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Border color', 'fl-builder' ),
						'default'       => '000',
						'show_reset'    => true,
					),
                    'border_radius'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Border radius', 'fl-builder' ),
						'default'          => '0',
					),
				)
			)
		)
	)
));