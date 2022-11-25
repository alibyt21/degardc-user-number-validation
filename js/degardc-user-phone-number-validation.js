jQuery(document).ready(function($) {
/* start inter number */
    $('#degardc-user-phone-number-validation-form').on('submit',function (event) {

        event.preventDefault();
        var $this = $(this);
        var $mobilenumber = $this.find('#degardc-mobile-number-input').val();
        var $security = $('#_wpnonce').val();

        $.ajax({
            url: degardc_phone_validation_ajax_object.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'degardc_user_phone_number_validation_ajax',
                mobilenumber: $mobilenumber,
                security: $security,
            },
            statusCode: {
                200: function(result) {
                    if(result.error){
                        $('#degardc-validation-message').html(result.message);
                        $('#degardc-validation-notice').removeClass('success');
                        $('#degardc-validation-notice').addClass('error');
                        setTimeout(function() {
                            $('#degardc-validation-notice').removeClass('error');
                        }, 8000);
                    }else{

                        $('#degardc-validation-message').html(result.message);
                        $('#degardc-validation-notice').removeClass('error');
                        $('#degardc-validation-notice').addClass('success');
                        setTimeout(function() {
                            $('#degardc-validation-notice').removeClass('success');
                        }, 8000);
                        $('#degardc-user-phone-number-validation-form').slideUp(800);
						
                        $('#degardc-user-phone-number-validation-verify-number-div').slideDown(800);
               
                        $('#degardc-can-send-code-again').removeClass('degardc-hide');
                        $('#degardc-send-new-code').addClass('degardc-hide');
                        $('.degardc-countdown').html($('#countdown-initial').html()) ;
                        //stop previous interval if existing
                        var previous_interval = $('#previous-counter').html();
                        window.clearInterval(previous_interval);
                        var timer2 = $('#countdown-initial').html();
                        var interval = setInterval(function() {
                            var timer = timer2.split(':');
                            //by parsing integer, I avoid all extra string processing
                            var minutes = parseInt(timer[0], 10);
                            var seconds = parseInt(timer[1], 10);
                            --seconds;
                            minutes = (seconds < 0) ? --minutes : minutes;
                            seconds = (seconds < 0) ? 59 : seconds;
                            seconds = (seconds < 10) ? '0' + seconds : seconds;
                            console.log(minutes, seconds);

                            //minutes = (minutes < 10) ?  minutes : minutes;
                            $('.degardc-countdown').html(minutes + ':' + seconds);
                            if (minutes < 0) clearInterval(interval);
                            //check if both minutes and seconds are 0
                            if ((seconds <= 0) && (minutes <= 0)){
                                clearInterval(interval);
                                $('#degardc-can-send-code-again').addClass('degardc-hide');
                                $('#degardc-send-new-code').removeClass('degardc-hide');
                            }
                            timer2 = minutes + ':' + seconds;
                        }, 1000);
                        $('#previous-counter').html(interval);

                    }
                },
                400: function(result) {

                    $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-validation-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('error');
                    }, 8000);
                    console.log(result.responseText);

                },
                404: function(result) {

                    $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-validation-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('error');
                    }, 8000);
                    console.log(result.responseText);

                },
                500: function(result) {

                    $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-validation-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('error');
                    }, 8000);
                    console.log(result.responseText);

                },
                401: function(result) {

                    $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-validation-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('error');
                    }, 8000);
                    console.log(result.responseText);

                }
            }
        });

    });

  /*change number link */

  $('#degardc-change-mobile-number').on('click',function (event) {
     $('#degardc-user-phone-number-validation-verify-number-div').slideUp(800);
     $('#degardc-user-phone-number-validation-form').slideDown(800);
     
   });

/*start inter verify code*/ 
  $('#degardc-user-phone-number-validation-verify-form').on('submit',function (event) {

    event.preventDefault();
    var $this = $(this);
    var $verifycode = $this.find('#degardc-verification-input').val();
    var $mobilenumber = $('#degardc-user-phone-number-validation-form').find('#degardc-mobile-number-input').val();
    var $security = $('#_wpnonce').val();
    $.ajax({
        url: degardc_phone_validation_ajax_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'degardc_verification_code_ajax',
            verifycode: $verifycode,
            mobilenumber: $mobilenumber,
            security: $security,
        },
        statusCode :{
            200: function(result) {
                if(result.error){
                    $('#degardc-validation-message').html(result.message);
                    $('#degardc-validation-notice').removeClass('success');
                    $('#degardc-validation-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('error');
                    }, 8000);
                }else{
                    $('#degardc-validation-message').html(result.message);
                    $('#degardc-validation-notice').removeClass('error');
                    $('#degardc-validation-notice').addClass('success');
                    /*ino bepors.... */
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('success');
                    }, 8000);
                    window.location.replace(result.redirect);
                }
            },
            400: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            },
            404: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            },
            500: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            },
            401: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            }
        
        }


    });

  });






/*send new code */

