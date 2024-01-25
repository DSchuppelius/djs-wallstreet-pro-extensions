<?php
/*
 * Created on   : Fri Sep 16 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

require_once "shortcodes_div.php";
require_once "shortcodes_jetpack.php";

function ageOF($atts, $content = null) {
    $current_setup = Extensions_Plugin_Setup::instance();

    if($current_setup->is_djs_wallstreet_pro_theme)
        $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

    extract(shortcode_atts([
        'begin' => '', /* See post for date formats */
        'end' => 'now', /* See post for date formats */
        'date' => false,
        'month' => false,
        'dateformat' => $current_setup->get("fulldateformat"),
        'ageformat' => '%y', /* http://php.net/manual/en/function.date.php */
        'fullageformat' => esc_html__('%y year(s) - %m month', DJS_EXTENSIONS_PLUGIN) /* http://php.net/manual/en/function.date.php */

    ], $atts));

    $from_date = null;
    $to_date = null;

    if (empty($begin) && strtotime($content)) $begin = $content;
    if (empty($end) || $end == "now") $to_date = new DateTime();

    $from_date = new DateTime($begin);
    $age = $from_date->diff($to_date);

    return $date ? sprintf("%s - %s (%s)", $from_date->format($dateformat), $to_date->format($dateformat), $age->format($fullageformat)) : $age->format($ageformat);
}
add_shortcode('age', 'ageOF');

function year_shortcode () {
    $year = date_i18n ('Y');
    return $year;
}
add_shortcode ('year', 'year_shortcode');
