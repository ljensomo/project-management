import { ajaxPost, swalError } from "./reusable-functions";

$(document).ready(function () {
  const loginForm = "#loginForm";
  $(loginForm).submit(function (e) {
    e.preventDefault();

    ajaxPost({
      url: "/login",
      formData: new FormData(this),
      errorMessage: "Failed to login.",
      callback: function (response) {
        if (response.success) {
          window.location.href = "/projects";
          return;
        }

        swalError(response.message, "Login Error");
        $("#passwordInput").val("");
      },
    });
  });
});
