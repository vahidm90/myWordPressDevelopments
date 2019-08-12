<?php

global $vmbwpt_lang;

$path = get_template_directory_uri() . '/assets';

get_header( 'front-page' );

?>
<div id="wrap">
	<?php get_template_part( 'template-parts/front-page/slider' ); ?>
    <div class="container-fluid py-5" id="lvl-2" style="background-image:url(<?php echo $path; ?>/images/train.jpg)">
        <div class="row">
            <div class="col-sm-4">
                <a href="<?php echo get_permalink(VMBWPT_LANGUAGES[$vmbwpt_lang]['pages']['about'] ); ?>">
                    <div class="circle position-relative" data-aos="flip-left" style="background-image:url(<?php echo $path; ?>/images/welcome_img.png)">
                        <p class="position-absolute w-100 text-center">
				            <?php _ex('Who are we?', 'About Circle', VMBWPT_TEXT_DOMAIN ); ?>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="<?php echo get_permalink(VMBWPT_LANGUAGES[$vmbwpt_lang]['pages']['product'] ); ?>">
                    <div class="circle position-relative" data-aos="flip-left" style="background-image:url(<?php echo $path; ?>/images/grade.jpg)">
                        <p class="position-absolute w-100 text-center">
				            <?php _ex('Our Products', 'Products Circle', VMBWPT_TEXT_DOMAIN ); ?>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="<?php echo get_permalink(VMBWPT_LANGUAGES[$vmbwpt_lang]['pages']['contact'] ); ?>">
                    <div class="circle position-relative" data-aos="flip-left" style="background-image:url(<?php echo $path; ?>/images/phone.jpg)">
                        <p class="position-absolute w-100 text-center">
				            <?php _ex('Get in touch!', 'Contact Circle', VMBWPT_TEXT_DOMAIN ); ?>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="lvl-3">
        <div class="row">
            <div class="col-12">
                <h2 class="mt-5">
                    <?php _ex( 'Our Mission', 'Home page content heading', VMBWPT_TEXT_DOMAIN ); ?>
                </h2>
            </div>
            <div class="col-12">
                <div class="content mb-5">
	                <?php echo get_post( VMBWPT_LANGUAGES[$vmbwpt_lang]['pages']['home'], 'OBJECT', 'display' )->post_content; ?>
                </div>
            </div>
        </div>
    </div>
<?php

get_footer( 'front-page' );