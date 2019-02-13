/*
 * All Admin Related Scripts in this Seese Theme
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

jQuery(document).ready(function($) {

	/*---------------------------------------------------------------*/
/* =  Toggle Meta boxes based on post formats
  /*---------------------------------------------------------------*/

	function toggle_metaboxes() {

		var format = $("input[name='post_format']:checked").val();

		$('#cs-tab-section_post_formats .cs-field-notice, #cs-tab-section_post_formats .cs-element-standardimage-format, #cs-tab-section_post_formats .cs-element-display-format, #cs-tab-section_post_formats .cs-element-add-gallery, #cs-tab-section_post_formats .cs-element-add-audio, #cs-tab-section_post_formats .cs-element-add-video').hide();

		if (format == '0' || format == 'image') {
			$('').slideUp('fast');
			$('.cs-element-standardimage-format').slideDown('slow');
		}
		if (format == 'gallery') {
			$('').slideUp('fast');
			$('#cs-tab-section_post_formats .gallery-title, #cs-tab-section_post_formats .cs-element-display-format, #cs-tab-section_post_formats .cs-element-add-gallery').slideDown('slow');
		}
		if (format == 'audio') {
			$('').slideUp('fast');
			$('#cs-tab-section_post_formats .audio-title, #cs-tab-section_post_formats .cs-element-add-audio').slideDown('slow');
		}
		if (format == 'video') {
			$('').slideUp('fast');
			$('#cs-tab-section_post_formats .video-title, #cs-tab-section_post_formats .cs-element-add-video').slideDown('slow');
		}
	}

	toggle_metaboxes(); // Execute on document ready

	$('#post-formats-select input[type="radio"]').click(toggle_metaboxes);

	if ($('body').hasClass('post-type-page')) {
		//alert('yes');
	} else {
		//alert('no');
    $(".cs-nav ul li a[data-section='banner_title_section']").parent('li').hide();
		$(".cs-sections #cs-tab-banner_title_section").hide();
	}
});


