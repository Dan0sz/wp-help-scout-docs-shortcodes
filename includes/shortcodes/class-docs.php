<?php
defined('ABSPATH') || exit;

/**
 * @package   Help Scout Docs Shortcodes
 * @author    Daan van den Bergh
 *            https://ffw.press
 */
class HelpScoutDocsShortcodes_Shortcodes_Docs
{
    const API_KEY  = 'HELP_SCOUT_DOCS_API_KEY';
    const API_URL  = 'https://docsapi.helpscout.net/v1/articles/{number}';
    const META_KEY = '_help_scout_docs_content';

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
        add_shortcode('docs', [$this, 'render']);
    }

    /**
     * Render the shortcode.
     * 
     * @param array $atts 
     * @param mixed $contents 
     * @param string $tag 
     * @return string 
     */
    public function render($atts = [], $contents = null, $tag = '')
    {
        $atts = array_change_key_case((array) $atts, CASE_LOWER);

        $atts = shortcode_atts(
            [
                'id' => '0',
            ],
            $atts,
            $tag
        );

        if (!defined(self::API_KEY)) {
            $post_meta = 'Help Scout Docs API key not defined.';
        } else {
            $post_meta = apply_filters('help_scout_docs_contents', $this->get_post_meta($atts['id']));
        }

        $output = "<div class='help-scout-docs'>";

        if ($post_meta) {
            $output .= $post_meta;
        }

        $output .= "</div>";

        return $output;
    }

    /**
     * Get Post Meta
     */
    private function get_post_meta($id)
    {
        $post_id   = get_the_ID();
        $post_meta = get_post_meta($post_id, self::META_KEY, true);

        if (!$post_meta || $this->should_refresh()) {
            $ch  = curl_init();
            $url = str_replace('{number}', $id, self::API_URL);

            $response = Requests::get(
                $url,
                null,
                ['auth' => [HELP_SCOUT_DOCS_API_KEY, 'x']]
            );

            $response = json_decode($response->body ?? '');

            $post_meta = $response->article->text ?? '';

            update_post_meta($post_id, self::META_KEY, $post_meta);
        }

        return $post_meta;
    }

    /**
     * Checks if the requested contents should be refreshed.
     */
    private function should_refresh()
    {
        return current_user_can('manage_options') && isset($_GET['refresh_docs']);
    }
}
