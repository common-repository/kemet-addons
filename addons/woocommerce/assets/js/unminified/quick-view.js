(function ($) {
  if (typeof kemet === "undefined") {
    return false;
  }
  KmtQuickView = {
    init: function () {
      this.bind();
      this.quickViewStyle();
    },
    bind: function () {
      // Open Quick View.
      $(document)
        .off(
          "click",
          ".kmt-quick-view , .kmt-qv-on-list , .kmt-qv-on-image, .kmt-qv-icon, .kmt-quickview-icon"
        )
        .on(
          "click",
          ".kmt-quick-view, .kmt-qv-on-list , .kmt-qv-on-image , .kmt-qv-icon, .kmt-quickview-icon",
          KmtQuickView.openModel
        );
      // Close Quick View.
      $(document)
        .off("click", ".kmt-qv-close , .kmt-close-qv")
        .on("click", ".kmt-qv-close , .kmt-close-qv", KmtQuickView.closeModel);
      $(document).on("keyup", KmtQuickView.EscKeypress);
      $(document).on("kemet-quick-view-loaded", KmtQuickView.resizeModel);
    },
    quickViewStyle: function () {
      $("#kmt-qv-content").css({
        "max-width": parseFloat($(window).width()) - 150,
        "max-height": parseFloat($(window).height()) - 150,
      });
    },
    openModel: function (e) {
      e.preventDefault();

      var control = this,
        quickBtn = $(this),
        productId = quickBtn.data("product_id"),
        modal = $("#kmt-qv-wrap"),
        overlay = $(".kmt-qv-overlay"),
        content = $("#kmt-qv-content");

      overlay.addClass("visible");
      overlay.addClass("loading");
      $.ajax({
        url: kemet.ajax_url,
        type: "POST",
        dataType: "html",
        data: {
          action: "kemet_load_quick_view",
          product_id: productId,
        },
      }).done(function (results) {
        var innerWidth = $("html").innerWidth();
        $("html").css("overflow", "hidden");
        var hiddenInnerWidth = $("html").innerWidth();
        $("html").css("margin-right", hiddenInnerWidth - innerWidth);
        $("html").addClass("kmt-qv-open");

        content.html(results);
        // Display modal
        modal.fadeIn();
        modal.addClass("is-visible");

        var imageSlider = content.find(".kmt-qv-image"),
          formVariation = content.find(".variations_form");

        // Initialize variable form.
        if (formVariation.length > 0) {
          formVariation.trigger("check_variations");
          formVariation.trigger("reset_image");
          formVariation.wc_variation_form();
          formVariation.find("select").change();
        }
        if (imageSlider.find("li").length > 1) {
          imageSlider.flexslider();
        }
        overlay.removeClass("loading");
        setTimeout(function () {
          $(document).trigger("kemet-quick-view-loaded");
        }, 100);
      });
    },
    resizeModel: function () {
      var sliderHeight = window.matchMedia("(max-width: 767px)").matches
        ? "auto"
        : parseFloat(
            $("#kmt-qv-content .images")
              .find(".woocommerce-product-gallery__image")
              .outerHeight()
          );

      var containerHeight = window.matchMedia("(max-width: 767px)").matches
        ? "auto"
        : parseFloat($("#kmt-qv-content").outerHeight());

      $("#kmt-qv-content").removeAttr("style");
      if (sliderHeight > 0) {
        $("#kmt-qv-content .entry-summary , #kmt-qv-content").css({
          "max-height": sliderHeight,
        });
      } else {
        $("#kmt-qv-content .entry-summary, #kmt-qv-content").css({
          "max-height": containerHeight,
        });
      }
    },
    closeModel: function (e) {
      e.preventDefault();

      var modal = $("#kmt-qv-wrap"),
        overlay = $(".kmt-qv-overlay"),
        content = $("#kmt-qv-content");

      $("html").css({
        overflow: "",
        "margin-right": "",
      });
      $("html").removeClass("kmt-qv-open");

      modal.fadeOut();
      modal.removeClass("is-visible");
      overlay.removeClass("visible");

      setTimeout(function () {
        content.html("");
      }, 600);
    },
    EscKeypress: function (e) {
      e.preventDefault();
      if (e.keyCode === 27) {
        KmtQuickView.closeModel(e);
      }
    },
  };

  /**
   * Initialization
   */
  $(function () {
    KmtQuickView.init();
  });
})(jQuery);
