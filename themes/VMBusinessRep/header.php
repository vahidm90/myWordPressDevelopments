<?php

global $vmbwpt_lang;

$path = get_template_directory_uri() . '/assets';

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); //TODO: Set fonts based on language. ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript">
        /* grunticon Stylesheet Loader | https://github.com/filamentgroup/grunticon | (c) 2012 Scott Jehl, Filament Group, Inc. | MIT license. */
        // Selects the correct stylesheet based on feature detects
        window.grunticon=function(e){if(e&&3===e.length){var t=window,n=!(!t.document.createElementNS||!t.document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||window.opera&&-1===navigator.userAgent.indexOf("Chrome")),o=function(o){var r=t.document.createElement("link"),a=t.document.getElementsByTagName("script")[0];r.rel="stylesheet",r.href=e[o&&n?0:o?1:2],a.parentNode.insertBefore(r,a)},r=new t.Image;r.onerror=function(){o(!1)},r.onload=function(){o(1===r.width&&1===r.height)},r.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="}};
        // Point to style sheet locations
        grunticon( [ "<?php echo $path; ?>/jQuery/jquery.mobile.inline-svg-1.4.5.min.css","<?php echo $path; ?>/jQuery/jquery.mobile.inline-png-1.4.5.min.css","<?php echo $path; ?>/jQuery/jquery.mobile.external-png-1.4.5.min.css" ] );
    </script>
    <noscript id="grunticon-fallback">
        <link href="<?php echo $path; ?>/jQuery/jquery.mobile.icons-1.4.5.min.css" rel="stylesheet">
    </noscript>
