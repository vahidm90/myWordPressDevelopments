<?php
if ( ! is_user_logged_in() ) :
	get_template_part( '/inc/template-parts/coming-soon' );
	die();
endif;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); //TODO: Set fonts based on language. ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="referer" content="origin-when-cross-origin">
