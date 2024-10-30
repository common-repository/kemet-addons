(function ($) {
  var Mode = "masonry";
  if ($(".blog-posts-container.blog-layout-2").hasClass("fit-rows")) {
    Mode = "fitRows";
  }
  $(".blog-posts-container.blog-layout-2").masonry({
    itemSelector: ".kmt-article-post",
    layoutMode: Mode,
  });

  /**
   * Infinite Scroll
   */
  var paginationStyle = kemet.blog_pagination_style,
    totalPages = parseInt(kemet.blog_infinite_total) || "",
    counter = parseInt(kemet.blog_infinite_count) || "",
    ajax_url = kemet.ajax_url || "",
    loadStatus = true,
    loader = $(".kmt-infinite-scroll-dots"),
    loadMore = $(".load-more-text"),
    noMoreMsg = $(".infinite-scroll-end-msg"),
    blog_infinite_nonce = kemet.blog_infinite_nonce || "";

  if (kemet.blog_load_more_style == 'button') {
    loader.hide();
  }
  if (typeof paginationStyle != "" && paginationStyle == "infinite-scroll") {
    var in_customizer = false;

    // check for wp.customize return boolean
    if (typeof wp !== "undefined") {
      in_customizer = typeof wp.customize !== "undefined" ? true : false;

      if (in_customizer) {
        return;
      }
    }

    if (kemet.blog_load_more_style == 'dots') {
      if ($("#main").find(".post:last").length > 0) {
        var windowHeight = $(window).outerHeight() / 2;
        $(window).scroll(function () {
          if (
            $(window).scrollTop() + windowHeight >=
            $("#main").find("article:last").offset().top
          ) {
            if (counter > totalPages) {
              return false;
            } else {
              if (loadStatus == true) {
                PostsLoader(counter);
                counter++;
                loadStatus = false;
              }
            }
          }
        });
      }
    } else {
      $(".load-more-text").click(function () {
        if (counter > totalPages) {
          return false;
        } else {
          if (loadStatus == true) {
            PostsLoader(counter);
            counter++;
          }
        }
      });
    }

    /**
     * Get Products via AJAX
     */
    function PostsLoader(pageNumber) {
      loader.show();
      loadMore.hide();
      var data = {
        action: "kemet_pagination_infinite",
        page_no: pageNumber,
        nonce: blog_infinite_nonce,
        query_vars: kemet.query_vars,
        kemet_infinite: "kemet_pagination_ajax",
      };

      $.post(ajax_url, data, function (data) {
        var posts = $(data),
          postContainer = $("#main > div > .blog-posts-container");
        loader.hide();
        loadMore.show();
        postContainer.append(posts);

        if (postContainer.hasClass("blog-layout-2")) {
          postContainer.masonry("appended", posts, true);

          postContainer.imagesLoaded(function () {
            postContainer.masonry("layout");
          });
          postContainer.trigger("masonryItemAdded");
        }

        //	Show no more msg
        if (counter > totalPages) {
          loadMore.hide();
          loader.hide();
          noMoreMsg.show();
        }
        loadStatus = true;
      });
    }
  }
})(jQuery);
