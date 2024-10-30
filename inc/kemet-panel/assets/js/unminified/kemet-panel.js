(function ($) {
  var kemetPanel = {
    init: function () {
      $(window).on("hashchange", kemetPanel.tabs);
      $(window).on("ready", kemetPanel.tabs());
      $(document).on("click", ".kemet-save-ajax", kemetPanel.saveOptions);
      $(document).on("click", ".kemet-reset-options", kemetPanel.resetOptions);
      $(document).on("click", ".kmt-plugin", kemetPanel.plugin);
      $(document).on(
        "click",
        ".kemet-enable-all-options",
        kemetPanel.enableAllOptions
      );
      $(document).on(
        "click",
        ".kemet-disable-all-options",
        kemetPanel.disableAllOptions
      );
      $(document).on("click", ".kfw--switcher", kemetPanel.switcher);
      $(document).on("ready", kemetPanel.stickyFooter());
      $(window).on("scroll", kemetPanel.stickyFooter);
      $(window).on("kemet-tab-changed", kemetPanel.stickyFooter);
    },
    plugin: function () {
      var pluginBtn = $(this),
        status = pluginBtn.data("status");
      $(this).addClass("updating-message");
      switch (status) {
        case "install":
          var requestUrl = pluginBtn.data("url-install"),
            text = "Installin";
          break;
        case "activate":
          var requestUrl = pluginBtn.data("url-activate"),
            text = "Activating";
          break;
        case "deactivate":
          var requestUrl = pluginBtn.data("url-deactivate"),
            text = "Deactivating";
          break;
      }
      $.ajax({
        url: requestUrl,
        type: "GET",
        beforeSend: function () {
          pluginBtn.text(text);
        },
      }).done(function (result) {
        if (status == "install") {
          $.ajax({
            url: pluginBtn.data("url-activate"),
            type: "GET",
            beforeSend: function () {
              pluginBtn.text("Activating");
            },
          }).done(function (result) {
            window.location.reload();
          });
        } else {
          window.location.reload();
        }
      });
    },
    tabs: function () {
      var hash = window.location.hash.match(new RegExp("tab=([^&]*)"));
      if (hash != null) {
        tabItem = $("." + hash[1] + "-tab");
        tab = $("#" + hash[1]);
      } else {
        tabItem = $(".kemet-panel-tabs").find("li:first-child");
        tab = $(".kemet-panel-tabs-content > div:first-child");
      }
      tabItem.addClass("active").siblings().removeClass("active");
      tab.addClass("active").siblings().removeClass("active");
      $(document).trigger("kemet-tab-changed", tab);
    },
    switcher: function () {
      var input = $(this).find("input"),
        newValue = input.val() == 0 ? 1 : 0;
      $(this).toggleClass("kfw--active");
      input.val(newValue);
      input.trigger("change");
    },
    saveOptions: function () {
      if ($(this).hasClass("updating-message")) {
        return;
      }
      var saveBtn = $(this),
        class_name = saveBtn.data("class"),
        tabID = saveBtn.data("id"),
        options = $("#" + tabID + " input"),
        optionsArray = {};
      $(this).addClass("updating-message");
      $.each(options, function () {
        var input = $(this),
          optionID = input.data("depend-id");
        optionsArray[optionID] = input.val();
      });
      $.ajax({
        url: window.ajaxurl,
        type: "POST",
        data: {
          action: "kemet-panel-save-options",
          class: class_name,
          options: optionsArray,
          nonce: kemetPanelVars.nonce,
        },
      }).done(function (response) {
        if (response.success) {
          window.location.reload();
        }
      });
    },
    resetOptions: function () {
      if ($(this).hasClass("updating-message")) {
        return;
      }
      var saveBtn = $(this),
        class_name = saveBtn.data("class");
      $(this).addClass("updating-message");
      $.ajax({
        url: window.ajaxurl,
        type: "POST",
        data: {
          action: "kemet-panel-reset-options",
          class: class_name,
          nonce: kemetPanelVars.nonce,
        },
      }).done(function (response) {
        if (response.success) {
          window.location.reload();
        }
      });
    },
    enableAllOptions: function () {
      if ($(this).hasClass("updating-message")) {
        return;
      }
      var saveBtn = $(this),
        class_name = saveBtn.data("class"),
        tabID = saveBtn.data("id"),
        options = $("#" + tabID + " .kfw--switcher input"),
        optionsArray = {};
      $(this).addClass("updating-message");
      $.each(options, function () {
        var input = $(this),
          optionID = input.data("depend-id");
        optionsArray[optionID] = 1;
      });
      $.ajax({
        url: window.ajaxurl,
        type: "POST",
        data: {
          action: "kemet-panel-enable-all",
          class: class_name,
          options: optionsArray,
          nonce: kemetPanelVars.nonce,
        },
      }).done(function (response) {
        if (response.success) {
          saveBtn.removeClass("updating-message");
          var switchers = $(".kfw--switcher");
          $.each(switchers, function () {
            var $this = $(this);
            $this.addClass("kfw--active");
            $this.find("input").val(1);
            $this.find("input").trigger("input");
          });
        }
      });
    },
    disableAllOptions: function () {
      if ($(this).hasClass("updating-message")) {
        return;
      }
      var saveBtn = $(this),
        class_name = saveBtn.data("class"),
        tabID = saveBtn.data("id"),
        options = $("#" + tabID + " .kfw--switcher input"),
        optionsArray = {};
      $(this).addClass("updating-message");
      $.each(options, function () {
        var input = $(this),
          optionID = input.data("depend-id");
        optionsArray[optionID] = 0;
      });
      $.ajax({
        url: window.ajaxurl,
        type: "POST",
        data: {
          action: "kemet-panel-disable-all",
          class: class_name,
          options: optionsArray,
          nonce: kemetPanelVars.nonce,
        },
      }).done(function (response) {
        if (response.success) {
          saveBtn.removeClass("updating-message");
          var switchers = $(".kfw--switcher");
          $.each(switchers, function () {
            var $this = $(this);
            $this.removeClass("kfw--active");
            $this.find("input").val(0);
            $this.find("input").trigger("input");
          });
        }
      });
    },
    stickyFooter: function () {
      var footer = $(document).find(".kemet-panel-footer");
      $.each(footer, function () {
        var $this = $(this),
          $inner = $this.find(".kemet-panel-footer-inner"),
          padding =
            parseInt($inner.css("padding-left")) +
            parseInt($inner.css("padding-right")),
          scrollBottom = $(window).scrollTop() + $(window).height(),
          offsetBottom = $this.offset().top,
          stickyBottom = offsetBottom - scrollBottom,
          winWidth = Math.max(
            document.documentElement.clientWidth,
            window.innerWidth || 0
          );
        if (stickyBottom >= 0 && winWidth > 782) {
          $inner.css({ width: $this.outerWidth() - padding });
          $this.css({ height: $this.outerHeight() }).addClass("kemet-sticky");
        } else {
          $inner.removeAttr("style");
          $this.removeAttr("style").removeClass("kemet-sticky");
        }
      });
    },
  };
  $(document).ready(function () {
    kemetPanel.init();
  });
})(jQuery, window, document);
