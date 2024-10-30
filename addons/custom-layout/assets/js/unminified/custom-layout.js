(function($) {
  /**
   * Set options Descriptions
   */
  var descriptions = kemetAddons.hooks_descriptions,
    hooksSelect = $(".kmt-hooks-select .kfw-fieldset select"),
    hookValue = hooksSelect.val(),
    descriptionDiv = $(".kmt-hooks-select .kfw-text-desc");

  if (
    descriptions[hookValue] != "" &&
    typeof descriptions[hookValue] != "undefined"
  ) {
    descriptionDiv.html(
      "Action to add your content or snippet " + descriptions[hookValue] + "."
    );
  }
  hooksSelect.change(function() {
    var $this = $(this),
      value = $this.val(),
      desc = descriptions[value];

    if (
      descriptions[value] != "" &&
      typeof descriptions[value] != "undefined"
    ) {
      descriptionDiv.html(
        "Action to add your content or snippet " + desc + "."
      );
    } else {
      descriptionDiv.html("");
    }
  });

  /**
   * set meta value to select
   * @param {string} selector
   * @param {array} values
   */

  var setValues = function(selector, values) {
    $.each(values, function(index, post_id) {
      var specificSelect = selector;
      postID = post_id.toString();

      if (postID.includes(",")) {
        var idsObj = postID.split(",");

        $.each(idsObj, function(x, id) {
          $.post(kemetAddons.ajax_url, {
            post_id: id,
            action: "kemet_get_post_title",
            nonce: kemetAddons.ajax_title_nonce
          }).done(function(data) {
            specificSelect.append(new Option(data, id, false, true));
          });
        });
      } else {
        $.post(kemetAddons.ajax_url, {
          post_id: postID,
          action: "kemet_get_post_title",
          nonce: kemetAddons.ajax_title_nonce
        }).done(function(data) {
          specificSelect.append(new Option(data, postID, false, true));
        });
      }
    });
  };

  var displayOldValues =
      kemetAddons.display_old_value != "" ? kemetAddons.display_old_value : "",
    hideOldValues =
      kemetAddons.hide_old_value != "" ? kemetAddons.hide_old_value : "";

  if (typeof displayOldValues == "object" && displayOldValues != null) {
    var displaySelector = $(".kmt-display-on-specifics-select").find("select");
    setValues(displaySelector, displayOldValues);
  }

  if (typeof hideOldValues == "object" && hideOldValues != null) {
    var hideSelector = $(".kmt-hide-on-specifics-select").find("select");
    setValues(hideSelector, hideOldValues);
  }

  /**
   * convert to select2 with ajax search
   * @param {string} selector
   */
  var convertToSelect2 = function(selector) {
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

  var specificSelect = $(
    ".kmt-hide-on-specifics-select , .kmt-display-on-specifics-select"
  ).find("select");
  specificSelect.each(function(index, selector) {
    convertToSelect2(selector);
  });

  var displaySelects = $(".display-on-rule , .hide-on-rule").find("select");
  displaySelects.select2({
    width: "100%"
  });

  displaySelects.each(function(index, selector) {
    var value = $(this).val(),
      ID = $(this).attr("data-depend-id");

    if (value != null && value.includes("specifics-location")) {
      switch (ID) {
        case "display-on-rule":
          $(".kmt-display-on-specifics-select").css("display", "block");
          break;
        case "hide-on-rule":
          $(".kmt-hide-on-specifics-select").css("display", "block");
          break;
      }
    } else {
      switch (ID) {
        case "display-on-rule":
          $(".kmt-display-on-specifics-select").css("display", "none");
          break;
        case "hide-on-rule":
          $(".kmt-hide-on-specifics-select").css("display", "none");
          break;
      }
    }
  });

  displaySelects.change(function() {
    var value = $(this).val(),
      ID = $(this).attr("data-depend-id");

    if (value != null && value.includes("specifics-location")) {
      switch (ID) {
        case "display-on-rule":
          $(".kmt-display-on-specifics-select").css("display", "block");
          break;
        case "hide-on-rule":
          $(".kmt-hide-on-specifics-select").css("display", "block");
          break;
      }
    } else {
      switch (ID) {
        case "display-on-rule":
          $(".kmt-display-on-specifics-select").css("display", "none");
          break;
        case "hide-on-rule":
          $(".kmt-hide-on-specifics-select").css("display", "none");
          break;
      }
    }
  });
  $(".kmt-user-rules")
    .find("select")
    .select2({
      width: "100%"
    });
  /**
   * Enable Code Editor
   */
  var codeEditorSwitcher = $(".enable-code-editor").find("input"),
    kemetMeta = $("#kemet_code_editor");

  var setSwitcherValue = function() {
    var url = window.location.href;

    if (
      url.indexOf("&code_editor") > -1 ||
      (codeEditorSwitcher.val() == 1 && url.indexOf("&wordpress_editor") == -1)
    ) {
      codeEditorSwitcher.parent().addClass("kfw--active");
      $("body").addClass("kemet-code-editor");
      codeEditorSwitcher.val(1);
    } else if (
      url.indexOf("&wordpress_editor") > -1 ||
      codeEditorSwitcher.val() == 0 ||
      url.indexOf("&code_editor") == -1
    ) {
      if ($("body").hasClass("kemet-code-editor")) {
        $("body").removeClass("kemet-code-editor");
      }
      codeEditorSwitcher.parent().removeClass("kfw--active");
      codeEditorSwitcher.val(0);
    } else {
      codeEditorSwitcher.val(0);
    }
  };
  setSwitcherValue();
  codeEditorSwitcher.change(function() {
    var value = $(this).val(),
      url = window.location.href;

    if (value == 1) {
      if (url.indexOf("&wordpress_editor") > -1) {
        url = url.replace("&wordpress_editor", "");
      }
      window.location.replace(url + "&code_editor");
    } else {
      if (url.indexOf("&code_editor") > -1) {
        url = url.replace("&code_editor", "");
      }

      url = url + "&wordpress_editor";

      window.location.replace(url);
    }
  });
})(jQuery);
