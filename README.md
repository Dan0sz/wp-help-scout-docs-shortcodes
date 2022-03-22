# Help Scout Docs Shortcode for WordPress

Because the Help Scout Docs are not compliant with GDPR I created these shortcodes to render the contents of articles in WordPress posts/pages using a shortcode.

Once contents from the Help Scout Docs API are retrieved they're cached in the database in the corresponding post's/page's metadata. You can refresh the contents by appending `?refresh_docs=1` to the page's URL.

It requires the API-key to be set in a constant named `HELP_SCOUT_DOCS_API_KEY` in your `wp-config.php` right before `/* That's all, stop editing! Happy publishing. */`, e.g.

````
define('HELP_SCOUT_DOCS_API_KEY', 'xxxx');

/* That's all, stop editing! Happy publishing. */
````

Yes, it requires quite a bit of manual labor to set it up, but it has a few perks:

- **SEO**: You can decide the URL structure yourself, which makes it much more attractive to search bots.
- **Use your site's layout**: You're working in WordPress, which increases recognizability for your users!
- **Keep using Help Scout**: Keep using that awesome tool, because similar alternatives like ZenDesk are waaay too expensive!

## Usage

### Article

To render an article, simple use the following shortcode in your content:

`[docs id="x"]`

"id" represents the number of the article you want to render, which is prepended to the slug, e.g. in the following URL:

https://docs.ffw.press/article/**7**-quick-start

"7" is the articles id, or "number" as it is called in Help Scout's documentation.

### Child Pages Menu

To render an unordered list of a specified (`slug`) parent page.

If a `slug` isn't specified, it attempts to find a page using the last part of the current URI, combined with the `base` parameter.
Usage

`[child_pages_menu slug="my-page" base="knowledge-base"]`

This shortcode will return the children pages of a page located at `knowledge-base/my-page`.

If a slug is not specified, e.g. `[child_pages_menu base="animals"]` and this shortcode is called on `https://yourdomain.com/awesome-stuff/cool-hamsters`, then it will attempt to render the child pages of a page located at `animals/cool-hamsters`.

You can also hide some child pages by specifying their ID's in a comma separated list, e.g.

`[child_page_menu slug="my-page" base="kb" hide="1,2,3"]`

This will not render child pages with ID's 1, 2 and 3.

As a last fallback it will try to get child pages based on the `base` parameter.

That's it!