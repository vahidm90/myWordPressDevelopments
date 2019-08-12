<?php

global $vmbwpt_lang, $vmbwpt_comma;

$path = get_template_directory_uri() . '/assets';

?>
<div class="vh-100 vw-100" id="welcome">
	<ul class="h-100 w-100 anim-slider text-light">
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-1">
			<div class="slide-content w-100 h-100 position-relative">
				<img src="<?php echo $path; ?>/images/welcome_img.png"
				     alt="<?php _ex( 'Logo', 'Image alt text', VMBWPT_TEXT_DOMAIN ); ?>" id="s1-img">
				<h1 class="slide-title h3" id="s1-title"><?php bloginfo(); ?></h1>
				<p class="d-none d-sm-block h6 slide-text" id="s1-text"><?php bloginfo( 'description' ); ?></p>
			</div>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-2">
            <h2 class="slide-title d-block mt-0 p-3 w-100 mt-lg-5" id="s2-title">
                <?php _e( 'Our Products', VMBWPT_TEXT_DOMAIN ); ?>
            </h2>
			<div class="slide-content h-100 pt-5 w-50" id="s2-1">
				<p class="slide-text s2-step-2 h4 mt-2" id="s2-text-1-1"><?php _ex( 'Penetration Bitumen', 'Slider Text', VMBWPT_TEXT_DOMAIN ); ?></p>
				<p class="slide-text s2-step-3 d-sm-inline-block h6 m-3" id="s2-text-1-2"><?php _e( '40-50', VMBWPT_TEXT_DOMAIN); ?></p>
				<p class="slide-text s2-step-4 d-sm-inline-block h6 m-3" id="s2-text-1-3"><?php _e( '60-70', VMBWPT_TEXT_DOMAIN); ?></p>
				<p class="slide-text s2-step-5 d-sm-inline-block h6 m-3" id="s2-text-1-4"><?php _e( '80-100', VMBWPT_TEXT_DOMAIN); ?></p>
                <img src="<?php echo $path; ?>/images/big/bitumen.jpg" alt="" class="s2-step-1 d-none d-sm-block h-auto mx-auto w-75" id="s2-img-1" />
            </div>
			<div class="slide-content h-100 pt-5 w-50" id="s2-2">
				<p class="slide-text s2-step-2 h4 mt-2" id="s2-text-2-1"><?php _e( 'Viscosity', VMBWPT_TEXT_DOMAIN ); ?></p>
				<p class="slide-text s2-step-3 d-sm-inline-block h6 m-3" id="s2-text-2-2"><?php _e( 'VG10', VMBWPT_TEXT_DOMAIN); ?></p>
				<p class="slide-text s2-step-4 d-sm-inline-block h6 m-3" id="s2-text-2-3"><?php _e( 'VG20', VMBWPT_TEXT_DOMAIN); ?></p>
				<p class="slide-text s2-step-5 d-sm-inline-block h6 m-3" id="s2-text-2-4"><?php _e( 'VG30', VMBWPT_TEXT_DOMAIN); ?></p>
				<p class="slide-text s2-step-6 d-sm-inline-block h6 m-3" id="s2-text-2-5"><?php _e( 'VG40', VMBWPT_TEXT_DOMAIN); ?></p>
                <img src="<?php echo $path; ?>/images/big/grade.jpg" alt="" class="s2-step-1 d-none d-sm-block h-auto mx-auto w-75" id="s2-img-2"/>
            </div>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-3">
            <div class="slide-content w-100 text-center position-static">
                <h2 class="slide-title mt-0 p-3 mt-lg-5" id="s3-title"><?php _e( 'Our Products', VMBWPT_TEXT_DOMAIN ); ?></h2>
                <p class="slide-text h6 my-1 m-sm-4 p-1 p-sm-3 d-sm-inline-block" id="s3-text-1"><?php _e('Paraffin Wax', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text h6 my-1 m-sm-4 p-1 p-sm-3 d-sm-inline-block" id="s3-text-2"><?php _e('Slack Wax', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text h6 my-1 m-sm-4 p-1 p-sm-3 d-sm-inline-block" id="s3-text-3"><?php _e('Base Oil', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text h6 my-1 m-sm-4 p-1 p-sm-3 d-sm-inline-block" id="s3-text-4"><?php _e('R.P.O', VMBWPT_TEXT_DOMAIN ); ?></p>
            </div>
            <div class="slide-content position-relative">
                <img src="<?php echo $path; ?>/images/big/Paraffin_wax.jpg" alt="" class="d-md-block d-none position-absolute w-25" id="s3-img-1"/>
                <img src="<?php echo $path; ?>/images/big/Oil_platform.jpg" alt="" class="d-md-block d-none position-absolute w-25" id="s3-img-2"/>
            </div>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-4">
				<h2 class="slide-title mt-2 position-static mt-lg-5" id="s4-title">
					<?php _ex( 'Where are you?', 'Slider Title', VMBWPT_TEXT_DOMAIN ); ?>
				</h2>
			<div class="slide-content position-relative h-100 w-100" id="s4-text-img" style="background-image: url(<?php echo $path; ?>/images/big/export_everywhere.jpg)">
                <div class="slide-content position-absolute h-100 w-50 p-1 p-sm-5" id="s4-1">
                    <p class="slide-text bg-dark h6 p-1 s4-step-1" id="s4-text-1"><?php _e( 'Afghanistan', VMBWPT_TEXT_DOMAIN ); ?></p>
                    <p class="slide-text bg-dark h6 p-1 s4-step-2" id="s4-text-2"><?php _e( 'Pakistan', VMBWPT_TEXT_DOMAIN ); ?></p>
                    <p class="slide-text bg-dark h6 p-1 s4-step-3" id="s4-text-3"><?php _e( 'Uzbekistan', VMBWPT_TEXT_DOMAIN ); ?></p>
                    <p class="slide-text bg-dark h6 p-1 s4-step-4" id="s4-text-4"><?php _e( 'Georgia', VMBWPT_TEXT_DOMAIN ); ?></p>
                </div>
                <div class="slide-content position-absolute h-100 w-50 p-1 p-sm-5" id="s4-2">
                    <p class="slide-text bg-dark h6 p-1 s4-step-1" id="s4-text-5"><?php _e( 'India', VMBWPT_TEXT_DOMAIN ); ?></p>
                    <p class="slide-text bg-dark h6 p-1 s4-step-2" id="s4-text-6"><?php _e( 'Myanmar', VMBWPT_TEXT_DOMAIN ); ?></p>
                    <p class="slide-text bg-dark h6 p-1 s4-step-3" id="s4-text-7"><?php _e( 'Bangladesh', VMBWPT_TEXT_DOMAIN ); ?></p>
                    <p class="slide-text bg-dark h6 p-1 s4-step-4" id="s4-text-8"><?php _e( 'Kenya', VMBWPT_TEXT_DOMAIN ); ?></p>
                </div>
                <div class="slide-content position-absolute w-100 text-center" id="s4-3">
                    <p class="slide-text d-inline-block bg-dark h6 p-1" id="s4-text-9">
                        <?php _e( 'World-wide coverage', VMBWPT_TEXT_DOMAIN ); ?>
                    </p>
                    <br />
                    <p class="slide-text d-inline-block bg-dark h6 p-1" id="s4-text-10">
                        <?php _e( 'Enjoy Your Purchase', VMBWPT_TEXT_DOMAIN ); ?>
                    </p>
                </div>
			</div>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-5">
            <div class="slide-content h-100 p-4 w-100">
                <h2 class="slide-title mt-2 mt-lg-5" id="s5-title"><?php _e( 'Your choice matters', VMBWPT_TEXT_DOMAIN ); ?></h2>
                <p class="text-left slide-text h6 m-1 m-sm-3" id="s5-text-1">
                    <span class="dashicons dashicons-yes" id="s5-text-1-tick"></span>
                    <?php _e( 'Fast Delivery', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
                <p class="text-left slide-text h6 m-1 m-sm-3" id="s5-text-2">
                    <span class="dashicons dashicons-yes" id="s5-text-2-tick"></span>
                    <?php _e( 'Customer Respect', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
                <p class="text-left slide-text h6 m-1 m-sm-3" id="s5-text-3">
                    <span class="dashicons dashicons-yes" id="s5-text-3-tick"></span>
	                <?php _e( 'Experienced Experts', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
                <p class="text-left slide-text h6 m-1 m-sm-3" id="s5-text-4">
                    <span class="dashicons dashicons-yes" id="s5-text-4-tick"></span>
                    <?php _e( 'Competitive Prices', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
                <p class="text-left slide-text h6 m-1 m-sm-3" id="s5-text-5">
                    <span class="dashicons dashicons-yes" id="s5-text-5-tick"></span>
                    <?php _e( 'Enjoy Your Purchase', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
            </div>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-6">
            <div class="slide-content position-relative text-left">
                <p class="slide-text h6 m-1 m-sm-3 mt-lg-5" id="s6-text-1">
                    <span class="dashicons dashicons-yes" id="s6-text-1-tick"></span>
		            <?php _e( 'Quality Goods', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
                <p class="slide-text h6 m-1 m-sm-3" id="s6-text-2">
                    <span class="dashicons dashicons-yes" id="s6-text-2-tick"></span>
		            <?php _e( 'From Reliable Producers', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
                <p class="slide-text h6 m-1 m-sm-3" id="s6-text-3">
                    <span class="dashicons dashicons-yes" id="s6-text-3-tick"></span>
		            <?php _e( 'Enjoy Your Purchase', VMBWPT_TEXT_DOMAIN ); ?>
                </p>
            </div>
			<img src="<?php echo $path; ?>/images/big/petrochemical_plant.jpg" alt="" class="d-block w-50" id="s6-img-1"/>
			<img src="<?php echo $path; ?>/images/big/petrochemical_plant_2.jpg" alt="" class="d-block w-50" id="s6-img-2"/>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-7">
            <div class="slide-content position-relative">
                <h2 class="slide-title text-white mt-lg-5" id="s7-title"><?php _e( 'Packagings', VMBWPT_TEXT_DOMAIN ); ?></h2>
            </div>
            <div class="slide-content position-relative mt-2">
                <p class="slide-text text-light h6 m-1 m-sm-3" id="s7-text-1"><?php _e( 'Bulk', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text text-light h6 m-1 m-sm-3" id="s7-text-2"><?php _e( 'Drums', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text text-light h6 m-1 m-sm-3" id="s7-text-3"><?php _e( 'Flexitanks', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text text-light h6 m-1 m-sm-3" id="s7-text-4"><?php _e( 'Jumbo Bags', VMBWPT_TEXT_DOMAIN ); ?></p>
            </div>
            <img src="<?php echo $path; ?>/images/big/train_tank.jpg" alt="" class="d-none d-sm-block" id="s7-img-1"/>
			<img src="<?php echo $path; ?>/images/big/truck.jpg" alt="" class="d-none d-sm-block" id="s7-img-2"/>
			<img src="<?php echo $path; ?>/images/big/ship_at_sea.jpg" alt="" class="d-none d-sm-block" id="s7-img-3"/>
			<img src="<?php echo $path; ?>/images/packing_bulk.png" alt="" class="d-none d-sm-block" id="s7-img-4"/>
			<img src="<?php echo $path; ?>/images/big/oil_drum.jpg" alt="" class="d-none d-sm-block" id="s7-img-5"/>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-8">
			<h2 class="slide-title mt-lg-5" id="s8-title"><?php _e( 'Land and Sea Routes', VMBWPT_TEXT_DOMAIN ); ?></h2>
			<img src="<?php echo $path; ?>/images/big/train.jpg" alt="" class="d-block" id="s8-img-1"/>
			<img src="<?php echo $path; ?>/images/big/ship_leaving_port.jpg" alt="" class="d-block" id="s8-img-2"/>
		</li>
		<li class="anim-slide p-1 p-sm-3 pt-5 pt-sm-5" id="slide-9">
            <div class="slide-content position-relative text-left">
                <p class="slide-text h6 m-1 m-sm-3 mt-lg-5" id="s9-text-1"><?php _e( 'What is your order?', VMBWPT_TEXT_DOMAIN ); ?></p>
                <p class="slide-text h6 m-1 m-sm-3" id="s9-text-2"><?php _e( 'Contact Us', VMBWPT_TEXT_DOMAIN ); ?></p>
            </div>
			<img src="<?php echo $path; ?>/images/phone.jpg" alt="" class="d-block" id="s9-img-1"/>
			<img src="<?php echo $path; ?>/images/contact.jpg" alt="" class="d-block" id="s9-img-2"/>
		</li>
		<nav class="anim-arrows">
			<span class="anim-arrows-prev d-none d-sm-block"></span>
			<span class="anim-arrows-next d-none d-sm-block"></span>
		</nav>
	</ul>
</div>

