<?php
/*
 *  Template Name: TV Series
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
                    <?php _ex('TV Series', 'Tier item', 'vmp-en'); ?>
                </a>
            </h1>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-xl-3 col-md-6">
            <div class="card" id="tvs-0">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_05.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Pand-e Parsi</span></p>
                    <p class="card-text">2015</p>
                    <p class="card-text">Producer: Rasoul Shiri</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Masoud Aslani</p>
                    <p class="card-text">39 Episode X 10 min</p>
                    <p class="card-text">In progress</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="tvs-1">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_14.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Chel Morq</span></p>
                    <p class="card-text">2010</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Samira Khosrojerdi</p>
                    <p class="card-text">13 Episode X 10 min</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="tvs-2">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/portfolio-image_13.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Milad's Kids</span></p>
                    <p class="card-text">2016</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Masoud Aslani, Amir Tajasosi</p>
                    <p class="card-text">39 Episode X 8 min</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="tvs-3">
                <img class="card-img-top w-100" src="<?php echo $path; ?>/img/unnamed.jpg">
                <div class="card-body">
                    <p class="card-title"><span>Fun Farm</span></p>
                    <p class="card-text">2012</p>
                    <p class="card-text">Director: Rasoul Shiri</p>
                    <p class="card-text">Screenplay: Masoud Aslani</p>
                    <p class="card-text">60 Episode X 6 min</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer('custom-template');
