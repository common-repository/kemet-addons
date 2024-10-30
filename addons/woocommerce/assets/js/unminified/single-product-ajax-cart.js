(function ($) {
  if (typeof kemet === "undefined") {
    return false;
  }
  KmtSingleProductAjax = {
    init: function () {
      this._bind();
    },
    _bind: function () {
      $(document.body).on(
        "click",
        "#kmt-qv-content .product:not(.product-type-external) button.single_add_to_cart_button",
        KmtSingleProductAjax._addToCartRequest
      );
      if (kemet.single_ajax_add_to_cart) {
        $(document).on(
          "click",
          "body.single-product .product:not(.product-type-external) button.single_add_to_cart_button",
          KmtSingleProductAjax._addToCartRequest
        );
      }
      $(document.body).on("added_to_cart", KmtSingleProductAjax._updateButton);
    },
    _addToCartRequest: function (e) {
      e.preventDefault();

      var form = $(this).closest("form");

      if (!form[0].checkValidity()) {
        form[0].reportValidity();
        return false;
      }

      var button = $(this),
        productId = $(this).val();

      if (button.hasClass("disabled")) {
        return;
      }

      button.removeClass("added");
      button.addClass("loading");

      // Set Quantity.
      //
      // For grouped product quantity should be array instead of single value
      // For that set the quantity as array for grouped product.
      var quantity = $('input[name="quantity"]').val();
      if ($(".woocommerce-grouped-product-list-item").length) {
        var quantities = $("input.qty"),
          quantity = [];

        $.each(quantities, function (index, val) {
          var name = $(this).attr("name");

          name = name.replace("quantity[", "");
          name = name.replace("]", "");
          name = parseInt(name);

          if ($(this).val()) {
            quantity[name] = $(this).val();
          }
        });
      }
      // Process the AJAX
      var cartFormData = $("form.cart").serialize();

      $.ajax({
        url: kemet.ajax_url,
        type: "POST",
        data:
          "action=kemet_add_cart_single_product&add-to-cart=" +
          productId +
          "&" +
          cartFormData,
        success: function (results) {
          // Trigger event so themes can refresh other areas.
          $(document.body).trigger("wc_fragment_refresh");
          $(document.body).trigger("added_to_cart", [
            results.fragments,
            results.cart_hash,
            button,
          ]);

          // Redirect to cart option
          if (wc_add_to_cart_params.cart_redirect_after_add === "yes") {
            window.location = wc_add_to_cart_params.cart_url;
            return;
          }
        },
      });
    },
    /**
     * Update cart page elements after add to cart events.
     */
    _updateButton: function (e, fragments, cart_hash, button) {
      button = typeof button === "undefined" ? false : button;

      if ($("button.single_add_to_cart_button").length) {
        $(button).removeClass("loading");
        $(button).addClass("added");

        // View cart text.
        if (
          !kemet.is_cart &&
          $(button).parent().find(".added_to_cart").length === 0
        ) {
          $(button).after(
            ' <a href="' +
              kemet.cart_url +
              '" class="added_to_cart wc-forward" title="' +
              kemet.view_cart +
              '">' +
              kemet.view_cart +
              "</a>"
          );
        }

        $(document.body).trigger("wc_cart_button_updated", [button]);
      }
    },
  };
  /**
   * Initialization
   */
  $(function () {
    KmtSingleProductAjax.init();
  });
})(jQuery);
