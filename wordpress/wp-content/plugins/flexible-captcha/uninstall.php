<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit();
}

if (is_multisite()) {
	$networkSites = get_sites();
	if (sizeof($networkSites) > 0) {
		$originalBlogID = get_current_blog_id();
		foreach($networkSites as $site) {
			switch_to_blog($site->blog_id);
			FC_delete_site_data();
		}
		switch_to_blog($originalBlogID);
	}
} else {
	FC_delete_site_data();
}

function FC_delete_site_data() {
	global $wpdb;
	//Delete database tables and options if the option to preserve is set to 0.
	$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."FC_captcha_store");
		
	delete_option('FC_request_key');
	delete_option('FC_default_width');
	delete_option('FC_default_height');
	delete_option('FC_random_font_count');
	delete_option('FC_font_colors');
	delete_option('FC_bg_colors');
	delete_option('FC_gradient_transitions');
	delete_option('FC_background_type');
	delete_option('FC_shape_count');
	delete_option('FC_section_count');
	delete_option('FC_case_sensitive');
	delete_option('FC_add_to_registration');
	delete_option('FC_add_to_comments');
	delete_option('FC_add_to_login');
	delete_option('FC_add_jquery_to_header');
	delete_option('FC_last_captcha_purge');
	delete_option('FC_preserve_settings');

	if (is_array(get_option('FC_uploaded_fonts'))) {
		foreach(get_option('FC_uploaded_fonts') as $fontFile) {
			if (file_exists($this->fontDirectory . $fontFile)) {
				@unlink($this->fontDirectory . $fontFile);
			}
		}
		delete_option('FC_uploaded_fonts');
	}
	
	if (file_exists($this->fontDirectory)) {
		@unlink($this->fontDirectory);
	}
}
?>