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

    function show_scriptconsent(){
        $current_setup = Extensions_Plugin_Setup::instance();
        $actual_link = get_the_currentURL();
        echo '<div id="script_fullscreen" class="open"><div class="title_row"><h3>'. esc_html__("Third-party scripts", DJS_EXTENSIONS_PLUGIN).'</h3><button type="button" class="not close material-icons">close</button></div><p>' . mb_convert_encoding($current_setup->get("script_before"), 'HTML-ENTITIES') . '</p>';
        echo '<form class="script center" action="' . $actual_link . '"><button class="btn ok" onclick="document.cookie=\'scriptconsent_estatus=allow;path=/;SameSite=Lax\'; location.reload(true);" type="button">' . mb_convert_encoding($current_setup->get("script_link"), 'HTML-ENTITIES') . '</button> <button class="btn no" onclick="document.cookie=\'scriptconsent_estatus=dismiss;path=/;SameSite=Lax\'; location.reload(true);" type="button">' . mb_convert_encoding($current_setup->get("noscript_link"), 'HTML-ENTITIES') . '</button></form>';
        echo "</div>";
    }
}
