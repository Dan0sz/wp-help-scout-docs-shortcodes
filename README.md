
# Help Scout Docs Shortcodes for WordPress

Because Help Scout Docs [isn't compliant with GDPR](https://docs.helpscout.com/article/1263-security-at-help-scout) I created these shortcodes to embed the contents of Help Scout Docs articles in WordPress posts/pages using a shortcode.

Once contents from the Help Scout Docs API are retrieved they're cached in the database in the corresponding post's/page's metadata.

It requires the API-key to be set in a constant named `HELP_SCOUT_DOCS_API_KEY` in your `wp-config.php` right before `/* That's all, stop editing! Happy publishing. */`, e.g.

````
define('HELP_SCOUT_DOCS_API_KEY', 'your-api-key');

/* That's all, stop editing! Happy publishing. */
````

Yes, it requires some manual labor to set it up, but it has quite a few perks:

-  **GDPR compliance**: Since the contents of each Docs article are cached in your database and served to your visitors from there, no connections are made to Help Scout's (US based) servers.
-  **SEO**: You can decide the URL structure yourself, just like you do with regular WordPress pages/posts, which makes it much more attractive to search bots.
-  **Use your site's layout**: You're working in WordPress, which increases recognizability for your users!
-  **Keep using Help Scout**: Keep using that awesome tool, because similar alternatives like ZenDesk are waaay too expensive!

##  Looking for an Automated approach?
If your documentation section is too large to embed manually, or you simply don't have the time to do the work, I've also built a premium [plugin which fully automates the embedding of your Help Scout Docs categories and articles into WordPress](https://ffw.press/wordpress/wp-help-scout-docs/).

## Usage
### Refresh an Article
You can refresh the contents of an article by appending `?refresh_docs=1` to the page's URL.

### Embed an Article
To embed an article, simply use the following shortcode within the content of any WordPress post/page:

`[docs id="x"]`

"id" represents the number of the article you want to render, which is prepended to the slug, e.g. in the following URL:

https://docs.ffw.press/article/**7**-quick-start

"7" is the articles id, or "number" as it is called in Help Scout's documentation.

### Create Child Page Menus

This is a powerful feature which allows you to imitate Category pages, i.e. to render an unordered list of children pages of a specified (by `slug`) parent page.

If a `slug` isn't specified, it attempts to find a page using the last part of the current URL, combined with the `base` parameter.

#### Example

`[child_pages_menu slug="my-page" base="knowledge-base"]`

This shortcode will return the children pages of a page located at `knowledge-base/my-page`.

If a slug is not specified, e.g.

`[child_pages_menu base="animals"]`

and this shortcode is called on `https://yourdomain.com/awesome-stuff/cool-hamsters`, then it will attempt to render the child pages of a page located at `animals/cool-hamsters`.

You can also hide some child pages by specifying their ID's in a comma separated list, e.g.

`[child_page_menu slug="my-page" base="kb" hide="1,2,3"]`

This will not render child pages with ID's 1, 2 and 3.

As a last fallback it will try to get child pages based on the `base` parameter.

That's it!

## Installation & Configuration

1. Upload the plugin files to the `/wp-content/plugins/help-scout-docs-shortcodes` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. [Create an API key](https://developer.helpscout.com/docs-api/) and add it to your **wp-config.php** file, right before `/* That's all, stop editing! Happy publishing. */`, e.g.

   ````
   define('HELP_SCOUT_DOCS_API_KEY', 'your-api-key');
   /* That's all, stop editing! Happy publishing. */
   ````

4. Create new pages/posts in your WordPress admin area and use the shortcodes to embed Docs articles.
