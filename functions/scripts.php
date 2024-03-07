<?php
/*
 * Created on   : Fri Sep 16 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : scripts.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function extensions_plugin_styles() {
    $current_setup = Extensions_Plugin_Setup::instance();

    if($current_setup->get("symbolfonts_enabled")) {
        wp_enqueue_style("font-awesome",                    DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/font-awesome/css/all.min.css");
        wp_enqueue_style("icon_font-faces",                 DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/icon_font-faces.css");
    }

    wp_enqueue_style("extensions-font",                     DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/font.css");

    wp_enqueue_style("extensions-embed",                    DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/embed.css");
    wp_enqueue_style("extensions-popup",                    DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/popup.css");
    }
add_action('wp_enqueue_scripts', 'extensions_plugin_styles');

function extensions_plugin_scripts() {
    $current_setup = Extensions_Plugin_Setup::instance();

    wp_enqueue_script("extensions-popup",                               DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "/js/popup.js", ["jquery"]);


    if (!(defined("WP_ADMIN") && WP_ADMIN) && $current_setup->get("extensions_enabled")) {
        //TODO: Add Code
    }
}
add_action('wp_enqueue_scripts', 'extensions_plugin_scripts');
?>
