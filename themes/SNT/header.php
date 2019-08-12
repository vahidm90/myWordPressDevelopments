<?php
// if( ! is_user_logged_in() ) : get_template_part( 'maintenance' ); endif;

global  $snt_lang, $snt_supported_lang;

$l_att = get_language_attributes();

echo "<!doctype html><html $l_att><head>";

if ( FALSE !== strpos( $_SERVER['SERVER_NAME'], 'islamnewsagency' ) ) :
    include_once( get_template_directory() . '/g-analytics.php' );
endif;

?><meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1.0" /><?php
$fonts = empty( $snt_supported_lang[ $snt_lang ]['font-url'] ) ? '' : $snt_supported_lang[ $snt_lang ]['font-url'];
if ( is_array( $fonts ) ) :

	$font = join( '|', $fonts );

	echo "<link href='https://fonts.googleapis.com/css?family=$font' rel='stylesheet'>";

endif;