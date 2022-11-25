<div class="degardc-container" id="degardc-enter-phone-container">
    <div class="degardc-main-content" id="degardc-enter-phone-main-content">
        <img width="96" height="96" src="https://degardc.com/wp-content/uploads/verify.svg" class="attachment-full size-full" alt="" loading="lazy">
        <h2>تایید شماره موبایل</h2>
        <p style="padding-bottom: 25px;">برای ادامه فرآیند خرید لازم است تا شماره همراه خود را تایید نمایید</p>
        <div id="degardc-user-phone-number-validation-box">
        <form id="degardc-user-phone-number-validation-form">

            <div class="degardc-section">
                <div class="degardc-form-element degardc-form-input" id="degardc-password-input-div">
                    <input id="degardc-mobile-number-input" class="degardc-form-element-field" placeholder="به عنوان مثال : 09123456789" type="tel" pattern="[0]{1}[9]{1}[0-9]{9}" required="required" oninvalid="this.setCustomValidity('لطفا شماره تلفن همراه خود را به صورت کامل و صحیح وارد کنید، به عنوان مثال : 09123456789')" oninput="setCustomValidity('')">
                    <div class="degardc-form-element-bar"></div>
                    <label class="degardc-form-element-label" for="degardc-mobile-number-input">لطفا شماره همراه خود را برای دریافت کد تایید وارد کنید</label>
                </div>
            </div>

            <button class="degardc-button" style="width: 210px !important;"><span>ارسال کد فعالسازی</span></button>

        </form>
    </div>

        <div class="degardc-notice" id="degardc-validation-notice">
            <p class="degardc-message" id="degardc-validation-message"></p>
        </div>

        <div class="degardc-hide" id="countdown-initial">2:00</div>
        <div class="degardc-hide" id="previous-counter"></div>
        <?php wp_nonce_field( 'degardc_nonce' ); ?>

        <div id="degardc-user-phone-number-validation-verify-number-div" style="display: none">
            <form id="degardc-user-phone-number-validation-verify-form">
                <div class="degardc-section">
                    <div class="degardc-form-element degardc-form-input" id="degardc-password-input-div">
                        <input type="text" maxlength="5" id="degardc-verification-input" class="degardc-form-element-field" placeholder=" " autofocus>
                        <div class="degardc-form-element-bar"></div>
                        <label class="degardc-form-element-label" for="degardc-verification-input">لطفا کد تایید ارسال شده را وارد کنید</label>
                    </div>
                </div>
                        <div class="degardc-section degardc-center">
                    <div class="degardc-inline" id="degardc-can-send-code-again">
                        <div class="degardc-inline degardc-disable"> دریافت مجدد کد تا </div>
                        <div class="degardc-countdown degardc-inline degardc-disable">2:00</div>
                    </div>
                    <div class="degardc-inline degardc-pointer degardc-hide" id="degardc-send-new-code">دریافت مجدد کد</div>
                    <div class="degardc-inline" style="margin:0 5px;color:#4aaefe;font-size:1.5em;font-weight:900;pointer-events:none;"> / </div>
                    <div class="degardc-inline degardc-pointer" id="degardc-change-mobile-number"> اصلاح شماره موبایل </div>
                </div>
                <button class="degardc-button" style="width: 210px !important;"><span>تایید کد و ادامه خرید</span></button>
            </form>
        </div>
    </div>
</div>