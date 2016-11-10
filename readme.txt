=== CPO Shortcodes ===
Contributors: cpothemes
Tags: button, counter, register, message, shortcode, share, gallery, slideshow, accordion, toggle, content, short code, tooltip, jquery, spoiler, links, list, custom, leading, notice, icon, touch, icons, team, testimonial, bar, progress, feed, portfolio, shortcodes, map, google map, animation, css3, transition, pricing, pricing table
Requires at least: 4.1
Tested up to: 4.4
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add all sorts of multimedia elements to your pages with this shortcode pack, comprised of over 30+ different elements.

== Description ==

[CPO Shortcodes](http://cpothemes.com/plugin/cpo-shortcodes) is a complete shortcode pack that gives you extreme flexibility for designing high-quality content.

By installing this plugin, you will be able to embed all sorts of interactive elements onto your pages: **buttons, accordions, slideshows, and even pricing tables**. By using these elements, you can make your content way more appealing and boost your conversions.

This plugin is designed to give you as much freedom as possible by making each shortcode as flexible as possible. Every one of these design pieces can be configured in many different ways, allowing you to pick any size, color or shape.

= Included Shortcodes =
* Accordions
* Animation areas
* Buttons
* Dropcaps
* Focus boxes
* Google Maps
* Icon Boxes
* Item lists
* Leading paragraphs
* Notifications
* Number Counters
* Optin Forms (Mailchimp)
* Progress Bars
* Separators
* Tabbed content
* Testimonials
* Team Members
* Sections
* Separators
* Spacers

= Advanced Shortcodes =

CPO Shortcodes also includes an number of more advanced shortcodes that let you create highly refined pages:

* **Column Layouts** - Lay out your content in up to 6 columns at a time, including multiple combinations.
* **Post Listings** - Create lists of any kind of post anywhere, either as a list or in grid format. You can create your own portfolio listing this way.
* **Pricing Tables** - Display your prices with a beautifully-designed pricing table, flexible enough that you can tweak it to maximize conversions.
* **Content Slideshows** - Create slideshows with virtually anything in them, including images, text, and even other shortcodes too.
* **Registration & Login Forms** - Create and embed beautiful registration forms to create a vibrant community around your website.

= Other highlights =

* Compatible with the vast majority of themes out there
* Responsive elements that adapt to the current screen size

== Installation ==

= Installing Through The WordPress Admin =

1. Download the ZIP file
2. In your WordPress admin area, go to Plugins > Add Plugin, and select Upload Plugin
3. Upload the ZIP file and installation will commence
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Make sure to check the **Settings > CPO Shortcodes** page before using it right away!
6. You are now ready to use the shortcodes from the WordPress Visual Editor

= Installing Through FTP =

1. Download the ZIP file and unpack it
2. Upload the entire **cpo-shortcodes** to the **/wp-content/plugins/** directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Make sure to check the **Settings > CPO Shortcodes** page before using it right away!
5. You are now ready to use the shortcodes from the WordPress Visual Editor

== Frequently Asked Questions ==

[Read The Documentation At CPOThemes](http://www.cpothemes.com/documentation/)

= HELP! My shortcodes are not working! =
Go to Settings > CPO Shortcodes and see what the **Shortcode Prefix** is. This prefix is meant to avoid conflicts with other plugins (in case you have a plugin that also has a --button-- shortcode). Simply make sure the shortcodes you are using correspond to the prefix in there. For example, if your prefix is **ct**, then you should use the **ct_button** shortcode. If you have an empty prefix, you can use just **button**.

== Screenshots ==

1. Quick Insert button for immediate markup
2. Multiple button sizes and colors. Choose from a predefined palette or a custom HEX color
3. Add message boxes, notifications, and highlighted boxes with custom background colors
4. Create testimonials, team members, or inline features
5. Add custom-colored pricing tables to your pages

== Changelog ==

= 1.4.0 =
* Various fixes and updates
* Better sanitization

= 1.3.5 =
* Improved performance by selectively loading assets

= 1.3.4 =
* New shortcode: Definition lists!
* Fixed minor errors in the shortcode generator
* Fixed responsive styles for narrow and fit columns

= 1.3.3 =
* New shortcode: Login form!
* Fixed PHP warnings as well as faulty generator links

= 1.3.2 =
* Minor fixes

= 1.3.1 =
* New shortcode: Registration form!

= 1.3.0 =
* Changed the settings page to use the native WordPress Settings API.
* Overhauled the shortcode generator and added a revamped interface.
* Reorganized some of the shortcodes in the visaul editor button.
* Added better handling of defaults.

= 1.2.3 =
* Changed the Cycle library to Cycle 2.
* Optimized performance by loading JS scripts only when needed

= 1.2.2 =
* Fixed the section shortcode not being included.
* Added missing shortcodes to the visual editor generator.
* Added a new shortcode: mailchimp optin form.
* Added a new shortcode: animation area.
* Added a new shortcode: clearing div.

= 1.2.1 =
* Fixed the icon generator not displaying properly.

= 1.2.0 =
* The plugin has been completely revamped with many new features.
* Buttons now have background colors, gradients, icons and borders.
* Notices have renamed to Focus Boxes, meant to highlight content. Notices still work as a shortcode but are not supported.
* Focus Boxes now have gradient backgrounds.
* Accordions can now be set as as part of a group, allowing only a single one to remain open.
* Inline features can now have multiple icon sizes, colors, backgrounds, and borders.
* Team members have been upgraded with new contact info, layout, and social features.
* Testimonials can now be placed facing left or right.
* Counters have been streamlined.
* Added more options to progress bars, such as gradients.
* Custom lists no longer affect a UL HTML element. They are now a single list item for flexibility purposes.
* Separators now have icons, descriptions, and various styles.
* Added more options to the posts shortcode to better filter queries.
* Attributes that now take an image can have either a full URL or a post ID.
* Cleaned styles and improved overall CSS.
* Added background colors, gradients, icons and borders to focus boxes.
* Added a setting to specify a shortcode prefix in order to avoid conflicts.

= 1.1.0 =
* Changed JS files to use the TinyMCE version 4.X API.

= 1.0.2 =
* Fixed team shortcodes and added animation, timeout, and speed parameters to slideshows

= 1.0.1 =
* Fixed minor CSS issues and markup corrections

= 1.0 =
* Plugin release, yay!

== Upgrade Notice ==

= 1.3.3 =
We're adding better support for intranets: Create front-facing login forms with the [ct_login] shortcode. 
