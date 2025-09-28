<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-copyright.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class Plugin_Extension_Copyright_Customizer extends Plugin_Customizer {
    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("wallstreet_copyright_setting", [
            "priority" => 900,
            "capability" => "edit_theme_options",
            "title" => esc_html__("Copyright and disclaimer settings", DJS_EXTENSIONS_PLUGIN),
        ]);
    }

    public function customize_register_section($wp_customize) {
        $wp_customize->add_section("cookie_section", [
            "title" => esc_html__("Cookie settings", DJS_EXTENSIONS_PLUGIN),
            "priority" => 35,
            "panel" => "wallstreet_copyright_setting",
        ]);

        $wp_customize->add_section("script_section", [
            "title" => esc_html__("Thirdparty Script settings", DJS_EXTENSIONS_PLUGIN),
            "priority" => 35,
            "panel" => "wallstreet_copyright_setting",
        ]);
    }

    public function customize_register_settings_and_controls($wp_customize) {
        $current_setup = Extensions_Plugin_Setup::instance();

        if($this->is_djs_wallstreet_pro_theme)
            $current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

        $wp_customize->add_setting($this->theme_options_name . "[cookieconsent_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookieconsent_enabled]", [
            "label" => esc_html__("Enable cookie consent", DJS_EXTENSIONS_PLUGIN),
            "section" => "cookie_section",
            "type" => "checkbox",
            "priority" => 100,
            "description" => esc_html__("enable if you want a cookie disclaimer on iframe media", DJS_EXTENSIONS_PLUGIN),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_before]", [
            "default" => esc_html__("This hidden content may leave traces of third-party vendors on your computer when activated. Perhaps your user behavior could be analyzed via these traces. Please confirm the execution of the content by clicking on the button. On the following pages you can view further information on the use of data on this website:", DJS_EXTENSIONS_PLUGIN) . ' <a href="/' . urlencode(strtolower(esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN) . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN)))) . '">' . esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN) . '</a>. ' . esc_html__("Do you have any further questions on this topic? Write me via the", DJS_EXTENSIONS_PLUGIN).' <a href="/' . urlencode(strtolower(esc_html__("contact", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("contact form", DJS_EXTENSIONS_PLUGIN) . '</a> ' . esc_html__("or by e-mail", DJS_EXTENSIONS_PLUGIN) . ' (<a href="mailto:' . $current_setup->get("contact_email_number_one") . '" >' . $current_setup->get("contact_email_number_one") . "</a>)",
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_before]", [
            "label" => esc_html__("Cookietext before button", DJS_EXTENSIONS_PLUGIN),
            "section" => "cookie_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_link]", [
            "default" => esc_html__("Yes, I would like to activate the content on this page...", DJS_EXTENSIONS_PLUGIN),
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_link]", [
            "label" => esc_html__("Buttontext", DJS_EXTENSIONS_PLUGIN),
            "section" => "cookie_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[cookie_after]", [
            "default" => esc_html__("Furthermore, you are aware that by activating the content, cookies can be set by third parties. In addition, you are aware that your data processing system interacts with the third-party service. This means that information from your system is transmitted to the third-party provider. If you follow the link below, cookies will probably also be set and data exchanged on the target website.", DJS_EXTENSIONS_PLUGIN),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[cookie_after]", [
            "label" => esc_html__("Cookietext after button", DJS_EXTENSIONS_PLUGIN),
            "section" => "cookie_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[scriptconsent_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[scriptconsent_enabled]", [
            "label" => esc_html__("Enable script consent", DJS_EXTENSIONS_PLUGIN),
            "section" => "script_section",
            "type" => "checkbox",
            "priority" => 100,
            "description" => esc_html__("enable if you want a disclaimer on external scripts", DJS_EXTENSIONS_PLUGIN),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[script_before]", [
            "default" => esc_html__("This site uses third-party program code that may allow conclusions to be drawn about your user behavior. Some of these program codes are loaded from external servers. We use this code to determine what content is of interest to you or to make the behavior and appearance of this website more pleasant for you. Would you like to support us and unlock these external scripts and styles? You can find more information about the use of data on these websites on the following pages:", DJS_EXTENSIONS_PLUGIN) . ' <a href="/' . urlencode(strtolower(esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("Imprint", DJS_EXTENSIONS_PLUGIN) . '</a>, <a href="/' . urlencode(remove_umlaut(strtolower(esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN)))) . '">' . esc_html__("Privacy policy", DJS_EXTENSIONS_PLUGIN) . '</a>. ' . esc_html__("Do you have any further questions on this topic? Write me via the", DJS_EXTENSIONS_PLUGIN).' <a href="/' . urlencode(strtolower(esc_html__("contact", DJS_EXTENSIONS_PLUGIN))) . '">' . esc_html__("contact form", DJS_EXTENSIONS_PLUGIN) . '</a> ' . esc_html__("or by e-mail", DJS_EXTENSIONS_PLUGIN) . ' (<a href="mailto:' . $current_setup->get("contact_email_number_one") . '" >' . $current_setup->get("contact_email_number_one") . "</a>)",
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[script_before]", [
            "label" => esc_html__("Load scripts question", DJS_EXTENSIONS_PLUGIN),
            "section" => "script_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[script_link]", [
            "default" => esc_html__("Yes, I would like to activate the external scripts on this page...", DJS_EXTENSIONS_PLUGIN),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[script_link]", [
            "label" => esc_html__("Load external Skripts", DJS_EXTENSIONS_PLUGIN),
            "section" => "script_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[noscript_link]", [
            "default" => esc_html__("No, I do not like to activate the external scripts on this page...", DJS_EXTENSIONS_PLUGIN),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[noscript_link]", [
            "label" => esc_html__("No external Skripts", DJS_EXTENSIONS_PLUGIN),
            "section" => "script_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[script_cookie_link]", [
            "default" => esc_html__("Yes, I want to accept the third-party cookies, the external content and the external scripts.", DJS_EXTENSIONS_PLUGIN),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[script_cookie_link]", [
            "label" => esc_html__("Accept third-party cookies, external content and external scripts", DJS_EXTENSIONS_PLUGIN),
            "section" => "script_section",
            "type" => "textarea",
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[script_cookie_nolink]", [
            "default" => esc_html__("No, I do not want to accept the third-party cookies, the external content and the external scripts.", DJS_EXTENSIONS_PLUGIN),
            "sanitize_callback" => "sanitize_link_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[script_cookie_nolink]", [
            "label" => esc_html__("Decline third-party cookies, external content and external scripts", DJS_EXTENSIONS_PLUGIN),
            "section" => "script_section",
            "type" => "textarea",
        ]);

    }
} ?>