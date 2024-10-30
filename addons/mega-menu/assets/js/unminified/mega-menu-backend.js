(function($) {
  //Mega Menu Dependency
  var megaMenuDependency = function(show) {
    var subMenus = $(".menu-item-depth-1"),
      show = true;

    subMenus.each(function(index, val) {
      var $this = $(this),
        parentItem = $this.prevAll(".menu-item-depth-0"),
        parentItemID = parentItem.attr("id"),
        megaMenu = $("#" + parentItemID).find(
          ".enable-mega-menu .kfw--switcher"
        );

      if (megaMenu.hasClass("kfw--active")) {
        $this
          .find(
            ".kfw-nav-menu-options .enable-template , .kfw-nav-menu-options .column-heading , .kfw-nav-menu-options .disable-item-label , .kfw-nav-menu-options .mega-menu-field-template"
          )
          .show();
      } else {
        $this
          .find(
            ".kfw-nav-menu-options .enable-template , .kfw-nav-menu-options .column-heading , .kfw-nav-menu-options .disable-item-label , .kfw-nav-menu-options .mega-menu-field-template"
          )
          .hide();
      }
    });
  };

  megaMenuDependency();

  var enableMegaMenu = $(".enable-mega-menu").find("input");

  enableMegaMenu.on("change input", function() {
    megaMenuDependency();
  });

  /**
   * set meta value to select
   */
  var oldMetaValues = kemetAddons.template_meta_value;

  if (typeof oldMetaValues == "object" && oldMetaValues != null) {
    $.each(oldMetaValues, function(id, value) {
      var menuItem = $("#menu-item-" + id),
        templateSelect = menuItem.find(".mega-menu-field-template select"),
        postID = value;

      $.post(kemetAddons.ajax_url, {
        post_id: postID,
        action: "kemet_get_post_title",
        nonce: kemetAddons.ajax_title_nonce
      }).done(function(data) {
        templateSelect.append(new Option(data, postID, false, true));
      });
    });
  }

  /**
   * convert to select2 with ajax search
   * @param {string} selector
   */
  var convertToSelect2 = function(selector) {
    if ($(selector).hasClass("select2-hidden-accessible")) {
      return;
    }
    if ($(selector).val() == "") {
      $(selector).html("");
    }

    $(selector).select2({
      placeholder: kemetAddons.search,

      ajax: {
        url: kemetAddons.ajax_url,
        dataType: "json",
        method: "post",
        delay: 250,
        data: function(params) {
          return {
            query: params.term, // search term
            page: params.page,
            action: "kemet_ajax_get_posts_list",
            nonce: kemetAddons.ajax_nonce
          };
        },
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      minimumInputLength: 2,
      language: kemetAddons.lang,
      width: "100%"
    });
  };

  var specificSelect = $(".mega-menu-field-template").find("select");
  specificSelect.each(function(index, selector) {
    convertToSelect2(selector);
  });

  $(document).ajaxComplete(function() {
    var specificSelect = $(".mega-menu-field-template").find("select");
    specificSelect.each(function(index, selector) {
      convertToSelect2(selector);
    });
  });
})(jQuery);
