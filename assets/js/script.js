jQuery( document ).ready( function( $ ) {
    showMoreCouponListing();

    $( window ).on( 'resize', function() {
        showMoreCouponListing();
    } );

    function showMoreCouponListing() {
        if ( $(window).width() > wc_coupon_listing.mobile_screen_size ) {
            $( '.wc-coupon-listing' ).height( $( '.wc-coupon-listing' ).height() );
        }

        $( '.wc-coupon-listing' )
            .on( 'mouseover', function() {
                var couponItem = $( '.wc-coupon-listing__coupon-item' );

                if ( $(window).width() > wc_coupon_listing.mobile_screen_size && couponItem.length > 1 ) {
                    $( this ).find( '.wc-coupon-listing__coupon-wrapper' ).addClass( 'show' );
                }
            } )
            .on( 'mouseleave', function() {
                var couponItem = $( '.wc-coupon-listing__coupon-item' );

                if ( $(window).width() > wc_coupon_listing.mobile_screen_size && couponItem.length > 1 ) {
                    $( this ).find( '.wc-coupon-listing__coupon-wrapper' ).removeClass( 'show' );
                }
            } );
    }
} );
