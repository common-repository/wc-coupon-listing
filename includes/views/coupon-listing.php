<?php if ( !defined( 'ABSPATH' ) ) exit; ?>

<div class="clear"></div>

<div class="wc-coupon-listing">
    <h2 class="wc-coupon-listing__heading"><?php echo esc_html( get_option( 'wc_coupon_listing_title', __( 'We have a deal for you!', 'wc-coupon-listing' ) ) ); ?></h2>

    <div class="wc-coupon-listing__coupon-wrapper">
        <div class="wc-coupon-listing__arrow"></div>

        <div class="wc-coupon-listing__coupon-items">
            <?php
            $total_displayed_coupons = 0;

            foreach ( $coupons as $coupon ) :
                if ( $coupon->get_amount() >= $product->get_price() ) {
                    continue;
                }

                $total_displayed_coupons++;
                ?>
                <div class="wc-coupon-listing__coupon-item">
                    <?php
                    $coupon_amount = $coupon->get_amount();
                    $product_price = $product->get_price();

                    switch ( $coupon->get_discount_type() ) {
                        case 'percent':
                            $product_price_after = $product_price - ( $product_price * ( $coupon_amount / 100 ) );
                            $formatted_coupon_amount = $coupon_amount . '%';
                            break;

                        default:
                            $product_price_after = $product_price - $coupon_amount;
                            $formatted_coupon_amount = wp_strip_all_tags( wc_price( $coupon_amount ) );
                            break;
                    }
                    ?>

                    <span class="wc-coupon-listing__coupon-title">
                        <?php
                        printf( esc_html__( 'Get %s Off', 'wc-coupon-listing' ), $formatted_coupon_amount );

                        if ( $coupon->get_free_shipping() ) {
                            esc_html_e( ' &amp; Free Shipping', 'wc-coupon-listing' );
                        }
                        ?>
                    </span>

                    <div class="wc-coupon-listing__coupon-code"><?php printf( __( 'Use this coupon code: <span>%s</span>', 'wc-coupon-listing' ), $coupon->get_code() ); ?></div>

                    <div class="wc-coupon-listing__coupon-info">
                        <?php if ( $coupon->get_description() ) : ?>
                            <span class="wc-coupon-listing__coupon-description"><?php echo rtrim( esc_html( $coupon->get_description() ), '.' ) . '.'; ?></span>
                        <?php endif; ?>

                        <span class="wc-coupon-listing__coupon-minimum-spend">
                            <?php
                            $coupon_minimum_spend = $coupon->get_minimum_amount();

                            if ( $coupon_minimum_spend > 0 ) {
                                printf( esc_html__( 'Minimum spend %s.', wp_strip_all_tags( wc_price( $coupon_minimum_spend ) ), 'wc-coupon-listing' ) );
                            } else {
                                printf( esc_html__( 'No minimum spend.', 'wc-coupon-listing' ) );
                            }
                            ?>
                        </span>

                        <?php if ( $coupon->get_date_expires() ) : ?>
                            <span class="wc-coupon-listing__coupon-expires"><?php printf( esc_html__( 'Valid till %s.', 'wc-coupon-listing' ), wc_format_datetime( $coupon->get_date_expires(), 'd/m/Y' ) ); ?></span>
                        <?php endif; ?>

                        <br>
                        <span class="wc-coupon-listing__coupon-after-discount">
                            <?php printf( __( 'After discount: <strong>%s</strong>', 'wc-coupon-listing' ), wp_strip_all_tags( wc_price( $product_price_after ) ) ); ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ( $total_displayed_coupons > 1 ) : ?>
        <span class="wc-coupon-listing__more"><?php esc_html_e( 'See more promotions ▼', 'wc-coupon-listing' ); ?></span>
    <?php endif; ?>
</div>
