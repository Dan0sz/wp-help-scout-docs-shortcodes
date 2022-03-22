<?php
defined('ABSPATH') || exit;

/**
 * @package   Help Scout Docs Shortcode
 * @author    Daan van den Bergh
 *            https://ffw.press
 */
class HelpScoutDocsShortcode
{
    /**
     * Set Fields.
     * 
     * @return void 
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Start Plugin
     * 
     * @return void 
     */
    private function init()
    {
        $this->define_constants();
        $this->add_shortcode();
    }

    /**
     * Any constants we might require to e.g. access settings in a consistent manner.
     * 
     * @return void 
     */
    private function define_constants()
    {
    }

    private function add_shortcode()
    {
        new HelpScoutDocsShortcode_Add();
    }
}
