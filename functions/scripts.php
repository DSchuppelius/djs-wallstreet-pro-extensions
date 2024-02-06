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

    wp_enqueue_style("extensions-font",                      DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/font.css");
    }
add_action('wp_enqueue_scripts', 'extensions_plugin_styles');

function extensions_plugin_scripts() {
    $current_setup = Extensions_Plugin_Setup::instance();

    if (!(defined("WP_ADMIN") && WP_ADMIN) && $current_setup->get("extensions_enabled")) {
        //TODO: Add Code
        }
        if ($current_setup->get("angular_animate_enabled")) {
            wp_enqueue_script("angularjs-animate",          DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-animate.min.js");
        }
add_action('wp_enqueue_scripts', 'extensions_plugin_scripts');


?>
