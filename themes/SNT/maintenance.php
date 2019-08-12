<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1.0" /><style>
		img {
			width: 100%;
			height: auto;
		}
		h1 { text-align: center; }
	</style>
</head>
<body><img src="<?php echo get_template_directory_uri(); ?>/maintenance.jpg" /><?php
die( '<h1>' . _x( 'Site Under Maintenance!', 'Message', 'snt-en' ) . '</h1>' );
?></body>
</html>
