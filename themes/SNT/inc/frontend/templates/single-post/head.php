<?php
//TODO: Add JSON-LD author info
//TODO: Add JSON-LD Site info
//TODO: Add JSON-LD Site logo
//TODO: Add RDFa and MicroData

global $snt_hct, $snt_nhct, $snt_comma;

$word_json = '';
$section = join(',', wp_get_post_terms( $id, 'topic', array( 'fields' => 'names' ) ) );
$words = array();
$desc = esc_attr( esc_html( get_post_meta( $id, 'desc_meta_data', TRUE ) ) );
$ttl = esc_html( get_the_title() );
$img = get_the_post_thumbnail_url( $id, 'full' );
$dat = get_the_time( 'c' );
$lnk = get_the_permalink();

foreach ( $snt_nhct as $tax ) :
	$words []= join( ',', wp_get_post_terms( $id, $tax->name, array( 'fields' => 'names' ) ) );
endforeach;
foreach ( $snt_hct as $tax ) :
	$words []= join( ',', wp_get_post_terms( $id, $tax->name, array( 'fields' => 'names' ) ) );
endforeach;

$word = join( ',', $words );

foreach ( explode( ',', $word ) as $item ) :
	$word_json .= '"' . $item . '",';
endforeach;

$word_json = '[' . substr( $word_json, 0, -1 ) . ']';

?><script type="application/ld+json">
    {
        "@context": "http://schema.org/",
        "@type": "NewsArticle",
        "mainEntityOfPage": { "@type": "WebPage","@id": "<?php echo $lnk; ?>" },
        "headline": "<?php echo $ttl; ?>",
        "url": "<?php echo $lnk; ?>",<?php

        if ( has_post_thumbnail() ) :

            ?>"image": { "@type": "ImageObject", "url": "<?php echo $img; ?>", },
            "thumbnailUrl": "<?php echo $img; ?>",<?php

        endif;

        ?>"dateCreated": "<?php echo $dat; ?>",
        "dateModified": "<?php the_modified_date( 'c' ) ?>",
        "datePublished": "<?php echo $dat; ?>",
        "publisher": { "@type": "Organization", "name": "<?php bloginfo( 'name' ); ?>" },
        "description": "<?php echo $desc; ?>",
        "articleSection": "<?php echo $section; ?>",
        "keywords": <?php echo $word_json; ?>,
        "identifier": "<?php echo wp_get_shortlink(); ?>"
    }
</script>
<meta name="description" content="<?php echo $desc; ?>" />
<meta name="keywords" content="<?php echo $word; ?>" /><?php
