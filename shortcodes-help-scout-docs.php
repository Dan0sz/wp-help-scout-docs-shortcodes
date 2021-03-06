<?php
defined('ABSPATH') || exit;
/**
 * Plugin Name: Shortcodes for Help Scout Docs
 * Plugin URI: https://wordpress.org/plugins/shortcodes-help-scout-docs/
 * Description: Embed Help Scout Docs articles in WordPress pages/posts with shortcodes.
 * Version: 1.0.0
 * Author: Daan from FFW.Press
 * Author URI: https://ffw.press
 * License: GPL2v2 or later
 * Text Domain: shortcodes-help-scout-docs
 */

define('DOCS_SHORTCODES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DOCS_SHORTCODES_PLUGIN_FILE', __FILE__);
define('DOCS_SHORTCODES_PLUGIN_BASE', plugin_basename(DOCS_SHORTCODES_PLUGIN_FILE));

/**
 * Takes care of loading classes on demand.
 *
 * @param $class
 *
 * @return mixed|void
 */
function help_scout_docs_shortcodes_autoload($class)
{
    $path = explode('_', $class);

    if ($path[0] != 'HelpScoutDocsShortcodes') {
        return;
    }

    if (!class_exists('FFWP_Autoloader')) {
        require_once(DOCS_SHORTCODES_PLUGIN_DIR . 'ffwp-autoload.php');
    }

    $autoload = new FFWP_Autoloader($class);

    return include DOCS_SHORTCODES_PLUGIN_DIR . 'includes/' . $autoload->load();
}

spl_autoload_register('help_scout_docs_shortcodes_autoload');

/**
 * All systems GO!!!
 *
 * @return HelpScoutDocsShortcodes
 */
function help_scout_docs_shortcodes()
{
    static $help_scout_docs_shortcodes = null;

    if ($help_scout_docs_shortcodes === null) {
        $help_scout_docs_shortcodes = new HelpScoutDocsShortcodes();
    }

    return $help_scout_docs_shortcodes;
}

help_scout_docs_shortcodes();
