<form id="degardc-register-form">
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
            <input id="degardc-password-input" class="degardc-form-element-field" placeholder="لطفا یک رمز عبور برای خود انتخاب کنید، حتما توجه کنید که صفحه کلید شما انگلیسی باشد" type="password" required="required" oninvalid="this.setCustomValidity('لطفا یک رمز عبور برای خود انتخاب کنید، دقت کنید که کیبورد شما به اشتباه فارسی نباشد')" oninput="setCustomValidity('')">
            <div class="degardc-form-element-bar"></div>
            <label class="degardc-form-element-label" for="degardc-password-input">رمز عبور خود را انتخاب کنید</label>
            <p class="degardc-form-element-hint" id="degardc-password-error"></p>
        </div>
    </div>
    <button class="degardc-button degardc-left" style="margin:0 !important;background-color: #fe597b;"><span>ثبت نام در سایت</span></button>
</form>


<div class="degardc-notice" id="degardc-register-notice">
    <p class="degardc-message" id="degardc-register-message"></p>
</div>
<?php $register_ajax_nonce = wp_create_nonce( 'degardc_register_nonce' ); ?>
<input type="hidden" id="_degardc_register_wpnonce" name="_wpnonce" value="<?php echo $register_ajax_nonce; ?>">

