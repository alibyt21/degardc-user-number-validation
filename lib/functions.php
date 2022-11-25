<?php


function faraz_sms_pattern_for_phone_validation($username, $password, $from , $pattern_code , $to , $input_data){

    $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
    $handler = curl_init($url);
    curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handler);
    return $response;

}

function is_user_phone_number_valid_in_iran($mobile_number){
    if(preg_match("/^09[0-9]{9}$/", $mobile_number) || preg_match("/^9[0-9]{9}$/", $mobile_number)) {
        return true;
    }else{
        return false;
    }
}
