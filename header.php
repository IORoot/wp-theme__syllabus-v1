<?php
	$body_classes = get_field('body_classes'); 
?>

<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		<title><?php echo wp_title(); ?></title>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<?php 
			wp_head(); 
			do_action('page_builder_header_code'); 
		?>
		<?php include( __DIR__.'/src/components/favicons/favicons.php' );  ?>
	</head>


	<body <?php body_class('syllabus bg-zinc-800 ' . $body_classes ); ?>>