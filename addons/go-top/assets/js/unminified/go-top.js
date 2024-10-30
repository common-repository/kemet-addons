window.onload = function () {
  var goTop = document.getElementById("kmt-go-top"),
    time = 0;
  if (void 0 !== goTop && null != goTop) {
    function scrollTop() {
      0 === window.pageYOffset && clearInterval(time),
        window.scroll(0, window.pageYOffset - 250);
    }
    goTop.addEventListener("click", function () {
      time = setInterval(scrollTop, 30);
    }),
      window.addEventListener("scroll", function () {
        200 < window.scrollY
          ? goTop.classList.add("is-opacity")
          : goTop.classList.remove("is-opacity");
      });
  }
};
