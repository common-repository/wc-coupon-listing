<?php
if ( !defined( 'ABSPATH' ) ) exit;

class WC_Coupon_Listing_Product {

    // Constructor
    public function __construct() {

        $is_enabled = get_option( 'wc_coupon_listing_show_on_product_page', 'yes' ) == 'yes';

        if ( !$is_enabled ) {
            return;
        }

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( $this->get_coupon_listing_product_hook(), array( $this, 'display_coupons' ) );

    }

    // Enqueue styles and scripts in frontend
    public function enqueue_scripts() {

        wp_enqueue_style( 'wc-coupon-listing', WC_COUPON_LISTING_URL . 'assets/css/style.css', array(), WC_COUPON_LISTING_VERSION );
        wp_enqueue_script( 'wc-coupon-listing', WC_COUPON_LISTING_URL . 'assets/js/script.js', array( 'jquery' ), WC_COUPON_LISTING_VERSION );

        wp_add_inline_style( 'wc-coupon-listing', $this->add_inline_styles() );

        wp_localize_script( 'wc-coupon-listing', 'wc_coupon_listing',
            array(
                'mobile_screen_size' => absint( get_option( 'wc_coupon_listing_mobile_screen_size', 599 ) ),
            )
        );

    }

    // Enqueue inline styles in frontend
    public function add_inline_styles() {

        $mobile_screen_size = absint( get_option( 'wc_coupon_listing_mobile_screen_size', 599 ) );

        return '
            @media screen and (max-width: ' . $mobile_screen_size . 'px) {
                .wc-coupon-listing__coupon-items {
                    display: flex;
                    overflow: auto;
                }
                .wc-coupon-listing__coupon-item {
                    width: 60vw;
                    flex-shrink: 0;
                    margin-right: 15px;
                }
                .wc-coupon-listing__coupon-item:last-child {
                    margin-right: 0;
                }
            }
            @media screen and (min-width: ' . ( $mobile_screen_size + 1 ) . 'px) {
                .wc-coupon-listing__coupon-item {
                    display: none;
                }
                .wc-coupon-listing__coupon-item:first-child,
                .wc-coupon-listing__coupon-wrapper.show .wc-coupon-listing__coupon-item {
                    display: block;
                }
                .wc-coupon-listing__coupon-item {
                    margin-bottom: 15px;
                }
                .wc-coupon-listing__coupon-item:last-child {
                    margin-bottom: 0;
                }
            }
            @media screen and (max-width: ' . $mobile_screen_size . 'px) {
                .wc-coupon-listing__more {
                    display: none;
                }
            }
        ';

    }

    // Get hook to display coupon listing in product page
    private function get_coupon_listing_product_hook() {

        $product_page_position = get_option( 'wc_coupon_listing_required_product' );

        switch ( $product_page_position ) {
            case 'after_product_summary':
                $hook = 'woocommerce_single_product_summary';
                break;

            case 'before_variations_form':
                $hook = 'woocommerce_before_variations_form';
                break;

            case 'after_variations_form':
                $hook = 'woocommerce_after_variations_form';
                break;

            case 'before_add_to_cart_form':
                $hook = 'woocommerce_before_add_to_cart_form';
                break;

            case 'after_add_to_cart_form':
                $hook = 'woocommerce_after_add_to_cart_form';
                break;

            case 'before_product_meta':
                $hook = 'woocommerce_product_meta_start';
                break;

            case 'after_product_meta':
                $hook = 'woocommerce_product_meta_end';
                break;

            default:
                $hook = 'woocommerce_after_add_to_cart_form';
                break;
        }

        return $hook;

    }

    // Display coupon listing in product page
    public function display_coupons() {

        global $post;

        $product = wc_get_product( $post );
        $coupons = $this->get_available_coupons( $product );

        if ( $coupons ) {
            include_once( WC_COUPON_LISTING_PATH . 'includes/views/coupon-listing.php' );
        }

    }

    // Get a list of available coupons for specified product
    private function get_available_coupons( $product ) {

        $coupon_ids = get_posts( array(
            'post_type'   => 'shop_coupon',
            'post_status' => 'publish',
            'numberposts' => -1,
            'fields'      => 'ids',
        ) );

        $wc_available_coupons = array();

        foreach ( $coupon_ids as $coupon_id ) {
            $wc_coupon = new WC_Coupon( $coupon_id );

            if ( $wc_coupon->is_valid_for_product( $product ) ) {
                $wc_available_coupons[] = $wc_coupon;
            }
        }

        return $wc_available_coupons;

    }

}
new WC_Coupon_Listing_Product();
