<?php

require_once ("vendor/autoload.php");

if(class_exists("\modules\util\ClientScriptsStyles")){

  $styles = new \modules\util\ClientScriptsStyles();

    $styles->addStyles("custom-css", get_template_directory_uri() . "-child/style.css", array('aurum-main'));

  $styles->addMobileStyle('custom-mobile-css',
                          get_template_directory_uri() . "-child/assets/css/mobile.css",
                          array('custom-css'));

  $styles->addDesktopStyle('custom-desktop-css',
                           get_template_directory_uri() . "-child/assets/css/desktop.css",
                           array('custom-css'));

    $styles->addDesktopStyle('custom-desktop-css',
        get_template_directory_uri() . "-child/assets/css/home.css",
        array('custom-css'));
}
