<form id="degardc-login-form">
    <div class="degardc-section">
        <div class="degardc-form-element degardc-form-input" id="degardc-email-input-div">
            <input id="degardc-email-input" class="degardc-form-element-field" placeholder="به عنوان مثال : aliramezani@gmail.com" type="email" required="required" oninvalid="this.setCustomValidity('لطفا ایمیل خود را به صورت کامل و صحیح وارد کنید')" oninput="setCustomValidity('')">
            <div class="degardc-form-element-bar"></div>
            <label class="degardc-form-element-label" for="degardc-email-input">پست الکترونیک (ایمیل) خود را وارد کنید</label>
            <p class="degardc-form-element-hint" id="degardc-email-error"></p>
        </div>
    </div>
    <div class="degardc-section">
        <div class="degardc-form-element degardc-form-input" id="degardc-password-input-div">
            <input id="degardc-password-input" class="degardc-form-element-field" placeholder="حتما توجه کنید که صفحه کلید شما انگلیسی باشد" type="password" required="required" oninvalid="this.setCustomValidity('لطفا رمز عبور خود را وارد کنید، دقت کنید که کیبورد شما به اشتباه فارسی نباشد')" oninput="setCustomValidity('')">
            <div class="degardc-form-element-bar"></div>
            <label class="degardc-form-element-label" for="degardc-password-input">رمز عبور خود را وارد کنید</label>
            <p class="degardc-form-element-hint" id="degardc-password-error"></p>
        </div>
    </div>
    <a href="https://degardc.com/my-account/lost-password/" class="degardc-forgat-password">گذرواژه خود را فراموش کرده اید؟</a>
    <button class="degardc-button degardc-left" style="margin:0 !important;"><span>ورود به سایت</span></button>
    <label class="degardc-form-checkbox-label" style="width: 40%; margin-top: 35px;">
        <input name="rememberme" class="degardc-form-checkbox-field" id="degardc-rememberme-checkbox" type="checkbox">
        <i class="degardc-form-checkbox-button"></i>
        <span style="font-size: 15px;">مرا به خاطر بسپار</span>
    </label>
</form>


<div class="degardc-notice" id="degardc-login-notice">
    <p class="degardc-message" id="degardc-login-message"></p>
</div>
<?php $login_ajax_nonce = wp_create_nonce( 'degardc_login_nonce' ); ?>
<input type="hidden" id="_degardc_login_wpnonce" name="_wpnonce" value="<?php echo $login_ajax_nonce; ?>">