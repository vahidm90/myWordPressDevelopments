<?php

$s_q = esc_attr( get_search_query( FALSE ) ); 

?><form role="search" action="<?php echo home_url('/'); ?>" id="form-search">
	<input type="search" name="s" title="Search" value="<?php echo $s_q; ?>" class="in-search"/>
    <button class="snt-icon-before snt-search"></button>
</form>