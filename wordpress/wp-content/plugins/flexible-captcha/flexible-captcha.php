<?php
/*
Plugin Name: Flexible Captcha
Plugin URI: http://www.sterupdesign.com/dev/wordpress/plugins/flexible-captcha/
Description: A plugin to create configurable captcha images on any form.
Version: 4.0.2
Author: Jeff Sterup
Author URI: http://www.sterupdesign.com
License: GPL2
*/
require_once(WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)) . "/lib/FlexibleCaptcha.class.php");


$FlexibleCaptcha = new FlexibleCaptcha(__FILE__);
?>