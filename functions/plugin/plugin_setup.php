<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : plugin_setup.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

if (!defined('ABSPATH')) exit;

if(!class_exists('Plugin_Setup')) {
    abstract class Plugin_Setup extends DJS_Setup {
        // A dummy magic method to prevent plugin from being cloned
        public function __clone() {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', DJS_EXTENSIONS_PLUGIN), $this->version);
        }

        // A dummy magic method to prevent plugin from being unserialized
        public function __wakeup() {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', DJS_EXTENSIONS_PLUGIN), $this->version);
        }
    }
}

require_once(DJS_EXTENSIONS_PLUGIN_DIR . "plugin_setup_data.php"); ?>