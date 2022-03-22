# Help Scout Docs Shortcode for WordPress

Because the Help Scout Docs are not compliant with GDPR I created this shortcode to render the contents of articles in WordPress posts/pages using a shortcode.

Once it's retrieved the contents from the Help Scout Docs API it caches the contents in the corresponding post's/page's metadata. You can refresh the contents by appending `?refresh_docs=1` to the page's URL.

It requires the API-key to be set in a constant named `HELP_SCOUT_DOCS_API_KEY` in your `wp-config.php` right before `/* That's all, stop editing! Happy publishing. */`, e.g.

````
define('HELP_SCOUT_DOCS_API_KEY', 'xxxx');

/* That's all, stop editing! Happy publishing. */
````

Yes, it requires quite a bit of manual labor to set it up, but it has a few perks:

- **SEO**: You can decide the URL structure yourself, which makes it much more attractive to search bots.
- **Use your site's layout**: You're working in WordPress, which increases recognizability for your users!
- **Keep using Help Scout**: Keep using that awesome tool, because similar alternatives like ZenDesk are waaay too expensive!