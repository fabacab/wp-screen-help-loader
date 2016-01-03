<?php
/**
 * WP Screen Help Loader plugin
 *
 * WordPress plugin header information:
 *
 * * Plugin Name: WP Screen Help Loader
 * * Plugin URI: https://wordpress.org/plugins/wp-screen-help-loader
 * * Description: Easily add custom on-screen help to the admin area of your WordPress website. <strong>Like this plugin? Please <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=TJLPJYXHSRBEE&amp;lc=US&amp;item_name=WP%20Screen%20Help%20Loader&amp;item_number=wp-screen-help-loader&amp;currency_code=USD&amp;bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" title="Send a donation to the developer of WP Screen Help Loader">donate</a>. &hearts; Thank you!</strong>
 * * Version: 0.1
 * * Author: Maymay <bitetheappleback@gmail.com>
 * * Author URI: https://maymay.net/
 * * License: GPL-3
 * * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 * * Text Domain: wp-screen-help-loader
 * * Domain Path: /languages
 *
 * @copyright Copyright (c) 2015-2016 by Meitar "maymay" Moscovitz
 *
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @package WordPress\Plugin\WP_Screen_Help_Loader
 */

if (!class_exists('WP_Screen_Help_Loader')) {
    require_once 'class-wp-screen-help-loader.php';
}

/**
 * Wrapper class for interaction with the WordPress APIs.
 */
class WP_Screen_Help_Plugin {

    /**
     * Registers hook.
     * 
     * @return void
     */
    public static function register () {
        add_action('admin_head', array(__CLASS__, 'apply'));
    }

    /**
     * Attaches the help files to the screen.
     *
     * @return void
     */
    public static function apply () {
        $help = new WP_Screen_Help_Loader();
        $help->applyTabs();
        $help->applySidebar();
    }
}

WP_Screen_Help_Plugin::register();
