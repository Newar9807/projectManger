$(document).ready(function () {
  if (localStorage.getItem("comment") != null) {
    $("#indicator").html(localStorage.getItem("comment"));
    if (localStorage.getItem("cmtClass") == "true") {
      console.log("active");
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

  $("#meetingForm").submit(function (e) {
    e.preventDefault();
    let description = $("#meetingDescription").val(),
      date = $("#meetingDate").val();
    let choosenDate = date.replaceAll("-", "");

    const d = new Date();
    let year = d.getFullYear(),
      month = d.getMonth() + 1,
      day = d.getDate();
    month = month < 10 ? "0" + month.toString() : month.toString();
    day = day < 10 ? "0" + day.toString() : day.toString();
    let currentDate = year + "-" + month + "-" + day;
    currentDate = currentDate.replaceAll("-", "");
    currentDate = parseInt(currentDate);
    choosenDate = parseInt(choosenDate);

    if (currentDate > choosenDate) {
      $("#meetingDate").addClass(" btn btn-outline-danger");
    } else {
      $("#meetingDate").removeClass("btn btn-outline-danger");
      $.post(
        "tempFunction/studentMeeting.php",
        {
          description: description,
          date: date,
        },
        function (response) {
          localStorage.setItem("comment", response);
          localStorage.setItem("cmtClass", true);
          location.reload();
        }
      );
    }
  });
});
