(function ($) {
  // Mega menu in principal menu
  var kemetMegMenu = function () {
    $(
      "body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item"
    ).hover(
      function () {
        if (window.innerWidth <= kemet.break_point) {
					return;
				}
        var headerContainer = $("header .main-header-bar .kmt-container"),
          headerWrap = headerContainer.parents(".main-header-bar"),
          containerWidth = $(this).parent(),
          Position = headerContainer.offset(),
          menuWidth = headerContainer.outerWidth();

        if ($(this).hasClass("mega-menu-full-width")) {
          menuWrapWidth = headerWrap.outerWidth();
          wrapPosition = headerWrap.offset();
        } else if ($(this).hasClass("mega-menu-container-width")) {
          menuWidth = containerWidth.width();
          Position = containerWidth.offset();
        }

        var menuItemPosition = $(this).offset(),
          positionLeft = menuItemPosition.left - Position.left,
          positionLeft =
            positionLeft < 0
              ? Math.abs(positionLeft) + "px"
              : "-" + positionLeft + "px";
        if (!$(this).hasClass("mega-menu-full-width")) {
          $(this)
            .find(".kemet-megamenu")
            .css({ left: positionLeft, width: menuWidth });
        } else {
          $(this).find(".kemet-megamenu").css({ width: menuWidth });

          var megaMenuWrap = $(this).find(".mega-menu-full-wrap"),
            menuItemPosition = $(this).offset(),
            positionLeft = menuItemPosition.left - wrapPosition.left,
            positionLeft =
              positionLeft < 0
                ? Math.abs(positionLeft) + "px"
                : "-" + positionLeft + "px";
          megaMenuWrap.css({
            left: positionLeft,
            width: menuWrapWidth,
          });
        }
      },
      function () {
        if (window.innerWidth <= kemet.break_point) {
					return;
				}
        if (!$(this).hasClass("mega-menu-full-width")) {
          $(this)
            .find(".kemet-megamenu")
            .css({ left: "-" + 999 + "em" });
        } else {
          $(this)
            .find(".mega-menu-full-wrap")
            .css({ left: "-" + 999 + "em" });
        }
      }
    );
  };
  //RTL Mega Menu
  var kemetRtlMegMenu = function () {
    $(
      "body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item"
    ).hover(
      function () {
        if (window.innerWidth <= kemet.break_point) {
					return;
				}
        var headerContainer = $("header .main-header-bar .kmt-container"),
          headerWrap = headerContainer.parents(".main-header-bar"),
          containerWidth = $(this).parent(),
          menuWidth = headerContainer.outerWidth(),
          Position = headerContainer.offset().left + menuWidth;

        if ($(this).hasClass("mega-menu-full-width")) {
          menuWrapWidth = headerWrap.outerWidth();
          wrapPosition = headerWrap.offset().left + menuWrapWidth;
        } else if ($(this).hasClass("mega-menu-container-width")) {
          menuWidth = containerWidth.width();
          Position = containerWidth.offset().left + menuWidth;
        }

        var menuItemPosition = $(this).offset().left + $(this).outerWidth(),
          positionRight = menuItemPosition - Position,
          positionRight =
            positionRight < 0
              ? "-" + Math.abs(positionRight) + "px"
              : positionRight + "px";
        if (!$(this).hasClass("mega-menu-full-width")) {
          $(this)
            .find(".kemet-megamenu")
            .css({ right: positionRight, width: menuWidth });
        } else {
          $(this).find(".kemet-megamenu").css({ width: menuWidth });

          var megaMenuWrap = $(this).find(".mega-menu-full-wrap"),
            menuItemPosition = $(this).offset().left + $(this).outerWidth(),
            positionRight = menuItemPosition - wrapPosition,
            positionRight =
              positionRight < 0
                ? "-" + Math.abs(positionRight) + "px"
                : positionRight + "px";
          megaMenuWrap.css({
            right: positionRight,
            width: menuWrapWidth,
          });
        }
      },
      function () {
        if (window.innerWidth <= kemet.break_point) {
					return;
				}
        if (!$(this).hasClass("mega-menu-full-width")) {
          $(this)
            .find(".kemet-megamenu")
            .css({ right: "-" + 999 + "em" });
        } else {
          $(this)
            .find(".mega-menu-full-wrap")
            .css({ right: "-" + 999 + "em" });
        }
      }
    );
  };

  if ($("body").hasClass("rtl")) {
    if (
      !$("header").is(
        ".header-main-layout-5 , .header-main-layout-6 , .header-main-layout-7"
      )
    ) {
      kemetRtlMegMenu();
    }
  } else {
    if (
      !$("header").is(
        ".header-main-layout-5 , .header-main-layout-6 , .header-main-layout-7"
      )
    ) {
      kemetMegMenu();
    }
  }
  $(window).resize(function () {
		if (window.innerWidth <= kemet.break_point) {
			$("#site-navigation .kemet-megamenu-item")
				.find(".kemet-megamenu").removeAttr('style').css({ width: "100%" });
			$("#site-navigation .kemet-megamenu-item").find(".kemet-megamenu").removeAttr('style').css({ width: "100%" });
			$("#site-navigation .kemet-megamenu-item").find(".mega-menu-full-wrap").removeAttr('style').css({
				width: "100%",
			});
		} else {
			if ($("body").is("rtl")) {
				if (
					!$("header").is(
						".header-main-layout-5 , .header-main-layout-6 , .header-main-layout-7"
					)
				) {
					kemetRtlMegMenu();
				}
			} else {
				if (
					!$("header").is(
						".header-main-layout-5 , .header-main-layout-6 , .header-main-layout-7"
					)
				) {
					kemetMegMenu();
				}
			}
		}
	});
})(jQuery);
