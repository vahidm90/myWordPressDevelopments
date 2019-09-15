<?php  get_header();  ?>
<div class="w-100 vh-100 position-relative overflow-hidden" id="welcome">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-title p-1 px-5">
                    <a href="<?php echo esc_url(home_url()); ?>" class="text-decoration-none text-white">
                        <h1><?php bloginfo(); ?></h1>
                        <p class="lead"><?php bloginfo( 'description' ); ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <a href="#categories"
       class="dashicons-before dashicons-arrow-down-alt2 position-absolute d-block text-decoration-none"
       id="scroll-down"></a>
</div>
<div id="categories"><?php get_template_part( '/inc/template-parts/categories'); ?></div>
<?php get_footer(); ?>
