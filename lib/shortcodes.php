<?php
add_shortcode( 'degardc_user_phone_number_validation', 'degardc_user_phone_number_validation_callback' );
function degardc_user_phone_number_validation_callback(){

    $current_user = wp_get_current_user();

    $degardc_mobile_number = $current_user -> degardc_mobile_number;

    if(!is_user_logged_in()){
        echo do_shortcode( '[elementor-template id="5181"]' );
    }

    else if(is_user_logged_in() and empty($degardc_mobile_number)){

        ob_start();
        include DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/tpl/user-number-validation-html.php';
        $html = ob_get_clean();
        return $html;

    }else{
        echo do_shortcode( '[elementor-template id="5177"]' );
    }

}


add_shortcode( 'degardc_register_form', 'degardc_register_form_callback' );
function degardc_register_form_callback(){

    ob_start();
    include DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/tpl/register-form-html.php';
    $html = ob_get_clean();
    return $html;

}



add_shortcode( 'degardc_login_form', 'degardc_login_form_callback' );
function degardc_login_form_callback(){

    ob_start();
    include DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/tpl/login-form-html.php';
    $html = ob_get_clean();
    return $html;

}
