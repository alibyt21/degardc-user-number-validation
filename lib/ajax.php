<?php


function degardc_user_phone_number_validation_ajax(){
    check_ajax_referer('degardc_nonce','security');
    $mobile_number = sanitize_text_field($_POST['mobilenumber']);
    $user_id = get_current_user_id();
    if ( empty($mobile_number) ){
        $result = array(
            'error' => true,
            'message' =>  'لطفا شماره تلفن همراه خود را به صورت کامل وارد کنید',
        );
        wp_send_json($result);
    }
    if(is_user_phone_number_valid_in_iran($mobile_number) ){
        $args = array(
            'meta_query' => array(
                array(
                    'key' => 'degardc_mobile_number',
                    'value' => $mobile_number,
                    'compare' => '='
                )
            )
        );
        $user_with_same_mobile_number = get_users($args);


        if($user_with_same_mobile_number){
            $result = array(
                'error' => true,
                'message' =>  'یک حساب کاربری فعال با شماره وارد شده در سیستم وجود دارد و این شماره قابل استفاده مجدد نیست',
            );
            wp_send_json($result);
        }


        $last_user_try = get_user_meta($user_id , 'degardc_validation_code');
        if( (empty($last_user_try)) || ($last_user_try[0]['number'] != $mobile_number) || ($last_user_try[0]['until']<time()) ){

            $random_number = rand(10000,99999);

            $response = faraz_sms_pattern_for_phone_validation( "voip09356126747" , "alibyt@21A" , "3000505" , 'qncer227zn' , array($mobile_number) , array("verification-code" => $random_number));
            // return int in success

            if(is_numeric($response)){
                $degardc_validation_code['number'] = $mobile_number;
                $degardc_validation_code['code'] = $random_number;
                $degardc_validation_code['until'] = time() + 120;
                update_user_meta($user_id , 'degardc_validation_code', $degardc_validation_code);
                $result = array(
                    'error' => false,
                    'message' =>  "پیامک فعال سازی با موفقیت به شماره <strong>$mobile_number</strong> ارسال شد",
                );
                wp_send_json($result);
            }else{
                $result = array(
                    'error' => true,
                    'message' => 'در ارسال پیامک خطایی رخ داده است، لطفا به پشتیبانی اطلاع دهید',
                );
                wp_send_json($result);
            }
        }else{
            $result = array(
                'error' => true,
                'message' => 'لطفا صبر کنید، درخواست قبلی شما هنوز معتبر است',
            );
            wp_send_json($result);
        }
    }else{
        $result = array(
            'error' => true,
            'message' => 'شماره تلفن همراه وارد شده نامعتبر است',
        );
        wp_send_json($result);
    }
    die();
}
add_action('wp_ajax_degardc_user_phone_number_validation_ajax', 'degardc_user_phone_number_validation_ajax');
add_action('wp_ajax_nopriv_degardc_user_phone_number_validation_ajax', 'degardc_user_phone_number_validation_ajax');


function degardc_verification_code_ajax(){

    check_ajax_referer('degardc_nonce','security');
	$user_verification_code = sanitize_text_field($_POST['verifycode']);
    $mobile_number = sanitize_text_field($_POST['mobilenumber']);
    $user_id = get_current_user_id();
    if (empty($user_verification_code)){
        $result = array(
            'error' => true,
            'message' =>  'لطفا کد ارسال شده را به صورت کامل وارد کنید',
        );
        wp_send_json($result);
    }
    $last_user_try = get_user_meta($user_id , 'degardc_validation_code');
    $system_verification_code = $last_user_try[0]['code'];
    if( $system_verification_code != $user_verification_code){
        $result = array(
            'error' => true,
            'message' =>  'کد وارد شده اشتباه است، لطفا مجددا تلاش کنید',
        );
        wp_send_json($result);
    }else{
        if($mobile_number != $last_user_try[0]['number']){
            $result = array(
                'error' => true,
                'message' =>  'شماره همراه وارد شده نامعتبر است، در صورت نیاز به پشتیبانی اطلاع دهید',
            );
            wp_send_json($result);
        }else{
            if(!update_user_meta($user_id ,'degardc_mobile_number', $mobile_number) || !update_user_meta($user_id ,'billing_phone', $mobile_number)){
                $result = array(
                    'error' => true,
                    'message' =>  'در ذخیره سازی شماره همراه شما خطایی رخ داده است، لطفا چند دقیقه بعد مجددا تلاش کنید',
                );
                wp_send_json($result);
            }else{

                    delete_user_meta($user_id , 'degardc_validation_code');
                    $redirect_path = wc_get_checkout_url();
                    $result = array(
                        'error' => false,
                        'message' =>  'شماره شما با موفقیت تایید شد',
                        'redirect' => $redirect_path,
                    );
                    wp_send_json($result);
            }
        }
    }
	
}

