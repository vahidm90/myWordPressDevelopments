<?php

get_header( 'front-page' );
//TODO: Get tiers from the theme customizer.
//TODO: Complete the navigation bar items/markup.

?>
<section class="fp-tier position-relative text-white vh-100 w-100" id="fp-tier-0" data-tier-no="0">
	<?php get_template_part( 'inc/front/template-parts/front-page-tiers/tier', '0' ); ?>
</section>
<section class="fp-tier position-relative vh-100 w-100" id="fp-tier-1" data-tier-no="1">
	<?php get_template_part( 'inc/front/template-parts/front-page-tiers/tier', '1' ); ?>
</section>
<section class="fp-tier position-relative w-100" id="fp-tier-2" data-tier-no="2">
	<?php get_template_part( 'inc/front/template-parts/front-page-tiers/tier', '2' ); ?>
</section>
<section class="fp-tier position-relative w-100" id="fp-tier-3" data-tier-no="3">
	<?php get_template_part( 'inc/front/template-parts/front-page-tiers/tier', '3' ); ?>
</section>
<?php get_footer(); ?>
