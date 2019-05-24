<?php
/*
Plugin Name: Single Sign On with ADFS/Azure AD/Windows
Plugin URI: http://miniorange.com/
Description: Single Sign On using Windows Credentials for automatic login into WordPress website.
Version: 4.9.8
Author: miniOrange
Author URI: http://miniorange.com/
*/


include_once dirname( __FILE__ ) . '/mo_login_saml_sso_widget.php';
require('mo-saml-class-customer.php');
require('mo_saml_settings_page.php');
require('feedback_form.php');
class iwa_mo_login {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'miniorange_iwa_menu' ) );
		add_action( 'admin_init', array( $this, 'miniorange_login_widget_saml_save_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'plugin_settings_style' ) );
		register_deactivation_hook(__FILE__, array( $this, 'miniorange_iwa_deactivate'));
		//register_uninstall_hook(__FILE__, array( 'saml_mo_login', 'mo_sso_saml_uninstall'));
		add_action( 'admin_enqueue_scripts', array( $this, 'plugin_settings_script' ) );
		//add_action( 'plugins_loaded', array( $this, 'mo_login_widget_text_domain' ) );
		remove_action( 'admin_notices', array( $this, 'mo_iwa_success_message') );
		remove_action( 'admin_notices', array( $this, 'mo_iwa_error_message') );
		add_action('wp_authenticate', array( $this, 'mo_iwa_authenticate' ) );
		add_shortcode( 'MO_IWA_FORM', array($this, 'mo_get_iwa_shortcode') );
		add_action( 'admin_footer', array( $this, 'feedback_request' ) );
		update_option( 'mo_iwa_host_name', 'https://auth.miniorange.com' );
	}

	function feedback_request() {

		display_windows_feedback_form();
	}

	function  mo_iwa_login_widget_saml_options () {
		global $wpdb;
		$host_name = get_option('mo_iwa_host_name');

		$token = get_option('mo_iwa_x509_certificate');

		mo_register_iwa();
	}

	function mo_iwa_success_message() {
		$class = "error";
		$message = get_option('mo_iwa_message');
		echo "<div class='" . $class . "'> <p>" . $message . "</p></div>";
	}

	function mo_iwa_error_message() {
		$class = "updated";
		$message = get_option('mo_iwa_message');
		echo "<div class='" . $class . "'> <p>" . $message . "</p></div>";
	}

	public function miniorange_iwa_deactivate() {
		if(!is_multisite()) {
			//delete all customer related key-value pairs
			delete_option('mo_iwa_host_name');
			delete_option('mo_iwa_new_registration');
			delete_option('mo_iwa_admin_phone');
			delete_option('mo_iwa_admin_password');
			delete_option('mo_iwa_verify_customer');
			delete_option('mo_iwa_admin_customer_key');
			delete_option('mo_iwa_admin_api_key');
			delete_option('mo_iwa_customer_token');
			delete_option('mo_iwa_message');
			delete_option('mo_iwa_registration_status');
			delete_option('mo_iwa_idp_config_complete');
			delete_option('mo_iwa_transactionId');
		} else {
			global $wpdb;
			$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
			$original_blog_id = get_current_blog_id();

			foreach ( $blog_ids as $blog_id )
			{
				switch_to_blog( $blog_id );
				//delete all your options
				//E.g: delete_option( {option name} );
				delete_option('mo_iwa_host_name');
				delete_option('mo_iwa_new_registration');
				delete_option('mo_iwa_admin_phone');
				delete_option('mo_iwa_admin_password');
				delete_option('mo_iwa_verify_customer');
				delete_option('mo_iwa_admin_customer_key');
				delete_option('mo_iwa_admin_api_key');
				delete_option('mo_iwa_customer_token');
				delete_option('mo_iwa_message');
				delete_option('mo_iwa_registration_status');
				delete_option('mo_iwa_idp_config_complete');
				delete_option('mo_iwa_transactionId');
			}
			switch_to_blog( $original_blog_id );
		}
	}

	function mo_iwa_show_success_message() {
		remove_action( 'admin_notices', array( $this, 'mo_iwa_success_message') );
		add_action( 'admin_notices', array( $this, 'mo_iwa_error_message') );
	}
	function mo_iwa_show_error_message() {
		remove_action( 'admin_notices', array( $this, 'mo_iwa_error_message') );
		add_action( 'admin_notices', array( $this, 'mo_iwa_success_message') );
	}
	function plugin_settings_style() {
		wp_enqueue_style( 'mo_saml_admin_settings_style', plugins_url( 'includes/css/style_settings.css?ver=3.7', __FILE__ ) );
		wp_enqueue_style( 'mo_saml_admin_settings_phone_style', plugins_url( 'includes/css/phone.css', __FILE__ ) );
		/*This script is added to include Font Awesome in the plugin.*/
		wp_enqueue_style( 'mo_saml_wpb-fa', plugins_url( 'includes/css/font-awesome.min.css', __FILE__ ) );
	}
	function plugin_settings_script() {
		wp_enqueue_script( 'mo_saml_admin_settings_script', plugins_url( 'includes/js/settings.js', __FILE__ ) );
		wp_enqueue_script( 'mo_saml_admin_settings_phone_script', plugins_url('includes/js/phone.js', __FILE__ ) );
	}
	function miniorange_login_widget_saml_save_settings(){
		if(isset($_POST['option']) and $_POST['option'] == "mo_iwa_login_widget_saml_save_settings"){
			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Save Identity Provider Configuration failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			//validation and sanitization
			$saml_identity_name = '';
			$saml_login_url = '';
			$saml_issuer = '';
			$saml_x509_certificate = '';
			if( $this->mo_iwa_check_empty_or_null( $_POST['saml_identity_name'] ) || $this->mo_iwa_check_empty_or_null( $_POST['saml_login_url'] ) || $this->mo_iwa_check_empty_or_null( $_POST['saml_issuer'] )  ) {
				update_option( 'mo_iwa_message', 'All the fields are required. Please enter valid entries.');
				$this->mo_iwa_show_error_message();
				return;
			} else if(!preg_match("/^\w*$/", $_POST['saml_identity_name'])) {
				update_option( 'mo_iwa_message', 'Please match the requested format for Identity Provider Name. Only alphabets, numbers and underscore is allowed.');
				$this->mo_iwa_show_error_message();
				return;
			} else{
				$saml_identity_name = trim( $_POST['saml_identity_name'] );
				$saml_login_url = trim( $_POST['saml_login_url'] );
				$saml_issuer = trim( $_POST['saml_issuer'] );
				$saml_x509_certificate = trim( $_POST['saml_x509_certificate'] );
			}

			update_option('mo_iwa_identity_name', $saml_identity_name);
			update_option('mo_iwa_login_url', $saml_login_url);
			update_option('mo_iwa_issuer', $saml_issuer);
			update_option('mo_iwa_x509_certificate', $saml_x509_certificate);
			if(isset($_POST['saml_response_signed']))
				{
				update_option('mo_iwa_response_signed' , 'checked');
				}
			else
				{
				update_option('mo_iwa_response_signed' , 'Yes');
				}
			if(isset($_POST['saml_assertion_signed']))
				{
				update_option('mo_iwa_assertion_signed' , 'checked');
				}
			else
				{
				update_option('mo_iwa_assertion_signed' , 'Yes');
				}

			update_option('mo_iwa_x509_certificate', Utilities::sanitize_certificate( $saml_x509_certificate ) );
			update_option('mo_iwa_message', 'Identity Provider details saved successfully.');
			$this->mo_iwa_show_success_message();
		}
		//Save Attribute Mapping
		if(isset($_POST['option']) and $_POST['option'] == "mo_iwa_login_widget_saml_attribute_mapping"){

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Save Attribute Mapping failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			update_option('mo_iwa_am_first_name', stripslashes($_POST['saml_am_first_name']));
			update_option('mo_iwa_am_last_name', stripslashes($_POST['saml_am_last_name']));
			update_option('mo_iwa_am_account_matcher', stripslashes($_POST['saml_am_account_matcher']));
			update_option('mo_iwa_message', 'Attribute Mapping details saved successfully');
			$this->mo_iwa_show_success_message();

		}
		//Save Role Mapping
		else if(isset($_POST['option']) and $_POST['option'] == "login_widget_saml_role_mapping"){

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Save Role Mapping failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			update_option('mo_iwa_am_default_user_role', $_POST['saml_am_default_user_role']);
			update_option('mo_iwa_message', 'Role Mapping details saved successfully.');
		    $this->mo_iwa_show_success_message();

		}

		else if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_register_customer" ) {	//register the admin to miniOrange

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Registration failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			//validation and sanitization
			$email = '';
			$phone = '';
			$password = '';
			$confirmPassword = '';
			$fname = '';
			$lname = '';
			$company = '';
			if( $this->mo_iwa_check_empty_or_null( $_POST['email'] ) || $this->mo_iwa_check_empty_or_null( $_POST['password'] ) || $this->mo_iwa_check_empty_or_null( $_POST['confirmPassword'] ) ) {
				update_option( 'mo_iwa_message', 'All the fields are required. Please enter valid entries.');
				$this->mo_iwa_show_error_message();
				return;
			} else if( strlen( $_POST['password'] ) < 6 || strlen( $_POST['confirmPassword'] ) < 6){
				update_option( 'mo_iwa_message', 'Choose a password with minimum length 6.');
				$this->mo_iwa_show_error_message();
				return;
			} else{
				$email = sanitize_email( $_POST['email'] );
				$phone = sanitize_text_field( $_POST['phone'] );
				$password = sanitize_text_field( $_POST['password'] );
				$confirmPassword = sanitize_text_field( $_POST['confirmPassword'] );
				$fname = sanitize_text_field($_POST['fname']);
				$lname = sanitize_text_field($_POST['lname']);
				$company = sanitize_text_field($_POST['company']);
			}

			update_option('mo_iwa_admin_email', $email);
			update_option('mo_iwa_admin_phone', $phone);
			update_option('mo_iwa_admin_fname', $fname);
			update_option('mo_iwa_admin_lname', $lname);
			update_option('mo_iwa_admin_company', $company);
			if( strcmp( $password, $confirmPassword) == 0 ) {
				update_option( 'mo_iwa_admin_password', $password );
				$email = get_option('mo_iwa_admin_email');
				$customer = new CustomerIWA();
				$content = json_decode($customer->check_customer(), true);
				if( strcasecmp( $content['status'], 'CUSTOMER_NOT_FOUND') == 0 ){
					$content = json_decode($customer->send_otp_token($email, ''), true);
					if(strcasecmp($content['status'], 'SUCCESS') == 0) {
						update_option( 'mo_iwa_message', ' A one time passcode is sent to ' . get_option('mo_iwa_admin_email') . '. Please enter the otp here to verify your email.');
						update_option('mo_iwa_transactionId',$content['txId']);
						update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_SUCCESS_EMAIL');
						$this->mo_iwa_show_success_message();
					}else{
						update_option('mo_iwa_message','There was an error in sending email. Please verify your email and try again.');
						update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_FAILURE_EMAIL');
						$this->mo_iwa_show_error_message();
					}
				}else{
					$this->get_current_customer();
				}

			} else {
				update_option( 'mo_iwa_message', 'Passwords do not match.');
				delete_option('mo_iwa_verify_customer');
				$this->mo_iwa_show_error_message();
			}

		}
		if(isset($_POST['option']) and $_POST['option'] == "mo_iwa_validate_otp"){

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Validate OTP failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			//validation and sanitization
			$otp_token = '';
			if( $this->mo_iwa_check_empty_or_null( $_POST['otp_token'] ) ) {
				update_option( 'mo_iwa_message', 'Please enter a value in otp field.');
				//update_option('mo_saml_registration_status','MO_OTP_VALIDATION_FAILURE');
				$this->mo_iwa_show_error_message();
				return;
			} else{
				$otp_token = sanitize_text_field( $_POST['otp_token'] );
			}

			$customer = new CustomerIWA();
			$content = json_decode($customer->validate_otp_token(get_option('mo_iwa_transactionId'), $otp_token ),true);
			if(strcasecmp($content['status'], 'SUCCESS') == 0) {

					$this->create_customer();
			}else{
				update_option( 'mo_iwa_message','Invalid one time passcode. Please enter a valid otp.');
				//update_option('mo_saml_registration_status','MO_OTP_VALIDATION_FAILURE');
				$this->mo_iwa_show_error_message();
			}
		}
		if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_verify_customer" ) {	//register the admin to miniOrange

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Login failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			//validation and sanitization
			$email = '';
			$password = '';
			if( $this->mo_iwa_check_empty_or_null( $_POST['email'] ) || $this->mo_iwa_check_empty_or_null( $_POST['password'] ) ) {
				update_option( 'mo_iwa_message', 'All the fields are required. Please enter valid entries.');
				$this->mo_iwa_show_error_message();
				return;
			} else{
				$email = sanitize_email( $_POST['email'] );
				$password = sanitize_text_field( $_POST['password'] );
			}

			update_option( 'mo_iwa_admin_email', $email );
			update_option( 'mo_iwa_admin_password', $password );
			$customer = new CustomerIWA();
			$content = $customer->get_customer_key();
			$customerKey = json_decode( $content, true );
			if( json_last_error() == JSON_ERROR_NONE ) {
				update_option( 'mo_iwa_admin_customer_key', $customerKey['id'] );
				update_option( 'mo_iwa_admin_api_key', $customerKey['apiKey'] );
				update_option( 'mo_iwa_customer_token', $customerKey['token'] );
				update_option( 'mo_iwa_admin_phone', $customerKey['phone'] );
				$certificate = get_option('mo_iwa_x509_certificate');
				update_option('mo_iwa_admin_password', '');
				update_option( 'mo_iwal_message', 'Customer retrieved successfully');
				update_option('mo_iwa_registration_status' , 'Existing User');
				delete_option('mo_iwa_verify_customer');
				$this->mo_iwa_show_success_message();
			} else {
				update_option( 'mo_iwa_message', 'Invalid username or password. Please try again.');
				$this->mo_iwa_show_error_message();
			}
			update_option('mo_iwa_admin_password', '');
		}else if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_contact_us_query_option" ) {

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Query submit failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			// Contact Us query
			$email = $_POST['mo_iwa_contact_us_email'];
			$phone = $_POST['mo_iwa_contact_us_phone'];
			$query = $_POST['mo_iwa_contact_us_query'];
			$customer = new CustomerIWA();
			if ( $this->mo_iwa_check_empty_or_null( $email ) || $this->mo_iwa_check_empty_or_null( $query ) ) {
				update_option('mo_iwa_message', 'Please fill up Email and Query fields to submit your query.');
				$this->mo_iwa_show_error_message();
			} else {
				$submited = $customer->submit_contact_us( $email, $phone, $query );
				if ( $submited == false ) {
					update_option('mo_iwa_message', 'Your query could not be submitted. Please try again.');
					$this->mo_iwa_show_error_message();
				} else {
					update_option('mo_iwa_message', 'Thanks for getting in touch! We shall get back to you shortly.');
					$this->mo_iwa_show_success_message();
				}
			}
		}
		else if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_resend_otp_email" ) {

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Resend OTP failed.');
				$this->mo_iwa_show_error_message();
				return;
			}
			$email = get_option ( 'mo_iwa_admin_email' );
		    $customer = new CustomerIWA();
			$content = json_decode($customer->send_otp_token($email, ''), true);
			if(strcasecmp($content['status'], 'SUCCESS') == 0) {
					update_option( 'mo_iwa_message', ' A one time passcode is sent to ' . get_option('mo_iwa_admin_email') . ' again. Please check if you got the otp and enter it here.');
					update_option('mo_iwa_transactionId',$content['txId']);
					update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_SUCCESS_EMAIL');
					$this->mo_iwa_show_success_message();
			}else{
					update_option('mo_iwa_message','There was an error in sending email. Please click on Resend OTP to try again.');
					update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_FAILURE_EMAIL');
					$this->mo_iwa_show_error_message();
			}
		} else if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_resend_otp_phone" ) {

			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Resend OTP failed.');
				$this->mo_iwa_show_error_message();
				return;
			}
			$phone = get_option('mo_iwa_admin_phone');
		    $customer = new CustomerIWA();
			$content = json_decode($customer->send_otp_token('', $phone, FALSE, TRUE), true);
			if(strcasecmp($content['status'], 'SUCCESS') == 0) {
					update_option( 'mo_iwa_message', ' A one time passcode is sent to ' . $phone . ' again. Please check if you got the otp and enter it here.');
					update_option('mo_iwa_transactionId',$content['txId']);
					update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_SUCCESS_PHONE');
					$this->mo_iwa_show_success_message();
			}else{
					update_option('mo_iwa_message','There was an error in sending email. Please click on Resend OTP to try again.');
					update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_FAILURE_PHONE');
					$this->mo_iwa_show_error_message();
			}
		}
		else if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_go_back" ){
				update_option('mo_iwa_registration_status','');
				update_option('mo_iwa_verify_customer', '');
				delete_option('mo_iwa_new_registration');
				delete_option('mo_iwa_admin_email');
				delete_option('mo_iwa_admin_phone');
		} else if( isset( $_POST['option'] ) and $_POST['option'] == "mo_iwa_register_with_phone_option" ) {
			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Resend OTP failed.');
				$this->mo_iwa_show_error_message();
				return;
			}
			$phone = sanitize_text_field($_POST['phone']);
			$phone = str_replace(' ', '', $phone);
			$phone = str_replace('-', '', $phone);
			update_option('mo_iwa_admin_phone', $phone);
			$customer = new CustomerIWA();
			$content = json_decode($customer->send_otp_token('', $phone, FALSE, TRUE), true);
			if(strcasecmp($content['status'], 'SUCCESS') == 0) {
				update_option( 'mo_iwa_message', ' A one time passcode is sent to ' . $phone . '. Please enter the otp here to verify your email.');
				update_option('mo_iwa_transactionId',$content['txId']);
				update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_SUCCESS_PHONE');
				$this->mo_iwa_show_success_message();
			}else{
				update_option('mo_iwa_message','There was an error in sending SMS. Please click on Resend OTP to try again.');
				update_option('mo_iwa_registration_status','MO_OTP_DELIVERED_FAILURE_PHONE');
				$this->mo_iwa_show_error_message();
			}
		}
		else if( isset( $_POST['option']) and $_POST['option'] == "mo_iwa_force_authentication_option") {
			if(mo_iwa_is_sp_configured()) {
				if(array_key_exists('mo_iwa_force_authentication', $_POST)) {
					$enable_redirect = $_POST['mo_iwa_force_authentication'];
				} else {
					$enable_redirect = 'false';
				}
				if($enable_redirect == 'true') {
					update_option('mo_iwa_force_authentication', 'true');
				} else {
					update_option('mo_iwa_force_authentication', '');
				}
				update_option( 'mo_iwa_message', 'Sign in options updated.');
				$this->mo_iwa_show_success_message();
			} else {
				update_option( 'mo_iwa_message', 'Please complete <a href="' . add_query_arg( array('tab' => 'save'), $_SERVER['REQUEST_URI'] ) . '" />Service Provider</a> configuration first.');
				$this->mo_iwa_show_error_message();
			}
		} else if( isset( $_POST['option']) and $_POST['option'] == "mo_iwa_enable_login_redirect_option") {
			if(mo_iwa_is_sp_configured()) {
				if(array_key_exists('mo_iwa_enable_login_redirect', $_POST)) {
					$enable_redirect = $_POST['mo_iwa_enable_login_redirect'];
				} else {
					$enable_redirect = 'false';
				}
				if($enable_redirect == 'true') {
					update_option('mo_iwa_enable_login_redirect', 'true');
				} else {
					update_option('mo_iwa_enable_login_redirect', '');
					update_option('mo_iwa_allow_wp_signin', '');
				}
				update_option( 'mo_iwa_message', 'Sign in options updated.');
				$this->mo_iwa_show_success_message();
			} else {
				update_option( 'mo_iwa_message', 'Please complete <a href="' . add_query_arg( array('tab' => 'save'), $_SERVER['REQUEST_URI'] ) . '" />Service Provider</a> configuration first.');
				$this->mo_iwa_show_error_message();
			}
		} else if(isset($_POST['option']) && $_POST['option'] == 'mo_iwa_forgot_password_form_option'){
			if(!mo_iwa_is_curl_installed()) {
				update_option( 'mo_iwa_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Resend OTP failed.');
				$this->mo_iwa_show_error_message();
				return;
			}

			$email = get_option('mo_iwa_admin_email');

			$customer = new CustomerIWA();
			$content = json_decode($customer->mo_iwa_forgot_password($email),true);
			if(strcasecmp($content['status'], 'SUCCESS') == 0){
				update_option( 'mo_iwa_message','Your password has been reset successfully. Please enter the new password sent to ' . $email . '.');
				$this->mo_iwa_show_success_message();
			}else{
				update_option( 'mo_iwa_message','An error occured while processing your request. Please Try again.');
				$this->mo_iwa_show_error_message();
			}
		}

		/**
		 * Added for feedback mechanisms
		 */
		if ( isset( $_POST['option'] ) and $_POST['option'] == 'mo_skip_feedback' ) {

			deactivate_plugins( __FILE__ );
			update_option( 'mo_iwa_message', 'Plugin deactivated successfully' );
			$this->mo_iwa_show_success_message();

		}
		if ( isset( $_POST['mo_feedback'] ) and $_POST['mo_feedback'] == 'mo_feedback' ) {
			$user = wp_get_current_user();

			$message = 'Plugin Deactivated:';

			$deactivate_reason         = array_key_exists( 'deactivate_reason_radio', $_POST ) ? $_POST['deactivate_reason_radio'] : false;
			$deactivate_reason_message = array_key_exists( 'query_feedback', $_POST ) ? $_POST['query_feedback'] : false;

			if ( $deactivate_reason ) {

				$message .= $deactivate_reason;
				if ( isset( $deactivate_reason_message ) ) {
					$message .= ':' . $deactivate_reason_message;
				}
				$email = get_option( "saml_am_email" );
				if ( $email == '' ) {
					$email = $user->user_email;
				}
				$phone = get_option( 'mo_saml_admin_phone' );

				//only reason

				$feedback_reasons = new CustomerIWA();

				$submited = json_decode( $feedback_reasons->send_email_alert( $email, $phone, $message ), true );

				if ( json_last_error() == JSON_ERROR_NONE ) {
					if ( is_array( $submited ) && array_key_exists( 'status', $submited ) && $submited['status'] == 'ERROR' ) {
						update_option( 'mo_iwa_message', $submited['message'] );
						$this->mo_iwa_show_error_message();

					}
					else {
						if ( $submited == false ) {

							update_option( 'mo_iwa_message', 'Error while submitting the query.' );
							$this->mo_iwa_show_error_message();
						}
					}
				}

				deactivate_plugins( __FILE__ );
				update_option( 'mo_iwa_message', 'Thank you for the feedback.' );
				$this->mo_iwa_show_success_message();



			} else {
				update_option( 'mo_iwa_message', 'Please Select one of the reasons ,if your reason is not mentioned please select Other Reasons' );
				$this->mo_iwa_show_error_message();
			}

		}

	}

	function create_customer(){
		$customer = new CustomerIWA();
		$customerKey = json_decode( $customer->create_customer(), true );
		if( strcasecmp( $customerKey['status'], 'CUSTOMER_USERNAME_ALREADY_EXISTS') == 0 ) {
					$this->get_current_customer();
		} else if( strcasecmp( $customerKey['status'], 'SUCCESS' ) == 0 ) {
			update_option( 'mo_iwa_admin_customer_key', $customerKey['id'] );
			update_option( 'mo_iwa_admin_api_key', $customerKey['apiKey'] );
			update_option( 'mo_iwa_customer_token', $customerKey['token'] );
			update_option('mo_iwa_admin_password', '');
			update_option( 'mo_iwa_message', 'Thank you for registering with miniorange.');
			update_option('mo_iwa_registration_status','');
			delete_option('mo_iwa_verify_customer');
			delete_option('mo_iwa_new_registration');
			$this->mo_iwa_show_success_message();
			wp_redirect(admin_url().'admin.php?page=mo_iwa_settings&tab=licensing');
		}
		update_option('mo_iwa_admin_password', '');
	}

	function get_current_customer(){
		$customer = new CustomerIWA();
		$content = $customer->get_customer_key();
		$customerKey = json_decode( $content, true );
		if( json_last_error() == JSON_ERROR_NONE ) {
			update_option( 'mo_iwa_admin_customer_key', $customerKey['id'] );
			update_option( 'mo_iwa_admin_api_key', $customerKey['apiKey'] );
			update_option( 'mo_iwa_customer_token', $customerKey['token'] );
			update_option('mo_iwa_admin_password', '' );
			$certificate = get_option('mo_iwa_x509_certificate');
			update_option( 'mo_iwa_message', 'Your account has been retrieved successfully.' );
			delete_option('mo_iwa_verify_customer');
			delete_option('mo_iwa_new_registration');
			$this->mo_iwa_show_success_message();
			wp_redirect(admin_url().'admin.php?page=mo_iwa_settings&tab=licensing');
		} else {
			update_option( 'mo_iwa_message', 'You already have an account with miniOrange. Please enter a valid password.');
			update_option('mo_iwa_verify_customer', 'true');
			delete_option('mo_iwa_new_registration');
			$this->mo_iwa_show_error_message();
		}
	}

	public function mo_iwa_check_empty_or_null( $value ) {
		if( ! isset( $value ) || empty( $value ) ) {
			return true;
		}
		return false;
	}

	function miniorange_iwa_menu() {
		//Add miniOrange Windows Authentication SSO
		$page = add_menu_page( 'Windows Authentication Settings ' . __( 'Configure SAML Identity Provider for SSO', 'mo_iwa_settings' ), 'miniOrange Windows SSO', 'administrator', 'mo_iwa_settings', array( $this, 'mo_iwa_login_widget_saml_options' ), plugin_dir_url(__FILE__) . 'images/miniorange.png' );
	}


	function mo_iwa_redirect_for_authentication( $relay_state ) {
		$mo_redirect_url = get_option('mo_iwa_host_name') . "/moas/rest/saml/request?id=" . get_option('mo_iwa_admin_customer_key') . "&returnurl=" . urlencode( site_url() . "/?option=readiwalogin&redirect_to=" . urlencode ($relay_state) );
		header('Location: ' . $mo_redirect_url);
		exit();
	}

	function mo_iwa_authenticate() {
		$redirect_to = '';
		if( get_option('mo_iwa_enable_login_redirect') == 'true' ) {
			if( isset($_GET['loggedout']) && $_GET['loggedout'] == 'true' ) {
				header('Location: ' . site_url());
				exit();
			} elseif ( get_option('mo_iwa_allow_wp_signin') == 'true' ) {
				if( ( isset($_GET['saml_sso']) && $_GET['saml_sso'] == 'false' ) || ( isset($_POST['saml_sso']) && $_POST['saml_sso'] == 'false' ) ) {
					return;
				} elseif ( isset( $_REQUEST['redirect_to']) ) {
					$redirect_to = $_REQUEST['redirect_to'];
					if( strpos( $redirect_to, 'wp-admin') !== false && strpos( $redirect_to, 'saml_sso=false') !== false) {
						return;
					}
				}
			}
			if ( isset( $_REQUEST['redirect_to']) ) {
				$redirect_to = $_REQUEST['redirect_to'];
			}
			$this->mo_iwa_redirect_for_authentication( $redirect_to );
		}
	}

	function mo_get_iwa_shortcode(){
		if(!is_user_logged_in()){
			$html = 'SP is not configured.';
		}
		else
			$html = 'Hello, '.wp_get_current_user()->display_name.' | <a href='.wp_logout_url(site_url()).'>Logout</a>';
		return $html;
	}
}
new iwa_mo_login;