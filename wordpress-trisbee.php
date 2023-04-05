// Hook Trisbee into the WooCommerce Thank You page
add_action( 'woocommerce_thankyou', 'custom_add_trisbee_payment_button', 9 );

function custom_add_trisbee_payment_button( $order_id ) {
    // Get the order object
    $order = wc_get_order( $order_id );

    // Check if the order was paid using the Trisbee payment method
    if ( $order->get_payment_method() === 'bacs' ) {
        // Get the order total amount and order number
        $order_price = $order->get_total();
        $order_number = $order->get_order_number();
        $return_url = urlencode( wc_get_endpoint_url( 'order-received', $order->get_id(), wc_get_page_permalink( 'checkout' ) ) );

        // Show the payment button
        echo '<a href="https://pay.trisbee.com/VLASTNI-USERNAME/' . $order_price . '/' . $order_number . '" class="trisbee-payment-button">Zaplatit kartou</a>';
    }
}

// Add the payment button to the email confirmation notification
add_action( 'woocommerce_email_before_order_table', 'custom_add_trisbee_payment_button_to_email', 9, 4 );

function custom_add_trisbee_payment_button_to_email( $order, $sent_to_admin, $plain_text, $email ) {
    // Check if the email is being sent to the customer
    if ( ! $sent_to_admin && 'customer_completed_order' === $email->id ) {
        // Check if the order was paid using the Trisbee payment method
        if ( $order->get_payment_method() === 'bacs' ) {
            // Get the order total amount and order number
            $order_price = $order->get_total();
            $order_number = $order->get_order_number();
            $return_url = urlencode( wc_get_endpoint_url( 'order-received', $order->get_id(), wc_get_page_permalink( 'checkout' ) ) );

            // Show the payment button
            echo '<p><a href="https://pay.trisbee.com/VLASTNI-USERNAME/' . $order_price . '/' . $order_number . '" class="trisbee-payment-button">Zaplatit kartou</a></p>';
        }
    }
}
// Add the Trisbee payment button to the Order Details on the My Account page under the order status
add_action( 'woocommerce_order_details_after_order_table_items', 'custom_add_trisbee_payment_button_to_my_account_order', 9, 1 );

function custom_add_trisbee_payment_button_to_my_account_order( $order ) {
    // Check if the order was paid using the Trisbee payment method
    if ( $order->get_payment_method() === 'bacs' ) {
        // Get the order total amount and order number
        $order_price = $order->get_total();
        $order_number = $order->get_order_number();
        $return_url = urlencode( wc_get_endpoint_url( 'order-received', $order->get_id(), wc_get_page_permalink( 'checkout' ) ) );

        // Show the payment button
        echo '<p><a href="https://pay.trisbee.com/VLASTNI-USERNAME/' . $order_price . '/' . $order_number . '" class="trisbee-payment-button">Zaplatit kartou</a></p>';
    }
}
