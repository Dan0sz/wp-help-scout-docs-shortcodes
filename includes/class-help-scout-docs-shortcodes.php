<?php
defined('ABSPATH') || exit;

/**
 * @package   Help Scout Docs Shortcodes
 * @author    Daan van den Bergh
 *            https://ffw.press
 */
class HelpScoutDocsShortcodes
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
        $this->add_docs_shortcode();
        $this->add_child_pages_menu_shortcode();
    }

    /**
     * Add Docs Shortcode
     * 
     * @return void 
     */
    private function add_docs_shortcode()
    {
        new HelpScoutDocsShortcodes_Shortcodes_Docs();
    }

    /**
     * Add Child Pages Menu shortcode
     * 
     * @return void 
     */
    private function add_child_pages_menu_shortcode()
    {
        new HelpScoutDocsShortcodes_Shortcodes_ChildPagesMenu();
    }
}
