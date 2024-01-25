<?php
/*
 * Created on   : Fri Sep 16 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : scripts.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function angularjs_plugin_styles() {
    $current_setup = AangularJS_Plugin_Setup::instance();

    if($current_setup->get("symbolfonts_enabled")) {
        wp_enqueue_style("font-awesome",                    DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/font-awesome/css/all.min.css");
        wp_enqueue_style("icon_font-faces",                 DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/icon_font-faces.css");
    }

    if($current_setup->get("customcolor_enabled") != "#cccccc" || $current_setup->get("customtextcolor_enabled") != "#ffffff") {
        add_action('wp_head', 'widget_colorsettings');
    }

    wp_enqueue_style("angularjs-widget-area",               DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/widget-area.css");
    wp_enqueue_style("angularjs-font",                      DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "css/fonts/font.css");
}
add_action('wp_enqueue_scripts', 'angularjs_plugin_styles');

function angularjs_plugin_scripts() {
    $current_setup = AangularJS_Plugin_Setup::instance();

    if (!(defined("WP_ADMIN") && WP_ADMIN) && $current_setup->get("angularjs_enabled")) {
        wp_enqueue_script("angularjs",                      DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular.min.js");
        if ($current_setup->get("angularjslocal_enabled") && file_exists(DJS_EXTENSIONS_PLUGIN_ASSETS_PATH . "js/angularjs/" . $current_setup->get("angularjs_version") . "/i18n/angular-locale_" . str_replace("_", "-", $current_setup->get("angularjslocal")) . ".js")) {
            wp_enqueue_script("angularjs-locale",           DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/i18n/angular-locale_" . str_replace("_", "-", $current_setup->get("angularjslocal")) . ".js");
        }
        if ($current_setup->get("angular_animate_enabled")) {
            wp_enqueue_script("angularjs-animate",          DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-animate.min.js");
        }
        if ($current_setup->get("angular_aria_enabled")) {
            wp_enqueue_script("angularjs-aria",             DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-aria.min.js");
        }
        if ($current_setup->get("angular_cookies_enabled")) {
            wp_enqueue_script("angularjs-cookies",          DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-cookies.min.js");
        }
        if ($current_setup->get("angular_loader_enabled")) {
            wp_enqueue_script("angularjs-loader",           DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-loader.min.js");
        }
        if ($current_setup->get("angular_messages_enabled")) {
            wp_enqueue_script("angularjs-messages",         DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-messages.min.js");
        }
        if ($current_setup->get("angular_message_format_enabled")) {
            wp_enqueue_script("angularjs-message-format",   DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-message-format.min.js");
        }
        if ($current_setup->get("angular_mocks_enabled")) {
            wp_enqueue_script("angularjs-mocks",            DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-mocks.js");
        }
        if ($current_setup->get("angular_parse_ext_enabled")) {
            wp_enqueue_script("angularjs-parse-ext",        DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-parse-ext.min.js");
        }
        if ($current_setup->get("angular_resource_enabled")) {
            wp_enqueue_script("angularjs-resource",         DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-resource.min.js");
        }
        if ($current_setup->get("angular_route_enabled")) {
            wp_enqueue_script("angularjs-route",            DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-route.min.js");
        }
        if ($current_setup->get("angular_sanitize_enabled")) {
            wp_enqueue_script("angularjs-sanitize",         DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-sanitize.min.js");
        }
        if ($current_setup->get("angular_scenario_enabled")) {
            wp_enqueue_script("angularjs-scenario",         DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/1.2.32/angular-scenario.js");
        }
        if ($current_setup->get("angular_touch_enabled")) {
            wp_enqueue_script("angularjs-touch",            DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/" . $current_setup->get("angularjs_version") . "/angular-touch.min.js");
        }
        if ($current_setup->get("angular_uibootstrap_enabled")) {
            wp_enqueue_script("angularjs-uibootstrap",      DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "js/angularjs/ui-bootstrap-tpls-2.5.0.min.js");
        }
    }
}
add_action('wp_enqueue_scripts', 'angularjs_plugin_scripts');


function widget_colorsettings() {
    $current_setup = AangularJS_Plugin_Setup::instance(); ?>
    <style>
        <?php if ($current_setup->get("customcolor_enabled") != "#cccccc") { ?>
            .wallstreet.fixed-widget {
                background-color: <?php echo $current_setup->get("customcolor_enabled"); ?>;
            }
        <?php }
        if ($current_setup->get("customtextcolor_enabled") != "#ffffff") { ?>
            .wallstreet.fixed-widget,
            .wallstreet.fixed-widget button,
            .wallstreet.fixed-widget button:hover,
            .wallstreet.fixed-widget > div a,
            .wallstreet.fixed-widget > div a:hover {
                color: <?php echo $current_setup->get("customtextcolor_enabled"); ?>;
            }
        <?php } ?>
    </style>        
<?php } ?>