$('#degardc-send-new-code').on('click',function (event) {

    var $mobilenumber = $('#degardc-user-phone-number-validation-form').find('#degardc-mobile-number-input').val()
    var $security = $('#_wpnonce').val();

    $.ajax({
        url:  degardc_phone_validation_ajax_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'degardc_user_phone_number_validation_ajax',
            mobilenumber: $mobilenumber,
            security: $security
        },
        statusCode: {
            200: function(result) {
                if(result.error){
                    $('#degardc-validation-message').html(result.message);
                    $('#degardc-validation-notice').removeClass('success');
                    $('#degardc-validation-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('error');
                    }, 8000);
                }else{
               
                    $('#degardc-validation-message').html(result.message);
                    $('#degardc-validation-notice').removeClass('error');
                    $('#degardc-validation-notice').addClass('success');
                    setTimeout(function() {
                        $('#degardc-validation-notice').removeClass('success');
                    }, 8000);
                    
                    $('#degardc-can-send-code-again').removeClass('degardc-hide');
                    $('#degardc-send-new-code').addClass('degardc-hide');
                    $('.degardc-countdown').html($('#countdown-initial').html());

                    //stop previous interval if existing
                    var previous_interval = $('#previous-counter').html();
                    window.clearInterval(previous_interval);

                    var timer2 = $('#countdown-initial').html();
                    var interval = setInterval(function() {
                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = (seconds < 0) ? --minutes : minutes;
                        seconds = (seconds < 0) ? 59 : seconds;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.degardc-countdown').html(minutes + ':' + seconds);
                        if (minutes < 0) clearInterval(interval);
                        //check if both minutes and seconds are 0
                        if ((seconds <= 0) && (minutes <= 0)){
                            clearInterval(interval);
                            $('#degardc-can-send-code-again').addClass('degardc-hide');
                            $('#degardc-send-new-code').removeClass('degardc-hide');
                        }
                        timer2 = minutes + ':' + seconds;
                    }, 1000);
                    $('#previous-counter').html(interval);

                }
            },
            400: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            },
            404: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            },
            500: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            },
            401: function(result) {

                $('#degardc-validation-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                $('#degardc-validation-notice').addClass('error');
                setTimeout(function() {
                    $('#degardc-validation-notice').removeClass('error');
                }, 8000);
                console.log(result.responseText);

            }
        }
    });
});



    $('#degardc-register-form').on('submit',function (event) {

        event.preventDefault();
        var $this = $(this);
        var $email = $this.find('#degardc-email-input').val();
        var $password = $this.find('#degardc-password-input').val();
        var $security = $('#_degardc_register_wpnonce').val();

        $.ajax({
            url: degardc_phone_validation_ajax_object.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'degardc_register_form_ajax',
                email: $email,
                password: $password,
                security: $security,
            },
            statusCode: {
                200: function(result) {
                    if(result.error){
                        $('#degardc-register-message').html(result.message);
                        $('#degardc-register-notice').addClass('error');
                        setTimeout(function() {
                            $('#degardc-register-notice').removeClass('error');
                        }, 10000);
                    }else{

                        $('#degardc-register-message').html(result.message);
                        $('#degardc-register-notice').addClass('success');
                        location.reload();
                        setTimeout(function() {
                            $('#degardc-register-notice').removeClass('success');
                        }, 10000);


                    }
                },
                400: function(result) {

                    $('#degardc-register-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-register-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-register-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                },
                404: function(result) {

                    $('#degardc-register-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-register-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-register-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                },
                500: function(result) {

                    $('#degardc-register-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-register-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-register-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                },
                401: function(result) {

                    $('#degardc-register-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-register-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-register-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                }
            }
        });
    });



    $('#degardc-login-form').on('submit',function (event) {

        event.preventDefault();
        var $this = $(this);
        var $email = $this.find('#degardc-email-input').val();
        var $password = $this.find('#degardc-password-input').val();
        var $rememberme = $('#degardc-rememberme-checkbox:checked').length;
        var $security = $('#_degardc_login_wpnonce').val();

        $.ajax({
            url: degardc_phone_validation_ajax_object.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'degardc_login_form_ajax',
                email: $email,
                password: $password,
                rememberme: $rememberme,
                security: $security,
            },
            statusCode: {
                200: function(result) {
                    if(result.error){
                        $('#degardc-login-message').html(result.message);
                        $('#degardc-login-notice').addClass('error');
                        setTimeout(function() {
                            $('#degardc-login-register-notice').removeClass('error');
                        }, 10000);
                    }else{

                        $('#degardc-login-message').html(result.message);
                        $('#degardc-login-notice').addClass('success');
                        location.reload();
                        setTimeout(function() {
                            $('#degardc-login-notice').removeClass('success');
                        }, 10000);


                    }
                },
                400: function(result) {

                    $('#degardc-login-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-login-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-login-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                },
                404: function(result) {

                    $('#degardc-login-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-login-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-login-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                },
                500: function(result) {

                    $('#degardc-login-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-login-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-login-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                },
                401: function(result) {

                    $('#degardc-login-message').text('خطایی رخ داده است، به پشتیبانی اطلاع دهید');
                    $('#degardc-login-notice').addClass('error');
                    setTimeout(function() {
                        $('#degardc-login-notice').removeClass('error');
                    }, 10000);
                    console.log(result.responseText);

                }
            }
        });
    });


});



