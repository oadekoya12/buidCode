<script language="javascript" type="text/javascript">
	jQuery(function() {
		jQuery('#FC-ui-notices').dialog({
			dialogClass: 'FC-ui-dialog',
			closeText: 'X',
			autoOpen: false,
			resizable: false,
			height: "auto",
			width: (jQuery(window).width() > 400)?'400':jQuery(window).width()-20,
			modal: true,
			position: {within: '.FC-content-wrap'},
			buttons: {
				"Ok": function() {
					jQuery(this).dialog("close");
				}
			},
			open: function(event, ui) {
				jQuery('.ui-widget-overlay.ui-front').css('position', 'fixed');
				jQuery('.ui-widget-overlay.ui-front').css('left', '0px');
				jQuery('.ui-widget-overlay.ui-front').css('right', '0px');
				jQuery('.ui-widget-overlay.ui-front').css('top', '0px');
				jQuery('.ui-widget-overlay.ui-front').css('bottom', '0px');
				jQuery('.ui-widget-overlay.ui-front').css('background', '#000');
				jQuery('.ui-widget-overlay.ui-front').css('opacity', '.5');
				jQuery('.ui-widget-overlay.ui-front').css('zIndex', '9998');
			}
		});
		FC_attach_help_dialog();
	});

	function FC_toggle_loading(container) {
		jQuery(container+' .FC-loading-container').toggle();
		jQuery(container+' .inside').toggle();
	}

	function FC_submit_ajax(action, postVars, container, callback) {
		FC_toggle_loading(container);
		jQuery.post(encodeURI(ajaxurl + '?action='+action), postVars, function (result) {
			try {
				var responseObj = jQuery.parseJSON(result);
			} catch(err) {
				var responseObj = {'success': 0, 'alerts': ['There was an issue saving the changes you made']};
			}
			
			if (typeof(callback) == 'function') {
				callback(responseObj);
			}
			if (responseObj['alerts'].length > 0) {
				var submissionAlerts = '';
				for (var i=0; i<responseObj['alerts'].length; i++) {
					submissionAlerts = submissionAlerts+'<br />'+responseObj['alerts'][i];
				}
				FC_display_ui_dialog('Submission Result', submissionAlerts);
			}

			FC_toggle_loading(container);
		});
	}

	function FC_display_ui_dialog(dialogTitle, dialogText) {
		jQuery('.FC-ui-dialog .ui-dialog-title').html(dialogTitle);
		jQuery('#FC-ui-notices-container').html(dialogText);
		jQuery('#FC-ui-notices').dialog('open');
	}

	function FC_attach_help_dialog() {
		jQuery('.help-dialog').tooltip({
			content: function() {
				return FC_format_tooltip(jQuery(this).attr('title'));
			},
			show: {
				effect: "slideDown",
				delay: 50
			},
			hide: {
				effect: "slideUp",
				delay: 50
			}
		});
	}

	function FC_format_tooltip(tooltipTxt) {
		var formattedTxt = tooltipTxt.replace(/__ts__/g, '<div class="tooltip-title">');
		formattedTxt = formattedTxt.replace(/__rs__/g, '<div class="tooltip-row">');
		return formattedTxt.replace(/(__te__|__re__)/g, '</div>');
	}
</script>