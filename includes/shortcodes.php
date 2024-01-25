<?php
/*
 * Created on   : Fri Sep 16 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// The [ng-app name="my-app" class="class"] shortcode
function angluarapp_div($atts, $content = null) {
    extract(shortcode_atts([
        'name'  => 'my-app',
        'class' => 'ng-scope',
        'style' => '',
        'id'    => '',
    ], $atts));

    $result = '<div';
    if (!empty($name))  $result .= ' ng-app="' . $name . '" ';
    if (!empty($class)) $result .= ' class="' . $class . '" ';
    if (!empty($style)) $result .= ' style="' . $style . '" ';
    if (!empty($id))    $result .= ' id="' . $id . '" ';
    $result .= '>';
    if (!empty($content)) $result .= $content . "</div>";
    return $result;
}
add_shortcode('ng-app', 'angluarapp_div');

// The [ng-locale-load locale="en-us"] shortcode
function angluarapp_load_locale($atts) {
    $current_setup = AangularJS_Plugin_Setup::instance();
    extract(shortcode_atts([
        'locale'  => 'en-us',
    ], $atts));
    if (!empty($locale) && file_exists(DJS_EXTENSIONS_PLUGIN_ASSETS_PATH . "/js/angularjs/" . $current_setup->get("angularjs_version") . "/i18n/angular-locale_" . $locale . ".js")) {
        wp_enqueue_script("angularjs-locale-shortcode", DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI . "/js/angularjs/" . $current_setup->get("angularjs_version") . "/i18n/angular-locale_" . $locale . ".js");
    }
}
add_shortcode('ng-locale-load', 'angluarapp_load_locale');


// The [ng-app-end] shortcode
function angluarapp_end_div() {
    return '</div>';
}
add_shortcode('ng-app-end', 'angluarapp_end_div');

// The [ng-form controller="my-controller" class="class"] shortcode
function angluarapp_form($atts, $content = null) {
    extract(shortcode_atts([
        'controller'    => 'my-controller',
        'name'          => 'my-form',
        'class'         => '',
        'style'         => '',
        'id'            => '',
    ], $atts));

    $result = '<form';
    if (!empty($name))          $result .= ' name="' . $name . '" ';
    if (!empty($controller))    $result .= ' ng-controller="' . $controller . '" ';
    if (!empty($class))         $result .= ' class="' . $class . '" ';
    if (!empty($style))         $result .= ' style="' . $style . '" ';
    if (!empty($id))            $result .= ' id="' . $id . '" ';
    $result .= '>';
    if (!empty($content))       $result .= $content . "</form>";
    return $result;
}
add_shortcode('ng-form', 'angluarapp_form');

// The [ng-form-end] shortcode
function angluarapp_end_form() {
    return '</form>';
}
add_shortcode('ng-form-end', 'angluarapp_end_form');
