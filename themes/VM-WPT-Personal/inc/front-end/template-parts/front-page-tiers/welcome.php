<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="site-title p-1 px-5">
                <a href="<?php echo esc_url( home_url() ); ?>" class="text-decoration-none text-white">
                    <h1><?php bloginfo(); ?></h1>
                    <p class="lead"><?php bloginfo( 'description' ); ?></p>
                </a>
            </div>
        </div>
    </div>
</div>
<nav class="position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-before dashicons-arrow-down-alt2 d-block text-decoration-none"></a>
</nav>
<nav class="d-xl-none" id="fp-nav-items"><?php echo $menu; ?></nav>
