(function ($) {
  //Header Merged With Page Title
  var header = $("header");
  if (header.hasClass("kmt-header-transparent")) {
    header.parent().addClass("overlay");
  }
  //Header 5
  $(".header-main-layout-4 .menu-icon-social").on("click", function () {
    var header_5 = $(".header-main-layout-4 .kmt-navbar-collapse");
    $(this).children(".menu-icon").toggleClass("open");
    header_5.slideToggle("300");
  });

  //Header 8
  $(".header-main-layout-7 .menu-icon-social").click(function () {
    if ($(this).children(".menu-icon").hasClass("open")) {
      $(".header-main-layout-7 .main-header-bar-wrap").removeClass(
        "side-header"
      );
      $(".header-main-layout-7 .menu-icon-social .menu-icon").removeClass(
        "open"
      );
    } else {
      $(".header-main-layout-7 .main-header-bar-wrap").addClass("side-header");
      $(".header-main-layout-7 .menu-icon-social .menu-icon").addClass("open");
    }
  });

  var animation = "";
  $(".header-main-layout-7 .main-header-bar-wrap").mouseleave(function () {
    animation = setTimeout(function () {
      $(".header-main-layout-7 .main-header-bar-wrap").removeClass(
        "side-header"
      );
      $(".header-main-layout-7 .menu-icon-social .menu-icon").removeClass(
        "open"
      );
    }, 2000);
  });
  $(".header-main-layout-7 .main-header-bar-wrap").mouseenter(function () {
    clearTimeout(animation);
  });

  //Header 7
  var header6Icon = $(".header-main-layout-6 .menu-icon-social");
  if ($("body").hasClass("admin-bar")) {
    var iconMargin = header6Icon.css("marginTop"),
      iconMargin = parseInt(iconMargin) + 32;
    header6Icon.css("margin-top", iconMargin + "px");
  }
  $(".header-main-layout-6 .menu-icon-social").click(function () {
    if ($(this).children(".menu-icon").hasClass("open")) {
      $(".header-main-layout-6 .main-header-bar").removeClass("side-header");
      $(".header-main-layout-6 .menu-icon-social .menu-icon").removeClass(
        "open"
      );
    } else {
      $(".header-main-layout-6 .main-header-bar").addClass("side-header");
      $(".header-main-layout-6 .menu-icon-social .menu-icon").addClass("open");
    }
  });

  var header7Animation = "";
  $(".header-main-layout-6 .main-header-bar").mouseleave(function () {
    if ($(this).hasClass("side-header")) {
      header7Animation = setTimeout(function () {
        $(".header-main-layout-6 .main-header-bar").removeClass("side-header");
        $(".header-main-layout-6 .menu-icon-social .menu-icon").removeClass(
          "open"
        );
      }, 2000);
    }
  });
  $(
    ".header-main-layout-6 .main-header-bar , .header-main-layout-6 .menu-icon-social"
  ).mouseenter(function () {
    clearTimeout(header7Animation);
  });
  var logoPostion = function () {
    if (
      $("body").hasClass("kmt-header-break-point") &&
      $("header").hasClass("header-main-layout-6")
    ) {
      $(".main-header-container").prepend($(".site-branding"));
    } else if (
      $("body").hasClass("kmt-header-break-point") != true &&
      $("header").hasClass("header-main-layout-6")
    ) {
      $(".main-header-bar-wrap").prepend($(".site-branding"));
    }
  };
  window.addEventListener("resize", function () {
    logoPostion();
  });
  logoPostion();

  //Header 9
  $(".header-main-layout-8 .menu-icon-social .menu-icon").click(function () {
    $(".header-main-layout-8 .main-header-container").toggleClass(
      "side-header"
    );
    $(this).toggleClass("open");
  });
  var header8 = $(".header-main-layout-8"),
    siteBrand = header8.find(".site-branding"),
    wrapDiv = header8.find(".outside-menu-mobile-icon-wrap");

  moveWrap();

  if (header8.length > 0) {
    window.addEventListener("resize", function () {
      moveWrap();
    });
  }

  function moveWrap() {
    if ($("body").hasClass("kmt-header-break-point")) {
      siteBrand.after(wrapDiv);
    } else {
      $(".menu-icon-header-8").after(wrapDiv);
    }
  }

  var $stickFooter = $(".sticky-footer"),
    $header5 = $("header.header-main-layout-5"),
    $header7 = $("header.header-main-layout-7");

  if (
    ($stickFooter.length > 0 && $header5.length > 0) ||
    ($stickFooter.length > 0 && $header7.length > 0)
  ) {
    var $body = $("body"),
      $header_left = $(".kemet-main-v-header-align-left"),
      $header_right = $(".kemet-main-v-header-align-right");

    if ($header_left.length > 0) {
      var paddingLeft = $body.css("padding-left");

      $stickFooter.css("padding-left", paddingLeft);
    } else if ($header_right.length > 0) {
      var paddingRight = $body.css("padding-right");

      $stickFooter.css("padding-right", paddingRight);
    }
  }
})(jQuery);
