<?php

array(
	'posts' => array(
		'page-slug' => array(
			'title' => 'Blah',
			'content' => 'Content',
			'import-id' => 'page-slug',
			'post_type' => 'cpt',
			'meta' => array()
		)
	),
	'comments' => array(
		0 => array(
			'for-import-id' => 'page-slug',
			'content' => 'Content',
			'meta' => array()
		)
	),
	'options' => array(
		0 => array(
			'name' => 'option_name',
			'value' => 'option_value'
		)
	),
	'terms' => array(),
	'term_taxonomy' => array(),
	'term_relationships' => array(),
	'requirements' => array(
		'theme' => 'TESSERACT',
		'theme_version_min' => 0,
		'theme_version_max' => '1.3.2',
		'required_plugins' => array(
			'woocommerce' => array(
				'source' => 'wp.org'
			),
			''
		)
	)
);