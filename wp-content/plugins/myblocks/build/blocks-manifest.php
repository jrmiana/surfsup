<?php
// This file is generated. Do not modify it manually.
return array(
	'eventgrid' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'custom-blocks/eventgrid',
		'version' => '0.1.0',
		'title' => 'Event Grid',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'limit' => array(
				'type' => 'number',
				'default' => 6
			),
			'category' => array(
				'type' => 'string',
				'default' => ''
			),
			'order' => array(
				'type' => 'string',
				'default' => 'DESC'
			)
		),
		'textdomain' => 'myblocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'herowithcta' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'custom-blocks/herowithcta',
		'version' => '0.1.0',
		'title' => 'Hero with CTA',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'imageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'heading' => array(
				'type' => 'string',
				'default' => ''
			),
			'buttonText' => array(
				'type' => 'string',
				'default' => ''
			),
			'buttonUrl' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'textdomain' => 'myblocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);
