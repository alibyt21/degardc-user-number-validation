<?php

add_action('wp_enqueue_scripts','degardc_user_phone_number_validation_styles');
function degardc_user_phone_number_validation_styles(){
	if ( is_checkout() ) {
		wp_enqueue_style('degardc_user_phone_number_validation-style', DEGARDC_USER_PHONE_NUMBER_VALIDATION_URL . 'css/style.css' );
		wp_register_script('degardc_user_phone_number_validation-js' , DEGARDC_USER_PHONE_NUMBER_VALIDATION_URL . 'js/degardc-user-phone-number-validation.js' , array('jquery'), false , true );
		wp_enqueue_script('degardc_user_phone_number_validation-js');
		/*
		 * 	send data by ajax to degardc-services-main-scripts.js
		 */
		wp_localize_script('degardc_user_phone_number_validation-js' , 'degardc_phone_validation_ajax_object' , array('ajax_url' => admin_url('admin-ajax.php')));
	}  
}

/*force woocommerce post_meta to set order phone number to degardc_mobile_number*/
add_action('woocommerce_new_order', 'degardc_force_validated_phone');
function degardc_force_validated_phone(){
    $user_id = get_current_user_id(); // The current user ID
    // Get the WC_Customer instance Object for the current user
    $customer = new WC_Customer( $user_id );
    // Get the last WC_Order Object instance from current customer
    $last_order = $customer->get_last_order();
    $last_order_id = $last_order->get_id();
    $current_user = wp_get_current_user();
    $degardc_mobile = $current_user -> degardc_mobile_number;
    update_post_meta($last_order_id , '_billing_phone', $degardc_mobile);
}

/*remove phone and email address from checkout page*/
add_filter( 'woocommerce_checkout_fields' , 'degardc_remove_checkout_email_phone_fields' );
function degardc_remove_checkout_email_phone_fields( $fields ) {
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_email']);
    return $fields;
}