=== Multicons [ Mulitple Favicons ] ===
Contributors: Doc4
Donate link: http://www.doc4design.com/donate
Tags: favicon, icon, apple favicon, apple icon, apple touch icon
Requires at least: 2.7
Tested up to: 3.0.1
Stable tag: 1.0


== Description ==

Multicons is a multi-favicon code generator which automatically inserts the necessary meta tags for both favicons (site-wide and/or admin) and Apple Touch icons.

Not sure what a favicon is? "A favicon (short for favorites icon), also known as a shortcut icon, website icon, URL icon, or bookmark icon is a 16×16 or 32×32 pixel square icon associated with a particular website or webpage. A web designer can create such an icon and install it into a website (or webpage) by several means, and most graphical web browsers will then make use of it. Browsers that provide favicon support typically display a page's favicon in the browser's address bar and next to the page's name in a list of bookmarks. Browsers that support a tabbed document interface  typically show a page's favicon next to the page's title on the tab. Some programs allow the user to select an icon of their own from the hard drive and associate it with a website." - Wikipedia

Favicons have a subtle, if small, role in building the branding of a website. When a user takes notice of a favicon it can often be a good indication they have come to the right place serving as visual representation of a website not only in the browser address bar but also when sifting through bookmarks. It is no secret that our eyes gravitate towards images before text and not just on the web but iPhones and iPads as well.

The meta data output by Multicons:

Site-wide Favicon:
• Location: Website [and Admin if no Admin Favicon specified]
• Meta Tags generated:

<code><link rel="shortcut icon" href="http://www.yoursite.com/favicon.ico" />
<link rel="icon" type="image/png" href="http://www.yoursite.com/favicon.ico" /></code>

Admin Favicon:
• Location: Admin Only
• Meta Tag generated:

<code><link rel="shortcut icon" href="http://www.yoursite.com/wp-content/favicon.ico" /></code>

Apple Touch Icon
• Location: Website Only
• Meta Tag generated:

<code><link rel="apple-touch-icon" href="http://www.yoursite.com/apple-touch-icon.png"></code>

If no image links are provided then no code is output thus, leaving a settings field blank will not bloat the site down with empty meta tags. If an is Admin image is not provided this option will default to the Site-Wide Favicon.

This plugin includes two sample files to assist in building the required images. We have included both a favicon.tiff and an apple-touch-icon.tiff file. These sample images are pre-sized and ready for a creative mind. Open these files in a graphics editor of your choice, make the necessary changes, save them in their appropriate file format and upload them. Typically favicons are stored in the 'root' of a website or in the case of WordPress, the same location as the 'wp-content' folder.

== Screenshots ==

View Screenshots:
http://www.doc4design.com/plugins/multicons/
 

== Installation ==

To install the plugin just follow these simple steps:

1. Download the plugin and expand it.
2. Copy the Multicons folder into your plugins folder ( wp-content/plugins ).
3. Log-in to the WordPress administration panel and visit the Plugins page.
4. Locate the Multicons plugin and click on the 'activate' link.
5. Visit Settings > Multicons and provide links to the favicons.


== Changelog ==

= 1.0 =
* Release candidate 1: code name 'Fapple'