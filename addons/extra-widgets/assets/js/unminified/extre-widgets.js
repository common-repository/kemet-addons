(function ($) {
  // Mailchimp Widget.
  "use strict";
  var valid = false;
  function validateValue($value, $target) {
    function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (!regex.test(email)) {
        return false;
      } else {
        return true;
      }
    }

    if ($value == "" || IsEmail($value) == false) {
      $target.addClass("visible");
    } else {
      $target.removeClass("visible");
      valid = true;
    }
  }

  $(".kmt-mailchimp-form").each(function () {
    var $this = $(this);

    $this.submit(function (event) {
      // 1. Prevent form submit default

      event.preventDefault();

      // 2. serialize form data

      var formData = $this.serialize();

      var email = $this.find("input[name='email']");

      // 3. Before submit validate email

      validateValue(email.val(), email.next(".alert"));

      if (email.val() != "" && valid == true) {
        $this.find(".sending").addClass("visible");

        // 4. POST AJAX

        $.ajax({
          type: "POST",
          url: $this.attr("action"),
          action: "kmt_mailchimp",
          data: formData,
        })
          .done(function (response) {
            // 5. If success show the success message to user

            $this.find(".sending").removeClass("visible");
            $this.find(".kmt-mailchimp-success").addClass("visible");
            setTimeout(function () {
              $this.find(".kmt-mailchimp-success").removeClass("visible");
            }, 2000);
          })
          .fail(function (data) {
            // 6. If fail show the error message to user

            $this.find(".sending").removeClass("visible");
            $this.find(".kmt-mailchimp-error").addClass("visible");
            setTimeout(function () {
              $this.find(".kmt-mailchimp-error").removeClass("visible");
            }, 2000);
          })
          .always(function () {
            // 7. Clear the form fields for next subscibe request

            setTimeout(function () {
              $this
                .find("input[name='email']")
                .val(email.attr("data-placeholder"));
            }, 2000);
          });
      }
    });
  });
})(jQuery);
