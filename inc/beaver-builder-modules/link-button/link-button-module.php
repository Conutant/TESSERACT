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
			'link-setup' => array(
				'title' => __( 'Link setup', 'fl-builder' ),
				'fields' => array(
                    'text'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Button text', 'fl-builder' ),
                    ),
					'font_size' => array(
						'type'          => 'text',
						'label'         => __( 'Font size', 'fl-builder' ),
						'default'       => '12',
						'description'   => 'px',
						'placeholder'   => '12',
						'maxlength'     => '4',
						'size'          => '5'
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
				),
			),
			'button-colors' => array(
				'title' => __( 'Button colors', 'fl-builder' ),
				'fields' => array(
                    'text_color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Text color', 'fl-builder' ),
						'default'       => '333',
						'show_reset'    => true,
					),
                    'button_color'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Button color', 'fl-builder' ),
						'default'       => 'fff',
						'show_reset'    => true,
					),
					'opacity' => array(
                        'type'          => 'text',
                        'label'         => __( 'Button color opacity', 'fl-builder' ),
						'default'       => '100',
						'description'   => '%',
						'placeholder'   => '100',
						'maxlength'     => '4',
						'size'          => '5'
					),
				),
			),
			'button-colors-hover' => array(
				'title' => __( 'Button colors on hover', 'fl-builder' ),
				'fields' => array(
                    'text_color_hover'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Text color', 'fl-builder' ),
						'default'       => '333',
						'show_reset'    => true,
					),
                    'button_color_hover'     => array(
                        'type'          => 'color',
                        'label'         => __( 'Button color', 'fl-builder' ),
						'default'       => 'fff',
						'show_reset'    => true,
					),
					'opacity_hover' => array(
                        'type'          => 'text',
                        'label'         => __( 'Button color opacity', 'fl-builder' ),
						'default'       => '100',
						'description'   => '%',
						'placeholder'   => '100',
						'maxlength'     => '4',
						'size'          => '5'
					),
				),
			),
			'display' => array(
				'title' => __( 'Display', 'fl-builder' ),
				'fields' => array(
					'align' => array(
                        'type'          => 'select',
                        'label'         => __( 'Alignment', 'fl-builder' ),
						'default'       => 'left',
						'options'       => array(
							'left' => 'Left',
							'center' => 'Center',
							'right' => 'Right',
						)
					),
					'padding_top' => array(
                        'type'          => 'text',
                        'label'         => __( 'Top padding', 'fl-builder' ),
						'default'       => '0',
						'description'   => 'px',
						'placeholder'   => '0',
						'maxlength'     => '4',
						'size'          => '5'
					),
					'padding_bottom' => array(
                        'type'          => 'text',
                        'label'         => __( 'Bottom padding', 'fl-builder' ),
						'default'       => '0',
						'description'   => 'px',
						'placeholder'   => '0',
						'maxlength'     => '4',
						'size'          => '5',
					),
					'padding_left' => array(
                        'type'          => 'text',
                        'label'         => __( 'Left padding', 'fl-builder' ),
						'default'       => '20',
						'description'   => 'px',
						'placeholder'   => '20',
						'maxlength'     => '4',
						'size'          => '5'
					),
					'padding_right' => array(
                        'type'          => 'text',
                        'label'         => __( 'Right padding', 'fl-builder' ),
						'default'       => '20',
						'description'   => 'px',
						'placeholder'   => '20',
						'maxlength'     => '4',
						'size'          => '5'
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
				),
			),
		)
	)
));