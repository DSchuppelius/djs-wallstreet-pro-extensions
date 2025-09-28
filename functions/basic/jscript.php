<?php
/*
 * Created on   : Wed Apr 22 2023
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : jscript.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
$current_setup = Extensions_Plugin_Setup::instance();

if ($current_setup->get("scriptconsent_enabled")) {
    function script_cookie_lazy_load() {
        $wp_scripts = wp_scripts();
        if ((!isset($_COOKIE["scriptconsent_estatus"]) || $_COOKIE["scriptconsent_estatus"] != "allow") && !isWebBot()) {
            foreach ($wp_scripts->registered as $jscript) {
                if (!$jscript->src || str_contains($jscript->src, $_SERVER["HTTP_HOST"]) || str_starts_with($jscript->src, "/"))
                    continue;
                wp_deregister_script($jscript->handle);
                if(!isset($_COOKIE["scriptconsent_estatus"]))
                    add_action('wp_footer', 'show_scriptconsent');
            }
        }
    }
    add_action("wp_enqueue_scripts", "script_cookie_lazy_load", 15);

function show_scriptconsent() {
    $current_setup = Extensions_Plugin_Setup::instance();
    $actual_link = esc_url( home_url( add_query_arg( null, null ) ) );

    // Öffnen des Containers
    echo '<div id="script_fullscreen" class="open" role="dialog" aria-labelledby="script_title">';

    // Titelzeile
    echo '<div class="title_row">';
    echo '<h3 id="script_title">' . esc_html__("Third-party scripts", DJS_EXTENSIONS_PLUGIN) . '</h3>';
    echo '<button type="button" class="not close material-icons" aria-label="' . esc_attr__("Close", DJS_EXTENSIONS_PLUGIN) . '" onclick="document.getElementById(\'script_fullscreen\').classList.remove(\'open\'); document.cookie=\'scriptconsent_estatus=dismiss;path=/;SameSite=Lax' . (is_ssl() ? ';Secure' : '') . '\';">close</button>';
    echo '</div>';

    // Beschreibung
    echo '<p>' . wp_kses_post($current_setup->get("script_before")) . '</p>';

    // Formular
    echo '<form class="script center" action="' . esc_url($actual_link) . '">';

    // "Erlauben"-Button
    echo '<button class="btn ok" type="button" onclick="document.cookie=\'scriptconsent_estatus=allow;path=/;SameSite=Lax' . (is_ssl() ? ';Secure' : '') . '\'; location.reload(true);">';
    echo esc_html($current_setup->get("script_link"));
    echo '</button> ';

    // "Ablehnen"-Button
    echo '<button class="btn no" type="button" onclick="document.cookie=\'scriptconsent_estatus=dismiss;path=/;SameSite=Lax' . (is_ssl() ? ';Secure' : '') . '\'; document.getElementById(\'script_fullscreen\').classList.remove(\'open\');">';
    echo esc_html($current_setup->get("noscript_link"));
    echo '</button>';
    echo '<button class="btn all-ok" onclick="document.cookie=\'cookieconsent_estatus=allow;path=/;SameSite=Lax' . (is_ssl() ? ';Secure' : '') . '\'; document.cookie=\'scriptconsent_estatus=dismiss;path=/;SameSite=Lax' . (is_ssl() ? ';Secure' : '') . '\'; location.reload(true);" type="button">' . mb_encode_numericentity($current_setup->get("script_cookie_link"), [0x80, 0x10FFFF, 0, 0x10FFFF], "UTF-8") . '</button>';
    // Formular schließen
    echo '</form>';

    // Container schließen
    echo '</div>';
}

}