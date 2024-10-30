(function ($) {  /**
   * Image Width
   */
  wp.customize("kemet-settings[product-image-width]", function (setting) {
    setting.bind(function (width) {
      var dynamicStyle =
        "@media only screen and (min-width: 768px){ .woocommerce #content .kmt-woocommerce-container div.product div.images,.woocommerce .kmt-woocommerce-container div.product div.images { width: " +
        parseInt(width) +
        "% }";
      dynamicStyle +=
        ".woocommerce #content .kmt-woocommerce-container div.product div.images,.woocommerce .kmt-woocommerce-container div.product div.images { max-width: " +
        parseInt(width) +
        "% }";

      dynamicStyle +=
        ".woocommerce #content .kmt-woocommerce-container div.product div.summary,.woocommerce .kmt-woocommerce-container div.product div.summary { width: " +
        (parseInt(100 - width) - 3) +
        "% }";
      dynamicStyle +=
        ".woocommerce #content .kmt-woocommerce-container div.product div.summary,.woocommerce .kmt-woocommerce-container div.product div.summary { max-width: " +
        (parseInt(100 - width) - 3) +
        "% } }";

      kemet_add_dynamic_css("product-image-width", dynamicStyle);
    });
  });

  kemet_css(
    "kemet-settings[infinite-scroll-loader-color]",
    "background-color",
    ".kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader"
  );
  kemet_css(
    "kemet-settings[woo-infinite-text-color]",
    "color",
    ".kmt-woo-load-more .woo-load-more-text"
  );
  kemet_css(
    "kemet-settings[sale-text-color]",
    "color",
    ".woocommerce .product .onsale , .product .onsale"
  );
  kemet_css(
    "kemet-settings[sale-background-color]",
    "background-color",
    ".woocommerce .product .onsale , .product .onsale"
  );
})(jQuery);
