(function ($) {
  kemet_css(
    "kemet-settings[sticky-menu-link-color]",
    "color",
    ".kmt-is-sticky .main-header-menu a"
  );
  kemet_css(
    "kemet-settings[sticky-menu-link-h-color]",
    "color",
    ".kmt-is-sticky .main-header-menu li:hover a,.kmt-is-sticky .main-header-menu li.current_page_item a"
  );
  kemet_css(
    "kemet-settings[sticky-submenu-bg-color]",
    "background-color",
    ".kmt-is-sticky .main-header-menu ul.sub-menu"
  );
  kemet_css(
    "kemet-settings[sticky-border-bottom-color]",
    "border-bottom-color",
    ".kmt-is-sticky.header-main-layout-4 .main-header-container.logo-menu-icon , .kmt-is-sticky .main-header-bar"
  );
  /**
   * SubMenu Border color
   */
  kemet_css(
    "kemet-settings[sticky-submenu-border-color]",
    "border-bottom-color",
    ".kmt-is-sticky .main-header-menu .sub-menu a"
  );

  /**
   * Sticky Header background
   */
  wp.customize("kemet-settings[sticky-bg-obj]", function (value) {
    value.bind(function (bg_obj) {
      var dynamicStyle =
        " .site-header.kmt-is-sticky .main-header-bar { {{css}} }";
      kemet_background_obj_css(
        wp.customize,
        bg_obj,
        "sticky-bg-obj",
        dynamicStyle
      );
    });
  });
  wp.customize("kemet-settings[sticky-submenu-link-color]", function (setting) {
    setting.bind(function (color) {
      if (color == "") {
        wp.customize.preview.send("refresh");
      }
      dynamicStyle =
        ".kmt-is-sticky .main-header-menu .sub-menu li a{ color: " +
        color +
        " } ";
      dynamicStyle +=
        ".kmt-is-sticky .main-header-menu .sub-menu li a{ border-bottom-color: " +
        color +
        " } ";
      kemet_add_dynamic_css("sticky-submenu-link-color", dynamicStyle);
    });
  });
  wp.customize(
    "kemet-settings[sticky-submenu-link-h-color]",
    function (setting) {
      setting.bind(function (color) {
        if (color == "") {
          wp.customize.preview.send("refresh");
        }
        dynamicStyle =
          ".site-header.kmt-is-sticky .main-header-menu .sub-menu li:hover a,.kmt-is-sticky .main-header-menu .sub-menu li.current_page_item a{ color: " +
          color +
          " } ";
        kemet_add_dynamic_css("sticky-submenu-link-h-color", dynamicStyle);
      });
    }
  );
  /**
   * Site Identity Spacing
   */
  kemet_responsive_spacing(
    "kemet-settings[sticky-site-identity-spacing]",
    "#sitehead.site-header.kmt-is-sticky .kmt-site-identity",
    "padding",
    ["top", "right", "bottom", "left"]
  );
  /*
   * Site Identity Logo Width
   */
  kemet_responsive_spacing(
    "kemet-settings[sticky-header-padding]",
    ".kmt-is-sticky .main-header-bar",
    "padding",
    ["top", "bottom", "right", "left"]
  );
  kemet_responsive_slider(
    "kemet-settings[sticky-logo-width]",
    "#sitehead .site-logo-img .custom-logo-link.sticky-custom-logo img , kmt-is-sticky .kemet-logo-svg",
    "width"
  );
  kemet_responsive_spacing(
    "kemet-settings[sticky-menu-item-spacing]",
    ".kmt-header-break-point .site-header.kmt-is-sticky .main-navigation ul li > a,.site-header.kmt-is-sticky .kmt-sitehead-custom-menu-items > *:not(.button),.site-header.kmt-is-sticky .main-header-menu li > a",
    "padding",
    ["top", "bottom", "right", "left"]
  );
  kemet_responsive_slider(
    "kemet-settings[sticky-border-width]",
    ".kmt-is-sticky.header-main-layout-4 .main-header-container.logo-menu-icon , .kmt-is-sticky .main-header-bar",
    "border-bottom-width"
  );
})(jQuery);
