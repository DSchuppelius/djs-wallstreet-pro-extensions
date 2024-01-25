<?php
/*
 * Created on   : Sun Sep 25 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if (!defined('ABSPATH')) exit;

if (!class_exists('Theme_Customizer')) {
    abstract class Theme_Customizer {
        protected string $theme_options_name;

        protected bool $register_section;
        protected bool $register_panel;

        public function __construct() {
            $this->theme_options_name = "wallstreet_pro_options";
            $this->register_section = true;
            $this->register_panel = false;
        }

        public function register() {
            if ($this->register_section)
                add_action("customize_register", [$this, "customize_register_section"]);
            if ($this->register_panel)
                add_action("customize_register", [$this, "customize_register_panel"]);

            add_action("customize_register", [$this, "customize_register_settings_and_controls"]);
        }

        abstract public function customize_register_panel($wp_customize);
        abstract public function customize_register_section($wp_customize);
        abstract public function customize_register_settings_and_controls($wp_customize);
    }
}
