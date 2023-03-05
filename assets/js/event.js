$(document).ready(function () {
  if (localStorage.getItem("comment") != null) {
    $("#indicator").html(localStorage.getItem("comment"));
    if (localStorage.getItem("cmtClass") == "true") {
      $("#indicator").removeClass("alert-info");
      $("#indicator").removeClass("alert-danger");
      $("#indicator").addClass("alert-success");
    } else {
      $("#indicator").removeClass("alert-success");
      $("#indicator").removeClass("alert-info");
      $("#indicator").addClass("alert-danger");
    }
    localStorage.removeItem("comment");
    localStorage.removeItem("cmtClass");
  } else {
    $("#indicator").html("Click On Date To Request Meeting..");
    $("#indicator").removeClass("alert-success");
    $("#indicator").removeClass("alert-danger");
    $("#indicator").addClass("alert-info");
  }

  $(".gate").on("click", function (e) {
    $("#meetingDate").removeClass("btn btn-outline-danger");
    $("#meetingDate").val(this.getAttribute("data-ddate"));
    $("#eventModal").modal("show");
  });

  $(".trash").on("click", function (e) {
    var id = this.getAttribute("data-id");
    $.post(
      "tempFunction/deleteMeeting.php",
      {
        id: id,
      },
      function (response) {
        localStorage.setItem("comment", response);
        localStorage.setItem("cmtClass", false);
        location.reload();
      }
    );
  });

  setTimeout(function () {
    $("#indicator").html("Click On Date To Request Meeting..");
    $("#indicator").removeClass("alert-success");
    $("#indicator").removeClass("alert-danger");
    $("#indicator").addClass("alert-info");
  }, 3000);

  $(".clickCheck").click(function () {
    $(this).find("small").toggleClass("d-none");
  });
});
