<?php

if ( !has_post_format( 'gallery' )) {
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                	        	STANDARD                                 │
	// └─────────────────────────────────────────────────────────────────────────┘
	include(get_template_directory() . '/src/views/layouts/page-standard.php'); 
}

if ( has_post_format( 'gallery' )) {
	// ┌─────────────────────────────────────────────────────────────────────────┐
	// │                	        	TUTORIAL                                 │
	// └─────────────────────────────────────────────────────────────────────────┘
	include(get_template_directory() . '/src/views/layouts/page-tutorial.php'); 
}