/*
 * TipTip
 * Copyright 2010 Drew Wilson
 * www.drewwilson.com
 * code.drewwilson.com/entry/tiptip-jquery-plugin
 *
 * Version 1.3   -   Updated: Mar. 23, 2010
 *
 * This Plug-In will create a custom tooltip to replace the default
 * browser tooltip. It is extremely lightweight and very smart in
 * that it detects the edges of the browser window and will make sure
 * the tooltip stays within the current window size. As a result the
 * tooltip will adjust itself to be displayed above, below, to the left
 * or to the right depending on what is necessary to stay within the
 * browser window. It is completely customizable as well via CSS.
 *
 * This TipTip jQuery plug-in is dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function($) {
	$.fn.tipTip = function(options) {
		var defaults = {
			activation: "hover",
			keepAlive: false,
			maxWidth: "200px",
			edgeOffset: 3,
			defaultPosition: "bottom",
			delay: 400,
			fadeIn: 200,
			fadeOut: 200,
			attribute: "title",
			content: false,
			enter: function() {},
			exit: function() {}
		};
		var opts = $.extend(defaults, options);
		if ($("#tiptip_holder").length <= 0) {
			var tiptip_holder = $('<div id="tiptip_holder" style="max-width:' + opts.maxWidth + ';"></div>');
			var tiptip_content = $('<div id="tiptip_content"></div>');
			var tiptip_arrow = $('<div id="tiptip_arrow"></div>');
			$("body").append(tiptip_holder.html(tiptip_content).prepend(tiptip_arrow.html('<div id="tiptip_arrow_inner"></div>')))
		} else {
			var tiptip_holder = $("#tiptip_holder");
			var tiptip_content = $("#tiptip_content");
			var tiptip_arrow = $("#tiptip_arrow")
		}
		return this.each(function() {
			var org_elem = $(this);
			if (opts.content) {
				var org_title = opts.content
			} else {
				var org_title = org_elem.attr(opts.attribute)
			}
			if (org_title != "") {
				if (!opts.content) {
					org_elem.removeAttr(opts.attribute)
				}
				var timeout = false;
				if (opts.activation == "hover") {
					org_elem.hover(function() {
						active_tiptip()
					}, function() {
						if (!opts.keepAlive) {
							deactive_tiptip()
						}
					});
					if (opts.keepAlive) {
						tiptip_holder.hover(function() {}, function() {
							deactive_tiptip()
						})
					}
				} else if (opts.activation == "focus") {
					org_elem.focus(function() {
						active_tiptip()
					}).blur(function() {
						deactive_tiptip()
					})
				} else if (opts.activation == "click") {
					org_elem.click(function() {
						active_tiptip();
						return false
					}).hover(function() {}, function() {
						if (!opts.keepAlive) {
							deactive_tiptip()
						}
					});
					if (opts.keepAlive) {
						tiptip_holder.hover(function() {}, function() {
							deactive_tiptip()
						})
					}
				}

				function active_tiptip() {
					opts.enter.call(this);
					tiptip_content.html(org_title);
					tiptip_holder.hide().removeAttr("class").css("margin", "0");
					tiptip_arrow.removeAttr("style");
					var top = parseInt(org_elem.offset()['top']);
					var left = parseInt(org_elem.offset()['left']);
					var org_width = parseInt(org_elem.outerWidth());
					var org_height = parseInt(org_elem.outerHeight());
					var tip_w = tiptip_holder.outerWidth();
					var tip_h = tiptip_holder.outerHeight();
					var w_compare = Math.round((org_width - tip_w) / 2);
					var h_compare = Math.round((org_height - tip_h) / 2);
					var marg_left = Math.round(left + w_compare);
					var marg_top = Math.round(top + org_height + opts.edgeOffset);
					var t_class = "";
					var arrow_top = "";
					var arrow_left = Math.round(tip_w - 12) / 2;
					if (opts.defaultPosition == "bottom") {
						t_class = "_bottom"
					} else if (opts.defaultPosition == "top") {
						t_class = "_top"
					} else if (opts.defaultPosition == "left") {
						t_class = "_left"
					} else if (opts.defaultPosition == "right") {
						t_class = "_right"
					}
					var right_compare = (w_compare + left) < parseInt($(window).scrollLeft());
					var left_compare = (tip_w + left) > parseInt($(window).width());
					if ((right_compare && w_compare < 0) || (t_class == "_right" && !left_compare) || (t_class == "_left" && left < (tip_w + opts.edgeOffset + 5))) {
						t_class = "_right";
						arrow_top = Math.round(tip_h - 13) / 2;
						arrow_left = -12;
						marg_left = Math.round(left + org_width + opts.edgeOffset);
						marg_top = Math.round(top + h_compare)
					} else if ((left_compare && w_compare < 0) || (t_class == "_left" && !right_compare)) {
						t_class = "_left";
						arrow_top = Math.round(tip_h - 13) / 2;
						arrow_left = Math.round(tip_w);
						marg_left = Math.round(left - (tip_w + opts.edgeOffset + 5));
						marg_top = Math.round(top + h_compare)
					}
					var top_compare = (top + org_height + opts.edgeOffset + tip_h + 8) > parseInt($(window).height() + $(window).scrollTop());
					var bottom_compare = ((top + org_height) - (opts.edgeOffset + tip_h + 8)) < 0;
					if (top_compare || (t_class == "_bottom" && top_compare) || (t_class == "_top" && !bottom_compare)) {
						if (t_class == "_top" || t_class == "_bottom") {
							t_class = "_top"
						} else {
							t_class = t_class + "_top"
						}
						arrow_top = tip_h;
						marg_top = Math.round(top - (tip_h + 5 + opts.edgeOffset))
					} else if (bottom_compare | (t_class == "_top" && bottom_compare) || (t_class == "_bottom" && !top_compare)) {
						if (t_class == "_top" || t_class == "_bottom") {
							t_class = "_bottom"
						} else {
							t_class = t_class + "_bottom"
						}
						arrow_top = -12;
						marg_top = Math.round(top + org_height + opts.edgeOffset)
					}
					if (t_class == "_right_top" || t_class == "_left_top") {
						marg_top = marg_top + 5
					} else if (t_class == "_right_bottom" || t_class == "_left_bottom") {
						marg_top = marg_top - 5
					}
					if (t_class == "_left_top" || t_class == "_left_bottom") {
						marg_left = marg_left + 5
					}
					tiptip_arrow.css({
						"margin-left": arrow_left + "px",
						"margin-top": arrow_top + "px"
					});
					tiptip_holder.css({
						"margin-left": marg_left + "px",
						"margin-top": marg_top + "px"
					}).attr("class", "tip" + t_class);
					if (timeout) {
						clearTimeout(timeout)
					}
					timeout = setTimeout(function() {
						tiptip_holder.stop(true, true).fadeIn(opts.fadeIn)
					}, opts.delay)
				}

				function deactive_tiptip() {
					opts.exit.call(this);
					if (timeout) {
						clearTimeout(timeout)
					}
					tiptip_holder.fadeOut(opts.fadeOut)
				}
			}
		})
	}
})(jQuery);

// After above plugins load
jQuery(document).ready(function($) {

	// Tooltip for System Status [?]
	$('.tool_tip_help').tipTip({
		attribute: 'data-tip'
	});
	$('a.tool_tip_help').click(function() {
		return false;
	});
	$(".seese-cs-widget-fields").parents(".widget-inside").addClass("seese-cs-widget");

	// Auto & Manual Import Tabs Active Mode
  $(function() {
    var loc = window.location.href; // returns the full URL
    console.log(loc);
    if(loc.indexOf('manual') > -1) {
      $('.nav-tab-wrapper .vt-auto-mode').removeClass('nav-tab-active');
      $('.nav-tab-wrapper .vt-manual-mode').addClass('nav-tab-active');
    }
  });

});

// Add Color to widget
jQuery(document).ready(function($) {
	'use strict';

	function initColorPicker(widget) {
		widget.find('.seese-widget-color-picker').wpColorPicker();
	};

	function onFormUpdate(event, widget) {
		initColorPicker(widget);
	};

	var $document = $(document);
	$document.on('widget-added widget-updated', onFormUpdate);
	$document.ready(function() {
		$('#widgets-right .widget:has(.seese-widget-color-picker)').each(function() {
			initColorPicker($(this));
		});
	});
});