add_action('wp_ajax_degardc_verification_code_ajax','degardc_verification_code_ajax');
add_action('wp_ajax_nopriv_degardc_verification_code_ajax','degardc_verification_code_ajax');



function degardc_register_form_ajax(){

    check_ajax_referer('degardc_register_nonce','security');
    $email = sanitize_text_field($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    if ( empty($email) || empty($password) ){
        $result = array(
            'error' => true,
            'message' => 'لطفا فرم را به صورت کامل تکمیل کنید'
        );
        wp_send_json($result);
    }
    if ( !filter_var( $email , FILTER_VALIDATE_EMAIL) ){
        $result = array(
            'error' => true,
            'message' => 'لطفا ایمیل خود را به صورت صحیح وارد کنید'
        );
        wp_send_json($result);
    }
    if ( email_exists($email) ){
        //it means that email is already registered in this site and we have to login

        $creds = array(
            'user_login'    => $email,
            'user_password' => $password,
            'remember'      => true
        );
        $wp_signon_result = wp_signon( $creds, false );
        if ( is_wp_error( $wp_signon_result ) ) {
            $result = array(
                'error' => true,
                'message' => $wp_signon_result->get_error_message(),
            );
            wp_send_json($result);
        }else{
            $result = array(
                'error' => false,
                'message' => 'شما با موفقیت وارد سایت شدید',
            );
            wp_send_json($result);
        }
    }else{
        //it means that email is new user and we have to register the user

        $user_login = substr($email, 0, strrpos($email, '@'));
        $creds = array(
            'user_login' => $user_login,
            'user_email' => $email,
            'user_pass'  => $password,
            'show_admin_bar_front' => 'false',
        );

        //in success return new user id
        $wp_insert_user_result = wp_insert_user($creds);

        if( is_wp_error($wp_insert_user_result) ){
            $result = array(
                'error' => true,
                'message' => $wp_insert_user_result->get_error_message(),
            );
            wp_send_json($result);
        }else{
            $creds = array(
                'user_login'    => $email,
                'user_password' => $password,
                'remember'      => true
            );
            $wp_signon_result = wp_signon( $creds, false );
            if( is_wp_error($wp_signon_result) ){
                $result = array(
                    'error' => true,
                    'message' =>  'حساب کاربری شما با موفقیت ایجاد شد، اما در ورود شما به سایت مشکلی رخ داده است، لطفا به پشتیبانی اطلاع دهید',
                );
                wp_send_json($result);
            }else{
                $result = array(
                    'error' => false,
                    'message' => 'حساب کاربری شما با موفقیت ایجاد شد',
                );
                wp_send_json($result);
            }
        }
    }
    die();
}
add_action('wp_ajax_degardc_register_form_ajax','degardc_register_form_ajax');
add_action('wp_ajax_nopriv_degardc_register_form_ajax','degardc_register_form_ajax');







function degardc_login_form_ajax(){

    check_ajax_referer('degardc_login_nonce','security');
    $email = sanitize_text_field($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $rememberme = sanitize_text_field($_POST['rememberme']);
    if ( empty($email) || empty($password) ){
        $result = array(
            'error' => true,
            'message' => 'لطفا فرم را به صورت کامل تکمیل کنید'
        );
        wp_send_json($result);
    }
    if ( !filter_var( $email , FILTER_VALIDATE_EMAIL) ){
        $result = array(
            'error' => true,
            'message' => 'لطفا ایمیل خود را به صورت صحیح وارد کنید'
        );
        wp_send_json($result);
    }
    if ( email_exists($email) ){
        //it means that email is already registered in this site and we have to login

        $creds = array(
            'user_login'    => $email,
            'user_password' => $password,
            'remember'      => $rememberme,
        );
        $wp_signon_result = wp_signon( $creds, false );
        if ( is_wp_error( $wp_signon_result ) ) {
            $result = array(
                'error' => true,
                'message' => $wp_signon_result->get_error_message(),
            );
            wp_send_json($result);
        }else{
            $result = array(
                'error' => false,
                'message' => 'شما با موفقیت وارد سایت شدید',
            );
            wp_send_json($result);
        }
    }else{
        $result = array(
            'error' => true,
            'message' => 'شما هنوز در سایت ثبت نام نکرده‌اید، لطفا از بخش ثبت نام ابتدا برای خود یک حساب کاربری جدید ایجاد کنید'
        );
        wp_send_json($result);
    }
}
add_action('wp_ajax_degardc_login_form_ajax','degardc_login_form_ajax');
add_action('wp_ajax_nopriv_degardc_login_form_ajax','degardc_login_form_ajax');


