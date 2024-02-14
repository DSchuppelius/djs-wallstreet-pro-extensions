<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-global.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class Plugin_Extension_Global_Customizer extends Plugin_Customizer {
    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("extension_panel_settings", [
            "title" => esc_html__("Extension options", DJS_EXTENSIONS_PLUGIN),
            "description" => "",
        ]);
    }

    public function customize_register_section($wp_customize) {
        if (!$this->is_djs_wallstreet_pro_theme) {
            $wp_customize->add_section("extensionfont_section_settings", [
                "title" => esc_html__("Font settings", DJS_EXTENSIONS_PLUGIN),
                "panel" => "extension_panel_settings",
                "description" => "",
            ]);
        }
    }

    public function customize_register_settings_and_controls($wp_customize) {
        if (!$this->is_djs_wallstreet_pro_theme) {            
            $this->register_symolicfontcontrols($wp_customize);
        }

    }

    private function register_symolicfontcontrols($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[symbolfonts_enabled]", [
            "default" => $this->is_djs_wallstreet_pro_theme,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[symbolfonts_enabled]", [
            "label" => esc_html__("Load symbolic fonts", DJS_EXTENSIONS_PLUGIN),
            "section" => "extensionfont_section_settings",
            "type" => "checkbox",
            "priority" => 100,
            "description" => esc_html__("enable if some icons are not displayed", DJS_EXTENSIONS_PLUGIN),
        ]);
    }
}
