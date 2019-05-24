<?php
/** miniOrange SAML 2.0 SSO enables user to perform Single Sign On with any SAML 2.0 enabled Identity Provider.
 Copyright (C) 2015  miniOrange
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>
 * @package 		miniOrange SAML 2.0 SSO
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */
/**
 * This library is miniOrange Authentication Service.
 *
 * Contains Request Calls to Customer service.
 */
class CustomerIWA {
	public $email;
	public $phone;
	
	/*
	 * * Initial values are hardcoded to support the miniOrange framework to generate OTP for email.
	 * * We need the default value for creating the first time,
	 * * As we don't have the Default keys available before registering the user to our server.
	 * * This default values are only required for sending an One Time Passcode at the user provided email address.
	 */
	private $defaultCustomerKey = "16555";
	private $defaultApiKey = "fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq";
	
	function create_customer() {
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/rest/customer/add';
		
		$ch = curl_init ( $url );
		
		$this->email = get_option ( 'mo_iwa_admin_email' );
		$this->phone = get_option ( 'mo_iwa_admin_phone' );
		$password = get_option ( 'mo_iwa_admin_password' );
		$fname = get_option('mo_iwa_admin_fname');
		$lname = get_option('mo_iwa_admin_lname');
		$company = get_option('mo_iwa_admin_company');
		
		$fields = array (
				'companyName' => $company,
				'areaOfInterest' => 'WP miniOrange Windows Single Sign On Plugin',
				'firstname' => $fname,
				'lastname' => $lname,
				'email' => $this->email,
				'phone' => $this->phone,
				'password' => $password 
		);
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'charset: UTF - 8',
				'Authorization: Basic' 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		
		curl_close ( $ch );
		return $content;
	}
	function get_customer_key() {
		$url = get_option ( 'mo_iwa_host_name' ) . "/moas/rest/customer/key";
		$ch = curl_init ( $url );
		$email = get_option ( "mo_iwa_admin_email" );
		
		$password = get_option ( "mo_iwa_admin_password" );
		
		$fields = array (
				'email' => $email,
				'password' => $password 
		);
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'charset: UTF - 8',
				'Authorization: Basic' 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		curl_close ( $ch );
		
		return $content;
	}
	function check_customer() {
		$url = get_option ( 'mo_iwa_host_name' ) . "/moas/rest/customer/check-if-exists";
		$ch = curl_init ( $url );
		$email = get_option ( "mo_iwa_admin_email" );
		
		$fields = array (
				'email' => $email 
		);
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'charset: UTF - 8',
				'Authorization: Basic' 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		curl_close ( $ch );
		
		return $content;
	}
	function send_otp_token($email, $phone, $sendToEmail = TRUE, $sendToPhone = FALSE) {
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/api/auth/challenge';
		$ch = curl_init ( $url );
		$customerKey = $this->defaultCustomerKey;
		$apiKey = $this->defaultApiKey;
		
		//$username = get_option ( 'mo_saml_admin_email' );
		
		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		$currentTimeInMillis = round ( microtime ( true ) * 1000 );
		
		/* Creating the Hash using SHA-512 algorithm */
		$stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) . $apiKey;
		$hashValue = hash ( "sha512", $stringToHash );
		
		$customerKeyHeader = "Customer-Key: " . $customerKey;
		$timestampHeader = "Timestamp: " . number_format ( $currentTimeInMillis, 0, '', '' );
		$authorizationHeader = "Authorization: " . $hashValue;
		
