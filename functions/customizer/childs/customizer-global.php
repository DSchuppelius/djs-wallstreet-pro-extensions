<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-global.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
class Customizer_Wallstreet_Pro_AngularJS extends Theme_Customizer {
    public $is_djs_wallstreet_pro_theme;

    public function __construct() {
        parent::__construct();
        $wallstreet_theme = wp_get_theme("DJS-Wallstreet-Pro");
        $current_theme = wp_get_theme();

        $this->is_djs_wallstreet_pro_theme = $wallstreet_theme->Name == $current_theme->Name;
        $this->register_panel = !$this->is_djs_wallstreet_pro_theme;
    }

    public function customize_register_panel($wp_customize) {
        $wp_customize->add_panel("angular_panel_settings", [
            "title" => esc_html__("AngularJS options", DJS_EXTENSIONS_PLUGIN),
            "description" => "",
        ]);
    }

    public function customize_register_section($wp_customize) {
        if ($this->is_djs_wallstreet_pro_theme) {
            $wp_customize->add_section("angular_section_settings", [
                "title" => esc_html__("AngularJS options", DJS_EXTENSIONS_PLUGIN),
                "panel" => "global_theme_settings",
                "description" => "",
            ]);
        } else {
            $wp_customize->add_section("angular_section_settings", [
                "title" => esc_html__("AngularJS options", DJS_EXTENSIONS_PLUGIN),
                "panel" => "angular_panel_settings",
                "description" => "",
            ]);

            $wp_customize->add_section("angularfont_section_settings", [
                "title" => esc_html__("Font settings", DJS_EXTENSIONS_PLUGIN),
                "panel" => "angular_panel_settings",
                "description" => "",
            ]);
        }
    }

    public function customize_register_settings_and_controls($wp_customize) {
        if (!$this->is_djs_wallstreet_pro_theme) {            
            $this->register_colorpickercontrols($wp_customize);
            $this->register_symolicfontcontrols($wp_customize);
        }

        $this->register_angularcontrols($wp_customize);
    }

    private function register_angularcontrols($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[angularjs_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angularjs_enabled]", [
            "label" => esc_html__("Enable AngularJS", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
            "description" => esc_html__("If enabled the following and enabled features are also taken into account", DJS_EXTENSIONS_PLUGIN),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angularjs_version]", [
            "default" => '1.8.2',
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angularjs_version]", [
            "label" => esc_html__("Select version of AngularJS", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "select",
            'choices' => [
                '1.2.32' => esc_html__('Version 1.2.32'),
                '1.8.2' => esc_html__('Version 1.8.2'),
            ],
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angularjslocal_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angularjslocal_enabled]", [
            "label" => esc_html__("Enable AngularJS Locale", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angularjslocal]", [
            "default" => strtolower(get_locale()),
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angularjslocal]", [
            "label" => esc_html__("Language", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "text",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_animate_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_animate_enabled]", [
            "label" => esc_html__("Enable AngularJS Animate", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_aria_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_aria_enabled]", [
            "label" => esc_html__("Enable AngularJS Aria", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_cookies_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_cookies_enabled]", [
            "label" => esc_html__("Enable AngularJS Cookies", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_loader_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_loader_enabled]", [
            "label" => esc_html__("Enable AngularJS Loader", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_messages_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_messages_enabled]", [
            "label" => esc_html__("Enable AngularJS Message", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_message_format_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_message_format_enabled]", [
            "label" => esc_html__("Enable AngularJS Messageformat", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_mocks_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_mocks_enabled]", [
            "label" => esc_html__("Enable AngularJS Mocks", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);


        $wp_customize->add_setting($this->theme_options_name . "[angular_parse_ext_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_parse_ext_enabled]", [
            "label" => esc_html__("Enable AngularJS Parse Extension", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_resource_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_resource_enabled]", [
            "label" => esc_html__("Enable AngularJS Resource", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_route_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_route_enabled]", [
            "label" => esc_html__("Enable AngularJS Route", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_sanitize_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_sanitize_enabled]", [
            "label" => esc_html__("Enable AngularJS Sanitize", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_scenario_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_scenario_enabled]", [
            "label" => esc_html__("Enable AngularJS Scenario", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
            "description" => esc_html__("Only in Version 1.2.32", DJS_EXTENSIONS_PLUGIN),
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_touch_enabled]", [
            "default" => false,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_touch_enabled]", [
            "label" => esc_html__("Enable AngularJS Touch", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);

        $wp_customize->add_setting($this->theme_options_name . "[angular_uibootstrap_enabled]", [
            "default" => true,
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_boolean_field",
            "type" => "option",
        ]);

        $wp_customize->add_control($this->theme_options_name . "[angular_uibootstrap_enabled]", [
            "label" => esc_html__("Enable AngularJS UI Bootstrap", DJS_EXTENSIONS_PLUGIN),
            "section" => "angular_section_settings",
            "type" => "checkbox",
            "priority" => 100,
        ]);
    }
    
    private function register_colorpickercontrols($wp_customize) {
        $wp_customize->add_setting($this->theme_options_name . "[customcolor_enabled]", [
            "default" => "#cccccc",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $this->theme_options_name . "[customcolor_enabled]", [
            'label' => esc_html__('Fixed Home Widget Background', DJS_EXTENSIONS_PLUGIN),
            'section' => 'colors',
            'settings' => $this->theme_options_name . '[customcolor_enabled]'
        ]));

        $wp_customize->add_setting($this->theme_options_name . "[customtextcolor_enabled]", [
            "default" => "#ffffff",
            "capability" => "edit_theme_options",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $this->theme_options_name . "[customtextcolor_enabled]", [
            'label' => esc_html__('Fixed Home Widget Textcolor', DJS_EXTENSIONS_PLUGIN),
            'section' => 'colors',
            'settings' => $this->theme_options_name . '[customtextcolor_enabled]'
        ]));
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
            "section" => "angularfont_section_settings",
            "type" => "checkbox",
            "priority" => 100,
            "description" => esc_html__("enable if some icons are not displayed", DJS_EXTENSIONS_PLUGIN),
        ]);
    }
}
