<?php
class FlexibleCaptcha {
	var $dimensions;
	var $image;
	var $fonts;
	var $string;
	var $fontDirectory;
	var $absPath;
	var $urlPath;
	var $nonce;
	var $captchaDisplayed=0;
	var $characterList = '';

	public function __construct($mainFile) {
		$this->absPath = WP_PLUGIN_DIR . "/" . plugin_basename(dirname($mainFile));
		$this->urlPath = plugins_url("", $mainFile);
		$this->fontDirectory = get_option('FC_stored_font_dir');
		if ($this->fontDirectory == '') {
			$uploadDir = wp_upload_dir();
			$this->fontDirectory = $uploadDir['basedir'] . "/fc-fonts/";
		}
		$this->add_hooks($mainFile);
		$this->characterList = get_option('FC_character_list');
	}
	
	function add_hooks($mainFile) {
		register_activation_hook($mainFile,array($this, 'activate'));

		add_action('init',  array($this, 'setup_nonce'));
		add_filter('init',  array($this, 'check_for_captcha_request'), 1, 1);

		add_action('admin_menu', array($this, 'admin_menu'));

		add_shortcode('FC_captcha_fields', array($this, 'display_captcha_shortcode'));

		add_action('wp_ajax_FC_delete_font_file',  array($this, 'delete_font_file'));
		add_action('wp_ajax_FC_submit_gen_settings',  array($this, 'submit_gen_settings'));
		add_action('wp_ajax_FC_submit_background_settings',  array($this, 'submit_background_settings'));
		add_action('wp_ajax_FC_submit_font_settings',  array($this, 'submit_font_settings'));

		##Comments form
		add_action('comment_form_after_fields', array($this, 'add_to_comment_form'));
		add_filter('wpmu_validate_user_signup', array($this, 'check_ms_registration_submit'));
		add_action('comment_form_logged_in_after', array($this, 'add_to_comment_form'));
		add_filter('preprocess_comment', array($this, 'check_comment_submit'));

		##Registration form
		add_action('signup_extra_fields',array($this, 'add_to_ms_registration_form'), 10, 1);
		add_action('register_form',array($this, 'add_to_registration_form'));
		add_action('register_post',array($this, 'check_registration_submit'),1,3);

		#Login Form
		add_action('login_form', array($this, 'add_to_login_form'));
		add_action('login_form_bottom', array($this, 'add_to_login_form_bottom'));
		add_filter('wp_authenticate_user', array($this, 'check_authentication'), 40, 1);

		add_action('wp_enqueue_scripts', array($this, 'add_jquery_to_header'));
		add_action('login_enqueue_scripts', array($this, 'add_jquery_to_header'));
		add_action('admin_init', array($this, 'register_admin_style'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_style'));
		add_action('admin_notices', array($this, 'add_ajax_notices'));
	}
	
	function activate() {
		global $wpdb;
		$sql = "CREATE TABLE ".$wpdb->prefix."FC_captcha_store (
			time datetime DEFAULT NULL,
			captcha varchar(255) default '',
			cookie_val varchar(255) default '',
			PRIMARY KEY FC_cookie_key (cookie_val)
			);";
	
		if($wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix."FC_captcha_store'") != $wpdb->prefix."FC_captcha_store") {
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}

		if (get_option('FC_default_width') == '') {
			update_option('FC_default_width', 150);
		}
		
		if (get_option('FC_default_height') == '') {
			update_option('FC_default_height', 30);
		}
		
		if (get_option('FC_random_font_count') == '') {
			update_option('FC_random_font_count', 2);
		}
		
		if (get_option('FC_font_colors') == '') {
			update_option('FC_font_colors', array(array(246, 247, 239)));
		}
		
		if (get_option('FC_bg_colors') == '') {
			update_option('FC_bg_colors', array(array(3, 19, 161), array(245, 12, 12)));
		}
		
		if (get_option('FC_gradient_transitions') == '') {
			update_option('FC_gradient_transitions', 5);
		}
		if (get_option('FC_background_type') == '') {
			update_option('FC_background_type', 'gradient');
		}
		if (get_option('FC_section_count') == '') {
			update_option('FC_section_count', 10);
		}
		if (get_option('FC_shape_count') == '') {
			update_option('FC_shape_count', 100);
		}
		if (get_option('FC_case_sensitive') == '') {
			update_option('FC_case_sensitive', 0);
		}
		if (get_option('FC_add_to_registration') == '') {
			update_option('FC_add_to_registration', 1);
		}
		if (get_option('FC_add_to_comments') == '') {
			update_option('FC_add_to_comments', 1);
		}
		if (get_option('FC_add_to_login') == '') {
			update_option('FC_add_to_login', 1);
		}
		if (get_option('FC_add_to_registration') == 1 || get_option('FC_add_to_comments') == 1) {
			update_option('FC_add_jquery_to_header', 1);
		} else {
			update_option('FC_add_jquery_to_header', 0);
		}

		if (!file_exists($this->fontDirectory)) {
			@mkdir($this->fontDirectory);
		}
		if (get_option('FC_uploaded_fonts') == '') {
			$this->setup_default_fonts();
		}
	}
	
