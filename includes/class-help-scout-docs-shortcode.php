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
        $this->add_shortcode();
    }

    private function add_shortcode()
    {
        new HelpScoutDocsShortcode_Add();
    }
}
