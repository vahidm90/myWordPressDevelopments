<?php

$posts_roll = '';
if ( have_posts() ) :
	while ( have_posts() ) :

		the_post();

        $html = vm_get_post_markup_array( $id );

		$img_html   = '';
		$img_col    = '';
		$img_offset = '';

		if ( $html['img_url'] ) :
			$img_col    = ' col-lg-9';
			$img_offset = ' offset-lg-3 col-lg-9';
			$img_html   = <<<html
<div class='col-12 col-lg-3'>
    <img src='{$html['img_url']}' class='post-image img-fluid my-3' alt='{$html['title_attr']}' />
</div>
html;
		endif;

		$posts_roll .= <<<html
<a href="{$html['link']}" title="{$html['title_attr']}" class="post-link text-decoration-none text-secondary">
	<article class="{$html['classes']} py-2">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<header class="d-none d-lg-block">
						<div class="container-fluid">
							<div class="row">
								$img_html
								<div class="col-12$img_col">
									<small class="post-category d-block">{$html['category']}</small>
									<h3 class="post-title">{$html['title']}</h3>
									<time datetime="{$html['iso_time']}" class="small d-block">{$html['rel_time']}</time>
								</div>
							</div>
						</div>
					</header>
					<header class="d-lg-none">
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<small class="post-category d-block">{$html['category']}</small>
									<h3 class="post-title">{$html['title']}</h3>
									<time datetime="{$html['iso_time']}" class="small d-block">{$html['rel_time']}</time>
								</div>
								$img_html
							</div>
						</div>
					</header>
				</div>
				<div class="col-12$img_offset">
					<div class="container">
						<div class="row">
							<div class="col-12"><p class="post-excerpt">{$html['excerpt']}</p></div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</article>
</a>
html;

	endwhile;
endif;

?>
<div class="tier-wrap d-flex flex-column h-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="tier-title display-4 mt-3">
					<?php _ex( 'Recently Published', 'Posts roll title; front-page tier title', VM_TD ); ?>
				</h2>
			</div>
		</div>
	</div>
	<div class="post-roll flex-grow-1 ml-3 ml-lg-0">
		<div class="container">
			<div class="row">
				<div class="col-12"><?php echo $posts_roll; ?></div>
			</div>
		</div>
	</div>
</div>