	function setup_default_fonts() {
		$includedFonts = array('Sansation_Bold.ttf', 'Sansation_Bold_Italic.ttf', 'Sansation_Italic.ttf', 'Sansation_Light.ttf', 'Sansation_Light_Italic.ttf', 'Sansation_Regular.ttf');
		foreach($includedFonts as $fontFile) {
			if (!file_exists($this->fontDirectory . $fontFile)) {
				@copy($this->absPath . "/fonts/" . $fontFile, $this->fontDirectory . $fontFile);
			}
		}
		update_option('FC_uploaded_fonts', $includedFonts);
	}
	
	function setup_nonce() {
		$this->nonce = wp_create_nonce(plugin_basename(__FILE__));
	}
	
	function admin_menu() {
		global $wpdb;
		$plugin_page=add_submenu_page('options-general.php', 'Flexible Captcha Settings', 'Flexible Captcha', 'activate_plugins', 'Flexible_Captcha', array($this, 'settings_page'));
		add_action('admin_head-'.$plugin_page, array($this, 'common_js'));
		add_action('admin_head-'.$plugin_page, array($this, 'admin_styles'));
		add_action('admin_head-'.$plugin_page, array($this, 'settings_page_head'));
	}

	function admin_notices() {
		$errMsg = '';
		if (!extension_loaded('gd') || !function_exists('gd_info')) {
			$errMsg = "<p>IMPORTANT!! It looks like the GD library is not enabled.  You must enable the GD library and FreeType support for PHP or the images will not appear.</p>";
		}
		if ($errMsg != '') {
			?>
			<div class="updated" id="FC_admin_notices">
				<h2>Flexible Captcha is not set up correctly.</h2>
				<?php _e( $errMsg, 'flexible-captcha' ); ?>
			</div>
			<script type="text/javascript" language="javascript">
				jQuery('#FC_disable_admin_notices').click(function() {
					jQuery.post(encodeURI(ajaxurl + '?action=FC_disable_admin_notices'), {PO_nonce: '<?php print $this->nonce; ?>'}, function (result) {
						jQuery('#FC_admin_notices').remove();
					});
					return false;
				});
			</script>
			<?php
		}
	}
	
	function add_ajax_notices() {
		?>
		<div id="FC-ui-notices">
			<div id="FC-ui-notices-container">
			</div>
		</div>
		<?php
	}
	
	function common_js() {
		add_action('admin_notices', array($this, 'admin_notices'));
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('jquery-ui-tooltip');
		require_once($this->absPath . "/tpl/common_js.php");
	}
	
