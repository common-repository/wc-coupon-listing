<?php
if ( !defined( 'ABSPATH' ) ) exit;

class WC_Coupon_Listing_Admin {

    // Constructor
    public function __construct() {

        add_action( 'plugin_action_links_' . WC_COUPON_LISTING_BASENAME, array( $this, 'register_settings_link' ) );

    }

    // Register plugin settings link
    public function register_settings_link( $links ) {

        $url = admin_url( 'admin.php?page=wc-settings&tab=coupon_listing' );
        $label = esc_html__( 'Settings', 'wc-coupon-listing' );

        $settings_link = '<a href="' . esc_url( $url ) . '">' . $label . '</a>';
        array_unshift( $links, $settings_link );

        return $links;

    }

}
new WC_Coupon_Listing_Admin();
