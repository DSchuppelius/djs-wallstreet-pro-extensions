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
        if ((!isset($_COOKIE["scriptconsent_estatus"])) && !isWebBot()) {
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

    add_action('wp_footer', function() {
        echo '<button id="cookie-settings" class="not cookie-settings-btn material-icons"
                    onclick="toggleScriptConsent();">cookie</button>';
    });

function show_scriptconsent() {
    $setup       = Extensions_Plugin_Setup::instance();
    $actual_link = esc_url(home_url(add_query_arg(null, null)));

    // nur beim ersten Mal direkt öffnen
    $is_first    = (!isset($_COOKIE["scriptconsent_estatus"])) && !isWebBot();
    $open_class  = $is_first ? ' open' : '';

    echo '<div id="script_fullscreen" class="' . $open_class . '" role="dialog" aria-labelledby="script_title">';

    echo '<div class="title_row">';
    echo '<h3 id="script_title">' . esc_html__("Third-party scripts", DJS_EXTENSIONS_PLUGIN) . '</h3>';
    echo '<button type="button" class="not close material-icons"
                    aria-label="' . esc_attr__("Close", DJS_EXTENSIONS_PLUGIN) . '"
                    onclick="closeScriptConsent();">close</button>';
    echo '</div>';

    echo '<p>' . wp_kses_post($setup->get("script_before")) . '</p>';

    echo '<form class="script center" action="' . $actual_link . '">';
    echo '<button class="btn ok" type="button" onclick="allowScriptConsent();">'
       . esc_html($setup->get("script_link")) . '</button> ';
    echo '<button class="btn no" type="button" onclick="dismissScriptConsent();">'
       . esc_html($setup->get("noscript_link")) . '</button>';

    if ($setup->get("cookieconsent_enabled")) {
        echo '<div class="footer_row">';
        echo '<button class="btn all-ok"
                      title="' . esc_attr($setup->get("script_cookie_link")) . '"
                      type="button" onclick="allowAllConsent();">'
           . mb_encode_numericentity($setup->get("script_cookie_link"), [0x80, 0x10FFFF, 0, 0x10FFFF], "UTF-8")
           . '</button> ';

               echo '<button class="btn all-no"
                  title="' . esc_attr($setup->get("script_cookie_nolink")) . '"
                  type="button" onclick="denyAllConsent();">'
       . mb_encode_numericentity($setup->get("script_cookie_nolink"), [0x80, 0x10FFFF, 0, 0x10FFFF], "UTF-8")
       . '</button>';
        echo '</div>';
    }

    echo '</form>';
    echo '</div>';
}

    add_action('wp_footer', 'show_scriptconsent');
}