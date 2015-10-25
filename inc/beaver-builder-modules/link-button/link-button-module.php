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

/* get a list of all available font awesome icons */
$icons_file = FL_BUILDER_DIR . 'css/font-awesome.min.css';
$parsed_file = file_get_contents( $icons_file );
preg_match_all( '/fa\-([a-zA-z0-9\-]+[^\:\.\,\s{>])/', $parsed_file, $matches );
$exclude_icons = array(
	'fa-lg', 'fa-2x', 'fa-3x', 'fa-4x', 'fa-5x',
	'fa-ul', 'fa-li', 'fa-fw', 'fa-border',
	'fa-pulse',	'fa-rotate-90',	'fa-rotate-180', 'fa-rotate-270',
	'fa-spin', 'fa-flip-horizontal', 'fa-flip-vertical',
	'fa-stack', 'fa-stack-1x', 'fa-stack-2x', 'fa-inverse'
);

$fa_icon_classes = array_diff( $matches[0], $exclude_icons );

$fa_icons = array();
foreach ( $fa_icon_classes as $icon ) {
	$fa_icons[ $icon ] = ucwords( str_replace( array( 'fa-', '-' ), array( '', ' ' ), $icon ) );
}

asort( $fa_icons );

/* get a list of all available typicons */
$icons_file = get_stylesheet_directory() . '/css/typicons.css';
$parsed_file = file_get_contents( $icons_file );
preg_match_all( '/typcn\-([a-zA-z0-9\-]+[^\:\.\,\s{>])/', $parsed_file, $matches );
$typ_icon_classes = $matches[0];

$typ_icons = array();
foreach ( $typ_icon_classes as $icon ) {
	$typ_icons[ $icon ] = ucwords( str_replace( array( 'typcn-', '-' ), array( '', ' ' ), $icon ) );
}

asort( $typ_icons );

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
						'default'       => '_top',
						'options'       => array(
							'_blank'      => __( 'A new window', 'fl-builder' ),
							'_top'        => __( 'The current window', 'fl-builder' ),
						),
                    ),
				),
			),
			'icon-setup' => array(
				'title' => __( 'Icon setup', 'fl-builder' ),
				'fields' => array(
                    'icon'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Add icon?', 'fl-builder' ),
						'default'		=> '',
						'options'		=> array(
							'' => 'No',
							'fa' => 'Font Awesome',
							'typ' => 'Typicons',
						),
						'toggle'       => array(
							'fa' => array(
								'fields' => array(
									'icon_position',
									'fa_icon',
									'fa_icon_size',
								)
							),
							'typ' => array(
								'fields' => array(
									'icon_position',
									'typ_icon',
									'typ_icon_size',
								)
							),
						)
                    ),
                    'icon_position'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Icon position', 'fl-builder' ),
						'default'		=> 'right',
						'options'		=> array(
							'right'   => 'Right',
							'left' => 'Left',
						)
                    ),
                    'fa_icon'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Icon', 'fl-builder' ),
						'default'		=> 'none',
						'options'		=> $fa_icons,
                    ),
                    'fa_icon_size'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Icon size', 'fl-builder' ),
						'default'		=> '',
						'options'		=> array(
							''   => 'Normal',
							'lg' => 'Large',
							'2x' => '2X',
							'3x' => '3X',
							'4x' => '4X',
							'5x' => '5X',
						)
                    ),
                    'typ_icon'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Icon', 'fl-builder' ),
						'default'		=> 'none',
						'options'		=> $typ_icons,
                    ),
                    'typ_icon_size'     => array(
                        'type'          => 'text',
                        'label'         => __( 'Icon size', 'fl-builder' ),
						'default'		=> '100',
						'description'   => '%',
						'placeholder'   => '100',
						'maxlength'     => '4',
						'size'          => '5'
                    ),
				)
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