<?php
if ( !defined( 'ABSPATH' ) ) exit;

class WC_Coupon_Listing {

    // Constructor
    public function __construct() {

        // Admin
        require_once( WC_COUPON_LISTING_PATH . 'includes/class-wc-coupon-listing-admin.php' );
        require_once( WC_COUPON_LISTING_PATH . 'includes/class-wc-coupon-listing-settings.php' );

        // Product page
        require_once( WC_COUPON_LISTING_PATH . 'includes/class-wc-coupon-listing-product.php' );

    }

}
new WC_Coupon_Listing();