	function register_admin_style() {
		wp_register_style('font-awesome-4.7.0', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_register_style('FC-admin', $this->urlPath . '/css/admin.css');
	}

	function enqueue_admin_style() {
		wp_enqueue_style('font-awesome-4.7.0');
	}
	
	function settings_page() {
		if (array_key_exists('submit_font_file', $_POST)) {
			$this->handle_font_upload();
		}
		$fontFiles = get_option('FC_uploaded_fonts');
		
		require_once($this->absPath . "/tpl/settings.php");
	}

	function handle_font_upload() {
		if (wp_verify_nonce(sanitize_text_field($_POST['FC_nonce']), plugin_basename(__FILE__))) {
			$fontMime = array('application/x-font-ttf', 'application/vnd.ms-opentype');
			if (preg_match("/(.otf|.ttf)$/", $_FILES['FC_font_upload']['name']) && in_array(mime_content_type($_FILES['FC_font_upload']['tmp_name']), $fontMime) && !file_exists($this->fontDirectory . $_FILES['FC_font_upload']['name']) && move_uploaded_file( $_FILES['FC_font_upload']['tmp_name'], $this->fontDirectory . $_FILES['FC_font_upload']['name'] )) {
				$fontFiles = get_option('FC_uploaded_fonts');
				if (!is_array($fontFiles)) {
					$fontFiles = array();
				}
				$fontFiles[] = sanitize_text_field($_FILES['FC_font_upload']['name']);
				$fontFiles = array_values($fontFiles);
				update_option('FC_uploaded_fonts', $fontFiles);
			}
		}
	}

	function delete_font_file() {
		$jsonResponse = array('success'=>0, 'alerts'=>array());
		if (wp_verify_nonce(sanitize_text_field($_POST['FC_nonce']), plugin_basename(__FILE__))) {
			$fontFiles = get_option('FC_uploaded_fonts');
			foreach($fontFiles as $key=>$font) {
				if ($font == sanitize_text_field($_POST['FC_font_file'])) {
					unset($fontFiles[$key]);
					$fontFiles = array_values($fontFiles);
					unlink($this->fontDirectory . sanitize_text_field($_POST['FC_font_file']));
				}
			}
			update_option('FC_uploaded_fonts', $fontFiles);
			$jsonResponse['alerts'][] = "Font files were successfully removed.";
			$jsonResponse['success'] = 1;
		}
		print json_encode($jsonResponse);
		die();
	}
	
	function settings_page_head() {
		?>
		<link type="text/css" rel="stylesheet" href="<?php print $this->urlPath; ?>/css/colorpicker.css" />
		<?php
		require_once($this->absPath . "/tpl/settings_page_js.php");
	}

	function admin_styles() {
		wp_enqueue_style('FC-admin');
	}
	
	function get_request_key() {
		$requestKey = get_option('FC_request_key');
		if ($requestKey == "") {
			$requestKey = md5('supersecretrequestkey');
			update_option('FC_request_key', $requestKey);
		}
		return $requestKey;
	}
	
	function display_captcha_shortcode($atts, $content=null) {
		extract( shortcode_atts( array('width' => get_option('FC_default_width'), 'height' => get_option('FC_default_height')), $atts ) );
		return $this->get_captcha_fields_display($width, $height);
	}
	
	function get_captcha_fields_display($width, $height) {
		$requestKey = $this->get_request_key();
		$uniqueFieldID = md5(mt_rand(9999, 9999999999) * mt_rand(9999, 9999999999));
		ob_start();
		require($this->absPath . "/tpl/captcha_fields.php");
		return ob_get_clean();
	}
	
	function check_for_captcha_request($wp_query) {
		$requestKey = $this->get_request_key();
		if (isset($_GET['FC_captcha_request']) && $_GET['FC_captcha_request'] == $requestKey) {
			##Set width
			if (is_numeric($_GET['cwidth']) && $_GET['cwidth'] <= 1000 && $_GET['cwidth'] >= 100) {
				$width = sanitize_text_field($_GET['cwidth']);
			} else {
				$width = get_option('FC_default_width');
			}

			##Set height
			if (is_numeric($_GET['cheight']) && $_GET['cheight'] <= 1000 && $_GET['cheight'] >= 16) {
				$height = sanitize_text_field($_GET['cheight']);
			} else {
				$height = get_option('FC_default_height');
			}

			$this->gen_image($width, $height);
		}
	}
	
	public function set_fonts($fontCount) {
		$fontFiles = get_option('FC_uploaded_fonts');
		if (is_array($fontFiles)) {
			for($i=0; $i<$fontCount; $i++) {
				$randomFontIndex = mt_rand()&(sizeof($fontFiles)-1);
				$tmpName = $this->fontDirectory . $fontFiles[$randomFontIndex];
				if (file_exists($tmpName)) {
					$this->fonts[]=$tmpName;
				} else {
					while(!file_exists($tmpName) && sizeof($fontFiles) > 0) {
						unset($fontFiles[$randomFontIndex]);
						$fontFiles = array_values($fontFiles);
						$randomFontIndex = mt_rand()&(sizeof($fontFiles)-1);
						$tmpName = $this->fontDirectory . $fontFiles[$randomFontIndex];
					}
					if (sizeof($fontFiles) == 0) {
						$this->setup_default_fonts();
						$fontFiles = get_option('FC_uploaded_fonts');
						$randomFontIndex = mt_rand()&(sizeof($fontFiles)-1);
						$tmpName = $this->fontDirectory . $fontFiles[$randomFontIndex];
					} else {
						update_option('FC_uploaded_fonts', $fontFiles);
					}
					
					$this->fonts[]=$tmpName;
				}
			}
		} else {
			$this->setup_default_fonts();
		}
	}
	
	public function gen_image($width=0, $height=0) {
		$this->dimensions['width']=$width;
		$this->dimensions['height']=$height;
		$randomFonts = (is_numeric(get_option('FC_random_font_count')))? get_option('FC_random_font_count') : 2;
		$this->set_fonts($randomFonts);
		
		$this->image = @imagecreatetruecolor($this->dimensions['width'], $this->dimensions['height']);
		$this->gen_bg(0, 0);
		#$backgroundColor = @imagecolorallocate($this->image, 0, 0, 0);
		#imageloadfont();
		if ($this->gen_string()) {
			header("Pragma: no-cache");
			header("cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Content-type: image/png");
			@imagepng($this->image);
			@imagedestroy($this->image);
			$this->purge_captcha();
		}
		exit;
	}

	function gen_random_char() {
		$char = '';
		if ($this->characterList != '') {
			$char = substr($this->characterList, mt_rand(0, strlen($this->characterList)-1), 1);
		} else {
			switch(mt_rand()&5) {
				case 0:
					$char = chr(mt_rand(65,79));
					break;
				case 4:
					$char = chr(mt_rand(80,90));
					break;
				case 1:
					$char = chr(mt_rand(109,122));
					break;
				case 3:
					$char = chr(mt_rand(97,108));
					break;
				case 2:
				case 5:
					$char = mt_rand(2,9);
					break;
			}
		}
		return $char;
	}
	
	public function gen_string() {
		global $wpdb;
		if (!isset($_GET['uniqueID']) || !preg_match('/^[a-f0-9]{32}$/', $_GET['uniqueID'])) {
			$this->string="";
			return false;
		} else {
			$uniqueID = $_GET['uniqueID'];
		}
		 
		if (isset($_COOKIE['FC_captcha_key']) && is_array($_COOKIE['FC_captcha_key'])) {
			$count = 0;
			if (isset($_COOKIE['FC_captcha_key'][$uniqueID])) {
				$deleteQuery = "DELETE FROM ".$wpdb->prefix."FC_captcha_store WHERE cookie_val=%s";
				$result = $wpdb->query($wpdb->prepare($deleteQuery, $_COOKIE['FC_captcha_key'][$uniqueID]));
				unset($_COOKIE['FC_captcha_key'][$uniqueID]);
			}
			
			if (sizeof($_COOKIE['FC_captcha_key']) > 20) {
				while(sizeof($_COOKIE['FC_captcha_key']) > 20 && $count < 5) {
					$count++;
					$oldCookieVal = reset($_COOKIE['FC_captcha_key']);
					if (preg_match('/^[a-f0-9]{32}$/', $oldCookieVal)) {
						$oldCookieIndex = key($_COOKIE['FC_captcha_key']);
						$tmp = array_shift($_COOKIE['FC_captcha_key']);
						$deleteQuery = "DELETE FROM ".$wpdb->prefix."FC_captcha_store WHERE cookie_val=%s";
						$result = $wpdb->query($wpdb->prepare($deleteQuery, $oldCookieVal));
						if ($uniqueID != $oldCookieIndex) {
							setcookie('FC_captcha_key['.$oldCookieIndex.']', 0, time()-3600);
						}
					}
				}
			}
		}
		$this->string="";
		$fontColor = get_option('FC_font_colors');
		$usedSpace = 0;
		$randomFontSize = mt_rand(($this->dimensions['height']*.35),($this->dimensions['height']*.65));
		while ($usedSpace < (int)($this->dimensions['width']-($randomFontSize*.75))) {
			$char = $this->gen_random_char();
			$charTestCount = 0;
			while($charTestCount < 20 && strpos(strtolower($this->string), strtolower($char)) !== false) {
				$char = $this->gen_random_char();
				$charTestCount++;
			}
			$colorSlot = mt_rand(0,sizeOf($fontColor)-1);
		
			$randomFont = $this->fonts[mt_rand()&sizeof($this->fonts)-1];
			$charSpace = imagettfbbox($randomFontSize, 0, $this->fonts[mt_rand()&sizeof($this->fonts)-1], $char);
			if ($charSpace !== false) {
				$charWidth = abs($charSpace[2]);
				$charHeight = abs($charSpace[5]);
			} else {
				$charWidth = $this->dimensions['height']*.65;
				$charHeight = $charWidth;
			}


			$usedSpace += $charWidth+5;
			$vertPosition = mt_rand($charHeight, $this->dimensions['height']-($charHeight*.1));
			
			$textColor = @imagecolorallocate($this->image, $fontColor[$colorSlot][0], $fontColor[$colorSlot][1], $fontColor[$colorSlot][2]);
			imagettftext($this->image, $randomFontSize, 0, ($usedSpace-($charWidth+5)), $vertPosition, $textColor, $randomFont, $char);
			$this->string .= $char;
			$randomFontSize = mt_rand(($this->dimensions['height']*.35),($this->dimensions['height']*.65));
		}
		$cookieVal = md5(mt_rand(9999, 9999999999) * mt_rand(9999, 9999999999));
		$cookieIndex = md5(mt_rand(9999, 9999999999) * mt_rand(9999, 9999999999));
		
		setcookie('FC_captcha_key['.$uniqueID.']', $cookieVal);
		$wpdb->insert($wpdb->prefix."FC_captcha_store", array("time"=>current_time('mysql'), "captcha"=>$this->string, "cookie_val"=>$cookieVal));
		return true;
	}


	public function set_bg_colors() {
		$this->bgColors = array();
		$bgColors = get_option('FC_bg_colors');
		if (is_array($bgColors)) {
			foreach($bgColors as $color) {
				if (sizeof($color) == 3 && is_numeric($color[0]) && is_numeric($color[1]) && is_numeric($color[2])) {
					$this->bgColors[] = $color;
				}
			}
		}
	}

	public function gen_bg($x1, $y1) {
		$this->set_bg_colors();
		if (get_option('FC_background_type') == 'random_shape') {
			$shapeCount = (is_numeric(get_option('FC_shape_count')))? get_option('FC_shape_count') : 100;
			$sectionCount = (is_numeric(get_option('FC_section_count')))? get_option('FC_section_count') : 10;
			$colorSlot = mt_rand(0,sizeOf($this->bgColors)-1);
			$shapeColor = imagecolorallocate($this->image, $this->bgColors[$colorSlot][0], $this->bgColors[$colorSlot][1], $this->bgColors[$colorSlot][2]);
			imagefill($this->image, 0, 0, $shapeColor);
			
			for ($i=0; $i<$shapeCount; $i++) {
				$coords = array();
				$randomSpot = mt_rand(0,$sectionCount-1);
				$sectionWidth = $this->dimensions['width']/$sectionCount;
				$widthRange = array($sectionWidth*$randomSpot,$sectionWidth*$randomSpot+$sectionWidth);

				$randomSpot = mt_rand(0,$sectionCount-1);
				$sectionHeight = $this->dimensions['height']/$sectionCount;
				$heightRange = array($sectionHeight*$randomSpot,$sectionHeight*$randomSpot+$sectionHeight);
				for ($x=mt_rand(5,15); $x>0; $x--) {
					$coords[] = mt_rand($widthRange[0],$widthRange[1]);
					$coords[] = mt_rand($heightRange[0],$heightRange[1]);
				}
				$colorSlot = mt_rand(0,sizeOf($this->bgColors)-1);
				$shapeColor = imagecolorallocate($this->image, $this->bgColors[$colorSlot][0], $this->bgColors[$colorSlot][1], $this->bgColors[$colorSlot][2]);
				imagefilledpolygon ( $this->image , $coords, sizeof($coords)/2, $shapeColor );
			}
		} else {
			$gradientTrans = (is_numeric(get_option('FC_gradient_transitions')))? get_option('FC_gradient_transitions') : 5;
			$lastColorSlot = mt_rand(0,sizeOf($this->bgColors)-1);
			for($x=0;$x<$gradientTrans;$x++) {
				$colorSlot = mt_rand(0,sizeOf($this->bgColors)-1);
				while(sizeof($this->bgColors) > 1 && $colorSlot == $lastColorSlot) {
					$colorSlot = mt_rand(0,sizeOf($this->bgColors)-1);
				}
				$color0=($this->bgColors[$lastColorSlot][0]-$this->bgColors[$colorSlot][0])/$this->dimensions['width'];
				$color1=($this->bgColors[$lastColorSlot][1]-$this->bgColors[$colorSlot][1])/$this->dimensions['width'];
				$color2=($this->bgColors[$lastColorSlot][2]-$this->bgColors[$colorSlot][2])/$this->dimensions['width'];
				for ($i=0;$i<=$this->dimensions['width']/$gradientTrans;$i++) {
					$red=$this->bgColors[$lastColorSlot][0]-floor($i*$color0*$gradientTrans);
					$green=$this->bgColors[$lastColorSlot][1]-floor($i*$color1*$gradientTrans);
					$blue=$this->bgColors[$lastColorSlot][2]-floor($i*$color2*$gradientTrans);
					$col= imagecolorallocate($this->image, $red, $green, $blue);
					imageline($this->image, $x1+($this->dimensions['width']/$gradientTrans*$x)+$i, $y1, $x1+($this->dimensions['width']/$gradientTrans*$x)+$i, $y1+$this->dimensions['height'], $col);
				}
				$lastColorSlot = $colorSlot;
			}
		}
	}
	
	function check_captcha_val() {
		global $wpdb;
		$caseSensitive = get_option('FC_case_sensitive');
		$returnVal = false;
		
		if (is_user_logged_in() && isset($_REQUEST['mode']) && in_array($_REQUEST['mode'], array('dashboard', 'detail', 'single')) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'replyto-comment') {
			$returnVal = true;
		} else if (isset($_COOKIE['FC_captcha_key']) && is_array($_COOKIE['FC_captcha_key']) && isset($_REQUEST['FC_captcha_input']) && $_REQUEST['FC_captcha_input'] != "" &&
		isset($_REQUEST['FC_captcha_unique_id']) && preg_match('/^[a-f0-9]{32}$/', $_REQUEST['FC_captcha_unique_id']) &&
		isset($_COOKIE['FC_captcha_key'][$_REQUEST['FC_captcha_unique_id']]) && preg_match('/^[a-f0-9]{32}$/', $_COOKIE['FC_captcha_key'][$_REQUEST['FC_captcha_unique_id']])) {
			if ($caseSensitive == 1) {
				$sql = "SELECT COUNT(*) FROM ".$wpdb->prefix."FC_captcha_store WHERE cookie_val LIKE BINARY %s AND captcha LIKE BINARY %s";
			} else {
				$sql = "SELECT COUNT(*) FROM ".$wpdb->prefix."FC_captcha_store WHERE cookie_val LIKE BINARY %s AND captcha=%s";
			}
			
			$captchaKey = sanitize_text_field($_COOKIE['FC_captcha_key'][$_REQUEST['FC_captcha_unique_id']]);
			if ($wpdb->get_var($wpdb->prepare($sql, $captchaKey, sanitize_text_field($_REQUEST['FC_captcha_input']))) == 1) {
				$returnVal = true;
			}
			$deleteQuery = "DELETE FROM ".$wpdb->prefix."FC_captcha_store WHERE cookie_val=%s";
			$result = $wpdb->query($wpdb->prepare($deleteQuery, $captchaKey));
			if (!headers_sent()) {
				setcookie('FC_captcha_key['.sanitize_text_field($_REQUEST['FC_captcha_unique_id']).']', 0, time()-999999);
			}
		}
		return $returnVal;
	}

	function purge_captcha() {
		global $wpdb;
		if (get_option('FC_last_captcha_purge') < time() - 3600) {
			$searchTime = date("Y-m-d H:i:s", strtotime(current_time('mysql')) - 1800);
			$deleteQuery = "DELETE FROM ".$wpdb->prefix."FC_captcha_store WHERE time<%s";
			$result = $wpdb->query($wpdb->prepare($deleteQuery, $searchTime));
			update_option('FC_last_captcha_purge', time());
		}
	}

	function submit_background_settings() {
		$jsonResponse = array('success'=>0, 'alerts'=>array());
		if (wp_verify_nonce(sanitize_text_field($_POST['FC_nonce']), plugin_basename(__FILE__) )) {
			##Set width
			if (is_numeric($_POST['FC_default_width']) && $_POST['FC_default_width'] <= 1000 && $_POST['FC_default_width'] >= 100) {
				update_option('FC_default_width', sanitize_text_field($_POST['FC_default_width']));
			}

			##Set height
			if (is_numeric($_POST['FC_default_height']) && $_POST['FC_default_height'] <= 1000 && $_POST['FC_default_height'] >= 16) {
				update_option('FC_default_height', sanitize_text_field($_POST['FC_default_height']));
			}


			if (isset($_POST['FC_background_type'])) {
				update_option('FC_background_type', sanitize_text_field($_POST['FC_background_type']));
			}
			
			if (is_numeric($_POST['FC_section_count']) && $_POST['FC_section_count'] <= 100) {
				update_option('FC_section_count', sanitize_text_field($_POST['FC_section_count']));
			}
			
			if (is_numeric($_POST['FC_shape_count'])) {
				update_option('FC_shape_count', sanitize_text_field($_POST['FC_shape_count']));
			}
			
			if (is_numeric($_POST['FC_gradient_transitions']) && $_POST['FC_gradient_transitions'] <= 100) {
				update_option('FC_gradient_transitions', sanitize_text_field($_POST['FC_gradient_transitions']));
			}

			if (is_array($_POST['FC_bg_colors'])) {
				$colors = array();
				foreach($_POST['FC_bg_colors'] as $color) {
					if (sizeof($color) == 3 && is_numeric($color[0]) && is_numeric($color[1]) && is_numeric($color[2])) {
						$colors[] = array(sanitize_text_field($color[0]), sanitize_text_field($color[1]), sanitize_text_field($color[2]));
					}
				}
				update_option('FC_bg_colors', $colors);
			}
			$jsonResponse['alerts'][] = "Background settings successfully saved.";
			$jsonResponse['success'] = 1;
		}
		print json_encode($jsonResponse);
		die();
	}
	
	function submit_font_settings() {
		$jsonResponse = array('success'=>0, 'alerts'=>array(), 'FC_character_list'=>'');
		if (wp_verify_nonce(sanitize_text_field($_POST['FC_nonce']), plugin_basename(__FILE__))) {
			if (isset($_POST['FC_character_list'])) {
				$charArr = str_split(sanitize_text_field($_POST['FC_character_list']));
				$charList = '';
				foreach($charArr as $char) {
					$charList = str_replace($char, '', $charList);
					$charList .= $char;
				}
				update_option('FC_character_list', $charList);
				$jsonResponse['FC_character_list'] = $charList;
			}
			
			if (is_numeric($_POST['FC_random_font_count']) && $_POST['FC_random_font_count'] < 100) {
				update_option('FC_random_font_count', sanitize_text_field($_POST['FC_random_font_count']));
			}
			
			if ($_POST['FC_case_sensitive'] == 1) {
				update_option('FC_case_sensitive', 1);
			} else {
				update_option('FC_case_sensitive', 0);
			}

			##Set font_color
			if (is_array($_POST['FC_font_colors'])) {
				$colors = array();
				foreach($_POST['FC_font_colors'] as $color) {
					if (sizeof($color) == 3 && is_numeric($color[0]) && is_numeric($color[1]) && is_numeric($color[2])) {
						$colors[] = array(sanitize_text_field($color[0]), sanitize_text_field($color[1]), sanitize_text_field($color[2]));
					}
				}
				update_option('FC_font_colors', $colors);
			}
			$jsonResponse['alerts'][] = "Font settings successfully saved.";
			$jsonResponse['success'] = 1;
		}
		print json_encode($jsonResponse);
		die();
	}
	
	function submit_gen_settings() {
		$jsonResponse = array('success'=>0, 'alerts'=>array());
		if (wp_verify_nonce(sanitize_text_field($_POST['FC_nonce']), plugin_basename(__FILE__))) {
			

			if (isset($_POST['FC_request_key']) && $_POST['FC_request_key'] != '') {
				##Set request key
				update_option('FC_request_key', sanitize_text_field($_POST['FC_request_key']));
			} else if (isset($_POST['FC_request_key'])) {
				$jsonResponse['alerts'][] = "Request key not saved.  The submitted key did not have a value.<br />";
			}
			
			if ($_POST['FC_add_to_comments'] == 1) {
				update_option('FC_add_to_comments', 1);
			} else {
				update_option('FC_add_to_comments', 0);
			}
			
			if ($_POST['FC_add_to_registration'] == 1) {
				update_option('FC_add_to_registration', 1);
			} else {
				update_option('FC_add_to_registration', 0);
			}
			
			if ($_POST['FC_add_to_login'] == 1) {
				update_option('FC_add_to_login', 1);
			} else {
				update_option('FC_add_to_login', 0);
			}
			
			if ($_POST['FC_add_jquery_to_header'] == 1 || get_option('FC_add_to_registration') == 1 || get_option('FC_add_to_comments') == 1) {
				update_option('FC_add_jquery_to_header', 1);
			} else {
				update_option('FC_add_jquery_to_header', 0);
			}
			
			$jsonResponse['alerts'][] = "General settings successfully saved.";
			$jsonResponse['success'] = 1;
		}
		print json_encode($jsonResponse);
		die();
	}
	
	function add_to_comment_form() {
		if (get_option('FC_add_to_comments') == 1) {
			print $this->get_captcha_fields_display(get_option('FC_default_width'), get_option('FC_default_height'));
		}
	}

	function add_to_registration_form() {
		if (get_option('FC_add_to_registration') == 1) {
			print $this->get_captcha_fields_display(get_option('FC_default_width'), get_option('FC_default_height'));
		}
	}

	function add_to_ms_registration_form($errors) {
		if (get_option('FC_add_to_registration') == 1) {
			if (isset($errors->errors['FC_captcha_input'])) {
				print '<p class="error">'.$errors->errors['FC_captcha_input'][0].'</p>';
			}
			print $this->get_captcha_fields_display(get_option('FC_default_width'), get_option('FC_default_height'));
		}
	}

	function add_to_login_form() {
		if (get_option('FC_add_to_login') == 1) {
			print $this->get_captcha_fields_display(get_option('FC_default_width'), get_option('FC_default_height'));
			$this->captchaDisplayed = 1;
		}
	}

	function add_to_login_form_bottom() {
		if (get_option('FC_add_to_login') == 1) {
			$this->captchaDisplayed = 1;
			return $this->get_captcha_fields_display(get_option('FC_default_width'), get_option('FC_default_height'));
		}
	}
	
	function check_ms_registration_submit($result) {
		global $pagenow;
		if ($pagenow != 'user-new.php' && get_option('FC_add_to_registration') == 1 && !$this->check_captcha_val()) {
			$result['errors']->add('FC_captcha_input', "<strong>ERROR</strong>: The entered text did not match the captcha image.");
		}
		return $result;
	}
	
	function check_registration_submit($login, $email, $errors) {
		if (get_option('FC_add_to_registration') == 1 && !$this->check_captcha_val()) {
			$errors->add('bad_captcha', "<strong>ERROR</strong>: The entered text did not match the captcha image.");
		}
	}

	function check_comment_submit($commentdata) {
		if (get_option('FC_add_to_comments') == 1 && !$this->check_captcha_val()) {
			wp_die( __( 'Error: The entered text did not match the captcha image.  Use your browsers back button and try again.' ) );
			exit;
		}
		return $commentdata;
	}

	function check_authentication($user) {
		if (get_option('FC_add_to_login') == 1 && !$this->check_captcha_val()) {
			$error = new WP_Error();
			$error->add('bad_captcha', '<strong>Error</strong>: The entered text did not match the captcha image.');
			return $error;
		}
		return $user;
	}
	
	function add_jquery_to_header() {
		if (get_option('FC_add_jquery_to_header') == 1) {
			wp_enqueue_script("jquery");
		}
	}

}
?>