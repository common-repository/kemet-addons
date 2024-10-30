(function($) {
  /**
   * Top Bar Header
   */

  kemet_css(
    "kemet-settings[topbar-bg-color]",
    "background-color",
    ".kemet-top-header"
  );

  /**
   * Top Bar Header Spacing
   */
  kemet_responsive_spacing(
    "kemet-settings[topbar-padding]",
    ".kemet-top-header",
    "padding",
    ["top", "bottom", "right", "left"]
  );
  kemet_responsive_spacing(
    "kemet-settings[topbar-item-padding]",
    ".kemet-top-header-section > div",
    "padding",
    ["top", "bottom", "right", "left"]
  );
  /**
   * Top Bar Header Link Color
   */
  kemet_css(
    "kemet-settings[topbar-link-color]",
    "color",
    ".kemet-top-header a"
  );
  kemet_css(
    "kemet-settings[topbar-submenu-bg-color]",
    "background-color",
    ".top-navigation ul.sub-menu"
  );
  kemet_css(
    "kemet-settings[topbar-link-h-color]",
    "color",
    ".kemet-top-header a:hover"
  );
  kemet_css("kemet-settings[topbar-text-color]", "color", ".kemet-top-header");
  kemet_css(
    "kemet-settings[topbar-submenu-items-color]",
    "color",
    ".top-navigation ul.sub-menu li a"
  );
  kemet_css(
    "kemet-settings[topbar-submenu-items-h-color]",
    "color",
    ".top-navigation ul.sub-menu li:hover a"
  );
  kemet_responsive_icon_select(
    "kemet-settings[section1-content-align]",
    ".kemet-top-header-section-wrap .kemet-top-header-section-1",
    "justify-content"
  );
  kemet_responsive_icon_select(
    "kemet-settings[section2-content-align]",
    ".kemet-top-header-section-wrap .kemet-top-header-section-2",
    "justify-content"
  );
  wp.customize("kemet-settings[topbar-border-bottom-size]", function(value) {
    value.bind(function(border) {
      var dynamicStyle = ".kemet-top-header{ border-width: " + border + "px }";
      kemet_add_dynamic_css("topbar-border-bottom-size", dynamicStyle);
    });
  });

  wp.customize("kemet-settings[topbar-border-color]", function(value) {
    value.bind(function(border_color) {
      jQuery(".kemet-top-header").css("border-color", border_color);
    });
  });
  kemet_responsive_slider(
    "kemet-settings[topbar-font-size]",
    ".kemet-top-header",
    "font-size"
  );
  kemet_responsive_slider(
    "kemet-settings[top-bar-letter-spacing]",
    ".kemet-top-header",
    "letter-spacing"
  );
  kemet_css(
    "kemet-settings[top-bar-text-transform]",
    "text-transform",
    ".kemet-top-header"
  );
  kemet_responsive_slider(
    "kemet-settings[top-bar-line-height]",
    ".kemet-top-header",
    "line-height"
  );
})(jQuery);
