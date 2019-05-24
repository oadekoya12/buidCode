<div id="wrap" class="FC-content-wrap">
    <div class="fc-setting-icon fa fa-cogs" id="icon-fc-settings"> <br /> </div>

    <h2 class="fc-setting-title">Settings</h2>
	<div style="clear: both;"></div>
	
	<div id="FC-tab-container">
		<div id="FC-tab-menu-container">
			<ul id="FC-tab-menu">
				<li id="FC-tab-1" class="active"><span class="FC-tab">Background</span></li>
				<li id="FC-tab-2"><span class="FC-tab">Font Settings</span></li>
				<li id="FC-tab-3"><span class="FC-tab">Upload Fonts</span></li>
				<li id="FC-tab-4"><span class="FC-tab">General Settings</span></li>
			</ul>
			<div style="clear: both;"></div>
		</div>
		<div id="FC-tab-content">
			<div id="FC-tab-1-content" class="FC-tab-content active">
				<div id="FC-background-settings-div">
					<div class="FC-loading-container fa fa-spinner fa-pulse"></div>
					<div class="inside">
						<h3>Background</h3>
						<label for="FC_default_width">Default Dimensions</label>
						<div id="FC-default-dim-div" class="FC-options-container">
							Width: <input type="text" name="FC_default_width" id="FC_default_width" value="<?php print get_option("FC_default_width"); ?>" /><br />
							Height: <input type="text" name="FC_default_height" id="FC_default_height" value="<?php print get_option("FC_default_height"); ?>" /><br />
						</div>
						
						<label for="FC_background_type">Background Type:  </label>
						<select name="FC_background_type" id="FC_background_type"><option value="gradient">Gradient</option><option value="random_shape"<?php print (get_option("FC_background_type") == 'random_shape')? ' selected="selected"':''; ?>>Random Shapes</option></select><br />
						
						<div id="random_shape_settings" style="height: 100px;display: none;">
							<label for="FC_section_count">Background Sections:  </label>
							<input type="text" name="FC_section_count" id="FC_section_count" value="<?php print get_option("FC_section_count"); ?>" />
							<span class="help-dialog fa fa-question-circle" title="__ts__Background Sections__te____rs__The number of sections that the background will be broken into for a shape to be drawn in.__re____rs__Max: 100.__re__"></span><br />
							<label for="FC_shape_count">Shape Count:  </label>
							<input type="text" name="FC_shape_count" id="FC_shape_count" value="<?php print get_option("FC_shape_count"); ?>" />
							<span class="help-dialog fa fa-question-circle" title="__ts__Shape Count__te____rs__The number of random shapes to be drawn.__re__"></span>
						</div>
						
						<div id="gradient_settings" style="height: 100px;display: none;">
							<label for="FC_gradient_transitions">Gradient Transitions:  </label><input type="text" name="FC_gradient_transitions" id="FC_gradient_transitions" value="<?php print get_option("FC_gradient_transitions"); ?>" />
							<span class="help-dialog fa fa-question-circle" title="__ts__Gradient Transitions__te____rs__The number of transitions from one color to another.__re____rs__Max: 100.__re__"></span>
						</div>

						<h4>
							<label for="FC-add-bg-color">Background Colors: </label>
							<span class="help-dialog fa fa-question-circle" title="__ts__Background Colors__te____rs__To delete colors check the box in the top left corner and click the Delete Colors button below it.__re__"></span>
						</h4>
						
						<div id="FC-bg-colors-div">
						</div>
						<div style="clear: both;"></div>
						<input type="button" id="FC-add-bg-color" value="Add Background Color" onclick="javascript:FC_add_new_color('bg');" /> &nbsp;&nbsp;
						<input type="button" id="FC-delete-bg-colors" value="Delete Colors" onclick="javascript:FC_delete_bg_colors();" />
						<div style="text-align: center;">
							<input type="button" name="FC_submit_background_settings" value="Submit" onmousedown="FC_submit_background_settings();" />
						</div>
					</div>
				</div>
			</div>

			<div id="FC-tab-2-content" class="FC-tab-content">
				<div id="FC-font-settings-div">
					<div class="FC-loading-container">
						<div>
							<img src="<?php print $this->urlPath . "/images/ajax-loader-round.gif"; ?>">
						</div>
					</div>
					<div class="inside">
						<h3>Font settings</h3>
						<label for="FC_character_list">Character List:  </label>
						<input type="text" name="FC_character_list" id="FC-character-list" value="<?php print get_option("FC_character_list"); ?>" maxlength="1000" />
						<span class="help-dialog fa fa-question-circle" title="__ts__Character List__te____rs__You can enter a list of characters that you want to use for your captcha images here.__re____rs__This is optional but will allow you to only use numbers for instance.__re____rs__If it is left blank it will use the default set of characters a-z 1-9.__re__"></span><br />
						
						<br />
						<label for="FC_random_font_count">Random Font Count:  </label>
						<input type="text" name="FC_random_font_count" id="FC_random_font_count" value="<?php print get_option("FC_random_font_count"); ?>" /><br />
						
						<br />
						<label for="FC_case_sensitive">Case Sensitive:  </label>
						<input type="checkbox" name="FC_case_sensitive" id="FC_case_sensitive" value="1"<?php print (get_option('FC_case_sensitive') == 1)? ' checked="checked"' : ''; ?> /><br />
						
						<h4>
							<label for="FC_delete_font_color">Font Colors:</label>
							<span class="help-dialog fa fa-question-circle" title="__ts__Background Colors__te____rs__To add a color click 'Add Font Color'.__re____rs__To delete colors check the box in the top left corner of the color and click the 'Delete Colors' button below it.__re__"></span>
						</h4>
						<div id="FC-font-colors-div">
						</div>
						<div style="clear: both;"></div>
						<input style="margin-bottom: 50px;" id="FC-add-font-color" type="button" value="Add Font Color" onclick="javascript:FC_add_new_color('font');" /> &nbsp;&nbsp;
						<input type="button" id="FC-delete-font-colors" value="Delete Colors" onclick="javascript:FC_delete_font_colors();" />
						<div style="text-align: center;">
							<input type="button" name="FC_submit_font_settings" value="Submit" onmousedown="FC_submit_font_settings();" />
						</div>
					</div>
				</div>
			</div>
			<div id="FC-tab-3-content" class="FC-tab-content">
				<div id="FC-font-files-div">
					<div class="FC-loading-container">
						<div>
							<img src="<?php print $this->urlPath . "/images/ajax-loader-round.gif"; ?>">
						</div>
					</div>
					<div class="inside">
						<h3><label for="FC_font_upload">Upload Fonts</label></h3>
						<form method="post" action="" enctype="multipart/form-data">
							Font File: <input type="file" name="FC_font_upload" id="FC_font_upload" value="" />
							<span class="help-dialog fa fa-question-circle" title="__ts__Font File__te____rs__Font file must be TTF or OTF.__re__"></span><br />
							<input type="hidden" name="FC_nonce" value="<?php print $this->nonce; ?>">
							<input type="submit" name="submit_font_file" value="Submit" />
						</form>
						<hr />
						<br /><br />
						<div>
							<?php
							if (is_array($fontFiles)) {
								foreach ($fontFiles as $key=>$font) {
									print '<div style="border-bottom: 1px solid #000000;" id="FC_font_file_'.$key.'"><input type="image" style="margin: 0px; padding: 0px;" src="'.$this->urlPath.'/images/delete.png" class="delete_font" onmousedown="FC_delete_font_file(\''.$font.'\', '.$key.');" />'.$this->fontDirectory . $font.'</div>';
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>

			<div id="FC-tab-4-content" class="FC-tab-content">
				<div id="FC-gen-settings-div">
					<div class="FC-loading-container">
						<div>
							<img src="<?php print $this->urlPath . "/images/ajax-loader-round.gif"; ?>">
						</div>
					</div>
					<div class="inside">
						<h3>General Settings</h3>
						<label for="FC_request_key">Request key:</label>
						<input type="text" name="FC_request_key" id="FC_request_key" value="<?php print get_option("FC_request_key"); ?>" /><br />

						<label for="FC_add_to_comments">Add To Comment Form:  </label>
						<input type="checkbox" name="FC_add_to_comments" id="FC_add_to_comments" value="1"<?php print (get_option('FC_add_to_comments') == 1)? ' checked="checked"' : ''; ?> /><br />
						
						<label for="FC_add_to_registration">Add To Registration Form:  </label>
						<input type="checkbox" name="FC_add_to_registration" id="FC_add_to_registration" value="1"<?php print (get_option('FC_add_to_registration') == 1)? ' checked="checked"' : ''; ?> /><br />
						
						<label for="FC_add_to_login">Add To Login Form:  </label>
						<input type="checkbox" name="FC_add_to_login" id="FC_add_to_login" value="1"<?php print (get_option('FC_add_to_login') == 1)? ' checked="checked"' : ''; ?> /><br />
						
						<label for="FC_add_jquery_to_header">Add jQuery To Header:  </label>
						<input type="checkbox" name="FC_add_jquery_to_header" id="FC_add_jquery_to_header" value="1"<?php print (get_option('FC_add_jquery_to_header') == 1)? ' checked="checked"' : ''; ?> />
						<div style="text-align: center;">
							<input type="button" name="FC_submit_font_settings" value="Submit" onmousedown="FC_submit_gen_settings();" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>