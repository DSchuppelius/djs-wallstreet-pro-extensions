<?php
/*
 * Created on   : Fri Sep 16 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : functions.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

if (!defined('DJS_EXTENSIONS_PLUGIN_DIR')) {
    define("DJS_EXTENSIONS_PLUGIN", dirname(plugin_basename( __FILE__ )));
    define("DJS_EXTENSIONS_PLUGIN_DIR", plugin_dir_path(__FILE__));
    define("DJS_EXTENSIONS_PLUGIN_DIR_URI", plugin_dir_url(__FILE__));
    define("DJS_EXTENSIONS_PLUGIN_ASSETS_PATH", trailingslashit(DJS_EXTENSIONS_PLUGIN_DIR . "assets"));
    define("DJS_EXTENSIONS_PLUGIN_ASSETS_PATH_URI", trailingslashit(DJS_EXTENSIONS_PLUGIN_DIR_URI . "assets"));
    define("DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH", trailingslashit(DJS_EXTENSIONS_PLUGIN_DIR . "functions"));
} elseif (DJS_EXTENSIONS_PLUGIN_DIR != plugin_dir_path(__FILE__)) {
    add_action('admin_notices', function() { echo "<div class='error'><p>" . sprintf(esc_html__("%s detected a conflict; please deactivate the plugin located in %s.", DJS_EXTENSIONS_PLUGIN), DJS_EXTENSIONS_PLUGIN, DJS_EXTENSIONS_PLUGIN_DIR) . "</p></div>"; });
    return;
}

require_once DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "base/web_functions.php";

require_once(DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "plugin/plugin_base.php");
require_once(DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "plugin/plugin_setup.php");

require_once(DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "plugin/plugin_sanitizer.php");

require_once DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "basic/iframe.php";
require_once DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "basic/jscript.php";

require_once(DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "customizer/customizer.php");
require_once(DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "customizer/childs/customizer-copyright.php");

require_once(DJS_EXTENSIONS_PLUGIN_FUNCTIONS_PATH . "scripts.php");
?>
