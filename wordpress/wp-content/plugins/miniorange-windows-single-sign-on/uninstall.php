<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

if (! is_multisite ()) {
	// delete all stored key-value pairs
	delete_option ( 'mo_iwa_host_name' );
	delete_option ( 'mo_iwa_enable_cloud_broker' );
	delete_option ( 'mo_iwa_new_registration' );
	delete_option ( 'mo_iwa_admin_phone' );
	delete_option ( 'mo_iwa_admin_email' );
	delete_option ( 'mo_iwa_admin_password' );
	delete_option ( 'mo_iwa_verify_customer' );
	delete_option ( 'mo_iwa_admin_customer_key' );
	delete_option ( 'mo_iwa_admin_api_key' );
	delete_option ( 'mo_iwa_customer_token' );
	delete_option ( 'mo_iwa_message' );
	delete_option ( 'mo_iwa_registration_status' );
	delete_option ( 'mo_iwa_idp_config_id' );
	delete_option ( 'mo_iwa_identity_name' );
	delete_option ( 'mo_iwa_login_url' );
	delete_option ( 'mo_iwa_logout_url' );
	delete_option ( 'mo_iwa_issuer' );
	delete_option ( 'mo_iwa_x509_certificate' );
	delete_option ( 'mo_iwa_response_signed' );
	delete_option ( 'mo_iwa_assertion_signed' );
	delete_option ( 'mo_iwa_am_first_name' );
	delete_option ( 'mo_iwa_am_username' );
	delete_option ( 'mo_iwa_am_email' );
	delete_option ( 'mo_iwa_am_last_name' );
	delete_option ( 'mo_iwa_am_default_user_role' );
	delete_option ( 'mo_iwa_am_role_mapping' );
	delete_option ( 'mo_iwa_am_group_name' );
	delete_option ( 'mo_iwa_idp_config_complete' );
	delete_option ( 'mo_iwa_enable_login_redirect' );
	delete_option ( 'mo_iwa_allow_wp_signin' );
	delete_option ( 'mo_iwa_am_account_matcher' );
	delete_option ( 'mo_iwa_transactionId' );
	delete_option ( 'mo_iwa_force_authentication' );
	delete_option ( 'mo_iwa_am_dont_allow_unlisted_user_role' );
	
	$users = get_users( array() );
	foreach ( $users as $user ) {
		delete_user_meta($user->ID, 'mo_iwa_session_index');
		delete_user_meta($user->ID, 'mo_iwa_name_id');
	}
} else {
	global $wpdb;
	$blog_ids = $wpdb->get_col ( "SELECT blog_id FROM $wpdb->blogs" );
	$original_blog_id = get_current_blog_id ();
	
	foreach ( $blog_ids as $blog_id ) {
		switch_to_blog ( $blog_id );
		// delete all your options
		// E.g: delete_option( {option name} );
		delete_option ( 'mo_iwa_host_name' );
		delete_option ( 'mo_iwa_new_registration' );
		delete_option ( 'mo_iwa_admin_phone' );
		delete_option ( 'mo_iwa_admin_email' );
		delete_option ( 'mo_iwa_admin_password' );
		delete_option ( 'mo_iwa_verify_customer' );
		delete_option ( 'mo_iwa_admin_customer_key' );
		delete_option ( 'mo_iwa_admin_api_key' );
		delete_option ( 'mo_iwa_customer_token' );
		delete_option ( 'mo_iwa_message' );
		delete_option ( 'mo_iwa_registration_status' );
		delete_option ( 'mo_iwa_idp_config_id' );
		delete_option ( 'mo_iwa_identity_name' );
		delete_option ( 'mo_iwa_login_url' );
		delete_option ( 'mo_iwa_logout_url' );
		delete_option ( 'mo_iwa_issuer' );
		delete_option ( 'mo_iwa_x509_certificate' );
		delete_option ( 'mo_iwa_response_signed' );
		delete_option ( 'mo_iwa_assertion_signed' );
		delete_option ( 'mo_iwa_am_first_name' );
		delete_option ( 'mo_iwa_am_username' );
		delete_option ( 'mo_iwa_am_email' );
		delete_option ( 'mo_iwa_am_last_name' );
		delete_option ( 'mo_iwa_am_default_user_role' );
		delete_option ( 'mo_iwa_am_role_mapping' );
		delete_option ( 'mo_iwa_am_group_name' );
		delete_option ( 'mo_iwa_idp_config_complete' );
		delete_option ( 'mo_iwa_enable_login_redirect' );
		delete_option ( 'mo_iwa_allow_wp_signin' );
		delete_option ( 'mo_iwa_am_account_matcher' );
		delete_option ( 'mo_iwa_transactionId' );
		delete_option ( 'mo_iwa_force_authentication' );
		delete_option ( 'mo_iwa_am_dont_allow_unlisted_user_role' );
		$users = get_users( array() );
		foreach ( $users as $user ) {
			delete_user_meta($user->ID, 'mo_iwa_session_index');
			delete_user_meta($user->ID, 'mo_iwa_name_id');
		}
	}
	switch_to_blog ( $original_blog_id );
}
?>