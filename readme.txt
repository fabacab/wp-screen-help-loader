=== Plugin Name ===
Contributors: meitar
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=TJLPJYXHSRBEE&amp;lc=US&amp;item_name=WP%20Screen%20Help%20Loader&amp;item_number=wp-screen-help-loader&amp;currency_code=USD&amp;bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: screen, help, plugin
Requires at least: 4.4
Tested up to: 4.4
Stable tag: 0.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Easily add custom on-screen help to the admin area of your WordPress website.

== Description ==

Make your site's on-screen admin help tabs more helpful by adding custom help tabs or additional sidebar content to any screen of the WordPress Admin Dashboard's built-in "Help" menu simply by placing help files in a special folder.

This plugin looks for files located in your current theme's `admin-help/` folder and, based on their name, adds their content to the WordPress on-screen help menuing system. The files should be written in [markdown](https://daringfireball.net/projects/markdown/).

You can augment any screen's help tabs or help sidebar, including screens created by other plugins. The name of the help file determines which screen in the WordPress admin area the file's content will be added to.

You can add help content in any language, and the plugin will automatically load the correct language file for your site. This makes translating help content easy.

For instance, if you run an English website and want to augment the built-in help provided by WordPress core or a custom plugin shown on the user's profile editing page, add a file at `YOUR_THEME/admin-help/en_US/profile.md`, where `YOUR_THEME` is the theme folder. (For a Spanish site, add a file to `YOUR_THEME/admin-help/es_ES/profile.md`.)

The rules used by the plugin to determine which file to load on which screen are as follows:

* Each help file is contained within a directory matching the [locale string of the WordPress installation](https://developer.wordpress.org/reference/functions/get_locale/). Control the locale string by changing the WordPress language setting.
* File names reference the `$action` and `$id` members of the [`WP_Screen`](https://developer.wordpress.org/reference/classes/wp_screen/) class.
* Files can be optionally suffixed with a numeric priority (lower numbers display first, above the content of files with larger numbers as per `WP_Screen` documentation).
* Files can be optionally prefixed with `sidebar-` indicating that the file contains content intended for the help sidebar rather than a tab of its own.
* The special filename `sidebar.md` is appended to the sidebar on every WordPress admin screen page where on-screen help is shown.

**For plugin or theme authors**

To use WP Screen Help Loader in your plugin, all you need to do is:

    function my_plugin_add_custom_help () {
        new WP_Screen_Help_Loader(plugin_dir_path(__FILE__) . 'help');
    }
    add_action('admin_head', 'my_plugin_add_custom_help');

Now put your localized help contents into the `help/YOUR_LANGUAGE` directory in your plugin directory. That's it!

== Installation ==

1. [Download the latest plugin code](https://downloads.wordpress.org/plugin/wp-screen-help-loader.zip) from the WordPress plugin repository.
1. Upload the unzipped `wp-screen-help-loader` folder to the `/wp-content/plugins/` directory of your WordPress installation.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Place help contents in the appropriate directory.

== Frequently Asked Questions ==

= Can I customize the help directory location? =

Yes. Either hook the `wp_screen_help_loader_help_dir_path` filter or specify a `new WP_Screen_Help_Loader()` object and pass in a new path.

= Why aren't my help files showing up? Why aren't my help tabs displaying on the right screen? =

Make sure your help files are named correctly and placed in the correct directory. Remember, file names reference the `$action` and `$id` members of the [`WP_Screen`](https://developer.wordpress.org/reference/classes/wp_screen/) class and are dereferenced more or less like this:

    glob("{$current_screen->action}{$current_screen->id}*.md");

So, for example, to write a help tab for the "Add New Post" screen, create a file named `addpost.md` in the appropriate locale directory.

An easy way to see what these values are for a given screen is to add the following code to your theme's `functions.php` file:

    function help_loader_show_current_screen_info () {
        $screen = get_current_screen();
        print 'The help file should be called: ';
        print "{$screen->action}{$screen->id}.md";
    }
    add_action('admin_notices', 'help_loader_show_current_screen_info');

This will display a line at the top of the admin screen showing what the help file should be named if you want it to appear on the current screen.

WP Screen Help Loader looks for your files in a language-specific directory inside your current theme's `admin-help/` directory. For example, when your site admin is set to English, the folder for your help files will be `admin-help/en_US/` by default.

= My help tabs are showing up, but are not displaying properly. =

Make sure your help files are written in standard [markdown syntax](https://daringfireball.net/projects/markdown/syntax/).

= Can I change the order in which the tabs appear? =

Yes. Use the optional suffix as part of the file name to control the order in which the tabs appear. Larger numbers will appear lower. For example, given the two help files `profile-20.md` and `profile-50.md`, the latter will appear lower in the tab list.

= How do I set a tab title? =

The first line of your help file's content becomes the tab title. So, for example, given a help file called `profile.md` containing this text:

    # This is the help tab title.

    This is the custom help tab content. You can:

    * write lists,
    * use formatting like *italic* and **bold**,
    * create [links](https://example.com/)
    * and much, much more. :)

    Enjoy your new help tab!

The tab title will be "This is the help tab title" and the tab content will start from "This is the custom help tab content."

== Screenshots ==

1. An example custom help tab and added sidebar content.

== Change log ==

* Version 0.1:
    * Initial release.

== Other notes ==

If you like this plugin, **please consider [making a donation](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=TJLPJYXHSRBEE&amp;lc=US&amp;item_name=WP%20Screen%20Help%20Loader&amp;item_number=wp-screen-help-loader&amp;currency_code=USD&amp;bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted) for your use of the plugin**, [purchasing one of Meitar's web development books](http://www.amazon.com/gp/redirect.html?ie=UTF8&location=http%3A%2F%2Fwww.amazon.com%2Fs%3Fie%3DUTF8%26redirect%3Dtrue%26sort%3Drelevancerank%26search-type%3Dss%26index%3Dbooks%26ref%3Dntt%255Fathr%255Fdp%255Fsr%255F2%26field-author%3DMeitar%2520Moscovitz&tag=maymaydotnet-20&linkCode=ur2&camp=1789&creative=390957) or, better yet, contributing directly to [Meitar's Cyberbusking fund](http://Cyberbusking.org/). (Publishing royalties ain't exactly the lucrative income it used to be, y'know?) Your support is appreciated!
