<?php
	$variables = (new andyp\theme\syllabus\app\all_page_variables)->get_variables();
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
		<?php include( get_template_directory() .'/src/components/favicons/favicons.php' );  ?>
	</head>


	<body <?php body_class('syllabus bg-zinc-800 subpixel-antialiased' . $variables["page_builder"]["body_classes"] ); ?>>