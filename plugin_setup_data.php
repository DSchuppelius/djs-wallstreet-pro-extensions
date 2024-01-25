<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : plugin_setup_data.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

class AangularJS_Plugin_Setup extends Plugin_Setup {
    // @return plugin|null
    public static function instance() {
        // Store the instance locally to avoid private static replication
        static $instance = null;

        // Only run these methods if they haven't been ran previously
        if (null === $instance) {
            $instance = new AangularJS_Plugin_Setup();
            $instance->load_current_setup();
        }

        // Always return the instance
        return $instance;
    }

    protected function get_initial_setup() {
        return [
            "customcolor_enabled" => "#cccccc",
            "customtextcolor_enabled" => "#ffffff",
            "symbolfonts_enabled" => false,
            "angularjs_enabled" => true,
            "angularjs_version" => "1.8.2",
            "angularjslocal_enabled" => true,
            "angularjslocal" => strtolower(get_locale()),
            "angular_animate_enabled" => true,
            "angular_aria_enabled" => false,
            "angular_cookies_enabled" => true,
            "angular_loader_enabled" => false,
            "angular_messages_enabled" => false,
            "angular_message_format_enabled" => false,
            "angular_mocks_enabled" => false,
            "angular_parse_ext_enabled" => false,
            "angular_resource_enabled" => false,
            "angular_route_enabled" => true,
            "angular_sanitize_enabled" => false,
            "angular_scenario_enabled" => false,
            "angular_touch_enabled" => false,
            "angular_uibootstrap_enabled" => true,
        ];
    }
}
?>
