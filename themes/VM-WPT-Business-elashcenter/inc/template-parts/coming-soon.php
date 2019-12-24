<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<style>
		body {
			margin: 0;
		}
		.img-lnk {
			position: absolute;
			top: 0;
			width: 100%;
			display: block;
			text-align: center;
			background-color: rgba(0, 0, 0, 0.56);
			color: #fff;
		}
		.bg-img {
			position: relative;
			display: block;
			width: 100%;
			height: 100vh;
			background:
				url("<?php echo get_template_directory_uri(); ?>/assets/bin/img/sample-coming-soon.jpg")
				center center/cover no-repeat;
		}
	</style>
</head>
<body>
<div class="bg-img">
	<a href="https://www.freepik.com/free-photos-vectors/background" class="img-lnk">
		Background vector created by rawpixel.com - www.freepik.com
	</a>
</div>
</body>
</html>
<?php //TODO: create the option to enable this page.


