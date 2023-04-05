// Hook  Trisbee into the WooCommerce Thank You page

add_action( 'woocommerce_thankyou', 'custom_add_trisbee_payment_button', 9 );


function custom_add_trisbee_payment_button( $order_id ) {

    // Get the order object

    $order = wc_get_order( $order_id );


    // Check if the order was paid using the Trisbee payment method

    if ( $order->get_payment_method() === 'bacs' ) {

        // Get the order total amount and order number

        $order_price = $order->get_total();

        $order_number = $order->get_order_number();


        // Show the payment button

        echo '<a href="https://pay.trisbee.com/VLASTNI-USER/' . $order_price . '/' . $order_number . '" class="trisbee-payment-button">Zaplatit kartou</a>';

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


            // Show the payment button

            echo '<p><a href="https://pay.trisbee.com/VLASTNI-USERNAME/' . $order_price . '/' . $order_number . '" class="trisbee-payment-button">Zaplatit kartou</a></p>';

        }

    }

}