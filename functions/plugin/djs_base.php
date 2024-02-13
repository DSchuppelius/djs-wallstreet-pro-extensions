<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : djs_base.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
defined('ABSPATH') or die('Hm, Are you ok?');

if(!class_exists('DJS_Base')) {
    abstract class DJS_Base {
        protected $data;

        // @var mixed False when not logged in; WP_User object when logged in
        public $current_user = false;

        // @var obj Add-ons append to this (Akismet, BuddyPress, etc...)
        public $extend;

        // @var array Topic views
        public $views = [];

        // @var array Overloads get_option()
        public $options = [];

        // @var array Overloads get_user_meta()
        public $user_options = [];

        // @return plugin|null
        abstract public static function instance();

        /**
         * A dummy constructor to prevent plugin from being loaded more than once.
         *
         * @since Theme_Base (v2.0.4)
         * @see Theme_Base::instance()
         * @see plugin();
         */
        protected function __construct() {
            /* Do nothing here */
        }

        // A dummy magic method to prevent plugin from being cloned
        public function __clone() {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'djs-wallstreet-pro'), '2.1.0');
        }

        // A dummy magic method to prevent plugin from being unserialized
        public function __wakeup() {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'djs-wallstreet-pro'), '2.1.0');
        }

        // Magic method for checking the existence of a certain custom field
        public function __isset($key) {
            return isset($this->data[$key]);
        }

        // Magic method for getting plugin variables
        public function __get($key) {
            return isset($this->data[$key]) ? $this->data[$key] : null;
        }

        // Magic method for setting plugin variables
        public function __set($key, $value) {
            $this->data[$key] = $value;
        }

        // Magic method for unsetting plugin variables
        public function __unset($key) {
            if (isset($this->data[$key])) unset($this->data[$key]);
        }

        // Magic method to prevent notices and errors from invalid method calls
        public function __call($name = '', $args = []) {
            unset($name, $args);
            return null;
        }
    }
}
?>
