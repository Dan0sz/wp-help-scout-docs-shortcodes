<?php
defined('ABSPATH') || exit;
/**
 * Plugin Name: Help Scout Docs Shortcode
 * Plugin URI: https://ffw.press/wordpress-plugins/help-scout-docs-shortcode/
 * Description: Use a shortcode to render Help Scout Docs in WordPress.
 * Version: 1.0.0
 * Author: Daan from FFW.Press
 * Author URI: https://ffw.press
 * License: GPL2v2 or later
 * Text Domain: hsds
 */

define('HSDS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('HSDS_PLUGIN_FILE', __FILE__);
define('HSDS_PLUGIN_BASENAME', plugin_basename(HSDS_PLUGIN_FILE));

/**
 * Takes care of loading classes on demand.
 *
 * @param $class
 *
 * @return mixed|void
 */
function hsds_autoload($class)
{
    $path = explode('_', $class);

    if ($path[0] != 'HelpScoutDocsShortcode') {
        return;
    }

    if (!class_exists('FFWP_Autoloader')) {
        require_once(GDPRESS_PLUGIN_DIR . 'ffwp-autoload.php');
    }

    $autoload = new FFWP_Autoloader($class);

    return include HSDS_PLUGIN_DIR . 'includes/' . $autoload->load();
}

spl_autoload_register('hsds_autoload');

/**
 * All systems GO!!!
 *
 * @return Hsds
 */
function hsds_press_init()
{
    static $hsds = null;

    if ($hsds === null) {
        $hsds = new HelpScoutDocsShortcode();
    }

    return $hsds;
}

hsds_press_init();
