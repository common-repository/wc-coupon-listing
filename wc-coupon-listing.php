<?php
/**
 * Plugin Name:       Coupon Listing for WooCommerce
 * Description:       Display available coupons in product page.
 * Version:           1.0.1
 * Requires at least: 4.6
 * Requires PHP:      7.0
 * Author:            Yied Pozi
 * Author URI:        https://yiedpozi.my/
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wc-coupon-listing
 */

if ( !defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WC_Coupon_Listing' ) ) return;

define( 'WC_COUPON_LISTING_FILE', __FILE__ );
define( 'WC_COUPON_LISTING_URL', plugin_dir_url( WC_COUPON_LISTING_FILE ) );
define( 'WC_COUPON_LISTING_PATH', plugin_dir_path( WC_COUPON_LISTING_FILE ) );
define( 'WC_COUPON_LISTING_BASENAME', plugin_basename( WC_COUPON_LISTING_FILE ) );
define( 'WC_COUPON_LISTING_VERSION', '1.0.1' );

// Plugin core class
require( WC_COUPON_LISTING_PATH . 'includes/class-wc-coupon-listing.php' );
