<?php

get_header( 'front-page' );

?><main>
    <section class="part-fp">
        <div class="container">
            <div class="row">
                <div class="col-sn-12"><?php get_template_part( 'inc/frontend/templates/front-page/grp', 'lead' ); ?></div>
            </div>
        </div>
    </section>
    <section class="part-fp">
        <div class="container">
            <div class="row">
                <div class="col-sn-12"><?php get_template_part( 'inc/frontend/templates/front-page/grp', 'regs' ); ?></div>
            </div>
        </div>
    </section>
    <section class="part-fp">
        <div class="container">
            <div class="row">
                <div class="col-sn-12"><?php get_template_part( 'inc/frontend/templates/front-page/grp', 'ana' ); ?></div>
            </div>
        </div>
    </section>
    <section class="part-fp">
        <div class="container">
            <div class="row">
                <div class="col-sn-12"><?php get_template_part( 'inc/frontend/templates/front-page/grp', 'topics' ); ?></div>
            </div>
        </div>
    </section>
</main><?php

get_footer( 'front-page' );