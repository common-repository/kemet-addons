(function($) {
  //   Social Icons Fields Dependency
  var socialIconsDependency = function() {
    var elementType = $(this).prop("nodeName");
    switch (elementType) {
      case "SELECT":
        var select = $(this);
        break;
      case "A":
        var select = $(this)
          .parents(".kfw-fields")
          .find(".social-icons-icons-style select");
        break;
    }

    var iconsStyle = select.val(),
      fieldParent = select.parents(".kfw-fields"),
      bgFields = fieldParent
        .find(".kfw-field-group")
        .find(".icon-bg-color , .icon-hover-bg-color"),
      borderFields = fieldParent
        .find(".kfw-field-group")
        .find(".icon-border-color , .icon-hover-border-color");

    switch (iconsStyle) {
      case "circle":
      case "square":
        bgFields.removeClass("hidden");
        borderFields.addClass("hidden");
        break;
      case "circle-outline":
      case "square-outline":
        borderFields.removeClass("hidden");
        bgFields.addClass("hidden");
        break;
      case "simple":
        borderFields.addClass("hidden");
        bgFields.addClass("hidden");
        break;
    }
  };

  $(document).on(
    "change",
    ".social-icons-icons-style select",
    socialIconsDependency
  );

  $(function() {
    $(".social-icons-icons-style")
      .find("select")
      .trigger("change");
    $(".kfw-cloneable-add").click(socialIconsDependency);
  });
})(jQuery);