		if ($sendToEmail) {
			$fields = array (
					'customerKey' => $customerKey,
					'email' => $email,
					'authType' => 'EMAIL',
					'transactionName' => 'WP miniOrange Windows Single Sign On Plugin' 
			);
		} else {
			$fields = array (
					'customerKey' => $customerKey,
					'phone' => $phone,
					'authType' => 'SMS',
					'transactionName' => 'WP miniOrange Windows Single Sign On Plugin'
			);
		}
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				"Content-Type: application/json",
				$customerKeyHeader,
				$timestampHeader,
				$authorizationHeader 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		curl_close ( $ch );
		return $content;
	}
	function validate_otp_token($transactionId, $otpToken) {
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/api/auth/validate';
		$ch = curl_init ( $url );
		
		$customerKey = $this->defaultCustomerKey;
		$apiKey = $this->defaultApiKey;
		
		$username = get_option ( 'mo_iwa_admin_email' );
		
		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		$currentTimeInMillis = round ( microtime ( true ) * 1000 );
		
		/* Creating the Hash using SHA-512 algorithm */
		$stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) . $apiKey;
		$hashValue = hash ( "sha512", $stringToHash );
		
		$customerKeyHeader = "Customer-Key: " . $customerKey;
		$timestampHeader = "Timestamp: " . number_format ( $currentTimeInMillis, 0, '', '' );
		$authorizationHeader = "Authorization: " . $hashValue;
		
		$fields = '';
		
		// *check for otp over sms/email
		$fields = array (
				'txId' => $transactionId,
				'token' => $otpToken 
		);
		
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				"Content-Type: application/json",
				$customerKeyHeader,
				$timestampHeader,
				$authorizationHeader 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		curl_close ( $ch );
		return $content;
	}
	function submit_contact_us($email, $phone, $query) {
		
		$fname = get_option('mo_iwa_admin_fname');
		$lname = get_option('mo_iwa_admin_lname');
		$company = get_option('mo_iwa_admin_company');
		
		$query = '[WP miniOrange Windows Single Sign On Plugin] ' . $query;
		$fields = array (
				'firstName' => $fname,
				'lastName' => $lname,
				'company' => $company,
				'email' => $email,
				'phone' => $phone,
				'query' => $query 
		);
		$field_string = json_encode ( $fields );
		
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/rest/customer/contact-us';
		
		$ch = curl_init ( $url );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'charset: UTF-8',
				'Authorization: Basic' 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			return false;
		}
		// echo " Content: " . $content;
		
		curl_close ( $ch );
		
		return true;
	}
	function save_external_idp_config() {
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/rest/saml/save-configuration';
		
		$ch = curl_init ( $url );
		
		$this->email = get_option ( 'mo_iwa_admin_email' );
		$this->phone = get_option ( 'mo_iwa_admin_phone' );
		
		$idpType = 'saml';
		$identifier = get_option ( 'mo_iwa_identity_name' );
		$acsUrl = $url;
		
		$password = get_option ( 'mo_iwa_admin_password' );
		$custId = get_option ( 'mo_iwa_admin_customer_key' );
		$samlLoginUrl = get_option ( 'mo_iwa_login_url' );
		$samlIssuer = get_option ( 'mo_iwa_issuer' );
		$samlX509Certificate = get_option ( 'mo_iwa_x509_certificate' );
		$Id = get_option ( 'mo_iwa_idp_config_id' );
		$assertionSigned = get_option ( 'mo_iwa_assertion_signed' ) == 'checked' ? 'true' : 'false';
		$responseSigned = get_option ( 'mo_iwa_response_signed' ) == 'checked' ? 'true' : 'false';
		
		$fields = array (
				'customerId' => $custId,
				'idpType' => $idpType,
				'identifier' => $identifier,
				'samlLoginUrl' => $samlLoginUrl,
				'samlLogoutUrl' => $samlLoginUrl,
				'idpEntityId' => $samlIssuer,
				'samlX509Certificate' => $samlX509Certificate,
				'assertionSigned' => $assertionSigned,
				'responseSigned' => $responseSigned,
				'overrideReturnUrl' => 'true',
				'returnUrl' => site_url () . '/?option=readiwalogin' 
		);
		
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'charset: UTF - 8',
				'Authorization: Basic' 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		
		curl_close ( $ch );
		return $content;
	}
	function mo_iwa_forgot_password($email) {
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/rest/customer/password-reset';
		$ch = curl_init ( $url );
		
		/* The customer Key provided to you */
		$customerKey = get_option ( 'mo_iwa_admin_customer_key' );
		
		/* The customer API Key provided to you */
		$apiKey = get_option ( 'mo_iwa_admin_api_key' );
		
		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		$currentTimeInMillis = round ( microtime ( true ) * 1000 );
		
		/* Creating the Hash using SHA-512 algorithm */
		$stringToHash = $customerKey . number_format ( $currentTimeInMillis, 0, '', '' ) . $apiKey;
		$hashValue = hash ( "sha512", $stringToHash );
		
		$customerKeyHeader = "Customer-Key: " . $customerKey;
		$timestampHeader = "Timestamp: " . number_format ( $currentTimeInMillis, 0, '', '' );
		$authorizationHeader = "Authorization: " . $hashValue;
		
		$fields = '';
		
		// *check for otp over sms/email
		$fields = array (
				'email' => $email 
		);
		
		$field_string = json_encode ( $fields );
		
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		
		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				"Content-Type: application/json",
				$customerKeyHeader,
				$timestampHeader,
				$authorizationHeader 
		) );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $field_string );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
		
		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		
		$content = curl_exec ( $ch );
		
		if (curl_errno ( $ch )) {
			echo 'Request Error:' . curl_error ( $ch );
			exit ();
		}
		
		curl_close ( $ch );
		return $content;
	}

	function get_timestamp() {
		$url = get_option ( 'mo_iwa_host_name' ) . '/moas/rest/mobile/get-timestamp';
		$ch = curl_init ( $url );

		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_ENCODING, "" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); // required for https urls

		curl_setopt ( $ch, CURLOPT_MAXREDIRS, 10 );

		curl_setopt ( $ch, CURLOPT_POST, true );

		if(defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') && defined('WP_PROXY_USERNAME') && defined('WP_PROXY_PASSWORD')){
			curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST);
			curl_setopt($ch, CURLOPT_PROXYPORT, WP_PROXY_PORT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, WP_PROXY_USERNAME.':'.WP_PROXY_PASSWORD);
		}
		$content = curl_exec ( $ch );

		if (curl_errno ( $ch )) {
			echo 'Error in sending curl Request. Please check your connection.';
			exit ();
		}

		curl_close ( $ch );
		return $content;
	}
	function send_email_alert($email,$phone,$message){

		$url = get_option( 'mo_iwa_host_name' ) . '/moas/api/notify/send';
		$ch = curl_init($url);

		$customerKey = $this->defaultCustomerKey;
		$apiKey =  $this->defaultApiKey;

		$currentTimeInMillis = self::get_timestamp();
		$stringToHash 		= $customerKey .  $currentTimeInMillis . $apiKey;
		$hashValue 			= hash("sha512", $stringToHash);
		$customerKeyHeader 	= "Customer-Key: " . $customerKey;
		$timestampHeader 	= "Timestamp: " .  $currentTimeInMillis;
		$authorizationHeader= "Authorization: " . $hashValue;
		$fromEmail 			= $email;
		$subject            = "Feedback: WordPress Windows SSO Plugin";
		$site_url=site_url();

		global $user;
		$user         = wp_get_current_user();


		$query        = '[WordPress Windows SSO: ]: ' . $message;


		$content='<div >Hello, <br><br>First Name :'.$user->user_firstname.'<br><br>Last  Name :'.$user->user_lastname.'   <br><br>Company :<a href="'.$_SERVER['SERVER_NAME'].'" target="_blank" >'.$_SERVER['SERVER_NAME'].'</a><br><br>Phone Number :'.$phone.'<br><br>Email :<a href="mailto:'.$fromEmail.'" target="_blank">'.$fromEmail.'</a><br><br>Query :'.$query.'</div>';


		$fields = array(
			'customerKey'	=> $customerKey,
			'sendEmail' 	=> true,
			'email' 		=> array(
				'customerKey' 	=> $customerKey,
				'fromEmail' 	=> $fromEmail,
				'bccEmail' 		=> $fromEmail,
				'fromName' 		=> 'miniOrange',
				'toEmail' 		=> 'shubham.gupta@miniorange.com',
				'toName' 		=> 'shubham.gupta@miniorange.com',
				'subject' 		=> $subject,
				'content' 		=> $content
			),
		);
		$field_string = json_encode($fields);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls

		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customerKeyHeader,
			$timestampHeader, $authorizationHeader));
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $field_string);
		$content = curl_exec($ch);

		if(curl_errno($ch)){
			return json_encode(array("status"=>'ERROR','statusMessage'=>curl_error($ch)));
		}
		curl_close($ch);
		return ($content);

	}

}
?>