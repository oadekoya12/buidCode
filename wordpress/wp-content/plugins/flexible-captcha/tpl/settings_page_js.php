<script type="text/javascript" language="javascript" src="<?php print $this->urlPath . "/js/colorpicker.js"; ?>"></script>
<script type="text/javascript" language="javascript">
	var FC_bg_colors = <?php print json_encode(get_option('FC_bg_colors')); ?>;
	var FC_font_colors = <?php print json_encode(get_option('FC_font_colors')); ?>;
	function FC_submit_gen_settings() {
		var checkBoxes = {
			'FC_add_to_comments': 0,
			'FC_add_to_registration': 0,
			'FC_add_to_login': 0,
			'FC_add_jquery_to_header': 0
		};
		
		var postObject = {
			'FC_add_to_comments': 0,
			'FC_add_to_registration': 0,
			'FC_add_to_login': 0,
			'FC_add_jquery_to_header': 0,
			'FC_request_key': jQuery('#FC_request_key').val(),
			'FC_nonce': '<?php print $this->nonce; ?>'
		};

		for(var key in checkBoxes) {
			if (jQuery('#'+key).attr('checked')) {
				checkBoxes[key] = 1;
			}
			postObject[key] = checkBoxes[key];
		}

		FC_submit_ajax('FC_submit_gen_settings', postObject, '#FC-gen-settings-div', '');

		return false;
	}

	function FC_submit_background_settings() {
		jQuery('input').removeClass('FC-form-error');
		if (jQuery('#FC_default_width').val() < 100 || jQuery('#FC_default_width').val() > 1000) {
			jQuery('#FC-ajax-notices-container').html("The default width must be a number between 100 and 1000.");
			jQuery("#FC-show-ajax-notices").click();
			jQuery('#FC_default_width').addClass('FC-form-error');
			jQuery('#FC_default_width').val(100);
			return false;
		}

		if (jQuery('#FC_default_height').val() < 16 || jQuery('#FC_default_height').val() > 1000) {
			jQuery('#FC-ajax-notices-container').html("The default width must be a number between 16 and 1000.");
			jQuery("#FC-show-ajax-notices").click();
			jQuery('#FC_default_height').addClass('FC-form-error');
			jQuery('#FC_default_height').val(16);
			return false;
		}
		
		if (jQuery('#FC_background_type').val() == 'random_shape' && jQuery('#FC_section_count').val() > 100) {
			jQuery('#FC-ajax-notices-container').html("The number of sections is limited to 100.");
			jQuery("#FC-show-ajax-notices").click();
			jQuery('#FC_section_count').addClass('FC-form-error');
			jQuery('#FC_section_count').val(100);
			return false;
		}

		if (jQuery('#FC_background_type').val() == 'gradient' && jQuery('#FC_gradient_transitions').val() > 100) {
			jQuery('#FC-ajax-notices-container').html("The number of gradient transitions is limited to 100.");
			jQuery("#FC-show-ajax-notices").click();
			jQuery('#FC_gradient_transitions').addClass('FC-form-error');
			jQuery('#FC_gradient_transitions').val(100);
			return false;
		}

		var postObject = {
			'FC_background_type': jQuery('#FC_background_type').val(),
			'FC_bg_colors': FC_bg_colors,
			'FC_section_count': jQuery('#FC_section_count').val(),
			'FC_shape_count': jQuery('#FC_shape_count').val(),
			'FC_gradient_transitions': jQuery('#FC_gradient_transitions').val(),
			'FC_default_width': jQuery('#FC_default_width').val(),
			'FC_default_height': jQuery('#FC_default_height').val(),
			'FC_nonce': '<?php print $this->nonce; ?>'
		};

		FC_submit_ajax('FC_submit_background_settings', postObject, '#FC-background-settings-div', '');

		return false;
	}

	function FC_submit_font_settings() {
		var postObject = {
			'FC_character_list': jQuery('#FC-character-list').val(),
			'FC_case_sensitive': 0,
			'FC_random_font_count': jQuery('#FC_random_font_count').val(),
			'FC_font_colors': FC_font_colors,
			'FC_nonce': '<?php print $this->nonce; ?>'
		};
		
		if (jQuery('#FC_case_sensitive').attr('checked')) {
			postObject['FC_case_sensitive'] = 1;
		}
		FC_submit_ajax('FC_submit_font_settings', postObject, '#FC-font-settings-div', function (responseObj) {
			jQuery('#FC-character-list').val(responseObj['FC_character_list']);
		});

		return false;
	}

	function FC_delete_font_file(fontFile, rowId) {
		var postObject = {
			'FC_font_file': fontFile,
			'FC_nonce': '<?php print $this->nonce; ?>'
		};

		FC_submit_ajax('FC_delete_font_file', postObject, '#FC-font-files-div', function (responseObj) {
			jQuery('#FC_font_file_'+rowId).remove();
		});
		return false;
	}
	
	function FC_rebuild_colors() {
		jQuery('#FC-font-colors-div, #FC-bg-colors-div').html('');
		FC_add_color_pickers();
	}
	
	function FC_delete_font_colors() {
		if (confirm('Do you really want to delete the selected Font Colors?')) {
			selectedIndexes = new Array();
			jQuery('.FC_delete_font_color').each(function() {
				if (jQuery(this).attr('checked')) {
					selectedIndexes[selectedIndexes.length] = jQuery(this).val();
				}
			});

			//sort indexes so we start removing at the highest index.
			selectedIndexes.sort(function(a, b){return b-a});
			for (var i=0; i<selectedIndexes.length; i++) {
				FC_font_colors.splice(selectedIndexes[i],1);
			}
			FC_rebuild_colors();
		}
	}

	function FC_delete_bg_colors(colorIndex) {
		if (confirm('Do you really want to delete the selected Background Colors?')) {
			selectedIndexes = new Array();
			jQuery('.FC_delete_bg_color').each(function() {
				if (jQuery(this).attr('checked')) {
					selectedIndexes[selectedIndexes.length] = jQuery(this).val();
				}
			});

			//sort indexes so we start removing at the highest index.
			selectedIndexes.sort(function(a, b){return b-a});
			for (var i=0; i<selectedIndexes.length; i++) {
				FC_bg_colors.splice(selectedIndexes[i],1);
			}
			FC_rebuild_colors();
		}
	}

	function FC_add_new_color(colorType) {
		if (colorType == 'font') {
			colorIndex = FC_font_colors.length;
			FC_font_colors[colorIndex] = [0, 0, 0];
			FC_add_font_color(colorIndex);
		} else if (colorType == 'bg') {
			colorIndex = FC_bg_colors.length;
			FC_bg_colors[colorIndex] = [0, 0, 0];
			FC_add_bg_color(colorIndex);
		}
	}
	
	function FC_add_font_color(colorIndex) {
		jQuery('#FC-font-colors-div').append(
			'<div id="FC_font_color_'+colorIndex+'_div" class="FC_font_color_div">&nbsp;</div>'
			+'<input name="FC_delete_font_color" class="FC_delete_font_color" type="checkbox" value="'+colorIndex+'" />'
		);
		
		jQuery('#FC_font_color_'+colorIndex+'_div').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				FC_font_colors[colorIndex] = [rgb.r, rgb.g, rgb.b];
				jQuery('#FC_font_color_'+colorIndex+'_div').css('backgroundColor', 'rgb('+rgb.r+', '+rgb.g+', '+rgb.b+')');
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor({r: FC_font_colors[colorIndex][0], g: FC_font_colors[colorIndex][1], b: FC_font_colors[colorIndex][2]});
			}
		});

		jQuery('#FC_font_color_'+colorIndex+'_div').css('backgroundColor', 'rgb('+FC_font_colors[colorIndex][0]+', '+FC_font_colors[colorIndex][1]+', '+FC_font_colors[colorIndex][2]+')');
	}
	
	function FC_add_bg_color(colorIndex) {
		jQuery('#FC-bg-colors-div').append(
			'<div id="FC_bg_color_'+colorIndex+'_div" class="FC_bg_color_div">&nbsp;</div>'
			+'<input name="FC_delete_bg_color" class="FC_delete_bg_color" type="checkbox" value="'+colorIndex+'" />'
		);

		jQuery('#FC_bg_color_'+colorIndex+'_div').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				FC_bg_colors[colorIndex] = [rgb.r, rgb.g, rgb.b];
				jQuery('#FC_bg_color_'+colorIndex+'_div').css('backgroundColor', 'rgb('+rgb.r+', '+rgb.g+', '+rgb.b+')');
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor({r: FC_bg_colors[colorIndex][0], g: FC_bg_colors[colorIndex][1], b: FC_bg_colors[colorIndex][2]});
			}
		});

		jQuery('#FC_bg_color_'+colorIndex+'_div').css('backgroundColor', 'rgb('+FC_bg_colors[colorIndex][0]+', '+FC_bg_colors[colorIndex][1]+', '+FC_bg_colors[colorIndex][2]+')');
	}
	
	function FC_add_color_pickers() {
		for(var i=0; i<FC_font_colors.length; i++) {
			FC_add_font_color(i);
		}

		for(var i=0; i<FC_bg_colors.length; i++) {
			FC_add_bg_color(i);
		}

	}

	function FC_add_listeners() {
		jQuery('#FC_background_type').change(function() {
			if (jQuery(this).val() == 'gradient') {
				jQuery('#gradient_settings').css('display', '');
				jQuery('#random_shape_settings').css('display', 'none');

			} else if (jQuery(this).val() == 'random_shape') {
				jQuery('#gradient_settings').css('display', 'none');
				jQuery('#random_shape_settings').css('display', '');
			}
		});
		jQuery('#FC_background_type').change();
	}
	

	function FC_show_tab(tab) {
		jQuery('#FC-tab-menu li').removeClass('active');
		jQuery(tab).addClass('active');
		jQuery('#FC-tab-content .FC-tab-content').removeClass('active');
		jQuery('#'+jQuery(tab).prop('id')+'-content').addClass('active');

	}
		
	jQuery(function() {
		FC_add_color_pickers();
		FC_add_listeners();

		jQuery('#FC-tab-menu li').click(function() {
			FC_show_tab(this);
		});
	});
</script>