<?php
defined('ABSPATH') || exit;

/**
 * @package   Help Scout Docs Shortcode
 * @author    Daan van den Bergh
 *            https://ffw.press
 */
class HelpScoutDocsShortcode_Add
{
    const API_KEY  = '4223a6b10e4b990166b5415ef254e50b4938211e';
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

        $post_meta = apply_filters('help_scout_docs_contents', $this->get_post_meta($atts['id']));

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

        if (!$post_meta || isset($_GET['refresh_docs'])) {
            $ch  = curl_init();
            $url = str_replace('{number}', $id, self::API_URL);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, self::API_KEY . ':x');

            $response = json_decode(curl_exec($ch));

            curl_close($ch);

            $post_meta = $response->article->text ?? '';

            update_post_meta($post_id, self::META_KEY, $post_meta);
        }

        return $post_meta;
    }
}
