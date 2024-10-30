(function ($) {
  kemet_css(
    "kemet-settings[header-content-bg-color]",
    "background-color",
    ".header-boxed-width .main-header-content , .header-stretched-width .main-header-content"
  );
  kemet_css(
    "kemet-settings[header-icon-bars-logo-bg-color]",
    "background-color",
    ".site-header .logo-menu-icon"
  );
  kemet_css(
    "kemet-settings[header-main-sep-color]",
    "border-color",
    ".kemet-main-v-header-align-right .main-header-bar-wrap , .kemet-main-v-header-align-left .main-header-bar-wrap"
  );
  kemet_css(
    "kemet-settings[header-icon-bars-color]",
    "background-color",
    ".site-header .menu-icon-social .icon-bars-btn span"
  );
  kemet_css(
    "kemet-settings[header-icon-bars-h-color]",
    "background-color",
    ".site-header .menu-icon-social .menu-icon:hover span, .site-header .menu-icon-social .open .icon-bars-btn span"
  );
  kemet_css(
    "kemet-settings[header-icon-bars-bg-color]",
    "background-color",
    ".site-header .menu-icon-social .menu-icon"
  );
  kemet_css(
    "kemet-settings[header-icon-bars-bg-h-color]",
    "background-color",
    ".site-header .menu-icon-social .menu-icon:hover,.site-header .menu-icon-social .menu-icon.open"
  );
  kemet_css(
    "kemet-settings[logo-icon-separator-color]",
    "background-color",
    ".header-main-layout-8 .inline-logo-menu.vertical-separator .site-branding:after"
  );
  kemet_css(
    "kemet-settings[header-icon-label-color]",
    "color",
    ".menu-icon-social .header-icon-label"
  );
  kemet_css(
    "kemet-settings[header-icon-label-hover-color]",
    "color",
    ".menu-icon-social .header-icon-label:hover"
  );
  wp.customize("kemet-settings[header-separator-height]", function (setting) {
    setting.bind(function (height) {
      var dynamicStyle =
        ".header-main-layout-8 .inline-logo-menu.vertical-separator .site-branding:after { height: " +
        parseInt(height) +
        "px } ";
      kemet_add_dynamic_css("header-separator-height", dynamicStyle);
    });
  });
  wp.customize(
    "kemet-settings[header-icon-bars-border-radius]",
    function (setting) {
      setting.bind(function (border) {
        var dynamicStyle =
          ".site-header .menu-icon-social .menu-icon { border-radius: " +
          parseInt(border) +
          "px } ";
        kemet_add_dynamic_css("header-icon-bars-border-radius", dynamicStyle);
      });
    }
  );
  wp.customize("kemet-settings[mini-vheader-width]", function (setting) {
    setting.bind(function (width) {
      var dynamicStyle =
        ".header-main-layout-7 .main-header-bar-wrap { width: " +
        parseInt(width) +
        "px } .header-main-layout-7.kemet-main-v-header-align-right { padding-right: " +
        parseInt(width) +
        "px } .header-main-layout-7.kemet-main-v-header-align-left { padding-left: " +
        parseInt(width) +
        "px }";
      kemet_add_dynamic_css("mini-vheader-width", dynamicStyle);
    });
  });
  wp.customize("kemet-settings[vertical-header-width]", function (setting) {
    setting.bind(function (width) {
      var dynamicStyle =
        ".header-main-layout-5 .main-header-bar-wrap { width: " +
        parseInt(width) +
        "px } .header-main-layout-5.kemet-main-v-header-align-right { padding-right: " +
        parseInt(width) +
        "px } .header-main-layout-5.kemet-main-v-header-align-left { padding-left: " +
        parseInt(width) +
        "px }";
      kemet_add_dynamic_css("vertical-header-width", dynamicStyle);
    });
  });

  wp.customize("kemet-settings[header-icon-label]", function (setting) {
    setting.bind(function (label) {
      if ($(".menu-icon-social .header-icon-label").length > 0) {
        $(".menu-icon-social .header-icon-label").text(label);
      } else {
        var html = "";
        if ("" != label) {
          html = '<span class="header-icon-label">' + label + "</span>";
        }
        $(".menu-icon-social").prepend(html);
      }
    });
  });
  kemet_responsive_slider(
    "kemet-settings[header-main-sep]",
    ".kemet-main-v-header-align-right .main-header-bar-wrap",
    "border-left-width"
  );
  kemet_responsive_slider(
    "kemet-settings[header-main-sep]",
    ".kemet-main-v-header-align-left .main-header-bar-wrap",
    "border-right-width"
  );
  kemet_responsive_spacing(
    "kemet-settings[menu-icon-bars-space]",
    ".site-header .menu-icon-social",
    "margin",
    ["top", "right", "bottom", "left"]
  );
  kemet_css(
    "kemet-settings[vertical-menu-items-border-color]",
    "border-bottom-color",
    ".ss-content .main-header-menu .menu-item>a"
  );
})(jQuery);
