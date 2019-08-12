<?php
/*
 *  Template Name: TV Commercials
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
<div class="tier" id="home">
    <div class="container tier-content">
        <div class="row">
            <div class="col-12">
                <h1>
                    <a href="#home">
                        <?php _ex('TV Commercials', 'Tier item', 'vmp-en'); ?>
                    </a>
                </h1>
            </div>
            <div class="col-md-6">
                <div class="img-div d-md-flex align-items-md-center">
                    <img src="<?php echo $path; ?>/img/portfolio-image_06.jpg" class="w-100" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="txt-div d-md-flex align-items-md-center">
                    <p class="tier-text text-md-right text-center">Teaser for Salamat Film Festival/2015</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tier" id="tvc-1">
    <div class="container tier-content">
        <div class="row">
            <div class="col-md-6">
                <div class="img-div d-md-flex align-items-md-center">
                    <img src="<?php echo $path; ?>/img/portfolio-image_10.jpg" class="w-100" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="txt-div d-md-flex align-items-md-center">
                    <p class="tier-text text-md-right text-center">Application Commercial/2015/QULVE app</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tier" id="tvc-2">
    <div class="container tier-content">
        <div class="row">
            <div class="col-md-6">
                <div class="img-div d-md-flex align-items-md-center">
                    <img src="<?php echo $path; ?>/img/roozaneh.jpg" class="w-100" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="txt-div d-md-flex align-items-md-center">
                    <p class="tier-text text-md-right text-center">Bell ROUZANEH CO. /2017/TV Commercial</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer('custom-template');
