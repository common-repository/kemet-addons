(function ($) {
  wp.customize("kemet-settings[widget-border-color]", function (setting) {
    setting.bind(function (color) {
      if (color == "") {
        wp.customize.preview.send("refresh");
      } else {
        var dynamicStyle =
          ".kmt-widget-style3 .widget-content,.kmt-widget-style6 div.title .widget-title,.kmt-widget-style6 div.title .widget-title:before, .kmt-widget-style8 .widget-title { border-bottom-color: " +
          color +
          " } ";
        dynamicStyle +=
          ".kmt-widget-style3 .widget-content , .kmt-widget-style5.widget , .kmt-widget-style9 .widget-title { border-color: " +
          color +
          " } ";
        dynamicStyle +=
          ".kmt-widget-style7 div.title .widget-title:after { background-color: " +
          color +
          " } ";
        kemet_add_dynamic_css("widget-border-color", dynamicStyle);
      }
    });
  });
  wp.customize("kemet-settings[widget-style-bg-color]", function (setting) {
    setting.bind(function (color) {
      if (color == "") {
        wp.customize.preview.send("refresh");
      } else {
        var dynamicStyle =
          ".kmt-widget-style2 .widget-title ,.kmt-widget-style4 .widget-head { background-color: " +
          color +
          " } ";
        kemet_add_dynamic_css("widget-style-bg-color", dynamicStyle);
      }
    });
  });
  wp.customize(
    "kemet-settings[footer-widget-border-color]",
    function (setting) {
      setting.bind(function (color) {
        if (color == "") {
          wp.customize.preview.send("refresh");
        } else {
          var dynamicStyle =
            ".kemet-footer .kmt-widget-style3 .widget-content,.kemet-footer .kmt-widget-style6 div.title .widget-title,.kemet-footer .kmt-widget-style6 div.title .widget-title:before  ,.kmt-footer-copyright .kmt-widget-style3 .widget-content,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title:before, .kemet-footer .kmt-widget-style8 .widget-title { border-bottom-color: " +
            color +
            " } ";
          dynamicStyle +=
            ".kemet-footer .kmt-widget-style3 .widget-content ,.kemet-footer .kmt-widget-style5.widget , .kmt-footer-copyright .kmt-widget-style3 .widget-content ,.kmt-footer-copyright .kmt-widget-style5.widget, .kemet-footer .kmt-widget-style9 .widget-title { border-color: " +
            color +
            " } ";
          dynamicStyle +=
            ".kemet-footer .kmt-widget-style7 div.title .widget-title:after ,.kmt-footer-copyright .kmt-widget-style7 div.title .widget-title:after { background-color: " +
            color +
            " } ";
          kemet_add_dynamic_css("footer-widget-border-color", dynamicStyle);
        }
      });
    }
  );
  wp.customize(
    "kemet-settings[footer-widget-title-bg-color]",
    function (setting) {
      setting.bind(function (color) {
        if (color == "") {
          wp.customize.preview.send("refresh");
        } else {
          var dynamicStyle =
            ".kemet-footer .kmt-widget-style2 .widget-title ,.kemet-footer .kmt-widget-style4 .widget-head ,  .kmt-footer-copyright .kmt-widget-style2 .widget-title ,.kmt-footer-copyright .kmt-widget-style4 .widget-head { background-color: " +
            color +
            " } ";
          kemet_add_dynamic_css("footer-widget-title-bg-color", dynamicStyle);
        }
      });
    }
  );
})(jQuery);
