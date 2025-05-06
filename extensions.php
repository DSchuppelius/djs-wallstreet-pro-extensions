<?php
/*
Plugin Name: DJS-Wallstreet-Pro Extensions
Plugin URI: https://github.com/DSchuppelius/djs-wallstreet-pro-extensions
Update URI: https://github.com/DSchuppelius/djs-wallstreet-pro-extensions/releases/latest/
Description: Adds some extensions and shortcodes to theme DJS-Wallstreet-Pro
Version: 1.0.0
Author: Daniel Joerg Schuppelius
Author URI: https://schuppelius.org
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: djs-wallstreet-pro-extensions
Domain Path: /languages/
Requires Plugins: djs-wallstreet-pro-core
*/
defined('ABSPATH') or die('Hm, Are you ok?');

require_once "functions.php";

if (!class_exists('DJS_Wallstreet_Pro_Extensions') && class_exists('DJS_Base')) {
    final class DJS_Wallstreet_Pro_Extensions extends DJS_Base {
        private static $instance = null;

        private $customizers;

        // @return plugin|null
        public static function instance() {
            // Only run these methods if they haven't been ran previously
            if (null === static::$instance) {
                static::$instance = new DJS_Wallstreet_Pro_Extensions();
                static::$instance->setup_globals();
                static::$instance->includes();
                static::$instance->setup_actions();

                add_action('plugins_loaded', [static::$instance, 'load_plugin_textdomain']);
            }

            // Always return the instance
            return static::$instance;
        }

        protected function setup_globals() {
            parent::setup_globals();
            /** Versions **********************************************************/
            $this->version = '1.0.0';
            $this->db_version = 'none';
        }

        private function includes() {
            require($this->includes_dir . "shortcodes.php");
        }

        private function setup_actions() {
            $this->customizers["global"] = new Plugin_Extension_Global_Customizer();
            $this->customizers["cookies"] = new Plugin_Extension_Copyright_Customizer();

            foreach($this->customizers as $customizer){
                $customizer->register();
            }
        }
    }

    function djs_wallstreet_pro_extensions() {
        return DJS_Wallstreet_Pro_Extensions::instance();
    }

    if (defined('DJS_Wallstreet_Pro_Extensions_LATE_LOAD')) {
        add_action('plugins_loaded', 'djs_wallstreet_pro_extensions', (int)DJS_Wallstreet_Pro_Extensions_LATE_LOAD);
    } else {
        djs_wallstreet_pro_extensions();
    }
}
