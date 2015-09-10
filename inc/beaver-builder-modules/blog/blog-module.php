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

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'TesseractBlogModule', array(
	'general' => array( // Tab
		'title' => __('General', 'fl-builder'), // Tab title
		'sections' => array( // Tab Sections
			'display' => array( // Section
				'title' => __('Display', 'tesseract'), // Section Title
				'fields' => array( // Section Fields
					'post_display' => array(
						'type' => 'select',
						'label' => __('Post Display', 'tesseract'),
						'default' => 'compact',
						'options' => array(
							'compact' => __('Compact', 'tesseract'),
							'vertical' => __('Vertical', 'tesseract'),
						)
					)
				)
			)
		)
	)
) );