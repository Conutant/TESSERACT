<?php

/**
 * @class TesseractBlogModule
 */
class TesseractBlogModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct( array(
			'name'			=> __('Blog', 'fl-builder'),
			'description'	=> __('A simple blog section.', 'fl-builder'),
			'category'		=> __('Advanced Modules', 'fl-builder'),
			'dir'			=> TESSERACT_BB_MODULE_DIR . 'blog/',
			'url'			=> TESSERACT_BB_MODULE_URL . 'blog/'
		) );

		$this->add_css('blog-module-css', $this->url . 'css/blog-module.css');
	}

	/**
	 * Use this method to work with settings data before
	 * it is saved. You must return the settings object.
	 *
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		return $settings;
	}

	/**
	 * This method will be called by the builder
	 * right before the module is deleted.
	 *
	 * @method delete
	 */
	public function delete()
	{

	}
}

/* get post types */
$post_types = array();
$all_post_types = get_post_types( array( 'public' => true ), 'objects' );

foreach ( $all_post_types as $type => $obj ) {
	if ( $obj->show_in_nav_menus ) {
		$post_types[ $type ] = $obj->label;
	}
}

/* get order by options */
$orderby_options = array(
	'none' => _( 'No order' ),
	'ID' => _( 'Order by post id' ),
	'author' => _( 'Order by author' ),
	'title' => _( 'Order by title' ),
	'name' => _( 'Order by post name (post slug)' ),
	'type' => _( 'Order by post type' ),
	'date' => _( 'Order by date' ),
	'modified' => _( 'Order by last modified date' ),
	'parent' => _( 'Order by post/page parent id' ),
	'rand' => _( 'Random order' ),
	'comment_count' => _( 'Order by number of comments' ),
	'menu_order' => _( 'Order by page order' ),
	'post__in' => _( 'Preserve post ID order given in Specific IDs field' ),
);

/* get all posts */
$posts = array();
$post_names = array_keys( $post_types );
$all_posts = get_posts( array( 'post_type' => $post_names, 'numberposts' => -1, 'post_status' => 'publish' ) );

foreach ( $all_posts as $p => $obj ) {
	$posts[ $obj->ID ] = $obj->post_title;
}

/* get all authors */
$authors = array( '' => 'All' );
$all_authors = get_users( array( 'role' => 'author' ) );

foreach ( $all_authors as $k => $obj ) {
	$authors[ $obj->data->ID ] = $obj->data->display_name;
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'TesseractBlogModule', array(
	'general' => array(
		'title' => __('General', 'fl-builder'),
		'sections' => array(
			'setup' => array(
				'title' => __( 'Loop Setup', 'tesseract' ),
				'fields' => array(
					'post_type' => array(
						'type' => 'select',
						'label' => __( 'Post Type', 'tesseract' ),
						'default' => 'post',
						'options' => $post_types
					),
					'users' => array(
						'type' => 'select',
						'label' => __( 'Author', 'tesseract' ),
						'options' => $authors
					),
					'posts_per_page' => array(
						'type' => 'text',
						'label' => __( 'Posts per page', 'tesseract' ),
						'default' => '5'
					),
					'order_by' => array(
						'type' => 'select',
						'label' => __( 'Order by', 'tesseract' ),
						'default' => 'date',
						'options' => $orderby_options
					),
					'order' => array(
						'type' => 'select',
						'label' => __( 'Order', 'tesseract' ),
						'default' => 'DESC',
						'options' => array(
							'DESC' => __( 'Descending' ),
							'ASC' => __( 'Ascending' )
						)
					),
					'ids' => array(
						'type' => 'text',
						'label' => 'Specific IDs',
						'description' => __( 'List the IDs separated by comma that will be displayed (leave blank to disable)' )
					)
				)
			),
			'display' => array(
				'title' => __( 'Format', 'tesseract' ),
				'fields' => array(
					'post_display' => array(
						'type' => 'select',
						'label' => __( 'Post Display', 'tesseract' ),
						'default' => 'compact',
						'options' => array(
							'compact' => __( 'Compact', 'tesseract' ),
							'vertical' => __( 'Vertical', 'tesseract' ),
						)
					),
					'show_featured' => array(
						'type' => 'select',
						'label' => __( 'Show featured image', 'tesseract' ),
						'default' => 'yes',
						'options' => array(
							'yes' => __( 'Yes', 'tesseract' ),
							'no' => __( 'No', 'tesseract' ),
						)
					),
					'show_date' => array(
						'type' => 'select',
						'label' => __( 'Show post date', 'tesseract' ),
						'default' => 'yes',
						'options' => array(
							'yes' => __( 'Yes', 'tesseract' ),
							'no' => __( 'No', 'tesseract' ),
						)
					),
					'show_author' => array(
						'type' => 'select',
						'label' => __( 'Show post author', 'tesseract' ),
						'default' => 'yes',
						'options' => array(
							'yes' => __( 'Yes', 'tesseract' ),
							'no' => __( 'No', 'tesseract' ),
						)
					),
					'excerpt_more' => array(
						'type' => 'text',
						'label' => __( 'Excerpt more text', 'tesseract' ),
						'default' => '...',
					),
				)
			),
		)
	)
) );