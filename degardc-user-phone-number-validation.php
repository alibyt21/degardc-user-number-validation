<?php

/**
 * Plugin Name: Degardc phone number validation
 * Author: Sahar Daraie
 * Author URI: https://degardc.com
 * Version: 1.0.0
 * Description: Confirm users phone number
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */


define('DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH',plugin_dir_path(__FILE__));
define('DEGARDC_USER_PHONE_NUMBER_VALIDATION_URL',plugin_dir_url(__FILE__));
include_once DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/lib/functions.php';
include_once DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/lib/shortcodes.php';
include_once DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/lib/hooks.php';
include_once DEGARDC_USER_PHONE_NUMBER_VALIDATION_PATH . '/lib/ajax.php';