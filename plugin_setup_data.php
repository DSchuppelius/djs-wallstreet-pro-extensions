<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : plugin_setup_data.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class Extensions_Plugin_Setup extends Plugin_Setup {
    // @return plugin|null
    public static function instance() {
        // Store the instance locally to avoid private static replication
        static $instance = null;

        // Only run these methods if they haven't been ran previously
        if (null === $instance) {
            $instance = new Extensions_Plugin_Setup();
            $instance->load_current_setup();
        }

        // Always return the instance
        return $instance;
    }

    protected function get_initial_setup() {
        return [
            "contact_email_number_one" => "info@schuppelius.org",

            "fulldateformat" => "jS F Y",

            "cookieconsent_enabled" => false,
            "scriptconsent_enabled" => false,

            "symbolfonts_enabled" => false,

            "cookie_before" => "This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:" . ' <a href="/imprint">Imprint</a>, <a href="/privacy_policy">Privacy policy"</a>. Do you have any further questions on this topic? Write me via the <a href="/contact">contact form</a> or by e-mail (<a href="mailto:info@schuppelius.org" >info@schuppelius.org</a>)',
            "cookie_link" => "Yes, I would like to activate the content on this page...",
            "cookie_after" => "Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.",

            "script_before" => 'This site uses third-party program code that may allow conclusions to be drawn about your user behavior. Some of these program codes are loaded from external servers. We use this code to determine what content is of interest to you or to make the behavior and appearance of this website more pleasant for you. Would you like to support us and unlock these external scripts and styles? You can find more information about the use of data on these websites on the following pages: <a href="/imprint">Imprint</a>, <a href="/privacy_policy">Privacy policy</a>. Do you have any further questions on this topic? Write me via the <a href="/"contact">contact form</a> or by e-mail (<a href="mailto:info@schuppelius.org" >info@schuppelius.org</a>)',
            "script_link" => "Yes, I would like to activate the external scripts on this page...",
            "noscript_link" => "No, I do not like to activate the external scripts on this page...",
            "script_cookie_link" => "I want to accept the third-party cookies and the external scripts.",
        ];
    }

    protected function get_translated_setup() {
        return [
            "fulldateformat" => esc_html__("jS F Y", DJS_EXTENSIONS_PLUGIN),

            "cookie_before" => esc_html__("This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:", DJS_EXTENSIONS_PLUGIN) . ' <a href="/' . urlencode(strtolower(esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN) . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN)))) . '">' . esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN) . '</a>. ' . esc_html__("Do you have any further questions on this topic? Write me via the", DJS_EXTENSIONS_PLUGIN).' <a href="/' . urlencode(strtolower(esc_html__("contact", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("contact form", DJS_EXTENSIONS_PLUGIN) . '</a> ' . esc_html__("or by e-mail", DJS_EXTENSIONS_PLUGIN) . ' (<a href="mailto:info@schuppelius.org" >info@schuppelius.org</a>)',
            "cookie_link" => esc_html__("Yes, I would like to activate the content on this page...", DJS_EXTENSIONS_PLUGIN),
            "cookie_after" => esc_html__("Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.", DJS_EXTENSIONS_PLUGIN),

            "script_before" => esc_html__("This site uses third-party program code that may allow conclusions to be drawn about your user behavior. Some of these program codes are loaded from external servers. We use this code to determine what content is of interest to you or to make the behavior and appearance of this website more pleasant for you. Would you like to support us and unlock these external scripts and styles? You can find more information about the use of data on these websites on the following pages:", DJS_EXTENSIONS_PLUGIN) . ' <a href="/' . urlencode(strtolower(esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN) . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN)))) . '">' . esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN) . '</a>. ' . esc_html__("Do you have any further questions on this topic? Write me via the", DJS_EXTENSIONS_PLUGIN).' <a href="/' . urlencode(strtolower(esc_html__("contact", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("contact form", DJS_EXTENSIONS_PLUGIN) . '</a> ' . esc_html__("or by e-mail", DJS_EXTENSIONS_PLUGIN) . ' (<a href="mailto:info@schuppelius.org" >info@schuppelius.org</a>)',
            "script_link" => esc_html__("Yes, I would like to activate the external scripts on this page...", DJS_EXTENSIONS_PLUGIN),
            "noscript_link" => esc_html__("No, I do not like to activate the external scripts on this page...", DJS_EXTENSIONS_PLUGIN),
            "script_cookie_link" => esc_html__("I want to accept the third-party cookies and the external scripts.", DJS_EXTENSIONS_PLUGIN),
        ];
    }
}
?>