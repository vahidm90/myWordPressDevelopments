<?php

/*
 * Template Name: Archive
 */

global $snt_supported_lang, $snt_lang, $snt_hct, $snt_nhct;

if ( have_posts() ) :
    while ( have_posts() ) :

        the_post();

		foreach ( array_merge( $snt_hct, $snt_nhct ) as $tax ) :
			if (
				empty( $snt_supported_lang[ $snt_lang ]['page-id'][ $tax->name ] ) ||
				$snt_supported_lang[ $snt_lang ]['page-id'][ $tax->name ] !== $id
			) :
				continue;
			endif;
			if ( $tax->hierarchical ) :
				get_template_part( 'inc/frontend/templates/pages/taxonomy', 'hierarchical' );
				continue 2;
			else :
				get_template_part( 'inc/frontend/templates/pages/taxonomy', 'non-hierarchical' );
				continue 2;
			endif;
		endforeach;

	    get_template_part( 'inc/frontend/templates/pages/archives' );

    endwhile;
endif;


