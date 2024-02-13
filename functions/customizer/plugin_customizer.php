<?php
/*
 * Created on   : Sun Sep 25 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : plugin_customizer.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if (!defined('ABSPATH')) exit;

require_once "customizer.php";

if (!class_exists('Plugin_Customizer')) {
    abstract class Plugin_Customizer extends Theme_Customizer {
        public $is_djs_wallstreet_pro_theme;

        public function __construct() {
            parent::__construct();
            $wallstreet_theme = wp_get_theme("DJS-Wallstreet-Pro");
            $current_theme = wp_get_theme();

            $this->is_djs_wallstreet_pro_theme = $wallstreet_theme->Name == $current_theme->Name;
            $this->register_panel = !$this->is_djs_wallstreet_pro_theme;
        }
    }
}
