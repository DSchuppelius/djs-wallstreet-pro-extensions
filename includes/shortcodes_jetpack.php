<?php
/*
 * Created on   : Tue Sep 20 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes_jetpack.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// The [jp_bf_count class="class"] shortcode
function jetpack_bruteforce_counter($atts, $content=null) {
    extract(shortcode_atts([
        'class' => 'widget blog-stats',
        'style' => '',
        'id'    => '',
    ], $atts));

    $result = '<div';
    if (!empty($style)) $result .= ' style="'.$style . '" ';
    if (!empty($class)) $result .= ' class="'.$class . '" ';
    if (!empty($id))    $result .= ' id="'.$id . '" ';
    $result .= '><ul><li>';
    if(!empty($content)) $result .= $content;

    if(is_plugin_active('jetpack/jetpack.php')) {
        if (Jetpack::is_module_active('protect')) {
            $result .= esc_html(number_format_i18n(get_site_option('jetpack_protect_blocked_attempts', 0))) . " " . esc_html__("visits", "djs-wallstreet-pro");
        } else {
            $result .= esc_html__("not enabled", "djs-wallstreet-pro");
        }
    } else {
        $result .= esc_html__("nonexistent", "djs-wallstreet-pro");
    }

    return $result . "</li></ul></div>";
}
add_shortcode('jp_bf_count', 'jetpack_bruteforce_counter');

// The [ak_spam_count class="class"] shortcode
function akismet_spam_counter($atts, $content=null) {
    extract(shortcode_atts([
        'class' => 'widget blog-stats',
        'style' => '',
        'id'    => '',
    ], $atts));

    $result = '<div';
    if (!empty($style)) $result .= ' style="'.$style . '" ';
    if (!empty($class)) $result .= ' class="'.$class . '" ';
    if (!empty($id))    $result .= ' id="'.$id . '" ';
    $result .= '><ul><li>';
    if(!empty($content)) $result .= $content;

    if(is_plugin_active('akismet/akismet.php')) {
        $result .= esc_html(number_format_i18n(get_site_option('akismet_spam_count', 0))) . " " . esc_html__("messages", "djs-wallstreet-pro");
    } else {
        $result .= esc_html__("nonexistent", "djs-wallstreet-pro");
    }

    return $result . "</li></ul></div>";
}
add_shortcode('ak_spam_count', 'akismet_spam_counter');
