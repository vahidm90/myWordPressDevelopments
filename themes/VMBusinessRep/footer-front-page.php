<div class="container-fluid" id="page-footer">
    <div class="row">
        <div class="col">
			<?php
            global $vmbwpt_lang;
			wp_nav_menu(
				array(
					'menu'       => VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['footer'],
					'items_wrap' => '<ul class="%2$s list-unstyled d-sm-flex flex-row justify-content-around my-3 my-sm-5" id="footer-menu">%3$s</ul>'
				)
			)
			?>
        </div>
    </div>
</div>
<?php

get_footer();