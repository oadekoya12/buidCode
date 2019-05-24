<?php

/**
 * Formidable Forms Securimage-WP Addon
 *
 * Copyright (c) 2018, Drew Phillips
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Any modifications to the library should be indicated clearly in the source code
 * to inform users that the changes are not a part of the original software.
 */
class SecurimageWPFormidableAddon
{
    private static $_instance;

    public static function register()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        // register form field
        add_filter('frm_available_fields', array(&$this, 'addFormField'), 10, 1);

        // show captcha input
        add_action('frm_form_fields', array(&$this, 'showCaptcha'), 10, 3);

        // form captcha validation
        add_filter('frm_validate_field_entry', array(&$this, 'validate'), 99, 4);
    }

    public function addFormField($fields)
    {
        $fields['securimage_wp'] = __('Securimage-WP', 'securimage-wp');

        return $fields;
    }

    public function showCaptcha($field, $field_name, $params)
    {
        if ($field['type'] != 'securimage_wp') return;

        $html = siwp_captcha_shortcode(array());

        $html = preg_replace('/siwp_captcha_value_\d+/', 'field_' . $field['field_key'], $html);
        $html = str_replace('siwp_captcha_value', $field_name, $html);

        echo $html;
    }

    public function validate($errors, $posted_field, $value, $args)
    {
        if ($posted_field->type != 'securimage_wp') return $errors;

        if (sizeof($errors) == 0) {
            // validate captcha if no other form errors
            $_POST['siwp_captcha_value'] = $value;

            $error = '';
            $failed  = (bool)(siwp_check_captcha($error) == false);

            if ($failed) {
                $errors['field' . $args['id']] = $error;
            }
        }

        return $errors;
    }
}
