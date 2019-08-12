<?php
/*
 *  Template Name: Animated Short Series
 */

$path = get_template_directory_uri() . '/assets';

get_header('custom-template');
?>
<nav class="navbar navbar-expand-lg navbar-light" id="static-top-bar">
    <a class="navbar-brand" href="<?php echo home_url(); ?>" title="Home">Rasoul Shiri</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-bar-items" aria-controls="top-bar-items" aria-label="Toggle Navigation Menu" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-lg-end" id="top-bar-items">
        <a class="nav-link" href="<?php echo home_url(); ?>#animation">Animation</a>
        <a class="nav-link" href="<?php echo home_url(); ?>#sketch">Sketch</a>
        <a class="nav-link" href="<?php echo home_url(); ?>#char-design">Character Design</a>
        <a class="nav-link" href="<?php echo home_url(); ?>#short-animation">Short Animation</a>
        <a class="nav-link" href="<?php echo home_url(); ?>#about">About</a>
        <a class="nav-link" href="<?php echo home_url(); ?>#contact">Contact</a>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>
                <a href="#">
                    <?php _ex('Animated Short Series', 'Tier item', 'vmp-en'); ?>
                </a>
            </h1>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-xl-3 col-md-6">
            <div class="card" id="anime-ss-0">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_15.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Happy New Year</span></p>
                    <p class="card-text">2011</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Rasoul Shiri</p>
                    <p class="card-text">13 Episode X 1 min</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="anime-ss-1">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_11.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Qoolqooti</span></p>
                    <p class="card-text">2017</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Ahmad Reza Kazemi</p>
                    <p class="card-text">20 Episode X 1':30"</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="anime-ss-2">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_02.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Net Soltan</span></p>
                    <p class="card-text">2016</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Masoud Aslani, Amir Tajasosi</p>
                    <p class="card-text">30 Episode X 1 min</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="anime-ss-3">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_03.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Human</span></p>
                    <p class="card-text">2018</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Rasoul Shiri, Masoud Aslani</p>
                    <p class="card-text">100 Episode X 30 sec</p>
                    <p class="card-text">In Progress</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer('custom-template');
