<?php
if ( !defined( 'ABSPATH' ) ) exit;

class WC_Coupon_Listing_Settings {

    private $settings_id = 'coupon_listing';

    // Constructor
    public function __construct() {

        add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 21 );
        add_action( 'woocommerce_settings_' . $this->settings_id, array( $this, 'output' ) );
        add_action( 'woocommerce_update_options_' . $this->settings_id, array( $this, 'save' ) );

    }

    // Register settings tab in WooCommerce settings page
    public function add_settings_page( $settings_tabs ) {

        $settings_tabs[ $this->settings_id ] = __( 'Coupon Listing', 'wc-coupon-listing' );
        return $settings_tabs;

    }

    // Init form fields in settings page
    public function output() {
        woocommerce_admin_fields( $this->get_settings() );
    }

    // Save settings
    public function save() {
        woocommerce_update_options( $this->get_settings() );
    }

    // Form fields
    private function get_settings() {

        return array(
            array(
                'title'    => __( 'Coupon Listing Settings', 'wc-coupon-listing' ),
                'type'     => 'title',
                'id'       => 'wc_coupon_listing_section_start',
            ),
            array(
                'title'    => __( 'Title', 'wc-coupon-listing' ),
                'id'       => 'wc_coupon_listing_title',
                'type'     => 'text',
                'default'  => __( 'We have a deal for you!', 'wc-coupon-listing' ),
            ),
            array(
                'title'    => __( 'Product page', 'wc-coupon-listing' ),
                'desc'     => __( 'Show coupon listing on product page', 'wc-coupon-listing' ),
                'id'       => 'wc_coupon_listing_show_on_product_page',
                'type'     => 'checkbox',
                'default'  => 'yes',
            ),
            array(
                'title'    => __( 'Product page position', 'wc-coupon-listing' ),
                'desc'     => __( 'Select position where coupon listing will be displayed in product page.', 'wc-coupon-listing' ),
                'desc_tip' => true,
                'id'       => 'wc_coupon_listing_required_product',
                'class'    => 'wc-enhanced-select-nostd',
                'css'      => 'min-width:300px;',
                'type'     => 'select',
                'default'  => 'after_add_to_cart_form',
                'options'  => array(
                    'after_product_summary' => __( 'After product summary', 'wc-coupon-listing' ),
                    'before_add_to_cart_form' => __( 'Before add to cart button', 'wc-coupon-listing' ),
                    'after_add_to_cart_form' => __( 'After add to cart button', 'wc-coupon-listing' ),
                    'before_product_meta' => __( 'Before product meta', 'wc-coupon-listing' ),
                    'after_product_meta' => __( 'After product meta', 'wc-coupon-listing' ),
                    'after_product_summary' => __( 'After product summary', 'wc-coupon-listing' ),
                ),
            ),
            array(
                'title'    => __( 'Mobile/tablet screen size (px)', 'wc-coupon-listing' ),
                'desc'     => __( 'Coupon listing will be displayed horizontally in mobile and tablet screen size.', 'wc-coupon-listing' ),
                'desc_tip' => true,
                'id'       => 'wc_coupon_listing_mobile_screen_size',
                'type'     => 'number',
                'default'  => 599,
            ),
            'section_end'  => array(
                'type'     => 'sectionend',
                'id'       => 'wc_coupon_listing_section_end',
            )
        );

    }

}
new WC_Coupon_Listing_Settings();
